{{--
 /**
   * 就プレ　EYERESERVE ユーザ側
   * ポータル画面
   *
   * @author 
   *
   * ファイル名=orderEnd.blade.php
   * ディレクトリ=/ph34/eyereserve/resources/views/user
   */
--}}

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="">
  <title>事前注文完了  | EYERESERVE</title>
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/reset.css">
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/order.css">
  <script src="/ph34/eyereserve/resources/js/jquery-3.3.1.min.js"></script>
  <!-- 自分のjs -->
  <!-- <script src="/ph34/eyereserve/resources/js/potal.js"></script> -->
</head>
<body>
  <!-- ヘッダー -->
  <header>
    <!-- 右上のリンク -->
    <div id="small">
      <p><small><a href="">ヘルプ/お問い合わせ</a></small></p>
      <p><small><a href="">はじめての方へ</a></small></p>
    </div>
    <!-- ナビゲーション -->
    <nav>
      <!-- ロゴ -->
      <div id="logo">
        <h1><a href="/ph34/eyereserve/public/goPortal"><img src="/ph34/eyereserve/public/image/logo.png" alt="ロゴ"></a></h1>
      </div>  
      <ul>
        <li><a href="">アウトレットモール</a></li>
        <li><a href="">
          <div id="unreadMessageCount">
            <img src="/ph34/eyereserve/public/image/mail_icon.png" alt="メールアイコン">
          </div>
        </a></li>
        <li><a href="" id="user">{{ $userName }}様</a></li>
        <li><a href=""><span style="font-size:larger">{{ $point }}</span>ポイント</a></li>
        <li><a href="/ph34/eyereserve/public/logout">ログアウト</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <!-- コンテンツ -->
    <div id="main">
      <h1>ありがとうございました！</h1>
      <h2>注文番号：{{ $orderId }}でご注文を承りました。</h2>
      <p>商品の準備が整いましたら担当のものからメールにてご連絡させて戴きます。</p>
    </div>
  </main>

  <!-- フッター -->
  <footer>
    <div id="fWrapper">
      <div id="fInner">
        <div id="fService">
          <ul>
            <li class="title"><a href="">EYERESERVE</a></li>
          </ul>
        </div>
        <div id="fSitemap">
          <ul>
            <li class="title"><a href="">アウトレットモール</a></li>
            <li><a href="">ショップランキング</a></li>
            <li><a href="">アイテムランキング</a></li>
            <li><a href="">今週のランキング</a></li>
            <li><a href="">カテゴリ一覧</a></li>
            <li><a href="">ショップ一覧</a></li>
          </ul>
          <ul>
            <li class="title"><a href="">探す</a></li>
            <li><a href="">おすすめのお店</a></li>
            <li><a href="">ショップ一覧</a></li>
            <li><a href="">カテゴリ一覧</a></li>
            <li><a href="">ショップランキング</a></li>
            <li><a href="">アイテムランキング</a></li>
          </ul>
          <ul>
            <li class="title"><a href="">知る</a></li>
            <li><a href="">マイページ</a></li>
            <li><a href="">キャンペーン一覧</a></li>
            <li><a href="">お知らせ一覧</a></li>
          </ul>
        </div>
        <div id="fMember">  
          <ul>
            <li><a href="">EYE会員</a></li>
          </ul>
        </div>
        <div id="fHelp">
          <ul>
            <li><a href="">ヘルプ</a></li>
            <li><a href="">初めての方へ</a></li>
            <li><a href="">お問い合わせ</a></li>
          </ul>
        </div>
        <div id="fMoble">
          <ul>
            <li><a href="">モバイル専用サイト</a></li>
            <li><a href="">Twitter</a></li>
            <li><a href="">Instagram</a></li>
            <li><a href="">LINE</a></li>
          </ul>
        </div>
      </div>
      <div id="fCorporate">
        <ul>
          <li><a href="">コーポレートサイト</a></li>
          <li><a href="">会社概要</a></li>
          <li><a href="">IR情報</a></li>
          <li><a href="">採用情報</a></li>
          <li><a href="">利用規約</a></li>
          <li><a href="">プライバシーポリシー</a></li>
        </ul>
        <p><small>&copy;HAL大阪</small></p>
      </div>
    </div>
  </footer>
</body>
</html>