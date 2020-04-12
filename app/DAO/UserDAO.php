<?php
  /**
   * 就プレ　EYERESERVE ユーザ側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=UserDao.php
   * ディレクトリ=/ph34/eyereserve/app/DAO/
   */


    namespace App\Dao;


    use PDO;
    use App\Entity\User;

   /**
    * userテーブルへのデータ操作クラス
    */

    class UserDAO{
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
       * メールアドレスによる検索
       * 
       * @param string $loginMail メールアドレス
       * @return User 該当するUserオブジェクト。ただし、該当データがない場合はnull
       */
      public function findByMail(string $mail): ?User{
        $sql = 'SELECT * FROM customer WHERE mail = :loginMail';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':loginMail',$mail,PDO::PARAM_INT);
        $result = $stmt->execute();
        $user = null;
        if($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $customerId = $row['customer_id'];
          $mail = $row['mail'];
          $password = $row['password'];
          $name = $row['name'];
          $nameFuri = $row['name_furi'];
          $gender = $row['gender'];
          $birthday = $row['birthday'];
          $tel = $row['phon'];
          $post = $row['post_number'];
          $address = $row['address'];
          $addressDetails = $row['address_details'];
          $customerFlg = $row['customer_flg'];
          $point = $row['point'];

          $user = new User();
          $user->setCustomerId($customerId);
          $user->setMail($mail);
          $user->setPassword($password);
          $user->setName($name);
          $user->setNameFuri($nameFuri);
          $user->setGender($gender);
          $user->setBirthday($birthday);
          $user->setTel($tel);
          $user->setPost($post);
          $user->setAddress($address);
          $user->setAddressDetails($addressDetails);
          $user->setCustomerFlg($customerFlg);
          $user->setPoint($point);
        }
        return $user;
      }


      /**
       * 新規会員登録
       * 
       * @param User $user 登録情報が格納されたUserオブジェクト
       * @return integer 登録情報の連番主キーの値。登録に失敗した場合は-1
       */
      public function userInsert(User $user): int{
        $sqlInsert = 'INSERT INTO customer (mail, password, name, name_furi, gender, birthday, phon, post_number, address, address_details, customer_flg, point) VALUES (:mail, :password, :name, :name_furi, :gender, :birthday, :phon, :post_number, :address, :address_details, :customer_flg, :point)';
        $stmt = $this->db->prepare($sqlInsert);
        $stmt->bindValue(':mail',$user->getMail(),PDO::PARAM_INT);
        $stmt->bindValue(':password',$user->getPassword(),PDO::PARAM_INT);
        $stmt->bindValue(':name',$user->getName(),PDO::PARAM_INT);
        $stmt->bindValue(':name_furi',$user->getNameFuri(),PDO::PARAM_INT);
        $stmt->bindValue(':gender',$user->getGender(),PDO::PARAM_INT);
        $stmt->bindValue(':birthday',$user->getBirthday(),PDO::PARAM_INT);
        $stmt->bindValue(':phon',$user->getTel(),PDO::PARAM_INT);
        $stmt->bindValue(':post_number',$user->getPost(),PDO::PARAM_INT);
        $stmt->bindValue(':address',$user->getAddress(),PDO::PARAM_INT);
        $stmt->bindValue(':address_details',$user->getAddressDetails(),PDO::PARAM_INT);
        $stmt->bindValue(':customer_flg',$user->getCustomerFlg(),PDO::PARAM_INT);
        $stmt->bindValue(':point',$user->getPoint(),PDO::PARAM_INT);

        $result = $stmt->execute();
        if($result){
          $userId = $this->db->lastInsertId();
        }
        else{
          $userId = -1;
        }
        return $userId;
      }


      /**
       * ユーザー名取得
       * 
       * @param integer $customerID 注文したユーザーの顧客ID
       * @return string 注文したユーザーの名前
       */
      public function findByUserId(int $customerID): string{
        $sql = 'SELECT name FROM customer WHERE customer_id = :customerID';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':customerID',$customerID,PDO::PARAM_INT);

        $result = $stmt->execute();
        if($result){
          $row = $stmt->fetch();
          $userName = $row['name'];
        }
        return $userName;
      }

    }
?>
