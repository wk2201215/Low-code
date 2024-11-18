<?php
session_start();
require "../DB/db-connect.php"; 

try {
    $pdo = new PDO($connect, USER, PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("データベース接続エラー: " . $e->getMessage());
}

// 新規登録処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $username = $_POST['username'] ?? '';

    if ($email && $password && $username) {
        // パスワードをハッシュ化
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // ユーザー登録
        $sql = 'INSERT INTO acount (name, password, email) VALUES (:username, :password, :email)';
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                ':username' => $username,
                ':password' => $hashedPassword,
                ':email' => $email,
            ]);
            echo "ユーザー $username が登録されました。";
        } catch (PDOException $e) {
            echo "登録エラー: " . $e->getMessage();
        }
    } else {
        echo "すべてのフィールドを入力してください。";
    }
}
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
