@extends('layouts.mainlayout')
@section('title', 'Extracurricular Detail')

@section('content')
<h2>Detail Extracurricular {{$ekskul->name}}</h2>

<div class="my-3">
    <h4>List Peserta</h4>
    <ol>
        @foreach ($ekskul->students as $item)
        <li>{{$item->name}}</li>
        @endforeach
    </ol>
</div>

@endsection