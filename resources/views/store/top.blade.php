{{--
 /**
   * 就プレ　EYERESERVE ストア側
   * ログイン画面
   *
   * @author 
   *
   * ファイル名=top.blade.php
   * ディレクトリ=/ph34/eyereserve/resources/views/store
   */
--}}

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="">
  <script src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
  <title>ストアトップ | EYERESERVE</title>
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/reset.css">
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/storeTop.css">
  <script src="/ph34/eyereserve/resources/js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="/ph34/eyereserve/resources/js/jquery.validate.min.js"></script>
  <script src="/ph34/eyereserve/resources/js/eyereserve.js"></script>
</head>
<body>
  <div id="logo">
    <img src="/ph34/eyereserve/public/image/logo.png" alt="ロゴ">
  </div>


  <div id="main">
    <!-- ログイン画面 -->
    <div id="login">
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
      <form action="/ph34/eyereserve/public/storeLogin" name="login" method="POST">
      @csrf
          <input type="num" name="storeId" value="{{ $storeId }}" size="50" placeholder="ストアID" required><br>
          <input type="password" name="loginPw" value="" size="50" placeholder="パスワード" required><br>
          <input type="submit" name="login-submit" value="ログインする">
      </form>
    </div>
  </div>
</body>
</html>