@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/guide.css') }}" rel="stylesheet">
<div class="container">
<div class="justify-content-center">
  <div class="OSCSS-content-box">
    <div class="OSCSS-content-box-inner">
      <h2 class="animate-box-up">ご利用ガイド</h2>
      <hr>
<div class="OSCSS-content-list">
    <h3><label for="content1">登録</label></h3>
    <input type="checkbox" id="content1" class="switcher" />
    <div class="listcontents">
	画面右上の「会員登録」をクリックしましょう。<br>
	<img class="OSCSS-guide-img-50" src="{{asset('img/guide/1.png')}}"><br>
	メールアドレスとパスワード入力して、利用規約とプライバシーポリシーを確認し、「アカウント作成」をクリックしましょう。<br>
	<img class="OSCSS-guide-img-50" src="{{asset('img/guide/2.png')}}"><br>
	
	上記の手続き完了したら、認証メールが送信されます。<br>
	メール確認しましょう。<br>
	<img class="OSCSS-guide-img-50" src="{{asset('img/guide/3.png')}}"><br>
	「メールアドレスを認証」ボタンをクリックして、登録手続き完了しましょう。
    </div>
</div>

<div class="OSCSS-content-list">
    <h3><label for="content2">ログイン</label></h3>
    <input type="checkbox" id="content2" class="switcher" />
    <div class="listcontents">
      画面右上の「ログイン」をクリックしましょう。<br>
      <img class="OSCSS-guide-img-50" src="{{asset('img/guide/4.png')}}"><br>
      メールアドレスとパスワードを記入してログインしましょう。<br>
      <img class="OSCSS-guide-img" src="{{asset('img/guide/5.png')}}">
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content3">パスワードリセット</label></h3>
    <input type="checkbox" id="content3" class="switcher" />
    <div class="listcontents">
      「ログイン」ボタンの下にある、「パスワードを忘れた方はこちら」のリンクをクリックしましょう。<br>
      <img class="OSCSS-guide-img-50" src="{{asset('img/guide/6.png')}}"><br>
      登録した「メールアドレス」を記入して、「パスワードリセットリンクを送信」をクリックしましょう。<br>
      メールが送信されます。メール確認しましょう。<br>
      <img class="OSCSS-guide-img-50" src="{{asset('img/guide/7.png')}}"><br>
      「パスワードリセット」をクリックしましょう。<br>
      <img class="OSCSS-guide-img-50" src="{{asset('img/guide/8.png')}}"><br>
      開かれたページで、新しい「パスワード」を記入し、「パスワードリセット」をクリックし、設定しましょう。<br>
      <img class="OSCSS-guide-img-50" src="{{asset('img/guide/9.png')}}">
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content4">プロフィール画像更新</label></h3>
    <input type="checkbox" id="content4" class="switcher" />
    <div class="listcontents">
      「マイページ」へアクセスしましょう。<br>
      「ファイルを選択」をクリックして、ファイルを選びましょう。<br>
      <img class="OSCSS-guide-img" src="{{asset('img/guide/10.png')}}"><br>
      その後、「アップロード」をクリックしましょう。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content5">ユーザ名更新</label></h3>
    <input type="checkbox" id="content5" class="switcher" />
    <div class="listcontents">
      「マイページ」へアクセスしましょう。<br>
      一般公開用のユーザ名を記入して、「ユーザ名を変更する」をクリックしましょう。<br>
      <img class="OSCSS-guide-img" src="{{asset('img/guide/11.png')}}">
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content6">自己紹介更新</label></h3>
    <input type="checkbox" id="content6" class="switcher" />
    <div class="listcontents">
      「マイページ」へアクセスしましょう。<br>
      一般公開用の自己紹介を記入して、「自己紹介を変更する」をクリックしましょう。<br>
      <img class="OSCSS-guide-img" src="{{asset('img/guide/12.png')}}">
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content7">ポートフォリオを登録</label></h3>
    <input type="checkbox" id="content7" class="switcher" />
    <div class="listcontents">
      「マイページ」へアクセスしましょう。<br>
      ポートフォリオのURLを記入し、「サイトを追加する」をクリックしましょう。<br>
      <img class="OSCSS-guide-img" src="{{asset('img/guide/13.png')}}">
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content8">ポートフォリオ画像更新</label></h3>
    <input type="checkbox" id="content8" class="switcher" />
    <div class="listcontents">
    「マイページ」へアクセスしましょう。<br>
    登録ポートフォリオの「認証・編集する」をクリックしましょう。<br>
    <img class="OSCSS-guide-img" src="{{asset('img/guide/14.png')}}"><br>
      「ファイルを選択」をクリックして、ファイルを選びましょう。<br>
    <img class="OSCSS-guide-img" src="{{asset('img/guide/15.png')}}"><br>
    その後、「アップロード」をクリックしましょう。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content9">ポートフォリオタイトル更新</label></h3>
    <input type="checkbox" id="content9" class="switcher" />
    <div class="listcontents">
    「マイページ」へアクセスしましょう。<br>
    登録ポートフォリオの「認証・編集する」をクリックしましょう。<br>
    <img class="OSCSS-guide-img" src="{{asset('img/guide/14.png')}}"><br>
    ポートフォリオのタイトルを記入して、「タイトル名を変更する」をクリックしましょう。
    <img class="OSCSS-guide-img" src="{{asset('img/guide/16.png')}}">
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content10">ポートフォリオ詳細内容更新</label></h3>
    <input type="checkbox" id="content10" class="switcher" />
    <div class="listcontents">
    「マイページ」へアクセスしましょう。<br>
    登録ポートフォリオの「認証・編集する」をクリックしましょう。<br>
    <img class="OSCSS-guide-img" src="{{asset('img/guide/14.png')}}"><br>
    ポートフォリオの詳細内容を記入して、「詳細内容を変更する」をクリックしましょう。<br>
    <img class="OSCSS-guide-img" src="{{asset('img/guide/17.png')}}">
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content11">ポートフォリオタイプ更新</label></h3>
    <input type="checkbox" id="content11" class="switcher" />
    <div class="listcontents">
    「マイページ」へアクセスしましょう。<br>
    登録ポートフォリオの「認証・編集する」をクリックしましょう。<br>
    <img class="OSCSS-guide-img" src="{{asset('img/guide/14.png')}}"><br>
    ポートフォリオのタイプを選択して、「タイプを変更する」をクリックしましょう。
    <img class="OSCSS-guide-img" src="{{asset('img/guide/18.png')}}">
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content12">ポートフォリオ認証</label></h3>
    <input type="checkbox" id="content12" class="switcher" />
    <div class="listcontents">
    「マイページ」へアクセスしましょう。<br>
    登録ポートフォリオの「認証・編集する」をクリックしましょう。<br>
    <img class="OSCSS-guide-img" src="{{asset('img/guide/14.png')}}"><br>
    認証用ファイルをダウンロードしましょう。<br>
    <img class="OSCSS-guide-img" src="{{asset('img/guide/19.png')}}"><br>
    このようにhtmlファイルがダウンロードされます。<br>
    <img class="OSCSS-guide-img-25" src="{{asset('img/guide/20.png')}}"><br>
    このファイルを登録されたドメインの配下に設置しましょう。<br>
    ※「http://example.com/」で登録された場合、「http://example.com/xxxxxxxxxxxxxxxx.html」になるように設置しましょう。<br>
    設置完了後、「今すぐ認証する」をクリックしましょう。<br>
    <img class="OSCSS-guide-img" src="{{asset('img/guide/21.png')}}"><br>
    成功した場合、このように表示されます。<br>
    <img class="OSCSS-guide-img" src="{{asset('img/guide/22.png')}}">
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content13">ポートフォリオ表示の切り替え</label></h3>
    <input type="checkbox" id="content13" class="switcher" />
    <div class="listcontents">
    ポートフォリオが認証後、表示・非表示が選択できるようになります。
    ※認証未完了の場合、まず認証しましょう。<br>
    「マイページ」へアクセスしましょう。<br>
    登録ポートフォリオの「認証・編集する」をクリックしましょう。<br>
    <img class="OSCSS-guide-img" src="{{asset('img/guide/14.png')}}"><br>
    「表示」の項目をクリックしましょう。<br>
    <img class="OSCSS-guide-img" src="{{asset('img/guide/23.png')}}"><br>
    ※「非表示」と「表示」を選択できます。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content14">退会</label></h3>
    <input type="checkbox" id="content14" class="switcher" />
    <div class="listcontents">
    「マイページ」へアクセスしましょう。<br>
    「退会したい方はこちら」をクリックしましょう。<br>
    <img class="OSCSS-guide-img" src="{{asset('img/guide/24.png')}}"><br>
    内容確認の上、「退会」または「いいえ」を選択しましょう。<br>
    </div>
</div>
    </div>  
  </div>
</div>
</div>
@endsection
