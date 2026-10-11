@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 1100px; margin: 0 auto;">
    <div style="margin-bottom: 24px;">
        <h1 style="margin: 0 0 8px; color: #0b1f3a;">Tambah Supplier</h1>
        <p style="margin: 0; color: #64748b;">Masukkan informasi pemasok barang.</p>
    </div>

    @if ($errors->any())
        <div style="padding: 14px; margin-bottom: 20px; background: #fee2e2; color: #991b1b; border-radius: 8px;">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul style="margin-bottom: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="background: white; padding: 24px; border-radius: 12px; box-shadow: 0 2px 8px rgba(15,23,42,.06);">
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 18px;">
                <div>
                    <label for="code" style="display: block; margin-bottom: 8px; font-weight: 600;">Kode Supplier *</label>
                    <input id="code" name="code" type="text" value="{{ old('code') }}" required maxlength="30" placeholder="Contoh: SUP001"
                        style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 7px;">
                </div>

                <div>
                    <label for="name" style="display: block; margin-bottom: 8px; font-weight: 600;">Nama Supplier *</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="150" placeholder="Masukkan nama supplier"
                        style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 7px;">
                </div>

                <div>
                    <label for="phone" style="display: block; margin-bottom: 8px; font-weight: 600;">Telepon</label>
                    <input id="phone" name="phone" type="text" value="{{ old('phone') }}" maxlength="20" placeholder="Masukkan nomor telepon"
                        style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 7px;">
                </div>

                <div>
                    <label for="address" style="display: block; margin-bottom: 8px; font-weight: 600;">Alamat</label>
                    <textarea id="address" name="address" rows="3" placeholder="Masukkan alamat supplier"
                            style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 7px;">{{ old('address') }}</textarea>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
                <a href="{{ route('suppliers.index') }}"
                style="padding: 11px 18px; background: #e2e8f0; color: #334155; text-decoration: none; border-radius: 7px;">
                    Batal
                </a>
                <button type="submit"
                        style="padding: 11px 20px; background: #0b1f3a; color: white; border: none; border-radius: 7px; cursor: pointer;">
                    Simpan Supplier
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
