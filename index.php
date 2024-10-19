<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>チーム情報登録</title>
  <style>
    /* 全体のリセット */
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
      letter-spacing: 1.5px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* コンテナのスタイル */
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

    input[type="text"], textarea {
      width: 100%;
      padding: 12px;
      margin-top: 8px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 1rem;
      background-color: #f9f9f9;
      transition: border-color 0.3s;
    }

    input[type="text"]:focus, textarea:focus {
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
      background-color: #3498db;
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

<header>🏉 TEAM RECORD 登録 🏉</header>

<!-- Main[Start] -->
<div class="container">
  <form method="POST" action="insert.php">
    <fieldset>
      <legend>チーム情報を登録してください</legend>
      <label>チーム名：
        <input type="text" name="team_name" placeholder="チーム名を入力">
      </label>
      <label>チームサイトURL：
        <input type="text" name="team_url" placeholder="URLを入力">
      </label>
      <label>メインスタジアム名：
        <input type="text" name="stadium_name" placeholder="スタジアム名を入力">
      </label>
      <label>スタジアムサイトURL：
        <input type="text" name="stadium_url" placeholder="URLを入力">
      </label>
      <label>備考：
        <textarea name="naiyou" placeholder="備考を入力"></textarea>
      </label>
      <input type="submit" value="送信">
    </fieldset>
  </form>
  <a href="select.php" class="link">チーム一覧を見る</a>
</div>
<!-- Main[End] -->

</body>
</html>



