<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Extracurricular;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::get();
        return view('student', ['studentList' => $student,]);
    }

    public function show($id)
    {
        $student = Student::with(['class.homeroomTeacher', 'extracurriculars'])->findOrFail($id);
        $ekskul = Extracurricular::get(['id', 'name']);
        return view('student-detail', ['student' => $student, 'ekskul' => $ekskul,]);
    }

    public function create()
    {
        $class = ClassRoom::select('id', 'name')->get();
        return view('student-add', ['class' => $class,]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $student = new Student();
        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->nis = $request->nis;
        // $student->class_id = $request->class_id;
        // $student->save();

        // mass assignment
        $student = Student::create($request->all());
        return redirect('/students');
    }

    public function addEkskul(Request $request)
    {
        $student = Student::find($request->student_id);
        $student->extracurriculars()->attach($request->extracurricular_id);
        return redirect('/students');
    }
}
