<? $country=intval($_GET['country']);
include('sqlcon.php');
$query="SELECT * FROM `jos_categories` WHERE `section`='$country'";
$result=mysql_query($query);
// onchange="getCity(<?=$country?\>,this.value)"
?>
<select name="state">
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['id']?>><?=$row['title']?></option>
<? } ?>
</select>
