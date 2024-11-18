<?php
session_start();
require "../DB/db-connect.php"; 

// データベース接続の準備
try {
    $pdo = new PDO($connect, USER, PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("データベース接続エラー: " . $e->getMessage());
}

// エラーメッセージ
$error = "";

// フォームが送信された場合
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームからの入力を取得
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // ユーザーの存在確認
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .container label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }
        .container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .container button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .container button:hover {
            background-color: #0056b3;
        }
        .container .error {
            color: red;
            font-size: 12px;
            margin-bottom: 15px;
        }
        .register-btn {
            margin-top: 10px;
            text-align: center;
        }
        .register-btn a {
            color: #007BFF;
            text-decoration: none;
        }
        .register-btn a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="" method="post">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">ログイン</button>
        </form>
        <div class="register-btn">
            <a href="shinkitoroku.php">新規登録はこちら</a>
        </div>
    </div>
</body>
</html>
