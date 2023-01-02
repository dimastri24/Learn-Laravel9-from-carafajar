@extends('layouts.mainlayout')
@section('title', 'Edit Student')

@section('content')
<div class="my-5 col-6 mx-auto">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/student/{{$student->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$student->name}}" autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="gender">Gender</label>
            <select name="gender" id="gender" class="form-control">
                <option value="{{$student->gender}}">{{$student->gender}}</option>
                @if ($student->gender == 'L')
                <option value="P">P</option>
                @else
                <option value="L">L</option>
                @endif
            </select>
        </div>
        <div class="mb-3">
            <label for="nis">NIS</label>
            <input type="text" class="form-control" id="nis" name="nis" value="{{$student->nis}}" autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="class">Class</label>
            <select name="class_id" id="class" class="form-control">
                {{-- <option value="{{$student->class->id}}">{{$student->class->name}}</option> --}}
                @foreach ($class as $item)
                <option value="{{$item->id}}" {{ ( $item->id == $student->class->id) ? 'selected' : '' }}>
                    {{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <button class="btn btn-success" type="submit">Update</button>
        </div>
    </form>
</div>

@endsection