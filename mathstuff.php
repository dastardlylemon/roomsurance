<?php
  require_once("../db_connect.php");

  function Chores($dueDate, $pointVal, ,$complete, $personAsgn, $peronDid)
  {
  	$today = date('Y-m-d');
  	if(($today < $dueDate) && ($complete == 0)
  		$personAsgnPoints -= $pointVal;
  	if($complete == 1 && (strcmp($personAsgn, $peronDid) != 0))
  		$peronDidPoints += $pointVal;
  }
?>