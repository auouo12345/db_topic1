<?php
    session_start();
    $db_link = require_once "connect.php";

    if(isset($_POST["addSelection"]))
    {
        $sql = sprintf("SELECT * FROM course WHERE cid = '%d'" , $_POST["cid"]);
        $result = $db_link->query($sql);

        if($result->num_rows == 0) alert("課程不存在");

        $sql = sprintf("SELECT * FROM student WHERE cid = '%s'" , $_SESSION["account"]);
        $studentInfo = $db_link->query($sql)->fetch_assoc();
        $courseInfo = $result->fetch_assoc();

        if($studentInfo["dept"] != $courseInfo["dept"]) alert("系所不一");

    }
    else alert("Something wrong");

    $db_link->close();

    function alert($message)
    {
        echo "<script type='text/javascript'>alert('$message'); window.location.href = '../home.php';</script>";
    }