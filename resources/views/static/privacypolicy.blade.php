@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/privacypolicy.css') }}" rel="stylesheet">
<div class="container">
<div class="justify-content-center">
  <div class="OSCSS-content-box">
    <div class="OSCSS-content-box-inner">
      <h2 class="animate-box-up">プライバシーポリシー</h2>
      <hr>
      <p>Portfolio Network（以下「本サービス」）では、個人情報を個人の重要な財産と認識し、厳重に保護・管理するよう努めております。</p>
      <h3>個人情報の収集について</h3>
<p>個人情報とは、本サービスを利用するお客様（以下「利用者」）から取得する氏名、メールアドレス、その他特定の個人を識別することができる情報を指します。</p>
<h3>個人情報の利用目的について</h3>
<p>本サービスは、利用者の個人情報を以下の目的で利用することができるものとします。</p>

<p>本サービスの利用に伴う本人確認のため<br>
本サービスへのお問い合わせやご意見への対応<br>
システムの維持、不具合対応、その他本サービスの運営上必要な事項の通知<br>
登録フォーム、プロフィールページやポートフォリオページで登録した情報の掲載<br>
ポートフォリオにおける登録など利用者が作成した情報の掲載<br>
メールマガジンの配信や、本サービスに関するお知らせ、その他情報の発信<br>
アンケートの実施や、統計情報の開示など本サービスの改善等に役立てるため<br>
本サービス内でのアクセス履歴などを活用した広告の配信のため</p>
<h3>個人情報の保護について</h3>
<p>利用者の個人情報の第三者への提供について、以下の何れかに該当する場合を除き、第三者に提供することはありません。</p>

<p>利用者の事前の同意・承諾を得た場合。<br>
人の生命、身体、健康、財産保護のために必要な場合であって、利用者の同意を取得することが困難な場合<br>
合併、事業譲渡その他の事由による事業の承継の際に、事業を承継する者に対して開示する場合<br>
公的機関からの要請があった場合<br>
その他法令等により提供が必要と判断した場合</p>
<h3>個人情報の訂正・削除について</h3>
<p>利用者から個人情報の訂正、追加、削除、利用の停止、消去を求められた場合、ご本人であることを確認させていただいた上で、合理的な期間内に対応を行います。</p>

<h3>プライバシーポリシーの更新について</h3>
<p>本サービスは、個人情報保護を図るため、法令等の変更や必要に応じて、プライバシーポリシーを改訂することがあります。その際は、最新のプライバシーポリシーを本サービスのウェブサイト内に掲載いたします。</p>

<h3>免責</h3>
<p>以下の場合は、本サービスでは何らの責任を負いません。</p>

<p>利用者が本サービス上に入力した情報等により、個人が識別できてしまった場合<br>
利用者を識別できる情報（メールアドレスやパスワード）を第三者が入手、利用した場合</p>
<h3>お問い合わせ先</h3>
<p>本プライバシーポリシーに関するお問い合わせは、下記連絡先にお問い合わせ下さい。</p>

<p>{{config('app.sender_address')}}</p>
    </div>  
  </div>
</div>
</div>
@endsection
