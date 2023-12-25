<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusLevyCreateRequest;
use App\Models\Bill;
use App\Models\BusLevy;
use App\Models\Student;
use Illuminate\Http\Request;

class BusLevyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buslevies = BusLevy::with('student')->get();

        return view('admin.buslevies.index', compact('buslevies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.buslevies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BusLevyCreateRequest $request, Student $student)
    {
        //check if student id provided exists within the db
        $student = Student::find($request->student_id);
        if ($student == null) {
            // if student id provided does not exist return with message
            return to_route('admin.buslevies.create')->with('warning', 'Student Identification Number is not found');
        }

        //check if student bill exist
        //dd($request->term);
        //check bill balance for particular student for period chosen for payment
        $studentBillBalances = Bill::where('student_id', $request->student_id)
            ->where('bill_type', 'Buslevies')
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
            return to_route('admin.buslevies.create')->with('warning', 'Error saving payment. Please create student bus levy bill for term ' . $request->term . ' of ' . $request->academic_year);
        }
        //dd( $billToSave);
        //Update bill in storage.
        Bill::where('student_id', $billId)
            ->where('bill_type', 'Buslevies')
            ->where('academic_year', $request->academic_year)
            ->where('term', $request->term)
            ->update(['bill_amount' => $billToSave]);

        // Create a new BusLevy payment for the student
        $busfare = BusLevy::create([
            'amount' => $request->amount,
            'student_id' => $request->student_id,
            'balance' => $billToSave,
            'date_of_payment' => $request->date_of_payment,
            'receipt_number' => $request->receipt_number,
            'academic_year' => $request->academic_year,
            'bill_type' => $request->bill_type,
            'term' => $request->term,
        ]);
        // Save the buslevy for the student
        $student->buslevies()->save($busfare);

        return to_route('admin.buslevies.index')->with('success', 'Bus Levy payment saved successfully');
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
    public function edit(BusLevy $buslevy)
    {
        return view('admin.buslevies.edit',  compact('buslevy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BusLevy $buslevy)
    {
        $request->validate([
            'amount' => 'required',
            'receipt_number' => 'required',
        ]);
        //if amount is grater than bill the return with error to user
        // if amount is greater than bill the return with error to user
        if ($buslevy->balance  < $request->amount) {
            $message = 'Enter amount less than the student bill balance of $' . $buslevy->balance;
            return to_route('admin.buslevys.edit', $buslevy->id)->with('warning',  $message);
        }
        //get actual change in bus levy amount
        $buslevyChange =  $buslevy->amount - $request->amount;

        // set updated buslevy
        $updatedFee = $buslevy->balance + $buslevyChange;

        //update corresponding bill balance
        Bill::where('student_id', $buslevy->student_id)
            ->where('academic_year', $buslevy->academic_year)
            ->where('term', $buslevy->term)
            ->where('bill_type', $buslevy->bill_type)
            ->update(['bill_amount' => $updatedFee,]);

        //update bus levy
        $buslevy->update([
            'amount' => $request->amount,
            'balance' =>  $updatedFee,
            'date_of_payment' => $request->date_of_payment,
            'receipt_number' => $request->receipt_number,

        ]);

        return to_route('admin.buslevies.index')->with('info', 'Bus Levy payment updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusLevy $buslevy)
    {
        //update bill balance before deleting buslevy
        //get updated buslevy
        $updatedBuslevy = $buslevy->amount + $buslevy->balance;

        //update corresponding bill balance
        Bill::where('student_id', $buslevy->student_id)
            ->where('academic_year', $buslevy->academic_year)
            ->where('term', $buslevy->term)
            ->where('bill_type', $buslevy->bill_type)
            ->update(['bill_amount' => $updatedBuslevy]);
        //delete the resource
        $buslevy->delete();
        return to_route('admin.buslevies.index')->with('warning', 'Bus Levy payment deleted successfully');;
    }
}
