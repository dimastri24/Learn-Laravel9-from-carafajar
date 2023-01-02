@extends('layouts.mainlayout')
@section('title', 'Student')

@section('content')
<h1>Ini Halaman Student</h1>

<div class="my-4 d-flex justify-content-between">
    <a href="student-add" class="btn btn-primary">Add Data</a>
    <a href="student-deleted" class="btn btn-info">Show Deleted Data</a>
</div>

@if (Session::has('status'))
<div class="alert alert-success" role="alert">
    {{Session::get('message')}}
</div>
@endif

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
            <td><a href="student/{{$data->id}}" class="btn btn-link p-0">detail</a> | <a
                    href="student-edit/{{$data->id}}" class="btn btn-link p-0">edit</a> |
                {{-- <a href="student-delete/{{$data->id}}">delete</a> --}}
                <form action="student-delete/{{$data->id}}" class="d-inline-block" method="POST">
                    @csrf
                    <input type="hidden" name="action" value="soft">
                    <button type="submit" class="btn btn-link p-0">delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection