<?php
    $db_link = require_once "connect.php";

    if(isset($_POST["login"]))
    {
        $account = $_POST["account"];
        $password = $_POST["password"];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = sprintf("SELECT * FROM students WHERE sid = '%s'" , $account);
        $result = $db_link->query($sql);

        if($result->num_rows == 1)
        {
            $temp = $result->fetch_assoc();

            if($password == $temp["password"])
            {
                session_start();
                $_SESSION["account"] = $account;
                $_SESSION["name"] = $temp["name"];
                $_SESSION["dept"] = $temp["dept"];
                header("location: ../home.php");
            }
            else alert("密碼錯誤");
        }
        else alert("帳號不存在");
    }
    else alert("Something wrong");

    $db_link->close();

    function alert($message)
    {
        echo "<script type='text/javascript'>alert('$message'); window.location.href = '../index.php' </script>";
    }
?>