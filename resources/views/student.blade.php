@extends('layouts.mainlayout')
@section('title', 'Students')

@section('content')
<h1>Ini Halaman Students</h1>
<h3>Student List</h3>
<ol>
    @foreach ($studentList as $data)
    <li>{{$data->name}} | {{$data->nis}} | {{$data->gender}} </li>
    @endforeach
</ol>
@endsection