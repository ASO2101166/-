<?php
    $raw = file_get_contents('php://input');
    $data = json_decode($raw);

    $res = $data.'phpの処理';

    echo json_encode($res);
?>