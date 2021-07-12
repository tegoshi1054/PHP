<?php
$useename = $_POST['username'];
$password = $_POST['password'];

try{
    $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
                        PDO::ATTR_EMULATE_PREPARES => false);
    $db = new PDO('mysql:dbname=morijyobi; host=localhost', 'user01', 'morijyobi',$opt);
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $ps = $db->prepare($sql);
    $ps->bindValue(1,$useename,PDO::PARAM_STR);
    $ps->bindValue(2,$password,PDO::PARAM_STR);
    $ps->execute();
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
<h1>脆弱性ログインページ</h1>
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