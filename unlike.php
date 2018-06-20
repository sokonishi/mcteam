<?php
  // session変数を使えるようにする
  session_start();
  // DBに接続
  require("dbconnect.php");
  // feed_idを取得
  $feed_id = $_GET["feed_id"];
  //SQL文作成（DELETE文）
  $sql = "DELETE FROM `likes` WHERE  `user_id`=? AND `feed_id`=?;";
  //SQL実行
  $data = array($_SESSION['id'],$feed_id);
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