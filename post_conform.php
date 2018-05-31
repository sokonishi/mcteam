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
        $sql = 'INSERT INTO `feeds` SET `feed`=?, `title`=?, `price`=?, `img_name`=?, `created`=NOW()';
        $data = array($feed, $title, $price, $img_name);
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
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/elohssa.css">
</head>
<body>

  <header>
    <div class="header_logo">
      <img src="img/missyou_logo.png" style="width: 20%">
      <img src="img/menu_bar.png" style="width: 5%; float: right;">
    </div>
  </header>

  <div class="background_signup">
    <div class="container">
      <div class="row space_mypage">
      </div><!-- /row -->
    </div><!-- /container -->

    <div class="container">
        <div class="row">
          <div class="col-xs-8 col-xs-offset-2">
          <h2 class="text-center content_header">アカウント情報確認</h2>
          <div class="row">
            <div class="col-xs-4">
              <img src="user_profile_img/<?php echo htmlspecialchars($img_name); ?>" class="img-responsive img-tumbnail">
            </div>
            
            <div class="col-xs-8">
              <div>
                <span>題名</span>      
                <p class="lead"><?php echo htmlspecialchars($title); ?></p>
              </div>
              <div>
                <span>内容</span>
                <p class="lead"><?php echo htmlspecialchars($feed); ?></p>
              </div>
              <div>
                <span>価格</span>
                <p class="lead"><?php echo htmlspecialchars($price); ?></p>
              </div>
    
                <form method="POST" action="">
                  <a href="post.php" class="btn" onclick="history.back()">&laquo;&nbsp;戻る</a>
                  <input type="hidden" name="action" value="submit">
                  <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
          </div>
        </div>
      </div><!-- /row -->
    </div><!-- /container -->
  </div><!-- /background_signup -->

  <script src="../assets/js/jquery-3.1.1.js"></script>
  <script src="../assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="../assets/js/bootstrap.js"></script>
</body>
</html>