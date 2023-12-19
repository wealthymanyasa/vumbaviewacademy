<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCreateRequest;
use App\Models\Student;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

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

        $request->validate([

            'dateOfBirth' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    // Check if the child is 3 years or older
                    $threeYearsAgo = now()->subYears(3);
                    $attribute = "date of birth";
                    if (strtotime($value) > strtotime($threeYearsAgo)) {
                        $fail("The selected $attribute must be for a child who is 3 years or older.");
                    }
                },
            ],
            'dateOfEnrolment' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    // Disable dates after today's date
                    $maxAllowedDate = now()->format('Y-m-d');
                    $attribute = "date of enrollment";
                    if (strtotime($value) > strtotime($maxAllowedDate)) {
                        $fail("The selected $attribute must be on or before $maxAllowedDate.");
                    }
                },
            ],

        ]);
        //check if birth entry number exists
        $student = Student::where('birthEntryNumber', $request->birthEntryNumber)->get();

        $studentHasbirthEntryNumber = '';
        foreach ($student as $student) {
            $studentHasbirthEntryNumber = $student->birthEntryNumber;
            //dd($studentHas);
        }
        //dd($studentHasbirthEntryNumber);
        if ($studentHasbirthEntryNumber == $request->birthEntryNumber) {
            return to_route('admin.students.create')->with('message', 'Please enter a different birth entry number');
        }

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
    public function show(Student $student)
    {
        return view(
            'admin.students.details',
            ['student' => $student]
        );
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

    public function details()
    {
    }
}
