@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="container">
        <h1>Edit Kategori</h1>

        <p>Ubah informasi kategori barang di bawah ini.</p>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <strong>Periksa kembali data yang kamu masukkan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('categories.update', $category->id) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label for="name">Nama Kategori</label>
                <br>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    maxlength="100"
                    required
                    style="width: 100%; padding: 8px;"
                >
            </div>

            <div style="margin-bottom: 15px;">
                <label for="description">Deskripsi</label>
                <br>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    style="width: 100%; padding: 8px;"
                >{{ old('description', $category->description) }}</textarea>
            </div>

            <button type="submit">Simpan Perubahan</button>

            <a
                href="{{ route('categories.index') }}"
                style="margin-left: 10px;"
            >
                Kembali
            </a>
        </form>
    </div>
@endsection
