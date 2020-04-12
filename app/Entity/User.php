<?php
  /**
   * 就プレ　EYERESERVE ユーザ側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=User.php
   * ディレクトリ=/ph34/eyereserve/app/Entity/
   */


  namespace App\Entity;

   /**
    * ユーザーエンティティクラス
    */

    class User{
      /**
       * 主キーのid
       */
      private $customerId;

      /**
       * メールアドレス
       */
      private $mail;

      /**
       * パスワード
       */
      private $password;

      /**
       * 名前
       */
      private $name;

      /**
       * 名前のフリガナ
       */
      private $nameFuri;

      /**
       * 性別
       */
      private $gender;

      /**
       * 生年月日
       */
      private $birthday;

      /**
       * 電話番号
       */
      private $tel;

      /**
       * 郵便番号
       */
      private $post;

      /**
       *  住所
       */
      private $address;

      /**
       * 住所の詳細
       */
      private $addressDetails;

      /**
       * 会員フラグ
       */
      private $customerFlg;

      /**
       * トークン
       */
      private $token;

      /**
       * 登録日時
       */
      private $date;


      //以下アクセサメソッド
      public function getCustomerId(): ?int{
        return $this->customerId;
      }
      public function setCustomerId(int $customerId): void{
        $this->customerId = $customerId;
      }

      public function getMail(): ?string{
        return $this->mail;
      }
      public function setMail(string $mail): void{
        $this->mail = $mail;
      }

      public function getPassword(): ?string{
        return $this->password;
      }
      public function setPassword(string $password): void{
        $this->password = $password;
      }

      public function getName(): ?string{
        return $this->name;
      }
      public function setName(?string $name) :void{
        $this->name = $name;
      }

      public function getNameFuri(): ?string{
        return $this->nameFuri;
      }
      public function setNameFuri(?string $nameFuri) :void{
        $this->nameFuri = $nameFuri;
      }

      public function getGender(): ?string{
        return $this->gender;
      }
      public function setGender(?string $gender) :void{
        $this->gender = $gender;
      }

      public function getBirthday(): ?string{
        return $this->birthday;
      }
      public function setBirthday(?string $birthday) :void{
        $this->birthday = $birthday;
      }

      public function getTel(): ?string{
        return $this->tel;
      }
      public function setTel(?string $tel) :void{
        $this->tel = $tel;
      }

      public function getPost(): ?string{
        return $this->post;
      }
      public function setPost(?string $post) :void{
        $this->post = $post;
      }

      public function getAddress(): ?string{
        return $this->address;
      }
      public function setAddress(?string $address) :void{
        $this->address = $address;
      }

      public function getAddressDetails(): ?string{
        return $this->addressDetails;
      }
      public function setAddressDetails(?string $addressDetails) :void{
        $this->addressDetails = $addressDetails;
      }

      public function getCustomerFlg(): ?string{
        return $this->customerFlg;
      }
      public function setCustomerFlg(?string $customerFlg) :void{
        $this->customerFlg = $customerFlg;
      }

      public function getPoint(): ?int{
        return $this->point;
      }
      public function setPoint(?int $point) :void{
        $this->point = $point;
      }
    }
?>
