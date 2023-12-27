<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UniformCreateRequest;
use App\Models\Bill;
use App\Models\Guardian;
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
            return to_route('admin.uniforms.create')->with('warning', 'Student Identification Number is not found');
        }

        //check if student bill exist
        //dd($request->term);
        //check bill balance for particular student for period chosen for payment
        $studentBillBalances = Bill::where('student_id', $request->student_id)
            ->where('bill_type', 'Uniforms')
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
            return to_route('admin.uniforms.create')->with('warning', 'Error saving payment. Please create student uniform bill for term ' . $request->term . ' of ' . $request->academic_year);
        }
        //dd( $billToSave);
        //Update bill in storage.
        Bill::where('student_id', $billId)
            ->where('bill_type', 'Uniforms')
            ->where('academic_year', $request->academic_year)
            ->where('term', $request->term)
            ->update(['bill_amount' => $billToSave]);

        // Create a new uniform payment for the student
        $uniformPayment = Uniform::create([
            'amount' => $request->amount,
            'student_id' => $request->student_id,
            'balance' => $billToSave,
            'date_of_payment' => $request->date_of_payment,
            'receipt_number' => $request->receipt_number,
            'academic_year' => $request->academic_year,
            'bill_type' => $request->bill_type,
            'term' => $request->term,
        ]);

        // Save the uniform payment for the student
        $student->uniforms()->save($uniformPayment);

        return to_route('admin.uniforms.index')->with('success', 'Uniforms payment saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Uniform $uniform)
    {
          //get student parent information
          $guardian = Guardian::where('student_id', $uniform->student_id)->get();
          //dd($guardian);
          $address = '';
          foreach ($guardian as $guardian){
              $address = $guardian->address;
          }
          //dd($address);
          return view('admin.uniforms.details', compact('uniform','address'));
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
        // if amount is greater than bill the return with error to user
        if ($uniform->balance  < $request->amount) {
            $message = 'Enter amount less than the student bill balance of $' . $uniform->balance;
            return to_route('admin.uniforms.edit', $uniform->id)->with('warning',  $message);
        }
        //get actual change in uniform amount
        $uniformChange =  $uniform->amount - $request->amount;

        // set updated uniform
        $updatedFee = $uniform->balance + $uniformChange;

        //update corresponding bill balance
        Bill::where('student_id', $uniform->student_id)
            ->where('academic_year', $uniform->academic_year)
            ->where('term', $uniform->term)
            ->where('bill_type', $uniform->bill_type)
            ->update(['bill_amount' => $updatedFee,]);

        //update uniform
        $uniform->update([
            'amount' => $request->amount,
            'balance' =>  $updatedFee,
            'date_of_payment' => $request->date_of_payment,
            'receipt_number' => $request->receipt_number,

        ]);

        return to_route('admin.uniforms.index')->with('info', 'Uniforms payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uniform $uniform)
    {
        //update bill balance before deleting the uniform
        //get updated uniform
        $updatedUniform = $uniform->amount + $uniform->balance;

        //update corresponding bill balance
        Bill::where('student_id', $uniform->student_id)
            ->where('academic_year', $uniform->academic_year)
            ->where('term', $uniform->term)
            ->where('bill_type', $uniform->bill_type)
            ->update(['bill_amount' => $updatedUniform]);
        //delete the resource
        $uniform->delete();
        return to_route('admin.uniforms.index')->with('danger', 'Uniforms payment saved successfully');;
    }
}
