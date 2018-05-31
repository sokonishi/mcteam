<?php
    session_start();
    $errors = array();    //この配列の意味はエラーの種類

    if (!empty($_POST)) {   //POST送信があった時に以下を実行する
        $theme = $_POST['input_theme'];
        $feed = $_POST['input_feed'];
        $price = $_POST['input_price'];

        // 内容の空チェック
        if ($theme == '') {
            $errors['theme'] = 'blank';
        }
        elseif($feed == ''){
            $errors['feed'] = 'blank';
        }

        if ($price == '') {
            $errors['price'] = 'blank';
        }

          var_dump($_FILES,$_POST);
          exit();
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
            $errors['img_name']='blank';
          }

          //echo $file_name."<br>"

          if(empty($errors)) {
            //エラーがなかった時の取得
            date_default_timezone_set('Asia/Manila');   //フィリピン時間に設定
            $date_str = date('YmdHis');
            //この行を実行した日時を取得
            $submit_file_name = $date_str.$file_name;
            echo $date_str;
            echo "<br>";
            echo $submit_file_name;
            //move_uploaded_file(テンポラリパス、保存したい場所、ファイル名)

            move_uploaded_file($_FILES['input_img_name']['tmp_name'], 'user_profile_img/'.$submit_file_name);

            //var_dump($_FILES);
            //exit();
            //$_SESSIONサーバーに保存されるスーパーグローバル変数
            //ログインしていることのユーザー情報などを保存しておくことが多い

            $_SESSION['mcteam']['theme'] = $_POST['input_theme'];
            $_SESSION['mcteam']['feed'] = $_POST['input_feed'];
            $_SESSION['mcteam']['price'] = $_POST['input_price'];
            $_SESSION['mcteam']['img_name'] = $submit_file_name;

            header('Location:post_conform.php');
            exit();
          }
    }

    // PHPプログラム
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
        <form method='POST' action='post.php'>

          <div class="form-group">
            <label for="img_name">写真</label>
            <input type="file" name="input_img_name" id="img_name">
              <?php if(isset($errors['img_name']) && $errors['img_name'] == 'type') { ?>
              <p class="text-danger">拡張子が「jpg」「png」「gif」「jpeg」の画像を選択してください</p>
              <?php } ?>
              <?php if(isset($errors['img_name']) && $errors['img_name'] == 'blank') { ?>
              <p class="text-danger">画像を選択してください</p>
              <?php } ?>
          </div>

          <div>
            <h3>題名</h3>
            <input type="text" name="input_theme" placeholder="名前を入力してください" style="width:300px">
          </div>

          <div>
              <h3>内容</h3>
              <textarea name="input_feed" cols="65" rows="5"></textarea>
          </div>

          <div>
              <h3>価格設定</h3>
              <input type="text" name="input_price" placeholder="価格設定" style="width: 300px">
          </div>
          <br>
          <input type="submit" value="submit">
        </form>
      </div>
    </div>
  </div>


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>