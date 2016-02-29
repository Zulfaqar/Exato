 <?php
 //This file stores the data posted from the CC3000 in your MySQL database
function db_connect()
{
   //$result = mysql_connect("exato-db-instance.cwbw53vhehej.us-west-2.rds.amazonaws.com", "Zulfaqar","94025467z"); 
   $result = mysql_connect("localhost","root","");
   if (!$result)
      return false;
   return $result;
}
db_connect();
mysql_select_db("exato_database");
//mysql_select_db("energy_project");
	// Store data
    if ($_GET["temp"] && $_GET["hum"]) {
    $temp = $_GET["temp"];
    $hum  = $_GET["hum"];
$sqlt = "insert into readings (sensor,value) values ('pool_temp',$temp)";
$sqlh = "insert into readings (sensor,value) values ('pool_hum',$hum)";
mysql_query($sqlt);
mysql_query($sqlh);
    }
?>