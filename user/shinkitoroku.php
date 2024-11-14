<?php
require 'db_config.php'; // データベース設定ファイルをインクルード

// フォームが送信されたときの処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $username = $_POST['username'] ?? '';

    // バリデーション
    if ($email && $password && $username) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // データベースにユーザー情報を挿入
        $stmt = $pdo->prepare("INSERT INTO users (email, password, username) VALUES (:email, :password, :username)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':username', $username);

        if ($stmt->execute()) {
            header("Location: login.php"); // 登録成功後、ログインページにリダイレクト
            exit();
        } else {
            $error = "登録に失敗しました";
        }
    } else {
        $error = "すべてのフィールドを入力してください";
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
