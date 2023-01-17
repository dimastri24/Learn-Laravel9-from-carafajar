@extends('layouts.mainlayout')
@section('title', 'Home')

@section('content')
<h1>Ini Halaman Home</h1>
<h2>Selamat datang, {{Auth::user()->name}}. Anda adalah {{Auth::user()->role->name}}</h2>

<x-alert message='Ini adalah halaman home' type='success'></x-alert>
@endsection