<?php
  // ここにDBに登録する処理を記述する


    //１　データベースに接続する処理
    $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');


    if(!empty($_POST)){
    $nickname = htmlspecialchars($_POST['nickname']);
    $comment = htmlspecialchars($_POST['comment']);
    $time = date('Y-m-d-G-i-s');
    $created = $time;

    //SQLに保存する
    $sql = 'INSERT INTO `posts`(`nickname`, `comment`,`created`) VALUES (?, ? ,?)';
    $data[] =  $nickname;
    $data[] =  $comment;
    $data[] = $created;
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    }

    $dbh = null;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>
</head>
<body>
    <form method="post" action="">
      <p><input type="text" name="nickname" placeholder="nickname"></p>
      <p><textarea type="text" name="comment" placeholder="comment"></textarea></p>
      <p><button type="submit" >つぶやく</button></p>
    </form>
    <!-- ここにニックネーム、つぶやいた内容、日付を表示する -->

</body>
</html>