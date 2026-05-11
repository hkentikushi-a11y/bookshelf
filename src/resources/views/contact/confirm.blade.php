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
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            @foreach ($input as $key => $value)
                @if ($key === 'tel')
                    <input type="hidden" name="tel" value="{{ $value }}">
                @else
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach
            <button type="submit" class="btn btn-primary">送信</button>
        </form>

        <form action="{{ route('contact.back') }}" method="POST">
            @csrf
            @foreach ($input as $key => $value)
                @if ($key === 'tel')
                    @php
                        $telParts = str_split($value, strlen($value) > 10 ? (strlen($value) - 8) : 3);
                    @endphp
                @else
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach
            {{-- tel を3分割して渡す --}}
            @php
                $tel = $input['tel'];
                $tel1 = substr($tel, 0, 3);
                $tel2 = substr($tel, 3, 4);
                $tel3 = substr($tel, 7);
            @endphp
            <input type="hidden" name="tel_1" value="{{ $tel1 }}">
            <input type="hidden" name="tel_2" value="{{ $tel2 }}">
            <input type="hidden" name="tel_3" value="{{ $tel3 }}">
            <button type="submit" class="btn btn-secondary">修正</button>
        </form>
    </div>
</div>
@endsection
