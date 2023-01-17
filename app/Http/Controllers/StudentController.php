<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Extracurricular;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
        // $student = Student::orderBy('updated_at', 'desc')->get();

        return view('student', ['studentList' => $student,]);
    }

    public function show($slug)
    {
        // $student = Student::with(['class.homeroomTeacher', 'extracurriculars'])->findOrFail($id);
        $student = Student::with(['class.homeroomTeacher', 'extracurriculars'])->where('slug', $slug)->first();
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
        // dd($request->photo);
        $newName = '';

        if ($request->file('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $strName = preg_replace('/\s+/', '', $request->name);
            $newName = strtolower($strName) . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('photo', $newName);
        }

        $request['image'] = $newName;
        $request['slug'] = Str::slug($request->name, '_');
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

    public function edit($slug)
    {
        $student = Student::with('class')->where('slug', $slug)->first();
        // $student = Student::with('class')->findOrFail($id);
        $class = ClassRoom::get(['id', 'name']);
        return view('student-edit', ['student' => $student, 'class' => $class,]);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $oldPhoto = $student->image;
        // $file_path = 'storage/photo/' . $oldPhoto; // path jika pakai unlink()
        $file_path = 'photo/' . $oldPhoto; // path jika pakai Storage::Delete

        $newName = '';

        if ($request->file('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $strName = preg_replace('/\s+/', '', $request->name);
            $newName = strtolower($strName) . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('photo', $newName);
            $request['image'] = $newName;

            if (isset($oldPhoto) || $oldPhoto != '') {
                // unlink / delete old photo
                // unlink($file_path);
                if (Storage::exists($file_path)) {
                    Storage::delete($file_path);
                } else {
                    dd('file gk ada!');
                }
            }
        } else {
            // timpa dgn nama yg sama, artinya biar gk berubah
            $request['image'] = $oldPhoto;
        }

        // dd($request->all());

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

    public function delete(Request $request, $slug)
    {
        // dd($request->all());
        $student = null;
        if ($request->action == 'soft') {
            // dd('soft delete');
            // $student = Student::findOrFail($id);
            $student = Student::where('slug', $slug)->first();
        } elseif ($request->action == 'force') {
            // dd('force delete');
            $studentTemp = Student::withTrashed()->where('slug', $slug)->get();
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

    public function restore($slug)
    {
        // $deletedStudent = Student::withTrashed()->where('id', $id)->restore();
        $deletedStudent = Student::withTrashed()->where('slug', $slug)->restore();

        if ($deletedStudent) {
            Session::flash('status', 'success');
            Session::flash('message', 'Restore student success!');
        }
        return redirect('/student-deleted');
    }

    // public function massUpdate()
    // {
    //     $student = Student::whereNull('slug')->get();
    //     collect($student)->map(function ($item) {
    //         $item->slug = Str::slug($item->name, '_');
    //         $item->save();
    //     });
    // }
}
