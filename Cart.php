<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>カート画面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ここにサイト説明を入れます">
    <script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <meta name="robots" content="noindex,follow" />
    <link rel="stylesheet" href="css/style.css">

    <?php
        if(!isset($_SESSION)){
            session_start();
        }
        
        require_once 'php/CartSelect.php';
    ?>
</head>

<body class="home">

    <div id="container">

        <!-- ヘッダー部分 -->
        <header>
            <?php 
                include('template/Header.php');
                if($isLogin == false){
                    header('Location: Login.php');
                    exit();
                }
            ?>
        </header>
        
        <main> 
            <div class="bg1">

                <section>
                    <h2><i class="bi bi-box-seam"></i> カート内の商品 <i class="bi bi-box-seam"></i></h2>
                    <div class="list-container">
                        <?php
                            $ClsCartSelect = new CartSelect();
                            $cartdatas = $ClsCartSelect->cartselectbyuserid($user->user_id);
                            $count = 0;
                            $totalprice = 0;
                            foreach($cartdatas as $cartdata){
                                
                        ?>
                        <div class="list blur">
                            <figure><img src="images/<?php echo $cartdata['item_image'];?>" alt=""></figure>
                            <div class="text">
                                <h4><?php echo $cartdata['item_name'];?></h4>
                                <p>配送予定日：</p>
                                <div class="quantity">
                                    <button class="minus-btn" type="button" name="button" 
                                            onclick="genshou(event,<?php echo $cartdata['cart_id'];?>,'hiki')">
                                        <img src="svg/minus.svg" alt="" style="pointer-events: none;"/>
                                    </button>
                                    <span class="cartkosuu"><?php echo $cartdata['quantity'];?></span>
                                    <button class="plus-btn" type="button" name="button" 
                                            onclick="zouka(event,<?php echo $cartdata['cart_id'];?>,'tasi')">
                                        <img src="svg/plus.svg" alt="" style="pointer-events: none;"/>
                                    </button>
                                </div>
                                <h1><i class="bi bi-currency-yen"></i><?php echo number_format($cartdata['unit_price']);?></h1>
                                <form action="php/CartDelete.php" method="post">
                                    <input type="hidden" name="cart_id" value="<?php echo $cartdata['cart_id'];?>">
                                    <input type="submit" value="商品を削除する">
                                </form>
                            </div>
                            <!-- Order.html に送るフォームの内容 -->
                            <input type="hidden" form="OrderForm" name="item[<?php echo $count?>][cart_id]" value="<?php echo $cartdata['cart_id']?>">
                            <input type="hidden" form="OrderForm" name="item[<?php echo $count?>][item_image]" value="<?php echo $cartdata['item_image']?>">
                            <input type="hidden" form="OrderForm" name="item[<?php echo $count?>][item_name]" value="<?php echo $cartdata['item_name']?>">
                            <input type="hidden" form="OrderForm" name="item[<?php echo $count?>][quantity]" value="<?php echo $cartdata['quantity']?>" class="quantityvalue">
                            <input type="hidden" form="OrderForm" name="item[<?php echo $count?>][unit_price]" value="<?php echo $cartdata['unit_price']?>" class="unit_pricevalue">
                            <input type="hidden" form="OrderForm" name="item[<?php echo $count?>][set_discount_division]" value="<?php echo $cartdata['set_discount_division']?>">
                            <!-- ----------------------------- -->
                        </div>
                        <?php
                                $count++;
                                $totalprice += $cartdata['unit_price'] * $cartdata['quantity'];
                            }
                        ?>
                        <div>
                            <h2>商品の個数：<?php echo $count;?>点</h2>
                            <div class="totalprice" style="display:none;"><?php echo $totalprice?></div>
                            <h2 class="muryou">無料配送まで：<?php
                                                if(10000 - $totalprice >= 1){
                                                    echo '￥'.number_format(10000 - $totalprice);
                                                }else{
                                                    echo  '到達しました';
                                                }
                                             ?>
                            </h2>
                            <h2 class="kakutokupoint">獲得ポイント：￥<?php echo number_format($totalprice * 0.02);?></h2>
                        </div>

                        

                    </div>
                    <!--/.list-container-->

                    <!-- Order.html に送るフォーム -->
                    <form action="Order.php" id="OrderForm" name="OrderForm" method="post">
                        <p class="btn mt30"><input type="submit" value="商品の注文手続きへ"class="ws"></p>
                    </form>

                </section>

            </div>

            <section>

            </section>
            <script type="text/javascript">
                            // $('.like-btn').on('click', function() {
                            //     $(this).toggleClass('is-active');
                            // });
            </script>
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
    <script src="js/main.js" async></script>

    <!--スライドショー（slick）-->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="js/slick.js"></script>

    <!-- カート個数増加・減少処理 -->
    <script src="js/CartUpdate.js"></script>

</body>
</html>

