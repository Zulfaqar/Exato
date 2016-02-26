<?php
//$con = mysql_connect("exato-db-instance.cwbw53vhehej.us-west-2.rds.amazonaws.com","Zulfaqar", "94025467z");
$con = mysql_connect("localhost","root", "");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("exato_database", $con);
//mysql_select_db("energy_project", $con);
$chart = array();
$sth = mysql_query("
                    SELECT 
                    value 
                    FROM readings 
                    where sensor='pool_temp'
                    ");
//$rows = array();
//$rows['name'] = 'Air Quality';

while($r = mysql_fetch_array($sth)) {
   $chart['api'][] = $r['value'];
}

$sth = mysql_query("
                    SELECT 
                    date_format(time_stamp,'%b %d, %h:%i %p') as time_stamp  
                    FROM readings 
                    where sensor='pool_temp'
                    ");
//$rows2 = array();
//$rows2['name'] = 'Time';
while($rrr = mysql_fetch_assoc($sth)) {
    $chart['api_date'][] = $rrr['time_stamp'];
}






//$chart = array();
//array_push($chart,$rows);
//array_push($chart,$rows2);


return json_encode($chart, JSON_NUMERIC_CHECK);

mysql_close($con);
?>
