@extends('layouts.app')

@section('title', 'Daftar Produk - Stockify')

@section('content')

<div class="page-header">
    <div>
        <h1>Daftar Produk</h1>
        <p>Kelola stok dan informasi produk kamu.</p>
    </div>

    <a href="{{ route('products.create') }}" class="btn">
        + Tambah Produk
    </a>
</div>

<div class="card">
    <form action="{{ route('products.index') }}" method="GET">
        <div class="filter-grid">

            <div class="form-group">
                <label for="search">Cari produk</label>
                <input
                    type="text"
                    name="search"
                    id="search"
                    class="form-control"
                    placeholder="Masukkan nama atau SKU..."
                    value="{{ $search }}"
                >
            </div>

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Semua kategori</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ (string) $categoryId === (string) $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="sort">Urutkan berdasarkan</label>
                <select name="sort" id="sort" class="form-control">
                    <option value="name" {{ $sort === 'name' ? 'selected' : '' }}>
                        Nama
                    </option>
                    <option value="sku" {{ $sort === 'sku' ? 'selected' : '' }}>
                        SKU
                    </option>
                    <option value="stock" {{ $sort === 'stock' ? 'selected' : '' }}>
                        Stok
                    </option>
                    <option value="price" {{ $sort === 'price' ? 'selected' : '' }}>
                        Harga
                    </option>
                    <option value="created_at" {{ $sort === 'created_at' ? 'selected' : '' }}>
                        Tanggal ditambahkan
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="direction">Urutan</label>
                <select name="direction" id="direction" class="form-control">
                    <option value="asc" {{ $direction === 'asc' ? 'selected' : '' }}>
                        Naik
                    </option>
                    <option value="desc" {{ $direction === 'desc' ? 'selected' : '' }}>
                        Turun
                    </option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Terapkan</button>
                <a href="{{ route('products.index') }}" class="btn btn-light">
                    Reset
                </a>
            </div>

        </div>
    </form>
</div>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>SKU</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Status Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>
                            {{ $products->firstItem() + $loop->index }}
                        </td>

                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category?->name ?? '-' }}</td>
                        <td>{{ $product->stock }}</td>

                        <td>
                            Rp {{ number_format((float) $product->price, 0, ',', '.') }}
                        </td>

                        <td>
                            @if ($product->stock <= $product->minimum_stock)
                                <span class="badge badge-low">Stok Menipis</span>
                            @else
                                <span class="badge">Tersedia</span>
                            @endif
                        </td>

                        <td>
                            <div class="actions">
                                <a
                                    href="{{ route('products.show', $product) }}"
                                    class="btn btn-light"
                                >
                                    Detail
                                </a>

                                <a
                                    href="{{ route('products.edit', $product) }}"
                                    class="btn"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('products.destroy', $product) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">
                            Produk tidak ditemukan.
                        </td>
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
