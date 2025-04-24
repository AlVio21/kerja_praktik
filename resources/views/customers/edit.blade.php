@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Customer</h1>

    <form action="{{ route('customers.update', $customer) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $customer->address) }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telepon</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
