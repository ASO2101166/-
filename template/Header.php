<!--メニュー-->

<nav id="menubar">
    <ul> 
        <?php
            if(!isset($_SESSION)){
                session_start();
            }
            require_once 'php/UserInfo.php';
            require_once 'php/SessionCheck.php';
            $isLogin = FALSE;
            if(isset($_SESSION['user'])){
                $user = unserialize($_SESSION['user']);
                $isLogin = TRUE;
            }
                
            // $ClsSessionCheck = new SessionCheck();
            // $sessioncheck = $ClsSessionCheck->usersessioncheck();
        ?>
        <li><a href="ItemList.php">HOME<i class="bi bi-house"></i></a></li>
        <li><a href="Cart.php">カート<i class="bi bi-cart4"></i></a></li>
        <li><a href="OrderHistory.php">注文履歴<i class="bi bi-clipboard2-check"></i></a></li>
        <?php if($isLogin == true){?>
            <li><a href=""><?php echo $user->username;?>さん<?php echo $user->point;?>ポイント<i class="bi bi-p-circle"></i></a></li>
        <?php }?>
        <?php if($isLogin == true){?>
            <li><a href="php/Logout.php">ログアウト<i class="bi bi-person-slash"></i></a></li>
        <?php }else{?>
            <li><a href="Login.php">ログイン<i class="bi bi-person-slash"></i></a></li>
        <?php } ?>
    </ul>
</nav>

<!--開閉ボタン（ハンバーガーアイコン）-->
<div id="menubar_hdr">
    <span></span><span></span><span></span>
</div>