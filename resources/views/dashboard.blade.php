@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="bg-white shadow rounded-xl p-6">
        <p class="text-gray-700">Selamat datang, {{ auth()->user()->name }}!</p>
        <p class="text-gray-500 mt-2">Anda berhasil login ke panel admin.</p>
    </div>
@endsection
