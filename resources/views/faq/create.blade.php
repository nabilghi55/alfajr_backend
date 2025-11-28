@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Tambah FAQ</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
            <strong>Terjadi Kesalahan:</strong>
            <ul class="list-disc ml-4 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('faq.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label class="font-semibold">Pertanyaan</label>
            <input type="text" name="pertanyaan" class="w-full border rounded p-2" value="{{ old('pertanyaan') }}" required>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Jawaban</label>
            <textarea name="jawaban" rows="5" class="w-full border rounded p-2" required>{{ old('jawaban') }}</textarea>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan FAQ
        </button>
    </form>
@endsection