@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Add Marketing Number</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('marketing.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}">
            </div>

            <div class="mb-3">
                <label>Rotation Order</label>
                <input type="number" name="rotation_order" class="form-control" value="{{ old('rotation_order') }}">
            </div>

            <button class="btn btn-primary mt-2">Save</button>
        </form>
    </div>
@endsection