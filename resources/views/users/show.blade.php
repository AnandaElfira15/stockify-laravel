@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1>Detail Pengguna</h1>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

<div class="card">
    <table>
        <tbody>
            <tr>
                <th style="width: 180px;">ID</th>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{ ucfirst($user->role) }}</td>
            </tr>
            <tr>
                <th>Dibuat</th>
                <td>{{ $user->created_at?->format('d-m-Y H:i') }}</td>
            </tr>
            <tr>
                <th>Diperbarui</th>
                <td>{{ $user->updated_at?->format('d-m-Y H:i') }}</td>
            </tr>
        </tbody>
    </table>

    <p>
        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">
            Edit Pengguna
        </a>
    </p>
</div>
@endsection
