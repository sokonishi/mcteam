<?php 
  $feed_id = $_GET['feed_id'];
  $user_id = $_SESSION['id'];

  function feed_detail($dbh,$feed_id){

  $sql = 'SELECT `f`.*, `u`.`name`,`u`.`img_name`, `u`.`introduction` FROM `feeds` AS `f` LEFT JOIN `users` AS `u` ON `f`.`user_id` = `u`.`id` WHERE `f`.`id`=?';
  $data = array($feed_id);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $record = $stmt->fetch(PDO::FETCH_ASSOC);
  return $record;
  }


  function user_detail($dbh,$user_id){

  $users_sql = 'SELECT * FROM `users` WHERE `id`=?';
  $users_data = array($user_id);//$_SESSION['id']
  $users_stmt = $dbh->prepare($users_sql);
  $users_stmt->execute($users_data);

  $users_record = $users_stmt->fetch(PDO::FETCH_ASSOC);
  return $users_record;
  }


  function feed_count($dbh,$feed_id){
  $sql_count = "SELECT COUNT(*) as `cnt` FROM `feeds` WHERE `id`=?";
  $data_cnt = array($feed_id);
  $stmt_count = $dbh->prepare($sql_count);
  $stmt_count->execute($data_cnt);

  $record_cnt = $stmt_count->fetch(PDO::FETCH_ASSOC);
  return $record_cnt;
  }


  function post_comment($dbh,$feed_id,$user_id){
  $errors = array();

  if (!empty($_POST)) {

    $comment = $_POST['comment'];

    if ($comment != '') {
      $comment_sql = 'INSERT INTO `comments` SET `comment`=?, `feed_id`=?,`user_id`=?, `created`=NOW()';
      $comment_data = array($comment, $feed_id, $user_id);
      $comment_stmt = $dbh->prepare($comment_sql);
      $comment_stmt->execute($comment_data);

      //------------重要--------------
      header('Location: comment_layer.php?feed_id='.$feed_id);
      exit();
      } else {
        $errors['comment'] = 'blank';
      }
    }
  }


  function comment_detail($dbh,$feed_id){
  $post_sql = "SELECT `c`.*, `u`.`name` , `u`.`img_name` ,`u`.`introduction` FROM `comments` AS `c` LEFT JOIN `users` AS `u` ON `c`.`user_id` = `u`.`id` WHERE `feed_id` = ? ORDER BY `c`.`created` DESC";

  $post_data = array($feed_id);
  $post_stmt = $dbh->prepare($post_sql);
  $post_stmt->execute($post_data);

  $comments = array();
  while (true) {
    $post_record = $post_stmt->fetch(PDO::FETCH_ASSOC);

    if ($post_record == false){
      break;
    } 
    $comments[] = $post_record;
  }
  return $comments;
  }

  
 ?>