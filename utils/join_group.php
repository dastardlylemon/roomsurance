<?php
require_once('./db_connect.php');

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

$groupPW = $_POST['gid'];
$userID = $_POST['guid'];

$findGroup = "SELECT groupid FROM groups WHERE pass = '" . $groupPW . "' LIMIT 1";
$getGroupID = mysql_query($findGroup);
$groupID = mysql_fetch_assoc($getGroupID);
$groupID = $groupID['groupid'];
if (!$groupID) echo "Could not find group with pass";
$findUser = "UPDATE users SET usergroup = " . $groupID . " WHERE userid = '" . $userID . "'";
if (mysql_query($findUser))
  echo "Successfully joined group";
else
  echo "Error joining the group: " . mysql_error($db);
$getCash = "SELECT cash_per FROM groups WHERE groupid = " . $groupID;
$getCashVal = mysql_query($getCash);
$cashVal = mysql_fetch_assoc($getCashVal);
$cashVal = $cashVal['cashval'];
$putCash = "UPDATE users SET cash = " . $cashVal . " AND points = 1000 WHERE userid = '" . $userID . "'";
if (mysql_query($putCash))
  echo "You now have $" . $cashVal;
else
  echo "Could not add cash";
calculateTotalPoints($getGroupID);