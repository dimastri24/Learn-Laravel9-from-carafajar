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

<div class="my-3 d-lg-flex justify-content-between">
    <div class="col mb-3 mb-lg-0">
        <h3 class="m-0">Student List</h3>
    </div>
    <div class="col-12 col-lg-5">
        <form action="" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" placeholder="Keyword..." aria-label="Keyword..."
                    aria-describedby="search-button" autocomplete="off">
                <button class="btn btn-outline-secondary" type="submit" id="search-button">Search</button>
            </div>
        </form>
    </div>
</div>

<table class="table mb-5">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>NIS</th>
            <th>Gender</th>
            <th>Class</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($studentList as $data)
        <tr>
            <td>{{$loop->iteration + $studentList->firstItem() - 1}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->nis}}</td>
            <td>{{$data->gender}}</td>
            <td>{{$data->class->name}}</td>
            <td>
                @if (Auth::user()->role_id != 1 && Auth::user()->role_id != 2)
                -
                @else
                <a href="student/{{$data->id}}" class="btn btn-link p-0">detail</a> |
                <a href="student-edit/{{$data->id}}" class="btn btn-link p-0">edit</a>
                @endif
                @if (Auth::user()->role_id == 1)
                <form action="student-delete/{{$data->id}}" class="d-inline-block" method="POST">
                    @csrf
                    <input type="hidden" name="action" value="soft">
                    | <button type="submit" class="btn btn-link p-0">delete</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="my-5">
    {{$studentList->withQueryString()->links()}}
</div>

@endsection