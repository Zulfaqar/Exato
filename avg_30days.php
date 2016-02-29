<?php
//$con = mysql_connect("exato-db-instance.cwbw53vhehej.us-west-2.rds.amazonaws.com","Zulfaqar", "94025467z");
$con = mysql_connect("localhost","root", "");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("exato_database", $con);
//mysql_select_db("energy_project", $con);

$query = mysql_query("
                    select 
                        round(AVG(value),2) as 'average_value',
                        date_format(NOW(),'%m/%d/%Y') AS 'from',
                        date_format(DATE_SUB(NOW(), INTERVAL 30 DAY),'%m/%d/%Y') as 'till'
                        FROM readings
                        WHERE sensor ='pool_temp'
                        AND time_stamp BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()
                    ");
$avg_30days = array();
while($row = mysql_fetch_array($query)) {
    $avg_30days['average_value']= $row['average_value'];
    $avg_30days['from']= $row['from'];
    $avg_30days['till']= $row['till'];
}


return json_encode($avg_30days, JSON_NUMERIC_CHECK);

mysql_close($con);
?>
