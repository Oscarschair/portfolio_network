# Portfolio Network プロジェクトドキュメント (Docs Portal)

本ディレクトリは、**Portfolio Network**（クリエイター向けポートフォリオプラットフォーム）の設計仕様、サーバー配置構成、アーキテクチャ意思決定記録（ADR）、および運用手順を管理する正本ドキュメント領域です。

---

## 📜 プロジェクト開発・ドキュメント運用憲章 (Project Charter)

1. **第 1 条: 正本はコード (Code is Single Source of Truth)**
   ソースコード（`app/`, `resources/`, `routes/`）および DB スキーマ（`database/migrations/`）が常に一次情報（正本）である。コードとドキュメントに不整合が生じた場合は、実行コードを絶対正とする。
2. **第 2 条: ドキュメントは「なぜ」と「不変条件」に特化する (Document the "Why" and Invariants)**
   ドキュメントにはコード単体では表現しきれない「ビジネスの背景（なぜその設計を選んだか）」「設計思想」「セキュリティ制約」「用語の定義」「不変条件」に特化して記述する。
3. **第 3 条: PR 同梱の同時更新 ＆ 日本語記述 (Definition of Done & Japanese PR)**
   機能追加・修正時には、対応する仕様書および ADR の更新を PR マージの必須条件 (Definition of Done) とする。
4. **第 4 条: アーキテクチャ変更の ADR 記録義務 (Mandatory ADR Trail)**
   技術スタックの選定・変更、データモデルの改編、セキュリティ方針の変更などの重要な意思決定は、必ず `docs/adr/NNNN-<title>.md` として標準フォーマットで記録を残す。

---

## 📚 ドキュメント構成一覧

| ドキュメント | 概要 | リンク |
| :--- | :--- | :--- |
| **デプロイ・サーバー配置仕様書** | ロリポップ本番環境の配置構造、LiteSpeed/mod_rewrite ルーティング、404 回避原則、デプロイフロー | [deployment.md](file:///c:/Users/user/git/portfolio_network/docs/deployment.md) |
| **全体アーキテクチャ設計書** | システム全体構成、Laravel バックエンド、フロントエンド設計、DB/ストレージ構成 | [architecture.md](file:///c:/Users/user/git/portfolio_network/docs/architecture.md) |
| **アーキテクチャ決定ログ (ADR)** | 技術選定や配置構成などの意思決定履歴 (4桁連番) | [adr/](file:///c:/Users/user/git/portfolio_network/docs/adr/) |
| **ドメイン・機能仕様書** | 各種機能仕様（ユーザー認証・ポートフォリオ登録・認証・検索） | [domains/](file:///c:/Users/user/git/portfolio_network/docs/domains/) |
