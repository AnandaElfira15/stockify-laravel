<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Stockify Inventory')</title>

    <style>
        * { box-sizing: border-box; }

        :root {
            --navy: #0b1f3a;
            --navy-light: #183657;
            --background: #f4f6f9;
            --text: #263445;
            --border: #e6eaf0;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            min-width: 250px;
            min-height: 100vh;
            background: var(--navy);
            color: white;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
        }

        .brand {
            font-size: 21px;
            font-weight: bold;
            padding: 0 10px 20px;
            border-bottom: 1px solid #29415f;
        }

        .user-info {
            padding: 15px 10px;
            border-bottom: 1px solid #29415f;
            overflow-wrap: anywhere;
        }

        .user-name {
            font-size: 14px;
            font-weight: bold;
            color: white;
        }

        .user-role {
            display: inline-block;
            margin-top: 7px;
            padding: 4px 8px;
            border-radius: 20px;
            background: #243b5a;
            color: #dbeafe;
            font-size: 11px;
            text-transform: uppercase;
        }

        .sidebar-label {
            color: #a9b9cc;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 24px 12px 10px;
        }

        .sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar a {
            display: block;
            color: #e5edf7;
            text-decoration: none;
            padding: 12px;
            border-radius: 7px;
            font-size: 14px;
            transition: background 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #243b5a;
            color: white;
        }

        .sidebar a.active {
            font-weight: bold;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 20px 10px 0;
            color: #a9b9cc;
            font-size: 12px;
        }

        .logout-form {
            margin-top: 12px;
        }

        .logout-button {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #49617f;
            border-radius: 7px;
            background: transparent;
            color: white;
            text-align: left;
            font-size: 13px;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #243b5a;
        }

        .main-area {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            min-height: 72px;
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 18px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .topbar-title {
            color: var(--navy);
            font-size: 17px;
            font-weight: bold;
        }

        .topbar-subtitle {
            color: #718096;
            font-size: 12px;
            margin-top: 5px;
        }

        .container {
            width: 100%;
            max-width: 1400px;
            margin: 28px auto;
            padding: 0 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 22px;
        }

        h1 {
            margin: 0 0 15px;
            font-size: 27px;
        }

        h2, h3 { color: var(--navy); }

        .card {
            background: white;
            padding: 22px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            background: var(--navy);
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn:hover { background: var(--navy-light); }

        .btn-light {
            background: #e8edf4;
            color: var(--navy);
        }

        .btn-danger {
            background: #c0392b;
            color: white;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccd3dd;
            border-radius: 6px;
            margin-top: 6px;
            font-size: 14px;
        }

        .form-control:focus {
            outline: 2px solid #b6c9e3;
            border-color: var(--navy);
        }

        .form-group { margin-bottom: 17px; }

        label {
            font-weight: bold;
            font-size: 14px;
        }

        input:not([type="checkbox"]):not([type="radio"]),
        select, textarea {
            max-width: 100%;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 12px;
            align-items: end;
        }

        .table-wrapper {
            overflow-x: auto;
            background: white;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 13px 12px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        th {
            background: #f7f9fc;
            color: var(--navy);
        }

        tbody tr:hover { background: #fafbfd; }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            background: #e8edf4;
            font-size: 12px;
        }

        .badge-low {
            background: #fde8e7;
            color: #b42318;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #e3f7e9;
            color: #176b35;
        }

        .alert-error {
            background: #fde8e7;
            color: #b42318;
        }

        .alert ul { margin-bottom: 0; }

        .actions {
            display: flex;
            gap: 7px;
            align-items: center;
            flex-wrap: wrap;
        }

        .actions form { margin: 0; }

        .pagination { margin-top: 20px; }

        .pagination nav > div:first-child {
            margin-bottom: 10px;
        }

        input, select, textarea, button { font-family: inherit; }

        @media (max-width: 850px) {
            .sidebar {
                width: 205px;
                min-width: 205px;
                padding: 20px 10px;
            }

            .container { padding: 0 18px; }

            .topbar { padding: 16px 20px; }

            .filter-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 600px) {
            .app-layout { flex-direction: column; }

            .sidebar {
                width: 100%;
                min-width: 0;
                min-height: auto;
                padding: 15px;
            }

            .brand { padding: 0 5px 15px; }

            .sidebar-label { padding: 15px 5px 8px; }

            .sidebar nav {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 5px;
            }

            .sidebar a {
                padding: 10px;
                font-size: 13px;
            }

            .sidebar-footer {
                margin-top: 15px;
                padding: 10px 5px 0;
            }

            .topbar {
                min-height: auto;
                padding: 15px;
            }

            .container {
                margin-top: 20px;
                padding: 0 12px;
            }

            .filter-grid { grid-template-columns: 1fr; }

            h1 { font-size: 23px; }

            .card { padding: 15px; }
        }
    </style>
</head>

<body>
<div class="app-layout">

    <aside class="sidebar">
        <div class="brand">Stockify Inventory</div>

        @auth
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <span class="user-role">
                    {{ ucfirst(auth()->user()->role) }}
                </span>
            </div>
        @endauth

        <div class="sidebar-label">Menu Utama</div>

        <nav>
            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('products.index') }}"
               class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                Produk
            </a>

            <a href="{{ route('categories.index') }}"
               class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                Kategori
            </a>

            <a href="{{ route('suppliers.index') }}"
               class="{{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                Supplier
            </a>

            <a href="{{ route('stock-movements.index') }}"
               class="{{ request()->routeIs('stock-movements.*') ? 'active' : '' }}">
                Pergerakan Stok
            </a>

            <a href="{{ route('reports.index') }}"
               class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
                Laporan
            </a>

            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('users.index') }}"
                       class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                        Manajemen Pengguna
                    </a>
                @endif
            @endauth
        </nav>

        <div class="sidebar-footer">
            Stockify Inventory<br>
            Sistem Manajemen Persediaan

            @auth
                <form action="{{ route('logout') }}" method="POST"
                      class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </aside>

    <div class="main-area">
        <header class="topbar">
            <div>
                <div class="topbar-title">
                    @yield('title', 'Dashboard Inventaris')
                </div>

                <div class="topbar-subtitle">
                    Sistem Informasi Persediaan Barang
                </div>
            </div>
        </header>

        <main class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Data belum berhasil disimpan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</div>
</body>
</html>
