# デプロイ・サーバー配置仕様書 (Deployment & Server Placement Specification)

本ドキュメントは、**Portfolio Network**（`portfolio-network.oscarchair.jp`）の本番環境（Lolipop共有サーバー / LiteSpeed）への配置構造、ルーティング仕様、およびデプロイ手順を定義します。

---

## 1. 🌐 本番サーバー環境概要

| 項目 | 設定値 / 仕様 | 備考 |
| :--- | :--- | :--- |
| **ホスト名 / ドメイン** | `portfolio-network.oscarchair.jp` | DNS解決先: `118.27.125.218` |
| **レンタルサーバー** | ロリポップ！共有サーバー（LiteSpeed Web Server） | PHP 8.4 / Apache mod_rewrite互換 |
| **SSH接続ホスト** | `ssh.lolipop.jp:2222` | ユーザー名: `lomo.jp-oscarchair` |
| **サーバーホーム** | `/home/users/0/lomo.jp-oscarchair` | 略記: `~/` |
| **Web公開領域ルート** | `/home/users/0/lomo.jp-oscarchair/web/` | 略記: `~/web/` |
| **本サービス配置パス** | `~/web/portfolio-network.oscarchair.jp/` | Laravelプロジェクト一式を配置 |

---

## 2. 🏗️ サーバー配置・ディレクトリ構造仕様

### 2.1 ロリポップ管理画面（ユーザー専用ページ）の設定仕様

ロリポップのサブドメイン設定において、以下の通り設定します：

| 設定項目 | 指定値 | 注意事項 |
| :--- | :--- | :--- |
| **サブドメイン名** | `portfolio-network` | 親ドメイン `oscarchair.jp` を選択 |
| **公開（アップロード）フォルダ** | `portfolio-network.oscarchair.jp` | **末尾にスラッシュ `/` や階層を付けず、ドメイン名完全一致で指定** |
| **独自SSL設定** | 有効（無料独自SSL / Let's Encrypt） | 常時SSL接続（HTTPS） |

> [!WARNING]
> **404エラー回避のための重要制約 (Invariants)**
> 1. ロリポップの「公開（アップロード）フォルダ」欄に `portfolio-network.jp/public/` のように **末尾スラッシュ `/` や階層パス** を入力すると、LiteSpeedのバーチャルホストマッピングが失敗し **404 Not Found** となります。
> 2. 他の稼働中サービス（`geomaru.oscarchair.jp`, `pinkroom.fun` 等）と同様に、公開フォルダ名は **`portfolio-network.oscarchair.jp`** と設定します。

---

### 2.2 リモートサーバー上のファイル配置ツリー

```text
/home/users/0/lomo.jp-oscarchair/
└── web/
    ├── geomaru.oscarchair.jp/          # (他稼働中サービス)
    ├── pinkroom.fun/                   # (他稼働中サービス)
    └── portfolio-network.oscarchair.jp/ # 【本サービス配置ディレクトリ】
        ├── .htaccess                   # [必須] public/ への自動ルーティング & HTTPS強制
        ├── .env                        # 本番環境変数 (DB接続, App Key等)
        ├── app/                        # アプリケーションロジック
        ├── bootstrap/                  # フレームワーク起動処理・キャッシュ
        ├── config/                     # 設定ファイル群
        ├── database/                   # マイグレーション
        ├── public/                     # 公開静的アセット・フロントエンド成果物
        │   ├── index.php               # エントリポイント
        │   ├── css/, js/, images/      # ビルド済みアセット
        │   ├── userimages/             # ユーザーアイコン画像 (永続化)
        │   └── portfolioimages/        # ポートフォリオ画像 (永続化)
        ├── resources/                  # Bladeテンプレート・未コンパイルアセット
        ├── routes/                     # ルーティング定義 (web.php, api.php)
        ├── storage/                    # ログ・フレームワークキャッシュ (777権限)
        └── vendor/                     # Composer依存ライブラリ
```

---

## 3. 🔄 ルーティング制御仕様 (`.htaccess`)

ロリポップ共有サーバーではドキュメントルートがプロジェクト直下（`~/web/portfolio-network.oscarchair.jp/`）を指すため、ルート直下に以下の [.htaccess](file:///c:/Users/user/git/portfolio_network/.htaccess) を配置して `public/` ディレクトリへ安全にリライトします。

### プロジェクトルートの [.htaccess](file:///c:/Users/user/git/portfolio_network/.htaccess)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On

    # 1. HTTPリクエストをHTTPSへ301リダイレクト
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [R=301,L]

    # 2. 全リクエストを public/ ディレクトリ配下へ転送
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### [public/.htaccess](file:///c:/Users/user/git/portfolio_network/public/.htaccess) (Laravel標準)
Laravel のフロントコントローラー（`public/index.php`）へリクエストを集約します。

---

## 4. 🗄️ 画像ストレージとパーミッション仕様

ロリポップ等のレンタルサーバー環境におけるシンボリックリンク（`storage:link`）制限（403 Forbidden）を回避するため、画像アップロード先は `public/` 直下に直接配置・永続化します。

- **ユーザーアイコン**: `public/userimages/` (権限: `755` または `777`)
- **ポートフォリオ画像**: `public/portfolioimages/` (権限: `755` または `777`)
- **フレームワーク書き込み領域**: `storage/`, `bootstrap/cache/` (権限: `777`)

---

## 5. 🚀 デプロイメント手順

### 5.1 環境設定ファイル
デプロイ用接続情報は [.env.deploy](file:///c:/Users/user/git/portfolio_network/.env.deploy) に定義します：

```ini
# SSH接続情報 (ロリポップ標準)
SSH_USER=lomo.jp-oscarchair
SSH_HOST=ssh.lolipop.jp
SSH_PORT=2222
SSH_PASS=****************

# デプロイ先ディレクトリ
DEPLOY_DIR=~/web/portfolio-network.oscarchair.jp/
```

### 5.2 デプロイ実行フロー
1. **アセットビルド**: `npm run build`（または `npm run prod`）を実行
2. **アーカイブ生成**: 不要なキャッシュや `.git` を除外し `deploy.zip` を作成
3. **サーバー転送**: SSH/SCP 経由で `deploy.zip` を転送
4. **リモート適用コマンド**:
   ```bash
   cd ~/web/portfolio-network.oscarchair.jp/
   unzip -o deploy.zip && rm deploy.zip
   /usr/local/php/8.4/bin/php composer.phar install --no-dev --optimize-autoloader
   /usr/local/php/8.4/bin/php artisan migrate --force
   /usr/local/php/8.4/bin/php artisan config:clear
   /usr/local/php/8.4/bin/php artisan route:clear
   /usr/local/php/8.4/bin/php artisan view:clear
   /usr/local/php/8.4/bin/php artisan optimize
   ```
