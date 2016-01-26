<?
session_start();
//include('framework.php');
include('kartlib.php');
include('sqlcon.php');
if(isset($_POST['button']))
{
//$name=strip_tags($_POST['name']);
$email=$_POST['email'];
$contact=$_POST['contact'];
$desc=strip_tags($_POST['desc']);
$key=strip_tags($_POST['key']);
$sec=strip_tags($_POST['country']);
$cat=strip_tags($_POST['state']);
$gid=strip_tags($_POST['gid']);
$captcha=$_POST['captcha'];
$e=0;
	if($_SESSION['img_ver']==$captcha)
	{
		//**************************security measures***********************
		$desc=preg_replace('/[^A-Za-z0-9 ]/','',$desc); //disallow anything but characters and numerals
		if(!is_numeric($gid))
			die('1');
		if(!is_numeric($sec)&&$sec!='')
			die('2');
		if(!is_numeric($cat)&&$cat!='')
			die('3');
	
		//******************************************************************
		$timestamp=date('d/m/Y');
		$rand_id=get_rand_id(10);
		$q="INSERT INTO `requests` (`id`, `desc`, `sec`, `cat`, `email`, `contact`, `uid`, `timestamp`, `gid`) VALUES (NULL, '$desc', '$sec', '$cat', '$email', '$contact', '$rand_id', '$timestamp', '$gid')";
		$result=mysql_query($q) or die('sqlerr 1 request');
		
		$q="select id from requests where uid='$rand_id'";
		$result=mysql_query($q) or die('sqlerr 2 request');
		$row=mysql_fetch_array($result);
		$id=$row['id'];
		if(isset($key))
		{
			$key=explode(',',$key);
			
			foreach($key as $keyword)
			{
				$keyword=strip_tags($keyword);
				$q="INSERT INTO `request_keywords` (`id`, `keyword`, `sec`, `cat`) VALUES ('$id', '$keyword', '$sec','$cat')";
				mysql_query($q) or die('sqlerr 3 request');
			}
		}
		message('Request posted Successfully !!');
		
	}
	else
	{//echo "here3";
		$e=1;
		error('Wrong Captcha Code Entered!!');
	}
}
info("Post your request and leave the rest to us. We will notify you instantly when someone is selling what you need.</br> Also, your request will be posted under the group you select for others to view.");
?>
<script type="text/javascript">
function r_getcats(value){
var categories_data= new Array();
categories_data[0] = '<select name="state" id="select2"></select>';
<?
$q="SELECT * FROM `jos_sections`";
$result=mysql_query($q) or die('MySQL Error(1)!!');
while($row=mysql_fetch_array($result))
{
	$data="";
	$q="SELECT * FROM `jos_categories` where section=".$row['id'];
	$result1=mysql_query($q) or die('MySQL Error(1)!!');
	$data = '<select name="state" id="select2">';
	while($row1=mysql_fetch_array($result1))
	{
		$data=$data.'<option value="'.$row1['id'].'">'.$row1['title'].'</option>';
	}
	$data=$data.'</select>';
	
?>
	categories_data[<?=$row['id']?>] = '<?=$data?>';
<?
}
?>
	document.getElementById('r_category').innerHTML = categories_data[value];
}
</script>
<link rel="stylesheet" href="css/form-field-tooltip.css" media="screen" type="text/css">
	<script type="text/javascript" src="js/rounded-corners.js"></script>
	<script type="text/javascript" src="js/form-field-tooltip.js"></script>
    
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<form id="form1" name="form1" method="post" action="">
  <table width="591">
    <tr>
      <td>E-Mail*</td>
      <td colspan="2"><span id="sprytextfield2">
      <label>
        <input name="email" type="text" id="text2" value="<? if($e){echo $email; }?>" maxlength="200" />
      </label>
      <span class="textfieldRequiredMsg">Email is required.</span><span class="textfieldInvalidFormatMsg">Invalid Email.</span></span></td>
    </tr>
    <tr>
      <td>Contact No.</td>
      <td colspan="2"><label>
<span id="sprytextfield3">
<input name="contact" type="text" id="text3" value="<? if($e){echo $contact; }?>" maxlength="12" />
<span class="textfieldInvalidFormatMsg">Invalid Contact no.</span><span class="textfieldMinCharsMsg">Atleast 7 digits are required.</span><span class="textfieldMaxCharsMsg">Only 12 digits are allowed.</span></span> (optional)</label></td>
    </tr>
    <tr>
      <td width="91"><p>Description*</p></td>
      <td colspan="2"><span id="sprytextarea1">
        <label>
          <textarea name="desc" id="textarea1" cols="35" rows="3" tooltipText="Describe what you need. Keep it simple and precise."><? if($e){echo $desc; }?></textarea>
        </label>
      <span class="textareaRequiredMsg">Description is required.</span></span></td>
    </tr>
    <tr>
      <td>Keywords*</td>
      <td colspan="2"><label>
<span id="sprytextfield4">
<input name="key" type="text" id="textfield" value="<? if($e){$key=implode(',',$key) ;echo $key; }?>" size="35" tooltipText="keywords help us to notify you if someone posts what you need"/>
<span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldRequiredMsg">Keywords are required.</span></span></label></td>
    </tr>
    <tr>
      <td>Post Under*</td>
      <td width="207"><span id="spryselect1">
        <select name="country" onchange="r_getcats(this.value)">
          <option value="0">Select Category</option>
          <?
    $q="SELECT * FROM `jos_sections`";
	$result=mysql_query($q) or die('MySQL Error(1)!!');
	while($row=mysql_fetch_array($result))
	{
	?>
          <option value="<?=$row['id']?>">
            <?=$row['title']?>
          </option>
          <?
	}
	?>
        </select>
      <span class="selectRequiredMsg">*</span></span></td>
      <td width="277"><div id="r_category"><select name="state" >
        </select></div></td>
    </tr>
     <tr>
      <td>Visibility*</td>
<td colspan="3">
	      <select name="gid" id="select1" tooltipText="Select the group where this request will be visible.">
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
          </select></td>
    </tr>
    <tr>
       <td>&nbsp;</td>
       <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
	    <td>Enter Code</td>
	    <td><img src="captcha.php" alt="Captcha Image" width="80px" height="30px"/><span id="sprytextfield5">
        <label>
          <input name="captcha" type="text" id="text3" size="10" maxlength="10" />
        </label>
        <span class="textfieldRequiredMsg">Captcha is required.</span></span></td>
    </tr>
      <td>&nbsp;</td>
      <td colspan="2"><label>
        <input type="submit" name="button" id="button" value="Submit" />
      </label></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {isRequired:false, validateOn:["blur"], minChars:7, maxChars:12});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "custom", {validateOn:["blur"], hint:"Enter Comma Separated keywords"});

//-->
</script>
<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.setTooltipPosition('right');
tooltipObj.setPageBgColor('#EEE');
tooltipObj.setCloseMessage('Exit');
tooltipObj.initFormFieldTooltip();
</script> 