<?php 
  session_start();
  if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];
  } else {
    $user_id = $_SESSION["id"];
  }

  require('dbconnect.php');

  $sql = 'SELECT * FROM `users` WHERE `id`=?';
  $data = array($user_id);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $record = $stmt->fetch(PDO::FETCH_ASSOC);

  $rec_profile = $stmt->fetch(PDO::FETCH_ASSOC);

  $sql_count = "SELECT COUNT(*) as `cnt` FROM `feeds` WHERE `user_id`=?";
  $data_cnt = array($user_id);
  $stmt_count = $dbh->prepare($sql_count);
  $stmt_count->execute($data_cnt);

  $record_cnt = $stmt_count->fetch(PDO::FETCH_ASSOC);

  $sql = 'SELECT `l`.*,`f`.* FROM `likes` AS `l` LEFT JOIN `feeds` AS `f` ON `l`.`feed_id`=`f`.`id` WHERE `l`.`user_id`=?';

  $data = array($user_id);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  while (true) {
    $likes = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($likes == false) {
      break;
    }
    $feeds[] = $likes;
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

  <div class="background_signup">
    <div class="container">
      <div class="row space_mypage">
      </div><!-- /row -->
    </div><!-- /container -->

    <div class="container">
      <div class="row profile_card">
          <div class="col-xs-3 col-md-2 col-lg-1">
            <img src="user_profile_img/<?php echo $record['img_name']; ?>">
          </div>
          <div class="col-xs-9 col-md-10 col-lg-11">
            <h6><?php echo $record['name']; ?></h6>
            <p>投稿 : <?php echo $record_cnt["cnt"]; ?>件  フォロワー98人 フォロー中129件</p>
            <p><?php echo $record['introduction']; ?></p>
            <a href="post_profile.php">プロフィールを編集</a>
          </div>
      </div><!-- /row -->
    </div><!-- /container -->

    <div class="container">
      <div class="row col-xs-offset-5">
        <ul class="mypage_nav">
          <li class="nav_item active"><a href="mypage.php">お気に入り</a></li>
          <li class="nav_item"><a href="mypage_tweet.php?user_id=<?php echo $user_id; ?>">投稿</a></li>
        </ul>
      </div>
    </div>

    <div class="container">
      <div class="row">
      <?php if (isset($feeds)) {
            foreach($feeds as $feed) { ?>
        <div class="col-sm-4">
          <a href="comment_timeline.php?feed_id=<?php echo $feed["id"] ?>" class="noline">
            <div class="card1 card_item">
              <img src="user_profile_img/<?php echo $feed["feed_img"]; ?>" style="width: 100%">
              <h4><?php echo $feed["title"]; ?></h4>
              <p><?php echo $feed["feed"]; ?></p>
              <h4 class="cost"><?php echo $feed["price"] ?>円</h4>
              
            </div><!-- /card1 -->
          </a>
        </div>
        <?php }} ?>
      </div><!-- /row -->
    </div><!-- /container -->
  </div><!-- /background -->


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>