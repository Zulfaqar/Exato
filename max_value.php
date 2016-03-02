<?php
$con = mysql_connect("exato-db-instance.cwbw53vhehej.us-west-2.rds.amazonaws.com","Zulfaqar", "94025467z");
//$con = mysql_connect("localhost","root", "");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("exato_database", $con);
//mysql_select_db("energy_project", $con);

$query = mysql_query("
                    SELECT 
                        value AS 'max',
                        date_format(time_stamp,'%b %d, %Y %h:%i %p') AS daily_date
                        FROM readings
                        ORDER BY value desc LIMIT 1
                    ");
$max = array();
while($row = mysql_fetch_array($query)) {
    $max['max']= $row['max'];
    $max['date']= $row['daily_date'];
}


//array_push($result,);


return json_encode($max, JSON_NUMERIC_CHECK);

mysql_close($con);
?>
