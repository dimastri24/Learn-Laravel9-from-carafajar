@extends('layouts.mainlayout')
@section('title', 'Deleted Student')

@section('content')
<h1 class="mb-3">Ini Halaman Student yang sudah di Delete</h1>
@if (Session::has('status'))
{{-- <div class="alert alert-success" role="alert">
    {{Session::get('message')}}
</div> --}}
<x-alert message="{{Session::get('message')}}" type='success'></x-alert>
@endif
<a href="/students" class="btn btn-primary">Go Back</a>

<div class="my-3">
    <table class="table">
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
                <td><a href="/student/{{$data->slug}}/restore" class="btn btn-link p-0">restore</a> |
                    {{-- <a href="student-delete/{{$data->id}}">delete</a> --}}
                    <form action="student-delete/{{$data->slug}}" class="d-inline-block" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="force">
                        <button type="submit" class="btn btn-link p-0">delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection