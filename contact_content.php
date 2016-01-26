<?php
$e=0;
if(isset($_POST['button']))
{
	if(isset($_POST['mess']))
	{
		$name=strip_tags($_POST['name']);
		$email=strip_tags($_POST['email']);
		$mess=strip_tags($_POST['mess']);
		$reason=strip_tags($_POST['reason']);
		$captcha=$_POST['captcha'];
		
		//echo $captcha.' '.$_SESSION['img_ver'];
		
		if($_SESSION['img_ver']==$captcha)
		{
			$to="admin@yourkart.com";
			$sub='[YourKart] '.$reason;
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Additional headers
			$headers .= 'From: '.$name.' <'.$email.'>' . "\r\n";
			mail($to,$sub,$mess,$headers);
			message('Your Query has been received by us !! We will get back to you in few hours :) ');
			$e=0;
		}
		else
		{
			echo '<font color="red">Invalid Captcha Code !!</font>';
			$e=1;
		}
	}
	else
	{
		echo '<br><font color="red">Message is Required !!</font>';
		$e=1;
	}
}
?>
<script src="kart/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="kart/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="kart/SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="kart/SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<form id="form1" name="form1" method="post" action="contactus.php">
  <table width="620" border="0">
    <tr>
      <td width="133">Name</td>
      <td width="477"><span id="sprytextfield11">
        <label>
          <input name="name" type="text" id="text1" value="<?=$name?>" maxlength="25" />
        </label>
      <span class="textfieldRequiredMsg">Name is required.</span></span></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><span id="sprytextfield12">
      <label>
        <input name="email" type="text" id="text2" value="<?=$email?>" size="30"/>
      </label>
      <span class="textfieldRequiredMsg">Email is required.</span><span class="textfieldInvalidFormatMsg">Invalid Email !</span></span></td>
    </tr>
    <tr>
      <td>Contact Reason</td>
      <td><label>
        <select name="reason" id="select">
          <option value="Regular Query" <? if($reason=='Regular Query'){ echo 'selected="selected"';}?>>Regular Query</option>
          <option value="Support Team" <? if(($_GET['reason']=='Support Team')||($reason=='Support Team')){ echo 'selected="selected"';}?>>Support Team</option>
          <option value="Legal Issues" <? if(($_GET['reason']=='Legal Issues')||($reason=='Legal Issues')){ echo 'selected="selected"';}?>>Legal Issues</option>
          <option value="Feedback" <? if(($_GET['reason']=='Feedback')||($reason=='Feedback')){ echo 'selected="selected"';}?>>Feedback</option>
          <option value="Press"><? if($reason=='Press'){ echo 'selected="selected"';}?>Press</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td>Message</td>
      <td><span id="sprytextarea11">
        <label>
          <textarea name="mess" id="textarea1" cols="30" rows="3"><? if($e){echo $mess;} ?></textarea>
        </label>
      <span class="textareaRequiredMsg">Message is required.</span></span></td>
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
        <input type="submit" name="button" id="button" value="Submit" />
  &nbsp;&nbsp;&nbsp;&nbsp;    </label>
        <label>
          <input type="reset" name="button2" id="button2" value="Reset" />
      </label></td>
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
