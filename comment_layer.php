<?php 
//  session_start();
//  require('dbconnect.php');
//
//  $feed_id = $_GET['feed_id'];
//  $user_id = $_SESSION['id'];
//
//  require('click_count.php');
//
//  require('comment_function.php');
//
//  $record = feed_detail($dbh,$feed_id);
//
//  $users_record = user_detail($dbh,$user_id);
//
//  $record_cnt = feed_count($dbh,$feed_id);
//
//  post_comment($dbh,$feed_id,$user_id);
//
//  $comments = comment_detail($dbh,$feed_id);


//  $sql = 'SELECT `f`.*, `u`.`name`,`u`.`img_name`, `u`.`introduction` FROM `feeds` AS `f` LEFT JOIN `users` AS `u` ON `f`.`user_id` = `u`.`id` WHERE `f`.`id`=?';
//  $data = array($feed_id);
//  $stmt = $dbh->prepare($sql);
//  $stmt->execute($data);
//
//  $record = $stmt->fetch(PDO::FETCH_ASSOC);
//
//  //echo '<pre>';
//  //var_dump($feed_id);
//  //echo '<pre>';
//
//  $users_sql = 'SELECT * FROM `users` WHERE `id`=?';
//  $users_data = array($_SESSION['id']);
//  $users_stmt = $dbh->prepare($users_sql);
//  $users_stmt->execute($users_data);
//
//  $users_record = $users_stmt->fetch(PDO::FETCH_ASSOC);
//
//  //var_dump($users_record);
//
//  $sql_count = "SELECT COUNT(*) as `cnt` FROM `feeds` WHERE `id`=?";
//  $data_cnt = array($feed_id);
//  $stmt_count = $dbh->prepare($sql_count);
//  $stmt_count->execute($data_cnt);
//
//  $record_cnt = $stmt_count->fetch(PDO::FETCH_ASSOC);
//
//  $errors = array();
//
//  if (!empty($_POST)) {
//
//    $comment = $_POST['comment'];
//
//    if ($comment != '') {
//      $comment_sql = 'INSERT INTO `comments` SET `comment`=?, `feed_id`=?,`user_id`=?, `created`=NOW()';
//      $comment_data = array($comment, $feed_id, $_SESSION['id']);
//      $comment_stmt = $dbh->prepare($comment_sql);
//      $comment_stmt->execute($comment_data);
//
//      //------------重要--------------
//      header('Location: comment_layer.php?feed_id='.$feed_id);
//      exit();
//      } else {
//        $errors['comment'] = 'blank';
//      }
//    }
//  //echo '<pre>';
//  //var_dump($users_record);
//  //echo '<pre>';
//
//  $post_sql = "SELECT `c`.*, `u`.`name` , `u`.`img_name` ,`u`.`introduction` FROM `comments` AS `c` LEFT JOIN `users` AS `u` ON `c`.`user_id` = `u`.`id` //WHERE `feed_id` = ? ORDER BY `c`.`created` DESC";
//
//  $post_data = array($feed_id);
//  $post_stmt = $dbh->prepare($post_sql);
//  $post_stmt->execute($post_data);
//
//  $comments = array();
//  while (true) {
//    $post_record = $post_stmt->fetch(PDO::FETCH_ASSOC);
//
//    if ($post_record == false){
//      break;
//    } 
//    $comments[] = $post_record;
//  }
  //echo '<pre>';
  //var_dump($comments);
  //echo '<pre>';
  
 ?>

<!-- <!DOCTYPE html>
<html lang="ja">
<meta charset="utf-8">
<head>
  <title>missyou</title>
  
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/elohssa.css">
</head>
<body> -->

<!--     <div class="container-fluid">
    <div class="row">
      <div class="col-xs-offset-1 col-xs-10 col-sm-12 comment_layer_col" style="padding: 0px; background-color: #fff">
        <div class="col-sm-7" style="padding: 0px;">
          <img src="user_profile_img/?php echo $feed['feed_img']; ?>" id="comment_layer_img">
          <div class="col-sm-7 wrapper" style="padding: 0px;">
            <div class="square">
              <div class="col-xs-offset-1 col-xs-10">
                <h3>?php echo $feed["title"] ?></h3>
                <p>?php echo $feed["feed"] ?></p>
                <h2>?php echo $feed["price"] ?>円</h2>
                <div class="purchase_btn_wrapper">
                  <a href="purchase.php" class="purchase_btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> カートに入れる</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-5 right_col">
          <div class="col-xs-4">
            <img src="img/sample_img.jpg" class="profile_img">
          </div>
          <div class="col-xs-8">
            <h4>Name?php echo $users_record['name'] ?></h4>
            <p>投稿 : 3?php echo $record_cnt["cnt"]; ?>件  フォロワー98人 フォロー中129件</p>
            <p>2018-06-09?php echo $users_record['introduction'] ?> </p>
          </div>
          <div class="row comment_box">
            <div class="col-xs-12">
              <form method="POST" action="">
                <div class="form-group">
                  <label for="comment">ツッコミを書く</label>
                  <textarea class="form-control" rows="2" id="comment"></textarea>
                  <a href="#" class="btn btn-primary btn-xs active" role="button" aria-pressed="true">ツッコむ</a>
                </div>
              </form>
            </div>
          </div>
          <div class="row comment_box">
            <div class="col-xs-12">
              <div class="col-xs-4">
                <img src="img/sample_img.jpg" class="profile_img" >
              </div>
              <div class="col-xs-8">
                <h4>Name</h4>
                <p>2018-06-09</p>
                <p>高すぎるわ！</p>
              </div>
            </div>
          </div>
          <div class="row comment_box">
            <div class="col-xs-12">
              <div class="col-xs-4">
                <img src="img/sample_img.jpg" class="profile_img" >
              </div>
              <div class="col-xs-8">
                <h4>Name</h4>
                <p>2018-06-09</p>
                <p>高すぎるわ！</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              いいね数：8
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

<div class="container-fluid" id="#cardpotision<?php echo $feed['id'] ?>">
    <div class="row">
      <div class="col-xs-offset-1 col-xs-10 col-sm-12 comment_layer_col" style="padding: 0px; background-color: #fff">
        <div class="col-sm-7" style="padding: 0px;">
          <img src="user_profile_img/<?php echo $feed['feed_img'] ?>" id="comment_layer_img">
          <div class="col-sm-7 wrapper" style="padding: 0px;">
            <div class="square">
              <div class="col-xs-offset-1 col-xs-10">
                <h3><?php echo $feed['title'] ?></h3>
                <p><?php echo $feed['feed'] ?></p>
                <h2 class="cost"><?php echo $feed['price'] ?>円</h2>
                <div class="purchase_btn_wrapper">

                  <a href="purchase.php" class="purchase_btn"><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i>カートに入れる</a>
                </div><!-- /purchase_btn_wrapper -->
                <div class="sns_share" style="">
                  <a href=""><i class="fa fa-facebook-official fa-fw fa-2x" aria-hidden="true"></i></a>
                  <a href=""><i class="fa fa-twitter fa-fw fa-2x" aria-hidden="true"></i></a>
                </div><!-- /sns_share -->
              </div><!-- /col-xs-10 -->
            </div><!-- /square -->
          </div><!-- /col-sm-7 -->
        </div><!-- /col-sm-7 -->
        <div class="row">
          <div class="col-sm-5 right_col">
            <div class="col-xs-12 user_profile">
              <div class="col-xs-4">
                <img src="user_profile_img/<?php echo $feed['feed_user']['img_name'] ?>" class="profile_img">
              </div><!-- /col-xs-4 -->
              <div class="col-xs-8 profile_name">
                <h4><?php echo $feed['feed_user']['name'] ?></h4>
                <p class="text-muted">投稿 : <?php echo $feed['feed_cnt']['cnt']; ?>件  フォロワー98人 フォロー中129件</p>
              </div><!-- /col-xs-4 -->
            <!-- <div class="row profile_row"> -->
              <!-- <div class="col-xs-12"> -->
                <!-- <p><?php /*echo $feed['feed_user']['introduction']*/ ?></p> -->
              <!-- </div>/col-xs-12 -->
            <!-- </div>/col-xs-12 -->
            </div><!-- /row -->

            <div style="width: 100%; height: 48vh; overflow: auto; border-bottom: 1px solid #ddd" class="masumi">
              <?php foreach($comments as $comment) {?>
              <div class="row comment_box">
                <div class="col-xs-12">
                  <div class="col-xs-4">
                    <img src="user_profile_img/<?php echo $comment['img_name'] ?>"  class="profile_img" >
                  </div><!-- /col-xs-4 -->
                  <div class="col-xs-8">
                    <h4><?php echo $comment['name'] ?></h4>
                    <p class="text-muted"><?php echo $comment['created'] ?></p>
                    <div class="row comment_content">
                      <div class="col-xs-12">
                        <p><?php echo $comment['comment'] ?></p>
                      </div><!-- /col-xs-12 -->
                    </div><!-- /row -->
                  </div><!-- /col-xs-8 -->
                </div><!-- /col-xs-12 -->
              </div><!-- /row -->
              <?php } ?>
            </div>

            <div class="row">
              <div class="col-xs-12 share_like_comment">
                <div class="row share_like">
                  <div class="col-xs-12">

                    <?php if($feed["like_flag"] == 0){ ?>
                        <button type="button" class="btn btn-default btn-circle hoge"><i class="fa fa-heart fa-fw fa-lg heart" aria-hidden="true"></i>:83</i></button>

                        <button type="button" class="btn btn-default btn-circle ika" style="display: none"><i class="fa fa-heart fa-fw fa-lg heart" aria-hidden="true" style="color: red;"></i>:83</i></button>
                        <input class="fuga" type="hidden" value="<?php echo $feed["id"]; ?>">
                    <?php }else{ ?>
                    <!-- いいねを取り消すボタンを表示 -->
                        <button type="button" class="btn btn-default btn-circle hoge" style="display: none"><i class="fa fa-heart fa-fw fa-lg heart" aria-hidden="true"></i>:83</i></button>

                        <button type="button" class="btn btn-default btn-circle ika"><i class="fa fa-heart fa-fw fa-lg heart" aria-hidden="true" style="color: red;"></i>:83</i></button>
                        <input class="fuga" type="hidden" value="<?php echo $feed["id"]; ?>">
                      <?php echo $feed['id'] ?>
                    <?php } ?>
                    
                    <i class="fa fa-eye fa-fw fa-lg eye" aria-hidden="true"></i>:100

                  </div><!-- /col-xs-12 -->
                </div><!-- /row -->
              <div class="row comment_box">
                <div class="col-xs-12">
                    <div class="form-group">
                      <textarea name="comment" class="form-control" rows="3" id="comment">ツッコミを書く</textarea>
                      <?php if(isset($errors['feed']) && $errors['feed'] == 'blank') { ?>
                      <p class="alert alert-danger">何か入力してください</p>
                      <?php } ?>
                      <input type="hidden" name="feed_id" value="<?php echo $feed["id"]; ?>">
                      <input type="button" value="ツッコむ" class="btn btn-primary btn-xs active tukkomi" role="button" style="margin-top: 5px" aria-pressed="true">
                    </div><!-- /form-group -->
                </div><!-- /col-xs-12 -->
              </div><!-- /row -->
            </div><!-- /col-xs-12 -->
          </div><!-- /row -->

        </div><!-- /col-sm-5 -->
      </div><!-- /row -->
    </div><!-- /col-xs-12 -->
  </div><!-- /row -->
</div><!-- /container-fluid -->
          
          <?php foreach($comments as $comment) {?>
          <div class="row comment_box">
            <div class="col-xs-12">
              <div class="col-xs-4">
                <img src="user_profile_img/<?php echo $comment['img_name'] ?>"  class="profile_img" >
              </div>
              <div class="col-xs-8">
                <h4><?php echo $comment['name'] ?></h4>
                <p><?php echo $comment['created'] ?></p>
                <p><?php echo $comment['comment'] ?></p>
              </div>
            </div>
          </div>
          <?php } ?>
          

          <div class="row">
            <div class="col-xs-12">
              いいね数：8
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




<!-- <script src="assets/js/jquery-3.1.1.js"></script>
<script src="assets/js/jquery-migrate-1.4.1.js"></script>
<script src="assets/js/bootstrap.js"></script>
</body>
</html> -->