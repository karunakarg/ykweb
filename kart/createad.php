<?
session_start();
include('simpleimage.php');
?>
<html xmlns:fb="http://ogp.me/ns/fb#">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=154894791343035";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?
//include('framework.php');
include('kartlib.php');
include('sqlcon.php');

//verifyparent();

if(isset($_POST['post']))
{
	$title=strip_tags($_POST['title']);
	$section=$_POST['country'];
	$category=$_POST['state'];
	//$brand=$_POST['city'];
	$age=$_POST['age'];
	//$condition=$_POST['cond'];
	//$mp=$_POST['mp'];
	$sp=$_POST['sp'];
	$info=strip_tags($_POST['info']);
	$warranty=$_POST['warranty'];
	$pn=$_POST['pn'];
	$group=$_POST['group'];
	$captcha=$_POST['captcha'];
	//$valid=$_POST['valid'];
	$date=date('d/m/Y');
	$email=$_POST['email'];
		$contact=$_POST['contact'];
	//echo $captcha.' '.$_SESSION['img_ver'];
	if($_SESSION['img_ver']==$captcha)
	{
		$s0=0;
		if(isset($_FILES['mimg']))
		{
			$mimg=$_FILES['mimg'];
		}
		if(isset($_FILES['img1']))
		{
			$img1=$_FILES['img1'];
		}
		if(isset($_FILES['img2']))
		{
			$img2=$_FILES['img2'];
		}
		
		//if(!$uid)
		//{
		//	$uid=0;
		//$uname=strip_tags($_POST['name']);
		//$college=$_POST['college'];
	//	$email=$_POST['email'];
		//$contact=$_POST['contact'];
		//$s0=1;
		//}
		/*else
		{
			$uzer=getuser($uid);
			//$uname=$uzer['name'];
			//$college=$uzer['college'];
			$email=$uzer['email'];
			$contact=$uzer['contact'];
			$s0=1;
		}
		*/
		//*************************************************** Image Upload ********************************************************
		
		  // **************************Image 1**********************
		 $target = "itemimage/";
		 if(basename( $_FILES['mimg']['name']))
		 {
			 $name=basename( $_FILES['mimg']['name']);
			 $res=checkex($name);
			 $s1=1;
			 if(!$res)
			 {
				 error('File Type not allowed!! You can only upload JPEG,PNG,BMP and GIF images.');
				 $s1=0;
			 }
			 $name=str_replace(' ','_',$name);
			 $name=get_rand_id(15).'_'.$name;
			 $target=$target.$name;
			 $mimg=kbase().'/kart/'.$target;
			 $timg=kbase().'/kart/'."itemimage/thumb_".$name;
			 if(move_uploaded_file($_FILES['mimg']['tmp_name'], $target)) 
			 {
				$s2=1;
				$path="itemimage/thumb_".$name;
				$image = new SimpleImage();
				$image->load($target);
				$image->resize(150,100);
				$image->save($path);
			 }
			 else
			 {
				error('Error Uploading Main Image !!'); 
				$s2=0;
			 }
		 }
		  else
		 {
				$mimg=kbase().'/kart/nimg.jpg'; 
				$timg=kbase().'/kart/nimg_small.jpg';
				$s1=1;
				$s2=1;
		 }
		 // ***************************** Image 2 ********************
		 if(basename( $_FILES['img1']['name']))
		 {
			 $target = "itemimage/";
			 $name=basename( $_FILES['img1']['name']);
			 $res=checkex($name);
			 $s3=1;
			 if(!$res)
			 {
				 error('File Type not allowed!! You can only upload JPEG,PNG,BMP and GIF images.');
				 $s3=0;
			 }
			 $name=str_replace(' ','_',$name);
			 $name=get_rand_id(15).'_'.$name;
			 $target=$target.$name;
			 $img1=kbase().'/kart/'.$target;
			 if(move_uploaded_file($_FILES['img1']['tmp_name'], $target)) 
			 {
				$s4=1;
			 }
			 else
			 {
				error('Error Uploading Image 2 !!'); 
				$s4=0;
			 }
		 }
		 else
		 {
				$img1=kbase().'/kart/nimg.jpg';
				$s3=1;
				$s4=1;
		 }
		 //************************** Image 3 ***************************
		 if(basename( $_FILES['img2']['name']))
		 {
			 $target = "itemimage/";
			 $name=basename( $_FILES['img2']['name']);
			 $res=checkex($name);
			 $s5=1;
			 if(!$res)
			 {
				 error('Error Uploading Image 3 :');
				 error('File Type not allowed!! You can only upload JPEG,PNG,BMP and GIF images.');
				 $s5=0;
			 }
			 $name=str_replace(' ','_',$name);
			 $name=get_rand_id(15).'_'.$name;
			 $target=$target.$name;
			 $img2=kbase().'/kart/'.$target;
			 if(move_uploaded_file($_FILES['img2']['tmp_name'], $target)) 
			 {
				$s6=1;
			 }
			 else
			 {
				error('Error Uploading Image 3 !!'); 
				$s6=0;
			 }
		 }
		  else
		 {
				$img2=kbase().'/kart/nimg.jpg'; 
				$s5=1;
				$s6=1;
		 }
		//**************************************************************************************************************************************
		$error=1;
		if($s1&&$s2&&$s3&&$s4&&$s5&&$s6)
		{
			$error=0;
			$arr=createad($title,$section,$category,$age,$sp,$info,$mimg,$img1,$img2,$group,$contact,$email,$warranty,$pn,$date,$timg);
			$arr=explode(":",$arr);
			$article_id=$arr[0];
			$uniq_id=$arr[1];
			$body="<html><p>Hi ,</p>
		<p>You've just posted an ad on YourKart.com . If you need to find your ad, you can find it at the link below :</p>
		<p><a href=".'"'."http://www.yourkart.com/index.php?option=com_content&view=article&id=$article_id".'"'.">$title</a></p>
		<p>To edit your Ad, use the link below :</p>
		<p><a href=".'"'."http://www.yourkart.com/index.php?option=com_content&view=article&id=56&token=$uniq_id".'"'.">Click Here to Edit Your Ad</a></p>
		<p></p><p>When you have sold your item, you can delete the ad using the link below :</p>
		<p><a href=".'"'."http://www.yourkart.com/index.php?option=com_content&view=article&id=57&token=$uniq_id".'"'.">Click Here to Delete Your Ad</a></p>
		<p></p><p>We wish you good luck in finding the seller for your item. We are happy to be of any help in this procedure.</p>
		<p>Regards</p>
		<p>YourKart Team</p></html>";
		
				$to=$email;
				$sub="You just posted an Ad on YourKart.com";
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: YourKart <noreply_notif@yourkart.com>' . "\r\n";
				
				mail($to,$sub,$body,$headers);
                
			$msg= '<a href="http://www.yourkart.com/index.php?option=com_content&view=article&id='.$article_id.'" target="_parent">Click here to view your Ad</a></br> <b>Spread the word !! Share your Ad on Facebook</b> </br> <fb:like href="http://www.yourkart.com/index.php?option=com_content&view=article&id='.$article_id.'" send="true" layout="button_count" width="450" show_faces="false" font="arial"></fb:like>';
			info($msg);
			check_requests($title,$article_id,$group,$section,$category);
		}
		else
		{
			error('Sorry, Something went wrong. Please try again !!');
			$error=1;
		
		}
	}
	else
	{
		$error=1;
		error('Wrong Captcha Code Entered!!');
	}
}
?>
<script language="javascript" type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getState(countryId) {		
		
		var strURL="findState.php?country="+countryId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('statediv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
</script>
<script type="text/javascript">
function changetxt(val)
{
	if(val==0)
	{
		document.getElementById('def').innerHTML = 'List the reasons for Selling : <input name="flag" type="hidden" id="hiddenField" value="0" />';
	}
	else if(val==1)
	{
		document.getElementById('def').innerHTML = 'Please List the Defects :<input name="flag" type="hidden" id="hiddenField" value="1" />';
	}
}

function numcheck(val,id)
{
	
	if(isNaN(val))
	{
		alert('Enter a Number');
	 	document.getElementById(id).value="";
	
	}
}
function spcheck(val,id)
{
	
	if(isNaN(val))
	{
		alert('Enter a Number');
		document.getElementById(id).value="";
	
	}
	else
	{
		var mp=document.getElementById('mp').value
		if(val>mp)
		{
			alert('Selling Price Cannot be Greater than Market Price');
			document.getElementById(id).value="";
		}
	}
}
</script>

<link rel="stylesheet" href="css/form-field-tooltip.css" media="screen" type="text/css">
	<script type="text/javascript" src="js/rounded-corners.js"></script>
	<script type="text/javascript" src="js/form-field-tooltip.js"></script>
    
<link rel="stylesheet" type="text/css" href="./css/style.css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.pd {
	font-family: "Comic Sans MS", cursive;
	font-size: 12px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #333;
	background-color: #FFC;
	position: absolute;
	visibility:hidden;
	height: 119px;
	width: 227px;
	left: 516px;
	top: 564px;
}
-->
</style>

<form action="createad.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <p><strong>Item Details --- Fields with * mark are required</strong></p>
  <table width="613" border="0" cellspacing="2">
    
    <tr>
      <td width="184">Ad Title *</td>
      <td colspan="3"><span id="sprytextfield2">
        <input name="title" type="text" id="text2" value="<?=show_on_error($error,$title)?>" size="40" maxlength="40" tooltipText="Give your ad a suitable title. for e.g. Samsung Galaxy S for Sale" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Category *</td>
      <td width="185">
      <span id="spryselect2"><select  id="select2" name="country" onChange="getState(this.value)">
	<option value="">Select Category</option>
	<?
    $q="SELECT * FROM `jos_sections`";
	$result=mysql_query($q) or die('MySQL Error(1)!!');
	while($row=mysql_fetch_array($result))
	{
	?>
    <option value="<?=$row['id']?>"><?=$row['title']?></option>
    <?
	}
	?>
      </select> 
      <span class="selectRequiredMsg">Please select an item.</span></span>&nbsp;&nbsp;
      </td>
      <td width="230"><div id="statediv"><select name="state" >
	<option value=""></option>
      </select></div></td>
    </tr>
    <tr>
      <td>Item Age *</td>
      <td colspan="3"><span id="sprytextfield1">
      <input name="age" type="text" id="text1" value="<?=show_on_error($error,$age)?>" size="10" tooltipText="How old is your item ?" />
      <span class="textfieldRequiredMsg">Age is required</span><span class="textfieldInvalidFormatMsg">Invalid age.</span></span> &nbsp;Months Old</td>
    </tr>
    <tr>
      <td>Selling Price *</td>
      <td colspan="3">Rs. <span id="sprytextfield4">
      <input name="sp" type="text" id="text4" value="<?=show_on_error($error,$sp)?>" maxlength="9" tooltipText="At what price you wish to sell it ?"/>
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid price.</span></span></td>
    </tr>
    <tr>
      <td>Price Negotiable</td>
      <td colspan="3"><label>
        <select name="pn" id="select3" tooltipText="Please specify if price is negotiable.">
          <option value="yes">Yes</option>
          <option value="no">No</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td>Under Warranty</td>
      <td colspan="3"><label>
        <select name="warranty" id="select4" tooltipText="Specify if your Item is still under Warranty.">
          <option value="yes">Yes</option>
          <option value="no">No</option>
          </select>
        </label></td>
    </tr>
    <tr>
      <td>Visibility</td>
<td colspan="3"><span id="spryselect1">
	      <select name="group" id="select1" tooltipText="Select the group where this ad will be visible.">
		<?
        $q="SELECT *
FROM `groups`";
$result=mysql_query($q) or die('MySQL Error(1)!!');
		while($row=mysql_fetch_array($result))
		{
			if($row['id']==$_SESSION['gid'])
			{
				echo '<option value="'.$row['id'].'" selected="selected">'.$row['name'].'</option>';
			}
			else
			{
				echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
			}
		}
		?>
          </select>
      <span class="selectRequiredMsg">Please select an item.</span></span></td>
    </tr>
    <tr>
      <td>Additional  Information</td>
      <td colspan="3"><textarea name="info" id="textarea" cols="30" rows="3" tooltipText="You can tell your buyers more about the item 
     for e.g. its condition,color,accessories,
      features etc."><?=show_on_error($error,$info)?></textarea></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><strong>Upload some pictures of your item. It helps in gaining attention of Buyers.</strong></td>
      
    </tr>
    <tr>
      <td>Main Image (max. 1MB)</td>
      <td colspan="3"><input type="file" name="mimg" id="fileField" /></td>
    </tr>
    <tr>
      <td>Image 2 (max. 1MB)</td>
      <td colspan="3"><input type="file" name="img1" id="fileField2" /></td>
    </tr>
    <tr>
      <td>Image 3 (max. 1MB)</td>
      <td colspan="3"><input type="file" name="img2" id="fileField3" /></td>
    </tr>
    
  </table>

  <?
    if(!$uid)
	{ ?>
  <strong>Contact Details</strong>
  <table width="593" border="0" cellspacing="0">
	  <tr>
	    <td width="151">E-Mail *</td>
	    <td width="438"><span id="sprytextfield6">
        <input name="email" type="text" id="text5" value="<?=show_on_error($error,$email)?>" size="40" maxlength="400" tooltipText="Please enter your E-mail Id. Buyers will use it to contact you."/>
        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid E-Mail .</span></span></td>
      </tr>
      <tr>
	    <td>Contact No. (optional)</td>
	    <td><span id="sprytextfield7">
        <input name="contact" type="text" id="text6" value="<?=show_on_error($error,$contact)?>" maxlength="12" tooltipText="Please enter your contact number. Buyers prefer to call."/>
<span class="textfieldInvalidFormatMsg">Invalid Phone Number.</span><span class="textfieldMinCharsMsg">Invalid Phone Number.</span></span></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
    </tr>
	  <tr>
	    <td>Enter Captcha</td>
	    <td><img src="captcha.php" alt="Captcha Image" width="80px" height="30px"/><span id="sprytextfield3">
        <label>
          <input name="captcha" type="text" id="text3" size="10" maxlength="10" />
        </label>
        <span class="textfieldRequiredMsg">Captcha is required.</span></span></td>
    </tr>
	  
    </table>
  <div class="pd">
    <p><strong><font>HATE Filling Personal Details</font></strong> ?</p>
    <p><a href="../index.php?option=com_ajaxregistration&task=register" target="_parent">Register Now</a> for once and get over with it. Also, you get to play with new tools like detailed Ad tracking and targeting to help you sell faster.</p>
</div>
    <p>
      <?	}
	  
	?>
    </p>
    <p>
      <input type="submit" name="post" id="button" value="Post Ad" />
    (By Posting this Ad, You Agree to Our <a target="_parent" href="http://www.yourkart.com/index.php?option=com_content&view=article&id=33&Itemid=96">Terms of Use</a>.)</p>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {validateOn:["blur"]});

var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "email", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "integer", {minChars:7, isRequired:false, validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
//-->
</script>
<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.setTooltipPosition('right');
tooltipObj.setPageBgColor('#EEE');
tooltipObj.setCloseMessage('Exit');
tooltipObj.initFormFieldTooltip();
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
</script> 
</html>