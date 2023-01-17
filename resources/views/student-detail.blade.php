@extends('layouts.mainlayout')
@section('title', 'Student Detail')

@section('content')
<h2>Detail Siswa {{$student->name}}</h2>

<div class="my-5 d-lg-flex">
    @if ($student->image != '')
    <div class="col col-lg-4 d-flex justify-content-center">
        <img src="{{asset('storage/photo/'.$student->image)}}" alt="photo" width="200"
            class="rounded-circle border border-3 border-white shadow">
    </div>
    @else
    <div class="col col-lg-4 d-flex justify-content-center">
        <img src="{{asset('images/images.jpeg')}}" alt="photo" width="200"
            class="rounded-circle border border-3 border-white shadow">
    </div>
    @endif

    <div class="col col-lg-8">
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
        </table>
    </div>
</div>

@if (Session::has('status'))
{{-- <div class="alert alert-success" role="alert">
    {{Session::get('message')}}
</div> --}}
<x-alert message="{{Session::get('message')}}" type='success'></x-alert>
@endif

<div class="col col-lg-6 bg-light p-3 rounded my-3">
    <p class="h3">Extracurriculars</p>
    <form action="/ekskul-edit" method="POST">
        @csrf
        <input type="hidden" name="student_id" value="{{$student->id}}">
        <div class="row row-cols-3 ms-1">
            @foreach ($ekskul as $item)
            <div class="form-check col">
                <input class="form-check-input" type="checkbox" value="{{$item->id}}" id="ekskulCheckBox"
                    name="extracurricular_id[]"
                    {{ ( $student->extracurriculars->contains($item->id) ) ? 'checked' : '' }}>
                <label class="form-check-label" for="ekskulCheckBox">
                    {{$item->name}}
                </label>
            </div>
            @endforeach
        </div>
        <div class="my-3">
            <button class="btn btn-success" type="submit">Update</button>
        </div>
    </form>
</div>

@endsection