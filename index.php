<! DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登入</title>
</head>
<body>
    <h1>登入</h1>

    <div class="login">
        <form action="php/login.php" method="post">
            <p>帳號 <input type="text" name="account"></p>
            <p>密碼 <input type="password" name="password"></p>
            <input type="hidden" name="login">
            <input type="submit" value="送出">
        </form>
    </div>
</body>
</html>