<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        // $student = Student::all();
        // return view('student', ['studentList' => $student,]);

        // query builder
        // $student = DB::table('students')->get();
        // DB::table('students')->insert([
        //     'name' => 'query builder',
        //     'gender' => 'L',
        //     'nis' => '020202020',
        //     'class_id' => 1,
        // ]);
        // DB::table('students')->where('id', 26)->update([
        //     'name' => 'query builder 2',
        //     'nis' => '010101010',
        //     'class_id' => '3',
        // ]);
        // DB::table('students')->where('id', 26)->delete();

        // eloquent
        // $student = Student::all();
        // Student::create([
        //     'name' => 'eloquent',
        //     'gender' => 'P',
        //     'nis' => '020202022',
        //     'class_id' => 2,
        // ]);
        // Student::find(27)->update([
        //     'name' => 'eloquent 2',
        //     'class_id' => 4,
        // ]);
        // Student::find(27)->delete();

        // dd($student);
    }
}
