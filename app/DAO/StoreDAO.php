<?php
  /**
   * 就プレ　EYERESERVE ユーザ側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=StoreDAO.php
   * ディレクトリ=/ph34/eyereserve/app/DAO/
   */


    namespace App\Dao;


    use PDO;
    use App\Entity\Store;

   /**
    * storeテーブルへのデータ操作クラス
    */

    class StoreDAO{
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
       * 主キーによる検索
       * 
       * @param int $storeId 主キー
       * @return Store 該当するStoreオブジェクト。ただし、該当データがない場合はnull
       */
      public function findById(int $storeId): ?Store{
        $sql = 'SELECT * FROM stores WHERE store_id = :storeId';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':storeId',$storeId,PDO::PARAM_INT);
        $result = $stmt->execute();
        $store = null;
        if($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $storeId = $row['store_id'];
          $loginPassword = $row['login_password'];
          $storeCategory = $row['store_category'];
          $storeCompany = $row['store_company'];
          $storeBrand = $row['store_brand'];
          $storeName = $row['store_name'];
          $storeTel = $row['store_tel'];
          $storePostNumber = $row['store_post_number'];
          $storePostPre = $row['store_post_pre'];
          $storePostCity = $row['store_post_city'];
          $storePostAddress1 = $row['store_post_address1'];
          $storePostAddress2 = $row['store_post_address2'];
          $update = $row['update'];
          $image = $row['image'];

          $store = new Store();
          $store->setStoreId($storeId);
          $store->setLoginPassword($loginPassword);
          $store->setStoreCategory($storeCategory);
          $store->setStoreCompany($storeCompany);
          $store->setStoreBrand($storeBrand);
          $store->setStoreName($storeName);
          $store->setStoreTel($storeTel);
          $store->setStorePostNumber($storePostNumber);
          $store->setStorePostPre($storePostPre);
          $store->setStorePostCity($storePostCity);
          $store->setStorePostAddress1($storePostAddress1);
          $store->setStorePostAddress2($storePostAddress2);
          $store->setUpdate($update);
          $store->setImage($image);
        }
        return $store;
      }


    }
?>
