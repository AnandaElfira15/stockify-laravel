@extends('layouts.app')

@section('content')
<div class="container" style="max-width:1200px; margin:0 auto;">

    {{-- Judul halaman --}}
    <div style="display:flex; justify-content:space-between; align-items:center; gap:15px; flex-wrap:wrap; margin-bottom:24px;">
        <div>
            <h1 style="margin:0 0 8px; color:#0b1f3a;">
                Pergerakan Stok
            </h1>
            <p style="margin:0; color:#64748b;">
                Catat dan pantau barang masuk serta barang keluar.
            </p>
        </div>

        <a href="{{ route('stock-movements.create') }}"
            style="padding:11px 18px; background:#0b1f3a; color:white; text-decoration:none; border-radius:7px;">
            + Tambah Pergerakan
        </a>
    </div>

    {{-- Pesan berhasil --}}
    @if (session('success'))
        <div style="padding:13px 16px; margin-bottom:18px; background:#d1fae5; color:#065f46; border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan kesalahan --}}
    @if ($errors->any())
        <div style="padding:13px 16px; margin-bottom:18px; background:#fee2e2; color:#991b1b; border-radius:8px;">
            <strong>Terjadi kesalahan:</strong>
            <ul style="margin-bottom:0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tabel pergerakan stok --}}
    <div style="background:white; padding:20px; border-radius:10px; box-shadow:0 2px 8px rgba(15,23,42,.06);">

        {{-- Form pencarian --}}
        <form action="{{ route('stock-movements.index') }}"
                method="GET"
                style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:20px;">

            <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau kode produk..."
                    style="flex:1; min-width:220px; padding:11px; border:1px solid #cbd5e1; border-radius:7px;">

            <select name="type"
                    style="padding:11px; border:1px solid #cbd5e1; border-radius:7px;">
                <option value="">Semua Jenis</option>
                <option value="in" {{ request('type') === 'in' ? 'selected' : '' }}>
                    Barang Masuk
                </option>
                <option value="out" {{ request('type') === 'out' ? 'selected' : '' }}>
                    Barang Keluar
                </option>
            </select>

            <button type="submit"
                    style="padding:11px 18px; background:#0b1f3a; color:white; border:none; border-radius:7px; cursor:pointer;">
                Cari
            </button>

            @if (request('search') || request('type'))
                <a href="{{ route('stock-movements.index') }}"
                    style="padding:11px 15px; background:#e2e8f0; color:#334155; text-decoration:none; border-radius:7px;">
                    Reset
                </a>
            @endif
        </form>

        <div style="overflow-x:auto;">
            <table style="width:100%; min-width:950px; border-collapse:collapse; font-size:14px;">

                <thead>
                    <tr style="background:#0b1f3a; color:white;">
                        <th style="padding:13px; text-align:left;">No.</th>
                        <th style="padding:13px; text-align:left;">Tanggal</th>
                        <th style="padding:13px; text-align:left;">Kode Produk</th>
                        <th style="padding:13px; text-align:left;">Nama Produk</th>
                        <th style="padding:13px; text-align:left;">Jenis</th>
                        <th style="padding:13px; text-align:right;">Jumlah</th>
                        <th style="padding:13px; text-align:left;">Supplier</th>
                        <th style="padding:13px; text-align:center;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($movements as $movement)
                        <tr style="border-bottom:1px solid #e2e8f0;">

                            <td style="padding:13px;">
                                {{ $movements->firstItem() + $loop->index }}
                            </td>

                            <td style="padding:13px; white-space:nowrap;">
                                {{ $movement->movement_date?->format('d-m-Y') ?? '-' }}
                            </td>

                            <td style="padding:13px;">
                                {{ $movement->product?->sku ?? '-' }}
                            </td>

                            <td style="padding:13px;">
                                {{ $movement->product?->name ?? '-' }}
                            </td>

                            <td style="padding:13px;">
                                @if ($movement->type === 'in')
                                    <span style="padding:5px 9px; background:#d1fae5; color:#065f46; border-radius:5px;">
                                        Barang Masuk
                                    </span>
                                @else
                                    <span style="padding:5px 9px; background:#fee2e2; color:#991b1b; border-radius:5px;">
                                        Barang Keluar
                                    </span>
                                @endif
                            </td>

                            <td style="padding:13px; text-align:right;">
                                {{ number_format($movement->quantity, 0, ',', '.') }}
                            </td>

                            <td style="padding:13px;">
                                {{ $movement->supplier?->name ?? '-' }}
                            </td>

                            <td style="padding:13px; text-align:center; white-space:nowrap;">

                                {{-- Tombol Detail --}}
                                <a href="{{ route('stock-movements.show', $movement) }}"
                                    style="display:inline-block; padding:7px 9px; margin:2px; background:#e0f2fe; color:#075985; text-decoration:none; border-radius:5px;">
                                    Detail
                                </a>

                                {{-- Tombol Edit --}}
                                <a href="{{ route('stock-movements.edit', $movement) }}"
                                    style="display:inline-block; padding:7px 9px; margin:2px; background:#fef3c7; color:#92400e; text-decoration:none; border-radius:5px;">
                                    Edit
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('stock-movements.destroy', $movement) }}"
                                        method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Yakin ingin menghapus pergerakan stok ini? Jumlah stok produk juga akan disesuaikan.');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            style="padding:7px 9px; margin:2px; background:#fee2e2; color:#991b1b; border:none; border-radius:5px; cursor:pointer;">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8"
                                style="padding:30px; text-align:center; color:#64748b;">
                                Belum ada riwayat pergerakan stok.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Navigasi halaman --}}
        <div style="margin-top:18px;">
            {{ $movements->links() }}
        </div>

    </div>
</div>
@endsection
