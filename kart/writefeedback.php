<?php
include('framework.php');
include('sqlcon.php');
$by="{$user->id}";
if(!$by)
{
	die('You Must Log in First !!');
}
?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<font color="#FF0000"><strong>Note :-</strong> <span id="sprytextarea2"> <span class="textareaRequiredMsg">*</span></span>You are advised to not use abusive language. It will get you permanently banned.</font>
<form id="form1" name="form1" method="post" action="writefeedback.php">
  <table width="459" border="0">
      <tr>
        <td colspan="" scope="col">Feedback Score:-</td>
        <td scope="col"><span id="spryselect1">
          <select name="score" id="select1">
            <option value="1" selected="selected">Positive</option>
            <option value="0">Negative</option>
          </select>
        <span class="selectRequiredMsg">Please select an item.</span></span></td>
      </tr>
      <tr>
        <td colspan="" scope="col">Exchange Code :-</td>
        <td scope="col"><span id="sprytextfield3">
          <input name="code" type="text" id="text3" value="<?=$_GET['code']?>" maxlength="20" readonly="readonly" />
        <span class="textfieldRequiredMsg">Exchange code is required.</span></span></td>
      </tr>
      <tr>
        <td colspan="" scope="col">Feedback :-</td>
        <td scope="col">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" scope="col"><span id="sprytextarea1">
          <textarea name="msg" cols="35" rows="3" id="textarea1"></textarea>
        </span></td>
    </tr>
      <tr>
        <td width="122" scope="col"><input type="submit" name="submit" id="button" value="Submit Feedback !" /></td>
        <th width="325" scope="col">&nbsp;</th>
        <th width="1" scope="col">&nbsp;</th>
      </tr>
  </table>
  </form>
<p>
<?php
$code=$_POST['code'];
$score=$_POST['score'];
$feedback=$_POST['msg'];
$date=date("d-m-Y");
$role='';
if(isset($_POST['submit']))
{
$q="SELECT * FROM `exchange` WHERE `code`='$code'";
$result=mysql_query($q) or die('Mysql Error !!');
$row=mysql_fetch_array($result);

if(!mysql_num_rows($result))
{
	echo '<script type="text/javascript"> alert("Invalid exchange code !!"); </script>';
	die();
}
if(!$row['successful'])
{
	echo '<script type="text/javascript"> alert("You cannot submit feedback yet! First,you must enter this exchange code in Enter exchange code section!!") </script>';
	die();
}
if($row['buyerid']==$by)
{
	$role='buyer';
	if($row['feedback_buyer'])
	{
	echo '<script type="text/javascript"> alert("You have already submitted a feedback for this exchange!!"); </script>';
	die();
	}
}
else if($row['sellerid']==$by)
{
	$role='seller';
	if($row['feedback_seller'])
	{
	echo '<script type="text/javascript"> alert("You have already submitted a feedback for this exchange!!"); </script>';
	die();
	}
}
if($role=='seller')
{
	$for=$row['buyerid'];
	$q1="UPDATE `$db`.`exchange` SET `feedback_seller` = '1' WHERE `exchange`.`code` ='$code'";
}
else if($role=='buyer')
{
	$for=$row['sellerid'];
	$q1="UPDATE `$db`.`exchange` SET `feedback_buyer` = '1' WHERE `exchange`.`code` ='$code'";
}
mysql_query($q1) or die('MySQL Error (1)!!');


$q="SELECT * FROM `jos_users` WHERE `id`=$for";
$result=mysql_query($q);
$row=mysql_fetch_array($result);
$fcount=$row['fcount'];
$fscore=$row['fscore'];

$pcount=0.01*$fscore*$fcount;
if($score)
{
	$pcount+=1;
}
$fcount=$fcount+1;
$fscore=($pcount*100)/$fcount;
$q="UPDATE `$db`.`jos_users` SET `fscore` =  '$fscore', `fcount` = '$fcount' WHERE `jos_users`.`id` = $for";
mysql_query($q) or die('MySQL Error(2)!!');

$for=$row['username'];
$by="{$user->username}";

$q="INSERT INTO `$db`.`feedback` (`fid`, `username`, `feedback`, `date`, `score`, `submitted_by`) VALUES (NULL, '$for', '$feedback', '$date', '$score', '$by')";
mysql_query($q) or die('Could not submit feedback !!');
echo '<script type="text/javascript"> alert("Feedback Submitted successfully!!"); </script>';
echo '<html><HEAD><META HTTP-EQUIV="refresh" CONTENT="0;URL=feedback.php"></HEAD></html>';
}
?>
</p>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
//-->
</script>
