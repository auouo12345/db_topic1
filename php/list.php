<?php
session_start();
echo "<h1>" . "可選課程列表" . "</h1>";
echo "<p>" . "搜尋結果：" . "</p>";
$db_link = require_once "connect.php";

$sql = sprintf("SELECT * FROM students WHERE sid = '%s' AND foreigner = 1" , $_SESSION["account"]);
$result = $db_link->query($sql);

//可選課程條件 : 沒有在課表上的 只有自己科系的 人數未滿的 未衝堂的課程
if($result->num_rows == 0){           //不是外籍生
    $sql = sprintf("SELECT * FROM course WHERE 
                    cid NOT IN (SELECT cid FROM student_timetable WHERE sid = '%s')                  
                    AND
                    dept IN (SELECT dept FROM students WHERE sid = '%s')
                    AND
                    max_quantity > current_quantity
                    AND
                    cid NOT IN (SELECT cid FROM course_timetable WHERE timeid IN (SELECT timeid FROM student_timetable WHERE sid = '%s'))
                    " , $_SESSION["account"] , $_SESSION["account"] , $_SESSION["account"]);
}
else{            //是外籍生
    //echo "is foreigner" . "<br>";
    $sql = sprintf("SELECT * FROM course WHERE 
                    cid NOT IN (SELECT cid FROM student_timetable WHERE sid = '%s')                  
                    AND
                    dept IN (SELECT dept FROM students WHERE sid = '%s')
                    AND
                    max_quantity > current_quantity
                    AND
                    cid NOT IN (SELECT cid FROM course_timetable WHERE timeid IN (SELECT timeid FROM student_timetable WHERE sid = '%s') OR
                                                                        timeid IN ('11','12','13','14','25','26','27','28','39','40','41','42','53','54','55','56','67','68','69','70'))
                    
                    " , $_SESSION["account"] , $_SESSION["account"] , $_SESSION["account"]);
}


$result = $db_link->query($sql);

while($row = $result->fetch_assoc()){
    echo $row["name"] . " 課程代號 : " . $row["cid"] . " 授課老師 : " . $row["professor"];
    echo " 課程人數 : " . $row["current_quantity"] . "/" . $row["max_quantity"] . "<br>";
}
echo "<form action=\"../home.php\" method=\"post\"> 
            <input type=\"submit\" value=\"返回首頁\"]>
            </form>";

$db_link->close();
?>