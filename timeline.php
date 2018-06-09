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
 
  $sql_count = "SELECT COUNT(*) as `cnt` FROM `feeds` WHERE `user_id`=?";
  $data_cnt = array($_SESSION['id']);
  $stmt_count = $dbh->prepare($sql_count);
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

                $feeds[] = $record;
            }

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
</head>
<body>

  <?php require('header.php'); ?>


  <div class="background">
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

        <div class="row">
          <div class="col-sm-offset-4 col-sm-4 col-sm-offset-4 col-xs-12 profile">
            <div class="detail">
              <img src="user_profile_img/<?php echo $users_record['img_name'] ?>" >
              <h4><?php echo $users_record['name'] ?></h4>
              <br>
              <p>投稿 : <?php echo $record_cnt["cnt"]; ?>件  フォロワー98人 フォロー中129件</p>
              <p><?php echo $users_record['introduction'] ?></p>
            </div><!-- /detail -->
          </div>
        </div>

    <div class="container">
      <?php foreach($feeds as $feed){ ?>
      <div class="row post-card">
        <div class="col-sm-4 col-xs-12">


          <div class="card">
            <a href="comment_timeline.php?feed_id=<?php echo $feed["id"] ?>" class="noline">
              <div class="card_item">
                <img src="user_profile_img/<?php echo $feed['feed_img']; ?>" style="width: 100%">
                <h4><?php echo $feed['title']; ?></h4>
                

                <?php if($feed["like_flag"] == 0){ ?>
                <a href="like.php?feed_id=<?php echo $feed["id"]; ?>" class="noline">
                    <button class="btn btn-default btn-xs"><i class="fa fa-thumbs-up" aria-hidden="true"></i>いいね！</button>
                </a>
                <?php } else { ?>
                <a href="unlike.php?feed_id=<?php echo $feed["id"]; ?>">
                  <button class="btn btn-default btn-xs"><i class="fa fa-thumbs-down" aria-hidden="true"></i>いいね！を取り消すボタン</button>
                </a>
                <?php } ?>
                <span class="like_count">いいね数 : <?php echo $feed["like_cnt"]; ?></span>

                <h4 class="cost"><?php echo $feed['price']; ?>円</h4>

              </div><!-- /card_item -->
            </a>
          </div><!-- /card -->
        </div>
        <?php }?>
      </div><!-- /row -->
    </div><!-- /container -->
  </div><!-- /background -->


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>