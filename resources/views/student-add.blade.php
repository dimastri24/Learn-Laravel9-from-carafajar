@extends('layouts.mainlayout')
@section('title', 'Add New Student')

@section('content')

<div class="my-5 col-6 mx-auto">
    <form action="student" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="gender">Gender</label>
            <select name="gender" id="gender" class="form-control" required>
                <option>Select One</option>
                <option value="L">Laki Laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="nis">NIS</label>
            <input type="text" class="form-control" id="nis" name="nis" required autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="class">Class</label>
            <select name="class_id" id="class" class="form-control" required>
                <option>Select One</option>
                @foreach ($class as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </form>
</div>

@endsection