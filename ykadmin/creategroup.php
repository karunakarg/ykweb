<?
session_start();
//include('framework.php');
include('../kart/kartlib.php');

//verifyparent();
?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<p></p>
<form action="creategroup.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
<fieldset>
  <table width="420" border="0">
    <tr>
      <td width="172">Group Name :</td>
      <td width="238"><span id="sprytextfield1">
        <input type="text" name="name" id="text1" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Group Alias :</td>
      <td><label>
        <input type="text" name="alias" id="textfield" />
      </label></td>
    </tr>
    <tr>
      <td>Group Image :</td>
      <td><label>
        <input type="file" name="mimg" id="fileField" />
        </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Create Group !!" /></td>
    </tr>
  </table>
  </fieldset>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
//-->
</script>
<?php
//require("sqlcon.php");
$title=strip_tags($_POST['name']);
$alias=strip_tags($_POST['alias']);
if(isset($_FILES['mimg']))
{
	$mimg=$_FILES['mimg'];
}

if(isset($_POST['name']))
{
//**************************Image**********************
 $target = "../kart/groupimage/";
 $target2 = "groupimage/";
 if(basename($_FILES['mimg']['name']))
 {
	 $name=basename( $_FILES['mimg']['name']);
	 $res=checkex($name);
	 $s1=1;
	 if(!$res)
	 {
		 error('File Type not allowed!! You can only upload JPEG,PNG,BMP and GIF images.');
		 $s1=0;
	 }
	 else
	 {
		 $name=str_replace(' ','_',$name);
		 $name=get_rand_id(15).'_'.$name;
		 $target=$target2.$name;
		 $mimg=kbase().'/kart/'.$target;
		 
		 if(move_uploaded_file($_FILES['mimg']['tmp_name'], $target)) 
		 {
			$s2=1;
		 }
		 else
		 {
			error('Error Uploading Main Image !!'); 
			$s2=0;
		 }
	 }
 }
 if($s1&&$s2)
 {
		//$desc=strip_tags($_POST['desc']);
		$q="INSERT INTO `groups` (`id`, `name`, `members`, `pic`, `alias`) VALUES (NULL, '$title', '0', '$name', '$alias')";
		//echo $q;
		mysql_query($q) or die('Could not create group|| My SQL Error !!');
		echo '<font color="#006600">Group Created Successfully !!</font>';
 }
 else
 {
	// echo $s1;
	 error('Failure !');
 }
}
?>

