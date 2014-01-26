<?php
require_once("./db_connect.php");
  
$newUser = "INSERT INTO users (userid, name) VALUES ('" . $_POST['userID'] . "', '" . $_POST['userName'] . "')";
if (mysql_query($newUser))
  return $_POST['userName'];
else
  return false;
?>
