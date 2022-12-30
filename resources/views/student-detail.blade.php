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

@endsection