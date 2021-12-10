@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/myprofile.css') }}" rel="stylesheet">
<script src="{{ asset('js/filechecker.js') }}" defer></script>
<div class="container">
    <div class="justify-content-center">
      <h2>マイページ</h2>
      <div class="OSCSS-content-box">
        <div class="OSCSS-content-box-inner">
          <dl>
            <dt>
              <div class="OSCSS-profile-icon">
                @if ($user->icon_path == null)
                <img src="{{ asset('img/defaultProfileIcon.png') }}" width="150" height="150"/>
                @else
                <img src="{{ asset('userimages/'.$user->icon_path) }}" width="150" height="150"/>
                @endif
              </div>
            </dt>
            <dd>
              <form action="{{route('editProfile')}}" id="ProfileModForm_icon" method="post" enctype="multipart/form-data">
                @csrf
                <div style="display:none;">
                  <input type="hidden" name="updateMethod" value="iconupload">
                </div>
                <input type="file" id="file" name="file" class="form-control" required="required" accept="image/jpeg, image/png">
                <input name="submit" class="btn btn-primary OSCSS-btn50" type="submit" value="アップロード">
              </form>
            </dd>
          </dl>
          <dl>
            <dt>メールアドレス：</dt>
            <dd>{{$user->email}}<br><span class="note">※メールアドレスは非公開です。</span></dd>
          </dl>
          <form action="{{route('editProfile')}}" id="ProfileModForm_name" method="post" accept-charset="utf-8">
           @csrf
	    <dl>
	      <div style="display:none;">
	        <input type="hidden" name="updateMethod" value="editName">
	      </div>
	      <dt>ユーザー名：</dt>
              <dd>
                <input name="name" value="{{$user->name}}" class="c-text-input" type="text" id="UserName" required="required" onKeyup="this.value=this.value.replace('@','')">
	        <input name="submit" class="btn btn-primary OSCSS-btn50" type="submit" value="ユーザー名を変更する">
	      </dd>
            </dl>
          </form>
          <dl>
            <dt>自己紹介：</dt>
            <dd>
              <form action="{{route('editProfile')}}" id="ProfileModForm_description" method="post" accept-charset="utf-8">
              @csrf
                <div style="display:none;">
	          <input type="hidden" name="updateMethod" value="editDescription">
	        </div>
	        <textarea rows="5" cols="60" name="description" type="text" id="userDescription" required="required" placeholder="自己紹介" maxlength="5000">{{$user->description}}</textarea>
	        <input name="submit" class="btn btn-primary OSCSS-btn50" type="submit" value="自己紹介を変更する">
	      </form>        
            </dd>
          </dl>
          
          
          <dl>
            <a class="OSCSS-profile-revoke" href="{{route('revoke_request')}}">退会したい方はこちら</a>
          </dl>
          <h2 class="OSCSS-subtitle">登録ポートフォリオ</h2>
	  <div class="OSCSS-profile-portfolio-list">
	    @foreach ($portfolios as $portfolio)
	    <div class="OSCSS-profile-portfolio-left">
	      <div class="OSCSS-profile-portfolio-pic">
                @if ($portfolio->icon_path == null)
                <img src="{{ asset('img/defaultPortfolioIcon.png') }}" width="300" height="200"/>
                @else
                <img src="{{ asset('portfolioimages/'.$portfolio->icon_path) }}" width="150" height="150"/>
                @endif
              </div>
	    </div>
	    <div class="OSCSS-profile-portfolio-right">
	      <table class="OSCSS-portfolio-table">
	        <tr><td>タイトル</td><td>{{$portfolio->title}}</td></tr>
	        <tr><td>詳細内容</td><td class="OSCSS-profile-portfolio-desc">{{$portfolio->description}}</td></tr>
	        <tr><td>URL</td><td>{{$portfolio->url}}</td></tr>
	        <tr><td>タイプ</td><td>{{$portfolioTypes[$portfolio->type]}}</td></tr>
	        <tr>
                  <td>所有者認証</td>
                  @if ($portfolio->verified_at == null)
	          <td>未完了<br></td>
                  @else
	          <td>認証済</td>
                  @endif
	        </tr>
	      </table>
	      @if ($portfolio->verified_at == null)
	      <span class="note">※未完了の場合ポートフォリオはされません。</span>
	      @endif
	      
	      <form action="{{route('editProfile')}}" id="ProfileModForm_deletePortfolio" method="post" accept-charset="utf-8">
             @csrf
               <a href="/portfolio/mod/{{$portfolio->id}}" class="btn btn-primary OSCSS-btn-portfolio">認証．編集する</a>
	        <div style="display:none;">
	          <input type="hidden" name="updateMethod" value="deletePortfolio">
	          <input type="hidden" name="portfolioID" value="{{$portfolio->id}}">
	        </div>
	        <input name="submit" class="btn btn-secondary OSCSS-btn50" type="submit" value="削除する">
	      </form>
	    </div>
	    <hr>
	    @endforeach
          </div>
          <div class="OSCSS-profile-portfolio-new">
	    <form action="{{route('editProfile')}}" id="ProfileModForm_addPortfolio" method="post" accept-charset="utf-8">
             @csrf
	      <dl>
	        <div style="display:none;">
	          <input type="hidden" name="updateMethod" value="addPortfolio">
	        </div>
	        <dt>サイトURL：</dt>
                <dd>
                  <input name="newURL" value="http://" class="c-text-input" pattern="https?://.*" type="text" id="newURL" required="required">
	          <input name="submit" class="btn btn-primary OSCSS-btn50" type="submit" value="サイトを追加する">
	        </dd>
              </dl>
            </form>
          </div>
	</div>
      </div>
    </div>
</div>

	
@endsection
