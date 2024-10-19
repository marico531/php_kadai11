<?php
// エラー処理のコード
error_reporting(E_ALL);
ini_set('display_errors', 1);

//1. POSTデータ取得
//[name,email,age,naiyou]
$game_date       = $_POST['game_date'];  // 'YYYY-MM-DD'
$game_time       = $_POST['game_time'];  // 'HH:MM'
// 日付と時間を結合して、'YYYY-MM-DD HH:MM:SS' の形式に変換
$game_day        = $game_date . ' ' . $game_time . ':00'; // 秒は00固定
// 日付と時間以外のデータ取得
$team_a          = $_POST["team_a"];
$team_a_lank     = $_POST["team_a_lank"];
$team_b          = $_POST["team_b"];
$team_b_lank     = $_POST["team_b_lank"];
$stadium         = $_POST["stadium"];
$stadium_url     = $_POST["stadium_url"];
$naiyou          = $_POST["naiyou"];

//2. DB接続します
//*** function化する！  *****************
include("funcs.php");// 外部ファイル読み込むためだけのコード。includehaは全部の意味
$pdo = db_conn();


//３．データ登録SQL作成
$sql="INSERT INTO game_an_table (game_day,team_a,team_a_lank,team_b,team_b_lank,stadium,stadium_url,naiyou,indate) 
       VALUES(:game_day,:team_a,:team_a_lank,:team_b,:team_b_lank,:stadium,:stadium_url,:naiyou,sysdate());";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':game_day',       $game_day,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':team_a',         $team_a,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':team_a_lank',    $team_a_lank,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':team_b',         $team_b,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':team_b_lank',    $team_b_lank,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':stadium',        $stadium,      PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT
$stmt->bindValue(':stadium_url',    $stadium_url,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou',         $naiyou,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); // 実行　true or false

//４．データ登録処理後
if($status==false){
  //*** function化する！*****************
  //エラーを表示させるコード
  sql_error($stmt);

}else{
  //*** function化する！*****************
  //情報をindex.phpに送るコード
redirect("index_g.php");
}

?>





