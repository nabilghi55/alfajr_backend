@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Tambah Testimoni</h1>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
            <strong>Terjadi Kesalahan:</strong>
            <ul class="list-disc ml-4 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('testimoni.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow">
        @csrf

        <div class="mb-4">
            <label class="font-semibold">Nama</label>
            <input type="text" name="nama" class="w-full border rounded p-2 @error('nama') border-red-500 @enderror"
                value="{{ old('nama') }}" required>
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="font-semibold">Deskripsi Testimoni</label>
            <textarea name="text_description"
                class="w-full border rounded p-2 @error('text_description') border-red-500 @enderror" rows="5"
                required>{{ old('text_description') }}</textarea>
            @error('text_description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan Testimoni
        </button>
    </form>
@endsection