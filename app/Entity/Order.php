<?php
  /**
   * 就プレ　EYERESERVE ユーザ側
   * 
   * 
   *
   * @author 
   *
   * ファイル名=Order.php
   * ディレクトリ=/ph34/eyereserve/app/Entity/
   */


  namespace App\Entity;

   /**
    * オーダーエンティティクラス
    */

    class Order{
      /**
       * 主キーのid
       */
      private $orderId;

      /**
       * カスタマーID
       */
      private $customerId;

      /**
       * ストアID
       */
      private $storeId;

      /**
       * メーカー・ブランド名
       */
      private $maker;

      /**
       * 商品名
       */
      private $product;

      /**
       * 個数
       */
      private $quantity;

      /**
       * 商品の説明
       */
      private $description;

      /**
       * 商品の画像URL
       */
      private $image;

      /**
       * 注文日時
       */
      private $orderDatetime;

      /**
       * 注文状況
       */
      private $orderStatus;


      //以下アクセサメソッド
      public function getOrderId(): ?int{
        return $this->orderId;
      }
      public function setOrderId(int $orderId): void{
        $this->orderId = $orderId;
      }

      public function getCustomerId(): ?int{
        return $this->customerId;
      }
      public function setCustomerId(int $customerId): void{
        $this->customerId = $customerId;
      }

      public function getStoreId(): ?int{
        return $this->storeId;
      }
      public function setStoreId(int $storeId): void{
        $this->storeId = $storeId;
      }

      public function getMaker(): ?string{
        return $this->maker;
      }
      public function setMaker(?string $maker) :void{
        $this->maker = $maker;
      }

      public function getProduct(): ?string{
        return $this->product;
      }
      public function setProduct(?string $product) :void{
        $this->product = $product;
      }

      public function getQuantity(): ?string{
        return $this->quantity;
      }
      public function setQuantity(?string $quantity) :void{
        $this->quantity = $quantity;
      }

      public function getDescription(): ?string{
        return $this->description;
      }
      public function setDescription(?string $description) :void{
        $this->description = $description;
      }

      public function getImage(): ?string{
        return $this->image;
      }
      public function setImage(?string $image) :void{
        $this->image = $image;
      }

      public function getOrderDatetime(): ?string{
        return $this->orderDatetime;
      }
      public function setOrderDatetime(?string $orderDatetime) :void{
        $this->orderDatetime = $orderDatetime;
      }

      public function getOrderStatus(): ?int{
        return $this->orderStatus;
      }
      public function setOrderStatus(?int $orderStatus) :void{
        $this->orderStatus = $orderStatus;
      }

    }
?>
