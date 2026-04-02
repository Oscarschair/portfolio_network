# Portfolio Network

クリエイターが自身のポートフォリオサイトを登録し、プロフィールを公開・共有できるプラットフォームを提供するLaravelアプリケーションです。

## 特徴
- **モダンなUI/UX**: 2026年現在の、プレミアムかつ洗練されたデザイン（グラスモーフィズム、高度なアニメーション、洗練されたタイポグラフィ）への刷新。
- **「3つの柱」戦略**: 単なるリンク集ではない、「見つかる・伝わる・繋がる」を具体化したプラットフォーム。
- **UIデザイナーへの対応**: スキルセット（職種）に「UIデザイナー」を標準搭載。
- **ユーザー認証**: ユーザー登録・ログイン (Google OAuth認証対応)
- **プロフィール管理**: マイページからのプロフィール管理 (カスタムアイコン、自己紹介など)
- **高度な検索機能**: 職種別・キーワード別の洗練された検索結果表示。
- **サイト認証機能**: ポートフォリオサイト（URL）の登録および所有者認証機能

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

### 7. キャッシュクリアとアセット更新
開発中にCSSやJSを変更した際は、以下のコマンドでキャッシュをクリアしてください。
```bash
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan cache:clear
```

## 各種ツール・ライブラリ
- **バックエンド**: Laravel 11 / PHP 8.3 Apache (Docker)
- **データベース**: MySQL 8.0 (Docker) / phpMyAdmin (`http://localhost:8081/`)
- **フロントエンド設計**: **Vanilla CSS / JavaScript (jQuery)**。モダンなデザインシステム（Indigo/Violetテーマ）を独自実装。
- **特殊ライブラリ**: 
  - `laravel/socialite` (SNSログイン)
  - `sunra/php-simple-html-dom-parser` (ポートフォリオサイトのタグ解析・認証用)

## 開発・運用ルール

### 1. 改行コードとGit運用
- 開発環境（Docker/Linux）との整合性を保つため、リポジトリ内の改行コードは **LF** で統一してください。

### 2. 強力なブラウザキャッシュ対策
- **アセットキャッシュ対策**: CSS や JS の読み込み時には、全ページで強制的に `?v={{ time() }}` クエリパラメータを付与しています。これにより、デプロイや変更時に即座に最新のデザインが反映されます。
- **画像キャッシュ対策**: アップロード時、キャッシュ対策としてランダムな16文字のファイル名を生成して保存するロジックを採用しています。古いファイルは削除されます。

### 3. デザイン整合性
- **OSCSS-section-inner**: コンテンツ幅は `1200px` で統一されており、ヘッダー・フッター・メインコンテンツのすべてがこの幅に準拠してレイアウトされています。
- **3つの柱**: クリエイターの「見つかる・伝わる・繋がる」を重視したカードレイアウトが、TOPおよび検索結果ページの設計思想となっています。


