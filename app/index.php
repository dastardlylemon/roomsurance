<?php
require_once ('../utils/db_connect.php');
function getChores($groupID)
{
  $arr = array();
  $findChores = "SELECT * FROM chores WHERE taskgroup = " . $groupID;
  $result = mysql_query($findChores);
  while ($row = mysql_fetch_assoc($result))
    $arr[] = $row;
  return $arr;
}

function printChores($groupID){
  $array = getChores($groupID);
  for ($i = 0; $i < count($array); $i++) {
    if ($array[$i][taskuser]) 
      $owner = $array[$i][taskuser];
    else
      $owner = 'no one';

    echo '<div class="chore" id ="choreID' .$array[$i][choreid] . '">' .
      '<div class="chore-date">' . date('M', strtotime($array[$i][due_date])) .'<br><b>' . date('d', strtotime($array[$i][due_date])) . '</b></div>' .
      '<h4 class="chore-title">' . $array[$i][chore_name] . ' </h4>' .  
      '<h5 class="chore-desc">' . $array[$i][chore_descrip] .' </h5>' .
      '<div class="chore-stats">Assigned to ' . $owner .
      ' | Difficulty: ' . $array[$i][difficulty] .   
      ' | Length: ' . $array[$i][length] .' mins' . 
      ' | Points:' . $array[$i][act_points] .' </div></div>'; 
  }
}

function getGroupName($groupID){
  $findGroup = "SELECT group_name FROM groups WHERE groupid = " . $groupID;
  $res = mysql_query($findGroup);
  $vals = mysql_fetch_assoc($res);
  echo $vals['group_name'];
}

function getUserName($userID){
  $findUser = "SELECT name FROM users WHERE userid = " . $userID;
  return mysql_fetch_assoc(mysql_query($findUser))['name'];
}

function getGroupUsers($groupID){
  $arr = array();
  $findUsers = "SELECT userid FROM users WHERE usergroup = " . $groupID;
  $res = mysql_query($findUsers);
  while ($row = mysql_fetch_assoc($res))
    $arr[] = getUserName($row['userid']);
  return $arr;
}

$uid = $_REQUEST['guid'];
$gid = $_REQUEST['gid'];
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Roomsurance</title>
  <link rel="stylesheet" href="../styles/styles.css">
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>

<body>
  <div id="header">
    <h1><?php getGroupName($gid); ?></h1>
  </div><br><br><br><br><br><br>
  <div id="content">
    <div id="chore-list">
      <?php printChores($gid); ?>
    </div>
  </div>

</body>
</html>
