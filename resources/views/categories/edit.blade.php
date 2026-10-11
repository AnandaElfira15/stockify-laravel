@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="container">
        <h1>Daftar Kategori</h1>

        <p>Halaman untuk melihat dan mengelola kategori barang.</p>

        <a href="{{ route('categories.create') }}">
            + Tambah Kategori
        </a>

        <br><br>

        {{-- Form pencarian kategori --}}
        <form action="{{ route('categories.index') }}" method="GET">
            <input
                type="text"
                name="search"
                placeholder="Cari nama kategori..."
                value="{{ $search ?? '' }}"
            >

            <button type="submit">Cari</button>

            <a href="{{ route('categories.index') }}">Reset</a>
        </form>

        <br>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        {{-- Tabel kategori --}}
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>
                            {{ $categories->firstItem() + $loop->index }}
                        </td>

                        <td>{{ $category->name }}</td>

                        <td>{{ $category->description ?? '-' }}</td>

                        <td>{{ $category->products_count }}</td>

                        <td>
                            <a href="{{ route('categories.show', $category->id) }}">
                                Detail
                            </a>

                            |

                            <a href="{{ route('categories.edit', $category->id) }}">
                                Edit
                            </a>

                            |

                            <form
                                action="{{ route('categories.destroy', $category->id) }}"
                                method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            Kategori tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <br>

        {{-- Navigasi halaman --}}
        {{ $categories->links() }}
    </div>
@endsection
