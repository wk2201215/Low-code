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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規登録</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 20px;
      width: 300px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .container h1 {
      font-size: 18px;
      margin-bottom: 20px;
      text-align: center;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      font-size: 14px;
      margin-bottom: 5px;
    }
    .form-group input {
      width: 100%;
      padding: 8px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    .form-group input:focus {
      border-color: #007BFF;
      outline: none;
    }
    .btn-submit {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #007BFF;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      text-align: center;
    }
    .btn-submit:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>新規登録</h1>
    <form action="#" method="post">
      <div class="form-group">
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="name">名前</label>
        <input type="text" id="name" name="name" required>
      </div>
      <button type="submit" class="btn-submit">新規登録</button>
    </form>
  </div>
</body>
</html>