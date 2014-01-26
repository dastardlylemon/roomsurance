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
    echo '<div class="chore-date">' . date('m/d', strtotime($array[$i][due_date])) .
      '<div class="chore" id ="choreID' .$array[$i][choreid] . '">' .
      '<div class="chore-title">' . $array[$i][chore_name] . ' </div>' .  
      '<div class="chore-desc">' . $array[$i][chore_descrip] .' </div>' .
      '<div class="chore-diff">' . $array[$i][difficulty] . ' </div>' .   
      '<div class="chore-length">' . $array[$i][length] .' </div>' . 
      '<div class="chore-points">' . $array[$i][act_points] .' </div></div>'; 
  }
}

$uid = $_REQUEST['guid'];
$gid = $_REQUEST['gid'];
echo "hi";
echo $gid;
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
    <h3>Group name</h3>
  </div><br><br><br><br><br><br>
  <div id="content">
    <div id="chore-list">
      <?php 
        echo $gid;
        printChores($gid); 
      ?>
    </div>
  </div>

</body>
</html>
