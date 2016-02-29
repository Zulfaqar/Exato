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
                    ifnull(round(value,2),0.00) AS api_value,
                    date_format(time_stamp,'%b %d, %Y %h:%i %p') AS daily_date
                    FROM readings
                    WHERE sensor = 'pool_temp'
                    ORDER BY 2 DESC LIMIT 1
                    ");
$result = array();
while($row = mysql_fetch_array($query)) {
    $result['data']= $row['api_value'];
    $result['date']= $row['daily_date'];
}


//array_push($result,);


return json_encode($result, JSON_NUMERIC_CHECK);

mysql_close($con);
?>
