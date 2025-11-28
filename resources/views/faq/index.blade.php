@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Daftar FAQ</h1>

    <a href="{{ route('faq.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded mb-4 inline-block">
        + Tambah FAQ
    </a>

    @if(session('success'))
        <div class="p-3 bg-green-100 border border-green-400 text-green-700 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded shadow">
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="p-2 text-left">Pertanyaan</th>
                    <th class="p-2 text-left">Jawaban</th>
                    <th class="p-2 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($faqs as $faq)
                    <tr class="border-b">
                        <td class="p-2">{{ $faq->pertanyaan }}</td>
                        <td class="p-2">{{ Str::limit($faq->jawaban, 80) }}</td>
                        <td class="p-2">
                            <form action="{{ route('faq.destroy', $faq->id) }}" method="POST"
                                onsubmit="return confirm('Hapus FAQ ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection