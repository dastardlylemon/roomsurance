<?php
require_once ('./db_connect.php');

function explodeString($rawGroupString, &$groups) {
	$groups = explode(",", $rawGroupString);
}

function removeSpaces($rawString)
{
	str_replace(" ", "", $rawString);
}

function sendEntryMail($emailString, $groupID)	//sends an entry email to everyone in the string
{
	$emailString = removeSpaces($emailString);
	$emails = array();
	explodeString($emailString, $emails); //emails now contains an array of tbe emails to be sent out.

	$getGroupPW = "SELECT pass FROM groups WHERE groupid = " . $groupID;
	$groupPW = mysql_query($getGroupPW);
	settype($groupPW, "string");

	for ($i = 0; $i < count($emails); $i++)
	{
		mail($emails[$i], "You've been invited to Roomsurance!", "Hello! \n You've been invited to Roomsurance!  This means one of your roommates has invited you to this chore management service.  Your password is: \n \n " . $groupPW . " \n \n Visit our website, and when prompted, please input the password above. If you believe you've received this email in error, kindly ignore this message.  \n Thanks, \n Roomsurance Staff ", "From: webmaster@Roomsurance.com");
	} //should work, theoretically.
}

// Input user's ID and name from Facebook
function createUser($userID, $userName)
{
	$newUser = "INSERT INTO users (userid, name) VALUES ('" . $userID . "', '" . $userName . "')";
	if (mysql_query($newUser))
		echo "Successfully created user " . $userName;
	else
		echo "User could not be created because " . mysql_error($db);
}

// Input user id to check if user already exists
function checkUser($userID)
{
	$getUser = "SELECT * FROM users WHERE userid = '" . $userID;
	if (!mysql_query($getUser))
		return true;
	else
		return false;
}

function getGroup($userID)
{
	$getGroup = "SELECT usergroup FROM users WHERE userid = '" . $userID;
	$newGroupID = mysql_query($getGroup);
	if (!$newGroupID)
		return 0;
	else
	{
		$groupID = mysql_fetch_assoc($newGroupID);
		$groupID = $groupID['groupid'];
		return $groupID;
	}
}

// To create a group, input the userID, desired group name, starting money of each person, and the list of group members you want to email
function createGroup($userID, $groupName, $cashPerPerson, $listEmails)
{
	$newGroup = "INSERT INTO groups (group_name, cash_per) VALUES ('" . $groupName . "', " . $cashPerPerson . ")";
	if (mysql_query($newGroup))
		echo "Successfully created group " . $groupName;
	else
		echo "Group could not be created because " . mysql_error($db);
	$getGroupID = "SELECT groupid FROM groups WHERE group_name = '" . $groupName . "' LIMIt 1";
	$newGroupID = mysql_query($getGroupID);
	$groupID = mysql_fetch_assoc($newGroupID);
	$groupID = $groupID['groupid'];
	$groupPW = generatePassword();

	$setGroupPW = "UPDATE groups SET pass = '" . $groupPW . "' WHERE groupid = " . $groupID;
	echo $setGroupPW;
	if (mysql_query($setGroupPW))
		echo "Successfully created password";
	else
		echo "Could not create password";
	$setGroupID = "UPDATE users SET usergroup = " . $groupID . " WHERE userid = '" . $userID ."'";
	echo $setGroupID;
	
	if (mysql_query($setGroupID))
		echo "Successfully joined group " . $groupName;
	else
		echo "Error joining the group: " . mysql_error($db);
	$putCash = "UPDATE users SET cash = " . $cashPerPerson . " AND points = 1000 WHERE userid = '" . $userID . "'";
	if (mysql_query($putCash))
		echo "You now have $" . $cashPerPerson;
	else
		echo "Could not add cash";
	sendEntryMail($listEmails, $groupID);
}

// To join a group, input your user id, and the unique password you were emailed
function joinGroup($userID, $groupPW)
{
	$findGroup = "SELECT groupid FROM groups WHERE pass = '" . $groupPW . "' LIMIT 1";
	$getGroupID = mysql_query($findGroup);
	$groupID = mysql_fetch_assoc($getGroupID);
	$groupID = $groupID['groupid'];
	if (!$getgroup) echo "Could not find group with pass";
	$findUser = "UPDATE users SET usergroup = " . $getGroupID . " WHERE userid = '" . $userID . "'";
	if (mysql_query($findUser))
		echo "Successfully joined group";
	else
		echo "Error joining the group: " . mysql_error($db);
	$getCash = "SELECT cash_per FROM groups WHERE groupid = " . $getGroupID;
	$getCashVal = mysql_query($getCash);
	$cashVal = mysql_fetch_assoc($getCashVal);
	$cashVal = $cashVal['cashval'];
	$putCash = "UPDATE users SET cash = " . $cashVal . " AND points = 1000 WHERE userid = '" . $userID . "'";
	if (mysql_query($putCash))
		echo "You now have $" . $cashVal;
	else
		echo "Could not add cash";
	calculateTotalPoints($getGroupID);
}

function removeGroup($groupID)
{
	$removeChores = "DELETE FROM chores WHERE taskgroup = " . $groupID;
	$delete = mysql_query($removeChores);
	$updateGroup = "UPDATE users SET usergroup = '' WHERE usergroup = " . $groupID;
	$didItWork = mysqli_query("DELETE FROM groups WHERE groupid = " . $groupID);
	if($didItWork)
		echo "Group Deleted.  Come back next time!";
	else
		echo "Something went wrong! Please try again in a couple of minutes";
}

function createChore($choreName, $pointValue, $groupID, $userID = "0", $chore_description = "", $diffi = 0, $timer = 0, $sugPoints = 0,
						$due_Date, $complete)
{
	$due_Date = date("Y-m-d");
	$newChore = "INSERT INTO chores (chore_name, chore_descrip, difficulty, length, sug_points, act_points, due_date, taskgroup, taskuser, completed) VALUES ('" . $choreName . "', '" . $chore_description . "', " . $diffi . ", " . $timer . ", " . $sugPoints . ", " . $due_Date . ", '" . $userID . "', 0)";
	if (mysql_query($newChore))
		echo "Successfully created chore " . $choreName;
	else
		echo "Chore could not be created because " . mysql_error($db);
}

function generateUniqueGroupID()
{
for($i = 0; $i < 100; $i++)
{
	$groupID = rand();
	$findGroupID = "SELECT groupid FROM groups WHERE groupID = " . $groupID;
		$result = mysql_query($findGroupID);
			if(mysql_num_rows($result) == 0) {
					return $groupID;
				}
}
	echo "it's boned";
	return -1;
}

//difficultyVal should be between 0 and 10; $timeVal should be time taken in minutes
function suggestedPrice($difficultyVal, $timeVal, $initialPoints)
{
	$modifier = $difficultyVal*$timeVal;
	$modifier = $modifier/600;				//Makes it sufficiently small (10*60) so that it will be a smaller portion of the initialpoints
	$sugPrice = ceil($modifier*$initialPoints/10);	//initial poitns should be somewhere ~1000, makes sugPrice ~20 for mediocre jobs
	return $sugPrice;
}

function calculateEndValue($totalPoints, $userPoints, $totalGroupCash)
{
	$ratio = $userPoints/$totalPoints;
	return $totalCash*$ratio;
}

function calculateTotalPoints($groupID)
{
	$sqlCall = "SELECT * FROM users WHERE groupid = " . $groupID;
	$result = mysql_query($sqlCall);
	$points = 0;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		$points = $points + $row['points'];
	$sqlPut = "UPDATE groups SET total_points = " . $points . " WHERE groupid = " . $groupID;
	return $points;
}

//contains 170 random words

function generatePassword()
{$randWords = array(
"entry", "stay", "nature", "orders", "availability", "africa", "summary", "turn", "mean", "growth", "notes", "agency", "king", "monday", "european", "activity", "copy", "although", "drug", "pics", "western", "income", "force", "cash", "employment", "overall", "river", "commission", "package", "contents", "seen", "players", "engine", "port", "album", "regional", "stop", "supplies", "started", "administration", "institute", "views", "plans", "build", "screen", "exchange", "types", "soon", "sponsored", "lines", "electronic", "across", "benefits", "needed", "season", "apply", "someone", "held", "anything", "printer", "condition", "effective", "believe", "organization", "effect", "asked", "mind", "sunday", "selection", "casino", "lost", "tour", "menu", "volume", "cross", "anyone", "mortgage", "hope", "silver", "corporation", "wish", "inside", "solution", "mature", "role", "rather", "weeks", "addition", "came", "supply", "nothing", "certain", "score", "statistics", "client", "returns", "capital", "follow", "sample", "investment", "sent", "shown", "saturday", "christmas", "england", "culture", "band", "flash", "boys", "outdoor", "deep", "morning", "otherwise", "allows", "rest", "protein", "plant", "reported", "transportation", "pool", "mini", "politics", "partner", "disclaimer", "authors", "boards", "faculty", "parties", "fish", "membership", "mission", "sense", "modified", "pack", "released", "stage", "internal", "goods", "recommended", "born", "unless", "richard", "detailed", "japanese", "race", "approved", "background", "target", "except", "character", "usb", "maintenance", "ability", "maybe", "functions", "moving", "brands", "places", "pretty", "trademarks", "phentermine", "spain", "southern", "yourself", "winter", "battery", "youth", "pressure", "submitted", "boston");

	for ($i = 0; $i < 170; $i++)
	{
		$password = $randWords[(rand()) % 170] . $randWords[(rand()) % 170];
		$findGroup = "SELECT groupid FROM groups WHERE pass = '" . $password . "'";
		$result = mysql_query($findGroup);
			if(mysql_num_rows($result) == 0) {
					return $password;
				}
			else if($result == $groupID)
				{
				return $password;
				}
			else
			{
				continue;
			}
	}
	echo "we ducked up the password. sorry.";
}

?>
