<?php
  session_start();
  require('dbconnect.php');

  $user_id = $_SESSION["id"];
  $feed_id = $_GET["feed_id"];

  $sql = "INSERT INTO `views` SET `user_id`=?, `feed_id`=?";

  $data = array($user_id, $feed_id);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  //header("Location: comment_timeline.php?feed_id=".$feed_id);

  header("Location: comment_layer.php?feed_id=".$feed_id);
?>