<?php 
  session_start();

  $user_id = $_SESSION["id"];
  $feed_id = $_GET["feed_id"];

  require('dbconnect.php');

  $sql = 'INSERT INTO `likes` SET `user_id`=?, `feed_id`=?';

  $data = array($user_id,$feed_id);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);


  header("Location: timeline.php");
 ?>