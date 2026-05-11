@extends('layouts.app')

@section('content')
<style>
    .contact-wrap {
        max-width: 600px;
        margin: 40px auto;
        padding: 40px;
        background-color: #fff;
        border-radius: 4px;
    }

    .contact-wrap h2 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 30px;
        color: #333;
    }

    .form-group {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        gap: 20px;
    }

    .form-label {
        width: 160px;
        flex-shrink: 0;
        font-size: 14px;
        padding-top: 8px;
    }

    .form-label .required {
        color: #c0392b;
        margin-left: 4px;
    }

    .form-inputs {
        flex: 1;
    }

    .form-inputs input[type="text"],
    .form-inputs input[type="email"],
    .form-inputs textarea,
    .form-inputs select {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 14px;
        background-color: #f5f0eb;
    }

    .form-inputs textarea {
        height: 100px;
        resize: vertical;
    }

    .form-inputs select {
        appearance: auto;
    }

    .tel-group {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .tel-group input {
        width: 80px;
    }

    .tel-group span {
        color: #666;
    }

    .gender-group {
        display: flex;
        gap: 20px;
        align-items: center;
        padding-top: 4px;
    }

    .gender-group label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        cursor: pointer;
    }

    .form-submit {
        text-align: center;
        margin-top: 30px;
    }
</style>

<div class="contact-wrap">
    <h2>Contact</h2>

    <form action="{{ route('contact.confirm') }}" method="POST">
        @csrf

        {{-- お名前 --}}
        <div class="form-group">
            <div class="form-label">
                お名前<span class="required">*</span>
            </div>
            <div class="form-inputs">
                <div style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <input type="text" name="first_name" placeholder="姓" value="{{ old('first_name', $input['first_name'] ?? '') }}">
                        @error('first_name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    <div style="flex:1;">
                        <input type="text" name="last_name" placeholder="名" value="{{ old('last_name', $input['last_name'] ?? '') }}">
                        @error('last_name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- 性別 --}}
        <div class="form-group">
            <div class="form-label">
                性別<span class="required">*</span>
            </div>
            <div class="form-inputs">
                <div class="gender-group">
                    <label>
                        <input type="radio" name="gender" value="1"
                            {{ old('gender', $input['gender'] ?? '') == '1' ? 'checked' : '' }}>
                        男性
                    </label>
                    <label>
                        <input type="radio" name="gender" value="2"
                            {{ old('gender', $input['gender'] ?? '') == '2' ? 'checked' : '' }}>
                        女性
                    </label>
                    <label>
                        <input type="radio" name="gender" value="3"
                            {{ old('gender', $input['gender'] ?? '') == '3' ? 'checked' : '' }}>
                        その他
                    </label>
                </div>
                @error('gender')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- メールアドレス --}}
        <div class="form-group">
            <div class="form-label">
                メールアドレス<span class="required">*</span>
            </div>
            <div class="form-inputs">
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email', $input['email'] ?? '') }}">
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- 電話番号 --}}
        <div class="form-group">
            <div class="form-label">
                電話番号<span class="required">*</span>
            </div>
            <div class="form-inputs">
                <div class="tel-group">
                    <input type="text" name="tel_1" placeholder="080" maxlength="5" value="{{ old('tel_1', $input['tel_1'] ?? '') }}" style="width:70px;">
                    <span>-</span>
                    <input type="text" name="tel_2" placeholder="1234" maxlength="5" value="{{ old('tel_2', $input['tel_2'] ?? '') }}" style="width:80px;">
                    <span>-</span>
                    <input type="text" name="tel_3" placeholder="5678" maxlength="5" value="{{ old('tel_3', $input['tel_3'] ?? '') }}" style="width:80px;">
                </div>
                @error('tel_1')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                @error('tel_2')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                @error('tel_3')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- 住所 --}}
        <div class="form-group">
            <div class="form-label">
                住所<span class="required">*</span>
            </div>
            <div class="form-inputs">
                <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', $input['address'] ?? '') }}">
                @error('address')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- 建物名 --}}
        <div class="form-group">
            <div class="form-label">
                建物名
            </div>
            <div class="form-inputs">
                <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building', $input['building'] ?? '') }}">
            </div>
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="form-group">
            <div class="form-label">
                お問い合わせの種類<span class="required">*</span>
            </div>
            <div class="form-inputs">
                <select name="category_id">
                    <option value="">選択してください</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $input['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="form-group">
            <div class="form-label">
                お問い合わせ内容<span class="required">*</span>
            </div>
            <div class="form-inputs">
                <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $input['detail'] ?? '') }}</textarea>
                @error('detail')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-submit">
            <button type="submit" class="btn btn-primary">確認画面</button>
        </div>
    </form>
</div>
@endsection
