<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {

        return view('admin.index');
    }

    public function dashboard()
    {
        $students = DB::table('students')->count();
        $bills = DB::table('bills')->count();
        $fees = DB::table('fees')->count();
        $buslevies = DB::table('bus_levies')->count();
        $guardians = DB::table('guardians')->count();
        $uniforms = DB::table('uniforms')->count();

        return view('dashboard', compact('students', 'uniforms', 'guardians', 'bills', 'buslevies', 'fees'));
    }


}
