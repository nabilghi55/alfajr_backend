@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto pb-20">
        
        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Marketing Number</h1>
                <p class="text-gray-500 mt-1">Perbarui informasi kontak CS.</p>
            </div>
            
            <a href="{{ route('marketing.index') }}" class="hidden md:inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- ERROR ALERT --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r shadow-sm">
                <strong class="font-bold">Terjadi kesalahan:</strong>
                <ul class="list-disc list-inside text-sm pl-5 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM CARD --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50 flex items-center">
                <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <h2 class="font-bold text-gray-700">Edit Data Kontak</h2>
            </div>

            <div class="p-8">
                <form action="{{ route('marketing.update', $number->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        {{-- Name --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Marketing / CS <span class="text-red-500">*</span></label>
                            <input type="text" name="name" class="w-full rounded-lg border-gray-300 focus:border-yellow-500 focus:ring focus:ring-yellow-200 transition shadow-sm" 
                                value="{{ old('name', $number->name) }}" required>
                        </div>

                        {{-- Phone Number --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <input type="text" name="phone_number" class="pl-10 w-full rounded-lg border-gray-300 focus:border-yellow-500 focus:ring focus:ring-yellow-200 transition shadow-sm" 
                                    value="{{ old('phone_number', $number->phone_number) }}" required>
                            </div>
                        </div>

                        {{-- Rotation Order --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Urutan Rotasi <span class="text-red-500">*</span></label>
                            <input type="number" name="rotation_order" class="w-full rounded-lg border-gray-300 focus:border-yellow-500 focus:ring focus:ring-yellow-200 transition shadow-sm" 
                                value="{{ old('rotation_order', $number->rotation_order) }}" required>
                        </div>

                    </div>

                    <div class="mt-10 flex justify-end border-t border-gray-100 pt-6">
                        <button type="submit" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Perbarui Data
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection