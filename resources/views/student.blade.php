@extends('layouts.mainlayout')
@section('title', 'Student')

@section('content')
<h1>Ini Halaman Student</h1>

<div class="my-4">
    <a href="student-add" class="btn btn-primary">Add Data</a>
</div>

<h3>Student List</h3>

<table class="table mb-5">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>NIS</th>
            <th>Gender</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($studentList as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->nis}}</td>
            <td>{{$data->gender}}</td>
            <td><a href="student/{{$data->id}}">detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection