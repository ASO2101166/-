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
          
        ?>
        <div class="waku">
          <div class="order">
            <p class="">配送予定日<br>2022/09/06</p>
            <p class="">合計金額<br>¥19,580</p>
          </div>
          <div class="orderdetail-area">
            <div class="orderdetail">
              <div class="order-image-area">
                <img class="order-image" src="images/bag.jpg" height="100" >
              </div>
              <div>
                <a class ="item-name">スニーカー</a>
                <div class ="bottom">¥9,790(税込)</div>
                <div class ="right">個数：１</div>
              </div>
              <form action="" method="post" class="orderform">
                <input type="submit" value="再度カートに入れる" class="cartbtn">
              </form>
            </div>
            <div class="hr"></div>
            <div class="orderdetail">
              <div class="order-image-area">
                <img class="order-image" src="images/bag.jpg" height="100" >
              </div>
              <div>
                <a class ="item-name">スニーカー</a>
                <div class ="bottom">¥9,790(税込)</div>
                <div class ="right">個数：１</div>
              </div>
              <form action="" method="post" class="orderform">
                <input type="submit" value="再度カートに入れる" class="cartbtn">
              </form>
            </div>
            <div class="hr"></div>
            <div class="orderdetail">
              <div class="order-image-area">
                <img class="order-image" src="images/bag.jpg" height="100" >
              </div>
              <div>
                <a class ="item-name">スニーカー</a>
                <div class ="bottom">¥9,790(税込)</div>
                <div class ="right">個数：１</div>
              </div>
              <form action="" method="post" class="orderform">
                <input type="submit" value="再度カートに入れる" class="cartbtn">
              </form>
            </div>
          </div>
        </div>
        
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