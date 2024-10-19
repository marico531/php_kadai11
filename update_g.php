<?php
// エラー処理のコード
error_reporting(E_ALL);
ini_set('display_errors', 1);

//1. POSTデータ取得
$game_date = $_POST['game_date'];
$game_time = $_POST['game_time'];

// 日付や時間が空でないことをチェック
if (empty($game_date) || empty($game_time)) {
    // エラーメッセージを表示して処理を中断
    die('日付または時間が指定されていません');
}

// 日付と時間を結合して、'YYYY-MM-DD HH:MM:SS' の形式に変換
$game_day        = $game_date . ' ' . $game_time . ':00'; // 秒は00固定

// 確認用にechoで値を表示する
echo $game_day;  // 値を確認


// 日付と時間以外のデータ取得
$team_a          = $_POST["team_a"];
$team_a_lank     = $_POST["team_a_lank"];
$team_b          = $_POST["team_b"];
$team_b_lank     = $_POST["team_b_lank"];
$stadium         = $_POST["stadium"];
$stadium_url     = $_POST["stadium_url"];
$naiyou          = $_POST["naiyou"];
$id              = $_POST["id"]; // 更新対象のID

//2. DB接続
include("funcs.php");
$pdo = db_conn();

//３．データ更新SQL作成
// insert→updateにかえる
$sql = "UPDATE game_an_table 
        SET game_day = :game_day, team_a = :team_a, team_a_lank = :team_a_lank, team_b = :team_b, 
            team_b_lank = :team_b_lank, stadium = :stadium, stadium_url = :stadium_url, naiyou = :naiyou 
        WHERE id = :id"; // IDで対象のレコードを特定して更新する

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':game_day',       $game_day,     PDO::PARAM_STR);
$stmt->bindValue(':team_a',         $team_a,       PDO::PARAM_STR);
$stmt->bindValue(':team_a_lank',    $team_a_lank,  PDO::PARAM_STR);
$stmt->bindValue(':team_b',         $team_b,       PDO::PARAM_STR);
$stmt->bindValue(':team_b_lank',    $team_b_lank,  PDO::PARAM_STR);
$stmt->bindValue(':stadium',        $stadium,      PDO::PARAM_STR);
$stmt->bindValue(':stadium_url',    $stadium_url,  PDO::PARAM_STR);
$stmt->bindValue(':naiyou',         $naiyou,       PDO::PARAM_STR);
$stmt->bindValue(':id',             $id,           PDO::PARAM_INT); // 更新対象のIDを指定
$status = $stmt->execute(); // 実行

//４．データ更新処理後
if($status==false){
  sql_error($stmt);
}else{
  // select_g.phpにリダイレクト
  redirect("select_g.php");
}

?>
