<?php
//--屍體部分
//    //關注列表
//    session_start();
//    echo "<h1>" . "關注課程列表" . "</h1>";
//    echo "<p>" . "搜尋結果：" . "</p>";
//    $db_link = require_once "connect.php";
//
//    $sql = sprintf("SELECT * FROM course WHERE cid IN (SELECT cid FROM attention_table WHERE sid = '%s')" , $_SESSION["account"]);
//    $result = $db_link->query($sql);
//
//    while($row = $result->fetch_assoc()){
//        echo $row["name"] . " 課程代號 : " . $row["cid"] . " 授課老師 : " . $row["professor"];
//        echo " 課程人數 : " . $row["current_quantity"] . "/" . $row["max_quantity"];
//        echo "<form action=\"cancle.php\" method=\"post\">
//                <input type=\"hidden\" name=\"cid\" value=\"{$row["cid"]}\">
//                <input type=\"submit\" value=\"取消關注\"]>
//                </form>";
//        echo "<br>";
//    }
//    echo "<form action=\"../home.php\" method=\"post\">
//            <input type=\"submit\" value=\"返回首頁\"]>
//            </form>";
//
//    $db_link->close();
//--

session_start();
$db_link = require_once "connect.php";

if (isset($_POST["attention"])) {
    //--整理課程與學生資訊
    $sql = sprintf("SELECT * FROM course WHERE cid = %d", $_POST["cid"]);
    $courseInfo = $db_link->query($sql)->fetch_assoc();
    $sql = sprintf("SELECT * FROM students WHERE sid = '%s'", $_SESSION["account"]);
    $studentInfo = $db_link->query($sql)->fetch_assoc();
    //--

    //--插入selection、更新學生已選學分
    $sql = sprintf("INSERT INTO course_selection (sid , cid , name , attention)VALUES ('%s' , %d , '%s' , 1)", $_SESSION["account"], $_POST["cid"], $courseInfo["name"]);
    $db_link->query($sql);
    $sql = sprintf("UPDATE students SET credit = %d WHERE sid = '%s'", $studentInfo["credit"] + $courseInfo["credit"], $_SESSION["account"]);
    $db_link->query($sql);
    $_SESSION["credit"] += $courseInfo["credit"];
    //--

    //--更新課表
    $sql = sprintf("SELECT * FROM course_timetable WHERE cid = %d", $_POST["cid"]);
    $result = $db_link->query($sql);

    while ($row = $result->fetch_assoc()) {
        $sql = sprintf("INSERT INTO student_timetable (sid , cid , timeid , name , attention) VALUES ('%s' , %d , %d , '%s' , 1)", $_SESSION["account"], $row["cid"], $row["timeid"], $courseInfo["name"]);
        $db_link->query($sql);
    }
    //--

    alert("關注成功");
} else alert("Something wrong");

$db_link->close();

function alert($message) {
    echo "<script type='text/javascript'>alert('$message'); window.location.href = '../home.php';</script>";
    exit();
}
?>