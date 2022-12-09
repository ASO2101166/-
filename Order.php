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
                            $totalprice = 0;
                            $count = 0;
                            $set = FALSE;
                            foreach($_POST['item'] as $item){
                                for($i = 0; $i < count($_POST['item']); $i++){
                                    if($i != $count && $_POST['item'][$i]['set_discount_division'] == $item['set_discount_division']){
                                        $set = TRUE;
                                    }
                                }
                        ?>
                        <div class="list blur">
                            <figure><img src="images/<?php echo $item['item_image'];?>" alt=""></figure>
                            <div class="text">
                                <h4><?php echo $item['item_name'];?></h4>
                                <h3>数量：<?php echo $item['quantity']?></h3>
                                <h1><i class="bi bi-currency-yen"></i><?php echo number_format($item['unit_price']);?></h1>
                            </div>
                        </div>
                        <!-- OrderCreate.php に送るフォームの内容 -->
                        <input type="hidden" form="OrderHistoryForm" name="cart_id[<?php echo $count;?>]" value="<?php echo $item['cart_id'];?>">
                        <!-- ------------------------------------ -->
                        <?php
                                $totalprice += $item['quantity'] * $item['unit_price'];
                                $count++;
                            }
                        ?>
                        <div>
                            <h2>注文内容</h2>
                            <h3>　小計：¥<?php echo number_format($totalprice);?></h3>
                            <h3>　配送料：¥500</h3>
                            <h3>　合計：¥<?php echo number_format($shougoukei = $totalprice + 500)?></h3>
                            <h2>割引</h2>
                            <h3>　配送料：¥<?php if($totalprice >= 10000){echo $haisou = 500;}else{echo $haisou = 0;}?></h3>
                            <h3>　セット割：¥<?php if($set == TRUE){echo number_format($setwari = $totalprice * 0.1);}else{echo $setwari = 0;}?></h3>
                            <h1 class="goukei">合計：¥<?php echo number_format($daikei = $shougoukei - $haisou - $setwari);?></h1>
                        </div>

                    </div>
                    <!--/.list-container-->
                    <form action="php/OrderCreate.php" id="OrderHistoryForm" method="post">
                        <input type="hidden" name="totalprice" value="<?php echo $daikei?>">
                        <input type="hidden" name="point" value="<?php echo $totalprice * 0.02;?>">
                        <input type="submit" value="注文確定" class="button004">
                    </form>
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


