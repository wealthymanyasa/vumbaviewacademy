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

        $student_id = $request->student_id;
        $student = Student::find($student_id);

        $feesBalance = $request->bill - $request->amount;
       //dd($feesBalance);
        //exit;
        // Create a new fee for the student
        $fee = Fee::create([
            'amount' => $request->amount,
            'bill' => $request->bill,
            'student_id' => $request->student_id,
            'balance' => $feesBalance,
            'dateOfPayment' => $request->dateOfPayment,
        ]);

        // Save the fee for the student
        $student->fees()->save($fee);

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
