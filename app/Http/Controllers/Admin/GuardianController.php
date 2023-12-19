<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardianCreateRequest;
use App\Models\Guardian;
use App\Models\Student;
use Illuminate\Http\Request;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guardians = Guardian::with('student')->get();

        return view('admin.guardians.index', compact('guardians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guardians.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardianCreateRequest $request)
    {

          //check if student id provided exists within the db
          $student = Student::find($request->student_id);
          if ($student == null) {
             // if student id provided does not exist return with message
              return to_route('admin.guardians.create')->with('danger', 'Student Id is not found');
          }
        Guardian::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'address' => $request->address,
            'dateOfEnrolment' => $request->dateOfEnrolment,
            'student_id' => $request->student_id
        ]);

        return to_route('admin.guardians.index')->with('info', 'Parent or Guardian infomation saved successfully');;
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
    public function edit(Guardian $guardian)
    {
        return view('admin.guardians.edit', compact('guardian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guardian $guardian)
    {
        $guardian->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'address' => $request->address,
            'dateOfEnrolment' => $request->dateOfEnrolment,

        ]);

        return to_route('admin.guardians.index')->with('info', 'Parent or Guardian infomation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian)
    {
        $guardian->delete();

        return to_route('admin.guardians.index')->with('warning', 'Parent or Guardian infomation deleted successfully');
    }
}
