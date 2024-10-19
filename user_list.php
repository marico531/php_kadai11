<?php
// セッション開始
session_start();

// funcs.phpをインクルード
include 'funcs.php';

// ログインチェック
sschk();

// 管理者かどうかをチェック
if ($_SESSION['kanri_flg'] != 1) {
    exit('Access Denied: あなたは管理者ではありません。');
}

// データベース接続
$pdo = db_conn();

// ユーザー一覧の取得SQL
$sql = "SELECT id, name, lid, lpw, kanri_flg, life_flg FROM rugby_an_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ取得に失敗した場合のエラーチェック
if ($status == false) {
    sql_error($stmt);
} else {
    // 結果を全て取得
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登録ユーザー一覧</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f7f6;
      padding: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #3498db;
      color: white;
    }

    a {
      color: #3498db;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
    }

    h2 {
      text-align: center;
      color: #34495e;
    }

    .back-link {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>登録ユーザー一覧</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>名前</th>
        <th>ログインID</th>
        <th>管理フラグ</th>
        <th>ライフフラグ</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
      <tr>
        <td><?= htmlspecialchars($user['id']) ?></td>
        <td><?= htmlspecialchars($user['name']) ?></td>
        <td><?= htmlspecialchars($user['lid']) ?></td>
        <td><?= $user['kanri_flg'] == 1 ? '管理者' : '一般' ?></td>
        <td><?= $user['life_flg'] == 0 ? 'アクティブ' : '退会済み' ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="back-link">
    <a href="select.php">チーム一覧に戻る</a></br>
  </div>
</div>

</body>
</html>
