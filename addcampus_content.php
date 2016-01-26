<?php
$e=0;
if(isset($_POST['button']))
{
	
		$name=strip_tags($_POST['name']);
		$email=strip_tags($_POST['email']);
		$captcha=$_POST['captcha'];
		
		//echo $captcha.' '.$_SESSION['img_ver'];
		
		if($_SESSION['img_ver']==$captcha)
		{
			$to="admin@yourkart.com";
			ykmail($to,$email,'Campus add request [YourKart]',$name);
			message('Your request has been received !! We will get back to you in few hours :) ');
			$e=0;
		}
		else
		{
			echo '<font color="red">Invalid Captcha Code !!</font>';
			$e=1;
		}
	
}
?>
<script src="kart/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="kart/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="kart/SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="kart/SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<form id="form1" name="form1" method="post" action="addcampus.php">
  <table width="620" border="0">
    <tr>
      <td width="133">College Name</td>
      <td width="477"><span id="sprytextfield11">
        <label>
          <input name="name" type="text" id="text1" value="<?=$name?>" maxlength="25" />
        </label>
      <span class="textfieldRequiredMsg">Name is required.</span></span></td>
    </tr>
    <tr>
      <td>Your Email Address</td>
      <td><span id="sprytextfield12">
      <label>
        <input name="email" type="text" id="text2" value="<?=$email?>" size="30"/>
      </label>
      <span class="textfieldRequiredMsg">Email is required.</span><span class="textfieldInvalidFormatMsg">Invalid Email !</span></span></td>
    </tr>
    
    <tr>
      <td>Enter Code </td>
      <td><img src="kart/captcha.php" alt="Captcha Image" width="80px" height="30px"/><span id="sprytextfield3">
        <label>
          <input name="captcha" type="text" id="text3" size="6" maxlength="6" />
        </label>
      <span class="textfieldRequiredMsg">Captcha is required.</span></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input class="btn btn-primary" type="submit" name="button" id="button" value="Submit" />
  &nbsp;&nbsp;&nbsp;&nbsp;    </label>
        </td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield11");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield12", "email", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea11");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
//-->
</script>
