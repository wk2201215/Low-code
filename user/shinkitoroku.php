<?php 
session_start();
require "../DB/db-connect.php"; 



$pdo = new PDO($connect, USER, PASS);

// ユーザー削除処理
if (isset($_POST['delete_user_id'])) {
    $deleteUserId = $_POST['delete_user_id'];
    $sql = 'DELETE FROM acount WHERE acount_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$deleteUserId]);

    echo "ユーザーID $deleteUserId が削除されました。";
}

// 全ユーザーの情報を取得
$sql = 'SELECT acount_id, name, password FROM acount';
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
</head>
<body>
    <form method="POST" action="">
        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="username">ユーザーネーム:</label>
        <input type="text" id="username" name="username" required><br><br>
        <button type="submit">新規登録</button>
    </form>
</body>
</html>
