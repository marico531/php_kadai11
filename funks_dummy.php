<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
//あぶない文字を無効化するコード。セキュリティー上大事
//$strに入力された文字を”htmlspecialchars”に通して、あぶない文字はworkしないようにする
//変なサイトにアクセスするコード入力なども可能。これらを無効にしておかないと、変なサイドへ誘導されデータを抜き取られることもあるため
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn() functionでその機能を持たせている
// 以下はローカルの場合
// function db_conn(){
//     try {
//         $db_name = "rugby_game_db";    //データベース名
//         $db_id   = "root";      //アカウント名
//         $db_pw   = "";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
//         $db_host = "localhost"; //DBホスト
//         return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
//     } catch (PDOException $e) {
//         exit('DB Connection Error:'.$e->getMessage());
//     }
// }

//以上はローカルの場合
// 以下はサクラサーバの場合

function db_conn(){
try {
    $db_name = "::::::::::::::::::::::::";    //データベース名
    $db_id   = "::::::::::::::::::::::::";      //アカウント名
    $db_pw   = ":::::::::::::::";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
    $db_host = "::::::::::::::::::::::::"; //DBホスト
    return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
}
}
//以上はサクラサーバの場合


//SQLエラー関数：sql_error($stmt)
//insert.phpの４．に連動
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

//insert.phpの４．に連動
//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}

//SessionCheck(スケルトン)
function sschk(){

//LOGINチェック このコードはセキュリティ強化のためのコード。どのページでも必要なため、funcs.phpへ関数化する。
// "!"がつくと、逆の意味になる。このケースは「セットされていなければ」となる
// ①「chk_ssid」がセットされていなければ　または②「chk_ssid」と「session_id」同じでなければ
if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
  //ログインエラーとなる 
     exit("Login Error");
  }else{
  //上記でない場合
     session_regenerate_id(true);  //SESSION KEYを入れ替える、という関数。”true”は必須
  //同じkeyだと、特定されやすいため、入れ替えする。セキュリティのため。  
     $_SESSION["chk_ssid"] = session_id();
  }


}
