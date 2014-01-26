<?
php
include 'groups.php';
function printChores($groupID){
$array = getChores($groupID);

for ($i = 0; $i < count($array); $i++)
{
	echo '<div class="choreTitle">' . $array[$i][chore_name]' </div>' .  '<div class="choreDescription">' . $array[$i][chore_description]' </div>' .
		 '<div class="choreDifficulty">' . $array[$i][difficulty]' </div>' .   '<div class="choreLength">' . $array[$i][length]' </div>' . 
		  '<div class="choreSugPoints">' . $array[$i][sugPoints]' </div>' .  '<div class="choreActualPoints">' . $array[$i][act_points]' </div>' . 
}		 '<div class="choreDueDate">' . $array[$i][due_date]' </div>'; 
}

?>