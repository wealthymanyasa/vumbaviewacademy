<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCreateRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::All();
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentCreateRequest $request)
    {
        Student::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'dateOfBirth' => $request->dateOfBirth,
            'birthEntryNumber' => $request->birthEntryNumber,
            'dateOfEnrolment' => $request->dateOfEnrolment,
            'studentType' => $request->studentType

        ]);

        return to_route('admin.students.index');
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
    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
        ]);

        $student->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'dateOfBirth' => $request->dateOfBirth,
            'birthEntryNumber' => $request->birthEntryNumber,
            'dateOfEnrolment' => $request->dateOfEnrolment,
            'studentType' => $request->studentType
        ]);

        return to_route('admin.students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return to_route('admin.students.index');
    }
}
