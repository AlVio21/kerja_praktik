@extends('layouts.app')

@section('content')
<h1 class="text-white text-center mb-4 h1 bg-primary p-3">Tambah Produk Baru</h1>
<div class="container">
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="text-white">Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="text-white">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="text-white">Harga (Rp)</label>
            <input type="number" name="price" class="form-control" required>
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="text-white">Stok</label>
            <input type="number" name="stock" class="form-control" required>
            @error('stock')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="text-white">Kategori</label>
            <select name="category" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="motor">Motor</option>
                <option value="mobil">Mobil</option>
            </select>
            @error('category')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>        

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
