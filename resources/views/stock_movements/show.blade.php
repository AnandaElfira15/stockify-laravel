@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pergerakan Stok</h1>

    <table style="width: 100%; max-width: 750px; border-collapse: collapse;"
        border="1" cellpadding="10">
        <tr>
            <th style="text-align: left;">Produk</th>
            <td>{{ $stockMovement->product->name }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">SKU</th>
            <td>{{ $stockMovement->product->sku }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Jenis Transaksi</th>
            <td>{{ $stockMovement->type === 'in' ? 'Barang Masuk' : 'Barang Keluar' }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Jumlah</th>
            <td>{{ number_format($stockMovement->quantity, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Tanggal</th>
            <td>{{ $stockMovement->movement_date->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Supplier</th>
            <td>{{ $stockMovement->supplier?->name ?? '-' }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Keterangan</th>
            <td>{{ $stockMovement->note ?: '-' }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Dibuat</th>
            <td>{{ $stockMovement->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Diperbarui</th>
            <td>{{ $stockMovement->updated_at?->format('d-m-Y H:i') ?? '-' }}</td>
        </tr>
    </table>

    <p style="margin-top: 20px;">
        <a href="{{ route('stock-movements.edit', $stockMovement) }}">Edit Transaksi</a>
        |
        <a href="{{ route('stock-movements.index') }}">Kembali ke Daftar</a>
    </p>
</div>
@endsection
