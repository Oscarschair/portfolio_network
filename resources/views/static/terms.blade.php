@extends('layouts.app')

@section('content')
@inject('dateLib', 'App\Libs\DateLib')
<link href="{{ asset('css/terms.css') }}" rel="stylesheet">
<div class="container">
<div class="justify-content-center">
  <div class="OSCSS-content-box">
    <div class="OSCSS-content-box-inner">
      <h2 class="animate-box-up">利用規約</h2>
      <hr>
      <p>Portfolio Network（以下「本サービス」）の利用につきましては、本利用規約（以下「本規約」）に必ず同意のうえご利用ください。</p>
      <h3>第1条 利用規約の適用</h3>
      <p>本規約は、本サービスの運営者（以下「事務局」）と、本サービスを利用する全てのお客様（以下「利用者」）との間の一切の関係に適用されます。<br>
      利用者が本サービスを利用したときは、本規約の内容に同意したものとみなされます。</p>
      <h3>第2条 定義</h3>
      <p>
        本規約において使用する用語は、以下に定める意味を有するものとします。<br>
                 「本サービス」とは、ご自身のポートフォリオサイトを共有プラットフォームへ登録することによって、不特定多数の方に共有することを可能にするPortfolio Networkという名称のサービスを意味します。<br>
                 「会員」とは、本サービスにアカウント登録をした利用者を意味します。<br>
                 「非会員」とは、本サービスにアカウント登録をしていない利用者を意味します。<br>
                 「会員情報」とは、ID、メールアドレス、パスワード、氏名、プロフィール画像など会員が本サービスへのアカウント登録および本サービスの利用に際して事務局に提供するすべての情報を意味します。<br>
                 「アカウント」とは、本サービスを利用する権利を意味します。<br>
                 「プロフィール情報」とは、会員名、自己紹介、プロフィール画像など利用者がプロフィールページにて確認可能なすべての情報を意味します。<br>
                 「登録ポートフォリオ」とは、会員がご自身が所有し、プロフィールで登録しているポートフォリオサイトのことを意味し、全ての利用者が登録ポートフォリオを閲覧することができます。ポートフォリオサイトの登録は、所有者認証の手続きが必須となります。</p>
      <h3>第3条 サービスの利用</h3>
      <p>本サービスの利用を希望する者は、本規約を遵守することに同意し、かつ事務局の定める一定の会員情報を事務局の定める方法で提供することにより、アカウント登録（本サービスの利用の登録）を申請することができます。<br>
      本サービスの利用を希望する者および会員は、登録の申請にあたり、真実、正確かつ最新の情報を提供しなければなりません。</p>
      <h3>第4条 メールアドレスおよびパスワード</h3>
      <p>本サービスの利用を希望する者および会員は、使用可能なメールアドレスを登録メールアドレスとして登録しなければなりません。<br>
      メールアドレスおよびパスワードの第三者による不正利用等による損害の責任は会員が負うものとし、事務局は一切の責任を負いません。<br>
      会員は、登録メールアドレスおよびパスワードとそれに紐づくアカウントを第三者に譲渡、使用させることはできません。</p>
      <h3>第5条 プロフィールの公開範囲</h3>
      <p>会員は、自らのプロフィールについて、会員、非会員を含むすべてのご利用者が閲覧可能となっており、全てのプロフィール情報が「公開」となっていることに予め同意するものとし、プロフィールの公開により発生した損害について事務局は一切の責任を負わないものとします。</p>
      <h3>第6条 登録ポートフォリオの公開範囲</h3>
      <p>会員は、自らの登録ポートフォリオについて、URL以外の情報は、会員、非会員を含むすべてのご利用者が閲覧可能となっており、URL情報は会員のみが閲覧可能となっており、全ての登録ポートフォリオ情報が「公開」となっていることに予め同意するものとし、登録ポートフォリオの公開により発生した損害について事務局は一切の責任を負わないものとします。</p>
      <h3>第7条 退会</h3>
      <p>会員が本サービスを退会する際は、事務局の定める所定の方法で退会申請をし、事務局で退会情報が確認できた時点で退会申請を承諾したものとします。</p>
      <h3>第8条 禁止行為</h3>
      <p>会員は、本サービスの利用にあたり、故意または過失を問わず、以下のいずれかに該当する行為またはこれらを助長する行為をしてはいけません。<br>
      尚、会員の行為がいずれかに該当、または該当する恐れがあると事務局が判断した場合は、会員に事前に通知することなく、当該情報の全部または一部を削除することができるものとし、それに基づき会員に発生した損害について一切の責任を負いません。</p>

      <p>
      法令又は公序良俗に違反する行為<br>
      事務局、会員、外部SNS事業者、その他第三者の著作権、肖像権等の知的財産権、プライバシー、名誉を侵害する行為<br>
      犯罪行為、反社会的行為を暗示・誘発・助長する行為、その他犯罪に関連する行為、またこれらを指南する行為<br>
      営利目的や宗教への勧誘を目的とした行為<br>
      風俗営業、売春、アダルト、ポルノ、その他これらに関連する内容の情報を投稿、送信、掲載する行為<br>
      異性交際を目的とした本サービスの利用、またそれに関する情報を投稿、送信、掲載する行為<br>
      人種、民族、性別、社会的身分等を根拠にする差別的表現を含む情報を投稿、送信、掲載する行為<br>
      利用者が不快に感じる画像、動画、文章を投稿、送信、掲載する行為<br>
      コンピュータウィルスその他の有害なコンピュータプログラムを含む情報を投稿、送信、掲載する行為<br>
      本サービスの運営やネットワーク・システムに支障を与える行為<br>
      他者になりすまして本サービスを利用する行為<br>
      根拠のない不確かな情報を投稿、送信、掲載する行為<br>
      その他、事務局が不適切と判断する行為</p>
      <h3>第9条 サービスの利用停止</h3>
      <p>会員が以下のいずれかに該当すると事務局が判断した場合は、会員に事前に通知することなく、本サービスの利用停止やアカウントの削除（強制退会）できるものとし、それに基づき会員に発生した損害について一切の責任を負いません。</p>
      <p>
      本規約等に反する行為があった場合<br>
      会員情報に虚偽の事実があることが判明した場合<br>
      連続して1年間ログインが確認できなかった場合<br>
      その他、事務局が不正と判断する事由があった場合
      </p>
      <h3>第10条 サービスの停止・中断</h3>
      <p>以下のいずれかに該当する場合には、会員に事前に通知することなく、本サービスの全部または一部を停止、中断できるものとし、それに基づき会員に発生した損害について一切の責任を負いません。</p>
      <p>本サービスにかかるサーバの保守、システムの点検を行う場合<br>
      コンピュータ、通信回線等が事故により停止した場合<br>
      天災地変、その他非常事態が発生し、本サービスの運営ができなくなった場合<br>
      外部SNSサービス等に、トラブル、サービスの変更、中断、停止等が生じた場合<br>
      本サービスの内容や仕様の変更に伴うメンテナンスを行う場合<br>
      その他当社がやむを得ない事由により本サービスの停止、中断が必要と判断した場合<br>
      尚、本サービスは事務局の都合により、サービスの提供を終了することができるものとします。（事前に通知するものとします。）</p>

      <h3>第11条 免責</h3>
      <p>本サービスの利用中に会員が行ったダウンロード等により、会員が保有する機器の故障、情報の消失等、会員に発生した損害について、事務局は一切の責任を負わないものとします。<br>
      本サービスに掲載している情報および会員が登録・掲載する情報等について、その完全性、正確性、適用性、有用性等に関し、事務局は一切の責任を負わないものとします。<br>
      会員同士の間で何らかの紛争が発生した場合、全て当事者間で解決するものとし、事務局は一切の責任を負わないものとします。</p>
      <h3>第12条 利用規約の変更</h3>
      <p>事務局は、本規約を変更することができるものとします。本規約を変更した場合は、会員に当該変更内容を通知するものとし、当該変更内容の通知後に本サービスを利用した会員は、本規約の変更に同意したものとみなします。</p>

      <h3>第13条 秘密保持</h3>
      <p>利用者は、本サービスに関連して事務局が利用者に対して秘密に取り扱うことを求めて開示した非公知の情報について、事務局の事前の書面による承諾がある場合を除き、秘密に取り扱うものとし、第三者に開示することはできないものとします。</p>

      <h3>第14条 有効期間</h3>
      <p>利用契約は、登録メンバーについて第3条に基づく登録が完了した日に効力を生じ、当該会員が退会した日、登録が取り消された日または本サービスの提供が終了した日のいずれか早い日まで、事務局と会員との間で有効に存続するものとします。</p>

      <h3>第15条 利用規約の譲渡等</h3>
      <p>会員は、事務局の書面による事前の承諾なく、利用契約上の地位又は本規約に基づく権利もしくは義務につき、第三者に対し、譲渡、移転、担保設定、その他の処分をすることはできません。<br>
      事務局は、本サービスにかかる事業を第三者に譲渡した場合には、当該事業譲渡に伴い利用契約上の地位、本規約に基づく権利及び義務並びに会員の会員情報その他の情報を当該事業譲渡の譲受人に譲渡することができるものとし、会員は、かかる譲渡につき本項において予め同意したものとします。なお、本項に定める事業譲渡には、通常の事業譲渡のみならず、会社分割その他事業が移転するあらゆる場合を含むものとします。</p>
      <h3>第16条 分離可能性</h3>
      <p>本規約の一部が、法令等により無効または執行不能と判断された場合であっても、本規約の残りの部分は有効とします。<br>
      本規約の一部が、ある利用者との関係で無効とされ、または取り消された場合でも、本規約はその他の利用者との関係では有効とします。</p>
      <h3>第17条 準拠法および裁判管轄</h3>
      <p>本規約の準拠法は日本法とし、本規約に起因しまたは関連する一切の紛争については、東京地方裁判所を第一審の専属的合意管轄裁判所とします。</p>
      <p>2021年12月9日　更新</p>
    </div>  
  </div>
</div>
</div>
@endsection
