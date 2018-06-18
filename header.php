<header>
  <div class="container">
    <div class="row">
      <a class="navbar-brand" href="timeline.php"><img src="img/missyou_logo.png" class="missyou_log_img" "></a>

      <div class="hamburger-menu type-9">
        <div class="hamburger-menu1"></div>
        <div class="hamburger-menu2"></div>
        <div class="hamburger-menu3"></div>
      </div><!-- /hamburger-menu -->
      <div class="right-header" id="dropmenu">
          <li>
            <img class="user_profile_img_sm type-9" src="user_profile_img/<?php echo $users_record['img_name'] ?>" >
            <ul>
              <li><a href="post.php"><i class="fa fa-share-square-o fa-fw" aria-hidden="true"></i>投稿</a></li>
              <li><a href="signout.php" class="noline"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>サインアウト</a></li>
            </ul>
          </li>
      </div><!-- /right-header -->
    </div><!-- /row -->
  </div><!-- /container -->
</header>
  <div class="container">
    <div class="row">
      <div class="header-menu" >
        <ul>
<!--           <li><a href="timeline.php">ホーム</a></li>
          <li><a href="mypage.php">マイページ</a></li> -->
          <li><a href="post.php" class="noline"><i class="fa fa-share-square-o fa-fw" aria-hidden="true"></i> 投稿</a></li>
<!--           <li><a href="ranking.php">ランキング</a></li> -->
          <li><a href="signout.php" class="noline"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> サインアウト</a></li>
        </ul>
      </div><!-- /header-menu -->
    </div><!-- /row -->
  </div><!-- /container -->