<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>商品一覧画面</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <meta name="description" content="ここにサイト説明を入れます">
  <link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" href="css/ItemList.css">
  <link rel="stylesheet" href="css/genre.css">

  <?php
    if(!isset($_SESSION)){
      session_start();
    }
    require_once 'php/ItemSelect.php';
    require_once 'php/GenreSelect.php';
    
  ?>
</head>

<body class="home">

  <div id="container">

    <!-- ヘッダー部分 -->
    <header>
    <?php include('template/Header.php');?>
    <h1 id="logo"><a href="ItemList.html" class="menu"></a>
          <!-- ハンバーガーメニュー部分 -->
        <div class="nav">  
          <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
          <input id="drawer_input" class="drawer_hidden" type="checkbox">  
          <!-- ハンバーガーアイコン -->
          <label for="drawer_input" class="drawer_open"><span></span></label>   
          <!-- メニュー -->
          <nav class="nav_content">
          <ul id="accordion" class="accordion">
              <?php
                $ClsGenreSelect = new GenreSelect();
                $genrelevel1 = $ClsGenreSelect->genreselectlevel1();
                foreach($genrelevel1 as $genre1){
              ?>
              <li>
                <div class="link"><i class="fa fa-rikuzyo"></i><?php echo $genre1['genre_name']?><i class="fa fa-chevron-down"></i></div>
                <ul class="submenu">
                  <?php
                    $genrelevel2 = $ClsGenreSelect->genreselectlevel2($genre1['genre_code']);
                    foreach($genrelevel2 as $genre2){
                  ?>
                  <form action="ItemList.php" method="post">
                    <input type="hidden" name="genre_code" value="<?php echo $genre2['genre_code']?>">
                    <li><input type="submit" value="<?php echo $genre2['genre_name']?>"/></li>
                  </form>
                  <?php
                    }
                  ?>
                </ul>
              </li>
              <?php
                }
              ?>
            </ul>
          </nav>
        </div>
      </h1>
      
    </header>
    <section>

    </section>
  

    <!--スライドショー（slick）-->
    <!-- Contenedor -->
    
    <div class="mainimg">
      <div><img src="images/ItemList1.jpg" alt=""></div>
      <div><img src="images/ItemList2.jpg" alt=""></div>
      <div><img src="images/ItemList3.jpg" alt=""></div>
    </div>



    <main>

      <div class="bg1">

        <section>

          <h2>Topics<i class="bi bi-emoji-sunglasses"></i></h2>

          <div class="list-container">
            <?php
              $ClsItemSelect = new ItemSelect();
              if(isset($_POST['genre_code'])){
                $itemData = $ClsItemSelect->itemselectBygenre($_POST['genre_code']);
              }else{
                $itemData = $ClsItemSelect->itemselect();
              }
              foreach($itemData as $row){
            ?>
            <div class="list blur">
              <figure><img src="images/<?php echo $row['item_image']?>" alt=""></figure>
              <div class="text">
                <h4><?php echo $row['item_name'];?></h4>
                <p><?php echo $row['explanation'];?></p>
              </div>
              <form action="php/CartCreate.php" method="post">
                <input type="hidden" name="item_id" value="<?php echo $row['item_id']?>">
                <p class="btn"><input type="submit" value="カートに入れる"></p>
              </form>
              <!-- <p class="btn"><a href="Cart.html">カートに入れる</a></p> -->
              <form action="ItemDetail.php" method="post">
                <p class="btn"><input type="submit" value="詳しく見る"></p>
                <input type="hidden" name="item[item_id]" value="<?php echo $row['item_id']?>">
                <input type="hidden" name="item[item_name]" value="<?php echo $row['item_name']?>">
                <input type="hidden" name="item[item_image]" value="<?php echo $row['item_image']?>">
                <input type="hidden" name="item[explanation]" value="<?php echo $row['explanation']?>">
                <input type="hidden" name="item[unit_price]" value="<?php echo $row['unit_price']?>">
                <input type="hidden" name="item[genre_code]" value="<?php echo $row['genre_code']?>">
                <input type="hidden" name="item[set_discount_division]" value="<?php echo $row['set_discount_division']?>">
              </form>
              <!-- <p class="btn"><a href="ItemDetail.html">詳しくみる</a></p> -->
              <span class="new">NEW</span>
            </div>
            <?php
              }
            ?>
          </div>
          <!--/.list-container-->
          <div class="itemcount" style="display:none;"><?php ?></div>
          <?php 
            if(isset($_POST['genre_code'])){
              $limitData = $ClsItemSelect->itemselectlimitBygenre($_POST['genre_code']);
            }else{
              $limitData = $ClsItemSelect->itemselectlimit();
            }
            foreach($limitData as $limit){
              if($limit['CHECK'] == false){
          ?>
            <p class="btn mt30"><button class="ws" type="button" name="button" onclick="mottomiru(event,'<?php if(isset($_POST['genre_code'])){echo $_POST['genre_code'];}else{echo 'no';}?>')">もっとみる<i class="bi bi-hand-index"></i></button></p>
          <?php 
              }
            }
          ?>

        </section>

      </div>

      <section>

      </section>

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

  <!--スライドショー（slick）-->
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="js/slick.js"></script>
  <script src="js/ItemList.js"></script>

</body>
</html>

