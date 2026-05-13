@extends('layouts.app')

@section('header-nav')
    <a href="{{ route('register') }}">register</a>
@endsection

@section('content')
<style>
    .auth-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 65px);
    }

    .auth-box {
        width: 400px;
        padding: 40px;
        background-color: #fff;
        border-radius: 4px;
    }

    .auth-box h2 {
        text-align: center;
        font-size: 22px;
        margin-bottom: 30px;
        color: #333;
    }

    .auth-group {
        margin-bottom: 20px;
    }

    .auth-group label {
        display: block;
        font-size: 14px;
        margin-bottom: 6px;
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

    .auth-submit {
        text-align: center;
        margin-top: 24px;
    }
</style>

<div class="auth-wrap">
    <div class="auth-box">
        <h2>Login</h2>

        <form action="/login" method="POST">
            @csrf

            <div class="auth-group">
                <label>メールアドレス</label>
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-group">
                <label>パスワード</label>
                <input type="password" name="password" placeholder="例: coachtech">
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="auth-submit">
                <button type="submit" class="btn btn-primary">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection
