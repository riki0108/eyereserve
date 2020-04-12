{{--
 /**
   * 就プレ　EYERESERVE　ストア側
   * 注文履歴画面
   *
   * @author 
   *
   * ファイル名=orderHistory.blade.php
   * ディレクトリ=/ph34/eyereserve/resources/views/store
   */
--}}

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="">
  <title>ストア側　注文履歴  | EYERESERVE</title>
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/reset.css">
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/storePortal.css">
  <script src="/ph34/eyereserve/resources/js/jquery-3.3.1.min.js"></script>

  <!-- 自分のjs -->
  <script src="/ph34/eyereserve/resources/js/potal.js"></script>

  <script>
  </script>
</head>
<body>
  <!-- ヘッダー -->
  <header>
    <!-- ナビゲーション -->
    <nav>
      <!-- ロゴ -->
      <div id="logo">
        <h1><a href="/ph34/eyereserve/public/goStorePortal"><img src="/ph34/eyereserve/public/image/logo.png" alt="ロゴ"></a></h1>
      </div>  
      <ul>
        <li><a href="/ph34/eyereserve/public/goStorePortal">1.注文一覧</a></li>
        <li><a href="/ph34/eyereserve/public/orderHistory"  style="color:white;background-color:#87ceeb">2.注文履歴</a></li>
        <li><a href="">3.来店スケジュール</a></li>
        <li><a href="">4.メッセージ一覧</a></li>
        <li><a href="">5.店舗情報の設定</a></li>
      </ul>
      <a id="logout" href="/ph34/eyereserve/public/storeLogout">ログアウト</a>
    </nav>
  </header>

  <main>
    <h2>2.注文履歴</h2>
    <div id="order_list">
      @isset($orderHistory)
        @foreach($orderHistory as $order)
          <section class="order_item">
            <div>
              <h3>
                {{ $order->getOrderStatus() }}：
                @if($order->getOrderStatus() == 3)
                 商品手配不可
                @elseif($order->getOrderStatus() == 5)
                  取引成立
                @endif
              </h3>
              <p>顧客ID：{{ $order->getCustomerId() }}</p>
              <p>注文日時：{{ $order->getOrderDatetime() }}</p>
            </div>
            <button>
              <a href="/ph34/eyereserve/public/orderDetails/{{ $order->getOrderId() }}">注文詳細へ</a>
            </button>
          </section>
        @endforeach
      @else
        <section>
          @foreach($validationMsgs as $msg)
            <h2>{{$msg}}</h2>
          @endforeach
        </section> 
      @endisset
    </div>
  </main>
</body>
</html>