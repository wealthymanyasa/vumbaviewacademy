<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StudentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeeCreateRequest;
use App\Models\Bill;
use App\Models\Fee;
use App\Models\Guardian;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Auth\Guard;
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
            return to_route('admin.fees.create')->with('warning', 'Student Identification Number is not found');
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
        //dd($request->date_of_payment);
        // Create a new fee for the student
        $tuition = Fee::create([
            'amount' => $request->amount,
            'student_id' => $request->student_id,
            'balance' => $billToSave,
            'date_of_payment' => $request->date_of_payment,
            'academic_year' => $request->academic_year,
            'receipt_number' => $request->receipt_number,
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
    public function show(Fee $fee)
    {
        //get student parent information
        $guardian = Guardian::where('student_id', $fee->student_id)->get();
        //dd($guardian);
        $address = '';
        foreach ($guardian as $guardian){
            $address = $guardian->address;
        }
        //dd($address);
        return view('admin.fees.details', compact('fee','address'));
    }

    // public function saveAsPdf(Fee $fee){
    //     $guardian = Guardian::where('student_id', $fee->student_id)->get('address');
    //     $address = '';
    //     foreach ($guardian as $guardian){
    //         $address = $guardian->address;
    //     }

    //     $pdf = Pdf::loadView('admin.fees.details', compact('fee','address'))->save(storage_path('app/public/receipt-001.pdf'));

    //     return $pdf->stream();
    // }


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

        // if amount is greater than bill the return with error to user
        if ($fee->balance  < $request->amount) {
            $message = 'Enter amount less than the student bill balance of $' . $fee->balance;
            return to_route('admin.fees.edit', $fee->id)->with('warning',  $message);
        }
        //dd($fee->balance );
        // dd($request->amount);
        //get actual change in fee amount
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

        //update fee
        $fee->update([
            'amount' => $request->amount,
            'balance' =>  $updatedFee,
            'receipt_number' => $request->receipt_number,
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
        //  dd($fee->balance);
        //get updated fee
        $updatedFee = $fee->amount + $fee->balance;
        // dd($updatedFee);

        //update corresponding bill balance
        //dd($fee->student_id);
        Bill::where('student_id', $fee->student_id)
            ->where('academic_year', $fee->academic_year)
            ->where('term', $fee->term)
            ->where('bill_type', $fee->bill_type)
            ->update(['bill_amount' => $updatedFee]);

        $fee->delete();
        return to_route('admin.fees.index')->with('danger', 'Fees payment deleted successfully');
    }
}
