<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // dd() adalah var_dump() nya punya laravel
        // dd("test dd");

        // pakai cara orm atau eloquent
        $student = Student::all();
        return view('student', ['studentList' => $student,]);
    }
}
