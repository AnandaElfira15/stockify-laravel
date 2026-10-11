@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 900px; margin: 0 auto;">
    <div style="margin-bottom: 24px;">
        <h1 style="margin: 0 0 8px; color: #0b1f3a;">Detail Supplier</h1>
        <p style="margin: 0; color: #64748b;">Informasi lengkap pemasok barang.</p>
    </div>

    <div style="background: white; padding: 24px; border-radius: 10px; box-shadow: 0 2px 8px rgba(15,23,42,.06);">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <th style="padding: 13px; width: 35%; text-align: left; border-bottom: 1px solid #e2e8f0;">Kode Supplier</th>
                <td style="padding: 13px; border-bottom: 1px solid #e2e8f0;">{{ $supplier->code ?: '-' }}</td>
            </tr>
            <tr>
                <th style="padding: 13px; text-align: left; border-bottom: 1px solid #e2e8f0;">Nama Supplier</th>
                <td style="padding: 13px; border-bottom: 1px solid #e2e8f0;">{{ $supplier->name }}</td>
            </tr>
            <tr>
                <th style="padding: 13px; text-align: left; border-bottom: 1px solid #e2e8f0;">Telepon</th>
                <td style="padding: 13px; border-bottom: 1px solid #e2e8f0;">{{ $supplier->phone ?: '-' }}</td>
            </tr>
            <tr>
                <th style="padding: 13px; text-align: left; border-bottom: 1px solid #e2e8f0;">Alamat</th>
                <td style="padding: 13px; border-bottom: 1px solid #e2e8f0; white-space: pre-line;">{{ $supplier->address ?: '-' }}</td>
            </tr>
        </table>

        <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 22px;">
            <a href="{{ route('suppliers.index') }}"
            style="padding: 10px 16px; background: #e2e8f0; color: #334155; text-decoration: none; border-radius: 7px;">
                Kembali
            </a>
            <a href="{{ route('suppliers.edit', $supplier) }}"
            style="padding: 10px 16px; background: #0b1f3a; color: white; text-decoration: none; border-radius: 7px;">
                Edit Supplier
            </a>
        </div>
    </div>
</div>
@endsection
