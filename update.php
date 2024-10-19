<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る

//insert.phpより 
///1. POSTデータ取得
$team_name      = $_POST["team_name"];
$team_url       = $_POST["team_url"];
$stadium_name   = $_POST["stadium_name"];
$stadium_url    = $_POST["stadium_url"];
$naiyou         = $_POST["naiyou"];
// 今回はidも必要なため、追加する
$id             = $_POST["id"];

//2. DB接続します
include("funcs.php"); // 外部ファイルを読み込むためのコード
$pdo = db_conn();

//３．データ登録SQL作成
$sql="UPDATE rugby_team_table SET team_name=:team_name, team_url=:team_url, stadium_name=:stadium_name, stadium_url=:stadium_url, naiyou=:naiyou WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':team_name',     $team_name,    PDO::PARAM_STR);  // 文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':team_url',      $team_url,     PDO::PARAM_STR);  // 文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':stadium_name',  $stadium_name, PDO::PARAM_STR);  // 文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':stadium_url',   $stadium_url,  PDO::PARAM_STR);  // 文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':naiyou',        $naiyou,       PDO::PARAM_STR);  // 文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':id',            $id,           PDO::PARAM_INT);  // 数値の場合 PDO::PARAM_INT
$status = $stmt->execute(); // 実行 true or false

//４．データ登録処理後
if($status==false){
    // エラーを表示させるコード
    sql_error($stmt);
}else{
    // 情報をselect.phpに送るコード
    redirect("select.php");
}
?>
