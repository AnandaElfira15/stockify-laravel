<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Stockify</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f1f5f9;
            font-family: Arial, sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 32px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin: 0 0 8px;
            color: #0b1f3a;
            text-align: center;
        }

        .subtitle {
            margin-bottom: 26px;
            color: #64748b;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 17px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 7px;
            background: #0b1f3a;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #17365d;
        }

        .error {
            padding: 10px;
            margin-bottom: 16px;
            border-radius: 7px;
            background: #fee2e2;
            color: #991b1b;
        }

        .success {
            padding: 10px;
            margin-bottom: 16px;
            border-radius: 7px;
            background: #dcfce7;
            color: #166534;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h1>Stockify</h1>
        <p class="subtitle">Sistem Manajemen Persediaan</p>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan email"
                required
                autofocus
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <label class="remember">
                <input type="checkbox" name="remember" value="1">
                Ingat saya
            </label>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
