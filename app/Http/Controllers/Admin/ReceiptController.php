<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusLevy;
use App\Models\Fee;
use App\Models\Student;
use App\Models\Uniform;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * show create fees receipt page
     */
    public function showCreateFeesReceiptPage()
    {
        return view('admin.receipts.fees');
    }
    /**
     * get Student Fees Payments
     */
    public function getStudentFeesPayments(Request $request)
    {       //get student information
        $student = Student::where('id', $request->student_id)->get();

        //validate request
        $request->validate([
            'student_id' => 'required',
            'academic_year' => 'required',
            'term' => 'required',
        ]);
        // get fee details for specific term
        $fees = Fee::where('student_id', $request->student_id)
            ->where('academic_year', $request->academic_year)
            ->where('term', $request->term)
            ->get();
        //get total fees payed for term
        $fees_total = Fee::where('student_id', $request->student_id)
            ->where('academic_year', $request->academic_year)
            ->where('term', $request->term)
            ->sum('amount');
        //dd($fees_total);
        //get due balance fees for term

        return view('admin.receipts.fees_receipt', compact('student', 'fees', 'fees_total'));
    }

     /**
     * show create uniforms receipt page
     */
    public function showCreateUniformsReceiptPage()
    {
        return view('admin.receipts.uniforms');
    }
    /**
     * get Student uniform Payments
     */
    public function getStudentUniformsPayments(Request $request)
    {       //get student information
        $student = Student::where('id', $request->student_id)->get();
        //validate request
        $request->validate([
            'student_id' => 'required',
            'academic_year' => 'required',
            'term' => 'required',
        ]);
        // get fee details for specific term
        $uniforms = Uniform::where('student_id', $request->student_id)
            ->where('academic_year', $request->academic_year)
            ->where('term', $request->term)
            ->get();
        //get total fees payed for term
        $uniforms_total = Uniform::where('student_id', $request->student_id)
            ->where('academic_year', $request->academic_year)
            ->where('term', $request->term)
            ->sum('amount');
        //dd($fees_total);

        return view('admin.receipts.uniforms_receipt', compact('student', 'uniforms', 'uniforms_total'));
    }
     /**
     * show create buslevies receipt page
     */
    public function showCreateBusLeviesReceiptPage()
    {
        return view('admin.receipts.buslevies');
    }
    /**
     * get Student bus levy Payments
     */
    public function getStudentBusLeviesPayments(Request $request)
    {       //get student information
        $student = Student::where('id', $request->student_id)->get();
        //validate request
        $request->validate([
            'student_id' => 'required',
            'academic_year' => 'required',
            'term' => 'required',
        ]);
        //buslevies details for specific term
        $buslevies = BusLevy::where('student_id', $request->student_id)
            ->where('academic_year', $request->academic_year)
            ->where('term', $request->term)
            ->get();
        //get tthe busleviess payed for term
        $buslevies_total = BusLevy::where('student_id', $request->student_id)
            ->where('academic_year', $request->academic_year)
            ->where('term', $request->term)
            ->sum('amount');
        //dd($fees_total);

        return view('admin.receipts.buslevies_receipt', compact('student', 'buslevies', 'buslevies_total'));
    }
}
