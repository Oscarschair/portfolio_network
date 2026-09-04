@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/editportfolio.css') }}?v={{ time() }}" rel="stylesheet">
<script src="{{ asset('js/filechecker.js') }}?v={{ time() }}" defer></script>

<div class="container">
    <div class="justify-content-center">
      @if ($portfolio->user_id == $user->id)
      <div class="edit-portfolio-card animate-box-up">
        <h2 class="edit-section-title">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
          ポートフォリオ編集・認証
        </h2>

        <div class="edit-form-grid">
          
          <!-- サムネイル画像 -->
          <div class="edit-field-item">
            <div class="edit-field-label">サムネイル画像</div>
            <div class="edit-field-content">
              <div class="edit-icon-preview">
                @if ($portfolio->icon_path == null)
                  <img src="{{ asset('img/defaultPortfolioIcon.png') }}" alt="サムネイル"/>
                @else
                  <img src="{{ asset('portfolioimages/'.$portfolio->icon_path) }}" alt="サムネイル"/>
                @endif
              </div>
              <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_icon" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="updateMethod" value="iconupload">
                <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                  <input type="file" id="file" name="file" class="form-control" style="max-width: 320px;" required accept="image/jpeg, image/png">
                  <button name="submit" class="btn btn-primary btn-sm" type="submit">アップロード</button>
                </div>
              </form>
            </div>
          </div>

          <!-- URL -->
          <div class="edit-field-item">
            <div class="edit-field-label">URL</div>
            <div class="edit-field-content">
              <a href="{{$portfolio->url}}" target="_blank" rel="noopener noreferrer" style="color: var(--primary, #6366f1); text-decoration: underline; word-break: break-all; font-weight: 500;">
                {{$portfolio->url}}
              </a>
            </div>
          </div>

          <!-- タイトル -->
          <div class="edit-field-item">
            <div class="edit-field-label">タイトル</div>
            <div class="edit-field-content">
              <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_title" method="post">
                @csrf
                <input type="hidden" name="updateMethod" value="editTitle">
                <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                  <input name="title" value="{{$portfolio->title}}" class="form-control" style="flex: 1; min-width: 240px;" type="text" id="portfolioTitle" required placeholder="タイトルを入力" maxlength="100">
                  <button name="submit" class="btn btn-primary btn-sm" type="submit">タイトル変更</button>
                </div>
              </form>
            </div>
          </div>

          <!-- 詳細内容 -->
          <div class="edit-field-item">
            <div class="edit-field-label">詳細内容</div>
            <div class="edit-field-content">
              <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_description" method="post">
                @csrf
                <input type="hidden" name="updateMethod" value="editDescription">
                <textarea rows="4" name="description" class="form-control" id="portfolioDescription" required placeholder="ポートフォリオのコンセプトや担当範囲などを入力" maxlength="5000">{{$portfolio->description}}</textarea>
                <div style="margin-top: 8px;">
                  <button name="submit" class="btn btn-primary btn-sm" type="submit">詳細内容を変更</button>
                </div>
              </form>
            </div>
          </div>

          <!-- 職種・タイプ -->
          <div class="edit-field-item">
            <div class="edit-field-label">職種・タイプ</div>
            <div class="edit-field-content">
              <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_type" method="post">
                @csrf
                <input type="hidden" name="updateMethod" value="editType">
                <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                  <select name="type" id="portfolioType" class="form-control" style="max-width: 260px;">
                    @for($i = 0; $i < count($portfolioTypes); $i++)
                      <option value="{{$i}}" {{ $i == $portfolio->type ? 'selected' : '' }}>{{$portfolioTypes[$i]}}</option>
                    @endfor
                  </select>
                  <button name="submit" class="btn btn-primary btn-sm" type="submit">タイプを変更</button>
                </div>
              </form>
            </div>
          </div>

          <!-- 所有者認証 -->
          <div class="edit-field-item">
            <div class="edit-field-label">所有者認証</div>
            <div class="edit-field-content">
              @if ($portfolio->verified_at == null)
                @if ($portfolio->failed_at != null)
                  <span class="status-badge failed">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    認証失敗: {{$portfolio->failed_message}}
                  </span>
                @else
                  <span class="status-badge unverified">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    未認証（所有権の確認が必要です）
                  </span>
                @endif

                <div class="auth-info-card">
                  <p style="margin-bottom: 8px; font-weight: 600; color: var(--text-primary, #f8fafc);">💡 認証手順：</p>
                  <ol style="padding-left: 20px; margin: 0; line-height: 1.6;">
                    <li>「認証用ファイルをダウンロード」をクリックして HTML ファイルを取得します。</li>
                    <li>サイトのルートディレクトリまたは指定パスへアップロードします。</li>
                    <li>「今すぐ認証する」をクリックして検証を実行します。</li>
                  </ol>
                </div>

                <div class="btn-group-row">
                  <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_authenticateNow" method="post">
                    @csrf
                    <input type="hidden" name="updateMethod" value="authenticateNow">
                    <button name="submit" class="btn btn-primary btn-sm" type="submit">今すぐ認証する</button>
                  </form>
                  <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_downloadAuthentication" method="post">
                    @csrf
                    <input type="hidden" name="updateMethod" value="downloadAuthentication">
                    <button name="submit" class="btn btn-secondary btn-sm" type="submit">認証用ファイルをダウンロード</button>
                  </form>
                </div>
              @else
                <span class="status-badge verified">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                  認証完了 ({{$portfolio->verified_at}})
                </span>
              @endif
            </div>
          </div>

          <!-- 公開設定 -->
          @if ($portfolio->verified_at != null)
          <div class="edit-field-item">
            <div class="edit-field-label">公開設定</div>
            <div class="edit-field-content">
              <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_switchDisplay" method="POST">
                @csrf
                <input type="hidden" name="updateMethod" value="switchDisplay">
                <div class="toggle-switch-wrapper">
                  <label class="toggle-switch">
                    <input type="checkbox" id="displaySwitcher" name="displaySwitcher" onchange="document.getElementById('PortfolioModForm_switchDisplay').submit();" {{ $portfolio->display_flag ? 'checked' : '' }}>
                    <span class="slider"></span>
                  </label>
                  <span style="font-size: 0.95rem; font-weight: 600; color: {{ $portfolio->display_flag ? 'var(--text-primary, #f8fafc)' : 'var(--text-muted, #94a3b8)' }};">
                    {{ $portfolio->display_flag ? '公開中（全体に表示されています）' : '非公開（マイページのみ）' }}
                  </span>
                </div>
              </form>
            </div>
          </div>
          @endif

        </div>
      </div>
      @else
      <div class="edit-portfolio-card" style="text-align: center; padding: 60px 20px;">
        <div style="font-size: 2.5rem; margin-bottom: 16px;">🚫</div>
        <h3 style="color: var(--text-primary, #f8fafc); margin-bottom: 8px;">権限がありません</h3>
        <p style="color: var(--text-muted, #94a3b8);">このポートフォリオを編集する権限がありません。適切なアカウントでログインしてください。</p>
        <div style="margin-top: 24px;">
          <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-secondary">別のアカウントでログイン</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
      @endif
    </div>
</div>
@endsection
