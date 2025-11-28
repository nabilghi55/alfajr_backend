@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Tambah Banner</h1>

    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label>Nama Banner</label>
            <input type="text" name="name" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label>Gambar Banner</label>
            <input type="file" name="image" class="w-full border rounded p-2" accept="image/*" required>
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan
        </button>
    </form>
@endsection