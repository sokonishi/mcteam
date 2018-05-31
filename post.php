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
        <form method='POST' action='timeline.php'>
          <div>
            <h3>題名</h3>
            <input type="text" name="theme" placeholder="名前を入力してください" style="width:300px">
          </div>

          <div>
              <h3>内容</h3>
              <textarea name="content" cols="65" rows="5"></textarea>
          </div>

          <div>
              <h3>価格設定</h3>
              <input type="text" name="value" placeholder="価格設定" style="width: 300px">
          </div>

          <br>
          <a href="#" class="cross_line">
          <input type="submit" value="submit"></a>
        </form>
      </div>
    </div>
  </div>


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>