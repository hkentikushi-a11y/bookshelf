@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Confirm</h2>
    <div class="form-card">
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

            <table class="confirm-table">
                <tr>
                    <th>お名前</th>
                    <td>{{ $input['last_name'] }} {{ $input['first_name'] }}</td>
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
                    <td>{{ str_replace('-', '', $input['tel']) }}</td>
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

            <div class="btn-group">
                <button type="button" class="btn btn-outline" id="back-btn">修正</button>
                <button type="submit" class="btn">送信</button>
            </div>
        </form>

        <form id="back-form" action="{{ route('contact.back') }}" method="POST" style="display:none;">
            @csrf
            <input type="hidden" name="category_id" value="{{ $input['category_id'] }}">
            <input type="hidden" name="first_name" value="{{ $input['first_name'] }}">
            <input type="hidden" name="last_name" value="{{ $input['last_name'] }}">
            <input type="hidden" name="gender" value="{{ $input['gender'] }}">
            <input type="hidden" name="email" value="{{ $input['email'] }}">
            <input type="hidden" name="tel_1" value="{{ explode('-', $input['tel'])[0] ?? '' }}">
            <input type="hidden" name="tel_2" value="{{ explode('-', $input['tel'])[1] ?? '' }}">
            <input type="hidden" name="tel_3" value="{{ explode('-', $input['tel'])[2] ?? '' }}">
            <input type="hidden" name="address" value="{{ $input['address'] }}">
            <input type="hidden" name="building" value="{{ $input['building'] ?? '' }}">
            <input type="hidden" name="detail" value="{{ $input['detail'] }}">
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('back-btn').addEventListener('click', function() {
    document.getElementById('back-form').submit();
});
</script>
@endpush

@push('styles')
<style>
    .confirm-table {
        width: 100%;
        border-collapse: collapse;
    }

    .confirm-table th,
    .confirm-table td {
        padding: 14px 20px;
        font-size: 14px;
        border-bottom: 1px solid #ede8e2;
        text-align: left;
    }

    .confirm-table th {
        background-color: #6b5b45;
        color: #fff;
        width: 200px;
        font-weight: 400;
    }
</style>
@endpush
