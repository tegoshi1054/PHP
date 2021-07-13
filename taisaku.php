<?php
// HTMLから取得した値をPOSTで受け取る
$useename = $_POST['username'];
$password = $_POST['password'];

// tyr catch メインの処理と例外の処理をする
try{
  // 　SQLインジェクションの例外処理をする
    $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
                        PDO::ATTR_EMULATE_PREPARES => false);
    // データベースに接続
    $db = new PDO('mysql:dbname=morijyobi; host=localhost', 'user01', 'morijyobi',$opt);
    // パスワードとユーザーネームが一致sqlを格納
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $ps = $db->prepare($sql);
    // bindValueでバインドする
    $ps->bindValue(1,$useename,PDO::PARAM_STR);
    $ps->bindValue(2,$password,PDO::PARAM_STR);
    $ps->execute();
    // パスワードとユーザー名が一致したら掲示板に飛ぶ
    // rowCount()　$sqlのSQｌ文に一致した行数を格納する関数。
    // もし一致した場合、０よりも大きくなるので、掲示板に飛ぶ仕様になっている。
    if ($ps->rowCount() > 0){
        header('location: http://localhost/WEB/keijiban.php');
    }else{
        echo '正しいパスワードと名前を入力してください';
    }
}catch(PDOException $e ){
    echo "error";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>正規のログインページ</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>正規のログインページ</h1>
<div class="message"></div>
<div class="loginform">
  <form action="taisaku.php" method="post">
  <link rel="stylesheet" href="style.css">
    <ul>
    <p><input name="username" type="text" class="box3" placeholder="ユーザー名"></p>
    <p><input name="password" type="text" class="box3" placeholder="パスワード"></p>
    <input name="送信" type="submit" class="button1">
    </ul>
  </form>
</div>
</div>
</body>
</html>

<!-- 
git remote add origin https://github.com/tegoshi1054/PHP.git
git branch -M main
git push -u origin main
 -->