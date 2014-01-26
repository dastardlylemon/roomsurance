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
          {
                  $curPoints2 = "SELECT points FROM users WHERE userid = '" . $peronDid . "'";
                  $result = mysql_execute($curPoints2);
                  $row2 = mysql_fetch_assoc($result);
                  $points2 = $row['points'];
                  $newPoints2 = $points2 + $pointVal;
                  $jamessenpai = "UPDATE users SET points = '" . $newPoints . "'";
        }
  }
?>