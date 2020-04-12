<?php
  /**
   * 就プレ　EYERESERVE ユーザ側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=UserTopController.php
   * ディレクトリ=/ph34/eyereserve/app/Http/Controllers
   */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions;
use App\Entity\User;
use App\Http\Controllers\Controller;

/**
 * UserTopに関するコントローラークラス
 */
class UserTopController extends Controller
{
    /**
     * Top画面表示処理
     */
    public function goTop(){
        $assign = [];
        $user = new User();
        $assign['user'] = $user;
        return view('user/top', $assign);
    }
}
