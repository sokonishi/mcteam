<?php 
  session_start();
    require('dbconnect.php');
    //var_dump($_SESSION);

  $feed_id = $_GET['feed_id'];

  $sql = 'SELECT * FROM `feeds` WHERE `id`=?';
  $data = array($feed_id);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $record = $stmt->fetch(PDO::FETCH_ASSOC);

  //echo '<pre>';
  //var_dump($feed_id);
  //echo '<pre>';

  $users_sql = 'SELECT * FROM `users` WHERE `id`=?';
  $users_data = array($_SESSION['id']);
  $users_stmt = $dbh->prepare($users_sql);
  $users_stmt->execute($users_data);

  $users_record = $users_stmt->fetch(PDO::FETCH_ASSOC);

  //var_dump($users_record);

  $sql_count = "SELECT COUNT(*) as `cnt` FROM `feeds` WHERE `id`=?";
  $data_cnt = array($feed_id);
  $stmt_count = $dbh->prepare($sql_count);
  $stmt_count->execute($data_cnt);

  $record_cnt = $stmt_count->fetch(PDO::FETCH_ASSOC);

  $errors = array();

  if (!empty($_POST)) {

    $comment = $_POST['comment'];

    if ($comment != '') {
      $comment_sql = 'INSERT INTO `comments` SET `comment`=?, `feed_id`=?,`user_id`=?, `created`=NOW()';
      $comment_data = array($comment, $feed_id, $_SESSION['id']);
      $comment_stmt = $dbh->prepare($comment_sql);
      $comment_stmt->execute($comment_data);

      //------------重要--------------
      header('Location: comment_timeline.php?feed_id='.$feed_id);
      exit();
      } else {
        $errors['comment'] = 'blank';
      }
    }
  //echo '<pre>';
  //var_dump($users_record);
  //echo '<pre>';

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
  //echo '<pre>';
  //var_dump($comments);
  //echo '<pre>';
  
 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>missyou</title>

  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/elohssa.css">
  <link rel="stylesheet" type="text/css" href="assets/css/comment.css">
</head>
<body>
  <?php require('header.php'); ?>

  <div class="background">
    <div class="container">
      <div class="row col-xs-offset-10">
        <div class="copy_img top">
          
        </div>
      </div>
    </div>


    <div class="container">
      <div class="row">
        <div class="col-sm-4 col-xs-12 post" style="position: fixed;" >
          <div class="card_item ">
            <img src="user_profile_img/<?php echo $record['img_name'] ?>" style="width: 100%">
            <h4><?php echo $record['title'] ?></h4>
            <p><?php echo $record['feed'] ?></p>
            <h4 class="cost"><?php echo $record['price'] ?>円</h4>
            <div class="purchase">
              <a href="purchase.php#" class="noline">
                <button type="button" class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i> カートに入れる</button>
              </a>
              </div><!-- /purchase -->
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = 'https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v3.0';
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-share-button" data-href="#" data-layout="button" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">シェア</a></div>
          </div><!-- /card_item -->
        </div>
      </div><!-- /row -->

      <div class="row">
        <div class="col-sm-7 col-sm-offset-5 col-xs-12 profile">
          <div class="detail">
            <img src="user_profile_img/<?php echo $users_record['img_name'] ?>" >
            <h4><?php echo $users_record['name'] ?></h4>
            <br>
            <p>投稿 : <?php echo $record_cnt["cnt"]; ?>件  フォロワー98人 フォロー中129件</p>
            <p><?php echo $users_record['introduction'] ?></p>
          </div><!-- /detail -->
        </div>

        <div class="col-sm-7 col-sm-offset-5 col-xs-12 comment">
          <div class="detail">

            <!-- headerと同様にactionに'Location: comment_timeline.php?feed_id='.$feed_idでも可能 -->
              <form method="POST" action="">
                <div class="form-group">
                  <!-- textareaは改行しないでしめる -->
                  <textarea name="comment" class="form-control" rows="2" placeholder="コメントを書いてください" style="font-size: 24px; margin-top: 50px "></textarea>
                  <?php if(isset($errors['feed']) && $errors['feed'] == 'blank') { ?>
                    <p class="alert alert-danger">何か入力してください</p>
                  <?php } ?>
                </div>
                <input type="submit" value="コメント" class="btn btn-primary" style="margin-bottom: 50px">
              </form>

            <?php foreach($comments as $comment) {?>
            <img src="user_profile_img/<?php echo $comment['img_name'] ?>" >
            <h4><?php echo $comment['name'] ?></h4>
            <br>
            <br>
            <p><?php echo $comment['comment'] ?></p><br>
            <?php } ?>

          </div>
        </div>
      </div>
      
    </div>


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>