@extends('layouts.app')

@section('content')
<div class="container" style="max-width:900px; margin:0 auto;">
    <h1 style="color:#0b1f3a;">Tambah Pergerakan Stok</h1>
    <p style="color:#64748b;">
        Catat transaksi barang masuk atau barang keluar.
    </p>

    @if ($errors->any())
        <div style="padding:15px; margin-bottom:20px; background:#fee2e2; color:#991b1b; border-radius:8px;">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stock-movements.store') }}" method="POST"
            style="background:white; padding:24px; border-radius:10px; box-shadow:0 2px 8px rgba(15,23,42,.08);">
        @csrf

        <div style="margin-bottom:18px;">
            <label for="product_id">Produk</label>
            <select name="product_id" id="product_id" required
                    style="display:block; width:100%; padding:11px; margin-top:7px; border:1px solid #cbd5e1; border-radius:7px;">
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}"
                        {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->sku }} - {{ $product->name }}
                        (Stok: {{ $product->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:18px;">
            <label for="type">Jenis Pergerakan</label>
            <select name="type" id="type" required
                    style="display:block; width:100%; padding:11px; margin-top:7px; border:1px solid #cbd5e1; border-radius:7px;">
                <option value="">-- Pilih Jenis --</option>
                <option value="in" {{ old('type') === 'in' ? 'selected' : '' }}>
                    Barang Masuk
                </option>
                <option value="out" {{ old('type') === 'out' ? 'selected' : '' }}>
                    Barang Keluar
                </option>
            </select>
        </div>

        <div style="margin-bottom:18px;">
            <label for="quantity">Jumlah Barang</label>
            <input type="number" name="quantity" id="quantity"
                    min="1" max="2147483647"
                    value="{{ old('quantity') }}" required
                    style="display:block; width:100%; padding:11px; margin-top:7px; border:1px solid #cbd5e1; border-radius:7px;">
        </div>

        <div style="margin-bottom:18px;">
            <label for="movement_date">Tanggal Transaksi</label>
            <input type="date" name="movement_date" id="movement_date"
                    value="{{ old('movement_date', date('Y-m-d')) }}" required
                    style="display:block; width:100%; padding:11px; margin-top:7px; border:1px solid #cbd5e1; border-radius:7px;">
        </div>

        <div style="margin-bottom:18px;">
            <label for="supplier_id">Supplier (Opsional)</label>
            <select name="supplier_id" id="supplier_id"
                    style="display:block; width:100%; padding:11px; margin-top:7px; border:1px solid #cbd5e1; border-radius:7px;">
                <option value="">-- Tanpa Supplier --</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}"
                        {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:24px;">
            <label for="note">Catatan (Opsional)</label>
            <textarea name="note" id="note" rows="3"
                        style="display:block; width:100%; padding:11px; margin-top:7px; border:1px solid #cbd5e1; border-radius:7px;">{{ old('note') }}</textarea>
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <button type="submit"
                    style="padding:11px 18px; background:#0b1f3a; color:white; border:0; border-radius:7px; cursor:pointer;">
                Simpan Transaksi
            </button>

            <a href="{{ route('stock-movements.index') }}"
                style="padding:11px 18px; background:#e2e8f0; color:#334155; text-decoration:none; border-radius:7px;">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
