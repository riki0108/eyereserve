{{--
 /**
   * 就プレ　EYERESERVE　ストア側
   * ポータル画面
   *
   * @author 
   *
   * ファイル名=portal.blade.php
   * ディレクトリ=/ph34/eyereserve/resources/views/store
   */
--}}

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="">
  <title>ストア側ポータル  | EYERESERVE</title>
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/reset.css">
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/storePortal.css">
  <script src="/ph34/eyereserve/resources/js/jquery-3.3.1.min.js"></script>

  <!-- 自分のjs -->
  <script src="/ph34/eyereserve/resources/js/potal.js"></script>

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
        <li><a href="#" style="color:white;background-color:#87ceeb">1.注文一覧</a></li>
        <li><a href="/ph34/eyereserve/public/orderHistory">2.注文履歴</a></li>
        <li><a href="">3.来店スケジュール</a></li>
        <li><a href="">4.メッセージ一覧</a></li>
        <li><a href="">5.店舗情報の設定</a></li>
      </ul>
      <a id="logout" href="/ph34/eyereserve/public/storeLogout">ログアウト</a>
    </nav>
  </header>

  <main>
    <h2>1.注文一覧</h2>
    <!-- 絞り込み検索 -->
    <div id="refine">
      <p id="refine_text">絞り込み検索　⬇︎</p>
      <div id="refine_item">
        <form action="/ph34/eyereserve/public/orderRefine" method="get">
        @csrf
          <input type="checkbox" name="status[]" value="1">商品準備中
          <input type="checkbox" name="status[]" value="2">商品手配完了
          <input type="checkbox" name="status[]" value="4">来店待ち<br>

          <input type="button" name="refine_button" value="絞り込み検索">
        </form>
      </div>
    </div>
    <div id="order_list">
      @isset($orderList)
        @foreach($orderList as $order)
          <section class="order_item">
            <div>
              <h3>
                {{ $order->getOrderStatus() }}：
                @if($order->getOrderStatus() == 1)
                  商品準備中
                @elseif($order->getOrderStatus() == 2)
                  商品手配完了
                @elseif($order->getOrderStatus() == 4)
                  来店待ち
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
<script>
    //初期表示は非表示
    document.getElementById("refine_item").style.display ="none";

    // 絞り込み検索が押されたら
    document.getElementById("refine_text").onclick = function() {
      if(refine_item.style.display=="block"){
        // noneで非表示
        refine_item.style.display ="none";
      }else{
        // blockで表示
        refine_item.style.display ="block";
      }
    };
  </script>

</html>