@extends('layouts.app')

@section('title', 'Edit Produk - Stockify')

@section('content')

<div class="page-header">
    <h1>Edit Produk</h1>
    <a href="{{ route('products.index') }}" class="btn btn-light">
        Kembali
    </a>
</div>

<div class="card">
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Produk *</label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                value="{{ old('name', $product->name) }}"
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
                value="{{ old('sku', $product->sku) }}"
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
                        {{ (string) old('category_id', $product->category_id) === (string) $category->id ? 'selected' : '' }}
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
            >{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="stock">Jumlah Stok *</label>
            <input
                type="number"
                name="stock"
                id="stock"
                class="form-control"
                min="0"
                value="{{ old('stock', $product->stock) }}"
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
                value="{{ old('price', $product->price) }}"
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
                value="{{ old('minimum_stock', $product->minimum_stock) }}"
                required
            >
            @error('minimum_stock')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn">Simpan Perubahan</button>
        <a href="{{ route('products.index') }}" class="btn btn-light">
            Batal
        </a>
    </form>
</div>

@endsection
