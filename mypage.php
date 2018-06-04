<?php 
  session_start();
    require('dbconnect.php');

  $sql = 'SELECT * FROM `users` WHERE `id`=?';
  $data = array($_SESSION['id']);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $record = $stmt->fetch(PDO::FETCH_ASSOC);

  // $sql = 'SELECT * FROM `profiles` WHERE `user_id`=?';
  // $data = array($_SESSION['id']);
  // $stmt = $dbh->prepare($sql);
  // $stmt->execute($data);

  $rec_profile = $stmt->fetch(PDO::FETCH_ASSOC);

  $sql_count = "SELECT COUNT(*) as `cnt` FROM `feeds` WHERE `user_id`=?";
  $data_cnt = array($_SESSION['id']);
  $stmt_count = $dbh->prepare($sql_count);
  $stmt_count->execute($data_cnt);

  $record_cnt = $stmt_count->fetch(PDO::FETCH_ASSOC);

  $sql = 'SELECT * FROM `likes` WHERE `user_id`=?';
  $data = array($_SESSION['id']);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  while (true) {
    $likes = $stmt->fetch(PDO::FETCH_ASSOC);

    $like_sql = 'SELECT * FROM `feeds` WHERE `id`=?';
    $like_data = array($likes["feed_id"]);
    $like_stmt = $dbh->prepare($like_sql);
    $like_stmt->execute($like_data);
    $rec = $like_stmt->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // var_dump($rec);
    // echo "</pre>";
    if ($rec == false) {
      break;
    }
    $feeds[] = $rec;
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
      <div class="row space_mypage">
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="profile_card">
          <div class="col-xs-3 col-md-2 col-lg-1">
            <img src="user_profile_img/<?php echo $record['img_name']; ?>">
          </div>
            <h6><?php echo $record['name']; ?></h6>
            <p>投稿 : <?php echo $record_cnt["cnt"]; ?>件  フォロワー98人 フォロー中129件</p>
            <p><?php echo $record['introduction']; ?></p>
            <a href="post_profile.php">プロフィールを編集</a>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row col-xs-offset-5">
        <ul class="mypage_nav">
          <li class="nav_item active"><a href="#">投稿</a></li>
          <li class="nav_item"><a href="#">お気に入り</a></li>
        </ul>
      </div>
    </div>

    <div class="container">
      <div class="row">
      <?php foreach($feeds as $feed){ ?>
        <div class="col-sm-4">
          <div class="card1">
            <img src="user_profile_img/<?php echo $feed["img_name"]; ?>" style="width: 100%">
            <h4><?php echo $feed["title"]; ?></h4>
            <p><?php echo $feed["feed"]; ?></p>
            <h4 class="cost"><?php echo $feed["price"] ?>円</h4>
            <div class="purchase">
              <button type="button" class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i> カートに入れる</button>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <!-- /background -->


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>