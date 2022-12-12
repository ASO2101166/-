<?php
    require_once 'Dbconnect.php';
    $raw = file_get_contents('php://input');
    $data = json_decode($raw,true);
    if($data['genre_code'] != 'no'){
        $cls = new Dbconnect();
        $pdo = $cls->dbConnect();
        $sql = "SELECT * FROM items WHERE genre_code = ? LIMIT ?;";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1,$data['genre_code'],PDO::PARAM_STR);
        $ps->bindValue(2,$data['count'],PDO::PARAM_INT);
        $ps->execute();
        $itemData = $ps->fetchAll();
        $res = '';
        foreach($itemData as $item){
            $res = $res.'<div class="list blur blurstyle">
                            <figure><img src="images/'.$item["item_image"].'" alt=""></figure>
                            <div class="text">
                                <h4>'.$item['item_name'].'</h4>
                                <p>'.$item['explanation'].'</p>
                            </div>
                            <form action="php/CartCreate.php" method="post">
                                <input type="hidden" name="item_id" value="'.$item['item_id'].'">
                                <p class="btn"><input type="submit" value="カートに入れる"></p>
                            </form>
                            <form action="ItemDetail.php" method="post">
                                <p class="btn"><input type="submit" value="詳しく見る"></p>
                                <input type="hidden" name="item[item_id]" value="'.$item['item_id'].'">
                                <input type="hidden" name="item[item_name]" value="'.$item['item_name'].'">
                                <input type="hidden" name="item[item_image]" value="'.$item['item_image'].'">
                                <input type="hidden" name="item[explanation]" value="'.$item['explanation'].'">
                                <input type="hidden" name="item[unit_price]" value="'.$item['unit_price'].'">
                                <input type="hidden" name="item[genre_code]" value="'.$item['genre_code'].'">
                                <input type="hidden" name="item[set_discount_division]" value="'.$item['set_discount_division'].'">
                            </form>
                            <span class="new">NEW</span>
                        </div>';
        }
        $sql = "
                SELECT CASE
                          WHEN Btbl.bcnt = tbl.cnt THEN true
                          ELSE false
                       END AS 'CHECK'
                FROM (SELECT COUNT(*) AS bcnt FROM items WHERE genre_code = ?) AS Btbl,
                     (SELECT COUNT(*) AS cnt FROM (SELECT * FROM items WHERE genre_code = ? LIMIT ?) AS lmttbl) AS tbl;
                ";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1,$data['genre_code'],PDO::PARAM_STR);
        $ps->bindValue(2,$data['genre_code'],PDO::PARAM_STR);
        $ps->bindValue(3,$data['count'],PDO::PARAM_INT);
        $ps->execute();
        $itemData = $ps->fetchAll();
        foreach($itemData as $item){
            if($item['CHECK'] == true){
                $res = $res.'OK';
            }else{
                $res = $res.'NG';
            }
        }
        echo json_encode($res);
    }else{
        $cls = new Dbconnect();
        $pdo = $cls->dbConnect();
        $sql = "SELECT * FROM items LIMIT ?;";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1,$data['count'],PDO::PARAM_INT);
        $ps->execute();
        $itemData = $ps->fetchAll();
        $res = '';
        foreach($itemData as $item){
            $res = $res.'<div class="list blur blurstyle">
                            <figure><img src="images/'.$item["item_image"].'" alt=""></figure>
                            <div class="text">
                                <h4>'.$item['item_name'].'</h4>
                                <p>'.$item['explanation'].'</p>
                            </div>
                            <form action="php/CartCreate.php" method="post">
                                <input type="hidden" name="item_id" value="'.$item['item_id'].'">
                                <p class="btn"><input type="submit" value="カートに入れる"/></p>
                            </form>
                            <form action="ItemDetail.php" method="post">
                                <p class="btn"><input type="submit" value="詳しく見る"/></p>
                                <input type="hidden" name="item[item_id]" value="'.$item['item_id'].'">
                                <input type="hidden" name="item[item_name]" value="'.$item['item_name'].'">
                                <input type="hidden" name="item[item_image]" value="'.$item['item_image'].'">
                                <input type="hidden" name="item[explanation]" value="'.$item['explanation'].'">
                                <input type="hidden" name="item[unit_price]" value="'.$item['unit_price'].'">
                                <input type="hidden" name="item[genre_code]" value="'.$item['genre_code'].'">
                                <input type="hidden" name="item[set_discount_division]" value="'.$item['set_discount_division'].'">
                            </form>
                            <span class="new">NEW</span>
                        </div>';
        }
        $sql = "
                SELECT CASE
                          WHEN Btbl.bcnt = tbl.cnt THEN true
                          ELSE false
                       END AS 'CHECK'
                FROM (SELECT COUNT(*) AS bcnt FROM items) AS Btbl,
                     (SELECT COUNT(*) AS cnt FROM (SELECT * FROM items LIMIT ?) AS lmttbl) AS tbl;
                ";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1,$data['count'],PDO::PARAM_INT);
        $ps->execute();
        $itemData = $ps->fetchAll();
        foreach($itemData as $item){
            if($item['CHECK'] == true){
                $res = $res.'OK';
            }else{
                $res = $res.'NG';
            }
        }
        echo json_encode($res);
    }

?>