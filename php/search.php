<?php
    if(isset($_POST["search"]) && $_POST["pattern"] != "")
    {
        echo "<h1>" . "課程搜尋" . "</h1>";
        echo "<p>" . "搜尋結果：" . "</p>";
        $db_link = include "connect.php";
        $week = array("星期一" , "星期二" , "星期三" , "星期四" , "星期五");
        $sql = sprintf("SELECT * FROM course WHERE name LIKE '%%%s%%' ORDER BY cid" , $_POST["pattern"]);
        $result = $db_link->query($sql);

        while($row = $result->fetch_assoc())
        {
            echo "<p>" . $row["name"] . " 課程代號：" . $row["cid"] . "</p>";
            $sql = sprintf("SELECT * FROM course_timetable WHERE cid = %d ORDER BY timeid", $row["cid"]);
            $timetable = $db_link->query($sql);

            while($row_timetable = $timetable->fetch_assoc())
            {
                $time = $row_timetable["timeid"] % 14;

                if($time == 0) $time = 14;

                echo "<p>" . $week[$row_timetable["timeid"] / 14] . " 第" . $time . "節" . "</p>";
            }

            echo "<br>";
        }

        $db_link->close();
    }
    //else alert("Something wrong");

    function alert($message)
    {
        echo "<script type='text/javascript'>alert('$message'); window.location.href = '../home.php'; </script>";
        exit();
    }
?>