<?php
require_once('./db_connect.php');

function explodeString($rawGroupString, &$groups) {
  $groups = explode(",", $rawGroupString);
}

function removeSpaces($rawString) {
  str_replace(" ", "", $rawString);
}

function sendEntryMail($emailString, $groupID) { //sends an entry email to everyone in the string 
  $emailString = removeSpaces($emailString);
  $emails = array();
  explodeString($emailString, $emails); //emails now contains an array of tbe emails to be sent out.

  $getGroupPW = "SELECT pass FROM groups WHERE groupid = " . $groupID;
  $groupPW = mysql_query($getGroupPW);
  settype($groupPW, "string");

  for ($i = 0; $i < count($emails); $i++) {
    mail($emails[$i], "You've been invited to Roomsurance!", "Hello! \n You've been invited to Roomsurance!  This means one of your roommates has invited you to this chore management service.  Your password is: \n \n " . $groupPW . " \n \n Visit our website, and when prompted, please input the password above. If you believe you've received this email in error, kindly ignore this message.  \n Thanks, \n Roomsurance Staff ", "From: webmaster@Roomsurance.com");
  } //should work, theoretically.
}

//contains 170 random words

function generatePassword() {
  $randWords = array(
    "entry", "stay", "nature", "orders", "availability", "africa", "summary", "turn", "mean", "growth", "notes", "agency", "king", "monday", "european", "activity", "copy", "although", "drug", "pics", "western", "income", "force", "cash", "employment", "overall", "river", "commission", "package", "contents", "seen", "players", "engine", "port", "album", "regional", "stop", "supplies", "started", "administration", "institute", "views", "plans", "build", "screen", "exchange", "types", "soon", "sponsored", "lines", "electronic", "across", "benefits", "needed", "season", "apply", "someone", "held", "anything", "printer", "condition", "effective", "believe", "organization", "effect", "asked", "mind", "sunday", "selection", "casino", "lost", "tour", "menu", "volume", "cross", "anyone", "mortgage", "hope", "silver", "corporation", "wish", "inside", "solution", "mature", "role", "rather", "weeks", "addition", "came", "supply", "nothing", "certain", "score", "statistics", "client", "returns", "capital", "follow", "sample", "investment", "sent", "shown", "saturday", "christmas", "england", "culture", "band", "flash", "boys", "outdoor", "deep", "morning", "otherwise", "allows", "rest", "protein", "plant", "reported", "transportation", "pool", "mini", "politics", "partner", "disclaimer", "authors", "boards", "faculty", "parties", "fish", "membership", "mission", "sense", "modified", "pack", "released", "stage", "internal", "goods", "recommended", "born", "unless", "richard", "detailed", "japanese", "race", "approved", "background", "target", "except", "character", "usb", "maintenance", "ability", "maybe", "functions", "moving", "brands", "places", "pretty", "trademarks", "phentermine", "spain", "southern", "yourself", "winter", "battery", "youth", "pressure", "submitted", "boston"
  );

  for ($i = 0; $i < 170; $i++) {
    $password = $randWords[(rand()) % 170] . $randWords[(rand()) % 170];
    $findGroup = "SELECT groupid FROM groups WHERE pass = '" . $password . "'";
    $result = mysql_query($findGroup);
    if(mysql_num_rows($result) == 0) {
        return $password;
    } else if($result == $groupID) {
      return $password;
    } else {
      continue;
    }
  }
  echo "we ducked up the password. sorry.";
}

$groupName = $_POST['gname'];
$cashPerPerson = $_POST['gmoney'];
$listEmails = $_POST['gmails'];
$userID = $_POST['guid'];

$newGroup = "INSERT INTO groups (group_name, cash_per) VALUES ('" . $groupName . "', " . $cashPerPerson . ")";
if (mysql_query($newGroup))
  echo "Successfully created group " . $groupName;
else
  echo "Group could not be created because " . mysql_error($db);
$getGroupID = "SELECT groupid FROM groups WHERE group_name = '" . $groupName . "' LIMIT 1";
$newGroupID = mysql_query($getGroupID);
$groupID = mysql_fetch_assoc($newGroupID);
$groupID = $groupID['groupid'];
$groupPW = generatePassword();

$setGroupPW = "UPDATE groups SET pass = '" . $groupPW . "' WHERE groupid = " . $groupID;

if (mysql_query($setGroupPW))
  echo "Successfully created password";
else
  echo "Could not create password";
$setGroupID = "UPDATE users SET usergroup = " . $groupID . " WHERE userid = '" . $userID ."'";
  
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
?>
