<?php
  /**
   * 就プレ　EYERESERVE ユーザ側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=UserPortalController.php
   * ディレクトリ=/ph34/eyereserve/app/Http/Controllers
   */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions;
use App\Entity\User;
use App\Http\Controllers\Controller;

/**
 * UserPortalに関するコントローラークラス
 */
class UserPortalController extends Controller
{
    /**
     * Portal画面表示処理
     */
    public function goPortal(Request $request){
        $assign = [];
        // ログインチェック
        if(Functions::loginCheck($request)){
            $validationMsgs[] = 'ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインし直してください。';
            $assign['LoginMalidationMsgs'] = $validationMsgs;
            $user = new User();
            $assign['user'] = $user;    
            $templatePath = 'user/top';
        }
        else{
            $templatePath = 'user/portal';
            // セッションから値を受け取る
            $assign['userName'] = $request->session()->get('name');
            $assign['point'] = $request->session()->get('point');

            $assign['storeId'] = 1;
        }
        return view($templatePath, $assign);
    }
}
