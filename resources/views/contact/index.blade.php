@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Contact</h2>
    <div class="form-card">
        <form action="{{ route('contact.confirm') }}" method="POST">
            @csrf

            <div class="form-group">
                <div class="form-label">お名前<span class="required">*</span></div>
                <div class="form-control">
                    <div class="input-row">
                        <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                        <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                    </div>
                    @error('last_name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    @error('first_name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">性別<span class="required">*</span></div>
                <div class="form-control">
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
                            男性
                        </label>
                        <label>
                            <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                            女性
                        </label>
                        <label>
                            <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
                            その他
                        </label>
                    </div>
                    @error('gender')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">メールアドレス<span class="required">*</span></div>
                <div class="form-control">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">電話番号<span class="required">*</span></div>
                <div class="form-control">
                    <div class="input-row">
                        <input type="text" name="tel_1" placeholder="080" value="{{ old('tel_1') }}" style="max-width:80px">
                        <span style="padding-top:10px">-</span>
                        <input type="text" name="tel_2" placeholder="1234" value="{{ old('tel_2') }}" style="max-width:90px">
                        <span style="padding-top:10px">-</span>
                        <input type="text" name="tel_3" placeholder="5678" value="{{ old('tel_3') }}" style="max-width:90px">
                    </div>
                    @if ($errors->has('tel_1') || $errors->has('tel_2') || $errors->has('tel_3'))
                        <p class="error-message">
                            {{ $errors->first('tel_1') ?: ($errors->first('tel_2') ?: $errors->first('tel_3')) }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">住所<span class="required">*</span></div>
                <div class="form-control">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                    @error('address')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">建物名</div>
                <div class="form-control">
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">お問い合わせの種類<span class="required">*</span></div>
                <div class="form-control">
                    <select name="category_id">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">お問い合わせ内容<span class="required">*</span></div>
                <div class="form-control">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                    @error('detail')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn">確認画面</button>
        </form>
    </div>
</div>
@endsection
