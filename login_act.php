<?php
// エラーメッセージ表示設定
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// セッション開始
session_start();
echo "セッション開始しました。<br>";

// POSTデータを受け取る
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
echo "POSTデータ受け取り完了: LID = " . htmlspecialchars($lid) . "<br>";

// データベース接続
include("funcs.php");
$pdo = db_conn();
if (!$pdo) {
    echo "データベース接続失敗<br>";
    exit();
}
echo "データベース接続に成功しました<br>";

// SQLクエリを実行
$stmt = $pdo->prepare("SELECT * FROM rugby_an_table WHERE lid=:lid AND life_flg=0");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();
if ($status == false) {
    echo "SQLクエリ実行失敗<br>";
    $error = $stmt->errorInfo();
    echo "SQLエラー: " . $error[2] . "<br>";
    exit();
}
echo "SQLクエリ実行成功<br>";

// データ取得
$val = $stmt->fetch();
if ($val) {
    echo "ユーザーが見つかりました<br>";
} else {
    echo "ユーザーが見つかりません<br>";
    exit();
}

// パスワード照合
if (password_verify($lpw, $val['lpw'])) {
    echo "パスワードが一致しました<br>";

    // セッション設定
    $_SESSION["chk_ssid"]  = session_id();
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["name"]      = $val['name'];

    // リダイレクト処理
    header("Location: select.php"); // リダイレクト先を設定
    exit(); // リダイレクト後にスクリプトが続かないようにする
} else {
    echo "パスワードが一致しません<br>";
    header("Location: login.php"); // ログイン失敗時にリダイレクト
    exit();
}
?>
