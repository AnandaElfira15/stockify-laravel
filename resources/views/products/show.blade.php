@extends('layouts.app')

@section('title', 'Detail Produk - Stockify')

@section('content')

<div class="page-header">
    <h1>Detail Produk</h1>

    <div>
        <a href="{{ route('products.edit', $product) }}" class="btn">
            Edit Produk
        </a>

        <a href="{{ route('products.index') }}" class="btn btn-light">
            Kembali
        </a>
    </div>
</div>

<div class="card">
    <table>
        <tbody>
            <tr>
                <th>SKU</th>
                <td>{{ $product->sku }}</td>
            </tr>

            <tr>
                <th>Nama Produk</th>
                <td>{{ $product->name }}</td>
            </tr>

            <tr>
                <th>Kategori</th>
                <td>{{ $product->category?->name ?? 'Tanpa kategori' }}</td>
            </tr>

            <tr>
                <th>Deskripsi</th>
                <td>{{ $product->description ?: '-' }}</td>
            </tr>

            <tr>
                <th>Stok</th>
                <td>{{ $product->stock }}</td>
            </tr>

            <tr>
                <th>Harga Satuan</th>
                <td>
                    Rp {{ number_format((float) $product->price, 0, ',', '.') }}
                </td>
            </tr>

            <tr>
                <th>Batas Minimum Stok</th>
                <td>{{ $product->minimum_stock }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    @if ($product->stock <= $product->minimum_stock)
                        <span class="badge badge-low">Stok Menipis</span>
                    @else
                        <span class="badge">Tersedia</span>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
