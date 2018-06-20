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

  //投稿へのlike数カウント
  $like_sql = "SELECT COUNT(*) AS `like_cnt` FROM `likes` WHERE `feed_id` = ?";
  $like_data = array($feed_id);
  $like_stmt = $dbh->prepare($like_sql);
  $like_stmt->execute($like_data);
  $like = $like_stmt->fetch(PDO::FETCH_ASSOC);
  $likes = $like["like_cnt"];

  echo json_encode($likes);

  header('Content-type:text/plain; charset=utf8');
?>