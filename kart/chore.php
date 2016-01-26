<?
include('framework.php');
include('sqlcon.php');
include('kartlib.php');
$id="{$user->id}";
$name="{$user->username}";

$college=$_POST['college'];
$contact=$_POST['contact'];
$coll=explode(':',$college);
$cid=$coll[0];
$college=$coll[1];


if($college&&$contact)
{

$q="UPDATE `jos_users` SET `contact` = '$contact', `cid` = '$cid', `college` = '$college', `active` = '1' WHERE `jos_users`.`id` ='$id'";
mysql_query($q) or die('An error has occured !! Please logout and login again.If the problem persists, then contact YourKart.com support team.');

echo '<font color="green" >Profile Updated Successfully !!</font>';
die();
}

$q="SELECT * FROM `jos_users` WHERE `id`='$id'";
$result=mysql_query($q) or die();
$row=mysql_fetch_array($result);
if(!$row['active'])
{
  if(!$row['contact'])
  {
?>
<table width="627" border="1" cellspacing="0" bordercolor="#CC0000" bgcolor="#FFBFC1">
  <tr>
    <th width="101">NOTE:-</th>
    <td width="516"> <p>Before you start using this website ,it is highly recommended to complete following 2 fields.</p></td>
  </tr>
</table></br>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<script type="text/javascript">
function numcheck()
{
	var val=document.getElementById('text1').value ;
	
	if(isNaN(val))
	{
		alert('Enter a Number');
	 	document.getElementById('text1').value="";
		text1.focus();
		return false;
	
	}
	else
	{
		if(val.length<10)
		{
		alert('Contact No. should be atleast 10 digits long');
		text1.focus();
		return false;
		}
	}
}
</script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<form id="form1" name="form1" method="post" action="chore.php" onsubmit="return numcheck()">
  <table width="700" border="0" cellspacing="4">
    <tr>
      <td width="134">Your College</td>
      <td width="550"><span id="spryselect1">
        <select name="college" id="select1">
          <?
		$q="SELECT *
FROM `college`";
		$result=mysql_query($q) or die('MySQL Error(1)!!');
		while($row=mysql_fetch_array($result))
		{
			echo '<option value="'.$row['cid'].':'.$row['name'].'">'.$row['name'].'</option>';
		}
		?>
        </select>
        <span class="selectRequiredMsg">Please select your College.</span></span></td>
    </tr>
    <tr>
      <td>Contact No.</td>
      <td><span id="sprytextfield1">
        <input type="text" name="contact" id="text1"/>
        <span class="textfieldRequiredMsg">Your Contact No. is required.</span></span></td>
    </tr>
    <tr>
      <td><input type="submit" name="button" id="button" value="Save" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>

<script type="text/javascript">
<!--
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
//-->
</script>
<?
}
else
{
	$q="UPDATE `jos_users` SET `active` = '1' WHERE `jos_users`.`id` ='$id'";
mysql_query($q) or die('An error has occured !! Please logout and login again.If the problem persists, then contact YourKart.com support team.');
}
}
else
{
	echo '<html><HEAD><META HTTP-EQUIV="refresh" CONTENT="0;URL=profile.php"></HEAD></html>';
}
?>