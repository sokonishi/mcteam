<?php
    session_start();
    // var_dump($_SESSION);

    require('dbconnect.php');


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
//            echo'<pre>';
//            var_dump($feeds);
//            echo'<pre>';

//  $user_id = $_SESSION['id'];
//
//  if(isset($_GET['feed_id'])){
//
//  $feed_id = $_GET['feed_id'];
//
//  require('click_count.php');
//
//  require('comment_function.php');
//
//  $record = feed_detail($dbh,$feed_id);
//
//  $users_record = user_detail($dbh,$user_id);
//
//  $record_cnt = feed_count($dbh,$feed_id);
//
//  post_comment($dbh,$feed_id,$user_id);
//
//  $comments = comment_detail($dbh,$feed_id);
//  }
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>

   <header>
    <nav class="container navbar navbar-dark bg-dark" style="height: 30px;">
      <div class="row">
        <div class="col-xs-2" style="padding-top: 10px;">
          <img src="img/missyou_logo.png" style="height: 70px">
        </div>
        <div class="col-xs-offset-9 col-xs-1">
          <div class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
          </div><!-- /navbar-toggler -->
        </div>
        <div style="text-align: right;">
          <a href="register/signup.php" style="color: #009795; font-size: 15px; font-weight: bold; margin-right: 20px;">新規登録</a>
          <a href="signin.php" style="color: #009795; font-size: 15px; font-weight: bold; margin-right: 15px;">ログイン</a>
        </div>
      </div><!-- /row -->
    </nav>

  </header>

  <div id="con1" class="modal-content">
    <p><?php include("comment_layer.html") ?></p>
    <p><a class="modal-close">閉じる</a></p>
  </div>

  <div class="background_timeline">
    <div class="container">
      <div class="row col-xs-offset-10">
        <div class="copy_img top">
          <img src="img/copy.png" style="width: 50%">
        </div><!-- /copy-img -->
      </div><!-- /row -->
    </div><!-- /container -->

    <div class="container">
      <div class="row">
        <div class="col-md-12" style="font-size: 30px; text-align: center; font-weight: bold; margin-top: 5px; margin-bottom: 30px;">
          <h2 style="font-size: 35px;">あなたも過去の恋愛の品を出品しよう！</h2>
          <div style="margin-top: 35px;">
            <a href="register/signup.php" style="text-decoration: none;">
              <button type="button" style="background-color: #009795; color: white; border-radius: 15px; border: solid 1px white; opacity: 0.8; margin-right: 30px;">
                新規登録
              </button>
            </a>
            <a href="signin.php">
              <button type="button" style="background-color: #009795; color: white; border-radius: 15px; border: solid 1px white; opacity: 0.8;">ログイン</button>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div style="margin-top: 50px; margin-bottom: 80px;">
        </div>
      </div><!-- /row -->
    </div><!-- /container -->

    <div class="container">
      <div class="row">
        <div class="col-md-12" style="text-align: left;">
          <h2 style="font-size: 35px; font-family: 'Chalkduster', cursive; border-bottom: 2px solid; margin-bottom: 30px; color: #009795;">Welcome to missyou!</h2>
          <p style="font-size: 30px; text-align: left; font-weight: bold; margin-top: 5px; margin-bottom: 30px;">missyouとは過去の恋愛から吹っ切れるためのサービスです！<br>過去の恋愛の品を面白いストーリーにのせて投稿して<br>笑いとお金に変えよう！</p>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12" style="text-align: left;">
          <h2 style="font-size: 35px; font-family: 'Chalkduster', cursive; border-bottom: 2px solid; margin-top: 20px; margin-bottom: 30px; color: #009795;">Timeline</h2>
        </div>
      </div>
    </div>

    <div class="container">

      <div class="row post-card">
      <?php foreach($feeds as $feed){ ?>
        <div class="col-md-4 col-xs-12">
          <div class="card">

            <!-- modalレイアウト表示 -->
            <a data-target="con1" class="modal-open noline">

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
  </div><!-- /background -->


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="missyou.js"></script>
</body>
</html>