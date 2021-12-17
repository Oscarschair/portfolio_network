@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/editportfolio.css') }}?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet">
<script src="{{ asset('js/filechecker.js') }}" defer></script>
<div class="container">
    <div class="justify-content-center">
      @if ($portfolio->user_id == $user -> id)
      <h2>ポートフォリオ認証．編集</h2>
      <div class="OSCSS-content-box">
        <div class="OSCSS-content-box-inner">
          <dl>
            <dt>
              <div class="OSCSS-portfolio-icon">
              <div class="OSCSS-portfolio-icon-inner">
                @if ($portfolio->icon_path == null)
                <img src="{{ asset('img/defaultPortfolioIcon.png') }}" width="150" height="150"/>
                @else
                <img src="{{ asset('portfolioimages/'.$portfolio->icon_path) }}" width="150" height="150"/>
                @endif
              </div>
              </div>
            </dt>
            <dd>
              <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_icon" method="post" enctype="multipart/form-data">
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
            <dt>URL：</dt>
            <dd>{{$portfolio->url}}</dd>
          </dl>
          <dl>
            <dt>タイトル：</dt>
            <dd>
              <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_title" method="post" accept-charset="utf-8">
              @csrf
                <div style="display:none;">
	          <input type="hidden" name="updateMethod" value="editTitle">
	        </div>
	        <input name="title" value="{{$portfolio->title}}" class="c-text-input" type="text" id="portfolioTitle" required="required" placeholder="タイトル" maxlength="100">
	        <input name="submit" class="btn btn-primary OSCSS-btn50" type="submit" value="タイトル名を変更する">
	      </form>
	    </dd>
          </dl>
          <dl>
            <dt>詳細内容：</dt>
            <dd>
              <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_description" method="post" accept-charset="utf-8">
              @csrf
                <div style="display:none;">
	          <input type="hidden" name="updateMethod" value="editDescription">
	        </div>
	        <textarea rows="5" cols="60" name="description" type="text" id="portfolioDescription" required="required" placeholder="詳細内容" maxlength="5000">{{$portfolio->description}}</textarea>
	        <input name="submit" class="btn btn-primary OSCSS-btn50" type="submit" value="詳細内容を変更する">
	      </form>        
            </dd>
          </dl>
          <dl>
            <dt>タイプ：</dt>
            <dd>
              <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_type" method="post" accept-charset="utf-8">
              @csrf
                <div style="display:none;">
	          <input type="hidden" name="updateMethod" value="editType">
	        </div>
	        <select name="type" id="portfolioType">
		@for($i = 0; $i < Count($portfolioTypes); $i++)
		  @if ($i == $portfolio->type)
		  <option value="{{$i}}" selected>{{$portfolioTypes[$i]}}</option>
		  @else
		  <option value="{{$i}}">{{$portfolioTypes[$i]}}</option>
		  @endif
		@endfor
	        </select>
	        <input name="submit" class="btn btn-primary OSCSS-btn50" type="submit" value="タイプを変更する">
	      </form>        
            </dd>
          </dl>
          <dl>
            <dt>認証：</dt>
            @if ($portfolio->verified_at == null)
            <dd>
            未完了&emsp;&emsp;
            @if ($portfolio->failed_at != null)
            (認証失敗 :{{$portfolio->failed_message}} {{$portfolio->failed_at}})
            @endif
            <br>
            <span class="note">※未完了の場合ポートフォリオはされません。</span>
            <div class="OSCSS-double-btn">
              <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_authenticateNow" method="post" accept-charset="utf-8">
              @csrf
                <div style="display:none;">
	          <input type="hidden" name="updateMethod" value="authenticateNow">
	        </div>
	        <input name="submit" class="btn btn-primary" type="submit" value="今すぐ認証する">
	      </form>  
              <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_downloadAuthentication" method="post" accept-charset="utf-8">
              @csrf
                <div style="display:none;">
	          <input type="hidden" name="updateMethod" value="downloadAuthentication">
	        </div>
	        <input name="submit" class="btn btn-light " type="submit" value="認証用ファイルをダウンロードする">
	      </form>
	    </div>
            </dd>
            @else
            <dd>{{$portfolio->verified_at}} 認証済</dd>
            @endif
          </dl>
          @if ($portfolio->verified_at != null)
          <dl>
            <dt>表示：</dt>
            <dd>
	      
	      <form action="{{ route('editPortfolio', ['id' => $portfolio->id])}}" id="PortfolioModForm_switchDisplay" method="POST">
              @csrf
                <div style="display:none;">
	          <input type="hidden" name="updateMethod" value="switchDisplay">
	        </div>
                <div class="switchArea">
	          @if ($portfolio->display_flag)
	          <input type="checkbox" id="displaySwitcher" name="displaySwitcher" onclick="document.getElementById('PortfolioModForm_switchDisplay').submit();" checked>
	          @else
	          <input type="checkbox" id="displaySwitcher" name="displaySwitcher" onclick="document.getElementById('PortfolioModForm_switchDisplay').submit();">
	          @endif
	          <label for="displaySwitcher"><span></span></label>
	          <div id="swImg"></div>
	        </div>
	      </form>
	      
            </dd>
          </dl>
          @endif
	</div>
      </div>
      @else
      <div class="OSCSS-content-box">
        <div class="OSCSS-content-box-inner" style="text-align: center;">
          ポートフォリオを編集する権限を持っておりません、別のアカウントでログインしてお試しください。<br><br>
          <a class="OSCSS-nav-item" href="http://localhost:8000/logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
        </div>
      </div>
      @endif
    </div>
</div>

	
@endsection
