@extends('layouts.app')

@section('content')
<div class="container">

    <h2 style="margin-bottom: 20px;">Laporan Inventaris</h2>

    {{-- Filter Tanggal --}}
    <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 25px;">
        <form action="{{ route('reports.index') }}" method="GET"
                style="display: flex; flex-wrap: wrap; align-items: end; gap: 15px;">

            <div>
                <label for="start_date">Dari Tanggal</label>
                <input type="date"
                        id="start_date"
                        name="start_date"
                        value="{{ $startDate }}"
                        style="display: block; padding: 8px; margin-top: 5px;">
            </div>

            <div>
                <label for="end_date">Sampai Tanggal</label>
                <input type="date"
                        id="end_date"
                        name="end_date"
                        value="{{ $endDate }}"
                        style="display: block; padding: 8px; margin-top: 5px;">
            </div>

            <button type="submit" class="btn btn-primary">
                Tampilkan
            </button>

            <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </form>
    </div>

    {{-- Ringkasan Pergerakan Stok --}}
    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 25px;">

        <div style="flex: 1; min-width: 200px; background: white; padding: 20px; border-radius: 8px;">
            <h3 style="margin-top: 0;">Total Barang Masuk</h3>
            <p style="font-size: 24px; font-weight: bold; color: #198754;">
                {{ number_format($totalIn, 0, ',', '.') }}
            </p>
        </div>

        <div style="flex: 1; min-width: 200px; background: white; padding: 20px; border-radius: 8px;">
            <h3 style="margin-top: 0;">Total Barang Keluar</h3>
            <p style="font-size: 24px; font-weight: bold; color: #dc3545;">
                {{ number_format($totalOut, 0, ',', '.') }}
            </p>
        </div>

    </div>

    {{-- Tabel Data Produk --}}
    <div style="margin-bottom: 30px;">
        <h3>Data Produk</h3>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; background: white;">
                <thead>
                    <tr>
                        <th style="background-color: #0B1F3A !important; color: #FFFFFF !important; padding: 12px; text-align: left;">
                            No.
                        </th>
                        <th style="background-color: #0B1F3A !important; color: #FFFFFF !important; padding: 12px; text-align: left;">
                            Kode Produk
                        </th>
                        <th style="background-color: #0B1F3A !important; color: #FFFFFF !important; padding: 12px; text-align: left;">
                            Nama Produk
                        </th>
                        <th style="background-color: #0B1F3A !important; color: #FFFFFF !important; padding: 12px; text-align: left;">
                            Kategori
                        </th>
                        <th style="background-color: #0B1F3A !important; color: #FFFFFF !important; padding: 12px; text-align: left;">
                            Stok
                        </th>
                        <th style="background-color: #0B1F3A !important; color: #FFFFFF !important; padding: 12px; text-align: left;">
                            Stok Minimum
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($products as $product)
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 12px;">
                                {{ $loop->iteration }}
                            </td>

                            <td style="padding: 12px;">
                                {{ $product->sku ?? '-' }}
                            </td>

                            <td style="padding: 12px;">
                                {{ $product->name }}
                            </td>

                            <td style="padding: 12px;">
                                {{ $product->category->name ?? '-' }}
                            </td>

                            <td style="padding: 12px;">
                                {{ $product->stock }}
                            </td>

                            <td style="padding: 12px;">
                                {{ $product->minimum_stock ?? 0 }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 20px; text-align: center;">
                                Belum ada data produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tabel Riwayat Pergerakan Stok --}}
    <div style="margin-bottom: 30px;">
        <h3>Riwayat Pergerakan Stok</h3>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; background: white;">
                <thead>
                    <tr>
                        <th style="background-color: #0B1F3A !important; color: #FFFFFF !important; padding: 12px; text-align: left;">
                            Tanggal
                        </th>
                        <th style="background-color: #0B1F3A !important; color: #FFFFFF !important; padding: 12px; text-align: left;">
                            Produk
                        </th>
                        <th style="background-color: #0B1F3A !important; color: #FFFFFF !important; padding: 12px; text-align: left;">
                            Jenis
                        </th>
                        <th style="background-color: #0B1F3A !important; color: #FFFFFF !important; padding: 12px; text-align: left;">
                            Jumlah
                        </th>
                        <th style="background-color: #0B1F3A !important; color: #FFFFFF !important; padding: 12px; text-align: left;">
                            Supplier
                        </th>
                        <th style="background-color: #0B1F3A !important; color: #FFFFFF !important; padding: 12px; text-align: left;">
                            Keterangan
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($movements as $movement)
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 12px;">
                                {{ $movement->movement_date
                                    ? \Illuminate\Support\Carbon::parse($movement->movement_date)->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td style="padding: 12px;">
                                {{ $movement->product->name ?? '-' }}
                            </td>

                            <td style="padding: 12px;">
                                @if ($movement->type === 'in')
                                    <span style="color: #198754; font-weight: bold;">
                                        Barang Masuk
                                    </span>
                                @else
                                    <span style="color: #dc3545; font-weight: bold;">
                                        Barang Keluar
                                    </span>
                                @endif
                            </td>

                            <td style="padding: 12px;">
                                {{ number_format($movement->quantity, 0, ',', '.') }}
                            </td>

                            <td style="padding: 12px;">
                                {{ $movement->supplier->name ?? '-' }}
                            </td>

                            <td style="padding: 12px;">
                                {{ $movement->note ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 20px; text-align: center;">
                                Belum ada riwayat pergerakan stok untuk periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
