<?
php
echo "test1";
require_once ('./db_connect.php');
echo "test2";
include '../groups.php';
echo "test3";
function printChores($groupID){
$array = getChores($groupID);
echo "test4";
for ($i = 0; $i < count($array); $i++)
{
	echo '<div class="superWrapper" id ="choreID' .$array[$i][choreid] . '">' .
		'<div class="choreTitle">' . $array[$i][chore_name]' </div>' .  '<div class="choreDescription">' . $array[$i][chore_description]' </div>' .
		 '<div class="choreDifficulty">' . $array[$i][difficulty]' </div>' .   '<div class="choreLength">' . $array[$i][length]' </div>' . 
		  '<div class="choreSugPoints">' . $array[$i][sugPoints]' </div>' .  '<div class="choreActualPoints">' . $array[$i][act_points]' </div>' . 
}		 '<div class="choreDueDate">' . $array[$i][due_date]' </div></div>'; 
}


//TEST CODE. REMOVE BEFORE EVERYTHING GOES BAD.
printChores(261)
?>