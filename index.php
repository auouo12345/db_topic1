<! DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>選課系統</title>
</head>
<body>
    <h1>選課系統</h1>
    <div class="login">
        <form action="" method="post">
            <p>帳號 <input type="text" name="account"></p>
            <p>密碼 <input type="password" name="password"></p>
            <input type="hidden" name="action">
            <input type="submit" value="送出">
        </form>
    </div>

    <?php
        if(isset($_POST["action"]))
        {
            $db_host = "localhost";
            $db_user = $_POST["account"];
            $db_password = $_POST["password"];
            $db_name = "ClassesDB";
            $db_link = new mysqli($db_host , $db_user , $db_password , $db_name);

            if($db_link->connect_error == "")
            {
                echo "連結成功";
                $db_link->query("SET NAMES 'utf8'");
            }
            else
            {
                die('資料庫連線錯誤:' . $db_link->connect_error);
            }
        }
    ?>
</body>
</html>