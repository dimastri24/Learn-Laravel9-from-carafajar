<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Models\Extracurricular;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StudentCreateRequest;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $student = Student::with('class:id,name')
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('gender', $keyword)
            ->orWhere('nis', 'LIKE', '%' . $keyword . '%')
            ->orWhereHas('class', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(15);
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

    public function store(StudentCreateRequest $request)
    {
        // dd($request->all());
        // $student = new Student();
        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->nis = $request->nis;
        // $student->class_id = $request->class_id;
        // $student->save();

        // $validated = $request->validate([
        //     'nis' => 'required|unique:students|min:9|max:10',
        //     'name' => 'required|max:50',
        //     'gender' => 'required',
        //     'class_id' => 'required',
        // ]);

        // mass assignment
        $student = Student::create($request->all());

        if ($student) {
            Session::flash('status', 'success');
            Session::flash('message', 'Add new student success!');
        }

        return redirect('/students');
    }

    public function addEkskul(Request $request)
    {
        $student = Student::find($request->student_id);
        $student->extracurriculars()->attach($request->extracurricular_id);

        return redirect('/students');
    }

    public function edit($id)
    {
        $student = Student::with('class')->findOrFail($id);
        $class = ClassRoom::get(['id', 'name']);
        return view('student-edit', ['student' => $student, 'class' => $class,]);
    }

    public function update(StudentCreateRequest $request, $id)
    {
        $student = Student::findOrFail($id);
        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->nis = $request->nis;
        // $student->class_id = $request->class_id;
        // $student->save();
        $student->update($request->all());

        if ($student) {
            Session::flash('status', 'success');
            Session::flash('message', 'Edit student success!');
        }

        return redirect('/students');
    }

    public function editEkskul(Request $request)
    {
        $ekskulList = $request->extracurricular_id;
        // dd($ekskulList[0]);
        $student = Student::find($request->student_id);
        $student->extracurriculars()->sync($ekskulList);

        if ($student) {
            Session::flash('status', 'success');
            Session::flash('message', 'Edit ekskul success!');
        }

        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        // dd($request->all());
        $student = null;
        if ($request->action == 'soft') {
            // dd('soft delete');
            $student = Student::findOrFail($id);
        } elseif ($request->action == 'force') {
            // dd('force delete');
            $studentTemp = Student::withTrashed()->where('id', $id)->get();
            $student = $studentTemp[0];
        }

        // dd($student);
        if ($student == null) {
            return abort(404);
        } else {
            return view('student-delete', ['student' => $student, 'action' => $request->action,]);
        }
    }

    public function destroy(Request $request, $id)
    {
        // $deletedStudent = DB::table('students')->where('id', $id)->delete();
        $deletedStudent = null;
        // dd($request->all());

        switch ($request->input('submit')) {
            case 'soft':
                $deletedStudent = Student::findOrFail($id)->delete();
                // $deletedStudent->delete();
                // dd('soft delete');
                break;
            case 'force':
                $deletedStudent = Student::withTrashed()->where('id', $id)->forceDelete();
                // $deletedStudent[0]->forceDelete();
                // dd('force delete');
                break;
        }

        if ($deletedStudent) {
            Session::flash('status', 'success');
            Session::flash('message', 'Delete student success!');
        } else {
            return abort(404);
        }

        return redirect('/students');
    }

    public function deletedStudent()
    {
        $deletedStudent = Student::onlyTrashed()->get();
        return view('student-deleted-list', ['studentList' => $deletedStudent,]);
    }

    public function restore($id)
    {
        $deletedStudent = Student::withTrashed()->where('id', $id)->restore();

        if ($deletedStudent) {
            Session::flash('status', 'success');
            Session::flash('message', 'Restore student success!');
        }
        return redirect('/student-deleted');
    }
}
