<?php
  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
  
  $server = $url["us-cdbr-east-04.cleardb.com"];
  $username = $url["bd925a77ad68a1"];
  $password = $url["88d26dab"];
  $db = substr($url["heroku_b2b5817a2ac0cf5"],1);

  mysql_connect($server, $username, $password);

  mysql_select_db($db);
