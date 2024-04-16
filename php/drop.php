<?php
    session_start();
    $db_link = require_once 'connect.php';

    if(isset($_POST['drop']))
    {
        $sql = sprintf("SELECT * FROM course WHERE cid = %d" , $_POST["cid"]);
        $result = $db_link->query($sql);

        if($result->num_rows == 0) alert("課程不存在");

        $sql = sprintf("SELECT * FROM students WHERE sid = '%s'" , $_SESSION["account"]);
        $studentInfo = $db_link->query($sql)->fetch_assoc();
        $courseInfo = $result->fetch_assoc();

        $sql = sprintf("SELECT * FROM course_selection WHERE sid = '%s' AND cid = %d" , $_SESSION["account"], $_POST["cid"]);
        $result = $db_link->query($sql);

        if($result->num_rows == 0) alert("未加選此課程");

        //(i) 退選後學分不可低於最低學分限制 (9 學分)；
        //if($studentInfo["credit"] - $courseInfo["credit"] < 9) alert("退選後學分不可低於最低學分限制 (9 學分)");
        $sql = sprintf("DELETE FROM course_selection WHERE sid = '%s' AND cid = %d" , $_SESSION["account"] , $_POST["cid"]);
        $db_link->query($sql);
        $sql = sprintf("DELETE FROM student_timetable WHERE sid = '%s' AND cid = %d" , $_SESSION["account"] , $_POST["cid"]);
        $db_link->query($sql);
        $sql = sprintf("UPDATE students SET credit = %d WHERE sid = '%s'" , $studentInfo["credit"] - $courseInfo["credit"] , $_SESSION["account"]);
        $db_link->query($sql);
        if($result->fetch_assoc()["attention"] == 0)
        {
            $sql = sprintf("UPDATE course SET current_quantity = %d WHERE cid = %d" , $courseInfo["current_quantity"] - 1 , $_POST["cid"]);
            $db_link->query($sql);
            //處理關注
            $sql = sprintf("SELECT * FROM course_selection WHERE cid = %d AND attention = 1", $_POST["cid"]);
            $result = $db_link->query($sql);

            if ($result->num_rows != 0)
            {
                $randNum = rand(1, $result->num_rows);

                for ($i = 0; $i < $randNum; $i++) $row = $result->fetch_assoc();

                $sql = sprintf("UPDATE course SET current_quantity = %d WHERE cid = %d", $courseInfo["current_quantity"] , $_POST["cid"]);
                $db_link->query($sql);
                $sql = sprintf("UPDATE course_selection SET attention = 0 WHERE sid = '%s' AND cid = %d", $row["sid"], $_POST["cid"]);
                $db_link->query($sql);
                $sql = sprintf("UPDATE student_timetable SET attention = 0 WHERE sid = '%s' AND cid = %d", $row["sid"], $_POST["cid"]);
                $db_link->query($sql);
            }
        }

        /*
        //如果至少有一人關注要退選的課程
        $sql = sprintf("SELECT * FROM attention_table WHERE cid = %d" , $_POST["cid"]);
        $result = $db_link->query($sql);
        if($result->num_rows != 0){
            //隨機選一個排隊的人的資料
            $sql = sprintf("SELECT * FROM attention_table WHERE cid = %d ORDER BY RAND() LIMIT 1" , $_POST["cid"]);
            $person_result = $db_link->query($sql);

            //判斷這個人是否有資格

            if($person_result && $person_result->num_rows > 0){
                $person = $person_result->fetch_assoc();
                //選中的人從隊伍裡刪除
                $sql = sprintf("DELETE FROM attention_table WHERE sid = %d AND cid = %d", $person["sid"] , $person["cid"]);
                $db_link->query($sql);
            }
            else{
                alert("something wrong");
            }

            

            //幫選中的人新增課表
            $sql = sprintf("SELECT * FROM course_timetable WHERE cid = %d" , $_POST["cid"]);
            $result = $db_link->query($sql);

            while($row = $result->fetch_assoc())
            {
                $sql = sprintf("INSERT INTO student_timetable VALUES ('%s' , %d , %d , '%s')" , $person["sid"] , $row["cid"] , $row["timeid"] , $courseInfo["name"]);
                $db_link->query($sql);
            }

            //更新學分與人數
            
        }
        */

        if($courseInfo["required"] == 1) alert("退選成功，注意：此課程為必修課");
        else alert("退選成功");
    }

    $db_link->close();

    function alert($message)
    {
        echo "<script type='text/javascript'>alert('$message'); window.location.href = '../home.php';</script>";
        exit();
    }