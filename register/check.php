<?php
    session_start();

    if(!isset($_SESSION['register'])) {
    //正規のルートから遷移していない場合
      header("Location:signup.php");
      exit();
    }

   // ①
    $name = $_SESSION['register']['name'];
    $email = $_SESSION['register']['email'];
    $user_password = $_SESSION['register']['password'];
    $img_name = $_SESSION['register']['img_name'];

    // 登録ボタンが押された時の処理 = POSTがからじゃない

    if(!empty($_POST)) {
        // 1.DB実行
        require('../dbconnect.php');

        // 2.SQL文実行
        $sql = 'INSERT INTO `users` SET `name`=?, `email`=?, `password`=?, `img_name`=?, `created`=NOW()';
        $data = array($name, $email, password_hash($user_password, PASSWORD_DEFAULT), $img_name);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        // 3. データベース切断
         $dbh = null;

        unset($_SESSION['register']);
        //var_dump($_SESSION['register']);
        header('Location: thanks.php');
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
      <img src="../img/missyou_logo.png" style="width: 20%">
      <img src="../img/menu_bar.png" style="width: 5%; float: right;">
    </div>
  </header>

  <div class="background">
    <div class="container">
        <div class="row">
          <div class="col-xs-8 col-xs-offset-2 thumbnail">
          <h2 class="text-center content_header">アカウント情報確認</h2>
          <div class="row">
            <div class="col-xs-4">
              <img src="../user_profile_img/<?php echo htmlspecialchars($img_name); ?>" class="img-responsive img-tumbnail">
            </div>
            
            <div class="col-xs-8">
              <div>
                <span>名前</span>      
                <p class="lead"><?php echo htmlspecialchars($name); ?></p>
              </div>
              <div>
                <span>メールアドレス</span>
                <p class="lead"><?php echo htmlspecialchars($email); ?></p>
              </div>
              <div>
                <span>パスワード</span>
                <p class="lead">●●●●●●●●●●</p>
              </div>
    
                <form method="POST" action="">
                  <a href="signup.php" class="btn" onclick="history.back()">&laquo;&nbsp;戻る</a>
                  <input type="hidden" name="action" value="submit">
                  <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/js/jquery-3.1.1.js"></script>
  <script src="../assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="../assets/js/bootstrap.js"></script>
</body>
</html>
