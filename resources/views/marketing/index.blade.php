@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-semibold mb-6">Nomor Marketing</h1>

    <a href="{{ route('marketing.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg mb-4 inline-block">
        + Add New
    </a>

    <div class="bg-white shadow rounded-xl p-6">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-700">
                    <th class="p-3">ID</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Phone Number</th>
                    <th class="p-3">Duration</th>
                    <th class="p-3">Rotation Order</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($marketing as $item)
                    <tr
                        class="border-b hover:bg-gray-50 transition
                        @if ($item->status == 1) bg-green-50 @endif">

                        <td class="p-3">{{ $item->id }}</td>
                        <td class="p-3 font-semibold">{{ $item->name }}</td>
                        <td class="p-3">{{ $item->phone_number }}</td>
                        <td class="p-3">{{ $item->duration_hours }} hours</td>
                        <td class="p-3">{{ $item->rotation_order }}</td>

                        <td class="p-3">
                            @if ($item->status == 1)
                                <span class="px-3 py-1 bg-green-600 text-white text-sm rounded-lg">
                                    Active
                                </span>
                            @else
                                <span class="px-3 py-1 bg-gray-400 text-white text-sm rounded-lg">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td class="p-3 flex gap-2">
                            <a href="{{ route('marketing.edit', $item->id) }}"
                                class="px-3 py-1 bg-yellow-500 text-white text-sm rounded">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('marketing.destroy', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus nomor marketing ini?')"
                                    class="px-3 py-1 bg-red-600 text-white text-sm rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
