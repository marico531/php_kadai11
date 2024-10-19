<?php
session_start(); // セッション開始

include "funcs.php";

// URLパラメータで"skip_check"がセットされているか確認
if (!isset($_GET['skip_check']) || $_GET['skip_check'] !== 'true') {
    // "skip_check"が無い場合や"true"ではない場合、ログインチェックを実行
    sschk();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録</title>
  <style>
    <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f7f6;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #333;
    }

    .container {
      background-color: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      text-align: center;
      color: #34495e;
      margin-bottom: 20px;
      font-size: 1.8rem;
    }

    label {
      display: block;
      font-size: 1.1rem;
      margin-bottom: 10px;
    }

    input[type="text"], input[type="password"], input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: 1px solid #ddd;
      background-color: #f9f9f9;
      transition: border-color 0.3s;
    }

    input[type="text"]:focus, input[type="password"]:focus {
      border-color: #3498db;
      outline: none;
    }

    input[type="submit"] {
      background-color: #3498db;
      color: white;
      font-size: 1.2rem;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #2980b9;
    }

    .radio-label {
      display: inline-block;
      margin-right: 20px;
      font-size: 1rem;
    }

    .back-to-login {
      text-align: center;
      margin-top: 20px;
    }

    .back-to-login a {
      color: #3498db;
      text-decoration: none;
    }

    .back-to-login a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>🏉ユーザー登録🏉</h2>
  <form method="post" action="user_insert.php">
    <label>名前：</label>
    <input type="text" name="name" required>

    <label>Login ID：</label>
    <input type="text" name="lid" required>

    <label>Login PW：</label>
    <input type="password" name="lpw" required>

    <label>管理FLG：</label>
    <div>
      <label class="radio-label">
        <input type="radio" name="kanri_flg" value="0" required> 一般
      </label>
      <label class="radio-label">
        <input type="radio" name="kanri_flg" value="1"> 管理者
      </label>
    </div>

    <input type="submit" value="送信">
  </form>

  <!-- ログインページに戻るリンク -->
  <div class="back-to-login">
    <p>既にアカウントをお持ちですか？ <a href="login.php">ログインページに戻る</a></p>
  </div>
</div>

</body>
</html>
