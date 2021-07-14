<?php
// SQLインジェクションを起こすために、脆弱性大にしてます。

// 日付を設定
$week = array( "日", "月", "火", "水", "木", "金", "土" );
$format1 = "Y/m/d(";
$format2 = ")H:i:s";
date_default_timezone_set('Asia/Tokyo');
// date()関数を使用した表示。"w"オプションで配列から曜日を取得
$date = date($format1).$week[date('w')].date($format2);

// 名前とコメントに何も値が入っていなければ、何もしない
if ($_POST['name'] == "" && $_POST['comment'] == "") {
    
    // 名前とコメントに値が入っていた場合、データベースに接続する処理を行う
} else {
    $dns = 'mysql:dbname=morijyobi; host=localhost';
    $username = 'user01';
    $password = 'morijyobi';
    try{
        $dns = new PDO($dns,$username,$password);
            // HTMLから値をPOSTで取得
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $email = $_POST['email'];
        // POSTで受け取ったデータをDBに登録
        $sqpl = "INSERT INTO keijiban (name,comment,date,email)
                    VALUES ('$name','$comment','$date','$email')";
        $sql2 = $email;
        $stmt = $dns->query($sqpl);
        $stm = $dns->query($sql2);
    } catch(PDOException $e){
        echo "失敗:" . $e->getMessage()."/n";
        exit();
    }
}
?>
 
<!-- ここからHTMLの記述 -->

<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>盛ジョビ掲示板</title>
    </head>
    <h1>盛ジョビ掲示板</h1>
    <!-- CSSの読み込み -->
    <link rel="stylesheet" href="style.css">
<!-- ここに、書き込まれたデータを表示する -->
<?php
    $SQL= 'SELECT id,name,date,comment FROM keijiban';

    if($_POST['name'] == "" && $_POST['comment'] == ""){
        echo 'コメントを入力してください';
    }else{
        foreach ($dns->query($SQL) as $a){
            echo "<div class=box>";
            echo '<div class=bold>'.$a['id'].' '."名前：".'<div class=name>'.$a['name'].'</div>'.' '.$a['date'].'</div>'.'<br>';
            echo $a['comment'].'<br>';
            echo "</div>";
        }
    }
?>
    <body>
    <!-- 入力フォーム -->
        <form method="post" action="keijiban.php">
            <input type="text" name="name" value="" placeholder="名前" class="box3"/><br><br>
            <textarea name="comment" placeholder="コメント内容" class="box4"></textarea><br>
            <p>メールアドレスは任意です</p>
            <input type="text" name="email"  placeholder="メールアドレスを入力してください" class="box5"></textarea><br><br>
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


xammpアクセス方法
http://localhost/WEB/taisaku.php