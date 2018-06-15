<?php
session_start();

require('dbconnect.php');

$ranking_sql = 'SELECT `feeds`.*, COUNT(`feed_id`) AS total FROM `likes` LEFT JOIN `feeds` ON `feeds`.`id` = `likes`.`feed_id` GROUP BY `feed_id` ORDER BY `total` DESC LIMIT 0,9';
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
$number=1;
// echo "<pre>";
// var_dump($rankings);
// echo "<pre>";


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
      <div class="row post-card">
      <?php foreach($rankings as $ranking){ ?>
        <div class="col-sm-4 col-xs-12">
          <div class="card">
            <a href="comment_timeline.php?feed_id=<?php echo $ranking["id"]; ?>" class="noline">
              <h4>第<?php echo $number; ?>位</h4>
              <div class="card_item">
                <img src="user_profile_img/<?php echo $ranking["feed_img"]; ?>" style="width: 100%">
                <h4><?php echo $ranking["title"]; ?></h4>
                <h4 class="like" style="text-align: center;">いいね数<?php echo $ranking["total"]; ?></h4>
              </div><!-- /card_item -->
            </a>
          </div><!-- card1 -->
        </div>
      <?php $number+=1; } ?>
      </div>
    </div>


  </div><!-- /background -->


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>