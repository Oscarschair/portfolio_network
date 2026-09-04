@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/myprofile.css') }}?v={{ time() }}" rel="stylesheet">
<script src="{{ asset('js/filechecker.js') }}?v={{ time() }}" defer></script>

<div class="myprofile-wrapper">
    <div class="OSCSS-section-inner">
        <div class="dashboard-grid">
            
            <!-- Left Sidebar: Profile Details -->
            <div class="profile-card">
                <div class="avatar-wrapper">
                    @if ($user->icon_path == null)
                        <img class="avatar-img" src="{{ asset('img/defaultProfileIcon.png') }}" alt="{{ $user->name }}" />
                    @else
                        <img class="avatar-img" src="{{ asset('userimages/' . $user->icon_path) }}" alt="{{ $user->name }}" />
                    @endif
                </div>
                
                <h2 class="user-name-display">{{ $user->name }}</h2>
                <p class="user-email-display">{{ $user->email }} (非公開)</p>

                <!-- Avatar Upload Form -->
                <form action="{{ route('editProfile') }}" id="ProfileModForm_icon" method="post" enctype="multipart/form-data" class="profile-edit-section">
                    @csrf
                    <input type="hidden" name="updateMethod" value="iconupload">
                    <h3>アイコン画像の変更</h3>
                    <div class="form-group-compact">
                        <input type="file" id="file" name="file" required accept="image/jpeg, image/png">
                    </div>
                    <button type="submit" class="btn-compact-submit">アイコンを更新</button>
                </form>

                <!-- Name Edit Form -->
                <form action="{{ route('editProfile') }}" id="ProfileModForm_name" method="post" class="profile-edit-section">
                    @csrf
                    <input type="hidden" name="updateMethod" value="editName">
                    <h3>ユーザー名変更</h3>
                    <div class="form-group-compact">
                        <input name="name" value="{{ $user->name }}" type="text" id="UserName" required onKeyup="this.value=this.value.replace('@','')">
                    </div>
                    <button type="submit" class="btn-compact-submit">名前を変更</button>
                </form>

                <!-- Bio Edit Form -->
                <form action="{{ route('editProfile') }}" id="ProfileModForm_description" method="post" class="profile-edit-section">
                    @csrf
                    <input type="hidden" name="updateMethod" value="editDescription">
                    <h3>自己紹介 / プロフィール</h3>
                    <div class="form-group-compact">
                        <textarea rows="4" name="description" id="userDescription" placeholder="スキルや実績、得意分野など">{{ $user->description }}</textarea>
                    </div>
                    <button type="submit" class="btn-compact-submit">自己紹介を更新</button>
                </form>

                <div class="account-danger-zone">
                    <a class="btn-revoke-link" href="{{ route('revoke_request') }}">退会申請はこちら</a>
                </div>
            </div>

            <!-- Right Main: Portfolios Management -->
            <div class="portfolios-area">
                
                <!-- Add New Portfolio Card -->
                <div class="dashboard-section-card">
                    <h2 class="dashboard-card-title">新規ポートフォリオの追加</h2>
                    <p class="dashboard-card-desc">あなたの自作WebサイトやWebポートフォリオのURLを入力してください。</p>
                    
                    <form action="{{ route('editProfile') }}" id="ProfileModForm_addPortfolio" method="post">
                        @csrf
                        <input type="hidden" name="updateMethod" value="addPortfolio">
                        <div class="add-portfolio-box">
                            <input name="newURL" value="https://" pattern="https?://.*" type="url" id="newURL" required placeholder="https://your-portfolio-site.com">
                            <button type="submit" class="btn-add-portfolio">＋ サイトを追加する</button>
                        </div>
                    </form>
                </div>

                <!-- Registered Portfolios List -->
                <div class="dashboard-section-card">
                    <h2 class="dashboard-card-title">
                        <span>登録中のポートフォリオ</span>
                        <span style="font-size: 14px; font-weight: 600; color: var(--color-primary);">{{ count($portfolios) }} 件</span>
                    </h2>
                    <p class="dashboard-card-desc">所有者認証を完了すると、一般公開・検索対象となります。</p>

                    @if(count($portfolios) > 0)
                        @foreach ($portfolios as $portfolio)
                            <div class="user-portfolio-item">
                                <div class="portfolio-item-thumb">
                                    @if ($portfolio->icon_path == null)
                                        <img src="{{ asset('img/defaultPortfolioIcon.png') }}" alt="{{ $portfolio->title ?? 'Portfolio' }}" />
                                    @else
                                        <img src="{{ asset('portfolioimages/' . $portfolio->icon_path) }}" alt="{{ $portfolio->title ?? 'Portfolio' }}" />
                                    @endif
                                </div>
                                
                                <div class="portfolio-item-content">
                                    <h3 class="portfolio-item-title">{{ $portfolio->title ?? '（タイトル未設定）' }}</h3>
                                    <div class="portfolio-item-url">{{ $portfolio->url }}</div>
                                    
                                    <div>
                                        @if ($portfolio->verified_at == null)
                                            <span class="portfolio-status-badge status-unverified">⚠️ 所有者未認証（非公開）</span>
                                        @else
                                            <span class="portfolio-status-badge status-verified">✓ 認証完了（公開中）</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="portfolio-item-actions">
                                    <a href="/portfolio/mod/{{ $portfolio->id }}" class="btn-action-edit">認証・編集</a>
                                    
                                    <form action="{{ route('editProfile') }}" method="post" onsubmit="return confirm('本当に削除しますか？');" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="updateMethod" value="deletePortfolio">
                                        <input type="hidden" name="portfolioID" value="{{ $portfolio->id }}">
                                        <button type="submit" class="btn-action-delete">削除</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p style="text-align: center; color: #94A3B8; padding: 32px 0;">まだ登録されたポートフォリオはありません。上のフォームから追加してください。</p>
                    @endif
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
