@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/guide.css') }}?v={{ time() }}" rel="stylesheet">

<div class="container">
  <div class="justify-content-center">
    <div class="guide-card animate-box-up">
      <h1 class="guide-title">ご利用ガイド</h1>

      <div class="guide-accordion">
        
        <!-- 登録 -->
        <div class="guide-accordion-item">
          <input type="checkbox" id="content1" class="switcher" checked />
          <label for="content1">1. 会員登録の方法</label>
          <div class="guide-content">
            <p>画面右上の「会員登録」をクリックします。</p>
            <img class="guide-img-half" src="{{asset('img/guide/1.png')}}" alt="会員登録ボタン"><br>
            <p>メールアドレスとパスワードを入力し、利用規約とプライバシーポリシーを確認のうえ「アカウント作成」をクリックします。</p>
            <img class="guide-img-half" src="{{asset('img/guide/2.png')}}" alt="アカウント作成フォーム"><br>
            <p>登録完了後、認証メールが送信されます。メールボックスを確認しましょう。</p>
            <img class="guide-img-half" src="{{asset('img/guide/3.png')}}" alt="認証メール"><br>
            <p>「メールアドレスを認証」ボタンをクリックすると登録手続きが完了します。</p>
          </div>
        </div>

        <!-- ログイン -->
        <div class="guide-accordion-item">
          <input type="checkbox" id="content2" class="switcher" />
          <label for="content2">2. ログイン</label>
          <div class="guide-content">
            <p>画面右上の「ログイン」をクリックします。</p>
            <img class="guide-img-half" src="{{asset('img/guide/4.png')}}" alt="ログインボタン"><br>
            <p>ご登録のメールアドレスとパスワードを入力してログインしてください。</p>
            <img class="guide-img-half" src="{{asset('img/guide/5.png')}}" alt="ログインフォーム">
          </div>
        </div>

        <!-- パスワードリセット -->
        <div class="guide-accordion-item">
          <input type="checkbox" id="content3" class="switcher" />
          <label for="content3">3. パスワードをお忘れの場合</label>
          <div class="guide-content">
            <p>ログイン画面の下部にある「パスワードをお忘れですか？」リンクをクリックします。</p>
            <img class="guide-img-half" src="{{asset('img/guide/6.png')}}" alt="パスワードリセット"><br>
            <p>ご登録のメールアドレスを入力し、「パスワードリセットリンクを送信」をクリックします。</p>
            <img class="guide-img-half" src="{{asset('img/guide/7.png')}}" alt="メール送信"><br>
            <p>受信メール内の「パスワードリセット」ボタンをクリックします。</p>
            <img class="guide-img-half" src="{{asset('img/guide/8.png')}}" alt="メール内ボタン"><br>
            <p>新しいパスワードを入力して再設定を完了します。</p>
            <img class="guide-img-half" src="{{asset('img/guide/9.png')}}" alt="再設定画面">
          </div>
        </div>

        <!-- プロフィール画像更新 -->
        <div class="guide-accordion-item">
          <input type="checkbox" id="content4" class="switcher" />
          <label for="content4">4. プロフィール設定・画像変更</label>
          <div class="guide-content">
            <p>ログイン後、「マイページ」へアクセスします。「ファイルを選択」をクリックしてプロフィール画像を選び、「アップロード」をクリックしてください。</p>
            <img class="guide-img-half" src="{{asset('img/guide/10.png')}}" alt="画像更新"><br>
            <p>お名前や自己紹介文もマイページからいつでも変更可能です。</p>
          </div>
        </div>

        <!-- ポートフォリオ追加・認証 -->
        <div class="guide-accordion-item">
          <input type="checkbox" id="content5" class="switcher" />
          <label for="content5">5. ポートフォリオの追加と所有者認証</label>
          <div class="guide-content">
            <p>マイページの「新規ポートフォリオ登録」フォームに、公開したいWebサイトのURL、タイトル、詳細、職種を入力して登録します。</p>
            <p>登録後、所有者確認のために認証用HTMLファイルをダウンロードし、ご自身のWebサーバーへ配置して「認証」を実行してください。</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
