@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1>Tambah Pengguna</h1>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="card">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name"
                value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email"
                value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>
                    Staff
                </option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                minlength="8" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation"
                name="password_confirmation" minlength="8" required>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Pengguna
        </button>
    </form>
</div>
@endsection
