<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>注文確定画面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ここにサイト説明を入れます">
    <script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
    <meta name="robots" content="noindex,follow" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="home">

    <div id="container">

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
                if(!isset($_POST['item'])){
                    header('Location: Cart.php');
                    exit();
                }
            ?>
        </header>

        <main>
            <div class="bg1">

                <section>
                    <h2><?php echo count($_POST['item']);?>点のご購入<i class="bi bi-basket2"></i></h2>
                    <div class="list-container">
                        <?php
                            $count = 0;
                            foreach($_POST['item'] as $item){

                        ?>
                        <div class="list blur">
                            <figure><img src="images/<?php echo $item['item_image'];?>" alt=""></figure>
                            <div class="text">
                                <h4><?php echo $item['item_name'];?></h4>
                                <h3>数量：<?php echo $item['quantity']?></h3>
                                <h1><i class="bi bi-currency-yen"></i><?php echo $item['unit_price']?></h1>
                            </div>
                        </div>
                        <!-- OrderCreate.php に送るフォームの内容 -->
                        <input type="hidden" form="OrderHistoryForm" name="cart_id[<?php echo $count;?>]" value="<?php echo $item['cart_id'];?>">
                        <!-- ------------------------------------ -->
                        <?php
                                $count++;
                            }
                        ?>
                        <div>
                            <h2>注文内容</h2>
                            <h3>　小計：¥</h3>
                            <h3>　配送料：¥</h3>
                            <h3>　合計：¥</h3>
                            <h2>割引</h2>
                            <h3>　配送料：－¥</h3>
                            <h3>　セット割：－¥</h3>
                            <h1 class="goukei">合計：¥</h1>
                        </div>

                    </div>
                    <!--/.list-container-->
                    <div class="button004">
                        <form action="php/OrderCreate.php" id="OrderHistoryForm" method="post">
                            <input type="submit" value="注文確定">
                        </form>
                    </div>
                    <div class="button005">
                        <a href="Cart.php">戻る</a>
                    </div>

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

</body>
</html>


