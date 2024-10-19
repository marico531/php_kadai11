<?php
// セッションの開始
session_start();

// GETパラメータからIDを取得
$id = $_GET["id"];

// 必要な関数やデータベース接続設定を読み込み
include("funcs.php");
sschk();
$pdo = db_conn();

// データベースからIDに対応するデータを取得
$sql = "SELECT * FROM game_an_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// エラーチェックとデータの取得
if ($status == false) {
    sql_error($stmt);
}
$v = $stmt->fetch();

// 日付と時間を分離
$game_day = $v["game_day"];
$game_date = date("Y-m-d", strtotime($game_day));  // YYYY-MM-DD 形式
$game_time = date("H:i", strtotime($game_day));    // HH:MM 形式
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>試合情報更新</title>
  <style>
    /* 基本リセット */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background-color: #f0f4f8;
      color: #333;
      padding: 20px;
    }

    header {
      background-color: #2c3e50;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 2rem;
      font-weight: bold;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    legend {
      font-size: 1.5rem;
      color: #34495e;
      margin-bottom: 20px;
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 15px;
      font-size: 1.1rem;
      color: #555;
    }

    input[type="text"], textarea, input[type="date"], input[type="time"] {
      width: 100%;
      padding: 12px;
      margin-top: 8px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 1rem;
      background-color: #f9f9f9;
      transition: border-color 0.3s;
    }

    input[type="text"]:focus, textarea:focus, input[type="date"]:focus, input[type="time"]:focus {
      border-color: #3498db;
      outline: none;
    }

    textarea {
      resize: none;
      height: 100px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #2c3e50;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1.2rem;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #2980b9;
    }

    .link {
      display: block;
      text-align: center;
      margin-top: 20px;
      font-size: 1.1rem;
      color: #3498db;
      text-decoration: none;
    }

    .link:hover {
      text-decoration: underline;
    }

  </style>
</head>
<body>

<header>🏉 試合情報更新 🏉</header>

<!-- Main[Start] -->
<div class="container">
  <form method="POST" action="update_g.php">
    <fieldset>
      <legend>試合情報を更新してください</legend>
      <label>試合日：
        <input type="date" name="game_date" value="<?= htmlspecialchars($game_date, ENT_QUOTES, 'UTF-8') ?>">
      </label>
      <label>試合時間：
        <input type="time" name="game_time" value="<?= htmlspecialchars($game_time, ENT_QUOTES, 'UTF-8') ?>">
      </label>
      <label>チームA：
        <input type="text" name="team_a" value="<?= htmlspecialchars($v["team_a"], ENT_QUOTES, 'UTF-8') ?>">
      </label>
      <label>チームAランク：
        <input type="text" name="team_a_lank" value="<?= htmlspecialchars($v["team_a_lank"], ENT_QUOTES, 'UTF-8') ?>">
      </label>
      <label>チームB：
        <input type="text" name="team_b" value="<?= htmlspecialchars($v["team_b"], ENT_QUOTES, 'UTF-8') ?>">
      </label>
      <label>チームBランク：
        <input type="text" name="team_b_lank" value="<?= htmlspecialchars($v["team_b_lank"], ENT_QUOTES, 'UTF-8') ?>">
      </label>
      <label>スタジアム名：
        <input type="text" name="stadium" value="<?= htmlspecialchars($v["stadium"], ENT_QUOTES, 'UTF-8') ?>">
      </label>
      <label>スタジアムサイトURL：
        <input type="text" name="stadium_url" value="<?= htmlspecialchars($v["stadium_url"], ENT_QUOTES, 'UTF-8') ?>">
      </label>
      <label>備考：
        <textarea name="naiyou"><?= htmlspecialchars($v["naiyou"], ENT_QUOTES, 'UTF-8') ?></textarea>
      </label>
      <input type="hidden" name="id" value="<?= htmlspecialchars($v["id"], ENT_QUOTES, 'UTF-8') ?>">
      <input type="submit" value="送信">
    </fieldset>
  </form>
  <a href="select_g.php" class="link">試合一覧を見る</a>
</div>
<!-- Main[End] -->

</body>
</html>
