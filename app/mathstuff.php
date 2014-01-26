<?php
  require_once("../db_connect.php");

  function Chores($dueDate, $pointVal, ,$complete, $personAsgn, $peronDid)
  {
  	$today = date('Ymd');
  	if($today<$dueDate && $complete == 0)
  	{
  		$curPoints = "SELECT points FROM users WHERE userid = '" . $personAsgn . "'";
  		$results = mysql_execute($curPoints);
  		$row = mysql_fetch_assoc($results);
  		$points = $row['points'];
  		$newPoints = $points - $pointVal;
  		$doesthismatter = "UPDATE users SET points = '" . $newPoints . "'";
   	}
  	if($complete == 1 && (strcmp($personAsgn, $peronDid) != 0))
  		$peronDidPoints += $pointVal;
  }
?>