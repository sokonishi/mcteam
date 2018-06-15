<?php
    session_start();
    // var_dump($_SESSION);
    require('dbconnect.php');
  $users_sql = 'SELECT * FROM `users` WHERE `id`=?';
  $users_data = array($_SESSION['id']);
  $users_stmt = $dbh->prepare($users_sql);
  $users_stmt->execute($users_data);
  $users_record = $users_stmt->fetch(PDO::FETCH_ASSOC);
  //var_dump($users_record);
  $count_sql = "SELECT COUNT(*) as `cnt` FROM `feeds` WHERE `user_id`=?";
  $data_cnt = array($_SESSION['id']);
  $stmt_count = $dbh->prepare($count_sql);
  $stmt_count->execute($data_cnt);
  $record_cnt = $stmt_count->fetch(PDO::FETCH_ASSOC);
    $sql = 'SELECT * FROM `feeds` ORDER BY `id` DESC';
            $data = array();
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);
            while (true) {
                $record = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($record == false) {
                    break;
                }
                $like_sql = "SELECT COUNT(*) AS `like_cnt` FROM `likes` WHERE `feed_id` = ?";
                $like_data = array($record["id"]);
                $like_stmt = $dbh->prepare($like_sql);
                $like_stmt->execute($like_data);
                $like = $like_stmt->fetch(PDO::FETCH_ASSOC);
                $record["like_cnt"] = $like["like_cnt"];
                $like_flag_sql = 'SELECT COUNT(*)as `like_flag` FROM `likes` WHERE `user_id`=? AND `feed_id`=?';
                $like_flag_data = array($_SESSION["id"],$record["id"]);
                $like_flag_stmt = $dbh->prepare($like_flag_sql);
                $like_flag_stmt->execute($like_flag_data);
                $like_flag = $like_flag_stmt->fetch(PDO::FETCH_ASSOC);
                // var_dump($like_flag);
                  if ($like_flag["like_flag"] > 0) {
                    $record["like_flag"] = 1;
                  } else {
                    $record["like_flag"] = 0;
                  }
                  $view_sql = "SELECT COUNT(*) FROM `views` WHERE `feed_id`=?";
                  $view_data = array($record["id"]);
                  $view_stmt = $dbh->prepare($view_sql);
                  $view_stmt->execute($view_data);
                  while (true) {
                    $view_record = $view_stmt->fetch(PDO::FETCH_ASSOC);
                    if ($view_record == false) {
                        break;
                    }
                    //var_dump($view_record);
                    $record["view_count"] = $view_record;
                  }
                $feeds[] = $record;
            }
//           echo'<pre>';
//           var_dump($feeds);
//           echo'<pre>';

// $user_id = $_SESSION['id'];

// if(isset($_GET['feed_id'])){

// $feed_id = $_GET['feed_id'];

// require('click_count.php');

// require('comment_function.php');

// $record = feed_detail($dbh,$feed_id);

// $users_record = user_detail($dbh,$user_id);

// $record_cnt = feed_count($dbh,$feed_id);

// post_comment($dbh,$feed_id,$user_id);

// $comments = array();
// $comments = comment_detail($dbh,$feed_id);
// }
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
  <link rel="stylesheet" type="text/css" href="assets/css/header.css">  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>

  <?php require('header.php'); ?>

  <div class="background_timeline">
    <div class="container">
      <div class="row col-xs-offset-10">
        <div class="copy_img top">
          <img src="img/copy.png" style="width: 50%">
        </div><!-- /copy-img -->
      </div><!-- /row -->
    </div><!-- /container -->

    <div class="container">
      <div class="row space_timeline">
      </div><!-- /row -->
    </div><!-- /container -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-offset-3 col-sm-6 col-xs-12">
          <div class="col-sm-3 col-xs-12 user_profile_img_wrapper detail">
            <img class="user_profile_img" src="user_profile_img/<?php echo $users_record['img_name'] ?>" >
          </div><!-- /user_profile_img_wrapper -->
          <div class="col-sm-8">
            <h3 class="user_name_profile"><?php echo $users_record['name'] ?></h3>
            <a class="edit_profile" href="post_profile.php">プロフィールを編集</a>
            <p>投稿 : <?php echo $record_cnt["cnt"]; ?>件  フォロワー98人 フォロー中129件</p>
            <p><?php echo $users_record['introduction'] ?></p>
          </div>
        </div>
      </div><!-- /row -->
    </div><!-- /container-fluid -->
    <div class="container">

      <div class="row post-card">

      <?php foreach($feeds as $feed){ ?>

        <div id="con<?php echo $feed['id'] ?>" class="modal-content">
          <p><?php include("comment_layer.php") ?></p>
          <p><a class="modal-close">閉じる</a></p>
        </div>

        <div class="col-md-4 col-xs-12">
          <div class="card">
            <!-- modalレイアウト表示 -->
            <a data-target="con<?php echo $feed['id'] ?>" class="modal-open noline">

            <!-- comment_timeline.phpに遷移 -->
            <!-- <a href="comment_layer.php?feed_id=?php echo $feed["id"] ?>" class="noline"> -->

              <div class="card_item card_hover card_click">                
                <img class="card_img" src="user_profile_img/<?php echo $feed['feed_img']; ?>" style="width: 100%">
                <ul class="card_contents">
                  <li class="feed_title"><?php echo $feed["title"] ?></li>
                  <li><i class="fa fa-heart fa-lg"></i>  <?php echo $feed["like_cnt"] ?>件</li>
                  <li><i class="fa fa-eye fa-lg"></i>  <?php echo $feed["view_count"]["COUNT(*)"] ?>件</li>
                </ul>
              </div><!-- /card_item -->
            </a>
          </div><!-- /card -->
        </div>
      <?php }?>
      </div><!-- /row -->
    </div><!-- /container -->
  </div><!-- /background_timeline -->


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="missyou.js"></script>
  <script src="assets/js/header.js"></script>
</body>
</html>