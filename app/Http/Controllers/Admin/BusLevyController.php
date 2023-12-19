<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusLevyCreateRequest;
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
            return to_route('admin.buslevies.create')->with('message', 'Student Id is not found');
        }
        //create buslevy object
        $buslevy = new BusLevy;
        //if amount is greater than bill then return with error to user

        if ($request->bill < $request->amount) {
            $message = 'Enter amount less than the student bill';
            //return with error to user
            return to_route('admin.buslevies.create', $buslevy->id)->with('message',  $message);
        }
         //get all students bus levies
        //  $buslevies = BusLevy::all();
        //  foreach ($buslevies as $buslevie){
        //     $bstudent_id = $buslevie->student_id;
        //  }

        //  //if existing balance is notnull do this else
        //  $latestLevy = BusLevy::where('student_id', $bstudent_id)->latest()->first();
        //  dd($latestLevy);
         //else compute $buslevyBalance
        $buslevyBalance = $request->bill - $request->amount;

        // Create a new buslevy for the student

      $busfair = $buslevy::create([
            'amount' => $request->amount,
            'bill' => $request->bill,
            'student_id' => $request->student_id,
            'balance' => $buslevyBalance,
            'dateOfPayment' => $request->dateOfPayment,
        ]);
        // dd($busfair ->amount);
        // exit;
        // Save the buslevy for the student
        $student->buslevies()->save($busfair);

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
        ]);
        //if amount is grater than bill the return with error to user
        if ($request->bill < $request->amount) {
            $message = 'Enter amount less than the student bill';
            return to_route('admin.buslevies.edit', $buslevy->id)->with('warning', $message);
        }
        /// find all old buslevies records
        $oldBusLevies = $buslevy::all();
        // loop through old fees and get the old fee bill
        foreach ($oldBusLevies as $oldBusLevy) {
            //create new balance from old feebilll minus inputed amount
            if ($oldBusLevy->bill != $request->bill) {
                // dd('bills are different');
                // exitif bills are different then compute newbalance using old values
                $newBalance = $request->bill - $request->amount;
            } else {
                $newBalance = $oldBusLevy->bill - $request->amount;
            }
            // dd($oldBusLevies->bill);
            // exit;
        }

        $buslevy->update([
            'amount' => $request->amount,
            'bill' => $request->bill,
            'balance' =>  $newBalance,
            'dateOfPayment' => $request->dateOfPayment,

        ]);

        return to_route('admin.buslevies.index')->with('info', 'Bus Levy payment updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusLevy $buslevy)
    {
        $buslevy->delete();
        return to_route('admin.buslevies.index')->with('warning', 'Bus Levy payment deleted successfully');;
    }
}
