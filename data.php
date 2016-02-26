<?php
$con = mysql_connect("exato-db-instance.cwbw53vhehej.us-west-2.rds.amazonaws.com","Zulfaqar", "94025467z");
//$con = mysql_connect("localhost","root", "");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("exato_database", $con);
//mysql_select_db("energy_project", $con);

$sth = mysql_query("SELECT value FROM readings where sensor='pool_temp'");
$rows = array();
$rows['name'] = 'Air Quality';
while($r = mysql_fetch_array($sth)) {
    $rows['data'][] = $r['value'];
}

$sth = mysql_query("SELECT value FROM readings where sensor='pool_hum'");
$rows1 = array();
$rows1['name'] = 'Voltage';
while($rr = mysql_fetch_assoc($sth)) {
    $rows1['data'][] = $rr['value'];
}

$sth = mysql_query("SELECT time_stamp*1000 as time_stamp FROM readings where sensor='pool_hum'");
$rows2 = array();
$rows2['name'] = 'time';
while($rrr = mysql_fetch_assoc($sth)) {
    $rows2['data'][] = $rrr['time_stamp'];
}


$result = array();
array_push($result,$rows2);
array_push($result,$rows);
array_push($result,$rows1);


print json_encode($result, JSON_NUMERIC_CHECK);

mysql_close($con);
?>
