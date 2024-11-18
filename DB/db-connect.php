<?php
    const SERVER = 'mysql310.phy.lolipop.lan';
    const DBNAME = 'LAA1517446-lowcode';
    const USER = 'LAA1517446';
    const PASS = 'lowcode';
 
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>try {
    $pdo = new PDO(
        'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8',
        USER,
        PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die("データベース接続エラー: " . $e->getMessage());
}
?>