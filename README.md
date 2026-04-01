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

### 5. ストレージリンクの作成
ユーザー画像のアップロード用にディレクトリのリンクを作成します。

**Windows環境での注意：**
もし `public/userimages` などのシンボリックリンクがテキストファイルとしてチェックアウトされてしまっている場合は、手動で削除してから実行してください。
```bash
docker-compose exec app php artisan storage:link
```
※WindowsのDocker環境ではジャンクションをホスト側から実行しなければいけないケースもあるため、画像がアップロードできても表示されない場合はホスト（Windows側）から `php artisan storage:link` の実行をお試しください。

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
- **バックエンド**: Laravel 11 / PHP 8.3 Apache (Docker)
- **データベース**: MySQL 8.0 (Docker) / phpMyAdmin (`http://localhost:8081/`)
- **フロントエンドビルド**: Laravel Mix (`webpack.mix.js` / `package.json`)
- **特殊ライブラリ**: 
  - `laravel/socialite` (SNSログイン)
  - `sunra/php-simple-html-dom-parser` (ポートフォリオサイトのタグ解析・認証など)
