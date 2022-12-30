@extends('layouts.mainlayout')
@section('title', 'Teacher Detail')

@section('content')
<h2>Detail Teacher {{$teacher->name}}</h2>

<div class="my-3">
    <h4>
        Class :
        @if ($teacher->class)
        {{$teacher->class->name}}
        @else
        -
        @endif
    </h4>
    @if ($teacher->class)
    <h4>Student List</h4>
    <ol>
        @foreach ($teacher->class->students as $item)
        <li>{{$item->name}}</li>
        @endforeach
    </ol>
    @else
    Bukan Homeroom Teacher
    @endif
</div>

@endsection