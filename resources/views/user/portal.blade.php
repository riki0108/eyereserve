{{--
 /**
   * 就プレ　EYERESERVE ユーザ側
   * ポータル画面
   *
   * @author 
   *
   * ファイル名=portal.blade.php
   * ディレクトリ=/ph34/eyereserve/resources/views/user
   */
--}}

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="">
  <title>ポータル  | EYERESERVE</title>
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/reset.css">
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/potal.css">
  <script src="/ph34/eyereserve/resources/js/jquery-3.3.1.min.js"></script>
  <!-- スライドショーのプラグイン読み込み -->
  <link rel="stylesheet" href="/ph34/eyereserve/resources/slick/slick-theme.css" type="text/css">
  <link rel="stylesheet" href="/ph34/eyereserve/resources/slick/slick.css" type="text/css">
  <script src="/ph34/eyereserve/resources/slick/slick.min.js"></script>
  <!-- 自分のjs -->
  <script src="/ph34/eyereserve/resources/js/potal.js"></script>

  <script>
    $(function(){
    //ページ読み込み時に通信を行う
        url = 'https://opendata.resas-portal.go.jp/api/v1/prefectures';
        PreSearch(url);

    // 都道府県が検索されたら
      $('#pre').change(function() {
          var pre = $(this).val();
          url = 'https://opendata.resas-portal.go.jp/api/v1/cities?prefCode='+pre;
          CitySearch(url);
      });
    })
  </script>
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
    <!-- キャンペーンやお知らせのスライドショー -->
    <div class="slider">
      <a href=""><img src="/ph34/eyereserve/public/image/campaign01.png" alt="キャンペーン画像"></a>
      <a href=""><img src="/ph34/eyereserve/public/image/campaign02.jpg" alt="キャンペーン画像"></a>
      <a href=""><img src="/ph34/eyereserve/public/image/campaign03.png" alt="キャンペーン画像"></a>
      <a href=""><img src="/ph34/eyereserve/public/image/campaign04.jpg" alt="キャンペーン画像"></a>
    </div>

    <!-- 検索 -->
    <article>
      <div id="search">
        <form action="">
          <!-- キーワード検索 -->
          <div id="keyword">
            <input type="text" name="keyword" placeholder="キーワード、店名など">
            <input type="submit" name="keyword_search" value="検索"><br>
          </div>

          <div id="conditions_search">
            <div id="area_search">
              <!-- 都道府県検索 -->
              <select name="pre" id="pre">
                <option value="">都道府県</option>
              </select>
              <!-- 市区検索 -->
              <select name="area" id="area">
                <option value="">市区</option>
              </select>
            </div>

            <!-- ジャンル検索 -->
            <select name="genre">
              <option value="1">お店のジャンル</option>
              <option value="2">コンビニ</option>
              <option value="3">各種総合小売</option>
              <option value="4">アパレル</option>
              <option value="5">食料品</option>
              <option value="6">家具</option>
              <option value="7">家電量販店</option>
              <option value="8">ホームセンター</option>
              <option value="9">楽器屋</option>
              <option value="10">本屋</option>
              <option value="11">スポーツ用品店</option>
              <option value="12">中古品店</option>
              <option value="13">日用品・雑貨屋</option>
              <option value="14">その他</option>
            </select><br>
          </div>

          <!-- ボタン -->
          <div id="conditions_search_button">
            <input type="reset" name="clear" value="条件をクリア">
            <input type="submit" name="conditions_search" value="この条件で検索">
          </div>
        </form>
      </div>
    </article>

    <!-- オススメのお店 -->
    <article> 
      <h2>おすすめのお店</h2>

      <!-- コンテンツ -->
      <div id="recomme">
        <section class="items"><a href="">
          <img src="/ph34/eyereserve/public/image/test1.png" alt="お店の画像">
          <p>ドン・キホーテ　桜ノ宮店</p>
          <p>各種総合小売</p>
        </a></section>
        <section class="items"><a href="test">
          <img src="/ph34/eyereserve/public/image/test1.png" alt="お店の画像">
          <p>ドン・キホーテ　桜ノ宮店</p>
          <p>各種総合小売</p>
        </a></section>
        <section class="items"><a href="">
          <img src="/ph34/eyereserve/public/image/test1.png" alt="お店の画像">
          <p>ドン・キホーテ　桜ノ宮店</p>
          <p>各種総合小売</p>
        </a></section>
        <section class="items"><a href="">
          <img src="/ph34/eyereserve/public/image/test1.png" alt="お店の画像">
          <p>ドン・キホーテ　桜ノ宮店</p>
          <p>各種総合小売</p>
        </a></section>
        <section class="items"><a href="">
          <img src="/ph34/eyereserve/public/image/test1.png" alt="お店の画像">
          <p>ドン・キホーテ　桜ノ宮店</p>
          <p>各種総合小売</p>
        </a></section>
        <section class="items"><a href="">
          <img src="/ph34/eyereserve/public/image/test1.png" alt="お店の画像">
          <p>ドン・キホーテ　桜ノ宮店</p>
          <p>各種総合小売</p>
        </a></section>
        <section class="items"><a href="">
          <img src="/ph34/eyereserve/public/image/test1.png" alt="お店の画像">
          <p>ドン・キホーテ　桜ノ宮店</p>
          <p>各種総合小売</p>
        </a></section>
        <section class="items"><a href="">
          <img src="/ph34/eyereserve/public/image/test1.png" alt="お店の画像">
          <p>ドン・キホーテ　桜ノ宮店</p>
          <p>各種総合小売</p>
        </a></section>
      </div>
    </article>

    <!-- 人気ショップランキング -->
    <article>
      <h2>人気ショップランキング</h2>
      <!-- カード型コンテンツ -->
      <div id="shop_ranking">
        <ul>
          <li><a href="/ph34/eyereserve/public/store/{{ $storeId }}">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/shop01.png" alt="ショップのロゴ">
              <p>ドン・キホーテ桜ノ宮店</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/shop02.png" alt="ショップのロゴ">
              <p>イオン四條畷店</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/shop03.jpeg" alt="ショップのロゴ">
              <p>セブンイレブン関目高殿店</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/shop04.png" alt="ショップのロゴ">
              <p>ユニクロ関目店</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/shop05.png" alt="ショップのロゴ">
              <p>ヤマダ電機今福東店</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/shop06.png" alt="ショップのロゴ">
              <p>ルクア大阪店</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/shop07.png" alt="ショップのロゴ">
              <p>イズミヤ今福店</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/shop08.jpeg" alt="ショップのロゴ">
              <p>大阪高島屋</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/shop09.png" alt="ショップのロゴ">
              <p>ビックカメラなんば店</p>
            </div>
          </a></li>
        </ul>
      </div>
    </article>

    <!-- 人気アイテムランキング -->
    <article>
      <h2>人気アイテムランキング</h2>
      <!-- カード型コンテンツ -->
      <div id="item_ranking">
        <ul>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/item01.jpg" alt="アイテム">
              <p>クリスタルカイザー</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/item02.jpg" alt="アイテム">
              <p>パンパース　ウルトラジャンボ</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/item03.jpg" alt="アイテム">
              <p>任天堂スイッチ</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/item04.jpg" alt="アイテム">
              <p>キャンディーマジック</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/item05.jpg" alt="アイテム">
              <p>アースコンタクト</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/item06.jpg" alt="アイテム">
              <p>エバーカラーワンデー</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/item07.jpg" alt="アイテム">
              <p>イズミヤ今福店</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/item08.jpg" alt="アイテム">
              <p>任天堂スイッチ</p>
            </div>
          </a></li>
          <li><a href="">
            <div class="card">
              <img src="/ph34/eyereserve/public/image/item09.jpg" alt="アイテム">
              <p>大乱闘スマッシュブラザーズ</p>
            </div>
          </a></li>
        </ul>
      </div>
    </article>
  </main>

  <!-- お店や企業向けコンテンツ -->
  <aside>
    <div id="store">
      <h3>システムを導入検討のお店様・企業様へ</h3>
      <div id="store_button">
        <a href="">システム導入</a>
        <a href="">システムの詳細</a>
      </div>
    </div>
  </aside>

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