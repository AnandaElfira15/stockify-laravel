@extends('layouts.app')

@section('title', 'Detail Kategori - Stockify')

@section('content')
<div class="page-header">
    <h1>Detail Kategori</h1>

    <div>
        <a href="{{ route('categories.edit', $category) }}" class="btn">
            Edit Kategori
        </a>
        <a href="{{ route('categories.index') }}" class="btn btn-light">
            Kembali
        </a>
    </div>
</div>

<div class="card">
    <p><strong>Nama kategori:</strong> {{ $category->name }}</p>
    <p><strong>Deskripsi:</strong> {{ $category->description ?: '-' }}</p>
    <p><strong>Jumlah produk:</strong> {{ $category->products_count ?? $category->products()->count() }}</p>
</div>

<div class="card">
    <h2>Produk dalam Kategori Ini</h2>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Nama Produk</th>
                    <th>Stok</th>
                    <th>Harga</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>Rp {{ number_format((float) $product->price, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada produk dalam kategori ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>
@endsection
