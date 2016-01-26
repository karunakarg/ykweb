<? session_start(); 
//$_SESSION['gid']=$_GET['gid'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Buy/Sell used books/mobile phones/laptops|  marketplace for college students | YourKart.com</title>
        <meta name="description" content="Buy/Sell/Trade used books/mobile phones/laptops/calculators etc. An online marketplace for students." />
    <?
      include('inc.php');
    ?>
        <style type="text/css">
.myButton {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );
	background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf');
	background-color:#ededed;
	-moz-border-radius:11px;
	-webkit-border-radius:11px;
	border-radius:11px;
	border:1px solid #dcdcdc;
	display:inline-block;
	color:#423d42;
	font-family:arial;
	font-size:17px;
	font-weight:bold;
	padding:6px 31px;
	text-decoration:none;
	text-shadow:1px 1px 0px #ffffff;
}.myButton:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed) );
	background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed');
	background-color:#dfdfdf;
}.myButton:active {
	position:relative;
	top:1px;
}

</style>
<style type="text/css">
	ul.pagination li.details{
	   color:#FFA200;
	}
	
	ul.pagination li a
	{
		color:#333333;
		text-shadow:0px 1px #F6F6F6;
		padding:6px 9px 6px 9px;
		border:solid 1px #B6B6B6;
		box-shadow:0px 1px #EFEFEF;
		-moz-box-shadow:0px 1px #EFEFEF;
		-webkit-box-shadow:0px 1px #EFEFEF;
		background:#E6E6E6;
		background:-moz-linear-gradient(top,#FFFFFF 1px,#F3F3F3 1px,#E6E6E6);
		background:-webkit-gradient(linear,0 0,0 100%,color-stop(0.02,#FFFFFF),color-stop(0.02,#F3F3F3),color-stop(1,#E6E6E6));
	}
	
	ul.pagination li
	{
		padding-bottom:1px;
	}
	
	ul.pagination li a:hover,
	ul.pagination li a.current
	{	
		color:#FFFFFF;
		box-shadow:0px 1px #E7E7E7;
		-moz-box-shadow:0px 1px #E7E7E7;
		-webkit-box-shadow:0px 1px #E7E7E7;       
	}
      
	ul.pagination li a:hover,
	ul.pagination li a.current
	{
		color:#893A00;
		text-shadow:0px 1px #FFEF42;
		border-color:#FFA200;
		background:#FFC800;
		background:-moz-linear-gradient(top,#FFFFFF 1px,#FFEA01 1px,#FFC800);
		background:-webkit-gradient(linear,0 0,0 100%,color-stop(0.02,#FFFFFF),color-stop(0.02,#FFEA01),color-stop(1,#FFC800));
	}         
	
	ul.pagination{
	margin:0px;
	padding:0px;
	height:100%;
	overflow:hidden;
	font:12px 'Tahoma';
	list-style-type:none;	
}

ul.pagination li.details{
    padding:7px 10px 7px 10px;
    font-size:14px;
}

ul.pagination li.dot{padding: 3px 0;}

ul.pagination li{
	float:left;
	margin:0px;
	padding:0px;
	margin-left:5px;
}

ul.pagination li:first-child{
	margin-left:0px;
}

ul.pagination li a{
	color:black;
	display:block;
	text-decoration:none;
	padding:7px 10px 7px 10px;
}

ul.pagination li a img{
	border:none;
}
	
</style>
<style type="text/css">
<!--
.myButton {
	-moz-box-shadow:inset 0px 1px 0px 0px #c1ed9c;
	-webkit-box-shadow:inset 0px 1px 0px 0px #c1ed9c;
	box-shadow:inset 0px 1px 0px 0px #c1ed9c;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #9dce2c), color-stop(1, #8cb82b) );
	background:-moz-linear-gradient( center top, #9dce2c 5%, #8cb82b 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#9dce2c', endColorstr='#8cb82b');
	background-color:#9dce2c;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #83c41a;
	display:inline-block;
	color:#ffffff;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:1px 1px 0px #689324;
}.myButton:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8cb82b), color-stop(1, #9dce2c) );
	background:-moz-linear-gradient( center top, #8cb82b 5%, #9dce2c 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8cb82b', endColorstr='#9dce2c');
	background-color:#8cb82b;
}.myButton:active {
	position:relative;
	top:1px;
}
.seller {
	font-family: "Comic Sans MS", cursive;
}
.rev {
	font-size: 12px;
}
.cs {
	font-family: "Comic Sans MS", cursive;
	font-size: 14px;
}
-->
</style>
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
    <body>
<? include('header.php'); ?>
<?php
$type = $_GET['type'];
include_once('function.php');                    ////////////////////////////////////////////////// <== Pagination
//*****************************Pagination ****************************

$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit = 10;
$startpoint = ($page * $limit) - $limit;
if(!is_numeric($page))
	die('invalid page number');
////////////////////////////////////////////////////////////////////
if(!is_numeric($_SESSION['gid']))
	die('invalid group id');

$q="select name from groups where id=".$_SESSION['gid'];
$result=mysql_query($q) or die('modjresults sqlerr');
$row=mysql_fetch_array($result);
if($type==1)//if search page
{
	$text = "<strong>Presenting search results from: </strong>".$row['name'];
}
else if($type==2)//if category page
{

$text = "<strong>Ads from Category : </strong>".getsec($_GET['section']);

}
?>
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
                      <div class="panel-heading"><?=$text?></div>
                      <div class="panel-body">
                      	<? include('results_content.php') ; ?>
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
    </body>
</html>




    