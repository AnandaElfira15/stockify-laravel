@extends('layouts.app')

@section('content')
<div class="container" style="max-width:1250px; margin:0 auto;">

    <div style="margin-bottom:25px;">
        <h1 style="margin:0 0 8px; color:#0b1f3a;">
            Dashboard Inventaris
        </h1>
        <p style="margin:0; color:#64748b;">
            Ringkasan data dan aktivitas persediaan barang.
        </p>
    </div>

    {{-- Kartu ringkasan --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:16px; margin-bottom:25px;">

        <div style="background:#0b1f3a; color:white; padding:22px; border-radius:12px;">
            <div style="font-size:14px; opacity:.85;">Total Produk</div>
            <div style="font-size:30px; font-weight:bold; margin-top:8px;">
                {{ number_format($totalProducts, 0, ',', '.') }}
            </div>
            <a href="{{ route('products.index') }}"
                style="display:inline-block; margin-top:12px; color:white; font-size:13px;">
                Lihat produk →
            </a>
        </div>

        <div style="background:white; padding:22px; border-radius:12px; box-shadow:0 2px 8px rgba(15,23,42,.06);">
            <div style="color:#64748b; font-size:14px;">Total Kategori</div>
            <div style="font-size:30px; font-weight:bold; color:#0b1f3a; margin-top:8px;">
                {{ number_format($totalCategories, 0, ',', '.') }}
            </div>
            <a href="{{ route('categories.index') }}"
                style="display:inline-block; margin-top:12px; color:#0b1f3a; font-size:13px;">
                Lihat kategori →
            </a>
        </div>

        <div style="background:white; padding:22px; border-radius:12px; box-shadow:0 2px 8px rgba(15,23,42,.06);">
            <div style="color:#64748b; font-size:14px;">Total Supplier</div>
            <div style="font-size:30px; font-weight:bold; color:#0b1f3a; margin-top:8px;">
                {{ number_format($totalSuppliers, 0, ',', '.') }}
            </div>
            <a href="{{ route('suppliers.index') }}"
                style="display:inline-block; margin-top:12px; color:#0b1f3a; font-size:13px;">
                Lihat supplier →
            </a>
        </div>

        <div style="background:white; padding:22px; border-radius:12px; box-shadow:0 2px 8px rgba(15,23,42,.06);">
            <div style="color:#64748b; font-size:14px;">Total Unit Stok</div>
            <div style="font-size:30px; font-weight:bold; color:#0b1f3a; margin-top:8px;">
                {{ number_format($totalStock, 0, ',', '.') }}
            </div>
            <div style="font-size:13px; color:#64748b; margin-top:12px;">
                Jumlah seluruh unit produk
            </div>
        </div>
    </div>

    {{-- Ringkasan barang masuk dan keluar --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:16px; margin-bottom:25px;">

        <div style="background:#d1fae5; color:#065f46; padding:20px; border-radius:10px;">
            <div style="font-size:14px;">Total Barang Masuk</div>
            <div style="font-size:27px; font-weight:bold; margin-top:8px;">
                {{ number_format($totalStockIn, 0, ',', '.') }} unit
            </div>
            <div style="font-size:12px; margin-top:6px;">
                Berdasarkan riwayat transaksi yang tercatat
            </div>
        </div>

        <div style="background:#fee2e2; color:#991b1b; padding:20px; border-radius:10px;">
            <div style="font-size:14px;">Total Barang Keluar</div>
            <div style="font-size:27px; font-weight:bold; margin-top:8px;">
                {{ number_format($totalStockOut, 0, ',', '.') }} unit
            </div>
            <div style="font-size:12px; margin-top:6px;">
                Berdasarkan riwayat transaksi yang tercatat
            </div>
        </div>
    </div>

    {{-- Produk dengan stok menipis --}}
    <div style="background:white; padding:22px; border-radius:12px; box-shadow:0 2px 8px rgba(15,23,42,.06); margin-bottom:25px;">

        <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap; margin-bottom:18px;">
            <h2 style="margin:0; font-size:19px; color:#0b1f3a;">
                Produk dengan Stok Menipis
            </h2>
            <a href="{{ route('products.index') }}"
                style="color:#0b1f3a; font-size:13px;">
                Lihat semua produk →
            </a>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%; min-width:550px; border-collapse:collapse; font-size:14px;">
                <thead>
                    <tr style="background:#0b1f3a; color:white;">
                        <th style="padding:12px; text-align:left;">Kode</th>
                        <th style="padding:12px; text-align:left;">Nama Produk</th>
                        <th style="padding:12px; text-align:right;">Stok</th>
                        <th style="padding:12px; text-align:right;">Batas Minimum</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lowStockProducts as $product)
                        <tr style="border-bottom:1px solid #e2e8f0;">
                            <td style="padding:12px;">
                                {{ $product->sku }}
                            </td>
                            <td style="padding:12px;">
                                {{ $product->name }}
                            </td>
                            <td style="padding:12px; text-align:right; color:#b91c1c; font-weight:bold;">
                                {{ number_format($product->stock, 0, ',', '.') }}
                            </td>
                            <td style="padding:12px; text-align:right;">
                                {{ number_format($product->minimum_stock, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding:22px; text-align:center; color:#64748b;">
                                Tidak ada produk yang berada pada atau di bawah batas minimum stok.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Transaksi terbaru --}}
    <div style="background:white; padding:22px; border-radius:12px; box-shadow:0 2px 8px rgba(15,23,42,.06);">

        <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap; margin-bottom:18px;">
            <h2 style="margin:0; font-size:19px; color:#0b1f3a;">
                Pergerakan Stok Terbaru
            </h2>
            <a href="{{ route('stock-movements.index') }}"
                style="color:#0b1f3a; font-size:13px;">
                Lihat semua transaksi →
            </a>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%; min-width:700px; border-collapse:collapse; font-size:14px;">
                <thead>
                    <tr style="background:#0b1f3a; color:white;">
                        <th style="padding:12px; text-align:left;">Tanggal</th>
                        <th style="padding:12px; text-align:left;">Kode Produk</th>
                        <th style="padding:12px; text-align:left;">Nama Produk</th>
                        <th style="padding:12px; text-align:left;">Jenis</th>
                        <th style="padding:12px; text-align:right;">Jumlah</th>
                        <th style="padding:12px; text-align:left;">Supplier</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentMovements as $movement)
                        <tr style="border-bottom:1px solid #e2e8f0;">
                            <td style="padding:12px;">
                                {{ $movement->movement_date?->format('d-m-Y') ?? '-' }}
                            </td>
                            <td style="padding:12px;">
                                {{ $movement->product?->sku ?? '-' }}
                            </td>
                            <td style="padding:12px;">
                                {{ $movement->product?->name ?? '-' }}
                            </td>
                            <td style="padding:12px;">
                                @if ($movement->type === 'in')
                                    <span style="padding:5px 8px; background:#d1fae5; color:#065f46; border-radius:5px;">
                                        Masuk
                                    </span>
                                @else
                                    <span style="padding:5px 8px; background:#fee2e2; color:#991b1b; border-radius:5px;">
                                        Keluar
                                    </span>
                                @endif
                            </td>
                            <td style="padding:12px; text-align:right;">
                                {{ number_format($movement->quantity, 0, ',', '.') }}
                            </td>
                            <td style="padding:12px;">
                                {{ $movement->supplier?->name ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding:22px; text-align:center; color:#64748b;">
                                Belum ada transaksi pergerakan stok.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
