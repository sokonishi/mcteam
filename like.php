<?php 
  session_start();

  $user_id = $_SESSION["id"];

  //POST送信されたデータを受け取る
  $feed_id = $_GET["id"];

  require('dbconnect.php');

  $sql = 'INSERT INTO `likes` SET `user_id`=?, `feed_id`=?';

  $data = array($user_id,$feed_id);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  //ヘッダーの設定
  header('Content-type:text/plain; charset=utf8');
  // echo json_encode($feed_id);
 ?>