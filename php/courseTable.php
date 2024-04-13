<?php
    $db_link = require_once "connect.php";
    $sql = sprintf("SELECT * FROM student_timetable WHERE sid = '%s'" , $_SESSION["account"]);
    $result = $db_link->query($sql);

    while ($row = $result->fetch_assoc())
    {
        $script = sprintf("<script>document.getElementById('%d').innerHTML = '%s<br/>%s';</script>" , $row["timeid"] , $row["name"] , $row["cid"] );
        echo $script;
    }

    $db_link->close();
?>
