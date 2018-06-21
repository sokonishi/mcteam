<?php 
  session_start();

  $user_id = $_SESSION["id"];
  $comment = $_GET["comment"];
  $feed_id = $_GET["id"];


  require('dbconnect.php');

  $comment_sql = 'INSERT INTO `comments` SET `comment`=?, `feed_id`=?,`user_id`=?, `created`=NOW()';
  $comment_data = array($comment, $feed_id, $user_id);
  $comment_stmt = $dbh->prepare($comment_sql);
  $comment_stmt->execute($comment_data);

  $id_sql = 'SELECT last_insert_id() AS `id` FROM `comments` WHERE `user_id` = ? AND `feed_id` = ? LIMIT 1';
  $id_data = array($user_id, $feed_id);
  $id_stmt = $dbh->prepare($id_sql);
  $id_stmt->execute($id_data);
  $id_record = $id_stmt->fetch(PDO::FETCH_ASSOC);



  $comments_sql = 'SELECT `comments`.*,`users`.`img_name`, `users`.`name` FROM `comments` JOIN `users` ON `comments`.`user_id`=`users`.`id` WHERE `comments`.`id`=?';

  $comments_data = array($id_record["id"]);
  $comments_stmt = $dbh->prepare($comments_sql);
  $comments_stmt->execute($comments_data);
  $comments_record = $comments_stmt->fetch(PDO::FETCH_ASSOC);

  // echo json_encode($test_id);
  echo json_encode($comments_record);
  // echo json_encode($id_record);
  // echo json_encode($created);

  // //ヘッダーの設定
  header('Content-type:text/plain; charset=utf8');