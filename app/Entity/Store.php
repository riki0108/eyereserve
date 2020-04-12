<?php
  /**
   * 就プレ　EYERESERVE ユーザ側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=Store.php
   * ディレクトリ=/ph34/eyereserve/app/Entity/
   */


  namespace App\Entity;

   /**
    * ストアエンティティクラス
    */

    class Store{
      /**
       * 主キーのid
       */
      private $storeId;

      /**
       * ログインパスワード
       */
      private $loginPassword;

      /**
       * カテゴリー
       */
      private $storeCategory;

      /**
       * 企業名
       */
      private $storeCompany;

      /**
       * ブランド
       */
      private $storeBrand;

      /**
       * 店名
       */
      private $storeName;

      /**
       * 電話番号
       */
      private $storeTel;

      /**
       * 郵便番号
       */
      private $storePostNumber;

      /**
       * 都道府県
       */
      private $storePostPre;

      /**
       * 市町村区
       */
      private $storePostCity;

      /**
       *  住所1
       */
      private $storePostAddress1;

      /**
       * 住所2
       */
      private $storePostAddress2;

      /**
       * 最終更新日
       */
      private $update;

      /**
       * 営業時間
       */
      private $storeBusinessHours;

      /**
       * 店の画像のURL
       */
      private $image;


      //以下アクセサメソッド
      public function getStoreId(): ?int{
        return $this->storeId;
      }
      public function setStoreId(int $storeId): void{
        $this->storeId = $storeId;
      }

      public function getLoginPassword(): ?string{
        return $this->loginPassword;
      }
      public function setLoginPassword(string $loginPassword): void{
        $this->loginPassword = $loginPassword;
      }

      public function getStoreCategory(): ?string{
        return $this->storeCategory;
      }
      public function setStoreCategory(string $storeCategory): void{
        $this->storeCategory = $storeCategory;
      }

      public function getStoreCompany(): ?string{
        return $this->storeCompany;
      }
      public function setStoreCompany(string $storeCompany): void{
        $this->storeCompany = $storeCompany;
      }

      public function getStoreBrand(): ?string{
        return $this->storeBrand;
      }
      public function setStoreBrand(?string $storeBrand) :void{
        $this->storeBrand = $storeBrand;
      }

      public function getStoreName(): ?string{
        return $this->storeName;
      }
      public function setStoreName(?string $storeName) :void{
        $this->storeName = $storeName;
      }

      public function getStoreTel(): ?string{
        return $this->storeTel;
      }
      public function setStoreTel(?string $storeTel) :void{
        $this->storeTel = $storeTel;
      }

      public function getStorePostNumber(): ?string{
        return $this->storePostNumber;
      }
      public function setStorePostNumber(?string $storePostNumber) :void{
        $this->storePostNumber = $storePostNumber;
      }

      public function getStorePostPre(): ?string{
        return $this->storePostPre;
      }
      public function setStorePostPre(?string $storePostPre) :void{
        $this->storePostPre = $storePostPre;
      }

      public function getStorePostCity(): ?string{
        return $this->storePostCity;
      }
      public function setStorePostCity(?string $storePostCity) :void{
        $this->storePostCity = $storePostCity;
      }

      public function getStorePostAddress1(): ?string{
        return $this->storePostAddress1;
      }
      public function setStorePostAddress1(?string $storePostAddress1) :void{
        $this->storePostAddress1 = $storePostAddress1;
      }

      public function getStorePostAddress2(): ?string{
        return $this->storePostAddress2;
      }
      public function setStorePostAddress2(?string $storePostAddress2) :void{
        $this->storePostAddress2 = $storePostAddress2;
      }

      public function getUpdate(): ?string{
        return $this->update;
      }
      public function setUpdate(?string $update) :void{
        $this->update = $update;
      }

      public function getStoreBusinessHours(): ?string{
        return $this->storeBusinessHours;
      }
      public function setStoreBusinessHours(?string $storeBusinessHours) :void{
        $this->storeBusinessHours = $storeBusinessHours;
      }

      public function getImage(): ?string{
        return $this->image;
      }
      public function setImage(?string $image) :void{
        $this->image = $image;
      }
    }
?>
