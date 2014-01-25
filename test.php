<?php
echo "test2";
require_once ('./db_connect.php');

echo "test";

var_dump(mysql_query("INSERT INTO groups
VALUES (13, 'Kantai Collection', 1000, 40000, 'kancolle')"));

var_dump(mysql_query("INSERT INTO users
VALUES ('1000', 'Yuudachi', 13, 20, 100.50)"));

mysql_close($con);

?>