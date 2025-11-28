@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Edit Marketing Number</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('marketing.update', $number->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" value="{{ $number->name }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Phone Number</label>
                <input type="text" name="phone_number" value="{{ $number->phone_number }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Rotation Order</label>
                <input type="number" name="rotation_order" value="{{ $number->rotation_order }}" class="form-control">
            </div>

            <button class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
@endsection
