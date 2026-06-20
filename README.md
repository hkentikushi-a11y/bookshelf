# coachtechフリマ

## アプリケーション概要

ある企業が独自に開発したフリマアプリです。商品の出品・購入・いいね・コメント機能を備えています。

## 環境構築

### 1. リポジトリのクローン

```bash
git clone https://github.com/hkentikushi-a11y/bookshelf.git
cd bookshelf
```

### 2. .env ファイルの作成

```bash
cp src/.env.example src/.env
```

### 3. Docker コンテナのビルドと起動

```bash
docker-compose up -d --build
```

### 4. パッケージのインストール

```bash
docker-compose exec app composer install
```

### 5. アプリケーションキーの生成

```bash
docker-compose exec app php artisan key:generate
```

### 6. マイグレーションとシーディング

```bash
docker-compose exec app php artisan migrate --seed
```

## 使用技術（実行環境）

- PHP 8.3
- Laravel 13
- MySQL 8.0
- Nginx 1.21
- Docker / Docker Compose

## 開発環境

| URL | 説明 |
|-----|------|
| http://localhost | 商品一覧（トップ画面） |
| http://localhost/register | 会員登録 |
| http://localhost/login | ログイン |

## ER図

![ER図](er_diagram.html)

詳細は `er_diagram.html` をブラウザで開いてご確認ください。
