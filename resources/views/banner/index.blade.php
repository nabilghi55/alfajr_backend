@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Banner</h1>

    <a href="{{ route('banner.create') }}"
        class="px-4 py-2 bg-blue-600 text-white rounded-lg mb-6 inline-block hover:bg-blue-700">
        + Tambah Banner
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($banners as $b)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('storage/' . $b->image) }}" class="w-full h-40 object-cover">

                <div class="p-4">
                    <h3 class="font-bold">{{ $b->name }}</h3>

                    <form action="{{ route('banner.destroy', $b->id) }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus banner ini?')"
                            class="px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach

    </div>
@endsection