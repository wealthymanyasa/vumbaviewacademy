<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillCreateRequest;
use App\Models\Bill;
use App\Models\Student;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use LengthException;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::with('student')->get();

        return view('admin.bills.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BillCreateRequest $request)
    {    //check if student id provided exists within the db
        $student = Student::find($request->student_id);
        if ($student == null) {
            // if student id provided does not exist return with message
            return to_route('admin.bills.create')->with('message', 'Student ID is not found');
        }
        //check if student has bill for the current enrolment term
        $studentBills = Bill::where('student_id', $request->student_id)
            ->where('academic_year', $request->academic_year)
            ->where('bill_type', $request->bill_type)
            ->where('term', $request->term)
            ->get();
        $studentBillId ='';
          //  dd(json_encode($studentBills));
        foreach ($studentBills as $studentBill) {
             //dd($studentBill->student_id);
            $studentBillId = $studentBill->student_id;
        }
            //check if bill exists
            if ($studentBillId == "") {
               // dd("null stndt id");
                //create bill
                Bill::create([
                    'bill_amount' => $request->bill_amount,
                    'bill_type' => $request->bill_type,
                    'student_id' => $request->student_id,
                    'academic_year' => $request->academic_year,
                    'term' => $request->term,
                ]);
            } else {
                // if bill exists return with message
                return to_route('admin.bills.create')->with('message', 'Can not create duplicate bill for student');
            }




        return to_route('admin.bills.index');
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
    public function edit(Bill $bill)
    {
        return view('admin.bills.edit', compact('bill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'bill_amount' => 'required',
            'bill_type' => 'required',
            'academic_year' => 'required',
            'term' => 'required',
        ]);
        $bill->update([
            'bill_amount' => $request->bill_amount,
            'bill_type' => $request->bill_type,
            'academic_year' => $request->academic_year,
            'term' => $request->term,
        ]);

        return to_route('admin.bills.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();
        return to_route('admin.bills.index');
    }
}
