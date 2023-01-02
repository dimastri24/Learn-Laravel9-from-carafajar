@extends('layouts.mainlayout')
@section('title', 'Student Detail')

@section('content')
<h2>Detail Siswa {{$student->name}}</h2>

<table class="table table-bordered my-3">
    <tr>
        <th class="col-4">NIS</th>
        <td class="col-8">{{$student->nis}}</td>
    </tr>
    <tr>
        <th>Gender</th>
        <td>@if ($student->gender == 'P')
            Perempuan
            @else
            Laki-laki
            @endif
        </td>
    </tr>
    <tr>
        <th>Class</th>
        <td>{{$student->class->name}}</td>
    </tr>
    <tr>
        <th>Homeroom Teacher</th>
        <td>{{$student->class->homeroomTeacher->name}}</td>
    </tr>
    <tr>
        <th>Extracurriculars</th>
        <td>
            <ul class="list-group list-group-horizontal-lg col-8">
                @foreach ($student->extracurriculars as $item)
                <li class="list-group-item">{{$item->name}}</li>
                @endforeach
            </ul>
        </td>
    </tr>
</table>
{{$ekskul}}
{{-- <a href="ekskul-add/{{$student->id}}" class="btn btn-success">Add Extracurricular</a> --}}
<div class="my-5 col-6 bg-light p-5 rounded">
    <p class="h3">Add New Extracurriculars</p>
    <form action="/ekskul-add" method="POST">
        @csrf
        <div class="mb-3">
            <input type="hidden" name="student_id" value="{{$student->id}}">
            <label for="ekskul">Extracurriculars</label>
            <select name="extracurricular_id" id="ekskul" class="form-control" required>
                <option>Select One</option>
                @foreach ($ekskul as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </form>
</div>

@endsection