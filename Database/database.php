<?php

include_once("../db_connect.php");
// Connection to db
$con = mysqli_connect($server, $username, $password, $db);
if (mysqli_connect_errno())
	echo "Failed to connect to MySQL: " . mysqli_connect_error();

// Create database
$sql = "CREATE DATABASE roomsurance";
if (mysqli_query ($con, $sql))
	echo "Database roomsurance created successfully";
else
	echo "Error creating database: " . mysqli_error($con);

// Create user table
$users = "CREATE TABLE users (
userid varchar(200) NOT NULL,
name varchar(30) NOT NULL,
group INT,
points INT,
PRIMARY KEY (userid),
FOREIGN KEY (group) REFERENCES group(groupid),
UNIQUE (userid)
)";
if (mysqli_query($con, $users))
	echo "Table users created successfully";
else
	echo "Error creating table: " . mysqli_error($con);

// Create group table
$groups = "CREATE TABLE groups (
groupid INT NOT NULL AUTO_INCREMENT,
group_name varchar(30) NOT NULL,
total_points INT,
pass varchar(30) NOT NULL,
PRIMARY KEY (groupid),
UNIQUE (groupid),
UNIQUE (pass)
)";
if (mysqli_query($con, $groups))
	echo "Table groups created successfully";
else
	echo "Error creating table: " . mysqli_error($con);

//Create chore table
$chores = "CREATE TABLE chores (
choreid INT NOT NULL AUTO_INCREMENT,
chore_name varchar(30) NOT NULL,
chore_descrip varchar(200),
diffi INT,
time INT,
sug_points INT,
act_point INT NOT NULL,
due_date DATE,
group INT,
user varchar(200),
PRIMARY KEY (choreid),
FOREIGN KEY (group) REFERENCES group(groupid),
FOREIGN KEY (user) REFERENCES user(userid),
UNIQUE (choreid)
)";
if (mysqli_query($con, $chores))
	echo "Table chores created successfully";
else
	echo "Error creating table: " , mysqli_error($con);
?>