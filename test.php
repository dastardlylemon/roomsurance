<?php
echo "test2";
require_once ('./db_connect.php');
$con = mysqli_connect($server, $username, $password, $db);
echo "test";
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

mysqli_query($con,"INSERT INTO groups
VALUES (13, 'Kantai Collection',1000, 40000, 'kancolle')");

mysqli_query($con,"INSERT INTO users
VALUES ('1000', 'Yuudachi', 13, 20, 100.50)");

mysqli_close($con);

?>