<?php
session_start();
require 'db_config.php'; // データベース設定ファイルをインクルード

// エラーメッセージ
$error = "";

// フォームが送信された場合
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームからの入力を取得
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // ユーザーの存在確認
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($pass, $user['password'])) {
        // 認証成功、セッションIDの再生成
        session_regenerate_id(true);
        $_SESSION['email'] = $email;
        header("Location: welcome.php"); // ログイン後のページにリダイレクト
        exit();
    } else {
        $error = "メールアドレスまたはパスワードが間違っています。";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <style>
        /* スタイル設定は省略 */
    </style>
</head>
<body>
    <div class="container">
        <button class="register-btn" onclick="location.href='register.php'">新規登録</button>
        <form action="" method="post">
            <?php if ($error): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" required>
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="login-btn">ログイン</button>
        </form>
    </div>
</body>
</html>
