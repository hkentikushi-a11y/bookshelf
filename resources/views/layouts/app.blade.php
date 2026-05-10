<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f0eb;
            color: #333;
        }

        header {
            background-color: #1a1a1a;
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            color: #fff;
            font-size: 20px;
            font-weight: 300;
            letter-spacing: 2px;
            text-decoration: none;
        }

        header .header-nav a {
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            padding: 6px 16px;
            border: 1px solid #fff;
            transition: all 0.2s;
        }

        header .header-nav a:hover {
            background-color: #fff;
            color: #1a1a1a;
        }

        main {
            min-height: calc(100vh - 60px);
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        h2 {
            text-align: center;
            font-size: 22px;
            font-weight: 400;
            letter-spacing: 2px;
            margin-bottom: 32px;
            color: #444;
        }

        .form-card {
            background: #fff;
            border-radius: 2px;
            padding: 40px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }

        .form-group {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            gap: 20px;
        }

        .form-label {
            width: 180px;
            min-width: 180px;
            font-size: 14px;
            padding-top: 10px;
            color: #555;
        }

        .form-label .required {
            color: #e53e3e;
            font-size: 11px;
            margin-left: 4px;
        }

        .form-control {
            flex: 1;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea,
        select {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #d5cec7;
            border-radius: 2px;
            font-size: 14px;
            background-color: #faf9f7;
            outline: none;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        textarea:focus,
        select:focus {
            border-color: #8b7355;
        }

        .input-row {
            display: flex;
            gap: 8px;
        }

        .input-row input {
            width: auto;
            flex: 1;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            padding-top: 8px;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            cursor: pointer;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn {
            display: block;
            width: 200px;
            margin: 30px auto 0;
            padding: 12px;
            background-color: #6b5b45;
            color: #fff;
            border: none;
            border-radius: 2px;
            font-size: 14px;
            letter-spacing: 1px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: #5a4a38;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid #6b5b45;
            color: #6b5b45;
        }

        .btn-outline:hover {
            background-color: #6b5b45;
            color: #fff;
        }

        .btn-danger {
            background-color: #c0392b;
        }

        .btn-danger:hover {
            background-color: #a93226;
        }

        .error-message {
            color: #e53e3e;
            font-size: 12px;
            margin-top: 4px;
        }

        .btn-group {
            display: flex;
            gap: 16px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn-group .btn {
            margin: 0;
        }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <a href="{{ route('contact') }}" class="logo">FashionablyLate</a>
        <nav class="header-nav">
            @yield('header-nav')
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>
