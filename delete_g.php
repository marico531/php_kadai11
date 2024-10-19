<?php
//sessionはスタートさせる
session_start();

//1. POSTデータ取得
$id = $_GET["id"];

//2. DB接続します
include("funcs.php");
// funcs.phpを読み込んだ後に入れる
sschk();
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM game_an_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("select_g.php");
}
?>
