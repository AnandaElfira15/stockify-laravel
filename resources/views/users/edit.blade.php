@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1>Edit Pengguna</h1>
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
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name"
                value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email"
                value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required
                {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                <option value="staff"
                    {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>
                    Staff
                </option>
                <option value="admin"
                    {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
            </select>

            @if ($user->id === auth()->id())
                <p>Akun yang sedang digunakan tetap memiliki role Admin.</p>
                <input type="hidden" name="role" value="admin">
            @endif
        </div>

        <div class="form-group">
            <label for="password">Password Baru (opsional)</label>
            <input type="password" id="password" name="password"
                minlength="8">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" id="password_confirmation"
                name="password_confirmation" minlength="8">
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
