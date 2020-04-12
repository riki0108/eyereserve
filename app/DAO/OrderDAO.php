<?php
  /**
   * 就プレ　EYERESERVE ユーザ側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=OrderDAO.php
   * ディレクトリ=/ph34/eyereserve/app/DAO/
   */


    namespace App\Dao;


    use PDO;
    use App\Entity\Order;

   /**
    * orderテーブルへのデータ操作クラス
    */

    class OrderDAO{
      /**
       * @var PDO DB接続オブジェクト
       */
      private $db;

      /**
       * コンストラクタ
       * 
       * @param PDO $db DB接続オブジェクト
       */
      public function __construct(PDO $db){
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        $this->db = $db;
      }

      /**
       * オーダー登録
       * 
       * @param Order $order 登録情報が格納されたOrderオブジェクト
       * @return integer 登録情報の連番主キーの値。登録に失敗した場合は-1
       */
      public function insert(Order $order): int{
        $sqlInsert = 'INSERT INTO `order` (store_id, customer_id, maker, product, quantity, description, image, order_datetime, order_status) VALUES (:store_id, :customer_id, :maker, :product, :quantity, :description, :image, :order_datetime, :order_status)';
        $stmt = $this->db->prepare($sqlInsert);
        $stmt->bindValue(':store_id',$order->getStoreId(),PDO::PARAM_INT);
        $stmt->bindValue(':customer_id',$order->getCustomerId(),PDO::PARAM_INT);
        $stmt->bindValue(':maker',$order->getMaker(),PDO::PARAM_STR);
        $stmt->bindValue(':product',$order->getProduct(),PDO::PARAM_STR);
        $stmt->bindValue(':quantity',$order->getQuantity(),PDO::PARAM_STR);
        $stmt->bindValue(':description',$order->getDescription(),PDO::PARAM_STR);
        $stmt->bindValue(':image',$order->getImage(),PDO::PARAM_STR);
        $stmt->bindValue(':order_datetime',$order->getOrderDatetime(),PDO::PARAM_STR);
        $stmt->bindValue(':order_status',$order->getOrderStatus(),PDO::PARAM_INT);

        $result = $stmt->execute();
        if($result){
          $orderId = $this->db->lastInsertId();
        }
        else{
          $orderId = -1;
        }
        return $orderId;
      }


      /**
       * storeIdによる注文の一覧検索
       * 
       * @param int $storeId ストアID
       * @return array 該当するOrderオブジェクト。ただし、該当データがない場合はnull
       */
      public function findByStoreId(int $storeId): ?array{
        $sql = 'SELECT * FROM `order` WHERE store_id = :storeId AND order_status != 5 AND order_status != 3 ORDER BY order_datetime ASC';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':storeId',$storeId,PDO::PARAM_INT);
        $result = $stmt->execute();
        $orderList = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $orderId = $row['order_id'];
          $customerId = $row['customer_id'];
          $maker = $row['maker'];
          $product = $row['product'];
          $quantity = $row['quantity'];
          $description = $row['description'];
          $image = $row['image'];
          $orderDatetime = $row['order_datetime'];
          $orderStatus = $row['order_status'];

          $order = new Order();
          $order->setOrderId($orderId);
          $order->setCustomerId($customerId);
          $order->setMaker($maker);
          $order->setProduct($product);
          $order->setQuantity($quantity);
          $order->setDescription($description);
          $order->setImage($image);
          $order->setOrderDatetime($orderDatetime);
          $order->setOrderStatus($orderStatus);
          $orderList[$orderId] = $order;
        }
        return $orderList;
      }

      /**
       * orderIdによる注文の詳細検索
       * 
       * @param int $orderId オーダーID
       * @return Order 該当するOrderオブジェクト。ただし、該当データがない場合はnull
       */
      public function findByOrderId(int $orderId): ?Order{
        $sql = 'SELECT * FROM `order` WHERE order_id = :orderId';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':orderId',$orderId,PDO::PARAM_INT);
        $result = $stmt->execute();
        $orderDetails = null;
        if($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $orderId = $row['order_id'];
          $customerId = $row['customer_id'];
          $maker = $row['maker'];
          $product = $row['product'];
          $quantity = $row['quantity'];
          $description = $row['description'];
          $image = $row['image'];
          $orderDatetime = $row['order_datetime'];
          $orderStatus = $row['order_status'];

          $orderDetails = new Order();
          $orderDetails->setOrderId($orderId);
          $orderDetails->setCustomerId($customerId);
          $orderDetails->setMaker($maker);
          $orderDetails->setProduct($product);
          $orderDetails->setQuantity($quantity);
          $orderDetails->setDescription($description);
          $orderDetails->setImage($image);
          $orderDetails->setOrderDatetime($orderDatetime);
          $orderDetails->setOrderStatus($orderStatus);
        }
        return $orderDetails;
      }


      /**
       * orderIdによる注文状況変更
       * 
       * @param Order $orderDetails 登録情報が格納されたOrderオブジェクト。主キーがこのオブジェクトのidの値のレコードを更新する。
       * @return boolean 登録が成功したかどうかを表す値。
       */
      public function orderStatusUpdate(Order $orderDetails): ?bool{
        $sqlUpdate = 'UPDATE `order` SET order_status = :order_status WHERE order_id = :order_id';
        $stmt = $this->db->prepare($sqlUpdate);
        $stmt->bindValue(':order_status',$orderDetails->getOrderStatus(),PDO::PARAM_INT);
        $stmt->bindValue(':order_id',$orderDetails->getOrderId(),PDO::PARAM_INT);
        $result = $stmt->execute();
        return $result;
      }


      /**
       * storeIdによる注文の一覧検索(取引終了)
       * 
       * @param int $storeId ストアID
       * @return array 該当するOrderオブジェクト。ただし、該当データがない場合はnull
       */
      public function findByStoreIdFin(int $storeId): ?array{
        $sql = 'SELECT * FROM `order` WHERE store_id = :storeId AND order_status != 1 AND order_status != 2 AND order_status != 4 ORDER BY order_datetime ASC';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':storeId',$storeId,PDO::PARAM_INT);
        $result = $stmt->execute();
        $orderHistory = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $orderId = $row['order_id'];
          $customerId = $row['customer_id'];
          $maker = $row['maker'];
          $product = $row['product'];
          $quantity = $row['quantity'];
          $description = $row['description'];
          $image = $row['image'];
          $orderDatetime = $row['order_datetime'];
          $orderStatus = $row['order_status'];

          $order = new Order();
          $order->setOrderId($orderId);
          $order->setCustomerId($customerId);
          $order->setMaker($maker);
          $order->setProduct($product);
          $order->setQuantity($quantity);
          $order->setDescription($description);
          $order->setImage($image);
          $order->setOrderDatetime($orderDatetime);
          $order->setOrderStatus($orderStatus);
          $orderHistory[$orderId] = $order;
        }
        return $orderHistory;
      }
    }
?>
