<?php
    session_start();

    if(!isset($_SESSION['mcteam'])) {
    //正規のルートから遷移していない場合
      header("Location:post.php");
      exit();
    }

   // ①
    $title = $_SESSION['mcteam']['title'];
    $feed = $_SESSION['mcteam']['feed'];
    $price = $_SESSION['mcteam']['price'];
    $img_name = $_SESSION['mcteam']['img_name'];

    // 登録ボタンが押された時の処理 = POSTがからじゃない

    if(!empty($_POST)) {
        // 1.DB実行
        require('dbconnect.php');

        // 2.SQL文実行
        $sql = 'INSERT INTO `feeds` SET `feed`=?, `title`=?, `price`=?, `feed_img`=?, `user_id` = ?,`created`=NOW()';
        $data = array($feed, $title, $price, $img_name, $_SESSION['id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        // 3. データベース切断
         $dbh = null;

        unset($_SESSION['mcteam']);
        //var_dump($_SESSION['register']);
        header('Location: timeline.php');
        exit();
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
      </div><!-- /row -->
    </div><!-- /container -->


          <h2 class="text-center content_header">投稿確認</h2>
          <div class="container">
            <div class="row col-xs-offset-4 col-xs-4">
              <div class="card_item">
                <img style="width: 100%" src="user_profile_img/<?php echo htmlspecialchars($img_name); ?>" class="img-responsive img-tumbnail">
                <div>
                  <h4 class="lead"><?php echo htmlspecialchars($title); ?></h4>
                  <p class="lead"><?php echo htmlspecialchars($feed); ?></p>
                  <h4 class="cost" style="color: red;"><?php echo htmlspecialchars($price); ?>円</h4>
                </div>
              </div><!-- /card_item -->
            </div><!-- /row -->
          </div><!-- /container -->
          <div class="container">
            <div class="row text-center" style="margin-top: 50px;">
              <form method="POST" action="">
                <a href="post.php" class="btn" onclick="history.back()">&laquo;&nbsp;戻る</a>
                <input type="hidden" name="action" value="submit">
                <input type="submit" class="btn btn-primary" value="登録">
              </form>
            </div><!-- /row -->
          </div><!-- /container -->
            

      </div>


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>