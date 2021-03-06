<?php
  // ここにDBに登録する処理を記述する


    //１　データベースに接続する処理
    $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');

    // 呟かれたデータを受け取る
    if(!empty($_POST)){
    $nickname = htmlspecialchars($_POST['nickname']);
    $comment = htmlspecialchars($_POST['comment']);
    $time = date('Y-m-d H:i:s');
    $created = $time;

    //SQLに保存する
    $sql = 'INSERT INTO `posts`(`nickname`, `comment`,`created`) VALUES (?, ? ,?)';
    $data[] =  $nickname;
    $data[] =  $comment;
    $data[] = $created;
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    }


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

<?php


    //データを取り出す
    $sql = 'SELECT * FROM `posts` ORDER BY created ASC';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    while (1) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec == false) {
    break;
  }
  echo $rec['nickname'] . '<br>';
  echo $rec['comment'] . '<br>';
  echo $rec['created'] . '<br>';
  echo '<hr>';

}

   $dbh = null;

?>




</body>
</html>