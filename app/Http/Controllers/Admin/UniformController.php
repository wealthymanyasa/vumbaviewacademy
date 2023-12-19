<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UniformCreateRequest;
use App\Models\Student;
use App\Models\Uniform;
use Illuminate\Http\Request;

class UniformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uniforms = Uniform::with('student')->get();;
        // foreach($uniforms as $uniform){
        //     dd($uniform->student->name);
        // }
        return view('admin.uniforms.index', compact('uniforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.uniforms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UniformCreateRequest $request, Student $student)
    {

        //check if student id provided exists within the db
        $student = Student::find($request->student_id);
        if ($student == null) {
            // if student id provided does not exist return with message
            return to_route('admin.uniforms.create')->with('message', 'Student Id is not found');
        }
        $uniform = new Uniform;

        if ($request->bill < $request->amount) {
            $message = 'Enter amount less than the student bill';
            return to_route('admin.uniforms.edit', $uniform->id)->with('message',  $message);
        }

        $uniformsBalance = $request->bill - $request->amount;

        // Create a new uniform payment for the student
        $uniformPayment = $uniform::create([
            'amount' => $request->amount,
            'bill' => $request->bill,
            'student_id' => $request->student_id,
            'balance' => $uniformsBalance,
            'dateOfPayment' => $request->dateOfPayment,
        ]);

        // Save the uniform payment for the student
        $student->uniforms()->save($uniformPayment);

        return to_route('admin.uniforms.index')->with('success', 'Uniforms payment saved successfully');
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
    public function edit(Uniform $uniform)
    {
        return view('admin.uniforms.edit', compact('uniform'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Uniform $uniform)
    {
        //if amount is grater than bill the return with error to user
        if ($request->bill < $request->amount) {
            $message = 'Enter amount less than the student bill';
            return to_route('admin.uniforms.edit', $uniform->id)->with('message',  $message);
        }
        /// find all old uniform records
        $oldUniformPayments = $uniform::all();
        // loop through old fees and get the old uniform bill
        foreach ($oldUniformPayments as $oldUniformPayment) {
            //create new balance from old uniform bill minus inputed amount
            if ($oldUniformPayment->bill != $request->bill) {
                // dd('uniforms payment are different');
                // exit if bills are different then compute newbalance using old values
                $newBalance = $request->bill - $request->amount;
            } else {
                //else compute newbalance using new values
                $newBalance = $oldUniformPayment->bill - $request->amount;
            }
            // dd($oldFee->bill);
            // exit;
        }

        $uniform->update([
            'amount' => $request->amount,
            'bill' => $request->bill,
            'balance' => $newBalance,
            'dateOfPayment' => $request->dateOfPayment,
        ]);

        return to_route('admin.uniforms.index')->with('success', 'Uniforms payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uniform $uniform)
    {
        $uniform->delete();

        return to_route('admin.uniforms.index')->with('warning', 'Uniforms payment saved successfully');;
    }
}
