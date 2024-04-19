<?php
$db_link = new mysqli("localhost", "root", "", "topic1");
$db_link->query("SET NAMES utf8");

if ($db_link->connect_error != "") die("ERROR: Could not connect. " . $db_link->connect_error);

return $db_link;
?>