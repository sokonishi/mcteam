<?php
//  session_start();
//  require('dbconnect.php');

  $user_id = $_SESSION["id"];
  $feed_id = $_GET["feed_id"];

  $click_sql = "INSERT INTO `views` SET `user_id`=?, `feed_id`=?";

  $click_data = array($user_id, $feed_id);
  $click_stmt = $dbh->prepare($click_sql);
  $click_stmt->execute($click_data);

  //header("Location: comment_timeline.php?feed_id=".$feed_id);

//  header("Location: comment_layer.php?feed_id=".$feed_id);

?>