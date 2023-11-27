<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        // Student::create([
        //     'name' => $request->name,
        //     'surname' => $request->surname,
        //     'image' => $image
        //     $table->string('name');
        //     $table->string('');
        //     $table->dateTime('dateOfBirth');
        //     $table->dateTime('dateOfEnrolment');
        //     $table->char('birthEntryNumber') ;
        //     $table->enum('studentType',array('primary', 'secondary'));

        // ]);

        // return to_route('admin.categories.index')
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
