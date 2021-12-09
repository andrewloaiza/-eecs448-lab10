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


/* query and display all users */
$users = "SELECT user_id FROM Users";

// check if query failed
if (!$dbc->query($users))
{
  echo "<h1>Error loading data</h1>

        <p>There was an error loading the users from the database.<br>
        [INSERT failed: (Error #".$dbc->errno.") " . $dbc->error . "]</p>

        <a href='../AdminHome.html'>Admin Home</a><br><br>
        <a href='../../index.html'>Main Menu</a>";
  die();
}

// save query result in variable
if ($result = $dbc->query($users))
{
  // if table is non-empty
  if (mysqli_num_rows($result) > 0)
  {
    echo "<h1>List of all users in Users Table</h1>";
    echo "<table border=\"1\">";
    echo "<tr><th>user_id</th></tr>";

    while ($row = $result->fetch_assoc())
    {
      echo "<tr><td>".$row['user_id']."</td></tr>";
    }

    echo "</table><br>";

    echo "<a href='../AdminHome.html'>Admin Home</a><br><br>
          <a href='../../index.html'>Main Menu</a>";
  }

  else
  {
    echo "<h1>Error loading data</h1>
          <p>There are no users to display.</p>
          <p>Click <a href='../../CreateUser/CreateUser.html'>here</a> to create an account.</p>
          <a href='../../index.html'>Main Menu</a>";
    die();
  }
}

?>
