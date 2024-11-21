<?php
// データベース接続情報
const SERVER = 'mysql310.phy.lolipop.lan';
const DBNAME = 'LAA1517446-lowcode';
const USER = 'LAA1517446';
const PASS = 'lowcode';

// DSN (Data Source Name) を設定
$dsn = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';

try {
    // PDOインスタンスを作成してデータベースに接続
    $pdo = new PDO(
        $dsn,       // DSN
        USER,       // ユーザー名
        PASS,       // パスワード
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,      // エラーモード (例外)
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // デフォルトのフェッチモード (連想配列)
        ]
    );
    echo "データベース接続成功！";
} catch (PDOException $e) {
    // エラー発生時の処理
    die("データベース接続エラー: " . $e->getMessage());
}
?>
