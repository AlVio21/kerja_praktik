@extends('layouts.app')

@section('content')
<h1 class="text-white text-center mb-4 h1 bg-primary p-3">Daftar Produk</h1>
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    <table class="table table-bordered table-dark border-2 border-blue-500">
        <thead class="table-dark text-center fw-bold fs-5">
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th style="width: 1%; white-space: nowrap;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->description }}</td>
                    <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td>{{ $p->stock }}</td>
                    <td>{{ ucfirst($p->category) }}</td>
                    <td>
                        <a href="{{ route('products.edit', $p) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                        <form action="{{ route('products.destroy', $p) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
