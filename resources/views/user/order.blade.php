{{--
 /**
   * 就プレ　EYERESERVE ユーザ側
   * ポータル画面
   *
   * @author 
   *
   * ファイル名=order.blade.php
   * ディレクトリ=/ph34/eyereserve/resources/views/user
   */
--}}

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="">
  <title>事前注文  | EYERESERVE</title>
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
    @isset($validationMsgs)
      <section id="errorMsg">
        <p>以下のメッセージをご確認下さい。</p>
        <ul>
          @foreach($validationMsgs as $msg)
          <li>{{$msg}}</li>
          @endforeach
        </ul>
      </section> 
    @endisset

    <!-- コンテンツ -->
    <div id="main">
      <p>
        店名：{{ $store->getStoreName() }}
      </p>
      <form enctype="multipart/form-data" action="/ph34/eyereserve/public/oredrConfirm/{{ $store->getStoreId() }}" method="POST">
      @csrf
        <!-- メーカー・ブランド -->
        <label for="">メーカー・ブランド&nbsp;<span class="required">必須</span></label>
        <p>※わからない場合は「不明」と入力してください。</p>
        <input type="text" name="maker" id="maker" value="{{$order->getMaker()}}" placeholder="例）カルビー" required><br>
        <!-- 商品名 -->
        <label for="">商品名&nbsp;<span class="required">必須</span></label>
        <p>※わからない場合は「不明」と入力してください。</p>
        <input type="text" name="product" id="product" value="{{$order->getProduct()}}" placeholder="例）ポテトチップスうすしお味" required><br>
        <!-- 個数 -->
        <label for="">個数&nbsp;<span class="required">必須</span></label>
        <p>※個数の単位も入力してください</p>
        <input type="text" name="quantity" id="quantity" value="{{$order->getQuantity()}}" placeholder="例）1ケース" required><br>
        <!-- 商品の説明 -->
        <label for="">商品の説明&nbsp;任意</label>
        <p>※できるだけ詳細に入力してください。</p>
        <textarea name="description" id="description" cols="30" rows="10">{{$order->getDescription()}}</textarea><br>
        <!-- 商品の画像 -->
        <label for="">商品の画像&nbsp;任意</label>
        <p>※画像がある方はできるだけ送ってください。</p>
        <input type="file" name="image" id="image"><br>
        <!-- カスタマーID -->
        <input type="hidden" name="customerId" id="customerId" value="{{ $customerId }}">
        <!-- 送信ボタン -->
        <input type="submit" name="order-submit" value="送信する">
      </form>
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