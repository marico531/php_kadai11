<?php
// エラーメッセージ表示
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// セッション開始
session_start();

// データベース接続
include("funcs.php");
$pdo = db_conn(); // funcs.phpにあるdb_conn()関数を呼び出す

// ログインチェック
sschk();

// データ登録SQL作成
$sql = "SELECT * FROM game_an_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ表示処理
if($status==false) {
  sql_error($stmt);
} else {
  $values = $stmt->fetchAll(PDO::FETCH_ASSOC); // 全データ取得
  $json = json_encode($values,JSON_UNESCAPED_UNICODE); // JSON形式でデータを取り込む
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>試合一覧表示</title>
<style>
  /* 全体のリセット */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  
  body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    padding: 20px;
  }

  /* ヘッダーのスタイル */
  header {
    background-color: #5cb85c;
    padding: 10px;
    color: white;
    text-align: center;
    margin-bottom: 20px;
    font-size: 1.5rem;
  }

  /* ナビゲーションリンク */
  .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
  }

  .navbar a {
    color: white;
    text-decoration: none;
    padding: 5px 10px;
    background-color: #4cae4c;
    border-radius: 4px;
    margin: 5px 0;
    font-size: 1rem; /* サイズを調整 */
  }

  .navbar a:hover {
    background-color: #45a049;
  }

  /* ヘッダー部分のレスポンシブ対応 */
  @media (max-width: 768px) {
    header {
      font-size: 1.2rem; /* ヘッダーフォントを小さく */
    }
    
    .navbar {
      flex-direction: column; /* ナビゲーションを縦に並べる */
      align-items: flex-start; /* 左揃えに変更 */
    }

    .navbar a {
      width: 100%; /* リンクを幅いっぱいに */
      text-align: center; /* テキストを中央揃え */
      margin-bottom: 10px;
    }
  }

  /* テーブルのスタイル */
  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    overflow-x: auto; /* テーブルが画面に収まらない場合にスクロールを追加 */
  }

  th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    white-space: nowrap; /* 改行せずに1行に収める */
  }

  th {
    background-color: #f2f2f2;
    color: #333;
  }

  td a {
    color: #5cb85c;
    text-decoration: none;
  }

  td a:hover {
    text-decoration: underline;
  }

  /* テーブル部分のレスポンシブ対応 */
  @media (max-width: 768px) {
    table, thead, tbody, th, td, tr {
      display: block;
    }

    th {
      display: none; /* ヘッダーを非表示にする */
    }

    td {
      display: flex;
      justify-content: space-between;
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }

    td::before {
      content: attr(data-label); /* 各セルの前にヘッダーの内容を表示 */
      font-weight: bold;
      text-align: left;
    }
  }
</style>

<script>
    function confirmDelete() {
      return confirm('削除してもいいですか？');
    }
</script>

</head>
<body>

<header>
  <div class="navbar">
    <span><?=$_SESSION["name"]?> さん、こんにちわ！</span>
    <div>
      <?php if($_SESSION["kanri_flg"] == "1"){ ?>
      <a href="index_g.php">試合登録</a>
      <?php } ?>
      <a href="select.php">チーム一覧</a>
      <a href="logout.php">ログアウト</a>
    </div>
  </div>
</header>

<!-- メインコンテンツ -->
<div>
  <h2>🏉試合一覧🏉</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>試合日時</th>
        <th>チーム</th>
        <th>ランク</th>
        <th>チーム</th>
        <th>ランク</th>
        <th>スタジアム</th>
        <th>スタジアムサイト</th>
        <th>備考</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($values as $v){ ?>
        <tr>
          <td data-label="ID"><?= h($v["id"]) ?></td>
          <td data-label="試合日時"><?= h($v["game_day"]) ?></td>
          <td data-label="チームA"><?= h($v["team_a"]) ?></td>
          <td data-label="ランクA"><?= h($v["team_a_lank"]) ?></td>
          <td data-label="チームB"><?= h($v["team_b"]) ?></td>
          <td data-label="ランクB"><?= h($v["team_b_lank"]) ?></td>
          <td data-label="スタジアム"><?= h($v["stadium"]) ?></td>
          <td data-label="スタジアムサイト"><a href="<?= h($v["stadium_url"]) ?>" target="_blank">公式サイト</a></td>
          <td data-label="備考"><?= h($v["naiyou"]) ?></td>
          <td data-label="操作">
            <?php if($_SESSION["kanri_flg"] == "1"){ ?>
            <a href="detail_g.php?id=<?=h($v["id"])?>">更新</a>
            <a href="delete_g.php?id=<?=h($v["id"])?>" onclick="return confirmDelete();">削除</a>
            <?php } ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script>
  const jsonData = '<?php echo $json; ?>';
  console.log(JSON.parse(jsonData));
</script>

</body>
</html>

