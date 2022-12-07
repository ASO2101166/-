<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>商品詳細画面</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <meta name="description" content="ここにサイト説明を入れます">
  <link rel="stylesheet" href="css/style.css">

  <?php
    if(!isset($_SESSION)){
      session_start();
    }
    require_once 'php/ItemSetSelect.php';
  ?>
</head>

<body>

  <div id="container">

    <!-- ヘッダー部分 -->
    <header>
      <?php include('template/Header.php');?>
    </header>

    <main>

      <article>
        <?php
          $item = $_POST['item'];
          $ClsItemSetSelect = new ItemSetSelect();
          $itemsetData = $ClsItemSetSelect->itemsetselect($item['set_discount_division'], $item['item_id']);
        ?>
        <h2><?php echo $item['item_name']?></h2>
        <h1><i class="bi bi-currency-yen"></i><?php echo $item['unit_price']?></h1>

        <p><img src="images/<?php echo $item['item_image']?>" alt=""></p>
        <h4><?php echo $item['explanation']?></h4>
        <?php
          if(!empty($itemsetData)){

        ?>
        <h2>1,600円のセット購入割</h2>
        <div class="list-container">

          <div class="list blur">
            <figure><img src="images/<?php echo $item['item_image']?>" alt=""></figure>
            <div class="text">
              <h4><?php echo $item['item_name']?></h4>
              <h4><i class="bi bi-currency-yen"></i><?php echo $item['unit_price']?></h4>
            </div>
            <form action="php/CartCreate.php" method="post">
              <input type="hidden" name="item_id" value="<?php echo $item['item_id']?>">
              <p class="btn"><input type="submit" value="カートに入れる"></p>
            </form>
            <span class="new">人気！</span>
          </div>

          <div class="lisblu">
            <figure><img src="images/ItemDetail1.jpg" alt=""></figure>
          </div>
          <?php
            foreach($itemsetData as $itemset){

            
          ?>
          <div class="list blur">
            <figure><img src="images/<?php echo $itemset['item_image'];?>" alt=""></figure>
            <div class="text">
              <h4><?php echo $itemset['item_name'];?></h4>
              <h4><i class="bi bi-currency-yen"></i><?php echo $itemset['unit_price'];?></h4>
            </div>
            <form action="php/CartCreate.php" method="post">
              <input type="hidden" name="item_id" value="<?php echo $itemset['item_id']?>">
              <p class="btn"><input type="submit" value="カートに入れる"></p>
            </form>
          </div>
          <?php
            }
          ?>
        </div>
        <?php
          }
        ?>
        <section>

        </section>

        <p class="c"><a href="javascript:history.back()">&lt;&lt; 前のページに戻る</a></p>

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



</body>
</html>
