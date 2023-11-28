<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeCreateRequest;
use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fees = Fee::all();
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
        //create fee object
        $fee = new Fee;
        //if amount is grater than bill the return with error to user

        if ($request->bill < $request->amount) {
            $message = 'Enter amount less than the student bill';
            //return with error to user
            return to_route('admin.fees.create', $fee->id)->with('message',  $message);
        }

        $feesBalance = $request->bill - $request->amount;

        // Create a new fee for the student
        $tuition = $fee::create([
            'amount' => $request->amount,
            'bill' => $request->bill,
            'student_id' => $request->student_id,
            'balance' => $feesBalance,
            'dateOfPayment' => $request->dateOfPayment,
        ]);

        // Save the fee for the student
        $student->fees()->save($tuition);

        return to_route('admin.fees.index');
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
        //if amount is grater than bill the return with error to user
        if ($request->bill < $request->amount) {
            $message = 'Enter amount less than the student bill';
            return to_route('admin.fees.edit', $fee->id)->with('message',  $message);
        }
        /// find all old fees records
        $oldFees = $fee::all();
        // loop through old fees and get the old fee bill
        foreach ($oldFees as $oldFee) {
            //create new balance from old feebilll minus inputed amount
            if ($oldFee->bill != $request->bill) {
                // dd('bills are different');
                // exitif bills are different then compute newbalance using old values
                $newBalance = $request->bill - $request->amount;
            } else {
                $newBalance = $oldFee->bill - $request->amount;
            }
            // dd($oldFee->bill);
            // exit;
        }

        $fee->update([
            'amount' => $request->amount,
            'bill' => $request->bill,
            'balance' =>  $newBalance,
            'dateOfPayment' => $request->dateOfPayment,

        ]);

        return to_route('admin.fees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fee $fee)
    {
        $fee->delete();
        return to_route('admin.fees.index');
    }
}
