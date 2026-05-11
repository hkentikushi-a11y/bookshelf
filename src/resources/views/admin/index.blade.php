@extends('layouts.app')

@section('header-nav')
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-secondary" style="border:1px solid #555; background:#fff; cursor:pointer;">logout</button>
    </form>
@endsection

@section('content')
<style>
    .admin-wrap {
        padding: 30px 40px;
    }

    .admin-wrap h2 {
        text-align: center;
        font-size: 22px;
        margin-bottom: 20px;
    }

    .search-form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
        margin-bottom: 20px;
    }

    .search-form input[type="text"],
    .search-form input[type="date"],
    .search-form select {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 14px;
        background-color: #f5f0eb;
    }

    .search-form input[type="text"] {
        width: 220px;
    }

    .contacts-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        margin-bottom: 20px;
    }

    .contacts-table th {
        background-color: #7d6d5e;
        color: #fff;
        padding: 12px 16px;
        text-align: left;
        font-size: 14px;
        font-weight: normal;
    }

    .contacts-table td {
        padding: 12px 16px;
        font-size: 14px;
        border-bottom: 1px solid #e0d6cb;
    }

    .contacts-table tr:hover td {
        background-color: #f5f0eb;
    }

    .pagination-wrap {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .pagination-wrap .pagination {
        display: flex;
        list-style: none;
        gap: 4px;
    }

    .pagination-wrap .pagination li a,
    .pagination-wrap .pagination li span {
        display: inline-block;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 14px;
        color: #555;
        text-decoration: none;
    }

    .pagination-wrap .pagination li span.active,
    .pagination-wrap .pagination li a:hover {
        background-color: #7d6d5e;
        color: #fff;
        border-color: #7d6d5e;
    }

    .export-btn-wrap {
        margin-bottom: 16px;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-box {
        background-color: #fff;
        padding: 30px;
        border-radius: 4px;
        width: 500px;
        max-width: 90%;
        position: relative;
        max-height: 80vh;
        overflow-y: auto;
    }

    .modal-close {
        position: absolute;
        top: 10px;
        right: 16px;
        font-size: 20px;
        cursor: pointer;
        color: #666;
        border: none;
        background: none;
    }

    .modal-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .modal-table th {
        background-color: #7d6d5e;
        color: #fff;
        padding: 10px 14px;
        text-align: left;
        font-size: 14px;
        font-weight: normal;
        width: 160px;
    }

    .modal-table td {
        padding: 10px 14px;
        font-size: 14px;
        border-bottom: 1px solid #e0d6cb;
        background-color: #faf7f4;
    }

    .modal-delete-form {
        text-align: center;
    }
</style>

<div class="admin-wrap">
    <h2>Admin</h2>

    {{-- 検索フォーム --}}
    <form action="{{ route('admin.index') }}" method="GET" class="search-form">
        <input type="text" name="name" placeholder="名前やメールアドレスを入力してください"
            value="{{ request('name') }}" style="width:260px;">

        <select name="gender">
            <option value="0" {{ request('gender', '0') === '0' ? 'selected' : '' }}>性別</option>
            <option value="0" {{ request('gender') === '0' ? 'selected' : '' }}>全て</option>
            <option value="1" {{ request('gender') === '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') === '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') === '3' ? 'selected' : '' }}>その他</option>
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

        <button type="submit" class="btn btn-primary" style="padding:8px 24px;">検索</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary" style="padding:8px 24px;">リセット</a>
    </form>

    {{-- エクスポートボタン --}}
    <div class="export-btn-wrap">
        <a href="{{ route('admin.export', request()->query()) }}" class="btn btn-primary" style="padding:8px 24px;">エクスポート</a>
    </div>

    {{-- ページネーション --}}
    <div class="pagination-wrap">
        {{ $contacts->links() }}
    </div>

    {{-- 一覧テーブル --}}
    <table class="contacts-table">
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
                <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                <td>{{ $contact->gender_label }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content ?? '' }}</td>
                <td>
                    <button type="button" class="btn btn-secondary detail-btn"
                        data-id="{{ $contact->id }}"
                        data-first="{{ $contact->first_name }}"
                        data-last="{{ $contact->last_name }}"
                        data-gender="{{ $contact->gender_label }}"
                        data-email="{{ $contact->email }}"
                        data-tel="{{ $contact->tel }}"
                        data-address="{{ $contact->address }}"
                        data-building="{{ $contact->building }}"
                        data-category="{{ $contact->category->content ?? '' }}"
                        data-detail="{{ $contact->detail }}"
                        style="padding:4px 16px; font-size:13px;">
                        詳細
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ページネーション --}}
    <div class="pagination-wrap">
        {{ $contacts->links() }}
    </div>
</div>

{{-- モーダル --}}
<div id="modal-overlay" class="modal-overlay">
    <div class="modal-box">
        <button class="modal-close" id="modal-close">&times;</button>
        <table class="modal-table">
            <tr>
                <th>お名前</th>
                <td id="modal-name"></td>
            </tr>
            <tr>
                <th>性別</th>
                <td id="modal-gender"></td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td id="modal-email"></td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td id="modal-tel"></td>
            </tr>
            <tr>
                <th>住所</th>
                <td id="modal-address"></td>
            </tr>
            <tr>
                <th>建物名</th>
                <td id="modal-building"></td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td id="modal-category"></td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td id="modal-detail"></td>
            </tr>
        </table>
        <div class="modal-delete-form">
            <form id="modal-delete-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">削除</button>
            </form>
        </div>
    </div>
</div>

<script>
    const detailBtns = document.querySelectorAll('.detail-btn');
    const modalOverlay = document.getElementById('modal-overlay');
    const modalClose = document.getElementById('modal-close');
    const deleteForm = document.getElementById('modal-delete-form');

    detailBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            document.getElementById('modal-name').textContent = btn.dataset.first + ' ' + btn.dataset.last;
            document.getElementById('modal-gender').textContent = btn.dataset.gender;
            document.getElementById('modal-email').textContent = btn.dataset.email;
            document.getElementById('modal-tel').textContent = btn.dataset.tel;
            document.getElementById('modal-address').textContent = btn.dataset.address;
            document.getElementById('modal-building').textContent = btn.dataset.building;
            document.getElementById('modal-category').textContent = btn.dataset.category;
            document.getElementById('modal-detail').textContent = btn.dataset.detail;
            deleteForm.action = '/delete/' + id;
            modalOverlay.classList.add('active');
        });
    });

    modalClose.addEventListener('click', () => {
        modalOverlay.classList.remove('active');
    });

    modalOverlay.addEventListener('click', (e) => {
        if (e.target === modalOverlay) {
            modalOverlay.classList.remove('active');
        }
    });
</script>
@endsection
