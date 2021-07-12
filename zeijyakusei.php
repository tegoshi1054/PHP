<?php

try{
  $dns = new PDO('mysql:dbname=morijyobi; host=localhost', 'user01', 'morijyobi');
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $ps = $dns->query($sql); 
  // echo $ps->queryString;
  if($ps->rowCount() > 0){
    header('location: http://localhost/WEB/keijiban.php');
    
  }else{
    echo 'ログイン失敗';
  }
} catch(PDOException $e ){
    echo "error";
}
// SQLインジェクションの例
// ' OR 'a'='a
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>脆弱性ログインページ</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>脆弱性ログインページ</h1>
<div class="message"></div>
<div class="loginform">
  <form action="zeijyakusei.php" method="post">
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