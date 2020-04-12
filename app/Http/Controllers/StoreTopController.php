<?php
  /**
   * 就プレ　EYERESERVE ストア側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=StoreTopController.php
   * ディレクトリ=/ph34/eyereserve/app/Http/Controllers
   */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Functions;
use App\Entity\Store;
use App\Http\Controllers\Controller;

/**
 * StoreTopに関するコントローラークラス
 */
class StoreTopController extends Controller
{
    /**
     * Top画面表示処理
     */
    public function goTop(){
        $assign = [];
        $assign['storeId'] = '';
        return view('store/top', $assign);
    }
}
