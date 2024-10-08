<?php
    const SERVER = 'mysql302.phy.lolipop.lan';
    const DBNAME = 'LAA1517442-postingapp24';
    const USER = 'LAA1517442';
    const PASS = 'post0418';
 
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
</head>
<body>
    <form>
        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email"><br><br>

        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password"><br><br>

        <label for="username">ユーザーネーム:</label>
        <input type="text" id="username" name="username"><br><br>

        <button type="submit">新規登録</button>
    </form>
</body>
</html>
