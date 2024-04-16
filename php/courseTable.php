<?php
    $db_link = require_once "connect.php";
    $sql = sprintf("SELECT * FROM student_timetable WHERE sid = '%s'" , $_SESSION["account"]);
    $result = $db_link->query($sql);

    for($i = 1 ; $i <= 70 ; $i++)
    {
        $script = sprintf("<script>document.getElementById('%d').style = 'background-color:white'</script>" , $i);
        echo $script;
    }

    while ($row = $result->fetch_assoc())
    {
        if($row["attention"] == 0) $script = sprintf("<script>document.getElementById('%d').style = 'background-color:green'</script>" , $row["timeid"]);
        else $script = sprintf("<script>document.getElementById('%d').style = 'background-color:orange'</script>" , $row["timeid"]);
        echo $script;
        $script = sprintf("<script>document.getElementById('%d').innerHTML = '%s<br/>%s';</script>" , $row["timeid"] , $row["name"] , $row["cid"] );
        echo $script;
    }

    $db_link->close();
?>
