<?php 
    session_start();

    //$_SESSION変数の破棄（ローカル）＝　空の配列を代入
    $_SESSION = array();

    //セッションを破棄（サーバー）
    session_destroy();

    header('Location: signin.php');
    exit();
    
?>