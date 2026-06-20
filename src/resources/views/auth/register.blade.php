@extends('layouts.app')

@section('header-nav')
    <a href="{{ route('login') }}">ログイン</a>
@endsection

@section('content')
<style>
    .auth-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 65px);
        padding: 40px 20px;
    }

    .auth-box {
        width: 100%;
        max-width: 480px;
        padding: 48px 40px;
        background-color: #fff;
        border-radius: 4px;
    }

    .auth-box h2 {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 36px;
        color: #333;
    }

    .auth-group {
        margin-bottom: 24px;
    }

    .auth-group label {
        display: block;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #333;
    }

    .auth-group input {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 14px;
        background-color: #f5f0eb;
    }

    .auth-group input:focus {
        outline: none;
        border-color: #7d6d5e;
    }

    .auth-submit {
        text-align: center;
        margin-top: 32px;
    }

    .auth-submit .btn {
        width: 100%;
        padding: 12px;
        font-size: 16px;
    }

    .auth-link {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
    }

    .auth-link a {
        color: #7d6d5e;
        text-decoration: none;
    }

    .auth-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="auth-wrap">
    <div class="auth-box">
        <h2>会員登録</h2>

        <form action="/register" method="POST">
            @csrf

            <div class="auth-group">
                <label for="name">ユーザー名</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="例: 山田 太郎"
                    value="{{ old('name') }}"
                >
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-group">
                <label for="email">メールアドレス</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="例: test@example.com"
                    value="{{ old('email') }}"
                >
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-group">
                <label for="password">パスワード</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="8文字以上で入力してください"
                >
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-group">
                <label for="password_confirmation">確認用パスワード</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="パスワードを再入力してください"
                >
                @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-submit">
                <button type="submit" class="btn btn-primary">登録する</button>
            </div>
        </form>

        <div class="auth-link">
            <a href="{{ route('login') }}">ログインはこちら</a>
        </div>
    </div>
</div>
@endsection
