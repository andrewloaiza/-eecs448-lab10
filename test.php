<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

$servername = "mysql.eecs.ku.edu";
$username = "a358l152";
$password = "phe7te4E";

/* create connection */
$mysqli = new mysqli($servername, $username, $password);

/* check connection */
if ($mysqli->connect_errno) {
  printf("Connect failed: %s\n", $mysqli->connect_error);
  exit();
}
echo "Connected successfully";

/* close connection */
$mysqli->close();

?>
