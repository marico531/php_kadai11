<?php
// エラー処理のコード
error_reporting(E_ALL);
ini_set('display_errors', 1);

//1. POSTデータ取得
//[name,email,age,naiyou]
$team_name      = $_POST["team_name"];
$team_url       = $_POST["team_url"];
$stadium_name   = $_POST["stadium_name"];
$stadium_url    = $_POST["stadium_url"];
$naiyou         = $_POST["naiyou"];

//2. DB接続します
//*** function化する！  *****************
include("funcs.php");// 外部ファイル読み込むためだけのコード。includehaは全部の意味
$pdo = db_conn();


//３．データ登録SQL作成
$sql="INSERT INTO rugby_team_table (team_name,team_url,stadium_name,stadium_url,naiyou,indate) 
       VALUES(:team_name,:team_url,:stadium_name,:stadium_url,:naiyou,sysdate());";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':team_name',     $team_name,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':team_url',      $team_url,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':stadium_name',  $stadium_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':stadium_url',   $stadium_url,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou',        $naiyou,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); // 実行　true or false

//４．データ登録処理後
if($status==false){
  //*** function化する！*****************
  //エラーを表示させるコード
  sql_error($stmt);

}else{
  //*** function化する！*****************
  //情報をindex.phpに送るコード
redirect("index.php");
}

?>





