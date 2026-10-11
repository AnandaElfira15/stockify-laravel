@extends('layouts.app')

@section('content')
<div class="container">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Data Kategori</h2>

        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            + Tambah Kategori
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin-bottom: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; background: white;">
            <thead>
                <tr style="background: #0B1F3A; color: white;">
                    <th style="padding: 12px; text-align: left;">No.</th>
                    <th style="padding: 12px; text-align: left;">Nama Kategori</th>
                    <th style="padding: 12px; text-align: left;">Deskripsi</th>
                    <th style="padding: 12px; text-align: center;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($categories as $category)
                    <tr style="border-bottom: 1px solid #ddd;">

                        <td style="padding: 12px;">
                            {{ $categories->firstItem() + $loop->index }}
                        </td>

                        <td style="padding: 12px;">
                            {{ $category->name }}
                        </td>

                        <td style="padding: 12px;">
                            {{ $category->description ?? '-' }}
                        </td>

                        <td style="padding: 12px;">
                            <div style="display: flex; justify-content: center; align-items: center; gap: 8px;">

                                <a href="{{ route('categories.show', $category->id) }}"
                                    class="btn btn-info">
                                    Detail
                                </a>

                                <a href="{{ route('categories.edit', $category->id) }}"
                                    class="btn btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}"
                                        method="POST"
                                        style="margin: 0;"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 20px; text-align: center;">
                            Belum ada data kategori.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (method_exists($categories, 'links'))
        <div style="margin-top: 20px;">
            {{ $categories->links() }}
        </div>
    @endif

</div>
@endsection
