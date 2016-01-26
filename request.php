<? session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Post a Request | YourKart.com</title>
        <meta name="description" content="Post a free request on YourKart - An online marketplace for students." />
    <?
      include('inc.php');
    ?>
        
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
    <body>
<? include('header.php'); ?>
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
                      <div class="panel-heading">Post a Free Request</div>
                      <div class="panel-body">
                        <? include('request_content.php'); ?>
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
    </body>
</html>


