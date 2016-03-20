<?php

$con = mysql_connect("exato-db-instance.cwbw53vhehej.us-west-2.rds.amazonaws.com","Zulfaqar", "94025467z");
//$con = mysql_connect("localhost","root", "");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("exato_database", $con);

$chart = array();
$sth = mysql_query("
SELECT 
value 
FROM readings 
WHERE sensor='pool_temp'
 AND time_stamp BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()
");
while($r = mysql_fetch_array($sth)) {
$chart['api'][] = $r['value'];
}
$sth = mysql_query("
SELECT 
date_format(time_stamp,'%b %d, %h:%i %p') as time_stamp  
FROM readings 
 WHERE sensor='pool_temp'
AND time_stamp BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()
");
while($rrr = mysql_fetch_assoc($sth)) {
$chart['api_date'][] = $rrr['time_stamp'];
}
  return json_encode($chart, JSON_NUMERIC_CHECK);
mysql_close($con);
?>

