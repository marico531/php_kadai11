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
$sql = "SELECT * FROM rugby_team_table";
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
<title>チーム一覧表示</title>
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
  }

  .navbar a:hover {
    background-color: #45a049;
  }

  /* レスポンシブ対応 */
  @media (max-width: 768px) {
    .navbar {
      flex-direction: column; /* 縦に並べる */
      align-items: center; /* 中央寄せ */
    }

    .navbar span {
      font-size: 1.2rem; /* 名前の文字サイズを小さく */
      margin-bottom: 10px; /* 余白を追加 */
    }

    .navbar a {
      width: 100%;
      text-align: center;
      padding: 10px;
      font-size: 1rem; /* ボタンの文字サイズを調整 */
      margin: 5px 0; /* ボタン間の余白 */
    }

    header {
      font-size: 1.3rem; /* ヘッダーの文字サイズを小さく */
    }
  }

  /* カード形式のチーム一覧 */
  .card-container {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
  }

  .card {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .card h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
  }

  .card p {
    margin-bottom: 8px;
    font-size: 1rem;
  }

  .card a {
    color: #5cb85c;
    text-decoration: none;
    font-weight: bold;
  }

  .card a:hover {
    text-decoration: underline;
  }

  /* デスクトップ対応 */
  @media (min-width: 768px) {
    .card-container {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (min-width: 1024px) {
    .card-container {
      grid-template-columns: repeat(3, 1fr);
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
      <a href="index.php">チーム登録</a>
      <a href="user_list.php">登録ユーザー一覧</a>
      <?php } ?>
      <a href="select_g.php">試合一覧</a>
      <a href="logout.php">ログアウト</a>
    </div>
  </div>
</header>

<!-- メインコンテンツ -->
<div>
  <h2>🏉チーム一覧🏉</h2>
  <div class="card-container">
    <?php foreach($values as $v){ ?>
      <div class="card">
        <h3><?= h($v["team_name"]) ?></h3>
        <p>メインスタジアム: <?= h($v["stadium_name"]) ?></p>
        <p>スタジアムサイト: <a href="<?= h($v["stadium_url"]) ?>" target="_blank">公式サイト</a></p>
        <p>チームサイト: <a href="<?= h($v["team_url"]) ?>" target="_blank">公式サイト</a></p>
        <p>備考: <?= h($v["naiyou"]) ?></p>
        <div>
          <?php if($_SESSION["kanri_flg"] == "1"){ ?>
            <a href="detail.php?id=<?=h($v["id"])?>">更新</a> |
            <a href="delete.php?id=<?=h($v["id"])?>" onclick="return confirmDelete();">削除</a>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<script>
  const jsonData = '<?php echo $json; ?>';
  console.log(JSON.parse(jsonData));
</script>

</body>
</html>
