<?php
  session_start();

  $user_id = $_SESSION["id"];

  //POST送信されたデータを受け取る
  $feed_id = $_GET["id"];

  require('dbconnect.php');

  $sql = "DELETE FROM `likes` WHERE  `user_id`=? AND `feed_id`=?;";

  $data = array($user_id,$feed_id);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  header('Content-type:text/plain; charset=utf8');
?>