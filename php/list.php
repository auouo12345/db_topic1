<?php
//--屍體部分
//session_start();
//echo "<h1>" . "可選課程列表" . "</h1>";
//echo "<p>" . "搜尋結果：" . "</p>";
//$db_link = require_once "connect.php";
//
//$sql = sprintf("SELECT * FROM students WHERE sid = '%s' AND foreigner = 1" , $_SESSION["account"]);
//$result = $db_link->query($sql);
//
////可選課程條件 : 沒有在課表上的 只有自己科系的 人數未滿的 未衝堂的課程
//if($result->num_rows == 0){           //不是外籍生
//    $sql = sprintf("SELECT * FROM course WHERE
//                    cid NOT IN (SELECT cid FROM student_timetable WHERE sid = '%s')
//                    AND
//                    dept IN (SELECT dept FROM students WHERE sid = '%s')
//                    AND
//                    max_quantity > current_quantity
//                    AND
//                    cid NOT IN (SELECT cid FROM course_timetable WHERE timeid IN (SELECT timeid FROM student_timetable WHERE sid = '%s'))
//                    " , $_SESSION["account"] , $_SESSION["account"] , $_SESSION["account"]);
//}
//else{            //是外籍生
//    //echo "is foreigner" . "<br>";
//    $sql = sprintf("SELECT * FROM course WHERE
//                    cid NOT IN (SELECT cid FROM student_timetable WHERE sid = '%s')
//                    AND
//                    dept IN (SELECT dept FROM students WHERE sid = '%s')
//                    AND
//                    max_quantity > current_quantity
//                    AND
//                    cid NOT IN (SELECT cid FROM course_timetable WHERE timeid IN (SELECT timeid FROM student_timetable WHERE sid = '%s') OR
//                                                                        timeid IN ('11','12','13','14','25','26','27','28','39','40','41','42','53','54','55','56','67','68','69','70'))
//
//                    " , $_SESSION["account"] , $_SESSION["account"] , $_SESSION["account"]);
//}
//
//
//$result = $db_link->query($sql);
//
//while($row = $result->fetch_assoc()){
//    echo $row["name"] . " 課程代號 : " . $row["cid"] . " 授課老師 : " . $row["professor"];
//    echo " 課程人數 : " . $row["current_quantity"] . "/" . $row["max_quantity"] . "<br>";
//}
//echo "<form action=\"../home.php\" method=\"post\">
//            <input type=\"submit\" value=\"返回首頁\">
//            </form>";
//
//$db_link->close();
//--

if (isset($_POST["list"])) {
    session_start();
    echo "<h1>" . "課程搜尋" . "</h1>";
    echo "<p>" . "搜尋結果：" . "</p>";
    $db_link = include "connect.php";
    $week = array("星期一", "星期二", "星期三", "星期四", "星期五");
    //--整理學生資訊
    $sql = sprintf("SELECT * FROM students WHERE sid = '%s'", $_SESSION["account"]);
    $studentInfo = $db_link->query($sql)->fetch_assoc();
    //--

    if ($studentInfo["foreigner"] == 1) {
        //--外籍生可選課程清單
        $sql = sprintf("SELECT * FROM course WHERE 
                                    cid NOT IN (SELECT cid FROM student_timetable WHERE sid = '%s')                  
                                    AND
                                    dept IN (SELECT dept FROM students WHERE sid = '%s')
                                    AND
                                    max_quantity > current_quantity
                                    AND
                                    cid NOT IN (SELECT cid FROM course_timetable WHERE timeid IN (SELECT timeid FROM student_timetable WHERE sid = '%s') 
                                                OR
                                                timeid IN ('11','12','13','14','25','26','27','28','39','40','41','42','53','54','55','56','67','68','69','70'))"
            , $_SESSION["account"], $_SESSION["account"], $_SESSION["account"]);
        //--
    } else {
        //--非外籍生可選課程清單
        $sql = sprintf("SELECT * FROM course WHERE
                                cid NOT IN (SELECT cid FROM student_timetable WHERE sid = '%s')
                                AND
                                dept IN (SELECT dept FROM students WHERE sid = '%s')
                                AND
                                max_quantity > current_quantity
                                AND
                                cid NOT IN (SELECT cid FROM course_timetable WHERE timeid IN (SELECT timeid FROM student_timetable WHERE sid = '%s'))"
            , $_SESSION["account"], $_SESSION["account"], $_SESSION["account"]);
        //--
    }

    //--執行sql指令，儲存結果
    $result = $db_link->query($sql);
    //--

    //--無搜尋結果輸出
    if ($result->num_rows == 0) echo "<p><span style='font-size: 1.2em; color: red;'>無搜尋結果</span></p>";
    //--

    while ($row = $result->fetch_assoc()) {
        //--處理搜尋結果，照格式輸出
        echo "<p><span style='font-size: 1.2em; color: #32a852;'>{$row["name"]}</span> {$row["dept"]}系 {$row["grade"]}年級 目前人數 / 最大人數：{$row["current_quantity"]} / {$row["max_quantity"]}</p>";
        echo "<p>課程代號：{$row["cid"]}";
        $sql = sprintf("SELECT * FROM course_timetable WHERE cid = %d ORDER BY timeid", $row["cid"]);
        $timetable = $db_link->query($sql);
        $count = 0;
        $preDay = null;

        while ($row_timetable = $timetable->fetch_assoc()) {
            if ($count == 0 && $preDay != $week[$row_timetable["timeid"] / 14]) echo "<p>{$week[$row_timetable["timeid"] / 14]} 第 ";
            else if ($preDay != $week[$row_timetable["timeid"] / 14]) echo " 節</p><p>{$week[$row_timetable["timeid"] / 14]} 第 ";
            else echo " , ";

            $preDay = $week[$row_timetable["timeid"] / 14];
            $time = $row_timetable["timeid"] % 14 ?: 14;
            echo $time;
            $count++;
        }

        echo " 節</p>";
        //--
    }

    $db_link->close();
}
?>