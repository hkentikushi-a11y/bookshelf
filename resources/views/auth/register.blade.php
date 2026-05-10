@extends('layouts.app')

@section('header-nav')
    <a href="{{ route('login') }}">login</a>
@endsection

@section('content')
<div class="container" style="max-width:500px;">
    <h2>Register</h2>
    <div class="form-card">
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:13px; color:#666; margin-bottom:6px;">お名前</label>
                <input type="text" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}">
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:13px; color:#666; margin-bottom:6px;">メールアドレス</label>
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:13px; color:#666; margin-bottom:6px;">パスワード</label>
                <input type="password" name="password" placeholder="パスワード">
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">登録</button>
        </form>
    </div>
</div>
@endsection
