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
 <header>
  <div class="header_logo">
    <img src="img/missyou_logo.png" style="width:20%">
    <img src="img/menu_bar.png" style="width: 5%; float: right;">
  </div>
    
 </header>

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
          <div class="card">
            <img src="user_profile_img/<?php echo $record['img_name'] ?>" style="width: 100%">
            <h4><?php echo $record['title'] ?></h4>
            <p><?php echo $record['feed'] ?></p>
            <h4 class="cost"><?php echo $record['price'] ?>円</h4>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-7 col-sm-offset-5 col-xs-12 profile">
          <div class="detail">
            <img src="user_profile_img/<?php echo $users_record['img_name'] ?>" >
            <h4><?php echo $users_record['name'] ?></h4>
            <br>
            <p>投稿 : <?php echo $record_cnt["cnt"]; ?>件  フォロワー98人 フォロー中129件</p>
            <p><?php echo $users_record['introduction'] ?></p>
          </div>
        </div>

        <div class="col-sm-7 col-sm-offset-5 col-xs-12 comment">
          <div class="detail">
            <img src="img/konio.png" >
            <h4>toshiki0523</h4>
            <br>
            <br>
            <p>プロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィール</p>
          </div>
        </div>
      </div>
      
    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm-7 col-sm-offset-5 col-xs-12 comment " ">
          <div class="detail">
            <img src="img/konio.png" >
            <h4>toshiki0523</h4>
            <br>
            <br>
            <p>プロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィール</p>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm-7 col-sm-offset-5 col-xs-12 comment">
          <div class="detail">
            <img src="img/konio.png" >
            <h4>toshiki0523</h4>
            <br>
            <br>
            <p>プロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィール</p>
          </div>
        </div>
      </div>
    </div>



  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>