<?php
//$_SESSION使うよ！
session_start();

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";

// sschk() はここでは不要です。ログインチェックを行わないようにします。

// エラーメッセージ表示設定
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//1. POSTデータ取得
$name      = filter_input(INPUT_POST, "name");
$lid       = filter_input(INPUT_POST, "lid");
$lpw       = filter_input(INPUT_POST, "lpw");
$kanri_flg = filter_input(INPUT_POST, "kanri_flg");
$lpw       = password_hash($lpw, PASSWORD_DEFAULT);   // パスワードハッシュ化

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO rugby_an_table(name,lid,lpw,kanri_flg,life_flg)VALUES(:name,:lid,:lpw,:kanri_flg,0)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    // エラーがあった場合、エラーメッセージを表示する
    sql_error($stmt);
} else {
    // 成功したらログインページにリダイレクト
    header("Location: login.php");
    exit();
}
?>
