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
画面右上の「会員登録」をクリックしましょう。

メールアドレスとパスワード入力して、利用規約とプライバシーポリシーを確認し、「ア
カウント作成」をクリックしましょう。
上記の手続き完了したら、認証メールが送信されます。
メール確認しましょう。

「メールアドレスを認証」ボタンをクリックして、登録手続き完了しましょう。
    </div>
</div>

<div class="OSCSS-content-list">
    <h3><label for="content2">ログイン</label></h3>
    <input type="checkbox" id="content2" class="switcher" />
    <div class="listcontents">
      画面右上の「ログイン」をクリックしましょう。

メールアドレスとパスワードを記入してログインしましょう。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content3">パスワードリセット</label></h3>
    <input type="checkbox" id="content3" class="switcher" />
    <div class="listcontents">
      「ログイン」ボタンの下にある、「パスワードを忘れた方はこちら」のリンクをクリックしましょう。

登録した「メールアドレス」を記入して、「パスワードリセットリンクを送信」をクリックしましょう。
メールが送信されます。メール確認しましょう。

「パスワードリセット」をクリックしましょう。

開かれたページで、新しい「パスワード」を記入し、「パスワードリセット」をクリックし、設定しましょう。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content4">プロフィール画像更新</label></h3>
    <input type="checkbox" id="content4" class="switcher" />
    <div class="listcontents">
      「マイページ」へアクセスしましょう。

「ファイルを選択」をクリックして、ファイルを選びましょう。
その後、「アップロード」をクリックしましょう。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content5">ユーザ名更新</label></h3>
    <input type="checkbox" id="content5" class="switcher" />
    <div class="listcontents">
      「マイページ」へアクセスしましょう。

一般公開用のユーザ名を記入して、「ユーザ名を変更する」をクリックしましょう。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content6">自己紹介更新</label></h3>
    <input type="checkbox" id="content6" class="switcher" />
    <div class="listcontents">
      「マイページ」へアクセスしましょう。

一般公開用の自己紹介を記入して、「自己紹介を変更する」をクリックしましょう。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content7">ポートフォリオを登録</label></h3>
    <input type="checkbox" id="content7" class="switcher" />
    <div class="listcontents">
      「マイページ」へアクセスしましょう。

ポートフォリオのURLを記入し、「サイトを追加する」をクリックしましょう。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content8">ポートフォリオ画像更新</label></h3>
    <input type="checkbox" id="content8" class="switcher" />
    <div class="listcontents">
    「マイページ」へアクセスしましょう。
登録ポートフォリオの「認証・編集する」をクリックしましょう。

「ファイルを選択」をクリックして、ファイルを選びましょう。
その後、「アップロード」をクリックしましょう。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content9">ポートフォリオタイトル更新</label></h3>
    <input type="checkbox" id="content9" class="switcher" />
    <div class="listcontents">
      「マイページ」へアクセスしましょう。
登録ポートフォリオの「認証・編集する」をクリックしましょう。

ポートフォリオのタイトルを記入して、「タイトル名を変更する」をクリックしましょう。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content10">ポートフォリオ詳細内容更新</label></h3>
    <input type="checkbox" id="content10" class="switcher" />
    <div class="listcontents">
      「マイページ」へアクセスしましょう。
登録ポートフォリオの「認証・編集する」をクリックしましょう。

ポートフォリオの詳細内容を記入して、「詳細内容を変更する」をクリックしましょう。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content11">ポートフォリオタイプ更新</label></h3>
    <input type="checkbox" id="content11" class="switcher" />
    <div class="listcontents">
      「マイページ」へアクセスしましょう。
登録ポートフォリオの「認証・編集する」をクリックしましょう。</p>

ポートフォリオのタイプを選択して、「タイプを変更する」をクリックしましょう。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content12">ポートフォリオ認証</label></h3>
    <input type="checkbox" id="content12" class="switcher" />
    <div class="listcontents">
    「マイページ」へアクセスしましょう。
登録ポートフォリオの「認証・編集する」をクリックしましょう。

認証用ファイルをダウンロードしましょう。

このようにhtmlファイルがダウンロードされます。
このファイルを登録されたドメインの配下に設置しましょう。
※「http://abc.com/」で登録された場合、「http://abc.com/xxxxxxxxxxxxxxxx.html」になるように設置しましょう。

設置完了後、「今すぐ認証する」をクリックしましょう。
成功した場合、このように表示されます。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content13">ポートフォリオ表示の切り替え</label></h3>
    <input type="checkbox" id="content13" class="switcher" />
    <div class="listcontents">
    ポートフォリオが認証後、表示・非表示が選択できるようになります。
※認証未完了の場合、まず認証しましょう。
「マイページ」へアクセスしましょう。
登録ポートフォリオの「認証・編集する」をクリックしましょう。

「表示」の項目をクリックしましょう。
※「非表示」と「表示」を選択できます。
    </div>
</div>
<div class="OSCSS-content-list">
    <h3><label for="content14">退会</label></h3>
    <input type="checkbox" id="content14" class="switcher" />
    <div class="listcontents">
      「マイページ」へアクセスしましょう。

「退会したい方はこちら」をクリックしましょう。

内容確認の上、「退会」または「いいえ」を選択しましょう。
    </div>
</div>
    </div>  
  </div>
</div>
</div>
@endsection
