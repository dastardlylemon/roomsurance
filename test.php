<?php
echo "test2";
require_once ('./db_connect.php');
var_dump ($con);

echo "test";

mysql_query($con,"INSERT INTO groups
VALUES (13, 'Kantai Collection',1000, 40000, 'kancolle')");

mysql_query($con,"INSERT INTO users
VALUES ('1000', 'Yuudachi', 13, 20, 100.50)");

mysql_close($con);

?>