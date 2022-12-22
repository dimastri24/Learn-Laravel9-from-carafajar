@extends('layouts.mainlayout')
@section('title', 'Home')

@section('content')
<h1>Ini Halaman Home</h1>
<h2>Selamat datang, {{ $name }}. Anda adalah {{ $role }}</h2>

{{-- @if ( $role == 'admin')
  <a href="">Ke Halaman Admin</a>
@elseif ( $role == 'staff')  
  <a href="">Ke Halaman gudang</a>
@else
  <a href="">Ke Halaman Apa Hayooo</a>
@endif --}}

{{-- @switch( $role )
    @case($role == 'admin')
        <a href="">Ke Halaman Admin</a>
        @break
    @case($role == 'staff')
        <a href="">Ke Halaman gudang</a>
        @break
    @default
        <a href="">Ke Halaman Apa Hayooo</a>
@endswitch --}}

{{-- @for ($i = 1; $i < 5; $i++)
    {{ $i }} <br>
@endfor --}}


<table class="table">
  <tr>
    <th>No</th>
    <th>Nama</th>
  </tr>
  
  @foreach ($buah as $data)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $data }}</td>
    </tr>
  @endforeach
</table>
@endsection