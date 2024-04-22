<?php
if (isset($_POST["search"]) && $_POST["pattern"] != "") {
    echo "<h1>" . "課程搜尋" . "</h1>";
    echo "<p>" . "搜尋結果：" . "</p>";
    $db_link = include "connect.php";
    $week = array("星期一", "星期二", "星期三", "星期四", "星期五");

    //--依關鍵字搜尋課程，儲存結果
    $sql = sprintf("SELECT * FROM course WHERE name LIKE '%%%s%%' ORDER BY cid", $_POST["pattern"]);
    $result = $db_link->query($sql);
    //--

    //--無搜尋結果輸出
    if ($result->num_rows == 0) echo "<p><span style='font-size: 1.2em; color: red;'>無搜尋結果</span></p>";
    //--

    while ($row = $result->fetch_assoc()) {
        //--處理搜尋結果，照格式輸出
        echo "<p><span style='font-size: 1.2em; color: #32a852;'>{$row["name"]}</span> {$row["dept"]}系{$row["grade"]}年級 目前人數 / 最大人數：{$row["current_quantity"]} / {$row["max_quantity"]}</p>";
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