@extends('layouts.mainlayout')
@section('title', 'Teacher')

@section('content')
<h1>Ini Halaman Teacher</h1>
<h3>Teacher List</h3>

<table class="table mb-5">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teacherList as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->name}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection