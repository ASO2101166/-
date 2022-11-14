<?php
    $raw = file_get_contents('php//input');
    $data = json_decode($raw);

    $res = $data.'返却';

    echo json_encode($res);
?>