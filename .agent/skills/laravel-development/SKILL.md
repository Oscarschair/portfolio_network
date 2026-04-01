---
name: Laravel Development
description: Skills and guidelines for developing and maintaining the Portfolio Network Laravel application.
---

# Laravel Development

このスキルセットは、本番運用および開発時の基本的なLaravelプロジェクト運用方法を定めます。

## アーキテクチャ

### 1. アプリケーション構造
- **ルーティング**: `routes/web.php`。ゲスト用、ログイン用(`auth`ミドルウェア)、Googleログインのリダイレクトなど。
- **コントローラ**: `app/Http/Controllers`。プロフィールの更新などは `MyProfileController` で集約。
- **ビュー**: `resources/views` (Bladeテンプレート)。

### 2. ファイルのアップロード運用
画像（プロフィールアイコン・ポートフォリオアイコン）はローカルの `storage/app` ディレクトリにアップロードされます。
`public/userimages` などのシンボリックリンクまたはジャンクションを使用して公開されます。

**Windowsでの注意点:**
Windows環境でGitからCloneしてきた際、Linux上のシンボリックリンクがテキストファイルとして落ちてくる場合があります。
その場合アップロードが成功してもWeb画面上で表示されない（404）ため、手動でテキストファイルを削除して `php artisan storage:link` のリンク再生成が必要です。

### 3. 所有者認証ロジック
- クリエイターが登録するサイトURLの中にある特定タグやトークンを用いて、自動クローラー (`php-simple-html-dom-parser`) が所有者認証を行えるように構成されています。

## ベストプラクティス
- `.env` ファイルに依存する設定は必ず `config/` でデフォルト値を拾うようにする。
- デバッグ時は `laravel-debugbar` を活用。
- Tailwindなどではなく純粋なCSSやAssetコンパイルにMix(`webpack.mix.js`)が使用されているため、フロントエンドの修正には `npm run dev` などを実行してください。

## デザイン & UI/UX ガイドライン

### 1. モダン・プレミアム・デザイン
- **アクセントカラー**: 深いインディゴ (`#4F46E5`) やバイオレット (`#7C3AED`) を基調とし、洗練された印象を与える。
- **グラスモーフィズム (Glassmorphism)**: ヘッダーやテキストボックスに `backdrop-filter: blur(10px)` と半透明の背景を組み合わせ、奥行きを表現する。
- **角丸とシャドウ**: コンポーネントには大きめの角丸 (`border-radius: 20px`) と、非常に柔らかいシャドウ (`box-shadow: 0 10px 30px rgba(0,0,0,0.05)`) を適用する。

### 2. インタラクション
- **ホバーエフェクト**: カードコンポーネントなどがホバー時に少し浮き上がる (`transform: translateY(-5px)`) 演出を加える。
- **タイポグラフィ**: "Inter" (本文用) や "Outfit" (見出し用) などのモダンなフォントを組み合わせ、可読性とデザイン性を両立させる。

