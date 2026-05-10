# FashionablyLate お問い合わせフォーム

COACHTECHの確認テスト用Laravelアプリケーションです。

## 使用技術

- PHP 8.4
- Laravel 13
- MySQL 8.0
- Nginx 1.21
- Docker / Docker Compose

## 環境構築

### 1. リポジトリのクローン

```bash
git clone <リポジトリURL>
cd coachtech-contact
```

### 2. Dockerコンテナのビルドと起動

```bash
docker-compose up -d --build
```

### 3. アプリケーションキーの生成

```bash
docker-compose exec app php artisan key:generate
```

### 4. マイグレーションとシーディング

```bash
docker-compose exec app php artisan migrate --seed
```

### 5. アクセス

ブラウザで `http://localhost` にアクセスしてください。

---

## 機能一覧

| 画面 | パス | 説明 |
|------|------|------|
| お問い合わせフォーム入力ページ | / | お問い合わせフォームの入力 |
| お問い合わせフォーム確認ページ | /confirm | 入力内容の確認 |
| サンクスページ | /thanks | 送信完了 |
| 管理画面 | /admin | お問い合わせ一覧（要ログイン） |
| ユーザー登録 | /register | 管理者アカウント登録 |
| ログイン | /login | 管理者ログイン |
| ログアウト | /logout | ログアウト |
| エクスポート | /export | CSV出力（要ログイン） |

## ER図

ER図は [er_diagram.html](er_diagram.html) を参照してください。

```
categories          contacts              users
──────────          ──────────────        ──────────
id (PK)        ┌── id (PK)               id (PK)
content        │   category_id (FK) ──┐  name
created_at     │   first_name         │  email
updated_at     └── last_name          │  password
                   gender             │  created_at
                   email              │  updated_at
                   tel                │
                   address            │
                   building           │
                   detail             │
                   created_at         │
                   updated_at         │
                                      │
categories ←──────────────────────────┘
（1対多）
```

```
categories
├── id (PK)
├── content
├── created_at
└── updated_at

contacts
├── id (PK)
├── category_id (FK -> categories.id)
├── first_name
├── last_name
├── gender (1:男性 2:女性 3:その他)
├── email
├── tel
├── address
├── building (nullable)
├── detail
├── created_at
└── updated_at

users
├── id (PK)
├── name
├── email
├── password
├── email_verified_at
├── remember_token
├── created_at
└── updated_at
```
