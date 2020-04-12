<?php
  /**
   * 就プレ　EYERESERVE ユーザ側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=UserLoginController.php
   * ディレクトリ=/ph34/eyereserve/app/Http/Controllers
   */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DAO\UserDAO;
use App\Entity\User;
use App\Http\Controllers\Controller;

/**
 * ログイン・ログアウトに関するコントローラークラス
 */

class UserLoginController extends Controller{
    /**
     * ログイン処理
     */
    public function login(Request $request){
        // 変数のセット 
        $isRedirect = false;
        $templatePath = 'user/top';
        $assign = [];

        // 入力された値の受け取り
        $loginMail = $request->input('loginMail');
        $loginPw = $request->input('loginPw');

        // 空白が入っていたら取り除く
        $loginMail = trim($loginMail);
        $loginPw = trim($loginPw);

        $validationMsgs = [];
        // 入力値のチェック
        // 正規表現チェック
        if (!(preg_match("/^[a-zA-Z0-9]+$/", $loginPw))) {
            $validationMsgs[] = 'パスワードは半角英数字で入力してください。';
        }

        // エラーがなかったらdb接続
        if(empty($validationMsgs)){
            $db = DB::connection()->getPdo();
            $userDAO = new UserDAO($db);

            // 入力されたメールアドレスが存在するかチェック
            $user = $userDAO->findByMail($loginMail);
            if($user == null){
                $validationMsgs[] =  '存在しないメールアドレスです。正しいメールアドレスを入力してください。';
            }
            else{
                $userPw = $user->getPassword();
                // パスワードが合っているかチェック
                if(password_verify($loginPw, $userPw)){
                    $customerId = $user->getCustomerId();
                    $customerFlg = $user->getCustomerFlg();
                    $name = $user->getName();
                    $point = $user->getPoint();

                    // セッションに格納
                    $session = $request->session();
                    $session->put('loginFlg', true);
                    $session->put('id', $customerId);
                    $session->put('name', $name);
                    $session->put('auth', $customerFlg);
                    $session->put('point', $point);
                    $isRedirect = true;
                }
                else{
                    $validationMsgs[] = 'パスワードが違います。正しいパスワードを入力してください。';
                }
            }
        }
        // エラーがなければポータルサイトに飛ばす
        if($isRedirect){
            $response = redirect('/goPortal');
        }
        // エラーがあれば入力値とエラーメッセージを保持しログイン画面に戻る
        else{
            if(!empty($validationMsgs)){
                $user = new User();
                $assign['user'] = $user;
                $assign['LoginMalidationMsgs'] = $validationMsgs;
                $assign['loginMail'] = $loginMail;
            }
            $response = view($templatePath,$assign);
        }
        return $response;
    }

    /**
     * ログアウト処理
     */
    public function logout(Request $request){
        $session = $request->session();
        $session->flush();
        $session->regenerate();
        return redirect('/');
    }
}
