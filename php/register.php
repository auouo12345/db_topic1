<?php
    $db_link = require_once "connect.php";

    if(isset($_POST["register"]))
    {
        $account = $_POST["account"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $dept = $_POST["dept"];
        $grade = $_POST["grade"];
        $foreigner = $_POST["foreigner"];
        $credit = 0;
        $sql = sprintf("SELECT * FROM students WHERE sid = '%s'" , $account);
        $result = $db_link->query($sql);

        if($result->num_rows != 0) alert("學號已存在");

        $sql = sprintf("INSERT INTO students (sid , name , dept , grade , password , foreigner) VALUES ('%s' , '%s' , '%s' , %d , '%s' , %d)", $account , $name , $dept , $grade , $password , $foreigner);
        $db_link->query($sql);
        $sql = sprintf("SELECT * FROM course WHERE dept = '%s' AND grade = %d AND required = 1" , $dept , $grade);
        $result = $db_link->query($sql);

        while($row = $result->fetch_assoc())
        {
            $sql = sprintf("INSERT INTO course_selection (sid , cid , name) VALUES ('%s' , %d , '%s')" , $account , $row["cid"] , $row["name"]);
            $db_link->query($sql);
            $sql = sprintf("UPDATE course SET current_quantity = %d WHERE cid = %d" , $row["current_quantity"] + 1 , $row["cid"]);
            $db_link->query($sql);
            $credit += $row["credit"];
            $sql = sprintf("SELECT * FROM course_timetable WHERE cid = %d" , $row["cid"]);
            $timetable = $db_link->query($sql);

            while($period = $timetable->fetch_assoc())
            {
                $sql = sprintf("INSERT INTO student_timetable (sid , cid , timeid , name) VALUES ('%s' , %d , %d , '%s')" , $account , $row["cid"] , $period["timeid"] , $row["name"]);
                $db_link->query($sql);
            }
        }

        $sql = sprintf("UPDATE students SET credit = %d WHERE sid = '%s'" , $credit , $account);
        $db_link->query($sql);
        echo "<script type='text/javascript'>alert('註冊成功'); window.location.href = '../index.html'; </script>";
        exit();
    }

    function alert($message)
    {
        echo "<script type='text/javascript'>alert('$message'); window.location.href = '../register.html'; </script>";
        exit();
    }
