@extends('layouts.mainlayout')
@section('title', 'Students')

@section('content')
<h1>Ini Halaman Students</h1>
<h3>Student List</h3>

<table class="table mb-5">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>NIS</th>
            <th>Gender</th>
            <th>Class</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($studentList as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->nis}}</td>
            <td>{{$data->gender}}</td>
            <td>{{$data->class['name']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection