@extends('layouts.app')

@section('title', 'Tambah Produk - Stockify')

@section('content')

<div class="page-header">
    <h1>Tambah Produk</h1>
    <a href="{{ route('products.index') }}" class="btn btn-light">
        Kembali
    </a>
</div>

<div class="card">
    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama Produk *</label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                value="{{ old('name') }}"
                required
            >
            @error('name')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="sku">SKU / Kode Produk *</label>
            <input
                type="text"
                name="sku"
                id="sku"
                class="form-control"
                value="{{ old('sku') }}"
                required
            >
            @error('sku')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Tanpa kategori</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea
                name="description"
                id="description"
                class="form-control"
                rows="3"
            >{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="stock">Jumlah Stok *</label>
            <input
                type="number"
                name="stock"
                id="stock"
                class="form-control"
                min="0"
                value="{{ old('stock', 0) }}"
                required
            >
            @error('stock')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Harga Satuan (Rp) *</label>
            <input
                type="number"
                name="price"
                id="price"
                class="form-control"
                min="0"
                step="0.01"
                value="{{ old('price', 0) }}"
                required
            >
            @error('price')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="minimum_stock">Batas Minimum Stok *</label>
            <input
                type="number"
                name="minimum_stock"
                id="minimum_stock"
                class="form-control"
                min="0"
                value="{{ old('minimum_stock', 5) }}"
                required
            >
            @error('minimum_stock')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn">Simpan Produk</button>
        <a href="{{ route('products.index') }}" class="btn btn-light">
            Batal
        </a>
    </form>
</div>

@endsection
