<?php
    session_start();
    $db_link = require_once 'connect.php';

    if(isset($_POST['drop']))
    {
        $sql = sprintf("SELECT * FROM course WHERE cid = %d" , $_POST["cid"]);
        $result = $db_link->query($sql);

        if($result->num_rows == 0) alert("課程不存在");

        $sql = sprintf("SELECT * FROM students WHERE sid = '%s'" , $_SESSION["account"]);
        $studentInfo = $db_link->query($sql)->fetch_assoc();
        $courseInfo = $result->fetch_assoc();

        $sql = sprintf("SELECT * FROM course_selection WHERE sid = '%s' AND cid = %d" , $_SESSION["account"], $_POST["cid"]);
        $result = $db_link->query($sql);

        if($result->num_rows == 0) alert("未加選此課程");

        //(i) 退選後學分不可低於最低學分限制 (9 學分)；
        //if($studentInfo["credit"] - $courseInfo["credit"] < 9) alert("退選後學分不可低於最低學分限制 (9 學分)");

        $sql = sprintf("DELETE FROM course_selection WHERE sid = '%s' AND cid = %d" , $_SESSION["account"] , $_POST["cid"]);
        $db_link->query($sql);
        $sql = sprintf("DELETE FROM student_timetable WHERE sid = '%s' AND cid = %d" , $_SESSION["account"] , $_POST["cid"]);
        $db_link->query($sql);
        $sql = sprintf("UPDATE students SET credit = %d WHERE sid = '%s'" , $studentInfo["credit"] - $courseInfo["credit"] , $_SESSION["account"]);
        $db_link->query($sql);
        $sql = sprintf("UPDATE course SET current_quantity = %d WHERE cid = %d" , $courseInfo["current_quantity"] - 1 , $_POST["cid"]);
        $db_link->query($sql);

        if($courseInfo["required"] == 1) alert("退選成功，注意：此課程為必修課");
        else alert("退選成功");
    }

    $db_link->close();

    function alert($message)
    {
        echo "<script type='text/javascript'>alert('$message'); window.location.href = '../home.php';</script>";
        exit();
    }