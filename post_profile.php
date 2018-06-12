<?php
    session_start();
    $errors = array();    //この配列の意味はエラーの種類

    require('dbconnect.php');

    $sql = 'SELECT * FROM `users` WHERE `id`=?';
    $data = array($_SESSION["id"]);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    $default = $record;

    if (!empty($_POST)) {   //POST送信があった時に以下を実行する
        $introduction = $_POST['input_introduction'];

        // 内容の空チェック
        if ($introduction == '') {
            $errors['introduction'] = 'blank';
        }

//画像名を取得
        $file_name = $_FILES[
          'input_img_name']['name'];
          if(!empty($file_name)) {
            //拡張子チェック
            $file_type = substr($file_name, -4);
            //画像の後ろから小文字4文字
            $file_type = strtolower($file_type);
            //比較するために取得した拡張子を小文字に変換する
            //var_dump($file_name);
            //exit();

            if( $file_type != '.jpg' && $file_type != '.png' && $file_type != '.gif' && $file_type != 'jpeg') {
              //エラーの時の処理
              $errors['img_name'] = 'type';
            }
          }
          else {
            //ファイルがないときの処理
            $file_name=$default["img_name"];
          }

          //echo $file_name."<br>"

          //echo"<pre>";
          //var_dump($_FILES);
          //echo"</pre>";

          if(empty($errors)) {
            $submit_file_name = $file_name;
            echo $submit_file_name;
            //move_uploaded_file(テンポラリパス、保存したい場所、ファイル名)

            move_uploaded_file($_FILES['input_img_name']['tmp_name'], 'user_profile_img/'.$submit_file_name);


            // 2.SQL文実行
            $sql = 'UPDATE `users` SET `img_name`=?, `introduction`=? WHERE `id`=?';
            $data = array($file_name, $introduction, $_SESSION["id"]);
            $stmt = $dbh->prepare($sql);
            $stmt->execute($data);

            header('Location:timeline.php');
            exit();
          }
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
      <div class="row col-xs-offset-10">
        <div class="copy_img top">
          <img src="img/copy.png" style="width: 50%">
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <form method='POST' action='post_profile.php' enctype="multipart/form-data">
          <div class="col-xs-12">
            <div class="form-group">
              <h3 for="img_name">写真</h3>
              <input type="file" name="input_img_name" id="img_name">
              <?php if(isset($errors['img_name']) && $errors['img_name'] == 'type') { ?>
              <p class="text-danger">拡張子が「jpg」「png」「gif」「jpeg」の画像を選択してください</p>
              <?php } ?>
              <h3>自己紹介</h3>
              <textarea name="input_introduction" class="form-control" cols="65" rows="5"></textarea>
              <?php if(isset($errors['introduction']) && $errors['introduction'] == 'blank') { ?>
              <p style="color: red;">自己紹介文を入力してください</p>
              <?php } ?>
            </div><!-- /form-group -->
            <input type="submit" class="btn btn-primary" value="保存">
          </div>
        </form>
      </div><!-- /row -->
    </div><!-- /container -->
  </div><!-- /background -->
  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>