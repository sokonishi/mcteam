<?php
  session_start();
  require('dbconnect.php');

  $user_id = $_SESSION["id"];
  $feed_id = $_GET["id"];

  $click_sql = "INSERT INTO `views` SET `user_id`=?, `feed_id`=?";

  $click_data = array($user_id, $feed_id);
  $click_stmt = $dbh->prepare($click_sql);
  $click_stmt->execute($click_data);

  header('Content-type:text/plain; charset=utf8');
?>