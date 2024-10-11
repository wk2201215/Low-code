<?php 
session_start();
require "../DB/db-connect.php"; 

// データベース接続
$pdo = new PDO($connect, USER, PASS);

// ユーザーの情報を取得
if (isset($_SESSION['user']['id'])) {
    $profileUserId = $_SESSION['user']['id'];
    
    // 編集フォームが送信された場合の処理
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $password = $_POST['password'];

        // ユーザー情報の更新
        $sql = 'UPDATE acount SET name = ?, password = ? WHERE acount_id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $password, $profileUserId]);

        echo "アカウント情報が更新されました。";
    }

    // 現在のユーザー情報を取得
    $sql = 'SELECT name, password FROM acount WHERE acount_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$profileUserId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/acount-hensyu.css">
    <title>アカウント編集</title>
    <style>
       
    </style>
</head>
<body>
    <h1>アカウント編集</h1>

    <?php if ($user): ?>
    <form action="acount-kanri(G-5-1).php" method="post">
        <label for="name">名前</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" value="<?= htmlspecialchars($user['password']) ?>" required>

        <button type="submit">更新</button>
    </form>
    <?php else: ?>
    <p>ユーザー情報が見つかりません。</p>
    <?php endif; ?>
</body>
</html>
