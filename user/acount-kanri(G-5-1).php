<?php 
session_start(); 
require "../DB/db-conect.php"; 

// データベース接続
$pdo = new PDO($connect, USER, PASS);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/acount-knari.css">
    <title>アカウント管理</title>
    
</head>
<body>
    <h1>アカウント管理</h1>

    <?php
    // ログイン中のユーザーIDを取得
    if (isset($_SESSION['user']['id'])) {
        $profileUserId = $_SESSION['user']['id'];

        // ユーザーのアカウント情報を取得
        $sql = "SELECT acount_id, password, name FROM acount WHERE acount_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$profileUserId]);

        // 結果を表示
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            echo '<table>';
            echo '<tr><th>アカウントID</th><td>' . htmlspecialchars($row['acount_id']) . '</td></tr>';
            echo '<tr><th>パスワード</th><td>' . htmlspecialchars($row['password']) . '</td></tr>';
            echo '<tr><th>名前</th><td>' . htmlspecialchars($row['name']) . '</td></tr>';
            echo '</table>';

            // 編集ボタン
            echo '<button onclick="location.href=\'acount-hensyu(G-5-2).php\'">編集</button>';

            // 削除ボタン
            // echo '<button onclick="confirmDelete()">削除</button>';
        } else {
            echo 'アカウント情報が見つかりません。';
        }
    } else {
        echo 'ログインしていません。';
    }
    ?>

    <!-- <script>
        // 削除確認の関数
        function confirmDelete() {
            if (confirm('本当にアカウントを削除しますか？')) {
                location.href = 'delete-account.php';  // 削除処理のページに遷移
            }
        }
    </script> -->

</body>
</html>
