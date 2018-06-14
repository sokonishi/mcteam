<?php
session_start();

require('dbconnect.php');

$ranking_sql = 'SELECT `feeds`.*, COUNT(`feed_id`) AS total FROM `likes` LEFT JOIN `feeds` ON `feeds`.`id` = `likes`.`feed_id` GROUP BY `feed_id` ORDER BY `total` DESC';
        $ranking_data = array();
        $ranking_stmt = $dbh->prepare($ranking_sql);
        $ranking_stmt->execute($ranking_data);

        while (true) {
            $record = $ranking_stmt->fetch(PDO::FETCH_ASSOC);

            if ($record == false) {
                break;
            }
            $rankings[] = $record;
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
        <h3>Ranking</h3>
      </div><!-- /row -->
    </div><!-- /container -->

    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="card1">
            <a href="comment_timeline.php" class="noline">
              <h4>第1位</h4>
              <div class="card_item">
                <img src="user_profile_img/<?php echo $rankings[0]["img_name"]; ?>" style="width: 100%">
                <h4><?php echo $rankings[0]["title"]; ?></h4>
                <p><?php echo $rankings[0]["feed"]; ?></p>
                <h4 class="cost"><?php echo $rankings[0]["price"]; ?></h4>
                <h4 class="like" style="text-align: center;">いいね数<?php echo $rankings[0]["total"]; ?></h4>                
              </div><!-- /card_item -->
            </a>
          </div><!-- card1 -->
        </div>

        <div class="col-sm-4">
          <div class="card2">
            <a href="comment_timeline.php" class="noline">
            <h4>第2位</h4>
            <div class="card_item">
                <img src="user_profile_img/<?php echo $rankings[1]["img_name"]; ?>" style="width: 100%">
                <h4><?php echo $rankings[1]["title"]; ?></h4>
                <p><?php echo $rankings[1]["feed"]; ?></p>
                <h4 class="cost"><?php echo $rankings[1]["price"]; ?></h4>
                <h4 class="like" style="text-align: center;">いいね数<?php echo $rankings[1]["total"]; ?></h4>                
              </div><!-- /card_item -->
            </a>
          </div><!-- /card2 -->
        </div>

        <div class="col-sm-4">
          <div class="card3">
            <a href="comment_timeline.php" class="noline">
              <h4>第3位</h4>
              <div class="card_item">
                <img src="user_profile_img/<?php echo $rankings[2]["img_name"]; ?>" style="width: 100%">
                <h4><?php echo $rankings[2]["title"]; ?></h4>
                <p><?php echo $rankings[2]["feed"]; ?></p>
                <h4 class="cost"><?php echo $rankings[2]["price"]; ?></h4>
                <h4 class="like" style="text-align: center;">いいね数<?php echo $rankings[2]["total"]; ?></h4>                
              </div><!-- /card_item -->
            </a>
          </div><!-- /card3 -->
        </div>
        
      </div>

      <div class="row">
        <div class="col-sm-4">
          <div class="card1">
            <a href="comment_timeline.php" class="noline">
              <h4>第4位</h4>
              <div class="card_item">
                <img src="user_profile_img/<?php echo $rankings[3]["img_name"]; ?>" style="width: 100%">
                <h4><?php echo $rankings[3]["title"]; ?></h4>
                <p><?php echo $rankings[3]["feed"]; ?></p>
                <h4 class="cost"><?php echo $rankings[3]["price"]; ?></h4>
                <h4 class="like" style="text-align: center;">いいね数<?php echo $rankings[3]["total"]; ?></h4>                
              </div><!-- /card_item -->
            </a>
          </div><!-- card1 -->
        </div>

        <div class="col-sm-4">
          <div class="card2">
            <a href="comment_timeline.php" class="noline">
              <h4>第5位</h4>
              <div class="card_item">
                <img src="user_profile_img/<?php echo $rankings[4]["img_name"]; ?>" style="width: 100%">
                <h4><?php echo $rankings[4]["title"]; ?></h4>
                <p><?php echo $rankings[4]["feed"]; ?></p>
                <h4 class="cost"><?php echo $rankings[4]["price"]; ?></h4>
                <h4 class="like" style="text-align: center;">いいね数<?php echo $rankings[4]["total"]; ?></h4>                
              </div><!-- /card_item -->
            </a>
          </div><!-- /card2 -->
        </div>

        <div class="col-sm-4">
          <div class="card3">
            <a href="comment_timeline.php" class="noline">
              <h4>第6位</h4>
              <div class="card_item">
                <img src="user_profile_img/<?php echo $rankings[5]["img_name"]; ?>" style="width: 100%">
                <h4><?php echo $rankings[5]["title"]; ?></h4>
                <p><?php echo $rankings[5]["feed"]; ?></p>
                <h4 class="cost"><?php echo $rankings[5]["price"]; ?></h4>
                <h4 class="like" style="text-align: center;">いいね数<?php echo $rankings[5]["total"]; ?></h4>                
              </div><!-- /card_item -->
            </a>
          </div><!-- /card3 -->
        </div>
        
      </div><!-- /row -->


      <div class="row">
        <div class="col-sm-4">
          <div class="card1">
            <a href="comment_timeline.php" class="noline">
              <h4>第7位</h4>
              <div class="card_item">
                <img src="user_profile_img/<?php echo $rankings[6]["img_name"]; ?>" style="width: 100%">
                <h4><?php echo $rankings[6]["title"]; ?></h4>
                <p><?php echo $rankings[6]["feed"]; ?></p>
                <h4 class="cost"><?php echo $rankings[6]["price"]; ?></h4>
                <h4 class="like" style="text-align: center;">いいね数<?php echo $rankings[6]["total"]; ?></h4>                
              </div><!-- /card_item -->
            </a>
          </div><!-- card1 -->
        </div>

        <div class="col-sm-4">
          <div class="card2">
            <a href="comment_timeline.php" class="noline">
              <h4>第8位</h4>
              <div class="card_item">
                <img src="user_profile_img/<?php echo $rankings[7]["img_name"]; ?>" style="width: 100%">
                <h4><?php echo $rankings[7]["title"]; ?></h4>
                <p><?php echo $rankings[7]["feed"]; ?></p>
                <h4 class="cost"><?php echo $rankings[7]["price"]; ?></h4>
                <h4 class="like" style="text-align: center;">いいね数<?php echo $rankings[8]["total"]; ?></h4>                
              </div><!-- /card_item -->
            </a>
          </div><!-- /card2 -->
        </div>

        <div class="col-sm-4">
          <div class="card3">
            <a href="comment_timeline.php" class="noline">
              <h4>第9位</h4>
              <div class="card_item">
                <img src="user_profile_img/<?php echo $rankings[8]["img_name"]; ?>" style="width: 100%">
                <h4><?php echo $rankings[8]["title"]; ?></h4>
                <p><?php echo $rankings[8]["feed"]; ?></p>
                <h4 class="cost"><?php echo $rankings[8]["price"]; ?></h4>
                <h4 class="like" style="text-align: center;">いいね数<?php echo $rankings[8]["total"]; ?></h4>                
              </div><!-- /card_item -->
            </a>
          </div><!-- /card3 -->
        </div>
        
      </div><!-- /row -->

    </div><!-- /container -->


  </div><!-- /background -->


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>