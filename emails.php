<?php
$db="ajdata";
$uname="root";
$pass="";
$host='localhost';
$con=mysql_connect($host,$uname,$pass);
mysql_select_db("$db");

$q="SELECT `email`
FROM `student`
WHERE `pyear` =2015
AND email LIKE '%@%'
LIMIT 0 , 99";
$result = mysql_query($q);
while ($row=mysql_fetch_array($result)) {
	echo $row['email'].',';
}
?>
