<?php

include 'coreutils.php';
echo "test2";
//require_once ('./db_connect.php');

echo "test";
mysql_query("INSERT INTO users (name) VALUES ('Coinye')");
$userID = mysql_query("SELECT userid FROM users WHERE name = 'Coinye'");

//mysql_query("INSERT INTO users (name) VALUES ('Doge')");
//$userID = mysql_query("SELECT userid FROM users WHERE name = 'Doge'");
// var_dump(mysql_query("INSERT INTO users
// VALUES ('1000', 'Yuudachi', 13, 20, 100.50)"));
createGroup($userID, "Hash tag cash money", 100.00, "d300078@drdrb.com, d300077@drdrb.com");

// var_dump(mysql_query("INSERT INTO groups
// VALUES (13, 'Kantai Collection', 1000, 40000, 'kancolle')"));

// var_dump(mysql_query("INSERT INTO users
// VALUES ('1000', 'Yuudachi', 13, 20, 100.50)"));

?>