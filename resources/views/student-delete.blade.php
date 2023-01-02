@extends('layouts.mainlayout')
@section('title', 'Delete Student')

@section('content')
<div class="my-5">
    <h2>Are you sure want to delete data : {{$student->name}} ( {{$student->nis}} )</h2>

    <form action="/student-destroy/{{$student->id}}" method="POST">
        @method('DELETE')
        @csrf
        @if ($action == 'soft')
        <button class="btn btn-warning" type="submit" name="submit" value="soft">Soft Delete</button>
        @endif
        <button class="btn btn-danger" type="submit" name="submit" value="force">Force Delete</button>
        <a href="/{{ ($action == 'soft') ? 'students' : 'student-deleted' }}" class="btn btn-primary">Cancel</a>
    </form>
</div>
@endsection