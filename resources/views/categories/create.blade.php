@extends('layouts.app')

@section('title', 'Tambah Kategori - Stockify')

@section('content')
<div class="page-header">
    <h1>Tambah Kategori</h1>
    <a href="{{ route('categories.index') }}" class="btn btn-light">Kembali</a>
</div>

<div class="card">
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama Kategori *</label>
            <input type="text" name="name" id="name"
                class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description"
                    class="form-control" rows="4">{{ old('description') }}</textarea>
            @error('description')
                <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn">Simpan Kategori</button>
        <a href="{{ route('categories.index') }}" class="btn btn-light">Batal</a>
    </form>
</div>
@endsection
