<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>商品一覧画面</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <meta name="description" content="ここにサイト説明を入れます">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="./css/orderhistory.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <?php
    require_once 'php/ItemSelect.php';
    require_once 'php/GenreSelect.php';
    require_once 'php/OrderSelect.php';
  ?>
</head>

<body>

  <div id="container">

    <!-- ヘッダー部分 -->
    <header>
      <?php
        if(!isset($_SESSION)){
          session_start();
        }
        include('template/Header.php');
        if($isLogin == false){
          header('Location: Login.php');
          exit();
        }
      ?>
    </header>

    <main>
      <article>
        <?php
          $ClsOrderSelect = new OrderSelect();
          $orderdatas = $ClsOrderSelect->orderselectbyuserid($user->user_id);
          foreach($orderdatas as $orderdata){
        ?>
        <div class="waku">
          <div class="order">
            <p class="">注文日<br><?php echo $orderdata['order_date'];?></p>
            <p class="">合計金額<br>￥<?php echo number_format($orderdata['total_price']);?></p>
          </div>
          <div class="orderdetail-area">
            <?php
              $orderdetaildatas = $ClsOrderSelect->orderdetailselectbyorderid($orderdata['order_id']);
              $length = count($orderdetaildatas);
              $count = 0;
              foreach($orderdetaildatas as $orderdetaildata){
            ?>
            <div class="orderdetail">
              <div class="order-image-area">
                <img class="order-image" src="images/<?php echo $orderdetaildata['item_image'];?>" height="100" >
              </div>
              <div>
                <form id="ItemDetailForm" action="ItemDetail.php" method="post">
                  <input type="hidden" name="item[item_id]" value="<?php echo $orderdetaildata['item_id']?>">
                  <input type="hidden" name="item[item_name]" value="<?php echo $orderdetaildata['item_name']?>">
                  <input type="hidden" name="item[item_image]" value="<?php echo $orderdetaildata['item_image']?>">
                  <input type="hidden" name="item[explanation]" value="<?php echo $orderdetaildata['explanation']?>">
                  <input type="hidden" name="item[unit_price]" value="<?php echo $orderdetaildata['unit_price']?>">
                  <input type="hidden" name="item[genre_code]" value="<?php echo $orderdetaildata['genre_code']?>">
                  <input type="hidden" name="item[set_discount_division]" value="<?php echo $orderdetaildata['set_discount_division']?>">
                  <input type="submit" value="<?php echo $orderdetaildata['item_name'];?>">
                </form>
                <div class ="bottom">￥<?php echo number_format($orderdetaildata['unit_price']);?></div>
                <div class ="right">個数：<?php echo $orderdetaildata['quantity'];?></div>
              </div>
              <form action="php/CartRegister.php" method="post" class="orderform">
                <input type="hidden" name="order[item_id]" value="<?php echo $orderdetaildata['item_id']?>">
                <input type="hidden" name="order[user_id]" value="<?php echo $user->user_id;?>">
                <input type="submit" value="再度カートに入れる" class="cartbtn">
              </form>
            </div>
            <?php
                $count++;
                if($count !== $length){
            ?>
            <div class="hr"></div>
            <?php
                }
              }
            ?>
          </div>
        </div>
        <?php
          }
        ?>
      </article>
    </main>

    <!-- フッター部分 -->
    <footer>
      <?php include('template/Footer.php');?>
    </footer>

    <!--ページの上部へ戻るボタン-->
    <div class="pagetop"><a href="#"><i class="fas fa-angle-double-up"></i></a></div>

  </div>
  <!--/#container-->

  <!--jQueryの読み込み-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!--パララックス（inview）-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/protonet-jquery.inview/1.1.2/jquery.inview.min.js"></script>
  <script src="js/jquery.inview_set.js"></script>

  <!--このテンプレート専用のスクリプト-->
  <script src="js/main.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>