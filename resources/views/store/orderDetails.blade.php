{{--
 /**
   * 就プレ　EYERESERVE　ストア側
   * 注文詳細画面
   *
   * @author 
   *
   * ファイル名=orderDetails.blade.php
   * ディレクトリ=/ph34/eyereserve/resources/views/store
   */
--}}

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="">
  <title>注文詳細  | EYERESERVE</title>
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/reset.css">
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/orderDetails.css">
  <script src="/ph34/eyereserve/resources/js/jquery-3.3.1.min.js"></script>

  <!-- 自分のjs -->
  <script src="/ph34/eyereserve/resources/js/potal.js"></script>

  <script>
    function check(){
      if(window.confirm('更新しますか？')){ // 確認ダイアログを表示
        return true; // 「OK」時は送信を実行
      }
      else{ // 「キャンセル」時の処理
        return false; // 送信を中止
      }
    }
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
        <li><a href="/ph34/eyereserve/public/goStorePortal" style="color:white;background-color:#87ceeb">1.注文一覧</a></li>
        <li><a href="/ph34/eyereserve/public/orderHistory">2.注文履歴</a></li>
        <li><a href="">3.来店スケジュール</a></li>
        <li><a href="">4.メッセージ一覧</a></li>
        <li><a href="">5.店舗情報の設定</a></li>
      </ul>
      <a id="logout" href="/ph34/eyereserve/public/storeLogout">ログアウト</a>
    </nav>
  </header>

  <main>
    <h2>1.注文一覧 > 注文詳細</h2>
    <div id="order_details">
      @isset($orderDetails)
        <div id="order_item">
          <h3>
            {{ $orderDetails->getOrderStatus() }}：
            @if($orderDetails->getOrderStatus() == 1)
              商品準備中
            @elseif($orderDetails->getOrderStatus() == 2)
              商品手配完了
            @elseif($orderDetails->getOrderStatus() == 4)
              来店待ち
            @else()
              取引終了
            @endif
          </h3>
          <table>
            <tr>
              <th>顧客ID</th>
              <td>{{ $orderDetails->getCustomerId() }}</td>
            </tr>
            <tr>
              <th>名前</th>
              <td>{{ $customerName }}　様</td>
            </tr>
            <tr>
              <th>注文日時</th>
              <td>{{ $orderDetails->getOrderDatetime() }}</td>  
            </tr>
          </table>

          <h2>注文内容</h2>
          <table>
            <tr>
              <th>メーカー</th>
              <td>{{ $orderDetails->getMaker() }}</td>
            </tr>
            <tr>
              <th>商品名</th>
              <td>{{ $orderDetails->getProduct() }}</td>
            </tr>
            <tr>
              <th>個数</th>
              <td>{{ $orderDetails->getQuantity() }}</td>
            </tr>
            <tr>
                <th>商品の説明</th>
                @if($orderDetails->getDescription())
                  <td>{{$orderDetails->getDescription()}}</td>
                @else
                  <td>なし</td>
                @endif
            </tr>
            <tr>
                <th>商品の画像</th>
                @if($orderDetails->getImage())
                  <td><img src="/ph34/eyereserve/storage/app/{{$orderDetails->getImage()}}" alt=""><td>
                @else
                  <td>なし</td>
                @endif
            </tr>
          </table>

          <!-- 注文状況変更ボタン -->
          <form action="/ph34/eyereserve/public/orderStatus" name="orderStatus" id="orderStatus" method="POST" onSubmit="return check()">
          @csrf
            <select name="status" id="status">
              <option value="1" {{ 1 == $orderDetails->getOrderStatus() ? 'selected' : '' }}>1：商品準備中</option>
              <option value="2" {{ 2 == $orderDetails->getOrderStatus() ? 'selected' : '' }}>2：商品手配完了</option>
              <option value="3" {{ 3 == $orderDetails->getOrderStatus() ? 'selected' : '' }}>3：商品手配不可(取引終了)</option>
              <option value="4" {{ 4 == $orderDetails->getOrderStatus() ? 'selected' : '' }}>4：来店待ち</option>
              <option value="5" {{ 5 == $orderDetails->getOrderStatus() ? 'selected' : '' }}>5：取引成立(取引終了)</option>
            </select>
            <input type="hidden" id="orderId" name="orderId" value="{{ $orderDetails->getOrderId() }}">
            <button type="submit">更新</button>
          </form>
        </div>
      @endisset
    </div>
  </main>
</body>
</html>