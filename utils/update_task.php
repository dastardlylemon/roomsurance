<?php
require_once ('./db_connect.php');

function updateTask($taskID, $taskName, $taskDesc, $diff, $len, $points, $due, $userID, $comp)
{
	$updateChores = "UPDATE chores SET chore_name = '" . $taskName . "', chore_descrip = '" . $taskDesc . "', difficulty = " . $diff . ", length = " . $len . ", act_points = " . $points . ", " . ". due_date = " . $today . ", taskuser = '" . $userID . "', completed = " . $comp . "WHERE choreid = " . $taskID;
	$result = mysql_query($updateChores);
}

// Should link to variables in HTML initialized to defaults for now
$choredate = date("Y-m-d");
$taskID = 0;
$choreName = "";
$choreDescrip = "";
$chorediff = 1;
$chorepoints = 1;
$choreUser = "";
$chorelen = 0;
$check = 0; // If 0, then unchecked. If 1, then checked
$findChores = "SELECT * FROM chores WHERE choreid = " . $taskID;
$result = mysql_query($findChores);

// 
$row = mysql_fetch_assoc($result))
if ($choreName != $row['chore_name']) $choreName = $row['chore_name'];
if ($choreDescr != $row['chore_descrip']) $choreDescr = $row['chore_descrip'];
if ($chorediff != $row['difficulty']) $chorediff = $row['difficulty'];
if ($chorelen != $row['length']) $chorelen = $row['length'];
if ($chorepoints != $row['act_points']) $chorepoints = $row['act_points'];
if ($choredate != $row['due_date']} $choredate = $row['due_date'];
if ($choreUser != $row['taskuser']) $choreUser = $row['taskuser'];
if ($check != $row['completed']) $check = $row['completed'];

updateTask($taskID, $choreName, $choreDescr, $chorediff, $chorelen, $chorepoints, $chorepoints, $choredate, $choreUser, $check);
?>
