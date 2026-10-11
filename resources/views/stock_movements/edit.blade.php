@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pergerakan Stok</h1>
    <p>Perubahan transaksi akan menyesuaikan stok secara otomatis.</p>

    @if ($errors->any())
        <div style="padding: 10px; margin-bottom: 15px; background: #fee2e2; color: #991b1b;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stock-movements.update', $stockMovement) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label for="product_id">Produk *</label><br>
            <select id="product_id" name="product_id" required style="width: 100%; padding: 8px;">
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                    <option
                        value="{{ $product->id }}"
                        @selected((string) old('product_id', $stockMovement->product_id) === (string) $product->id)
                    >
                        {{ $product->name }} ({{ $product->sku }}) — Stok: {{ $product->stock }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="type">Jenis Transaksi *</label><br>
            <select id="type" name="type" required style="width: 100%; padding: 8px;">
                <option value="in" @selected(old('type', $stockMovement->type) === 'in')>
                    Barang Masuk
                </option>
                <option value="out" @selected(old('type', $stockMovement->type) === 'out')>
                    Barang Keluar
                </option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="quantity">Jumlah *</label><br>
            <input
                type="number"
                id="quantity"
                name="quantity"
                value="{{ old('quantity', $stockMovement->quantity) }}"
                min="1"
                max="2147483647"
                required
                style="width: 100%; padding: 8px;"
            >
        </div>

        <div style="margin-bottom: 15px;">
            <label for="movement_date">Tanggal Transaksi *</label><br>
            <input
                type="date"
                id="movement_date"
                name="movement_date"
                value="{{ old('movement_date', $stockMovement->movement_date->format('Y-m-d')) }}"
                required
                style="width: 100%; padding: 8px;"
            >
        </div>

        <div style="margin-bottom: 15px;">
            <label for="supplier_id">Supplier (opsional)</label><br>
            <select id="supplier_id" name="supplier_id" style="width: 100%; padding: 8px;">
                <option value="">-- Tanpa Supplier --</option>
                @foreach ($suppliers as $supplier)
                    <option
                        value="{{ $supplier->id }}"
                        @selected((string) old('supplier_id', $stockMovement->supplier_id) === (string) $supplier->id)
                    >
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="note">Keterangan</label><br>
            <textarea
                id="note"
                name="note"
                rows="4"
                style="width: 100%; padding: 8px;"
            >{{ old('note', $stockMovement->note) }}</textarea>
        </div>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('stock-movements.index') }}">Batal</a>
    </form>
</div>
@endsection
