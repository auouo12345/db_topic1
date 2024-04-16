<?php
    session_start();
    $db_link = require_once "connect.php";

    $restricted_timeids_for_foreigners = [11, 12, 13, 14, 25, 26, 27, 28, 39, 40, 41, 42, 53, 54, 55, 56, 67, 68, 69, 70];

    if(isset($_POST["addSelection"]))
    {
        $sql = sprintf("SELECT * FROM course WHERE cid = %d" , $_POST["cid"]);
        $result = $db_link->query($sql);

        if($result->num_rows == 0) alert("課程不存在");

        $sql = sprintf("SELECT * FROM students WHERE sid = '%s'" , $_SESSION["account"]);
        $studentInfo = $db_link->query($sql)->fetch_assoc();
        $courseInfo = $result->fetch_assoc();

        //(i) 同學只能加選本系的課程
        if($studentInfo["dept"] != $courseInfo["dept"]) alert("系所不一");

        //(ii) 外籍生 不能選晚上的課
        if ($studentInfo["foreigner"] == 1) {
            $sql = sprintf("SELECT * FROM course_timetable WHERE cid = %d AND timeid IN (%s)", $_POST["cid"], implode(',', $restricted_timeids_for_foreigners));
            $result = $db_link->query($sql);
            if ($result->num_rows > 0) alert("外籍生不能選晚上的課");
        }

        //(iv) 不可加選衝堂的課程；
        $sql = sprintf("SELECT * FROM student_timetable WHERE sid = '%s' AND timeid IN
                                (SELECT timeid FROM course_timetable WHERE cid = %d)" , $_SESSION["account"], $_POST["cid"]);
        $result = $db_link->query($sql);

        if($result->num_rows != 0) alert("課程衝堂");

        //(v) 不可加選與已選課程同名的課程；
        $sql = sprintf("SELECT * FROM course_selection WHERE sid = '%s' AND name = '%s'" , $_SESSION["account"], $courseInfo["name"]);
        $result = $db_link->query($sql);

        if($result->num_rows != 0) alert("不可加選與已選課程同名的課程");

        //(vi) 加選後學分不可超過最高學分限制 (30 學分)。
        if($studentInfo["credit"] + $courseInfo["credit"] > 30) alert("超過學分上限");

        //(iii) 人數已滿的課程不可加選；
        if($courseInfo["max_quantity"] <= $courseInfo["current_quantity"])
        {
            echo "<form id = 'attention' method='POST' action='attention.php'>
                    <input type='hidden' name='cid' value='" . $_POST["cid"] . "'>
                    <input type='hidden' name='attention'>
                  </form>";
            confirm();
        }


        $sql = sprintf("INSERT INTO course_selection (sid , cid , name )VALUES ('%s' , %d , '%s')" , $_SESSION["account"], $_POST["cid"], $courseInfo["name"]);
        $db_link->query($sql);
        $sql = sprintf("UPDATE course SET current_quantity = %d WHERE cid = %d" , $courseInfo["current_quantity"] + 1 , $_POST["cid"]);
        $db_link->query($sql);
        $sql = sprintf("UPDATE students SET credit = %d WHERE sid = '%s'" , $studentInfo["credit"] + $courseInfo["credit"] , $_SESSION["account"]);
        $db_link->query($sql);
        $sql = sprintf("SELECT * FROM course_timetable WHERE cid = %d" , $_POST["cid"]);
        $result = $db_link->query($sql);

        while($row = $result->fetch_assoc())
        {
            $sql = sprintf("INSERT INTO student_timetable (sid , cid , timeid , name) VALUES ('%s' , %d , %d , '%s')" , $_SESSION["account"] , $row["cid"] , $row["timeid"] , $courseInfo["name"]);
            $db_link->query($sql);
        }

        alert("加選成功");
    }
    else alert("Something wrong");

    $db_link->close();

    function alert($message)
    {
        echo "<script type='text/javascript'>alert('$message'); window.location.href = '../home.php';</script>";
        exit();
    }

    function confirm()
    {
        echo "<script>
                if(confirm('人數已滿，是否要關注該課程？(該課程有人退選時，抽取一名關注的學生加選)') === true)
                {    
                    document.getElementById('attention').submit();
                }
                else window.location.href = '../home.php';
              </script>";
        exit();
    }
?>
