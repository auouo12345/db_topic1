<?php
    echo "<h1>" . "課程搜尋" . "</h1>";
    echo "<p>" . "搜尋結果：" . "</p>";
    $db_link = require_once "connect.php";
    $week = array("星期一" , "星期二" , "星期三" , "星期四" , "星期五");

    if(isset($_POST["search"]) && $_POST["pattern"] != "")
    {
        $sql = sprintf("SELECT * FROM course WHERE name LIKE '%%%s%%' ORDER BY cid" , $_POST["pattern"]);
        $result = $db_link->query($sql);

        while($row = $result->fetch_assoc())
        {
            echo $row["name"] . " 課程代號：" . $row["cid"] . "<br>";
            $sql = sprintf("SELECT * FROM course_timetable WHERE cid = %d ORDER BY timeid", $row["cid"]);
            $timetable = $db_link->query($sql);

            while($row_timetable = $timetable->fetch_assoc())
            {
                echo $week[$row_timetable["timeid"] / 14] . " 第" . $row_timetable["timeid"] % 14 . "節" . "<br>";
            }

            echo "<br>";
        }
    }
    //else if($_POST["search"] == "") alert("搜尋欄不可為空");
    else alert("Something wrong");

    $db_link->close();

    function alert($message)
    {
        echo "<script type='text/javascript'>alert('$message'); window.location.href = '../home.php'; </script>";
        exit();
    }
?>