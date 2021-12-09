<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* create connection */

// server and login info
$db_servername = "mysql.eecs.ku.edu";
$db_username = "a358l152";
$db_password = "phe7te4E";

// create connection
$dbc = new mysqli($db_servername, $db_username, $db_password);
$db  = $db_username;

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_STRICT);
error_reporting(E_ERROR);

// check connection
if ($dbc->connect_error)
{
  die("Connection failed: " . $conn->connect_error);
}

// connect to database
if (!mysqli_select_db($dbc, $db))
{
    die("Uh oh, couldn't select database $db");
}


/* add user to DB */

// username chosen by user
$username = $_POST["username"];

// query to get usernames from Users table
$addUser = "INSERT INTO Users (user_id) VALUES ('".addslashes($username)."')";

// check if query was successful
if (!$dbc->query($addUser))
{
  echo "<h2>Could not create account</h2>
        <p>It looks like <b>".$username."</b> is taken, try a different username.<br>
        [INSERT failed: (Error #".$dbc->errno.") " . $dbc->error . "]<p>
        <a href='CreateUser.html'>Try again</a> <br><br>
        <a href='../index.html'>Main Menu</a>";
  die();
}

echo "<h2>Account successful</h2>

      <p>Successfully added <b>".$username."</b> as a user! Feel free to create a post.</p>
      <a href='../index.html'>Menu</a> <br>
      <a href='../CreatePosts/CreatePosts.html'>Create Post</a> <br>";

/* close connection */
$dbc->close();

?>
