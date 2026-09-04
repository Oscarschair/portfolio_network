# [ADR-0001] ロリポップ共有サーバーへの配置構成と.htaccess自動ルーティング方式の選定

- **ステータス (Status)**: Accepted
- **日付 (Date)**: 2026-09-04
- **意思決定者 (Deciders)**: oscarchair 開発チーム
- **関連ドキュメント**: [deployment.md](file:///c:/Users/user/git/portfolio_network/docs/deployment.md)

---

## 1. コンテキストと問題提起 (Context and Problem Statement)
`https://portfolio-network.oscarchair.jp/` の本番稼働において、初期設定では `~/laravel/portfolio_network/` にプロジェクトを配置し、`~/web/` からシンボリックリンクを貼る旧方式が想定されていたが、以下の問題が発生した：
1. ロリポップの管理画面で公開フォルダに `portfolio-network.jp/public/` 等の階層・末尾スラッシュが指定されたことで LiteSpeed 側で 404 エラーとなった。
2. 同一サーバー上で稼働中の他サービス（`geomaru.oscarchair.jp` や `pinkroom.fun`）では、`~/web/[ドメイン名]/` 直下にプロジェクト全体を配置し、ルートの `.htaccess` で `public/` へリライトする標準方式が安定稼働している。

## 2. 検討した選択肢 (Considered Options)
- **選択肢 1（旧シンボリックリンク方式）**: `~/laravel/portfolio_network/` に本体を置き、`~/web/` 配下に `public` へのシンボリックリンクを作成する。
  - *デメリット*: レンタルサーバーのパーミッションや更新時のリンク切れリスク、管理画面のパス指定との不整合リスクがある。
- **選択肢 2（ドメイン配下直接配置 ＋ `.htaccess` 自動ルーティング方式【採用】）**: ロリポップの公開フォルダを `portfolio-network.oscarchair.jp` とし、`~/web/portfolio-network.oscarchair.jp/` 直下にプロジェクトを配置。ルートの `.htaccess` で `public/` へルーティングする。
  - *メリット*: `geomaru` や `pinkroom` と同一の全社共通標準となり、管理・デプロイスクリプト・障害対応が完全に統一される。

## 3. 決定内容 (Decision Outcome)
**選択肢 2 を採用**する。
- ロリポップ管理画面の公開フォルダ設定: `portfolio-network.oscarchair.jp`
- リモート配置先: `~/web/portfolio-network.oscarchair.jp/`
- ルーティング: ルート直下の `.htaccess` による `public/$1` 自動リライトおよび HTTPS 強制リダイレクト

## 4. 影響と結果 (Consequences)
- デプロイスクリプト（[.env.deploy](file:///c:/Users/user/git/portfolio_network/.env.deploy) / `deploy.ps1`）を本方式に更新。
- 404 エラーおよびシンボリックリンク起因のパーミッションエラーを恒久的に排除できる。
