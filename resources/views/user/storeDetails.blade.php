{{--
 /**
   * 就プレ　EYERESERVE ユーザ側
   * ポータル画面
   *
   * @author 
   *
   * ファイル名=storeDetails.blade.php
   * ディレクトリ=/ph34/eyereserve/resources/views/user
   */
--}}

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="">
  <title>お店の詳細  | EYERESERVE</title>
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/reset.css">
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/storeDetails.css">
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
      <!-- 情報の最終更新日時 -->
      <p><small>
        お店の情報の最終更新日時<br>
        {{ $store->getUpdate() }}
      </small></p>
      <!-- お店の画像 -->
      <img src="/ph34/eyereserve/public/image/shop{{ $store->getImage() }}" alt="お店の画像">
      <!-- 店名 -->
      <h1>{{ $store->getStoreName() }}</h1>
      <!-- 営業時間 -->
      <h2>{{ $store->getStoreBusinessHours() }}</h2>

      <!-- お店の企業情報 -->
      <div id="company">
        <!-- カテゴリー -->
        <p>{{ $store->getStoreCategory() }}</p>
        <!-- 企業名 -->
        <p>{{ $store->getStoreCompany() }}</p>
        <!-- ブランド -->
        <p>{{ $store->getStoreBrand() }}</p>
      </div>

      <!-- 地図 -->
      <div id="map">

      </div>

      <!-- アクションボタン -->
      <div id="action">
        <button id="order"><a href="/ph34/eyereserve/public/order/{{$store->getStoreId()}}">事前注文</a></button>
        <button id="info"><a href="">お問い合わせ</a></button>
      </div>
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
  <script>
    //変数宣言
    var map;
    var type = 'roadmap';
    var maptype = true;
    var fullscreen = true;
    var streetview = true;
    var zoom = true;
    var geocode = '{{$store->getStorePostPre()}}{{$store->getStorePostCity()}}{{$store->getStorePostAddress1()}}';
    var currentInfoWindows = null;

    function initMap(){
      console.log('initMap');
      //初期マップ表示
      //ジオコーディング処理
      geocoder = new google.maps.Geocoder();
      geocoder.geocode({'address':geocode},
          function(result,status){
              if(status == google.maps.GeocoderStatus.OK){
                  var lastlng = result[0].geometry.location;
                  //初期設定
                  var Options = {
                  zoom: 17,      //地図の縮尺値
                  center: lastlng,    //地図の中心座標
                  mapTypeId: type,   //地図の種類
                  mapTypeControl: maptype,   //マップタイプコントロール
                  fullscreenControl: fullscreen,     //全画面表示
                  streetViewControl: streetview,    //フルスクリーン
                  zoomControl: zoom,    //ズーム
                  };
                  //マップ作成
                  map = new google.maps.Map(document.getElementById('map'), Options);
                  //マーカーファンクション
                  Marker(lastlng);
              }else{
                  console.log(status);
              };
          }
      );
    };
    //マーカー
    function Marker(lastlng){
        //マーカー処理
        var maker = new google.maps.Marker({
        position:lastlng,
        map:map,
        });                            
        //インフォウィンドウ処理
        var infoWindow = new google.maps.InfoWindow({
            content:'<div>{{ $store->getStoreName() }}</div>'
        });
        maker.addListener('click',function(){
            //クローズ制御
            if(currentInfoWindows){
                currentInfoWindows.close();
            }
            currentInfoWindows = infoWindow;
            //オープン処理
            infoWindow.open(map,maker);                    
        });
    };
  </script>
  </script>
    <!-- google map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe-zOFpFYZkIVYzSu-0Gk-c_ybElmE3NI&callback=initMap" async defer>
  </script>
</body>
</html>