<?
include('framework.php');
include('sqlcon.php');
include('kartlib.php');

$id="{$user->id}";
$uname="{$user->username}";
$contact=$_POST['contact'];
$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$vpass=$_POST['vpass'];
$fail=0;

if(isset($email))
{
if($pass!=$vpass)
{
	echo "<font color='red'>Passwords do not match !!</font></br>";
    $fail=1;
}

$q="SELECT `id` FROM `jos_users` WHERE `email`='$email'";
$result=mysql_query($q) or die('MySQL Error(1)!!');
if(mysql_num_rows($result))
{
	$row=mysql_fetch_array($result);
	$userid=$row['id'];
	if($id!=$userid)
	{
		echo "<font color='red'>E-mail address is in use by another person .</font></br>";
		$fail=1;
	}
}

}

if(isset($pass))
{
	$password = $pass;
/*
   for ($i=0; $i<=32; $i++) {
      $d=rand(1,30)%2;
      $salt .= $d ? chr(rand(65,90)) : chr(rand(48,57));
   }
*/
$salt=get_rand_id(32);

//hash password with salt-->
$hashed = md5($password . $salt);

//here is your new encrypted password, ready to store in the database table,  `jos_users`
$encrypted = $hashed . ':' . $salt;
}
$fail=!$fail;
if($contact&&$fail)
{
if(isset($pass))
{
$q="UPDATE `jos_users` SET `contact` = '$contact', `active` = '1', `name` = '$name', `email` = '$email', `password` = '$encrypted' WHERE `jos_users`.`id` ='$id'";	
}
else
{
$q="UPDATE `jos_users` SET `contact` = '$contact', `active` = '1', `name` = '$name', `email` = '$email' WHERE `jos_users`.`id` ='$id'";
}
mysql_query($q) or die('Error Updating Your Profile !!');
echo '<font color="green" >Your details have been Updated Successfully !!</font></br>';
}

$q="SELECT * FROM `jos_users` WHERE `id`=$id";
$result=mysql_query($q) or die('MySQL Error(2)!!');
$row2=mysql_fetch_array($result);
?>
<SCRIPT LANGUAGE="JavaScript">
function kk(vpass)
{
	var pass = document.getElementById('pid').value;
	if(pass!=vpass)
	{
		alert('Passwords Do not Match !!');
	}
}
//  End -->
</script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<fieldset><legend>Edit Your Details</legend>
<form id="form1" name="form1" method="post" action="profile.php">
  <table width="534" border="0" cellspacing="0">
    <tr>
      <td width="127">Username:</td>
      <td width="403">&nbsp;<?=$uname?></td>
    </tr>
    <tr>
      <td>Your Name:</td>
      <td><span id="sprytextfield2">
        <input name="name" type="text" id="text2" value="<?=$row2['name']?>" maxlength="150" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>E-mail:</td>
      <td><span id="sprytextfield3">
      <input name="email" type="text" id="text3" value="<?=$row2['email']?>" size="40" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid Email.</span></span></td>
    </tr>
    <tr>
      <td>Contact No.</td>
      <td><span id="sprytextfield1">
      <input name="contact" type="text" id="text1" value="<?=$row2['contact']?>" />
      <span class="textfieldRequiredMsg">Your Contact No. is required.</span><span class="textfieldInvalidFormatMsg">Invalid Phone no.</span><span class="textfieldMinCharsMsg">Atleast 7 digits are required.</span><span class="textfieldMaxCharsMsg">Only 12 digits are allowed.</span></span></td>
    </tr>
    <tr>
      <td>New Password:</td>
      <td>
        <span id="sprypassword1">
        <label>
          <input type="password" name="pass" id="pid" />
          <span class="passwordMinCharsMsg">Atleast 6 characters are required.</span></label>
</span></td>
    </tr>
    <tr>
      <td>Verify Password:</td>
      <td>
        <span id="sprypassword2">
        <label>
          <input type="password" name="vpass" id="textfield2" onblur="kk(this.value)"/>
          <span class="passwordMinCharsMsg">Atleast 6 characters are required.</span></label>
</span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input type="submit" name="button" id="button" value="Save" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>

</form></fieldset>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {minChars:7, maxChars:12, validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email", {validateOn:["blur"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {isRequired:false});
var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2", {isRequired:false});
//-->
</script>
