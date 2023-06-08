<?php
$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "EndProject";


$mysqli = new mysqli($db_server, $db_username, $db_password, $db_name);
if ($mysqli->connect_errno) {
    throw new RuntimeException('mysqli connection error: ' . $mysqli->connect_error);
}

/* Set the desired charset after establishing a connection */
$mysqli->set_charset('utf8');
if ($mysqli->errno) {
    throw new RuntimeException('mysqli error: ' . $mysqli->error);
}

$mysqli->close();
?>