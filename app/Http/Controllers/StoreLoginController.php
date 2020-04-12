<?php
  /**
   * 就プレ　EYERESERVE ストア側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=StoreLoginController.php
   * ディレクトリ=/ph34/eyereserve/app/Http/Controllers
   */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DAO\StoreDAO;
use App\Entity\Store;
use App\Http\Controllers\Controller;

/**
 * ログイン・ログアウトに関するコントローラークラス
 */

class StoreLoginController extends Controller{
    /**
     * ログイン処理
     */
    public function login(Request $request){
        // 変数のセット 
        $isRedirect = false;
        $templatePath = 'store/top';
        $assign = [];

        // 入力された値の受け取り
        $loginId = $request->input('storeId');
        $loginPw = $request->input('loginPw');

        // 空白が入っていたら取り除く
        $loginId = trim($loginId);
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
            $storeDAO = new StoreDAO($db);

            // 入力されたストアIDが存在するかチェック
            $store = $storeDAO->findById($loginId);
            if($store == null){
                $validationMsgs[] =  '存在しないストアIDです。正しいストアIDを入力してください。';
            }
            else{
                $storePw = $store->getLoginPassword();
                // パスワードが合っているかチェック
                if(password_verify($loginPw, $storePw)){
                    $storeId = $store->getStoreId();
                    $storeName = $store->getStoreName();

                    // セッションに格納
                    $session = $request->session();
                    $session->flush();
                    $session->regenerate();
                    $session->put('loginFlg', true);
                    $session->put('id', $storeId);
                    $session->put('name', $storeName);
                    $isRedirect = true;
                }
                else{
                    $validationMsgs[] = 'パスワードが違います。正しいパスワードを入力してください。';
                }
            }
        }
        // エラーがなければポータルサイトに飛ばす
        if($isRedirect){
            $response = redirect('/goStorePortal');
        }
        // エラーがあれば入力値とエラーメッセージを保持しログイン画面に戻る
        else{
            if(!empty($validationMsgs)){
                $store = new Store();
                $assign['store'] = $store;
                $assign['validationMsgs'] = $validationMsgs;
                $assign['storeId'] = $loginId;
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
        return redirect('/storeTop');
    }
}
