@extends('layouts.app')

@section('header-nav')
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" style="background:none; border:1px solid #fff; color:#fff; padding:6px 16px; cursor:pointer; font-size:13px;">logout</button>
    </form>
@endsection

@push('styles')
<style>
    .admin-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .search-bar {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }

    .search-bar input[type="text"],
    .search-bar select {
        padding: 8px 12px;
        border: 1px solid #d5cec7;
        border-radius: 2px;
        font-size: 13px;
        background-color: #faf9f7;
        outline: none;
        width: auto;
    }

    .search-bar input[type="date"] {
        padding: 8px 12px;
        border: 1px solid #d5cec7;
        border-radius: 2px;
        font-size: 13px;
        background-color: #faf9f7;
    }

    .btn-sm {
        padding: 8px 20px;
        border: none;
        border-radius: 2px;
        font-size: 13px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-search {
        background-color: #6b5b45;
        color: #fff;
    }

    .btn-reset {
        background-color: #9e9e9e;
        color: #fff;
    }

    .btn-export {
        background-color: #6b5b45;
        color: #fff;
        margin-bottom: 12px;
        display: inline-block;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        font-size: 13px;
    }

    .data-table th {
        background-color: #6b5b45;
        color: #fff;
        padding: 12px 16px;
        text-align: left;
        font-weight: 400;
    }

    .data-table td {
        padding: 12px 16px;
        border-bottom: 1px solid #ede8e2;
    }

    .data-table tr:hover td {
        background-color: #faf6f2;
    }

    .btn-detail {
        padding: 5px 14px;
        background-color: #6b5b45;
        color: #fff;
        border: none;
        border-radius: 2px;
        font-size: 12px;
        cursor: pointer;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        margin-top: 20px;
    }

    .pagination a,
    .pagination span {
        padding: 6px 12px;
        border: 1px solid #d5cec7;
        border-radius: 2px;
        font-size: 13px;
        text-decoration: none;
        color: #555;
    }

    .pagination .active span {
        background-color: #6b5b45;
        color: #fff;
        border-color: #6b5b45;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: flex-start;
        padding-top: 60px;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal {
        background: #fff;
        width: 480px;
        max-height: 80vh;
        overflow-y: auto;
        border-radius: 2px;
        padding: 30px;
        position: relative;
    }

    .modal-close {
        position: absolute;
        top: 12px;
        right: 16px;
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #888;
    }

    .modal-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .modal-table th,
    .modal-table td {
        padding: 10px 14px;
        border-bottom: 1px solid #ede8e2;
        text-align: left;
    }

    .modal-table th {
        width: 160px;
        color: #666;
        font-weight: 400;
    }

    .search-name-email {
        display: flex;
        flex: 1;
        gap: 10px;
        min-width: 0;
    }
</style>
@endpush

@section('content')
<div class="admin-container">
    <h2>Admin</h2>

    <form action="{{ route('search') }}" method="GET">
        <div class="search-bar">
            <div class="search-name-email">
                <input type="text" name="name" placeholder="名前やメールアドレスを入力してください" value="{{ request('name') }}" style="flex:1;">
            </div>
            <select name="gender">
                <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>性別</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>
            <select name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
            <input type="date" name="date" value="{{ request('date') }}">
            <button type="submit" class="btn-sm btn-search">検索</button>
            <a href="{{ route('reset') }}" class="btn-sm btn-reset">リセット</a>
        </div>
    </form>

    <a href="{{ route('export', request()->all()) }}" class="btn-sm btn-export">エクスポート</a>

    {{ $contacts->links('vendor.pagination.custom') }}

    <table class="data-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>{{ $contact->gender_label }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content ?? '' }}</td>
                <td>
                    <button class="btn-detail" onclick="openModal({{ $contact->id }})">詳細</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contacts->links('vendor.pagination.custom') }}
</div>

@foreach ($contacts as $contact)
<div class="modal-overlay" id="modal-{{ $contact->id }}">
    <div class="modal">
        <button class="modal-close" onclick="closeModal({{ $contact->id }})">&times;</button>
        <table class="modal-table">
            <tr><th>お名前</th><td>{{ $contact->last_name }} {{ $contact->first_name }}</td></tr>
            <tr><th>性別</th><td>{{ $contact->gender_label }}</td></tr>
            <tr><th>メールアドレス</th><td>{{ $contact->email }}</td></tr>
            <tr><th>電話番号</th><td>{{ $contact->tel }}</td></tr>
            <tr><th>住所</th><td>{{ $contact->address }}</td></tr>
            <tr><th>建物名</th><td>{{ $contact->building }}</td></tr>
            <tr><th>お問い合わせの種類</th><td>{{ $contact->category->content ?? '' }}</td></tr>
            <tr><th>お問い合わせ内容</th><td>{{ $contact->detail }}</td></tr>
        </table>
        <form action="{{ route('delete', $contact->id) }}" method="POST" style="text-align:center; margin-top:20px;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" style="width:120px; margin:0 auto; display:block;">削除</button>
        </form>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<script>
function openModal(id) {
    document.getElementById('modal-' + id).classList.add('active');
}
function closeModal(id) {
    document.getElementById('modal-' + id).classList.remove('active');
}
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-overlay')) {
        e.target.classList.remove('active');
    }
});
</script>
@endpush
