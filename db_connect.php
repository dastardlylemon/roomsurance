<?php
  
  $server = "us-cdbr-east-04.cleardb.com";
  $username = "bd925a77ad68a1";
  $password = "88d26dab";
  $db = substr("heroku_b2b5817a2ac0cf5",1);

  $con = mysql_connect($server, $username, $password);

  mysql_select_db($db);
