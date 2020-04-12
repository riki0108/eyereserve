{{--
 /**
   * 就プレ　EYERESERVE ユーザ側
   * ログイン・新規登録画面
   *
   * @author 
   *
   * ファイル名=top.blade.php
   * ディレクトリ=/ph34/eyereserve/resources/views/user
   */
--}}

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="">
  <script src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
  <title>トップ | EYERESERVE</title>
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/reset.css">
  <link rel="stylesheet" href="/ph34/eyereserve/public/css/userTop.css">
  <script src="/ph34/eyereserve/resources/js/jquery-3.3.1.min.js"></script>
  <script src="/ph34/eyereserve/resources/js/eyereserve.js"></script>
</head>
<body>
  <div id="logo">
    <img src="/ph34/eyereserve/public/image/logo.png" alt="ロゴ">
  </div>


  <div id="main">
      <!-- タブ機能 -->
      <p id="tabcontrol">
        <a href="#logo" id="clickLogin">ログイン</a>
        <a href="#logo" id="clickRegistration" class="active">新規登録</a>
      </p>
  
    <!-- ログイン画面 -->
    <div id="login">
        @isset($LoginMalidationMsgs)
          <section id="errorMsg">
            <ul>
              @foreach($LoginMalidationMsgs as $msg)
              <li>{{$msg}}</li>
              @endforeach
            </ul>
          </section> 
        @endisset
      <form action="/ph34/eyereserve/public/login" name="login" method="POST">
      @csrf
          <input type="email" name="loginMail" value="{{$loginMail ?? ''}}" size="50" placeholder="メールアドレス" required><br>
          <input type="password" name="loginPw" value="" size="50" minlength="8" placeholder="パスワード" required><br>
          <input type="submit" name="login-submit" value="ログインする">
      </form>
    </div>

    <!-- 新規登録画面 -->
    <div id="registration" class="none">
        @isset($RegistrationMalidationMsgs)
          <section id="errorMsg">
            <ul>
              @foreach($RegistrationMalidationMsgs as $msg)
              <li>{{$msg}}</li>
              @endforeach
            </ul>
          </section> 
        @endisset
      <form action="/ph34/eyereserve/public/registration" name="registration" id="reg" method="POST">
      @csrf
          <!-- 氏名入力フィールド -->
          <label>氏名</label><br>
          <div class="name-box">
            <input type="text" name="name" value="{{$name1 ?? ''}}" size="25" placeholder="例）山田" required>
            <input type="text" name="name2" value="{{$name2 ?? ''}}" size="25" placeholder="例）太郎" required><br>
          </div>
          <label>フリガナ</label><br>
          <div class="name-box">
            <input type="text" name="name-furi" value="{{$name_furi1 ?? ''}}" size="25" placeholder="例）ヤマダ" required>
            <input type="text" name="name-furi2" value="{{$name_furi2 ?? ''}}" size="25" placeholder="例）タロウ" required><br>
          </div>
          <!-- 性別選択フィールド -->
          <label>性別</label><br>
          男：<input type="radio" class="gender" name="gender" value="men" {{ $user->getGender() == 'men' ? 'checked' : '' }} required>
          女：<input type="radio" class="gender" name="gender" value="woman" {{ $user->getGender() == 'woman' ? 'checked' : '' }} required><br>
          <!-- ▼郵便番号入力フィールド(3桁+4桁) -->
          <label>住所</label><br>
          郵便番号：<input type="tel" class="post" name="zip1" size="4" maxlength="3" value="{{$zip1 ?? ''}}" required> － <input type="tel" class="post" name="zip2" size="5" maxlength="4" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','address1','address1');" value="{{$zip2 ?? ''}}" required><br>
          <!-- ▼住所入力フィールド(都道府県+以降の住所) -->
          <input type="text" name="address1" size="50" placeholder="例）大阪市大阪府北区梅田" value="{{$user->getAddress()}}" required><br>
          <input type="text" name="address2" size="80" placeholder="例）3-3-3 〇〇マンション555号室" value="{{$user->getAddressDetails()}}" required><br>
          <!-- 生年月日選択フィールド -->
          <label>生年月日</label><br>
          <input type="date" name="birthday" value="{{$user->getBirthday()}}" required><br>
          <!-- 電話番号入力フィールド -->
          <label>電話番号※ハイフンなしで入力してください</label><br>
          <input type="tel" name="tel" size="30" placeholder="例）08012345678" value="{{$user->getTel()}}" required><br>
          <span class="errorMsg"><label id="telError"></label></span>
          <!-- メールアドレス入力フィールド -->
          <label>メールアドレス</label><br>
          <input type="email" name="mail" size="50" placeholder="例）ddddd@ddddd.de.de" value="{{$user->getMail()}}" required><br>
          <label>※確認用にもう一度入力してください</label><br>
          <input type="email" name="mail2" size="50" required><br>
          <span class="errorMsg"><label id="mailError"></label></span>
          <!-- パスワード入力フィールド -->
          <label>
            パスワード
            ※半角英数字8文字以上で入力してください
          </label><br>
          <input type="password" name="password" size="50" minlength="8" required><br>
          <span class="errorMsg"><label id="passwordError"></label></span>
          <!-- 利用規約同意ボタン -->
          <div id="consent">
            <input type="checkbox" name="check" require>
            <p><a href="">利用規約</a>に同意する</p></br>
          </div>
          <!-- 登録ボタン -->
          <input type="submit" name="registration-submit" value="登録する">
      </form>
    </div>
  </div>
</body>
</html>