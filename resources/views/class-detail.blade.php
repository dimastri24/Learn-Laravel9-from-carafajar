@extends('layouts.mainlayout')
@section('title', 'Class Detail')

@section('content')
<h2>Detail Kelas {{$class->name}}</h2>

<div class="my-3">
    <p class="h4">Homeroom Teacher : {{$class->homeroomTeacher->name}}</p>
</div>

<div class="my-3">
    <h4>List Students</h4>
    <ol>
        @foreach ($class->students as $item)
        <li>{{$item->name}}</li>
        @endforeach
    </ol>
</div>

@endsection