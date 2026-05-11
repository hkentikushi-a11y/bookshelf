@extends('layouts.app')

@section('content')
<style>
    .confirm-wrap {
        max-width: 600px;
        margin: 40px auto;
        padding: 40px;
        background-color: #fff;
        border-radius: 4px;
    }

    .confirm-wrap h2 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 30px;
        color: #333;
    }

    .confirm-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }

    .confirm-table th {
        background-color: #7d6d5e;
        color: #fff;
        padding: 14px 20px;
        text-align: left;
        font-size: 14px;
        font-weight: normal;
        width: 180px;
    }

    .confirm-table td {
        padding: 14px 20px;
        font-size: 14px;
        border-bottom: 1px solid #e0d6cb;
        background-color: #faf7f4;
    }

    .confirm-actions {
        display: flex;
        justify-content: center;
        gap: 20px;
    }
</style>

<div class="confirm-wrap">
    <h2>Confirm</h2>

    <table class="confirm-table">
        <tr>
            <th>お名前</th>
            <td>{{ $input['first_name'] }} {{ $input['last_name'] }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>
                @if ($input['gender'] == 1) 男性
                @elseif ($input['gender'] == 2) 女性
                @else その他
                @endif
            </td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $input['email'] }}</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>{{ $input['tel'] }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $input['address'] }}</td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>{{ $input['building'] ?? '' }}</td>
        </tr>
        <tr>
            <th>お問い合わせの種類</th>
            <td>{{ $category->content }}</td>
        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td>{{ $input['detail'] }}</td>
        </tr>
    </table>

    <div class="confirm-actions">
        {{-- 送信フォーム --}}
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <input type="hidden" name="category_id" value="{{ $input['category_id'] }}">
            <input type="hidden" name="first_name" value="{{ $input['first_name'] }}">
            <input type="hidden" name="last_name" value="{{ $input['last_name'] }}">
            <input type="hidden" name="gender" value="{{ $input['gender'] }}">
            <input type="hidden" name="email" value="{{ $input['email'] }}">
            <input type="hidden" name="tel" value="{{ $input['tel'] }}">
            <input type="hidden" name="address" value="{{ $input['address'] }}">
            <input type="hidden" name="building" value="{{ $input['building'] ?? '' }}">
            <input type="hidden" name="detail" value="{{ $input['detail'] }}">
            <button type="submit" class="btn btn-primary">送信</button>
        </form>

        {{-- 修正フォーム --}}
        <form action="{{ route('contact.back') }}" method="POST">
            @csrf
            <input type="hidden" name="category_id" value="{{ $input['category_id'] }}">
            <input type="hidden" name="first_name" value="{{ $input['first_name'] }}">
            <input type="hidden" name="last_name" value="{{ $input['last_name'] }}">
            <input type="hidden" name="gender" value="{{ $input['gender'] }}">
            <input type="hidden" name="email" value="{{ $input['email'] }}">
            <input type="hidden" name="tel_1" value="{{ $input['tel_1'] }}">
            <input type="hidden" name="tel_2" value="{{ $input['tel_2'] }}">
            <input type="hidden" name="tel_3" value="{{ $input['tel_3'] }}">
            <input type="hidden" name="address" value="{{ $input['address'] }}">
            <input type="hidden" name="building" value="{{ $input['building'] ?? '' }}">
            <input type="hidden" name="detail" value="{{ $input['detail'] }}">
            <button type="submit" class="btn btn-secondary">修正</button>
        </form>
    </div>
</div>
@endsection
