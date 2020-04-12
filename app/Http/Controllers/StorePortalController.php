<?php
  /**
   * 就プレ　EYERESERVE ストア側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=StorePortalController.php
   * ディレクトリ=/ph34/eyereserve/app/Http/Controllers
   */


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Functions;
use App\Entity\Store;
use App\Entity\Order;
use App\DAO\OrderDAO;
use App\DAO\UserDAO;
use App\Entity\User;
use App\Http\Controllers\Controller;

/**
 * StorePortalに関するコントローラークラス
 */
class StorePortalController extends Controller
{
    /**
     * portal画面表示処理
     */
    public function goPortal(Request $request){
        $assign = [];
        $validationMsgs = [];
        $templatePath = 'store/portal';

        // セッションから値を受け取る
        $storeId = $request->session()->get('id');

        // DB接続
        $db = DB::connection()->getPdo();
        $orderDAO = new OrderDAO($db);

        // 現在取引中の注文を取得
        $orderList = $orderDAO->findByStoreId($storeId);
        if($orderList == null){
            $validationMsgs[] =  '現在お取引中のご注文はございません。';
            $assign['validationMsgs'] = $validationMsgs;
        }
        else{
            $assign['orderList'] = $orderList;
        }


        return view($templatePath, $assign);
    }

    /**
     * 注文詳細画面表示処理
     */
    public function orderDetails(int $orderId, Request $request){
        $assign = [];
        
        // DB接続
        $db = DB::connection()->getPdo();
        $orderDAO = new OrderDAO($db);

        // 選択された注文データを取得する
        $orderDetails = $orderDAO->findByOrderId($orderId);
        if(!($orderDetails == null)){
            $assign['orderDetails'] = $orderDetails;
        }

        // 注文している顧客の名前を取得する
        $customerID = $orderDetails->getCustomerId();
        $userDAO = new UserDAO($db);
        $customerName = $userDAO->findByUserId($customerID);
        $assign['customerName'] = $customerName;

        return view('store/orderDetails', $assign);
    }
    
    /**
     * 注文の状況変更
     */
    public function orderStatus(Request $request){
        $assign = [];
        $validationMsgs = [];
        $response = '';
        $templatePath = 'store/portal';
        // 入力された値の受け取り
        $status = $request->input('status');
        $orderId = $request->input('orderId');

        // DB接続
        $db = DB::connection()->getPdo();

        $orderDAO = new OrderDAO($db);
        $orderDetails = $orderDAO->findByOrderId($orderId);
        $orderDetails->setOrderId($orderId);
        $orderDetails->setOrderStatus($status);

        $result = $orderDAO->orderStatusUpdate($orderDetails);
        // 情報を更新できたら
        if($result){
            // セッションから値を受け取る
            $storeId = $request->session()->get('id');
            // 現在取引中の注文を取得
            $orderList = $orderDAO->findByStoreId($storeId);
            if($orderList == null){
                $validationMsgs[] =  '現在お取引中のご注文はございません。';
                $assign['validationMsgs'] = $validationMsgs;
            }
            else{
                $assign['orderList'] = $orderList;
            }
            $response = view($templatePath, $assign);
        }
        return $response;
    }


    /**
     * 注文履歴画面表示
     */
    public function orderHistory(Request $request){
        $assign = [];
        $validationMsgs = [];
        $templatePath = 'store/orderHistory';

        // セッションから値を受け取る
        $storeId = $request->session()->get('id');

        // DB接続
        $db = DB::connection()->getPdo();
        $orderDAO = new OrderDAO($db);

        // 取引が終了した注文を取得
        $orderHistory = $orderDAO->findByStoreIdFin($storeId);
        if($orderHistory == null){
            $validationMsgs[] =  '注文データがございません';
            $assign['validationMsgs'] = $validationMsgs;
        }
        else{
            $assign['orderHistory'] = $orderHistory;
        }
        return view($templatePath, $assign);
    }


    /**
     * 注文絞り込み検索結果表示
     */
    public function orderRefine(Request $request){
        $assign = [];
        $validationMsgs = [];
        $templatePath = 'store/portal';
        echo 'deed';

        // セッションから値を受け取る
        $storeId = $request->session()->get('id');

        // 入力された値を受け取る
        $status = $request->input('status');
        var_dumo($status);

        // DB接続
        $db = DB::connection()->getPdo();
        $orderDAO = new OrderDAO($db);

        // 注文絞り込み検索結果表示
        $orderRefine = $orderDAO->findByStoreIdFin($storeId, $status);
        if($orderRefine == null){
            $validationMsgs[] =  '注文データがございません';
            $assign['validationMsgs'] = $validationMsgs;
        } 
        else{
            $assign['orderRefine'] = $orderRefine;
        }
        return view($templatePath, $assign);
    }
}
