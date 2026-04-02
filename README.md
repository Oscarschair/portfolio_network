# Portfolio Network

クリエイターが自身のポートフォリオサイトを登録し、プロフィールを公開・共有できるプラットフォームを提供するLaravelアプリケーションです。

## 特徴
- ユーザー登録・ログイン (Google OAuth認証対応)
- マイページからのプロフィール管理 (カスタムアイコン、自己紹介など)
- ポートフォリオサイト（URL）の登録および所有者認証機能
- クリエイタープロフィールの公開ページ (`/profile/{id}`)

## 開発環境セットアップ

本プロジェクトは Docker を用いた開発環境 (`docker-compose`) に対応しています。

### 1. リポジトリのクローンとインストール
```bash
git clone [repository_url]
cd portfolio_network
composer install
npm install
```

### 2. 環境変数の設定
`.env.example` をコピーして `.env` を作成し、環境に合わせて設定してください。
```bash
cp .env.example .env
```
Docker で起動する際の主要な設定項目（`docker-compose.yml`の設定と合致します）：
- `DB_CONNECTION=mysql`
- `DB_HOST=mysql`
- `DB_PORT=3306`
- `DB_DATABASE=LAA1377707-portdb211210` (新規環境の場合は `laravel_db`)
- `DB_USERNAME=root`
- `DB_PASSWORD=password`
- `GOOGLE_CLIENT_ID` / `GOOGLE_CLIENT_SECRET`: Googleログイン用APIキー

### 3. Docker によるサーバー起動
```bash
docker-compose up -d --build
```
起動後は `http://localhost:8080/` または指定したアプリURLからアクセス可能です。

### 4. アプリケーションキーの生成とDBマイグレーション
Dockerコンテナ（`app`）内でコマンドを実行し、初期設定を行います。
```bash
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
```

### 5. 画像保存用ディレクトリについて
ロリポップ等の一部レンタルサーバーのセキュリティ仕様により、`storage:link`によるシンボリックリンクでは画像が表示できない（403エラー）ケースがあります。
そのため、本プロジェクトでは画像を `storage/app/` ではなく 直接 `public/userimages/` や `public/portfolioimages/` フォルダに保存する仕様を採用しています。

**Windows環境での注意：**
もし `public/userimages` や `public/portfolioimages` がシンボリックリンクとしてチェックアウトされてしまっている場合は、手動でフォルダとして作り直してください。

### 6. フロントエンドのビルド
```bash
npm run dev
```

### 7. テストメール送信設定（オプション）
本環境ではDocker内にメールサーバーが構築されていないため、ユーザー登録時の「認証メール」などは送信エラーになります。
これを防ぐため、ローカル開発時は `.env` ファイルのメール設定を `log` ドライバーに変更してください。
これにより、認証メールの本文（認証URL含む）が画面にエラーを出さずに `storage/logs/laravel.log` の一番下へ出力されるようになります。

```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@portfolionetwork.local"
```
（※変更後は `docker-compose exec app php artisan config:clear` を実行して設定を反映させてください）

## 主要な構成
### 3. キャッシュ対策
- ブラウザのキャッシュによってデザイン変更が反映されないことを防ぐため、CSS や JS の読み込み時には常に `?v={{ date('YmdHi') }}` などのバージョン情報を付与すること。

## 本番環境 (ロリポップ) のサーバー構成

### ディレクトリ構成とシンボリックリンク

ロリポップのサーバーでは、以下のようなディレクトリ構成になっています。

| ディレクトリ | 役割 |
|---|---|
| `~/laravel/portfolio_network/` | Laravelアプリケーションの実体（`git clone` 先） |
| `~/web/portfolio-network.jp/` | ロリポップが管理する Webアクセス用フォルダ |

| `~/laravel/portfolio_network/` | Laravelアプリケーションの実体（`git clone` 先） |
| `~/web/portfolio-network.jp/` | ロリポップが管理する Webアクセス用フォルダ |

**設定の概要**: `~/web/portfolio-network.jp/public` は `~/laravel/portfolio_network/public` へのシンボリックリンクになっています。

```
~/web/portfolio-network.jp/public -> /home/users/0/lomo.jp-oscarchair/laravel/portfolio_network/public
```

ロリポップのコントロールパネルで `portfolio-network.oscarchair.jp` のドキュメントルートが `~/web/portfolio-network.jp/public/` に設定され、それ経由で `~/laravel/portfolio_network/public/` のファイルが配信されます。

> **重要**: ロリポップのセキュリティ仕様により、ドキュメントルート（`public/`）より上の階層を参照するシンボリックリンクは **403 Forbidden** となります。そのため `php artisan storage:link` は使用せず、物理的なディレクトリを配置しています。

### 本番デプロイ手順

1. ローカルで変更をプッシュ: `git push origin main`
2. デプロイスクリプトを実行: `./deploy.ps1`
   - リモートで `git pull`, `artisan migrate`, キャッシュクリアを自動実行

### 画像ストレージの構成

本番環境での画像ファイルの保存先と公開URLは**直接 public フォルダ**を使用します：

| 種別 | 保存先 (=公開URL) |
|---|---|
| ユーザーアイコン | `public/userimages/` |
| ポートフォリオアイコン | `public/portfolioimages/` |

> **注意**: デプロイ環境では `public/userimages/` 等をシンボリックリンクから物理フォルダ（ディレクトリ）に置き換える必要があります。

> **Tips (キャッシュ対策)**: ブラウザの強力なキャッシュ現象（同名ファイルをアップロードしても画像が切り替わらない問題）を防ぐため、画像のアップロードや更新時には必ず「古い画像ファイルを削除し、新しく**ランダムなファイル名を生成**して保存する」ロジックが実装されています（`MyProfileController` 等）。

---

## Git 運用ルール
- 開発環境（Docker/Linux）との整合性を保つため、リポジトリ内の改行コードは **LF** で統一する。
- Windows 環境の Git クライアントを使用する場合でも、`.gitattributes` の設定に従い `LF` でチェックアウトされるように構成されていることを確認する。

## サイトマップ生成
- `resources/views/sitemap.blade.php` は XML 形式で出力される。
- XML 宣言 (`<?xml ... ?>`) が PHP の開始タグと誤認してリンターエラーを引き起こすのを防ぐため、文字分割などのエスケープ処理を施して出力すること。

- **バックエンド**: Laravel 11 / PHP 8.3 Apache (Docker)
- **データベース**: MySQL 8.0 (Docker) / phpMyAdmin (`http://localhost:8081/`)
- **フロントエンドビルド**: Laravel Mix (`webpack.mix.js` / `package.json`)
- **特殊ライブラリ**: 
  - `laravel/socialite` (SNSログイン)
  - `sunra/php-simple-html-dom-parser` (ポートフォリオサイトのタグ解析・認証など)

## 技術的補足

### 改行コードについて
本プロジェクトは Docker (Linux) 環境での動作を前提としています。Windows 環境で開発する場合、改行コードの混在を防ぐために `.gitattributes` を設定しています。
Git の `core.autocrlf` 設定に関わらず、リポジトリ内およびチェックアウト時は `LF` で統一するように構成されています。

### キャッシュバスティング (CSS Versioning)
ブラウザキャッシュによるスタイルの反映遅延を防ぐため、主要な CSS リンクには `?v=YYYYMMDDHi` 形式のクエリパラメータを付与しています。
新しいスタイルを適用した際は、`resources/views/layouts/app.blade.php` 等の該当箇所を確認してください。

