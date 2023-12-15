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
            return to_route('admin.fees.create')->with('message', 'Student Id is not found');
        }
        //check bill balance for particular student
        $studentBillBalances = Bill::where('student_id', $request->student_id)->where('bill_type', 'fees')->get();
        foreach ($studentBillBalances as $studentBillBalance) {
            // dd($studentBillBalance->bill_amount);
            // deduct inputed amount from bill amount
            $billToSave = $studentBillBalance->bill_amount - $request->amount;
            $billId = $studentBillBalance->student_id;

            //Update bill in storage.
            Bill::where('student_id', $billId)
                ->update(['bill_amount' => $billToSave,]);
            // Create a new fee for the student
            $tuition = Fee::create([
                'amount' => $request->amount,
                'student_id' => $request->student_id,
                'balance' => $billToSave,
                'dateOfPayment' => $request->dateOfPayment,
            ]);
        }


        // Save the fee for the student
        $student->fees()->save($tuition);
        $bills = Bill::all();
        foreach ($bills as $bill) {
            $bill_balance = $bill->bill_amount;
        }
        //dd();
        return to_route('admin.fees.index', ['bill_balance' => $bill_balance])->with('success', 'Fees payment saved successfully');
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
        //get student bill information
        $studentBillBalances = Bill::where('student_id', $fee->student_id)->where('bill_type', 'fees')->get();
        $studentBill = "";
        foreach ($studentBillBalances as $studentBillBalance) {
            $studentBill = $studentBillBalance->bill_amount;
            $billId = $studentBillBalance->student_id;
        }
        //update bill
        $billToSave = $studentBill - $request->amount;
        // dd($billToSave);
        $this->updateBill($billToSave, $billId);
        // dd($studentBill);
        //if amount is grater than bill the return with error to user
        if ($studentBill < $request->amount) {
            $message = 'Enter amount less than the student bill';
            return to_route('admin.fees.edit', $fee->id)->with('message',  $message);
        }

        /// find all old fees records
        $oldFees = $fee::all();
        // loop through old fees and get the old fee bill
        foreach ($oldFees as $oldFee) {
            //create new balance from old feebilll minus inputed amount
            if ($oldFee->bill != $studentBill) {
                // dd('bills are different');
                // exitif bills are different then compute newbalance using old values
                $newBalance = $studentBill - $request->amount;
            } else {
                $newBalance = $oldFee->bill - $request->amount;
            }
            // dd($oldFee->bill);
            // exit;
        }

        $fee->update([
            'amount' => $request->amount,

            'balance' =>  $newBalance,
            'dateOfPayment' => $request->dateOfPayment,

        ]);

        return to_route('admin.fees.index')->with('success', 'Fees payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fee $fee)
    {
        $fee->delete();
        return to_route('admin.fees.index')->with('warning', 'Fees payment deleted successfully');
    }
}
