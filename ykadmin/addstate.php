<?
include('sqlcon.php');
include('kartlib.php');

$state=$_POST['state'];
if(isset($state))
{
	$q="TRUNCATE TABLE `state`";
	mysql_query($q) or die('MySQL Error(2)!!');
	$state=explode(',',$state);
	foreach($state as $val)
	{
		$q="INSERT INTO `state` (
`sid` ,
`name`
)
VALUES (
NULL , '$val'
)";
mysql_query($q) or die('MySQL Error(3)!!');
	}
echo '<script type="text/javascript"> alert("Saved Successfully!!"); </script>';
}
$states=getstate(0,0);
$states=implode(',',$states);
?>
<form id="form1" name="form1" method="post" action="addstate.php">
  <p>
    <textarea name="state" id="textarea" cols="60" rows="8"><?=$states?></textarea>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Save" />
  </p>
</form>
