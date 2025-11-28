@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Daftar Testimoni</h1>

    <a href="{{ route('testimoni.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg mb-6 inline-block">
        + Tambah Testimoni
    </a>

    @if(session('success'))
        <div class="p-3 bg-green-100 border border-green-400 text-green-700 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded-lg shadow">
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-2">Nama</th>
                    <th class="text-left p-2">Deskripsi</th>
                    <th class="text-left p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($testimonis as $item)
                    <tr class="border-b">
                        <td class="p-2">{{ $item->nama }}</td>
                        <td class="p-2">{{ Str::limit($item->text_description, 80) }}</td>
                        <td class="p-2">
                            <form action="{{ route('testimoni.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Hapus testimoni ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection