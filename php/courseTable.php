<?php
$db_link = require_once "connect.php";

//--從課表table找尋該學生課表
$sql = sprintf("SELECT * FROM student_timetable WHERE sid = '%s'", $_SESSION["account"]);
$result = $db_link->query($sql);
//--

//--重置課表顏色
for ($i = 1; $i <= 70; $i++) {
    $script = sprintf("<script>document.getElementById('%d').style = 'background-color:white'</script>", $i);
    echo $script;
}
//--

//--輸出課表
while ($row = $result->fetch_assoc()) {
    //--依照是否關注更改課表顏色
    if ($row["attention"] == 0) $script = sprintf("<script>document.getElementById('%d').style = 'background-color:#CEFFCE'</script>", $row["timeid"]);
    else $script = sprintf("<script>document.getElementById('%d').style = 'background-color:#FFE66F'</script>", $row["timeid"]);

    echo $script;
    //--

    //--輸出課表資訊
    $script = sprintf("<script>document.getElementById('%d').innerHTML = '%s<br/>%s';</script>", $row["timeid"], $row["name"], $row["cid"]);
    echo $script;
    //--
}
//--

$db_link->close();
?>