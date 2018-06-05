<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Learn SNS</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body style="margin-top: 60px; background: #E4E6EB;">
    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Learn SNS</a>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse1">
        <ul class="nav navbar-nav">
          <li><a href="timeline.php">タイムライン</a></li>
          <li class="active"><a href="#">ユーザー一覧</a></li>
        </ul>
        <form method="GET" action="" class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <input type="text" name="search_word" class="form-control" placeholder="投稿を検索">
          </div>
          <button type="submit" class="btn btn-default">検索</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="" width="18" class="img-circle">test <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">マイページ</a></li>
              <li><a href="signout.php">サインアウト</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-xs-3 text-center">
        <img src="http://placehold.jp/200x200.png" class="img-thumbnail" />
        <h2>Omoemon Nobi</h2>
        <button class="btn btn-default btn-block">フォローする</button>
      </div>

      <div class="col-xs-9">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#tab1" data-toggle="tab">Followers</a>
          </li>
          <li>
            <a href="#tab2" data-toggle="tab">Following</a>
          </li>
        </ul>
        <!--タブの中身-->
        <div class="tab-content">
          <div id="tab1" class="tab-pane fade in active">
            <div class="thumbnail">
              <div class="row">
                <div class="col-xs-2">
                  <img src="http://placehold.jp/80x80.png" width="80">
                </div>
                <div class="col-xs-10">
                  名前 オモえもん<br>
                  <a href="#" style="color: #7F7F7F;">2018-05-29 10:00:00からメンバー</a>
                </div>
              </div>
            </div>
            <div class="thumbnail">
              <div class="row">
                <div class="col-xs-2">
                  <img src="http://placehold.jp/80x80.png" width="80">
                </div>
                <div class="col-xs-10">
                  名前 オモえもん2<br>
                  <a href="#" style="color: #7F7F7F;">2018-05-29 10:00:00からメンバー</a>
                </div>
              </div>
            </div>
            <div class="thumbnail">
              <div class="row">
                <div class="col-xs-2">
                  <img src="http://placehold.jp/80x80.png" width="80">
                </div>
                <div class="col-xs-10">
                  名前 オモえもん2<br>
                  <a href="#" style="color: #7F7F7F;">2018-05-29 10:00:00からメンバー</a>
                </div>
              </div>
            </div><!-- thumbnail -->
          </div>
          <div id="tab2" class="tab-pane fade">
            <div class="thumbnail">
              <div class="row">
                <div class="col-xs-2">
                  <img src="http://placehold.jp/80x80.png" width="80">
                </div>
                <div class="col-xs-10">
                  名前 さとし<br>
                  <a href="#" style="color: #7F7F7F;">2018-05-29 10:00:00からメンバー</a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div><!-- class="col-xs-12" -->

    </div><!-- class="row" -->
  </div><!-- class="cotainer" -->
  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>