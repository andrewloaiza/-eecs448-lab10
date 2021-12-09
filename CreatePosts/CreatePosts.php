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


/* add post to DB */

// obtain username and post
$username = $_POST["username"];
$post     = $_POST["post"];

// query to get usernames from Users table
$addPost = "INSERT INTO Posts (author_id, content) VALUES ('".addslashes($username)."', '".addslashes($post)."')";

// check if query was successful
if (!$dbc->query($addPost))
{
  echo "<h2>Unseccessful post</h2>

        <p>The username <b>".$username."</b> does not exist.<br>
        [INSERT failed: (Error #".$dbc->errno.") " . $dbc->error . "]</p>

        <p>Click <a href='../CreateUser/CreateUser.html'>here</a>to create an account.</p>

        <p>If you entered the username incorrectly,
        <a href='CreatePosts.html'> try again.</a></p>

        <a href='../index.html'>Main Menu</a>";

  die();
}

echo "<h2>Seccessfully created post</h2>

      Your post is now online <b>".$username."!</b> Feel free to create another post.<br><br>
      <a href='../index.html'>Menu</a> <br><br>
      <a href='CreatePosts.html'>Create Post</a> <br>";

/* close connection */
$dbc->close();

?>
