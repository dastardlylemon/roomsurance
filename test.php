<?php

echo "test3\n";
include 'groups.php';
echo "test2\n";
//require_once ('./db_connect.php');

echo "test";

$getUserID = mysql_query("INSERT INTO users (name) VALUES ('Coinye')");
$userID = mysql_fetch_assoc($getUserID);
$userID = $userID['userid'];

//mysql_query("INSERT INTO users (name) VALUES ('Doge')");
//$userID = mysql_query("SELECT userid FROM users WHERE name = 'Doge'");
// var_dump(mysql_query("INSERT INTO users
// VALUES ('1000', 'Yuudachi', 13, 20, 100.50)"));
createGroup($userID, "Hash tag cache monet", 100.00, "d301334@drdrb.com");

// var_dump(mysql_query("INSERT INTO groups
// VALUES (13, 'Kantai Collection', 1000, 40000, 'kancolle')"));

// var_dump(mysql_query("INSERT INTO users
// VALUES ('1000', 'Yuudachi', 13, 20, 100.50)"));

?>