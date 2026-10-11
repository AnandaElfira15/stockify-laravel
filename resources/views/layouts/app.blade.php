
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Stockify Inventory')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #263445;
        }

        .navbar {
            background: #0b1f3a;
            color: white;
            padding: 18px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
        }

        .navbar nav {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 9px 12px;
            border-radius: 6px;
            font-size: 14px;
        }

        .navbar a:hover,
        .navbar a.active {
            background: #243b5a;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
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

        h2, h3 {
            color: #0b1f3a;
        }

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
            background: #0b1f3a;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn:hover {
            background: #183657;
        }

        .btn-light {
            background: #e8edf4;
            color: #0b1f3a;
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
            border-color: #0b1f3a;
        }

        .form-group {
            margin-bottom: 17px;
        }

        label {
            font-weight: bold;
            font-size: 14px;
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
            border-bottom: 1px solid #e6eaf0;
            vertical-align: middle;
        }

        th {
            background: #f7f9fc;
            color: #0b1f3a;
        }

        tbody tr:hover {
            background: #fafbfd;
        }

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

        .actions {
            display: flex;
            gap: 7px;
            align-items: center;
            flex-wrap: wrap;
        }

        .actions form {
            margin: 0;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination nav > div:first-child {
            margin-bottom: 10px;
        }

        input, select, textarea, button {
            font-family: inherit;
        }

        @media (max-width: 850px) {
            .filter-grid {
                grid-template-columns: 1fr 1fr;
            }

            .container {
                margin-top: 20px;
            }
        }

        @media (max-width: 600px) {
            .navbar {
                align-items: flex-start;
                padding: 16px 5%;
            }

            .navbar nav {
                width: 100%;
            }

            .navbar a {
                margin: 0;
                padding: 8px;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 0 12px;
            }

            h1 {
                font-size: 23px;
            }

            .card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

    <header class="navbar">
        <div class="brand">Stockify Inventory</div>

        <nav>
            <a
                href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >
                Dashboard
            </a>

            <a
                href="{{ route('products.index') }}"
                class="{{ request()->routeIs('products.*') ? 'active' : '' }}"
            >
                Produk
            </a>

            <a
                href="{{ route('categories.index') }}"
                class="{{ request()->routeIs('categories.*') ? 'active' : '' }}"
            >
                Kategori
            </a>

            <a
                href="{{ route('suppliers.index') }}"
                class="{{ request()->routeIs('suppliers.*') ? 'active' : '' }}"
            >
                Supplier
            </a>

            <a
                href="{{ route('stock-movements.index') }}"
                class="{{ request()->routeIs('stock-movements.*') ? 'active' : '' }}"
            >
                Pergerakan Stok
            </a>

            <a
                href="{{ route('reports.index') }}"
                class="{{ request()->routeIs('reports.*') ? 'active' : '' }}"
            >
                Laporan
            </a>
        </nav>
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

</body>
</html>
