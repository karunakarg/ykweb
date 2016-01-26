<? $countryId=intval($_GET['country']);
$stateId=intval($_GET['state']);
include('sqlcon.php');
$query="SELECT * FROM `brand` WHERE `catid`='$stateId'";
$result=mysql_query($query);

?>
<select name="city">
<option>Select Brand</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value="<?=$row['bid']?>"><?=$row['name']?></option>
<? } ?>
</select>
