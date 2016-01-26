<? session_start(); 
require_once('recaptchalib.php');
include_once('kart/kartlib.php');
include_once('kart/sqlcon.php');
include_once('kart/simpleimage.php');


?>
<!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
    <head>

        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Post a Free Ad | YourKart.com</title>
        <meta name="description" content="Buy/Sell/Trade used books/mobile phones/laptops/calculators etc. An online marketplace for students." />
    <?
      include('inc.php');
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

<link rel="stylesheet" href="modules/mod_createad/css/form-field-tooltip.css" media="screen" type="text/css">
	<script type="text/javascript" src="modules/mod_createad/js/rounded-corners.js"></script>
	<script type="text/javascript" src="modules/mod_createad/js/form-field-tooltip.js"></script>
    
<link rel="stylesheet" type="text/css" href="modules/mod_createad/css/style.css" />
<script src="kart/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="kart/SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="kart/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="kart/SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
    <body>
<? include('header.php'); ?>

<div id="fb-root"></div>

<!-- Begin Body -->
<div id="wrap"> 
<div class="container">
	<div class="row">
  			<div class="col-md-3" id="leftCol">
              
              	<? include('sidebar.php'); ?>
              
      		</div>  
      		<div class="col-md-9">
              	<br>
              	<div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">Post a Free Ad</div>
                      <div class="panel-body">
                        <? include('postad_content.php'); ?>
                      </div>
                    </div>
                  </div> 
              	</div>
              	<hr>
      		</div> 
  	</div>
</div>
<div id="push"></div>
</div>
<? include('footer.php'); ?>
    <? include('endinc.php'); ?>
    <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=154894791343035";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    
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
    </body>
</html>