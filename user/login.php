<?php
session_start();
require "../DB/db-connect.php"; 

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <style>
        /* ページ全体のスタイル */
        body {
            background-color: #f7eff7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* コンテナのスタイル */
        .container {
            background-color: #f7eff7;
            padding: 20px;
            width: 300px;
            border: 1px solid #ccc;
            position: relative;
        }

        /* ラベルのスタイル */
        label {
            font-size: 16px;
            margin-top: 10px;
            display: block;
            color: #333;
        }

        /* 入力フィールドのスタイル */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #333;
            border-radius: 4px;
        }

        /* ログインボタンのスタイル */
        .login-btn {
            width: 100%;
            padding: 10px;
            background-color: #ccc;
            border: 1px solid #333;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        /* 新規登録ボタンのスタイル */
        .register-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            background-color: #ccc;
            border: 1px solid #333;
            border-radius: 4px;
            cursor: pointer;
        }

        /* エラーメッセージのスタイル */
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="register-btn">新規登録</button>
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