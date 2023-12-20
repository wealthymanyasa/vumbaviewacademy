<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StudentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeeCreateRequest;
use App\Models\Bill;
use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fees =  Fee::with('student')->get();

        return view('admin.fees.index', compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeeCreateRequest $request, Student $student)
    {
        //check if student id provided exists within the db
        $student = Student::find($request->student_id);
        if ($student == null) {
            // if student id provided does not exist return with message
            return to_route('admin.fees.create')->with('danger', 'Student Id is not found');
        }
        //check if student bill exist

        //dd($request->term);
        //check bill balance for particular student for period chosen for payment
        $studentBillBalances = Bill::where('student_id', $request->student_id)
            ->where('bill_type', 'Fees')
            ->where('academic_year', $request->academic_year)
            ->where('term', $request->term)
            ->get();

        $billToSave = "";
        $billId = "";

        foreach ($studentBillBalances as $studentBillBalance) {
            //dd($studentBillBalance->bill_amount);
            // deduct inputed amount from bill amount
            $billToSave = $studentBillBalance->bill_amount - $request->amount;
            $billId = $studentBillBalance->student_id;
        }
        //  dd($billId);
        if ($billToSave == "") {
            return to_route('admin.fees.create')->with('warning', 'Error saving payment. Please create student bill for term ' . $request->term . ' of ' . $request->academic_year);
        }
        //dd( $billToSave);
        //Update bill in storage.
        Bill::where('student_id', $billId)
            ->where('bill_type', 'Fees')
            ->where('academic_year', $request->academic_year)
            ->where('term', $request->term)
            ->update(['bill_amount' => $billToSave]);

        // Create a new fee for the student
        $tuition = Fee::create([
            'amount' => $request->amount,
            'student_id' => $request->student_id,
            'balance' => $billToSave,
            'dateOfPayment' => $request->dateOfPayment,
            'academic_year' => $request->academic_year,
            'bill_type' => $request->bill_type,
            'term' => $request->term,
        ]);
        // Save the fee for the student
        $student->fees()->save($tuition);

        return to_route('admin.fees.index')->with('success', 'Fees payment saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fee $fee,)
    {
        return view('admin.fees.edit', compact('fee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fee $fee)
    {
        $request->validate([
            'amount' => 'required',
        ]);
    //     if amount is greater than bill the return with error to user

        if ($fee->balance  < $request->amount) {
            $message = 'Enter amount less than the student bill balance of $'.$fee->balance;
            return to_route('admin.fees.edit', $fee->id)->with('warning',  $message);
        }
        //dd($fee->balance );
       // dd($request->amount);
       //get actuacl change in fee amount
       $feeChange =  $fee->amount - $request->amount;
      // dd(  $feeChange);
       // set updated fee
        $updatedFee = $fee->balance + $feeChange;
      //  dd($updatedFee);

        //update corresponding bill balance
        //dd($fee->student_id);
          Bill::where('student_id', $fee->student_id)
            ->where('academic_year', $fee->academic_year)
            ->where('term', $fee->term)
            ->where('bill_type', $fee->bill_type)
            ->update(['bill_amount' => $updatedFee,]);
           // dd($fee->student_id);
        // //get student bill information
        // $studentBillBalances = Bill::where('student_id', $fee->student_id)->where('bill_type', 'fees')->get();
        // $studentBill = "";
        // //  dd($studentBillBalances);
        // foreach ($studentBillBalances as $studentBillBalance) {
        //     $studentBill = $studentBillBalance->bill_amount;
        //     $billId = $studentBillBalance->student_id;
        //     $academic_year = $studentBillBalance->academic_year;
        //     $term = $studentBillBalance->term;
        //     $bill_type = $studentBillBalance->bill_type;
        // }
        // //update bill
        // $billToSave = $studentBill - $request->amount;
        // //   dd($billToSave);
        // Bill::where('student_id', $billId)
        //     ->where('academic_year', $academic_year)
        //     ->where('term', $term)
        //     ->where('bill_type', $bill_type)
        //     ->update(['bill_amount' => $billToSave,]);

        //dd($billToSave);
        // dd($studentBill);
        //if amount is greater than bill the return with error to user
        // if ($studentBill < $request->amount) {
        //     $message = 'Enter amount less than the student bill';
        //     return to_route('admin.fees.edit', $fee->id)->with('warning',  $message);
        // }

        /// find all old fees records
        //  $oldFees = $fee::all();
        // loop through old fees and get the old fee bill
        // foreach ($oldFees as $oldFee) {
        //     //create new balance from old feebilll minus inputed amount
        //     if ($oldFee->bill != $studentBill) {
        //         // dd('bills are different');
        //         // exitif bills are different then compute newbalance using old values
        //         $newBalance = $studentBill - $request->amount;
        //     } else {
        //         $newBalance = $oldFee->bill - $request->amount;
        //     }
        //     // dd($oldFee->bill);
        //     // exit;
        // }

        $fee->update([
            'amount' => $request->amount,
            'balance' =>  $updatedFee,
            'dateOfPayment' => $request->dateOfPayment,

        ]);

        return to_route('admin.fees.index')->with('info', 'Fees payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fee $fee, Request $request)
    {
        //update bill balance before deleting the fee
        // dd($fee->amount);
        Bill::where('student_id', $fee->student_id)
            ->where('academic_year', $fee->academic_year)
            ->where('term', $fee->term)
            ->where('bill_type', $fee->bill_type)
            ->update(['bill_amount' => $fee->balance + $fee->amount,]);

        $fee->delete();
        return to_route('admin.fees.index')->with('warning', 'Fees payment deleted successfully');
    }
}
