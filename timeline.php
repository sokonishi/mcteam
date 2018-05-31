<?php 
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
 <header>
  <div class="header_logo">
    <img src="img/missyou_logo.png" style="width: 20%">
    <img src="img/menu_bar.png" style="width: 5%; float: right;">
  </div>
 </header>

  <div class="background">
    <div class="container">
      <div class="row col-xs-offset-10">
        <div class="copy_img top">
          <img src="img/copy.png" style="width: 50%">
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row space_timeline">
      </div>
    </div>

    <div class="container">
      <?php foreach($feeds as $feed){ ?>
      <div class="row">
        <div class="col-sm-4">
          <div class="card1">
            <img src="img/<?php echo $feed['img_name']; ?>" style="width: 100%">
            <h4><?php echo $feed['title']; ?></h4>
            <p><?php echo $feed['feed']; ?></p>
            <a href="like.php?feed_id=<?php echo $feed["id"]; ?>">
                      <button class="btn btn-default btn-xs"><i class="fa fa-thumbs-up" aria-hidden="true"></i>いいね！</butt
                        on>
            </a>
            <h4 class="cost"><?php echo $feed['value']; ?></h4>
            <span class="like_count">いいね数 : <?php echo $feed["like_cnt"]; ?></span>
          </div>
        </div>
        <?php } ?>

        
        
      </div>

      <div class="row">
        <div class="col-sm-4">
          <div class="card1">
            <img src="img/item_img.png" style="width: 100%">
            <h4>タイトル</h4>
            <p>ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。</p>
            <h4 class="cost">20,000円</h4>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="card2">
            <img src="img/item_img.png" style="width: 100%">
            <h4>タイトル</h4>
            <p>ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。</p>
            <h4 class="cost">20,000円</h4>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="card3">
            <img src="img/item_img.png" style="width: 100%">
            <h4>タイトル</h4>
            <p>ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。ここにストーリが入ります。</p>
            <h4 class="cost">20,000円</h4>
          </div>
        </div>
        
      </div>
  </div>


  </div>


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>