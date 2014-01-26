<?php

function createChore($choreName, $pointValue, $groupID, $userID = "", $chore_description = "", $diffi = 0, $timer = 0,
						$due_Date)
{
	$due_Date = date("Y-m-d");
	$newChore = "INSERT INTO chores (chore_name, chore_descrip, difficulty, length, act_points, due_date, taskgroup, taskuser, completed) VALUES ('" . $choreName . "', '" . $chore_description . "', " . $diffi . ", " . $pointValue . ", " . $timer . ", " . $due_Date . ", '" . $userID . "', 0)";
	if (mysql_query($newChore))
		echo "Successfully created chore " . $choreName;
	else
		echo "Chore could not be created because " . mysql_error($db);
}

// Should link to variables in HTML initialized to defaults for now
$choredate = date("Y-m-d");
$groupID = 0;
$choreName = "";
$choreDescrip = "";
$chorediff = 1;
$chorelen = 0;
$sugPoints = 1000;
$choreUser = "";
$userID = "";

createChore($choreName, $sugPoints, $groupID, $userID, $choreDescrip, $chorediff, $chorelen, $choredate);

?>