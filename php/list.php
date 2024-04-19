<?php
if(isset($_POST["list"]))
{
    session_start();
    echo "<h1>搜尋結果：</h1>";
    $db_link = include "connect.php";
    $week = array("星期一", "星期二", "星期三", "星期四", "星期五");

    $sql = sprintf("SELECT c.*, ct.timeid FROM course c
                    LEFT JOIN course_timetable ct ON c.cid = ct.cid
                    WHERE c.cid NOT IN (SELECT cid FROM student_timetable WHERE sid = '%s')
                    AND c.dept IN (SELECT dept FROM students WHERE sid = '%s')
                    AND c.max_quantity > c.current_quantity
                    AND c.cid NOT IN (SELECT cid FROM course_timetable WHERE timeid IN 
                                       (SELECT timeid FROM student_timetable WHERE sid = '%s') 
                                       OR timeid IN ('11','12','13','14','25','26','27','28',
                                                     '39','40','41','42','53','54','55','56',
                                                     '67','68','69','70'))
                    ORDER BY c.cid, ct.timeid", $_SESSION["account"], $_SESSION["account"], $_SESSION["account"]);

    $result = $db_link->query($sql);
    $prevCourseId = null;

    while($row = $result->fetch_assoc())
    {
        if($row["cid"] != $prevCourseId)
        {
            echo "<p><span style='font-size: 1.2em; color: #32a852;'>{$row["name"]}</span> 課程代號：{$row["cid"]}</p>";
            $prevCourseId = $row["cid"];
        }

        $day = $week[$row["timeid"] / 14];
        $section = $row["timeid"] % 14 ?: 14;
        $sectionText = $section == 14 ? "1-4" : $section; // Display 1-4 for section 14

        echo "<nobr>{$day} 第{$sectionText}節 </nobr>";
    }

    $db_link->close();
}
?>