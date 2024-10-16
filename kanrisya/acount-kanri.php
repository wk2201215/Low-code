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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/acount-kanri(kanrisya).css" rel="stylesheet">
    <title>ユーザー管理</title>
</head>
<body>
    <h1>ユーザー管理</h1>

    <table>
        <thead>
            <tr>
                <th>ユーザーID</th>
                <th>名前</th>
                <th>パスワード</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['acount_id']) ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['password']) ?></td>
                <td>
                    <form method="post" onsubmit="return confirm('本当にこのユーザーを削除しますか？');">
                        <input type="hidden" name="delete_user_id" value="<?= $user['acount_id'] ?>">
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
