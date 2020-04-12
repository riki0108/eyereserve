<?php
  /**
   * 就プレ　EYERESERVE ユーザ側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=StoreDetailsController.php
   * ディレクトリ=/ph34/eyereserve/app/Http/Controllers
   */


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Functions;
use App\Entity\User;
use App\Entity\Store;
use App\DAO\StoreDAO;
use App\Entity\Order;
use App\DAO\OrderDAO;
use App\Http\Controllers\Controller;

/**
 * StoreDetailsに関するコントローラークラス
 */
class StoreDetailsController extends Controller
{
    /**
     * お店の詳細画面表示処理
     */
    public function goStoreDetails(int $storeId, Request $request){
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
            $templatePath = 'user/storeDetails';
            // セッションから値を受け取る
            $assign['userName'] = $request->session()->get('name');
            $assign['point'] = $request->session()->get('point');

            $db = DB::connection()->getPdo();
            $storeDAO = new StoreDAO($db);
            $store = $storeDAO->findById($storeId);    
            $assign['store'] = $store;        
        }
        return view($templatePath, $assign);
    }
}
