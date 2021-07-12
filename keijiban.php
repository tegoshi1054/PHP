<?php

// pdoを使ったデータベース接続
$dns = 'mysql:dbname=morijyobi; host=localhost';
$username = 'user01';
$password = 'morijyobi';

// 日付を設定
$week = array( "日", "月", "火", "水", "木", "金", "土" );
$format1 = "Y/m/d(";
$format2 = ")H:i:s";
date_default_timezone_set('Asia/Tokyo');
// date()関数を使用した表示。"w"オプションで配列から曜日を取得
$date = date($format1).$week[date('w')].date($format2);

// データベースに接続できるかの確認
try{
    $dns = new PDO($dns,$username,$password);
    echo "接続成功";
} catch(PDOException $e){
    echo "失敗:" . $e->getMessage()."/n";
    exit();
}

// POSTで受け取ったデータをDBに登録
$sqpl = "INSERT INTO keijiban (name,comment,date)
            VALUES (:name,:comment,:date)" ;
$stmt = $dns->prepare($sqpl);

if ($_POST['name'] === "" && $_POST['comment'] === ""){
    $akb48 = '名前を入力してください';
}else{
    $params = array(':name' => $_POST['name'],':comment' => $_POST['comment'],':date' => $date);
    $stmt->execute($params);

}
// $params = array(':name' => $_POST['name'],':comment' => $_POST['comment'],':date' => $date,'session'=>$session_sql);
// $stmt->execute($params);

?>
 
<!-- ここからHTMLの記述 -->

<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>
    <h1>盛ジョビ掲示板</h1>
    <!-- CSSの読み込み -->
    <link rel="stylesheet" href="style.css">
<!-- ここに、書き込まれたデータを表示する -->
<?php
    $SQL= 'SELECT id,name,date,comment FROM keijiban';
    foreach ($dns->query($SQL) as $a){
        echo "<div class=box>";
        echo '<div class=bold>'.$a['id'].' '."名前：".'<div class=name>'.$a['name'].'</div>'.' '.$a['date'].'</div>'.'<br>';
        echo $a['comment'].'<br>';
        echo "</div>";
    }
    

?>
    <body>
    <!-- 入力フォーム -->
        <form method="post" action="keijiban.php">
            <input type="text" name="name" value="" placeholder="名前" class="box3"/><br><br>
            <textarea name="comment" placeholder="コメント内容" class="box4"></textarea><br><br>
           <input type="submit" name="send" value="書き込む" class="button" />
        </form>
        

    </body>
</html>


<!-- git push
    git branch -M main     
    git push -u origin main
  -->

<!-- auto_incrementのリセット 
DELETE FROM [テーブル名]　WHERE [条件];
DELETE FROM [テーブル名]　WHERE name IS NULL;
ALTER TABLE keijiban auto_increment　=1: