<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
  <style>
    /* 基本スタイルリセット */
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

    .signup-link {
      text-align: center;
      margin-top: 20px;
    }

    .signup-link a {
      color: #3498db;
      text-decoration: none;
    }

    .signup-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>🏉Login🏉</h2>
  <form name="form1" action="login_act.php" method="post">
    <label>ID:</label>
    <input type="text" name="lid" required>
    
    <label>PW:</label>
    <input type="password" name="lpw" required>
    
    <input type="submit" value="ログイン">
  </form>

  <div class="signup-link">
  <p>新規ユーザーですか？ <a href="user.php?skip_check=true">ユーザー登録</a></p>
</div>

</div>

</body>
</html>
