<?php
    $db_link = require_once "connect.php";
    $sql = sprintf("SELECT * FROM student_timetable WHERE sid = '%s'" , $_SESSION["account"]);
    $result = $db_link->query($sql);

    while ($row = $result->fetch_assoc())
    {
        $sql = sprintf("SELECT * FROM course WHERE cid = '%s'" , $row["cid"]);
        $courseInfo = $db_link->query($sql)->fetch_assoc();
        $script = sprintf("<script>document.getElementById('%d').innerText = '%s';</script>" , $row["timeid"] , $courseInfo["name"]);
        echo $script;
    }

    $db_link->close();
?>
