<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
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
            background-color: #fff;
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e0d6cb;
        }

        header h1 {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            letter-spacing: 1px;
        }

        header nav {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        header nav a {
            font-size: 14px;
            color: #555;
            text-decoration: none;
            border: 1px solid #555;
            padding: 6px 16px;
            border-radius: 3px;
        }

        header nav a:hover {
            background-color: #555;
            color: #fff;
        }

        header nav form button {
            font-size: 14px;
            color: #555;
            text-decoration: none;
            border: 1px solid #555;
            padding: 6px 16px;
            border-radius: 3px;
            background: none;
            cursor: pointer;
        }

        header nav form button:hover {
            background-color: #555;
            color: #fff;
        }

        main {
            min-height: calc(100vh - 65px);
        }

        .btn {
            display: inline-block;
            padding: 10px 40px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background-color: #7d6d5e;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #6a5c4e;
        }

        .btn-danger {
            background-color: #c0392b;
            color: #fff;
        }

        .btn-secondary {
            background-color: #fff;
            color: #333;
            border: 1px solid #ccc;
        }

        .error-message {
            color: #c0392b;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <header>
        <h1>coachtechフリマ</h1>
        <nav>
            @yield('header-nav')
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
