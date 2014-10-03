<?php
// Connecting, selecting database
  $dbconn = pg_connect("host=localhost dbname=postgres user=postgres password=negjktd")
  or die('Could not connect: ' . pg_last_error());

//  pg_query("set character_set_client='UTF8'");
//  pg_query("set character_set_results='UTF8'");
//  pg_query("set collation_connection='UTF8_general_ci'");

  $ver = pg_query("SELECT VERSION()");
  echo "".pg_result($ver, 0);

// Closing connection
pg_close($dbconn);

?>
