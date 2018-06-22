<?php
    session_start();
    // var_dump($_SESSION);

    require('dbconnect.php');


    $sql = 'SELECT * FROM `feeds` ORDER BY `id` DESC LIMIT 9';
    $data = array();
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    while (true) {
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($record == false) {
          break;
      }
      //投稿者情報
      $feed_user_sql = 'SELECT `u`.`name`,`u`.`img_name`,`u`.`introduction` FROM `feeds` AS `f` LEFT JOIN `users` AS `u` ON `f`.`user_id` = `u`.`id` WHERE `f`.`id`=?';
      $feed_user_data = array($record["id"]);
      $feed_user_stmt = $dbh->prepare($feed_user_sql);
      $feed_user_stmt->execute($feed_user_data);
      $record['feed_user'] = $feed_user_stmt->fetch(PDO::FETCH_ASSOC);

      //投稿者の投稿数
      $feed_cnt_sql = "SELECT COUNT(*) as `cnt` FROM `feeds` WHERE `user_id`=?";
      $feed_cnt_data = array($record['user_id']);
      $feed_cnt_stmt = $dbh->prepare($feed_cnt_sql);
      $feed_cnt_stmt->execute($feed_cnt_data);
      $record["feed_cnt"] = $feed_cnt_stmt->fetch(PDO::FETCH_ASSOC);

      //投稿へのlike数カウント
      $like_sql = "SELECT COUNT(*) AS `like_cnt` FROM `likes` WHERE `feed_id` = ?";
      $like_data = array($record["id"]);
      $like_stmt = $dbh->prepare($like_sql);
      $like_stmt->execute($like_data);
      $like = $like_stmt->fetch(PDO::FETCH_ASSOC);
      $record["like_cnt"] = $like["like_cnt"];

      //閲覧数
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
  <link rel="stylesheet" type="text/css" href="assets/css/promotion.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>

   <header class="header_hover">
    <nav class="container navbar navbar-dark bg-dark" style="height: 30px;">
      <div class="row">
        <div class="col-xs-2" style="padding-top: 10px;">

          <img id="header_img"  src="img/missyou_logo2.png" style="height: 70px">
          <img id="header_img2"  src="img/missyou_logo.png" style="height: 70px">

        </div>
        <div class="col-xs-offset-9 col-xs-1">
          <div class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
          </div><!-- /navbar-toggler -->
        </div>
        <div style="text-align: right;">
          <a href="register/signup.php" style="color: #fff; font-size: 15px; font-weight: bold; margin-right: 20px;">新規登録</a>
          <a href="signin.php" style="color: #fff; font-size: 15px; font-weight: bold; margin-right: 15px;">ログイン</a>
        </div>
      </div><!-- /row -->
    </nav>
  </header>

  <div id="con1" class="modal-content">
    <p><?php include("comment_layer.html") ?></p>
    <p><a class="modal-close">閉じる</a></p>
  </div>

  <div class="signup-header">

    <div class="container">
      <div class="row">
        <div class="col-md-12" style="font-size: 30px; text-align: center; font-weight: bold; margin-top: 230px; margin-bottom: 200px;">
          <h2 style="font-size: 36px;font-weight: bold; color:#fff;">あなたの未練とお別れをしよう！</h2>
          <h2 style="font-size: 24px;color:#fff;">まだ捨てられない元カレ、カノからのプレゼントも、思い出も。<br>missyouはあなたの人生を「少しだけ」後押しします。</h2>
          <div style="margin-top: 60px;color:#fff;">
            <h5>騙されたと思って</h5>
            <a href="register/signup.php" class="square_btn">試してみる</a>
          </div>
        </div>
      </div>
    </div>
    <div class="section1">
      <div class="container">
        <div class="row">
          <div style="margin-top: 66px; margin-bottom: 66px;">
            <h2 style="font-size: 36px; font-family: 'Chalkduster', cursive; margin-bottom: 12px; color: #009795;">Welcom to missyou!</h2>
          </div>
        </div><!-- /row -->
      </div><!-- /container -->

      <div class="container">
        <div class="row">
          <div class="col-md-7" style="text-align: left;">
            <h2 style="font-size: 36px; font-family: 'Chalkduster', cursive; margin-bottom: 12px; color: #009795;">About missyou</h2>
            <p style="font-size: 24px; text-align: left; font-weight: bold; margin-top: 5px; margin-bottom: 24px;">missyouとは過去の恋愛から吹っ切れるためのサービスです！<br>過去の恋愛の品を面白いストーリーにのせて投稿し、笑いとお金に変えよう！</p>
          </div>
          <div class="col-md-5 centered">
            <img src="img/sample_img2.png" width="350" style="padding-top: 24px;">
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md-5 centered">
            <img src="img/sample_img.png" width="350" style="padding-top: 24px;">
          </div>
          <div class="col-md-7" style="text-align: left;">
            <h2 style="font-size: 36px; font-family: 'Chalkduster', cursive; margin-bottom: 12px; color: #009795;">How to use</h2>
            <p style="font-size: 24px; text-align: left; font-weight: bold; margin-top: 5px; margin-bottom: 24px;">未練を断ち切ることは勿論、面白い失恋話<br>と出会える！<br>投稿したり、ツッコむことで<br>笑いと元気を貰おう！</p>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 style="font-size: 36px; font-family: 'Chalkduster', cursive; margin-top: 20px; margin-bottom: 30px; color: #009795;">Timeline</h2>
        </div>
      </div>

      <div class="row post-card">
      <?php foreach($feeds as $feed){ ?>
        <?php
          $post_sql = "SELECT `c`.*, `u`.`name` , `u`.`img_name` ,`u`.`introduction` FROM `comments` AS `c` LEFT JOIN `users` AS `u` ON `c`.`user_id` = `u`.`id` WHERE `feed_id` = ? ORDER BY `c`.`created` DESC";

          $post_data = array($feed['id']);
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
        ?>

        <div id="con<?php echo $feed['id'] ?>" class="modal-content">
          <!-- <p><a class="modal-close"><i class="fa fa-times fa-fw" aria-hidden="true"></i></a></p> -->
          <p><?php include("comment_layer2.php") ?></p>
        </div>

        <div class="col-md-4 col-xs-12">
          <div class="card">

            <!-- modalレイアウト表示 -->
            <a href="#cardpotision<?php echo $feed['id'] ?>" data-target="con<?php echo $feed['id'] ?>" class="modal-open noline" onclick="view(<?php echo $feed['id']; ?>);">

            <!-- comment_timeline.phpに遷移 -->
            <!-- <a href="comment_layer.php?feed_id=?php echo $feed["id"] ?>" class="noline"> -->

              <div class="card_item card_hover card_click">                
                <img class="card_img" src="user_profile_img/<?php echo $feed['feed_img']; ?>" style="width: 100%">
                <ul class="card_contents">
                  <li class="feed_title">『<?php echo $feed["title"] ?>』</li>
                  <li><i class="fa fa-heart fa-lg"></i>  <?php echo $feed["like_cnt"] ?>件</li>
                  <li><i class="fa fa-eye fa-lg"></i>  <?php echo $feed["view_count"]["COUNT(*)"] ?>件</li>
                </ul>
              </div><!-- /card_item -->
            </a>
          </div><!-- /card -->
        </div>
      <?php }?>
      </div><!-- /row -->

        <div style="margin-top: 60px; margin-bottom: 60px;">
          <a href="register/signup.php" class="square_btn">もっと見る</a>
        </div>

    </div><!-- /container -->

  <div class="section1">
    <div class="container">
      <div class="row">
        <div class = "centered">
          <div style="margin-top: 66px; margin-bottom: 66px;">
            <h2 style="font-size: 36px; font-family: 'Chalkduster', cursive; margin-bottom: 30px; color: #009795;">Contact me if you can</h2>
          </div>
          <form method="POST" action="check.php">

          <div>
            <p style="font-size: 24px; font-weight: bold; margin-top: 24px; margin-bottom: 12px;">お名前</p>
            <input type="text" name="name" style="width: 450px">
          </div>

          <div>
            <p style="font-size: 24px; font-weight: bold; margin-top: 24px; margin-bottom: 12px;">メールアドレス</p>
            <input type="text" name="email" style="width: 450px">
          </div>

          <div>
            <p style="font-size: 24px; font-weight: bold; margin-top: 24px; margin-bottom: 12px;">お問い合わせ内容</p>
            <textarea name="content" cols="65" rows="3" style="width: 450px"></textarea>
          </div>
          <br>
          <div style="margin-top: 12px; margin-bottom: 60px;">
            <a href="#">
              <input type="submit" value="submit" class="square_btn">
            </a>
          </div>

        <div class="row centered" style="margine-bottom:30px;">
          <div class="col-md-4">
            <a href="#"><i class="fa fa-facebook fa-3x" style="color:#009795;"></i></a>
          </div>
          
          <div class="col-md-4">
            <a href="#"><i class="fa fa-twitter fa-3x" style="color:#009795;"></i></a>
          </div>
          <div class="col-md-4">
            <a href="#"><i class="fa fa-envelope fa-3x" style="color:#009795;"></i></a>
          </div>
        </div>

      </div><!-- /row -->
    </div>
  </div>

  </div><!-- /signup-header -->


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/promotion.js"></script>
  <script src="missyou.js"></script>
</body>
</html>