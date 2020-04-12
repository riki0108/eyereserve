<?php
  /**
   * 就プレ　EYERESERVE ユーザ側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=OrderController.php
   * ディレクトリ=/ph34/eyereserve/app/Http/Controllers
   */


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
use App\Functions;
use App\Entity\User;
use App\Entity\Store;
use App\DAO\StoreDAO;
use App\Entity\Order;
use App\DAO\OrderDAO;
use App\Http\Controllers\Controller;

/**
 * OrderControllerに関するコントローラークラス
 */
class OrderController extends Controller
{
    /**
     * 事前注文画面表示処理
     */
    public function goOrder(int $storeId, Request $request){
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
            $templatePath = 'user/order';
            // セッションから値を受け取る
            $assign['userName'] = $request->session()->get('name');
            $assign['point'] = $request->session()->get('point');
            $assign['customerId'] = $request->session()->get('id');

            $db = DB::connection()->getPdo();
            $storeDAO = new StoreDAO($db);
            $store = $storeDAO->findById($storeId); 
            $order = new Order();   
            $assign['store'] = $store;   
            $assign['order'] = $order;        
        }
        return view($templatePath, $assign);
    }

    /**
     * 事前注文処理
     */
    public function oredrConfirm(int $storeId, Request $request){
        // ログインチェック
        if(Functions::loginCheck($request)){
            $validationMsgs[] = 'ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインし直してください。';
            $assign['LoginMalidationMsgs'] = $validationMsgs;
            $user = new User();
            $assign['user'] = $user;    
            $templatePath = 'user/top';
        }
        else{
            // 変数のセット 
            $isRedirect = false;
            $templatePath = 'user/orderEnd';
            $assign = [];
            $validationMsgs = [];
            // 登録日時
            date_default_timezone_set('Asia/Tokyo');
            $orderDatetime = date('Y-m-d H:i:s');
            // 注文状況
            $orderStatus = 1;
            $path = '';
            
            // 入力された値の受け取り
            $maker = $request->input('maker');
            $product = $request->input('product');
            $quantity = $request->input('quantity');
            $description = $request->input('description');
            $customerId = $request->input('customerId');
            //ファイルがアップロードできてるか確認
            if (!empty($request->image)){
                //ファイルの拡張子取得
                $extension = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_EXTENSION);
                // 画像かどうかのチェック
                if($extension == 'jpeg' or $extension == 'jpg' or $extension == 'png' or $extension == 'gif'){
                    // 保存先のパスを取得
                    $path = $request->file('image')->store($customerId);
                }
                else{
                    $validationMsgs[] = '拡張子はjpegかjpgかpngかgifで登録してください。';
                }
            }    

            // 空白が入っていたら取り除く
            $maker = trim($maker);
            $product = trim($product);
            $quantity = trim($quantity);
            $description = trim($description);


            // 入力された値とDBに登録するデータをエンティティに格納
            $order = new Order();
            $order->setCustomerId($customerId);
            $order->setStoreId($storeId);
            $order->setMaker($maker);
            $order->setProduct($product);
            $order->setQuantity($quantity);
            $order->setDescription($description);
            $order->setImage($path);
            $order->setOrderDatetime($orderDatetime);
            $order->setOrderStatus($orderStatus);

            // DB登録
            $db = DB::connection()->getPdo();
            $orderDAO = new OrderDAO($db);
            if(empty($validationMsgs)){
                $orderId = $orderDAO->insert($order);
                if($orderId === -1){
                    $assign['errorMsg'] = '情報登録に失敗しました。もう一度初めからやり直してください。';
                    $templatePath = 'user/order';
                }
                else{
                    $isRedirect = true;
                    // セッションから値を受け取る
                    $assign['userName'] = $request->session()->get('name');
                    $assign['point'] = $request->session()->get('point');
                    $assign['customerId'] = $request->session()->get('id');
                    $assign['orderId'] = $orderId;
                }
            }
            else{
                // セッションから値を受け取る
                $assign['userName'] = $request->session()->get('name');
                $assign['point'] = $request->session()->get('point');
                $assign['customerId'] = $request->session()->get('id');

                $db = DB::connection()->getPdo();
                $storeDAO = new StoreDAO($db);
                $store = $storeDAO->findById($storeId);
                $order->setImage($request->file('image')->getClientOriginalName()); 
                $assign['order'] = $order;   
                $assign['store'] = $store;        
                $assign['validationMsgs'] = $validationMsgs;
                $templatePath = 'user/order';
            }
            if($isRedirect){
                $response = view($templatePath, $assign);
            }
            else{
                $response = view($templatePath, $assign);
            }
            return $response;
        }
    }
}