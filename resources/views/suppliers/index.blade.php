@extends('layouts.app')

@section('content')
<div class="container">
    <div style="margin-bottom: 24px;">
        <h1 style="margin: 0 0 8px; color: #0b1f3a;">Data Supplier</h1>
        <p style="margin: 0; color: #64748b;">
            Kelola kode, nama, telepon, dan alamat pemasok barang.
        </p>
    </div>

    @if (session('success'))
        <div style="padding: 13px 16px; margin-bottom: 18px; background: #d1fae5; color: #065f46; border-radius: 8px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="padding: 13px 16px; margin-bottom: 18px; background: #fee2e2; color: #991b1b; border-radius: 8px;">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul style="margin-bottom: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM TAMBAH SUPPLIER --}}
    <div style="background: white; padding: 22px; margin-bottom: 24px; border-radius: 10px; box-shadow: 0 2px 8px rgba(15,23,42,.06);">
        <h2 style="margin: 0 0 20px; font-size: 19px; color: #0b1f3a;">
            Form Supplier
        </h2>

        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px;">
                <div>
                    <label for="code" style="display: block; margin-bottom: 7px; font-weight: 600;">Kode Supplier *</label>
                    <input id="code" name="code" type="text" value="{{ old('code') }}" required maxlength="30" placeholder="Contoh: SUP001"
                        style="box-sizing: border-box; width: 100%; padding: 11px; border: 1px solid #cbd5e1; border-radius: 7px;">
                </div>

                <div>
                    <label for="name" style="display: block; margin-bottom: 7px; font-weight: 600;">Nama Supplier *</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="150" placeholder="Nama supplier"
                        style="box-sizing: border-box; width: 100%; padding: 11px; border: 1px solid #cbd5e1; border-radius: 7px;">
                </div>

                <div>
                    <label for="phone" style="display: block; margin-bottom: 7px; font-weight: 600;">Telepon</label>
                    <input id="phone" name="phone" type="text" value="{{ old('phone') }}" maxlength="20" placeholder="Nomor telepon"
                        style="box-sizing: border-box; width: 100%; padding: 11px; border: 1px solid #cbd5e1; border-radius: 7px;">
                </div>

                <div>
                    <label for="address" style="display: block; margin-bottom: 7px; font-weight: 600;">Alamat</label>
                    <textarea id="address" name="address" rows="1" placeholder="Alamat supplier"
                            style="box-sizing: border-box; width: 100%; padding: 11px; border: 1px solid #cbd5e1; border-radius: 7px;">{{ old('address') }}</textarea>
                </div>
            </div>

            <div style="margin-top: 18px; display: flex; justify-content: flex-end;">
                <button type="submit"
                        style="padding: 11px 20px; border: none; border-radius: 7px; background: #0b1f3a; color: white; font-weight: 600; cursor: pointer;">
                    + Simpan Supplier
                </button>
            </div>
        </form>
    </div>

    {{-- TABEL SUPPLIER --}}
    <div style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(15,23,42,.06);">
        <div style="padding: 18px 20px; border-bottom: 1px solid #e2e8f0;">
            <h2 style="margin: 0 0 15px; color: #0b1f3a; font-size: 19px;">
                Daftar Supplier
            </h2>

            <form action="{{ route('suppliers.index') }}" method="GET"
                style="display: flex; flex-wrap: wrap; gap: 10px;">
                <input type="text" name="search" value="{{ $search }}"
                    placeholder="Cari kode, nama, kontak, atau telepon..."
                    style="box-sizing: border-box; flex: 1; min-width: 220px; padding: 11px; border: 1px solid #cbd5e1; border-radius: 7px;">

                <button type="submit"
                        style="padding: 11px 18px; border: none; border-radius: 7px; background: #0b1f3a; color: white; cursor: pointer;">
                    Cari
                </button>

                @if ($search)
                    <a href="{{ route('suppliers.index') }}"
                    style="padding: 11px 15px; background: #e2e8f0; color: #334155; text-decoration: none; border-radius: 7px;">
                        Reset
                    </a>
                @endif
            </form>

            <p style="margin: 14px 0 0; color: #64748b; font-size: 13px;">
                Total supplier: {{ $suppliers->total() }}
            </p>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; min-width: 750px; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="background: #0b1f3a; color: white;">
                        <th style="padding: 13px 15px; text-align: left;">No.</th>
                        <th style="padding: 13px 15px; text-align: left;">Kode</th>
                        <th style="padding: 13px 15px; text-align: left;">Nama Supplier</th>
                        <th style="padding: 13px 15px; text-align: left;">Telepon</th>
                        <th style="padding: 13px 15px; text-align: left;">Alamat</th>
                        <th style="padding: 13px 15px; text-align: center;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($suppliers as $supplier)
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 13px 15px;">
                                {{ $suppliers->firstItem() + $loop->index }}
                            </td>
                            <td style="padding: 13px 15px; font-weight: 600;">
                                {{ $supplier->code ?: '-' }}
                            </td>
                            <td style="padding: 13px 15px;">
                                {{ $supplier->name }}
                            </td>
                            <td style="padding: 13px 15px;">
                                {{ $supplier->phone ?: '-' }}
                            </td>
                            <td style="padding: 13px 15px;">
                                {{ $supplier->address ?: '-' }}
                            </td>
                            <td style="padding: 13px 15px; text-align: center; white-space: nowrap;">
                                <a href="{{ route('suppliers.show', $supplier) }}"
                                style="display: inline-block; padding: 6px 9px; margin: 2px; background: #e0f2fe; color: #075985; text-decoration: none; border-radius: 5px;">
                                    Detail
                                </a>

                                <a href="{{ route('suppliers.edit', $supplier) }}"
                                style="display: inline-block; padding: 6px 9px; margin: 2px; background: #fef3c7; color: #92400e; text-decoration: none; border-radius: 5px;">
                                    Edit
                                </a>

                                <form action="{{ route('suppliers.destroy', $supplier) }}"
                                    method="POST" style="display: inline-block; margin: 2px;"
                                    onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            style="padding: 6px 9px; background: #fee2e2; color: #b91c1c; border: none; border-radius: 5px; cursor: pointer;">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 35px 15px; text-align: center; color: #64748b;">
                                Belum ada data supplier. Isi form di atas untuk menambahkan supplier pertama.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($suppliers->hasPages())
            <div style="padding: 18px 20px;">
                {{ $suppliers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
