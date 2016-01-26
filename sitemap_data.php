<?php
include('kart/kartlib.php');
include('kart/sqlcon.php');
include('kart/function_smap.php');
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
<?
//*****************************Pagination ****************************

$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit = 10;
$startpoint = ($page * $limit) - $limit;
if(!is_numeric($page))
	die('-1');

$query=$_GET['q'];
$sec=$_GET['section'];
$cat=$_GET['category'];
//$brand='any';

$pl=$_GET['pl'];
$ph=$_GET['ph'];
$war=$_GET['war'];
$pn=$_GET['pn'];
$age=$_GET['age'];
//*******************************security measures********************
$query=preg_replace('/[^A-Za-z0-9 ]/','',$query); //disallow anything but characters and numerals
if(!is_numeric($sec)&&$sec!='any')
	die('1');
if(!is_numeric($cat)&&$cat!='any')
	die('2');

if(isset($pl))
{
	if(!is_numeric($pl)&&$pl!='any')
	die('3');
}
if(isset($ph))
{
	if(!is_numeric($ph)&&$ph!='any')
	die('4');
}
if(isset($war))
{
	if($war!='yes'&&$war!='no'&&$war!='any')
	die('5');
}
if(isset($pn))
{
	if($pn!='yes'&&$pn!='no'&&$pn!='any')
	die('6');
}
if(isset($age))
{
	if(!is_numeric($age)&&$age!='')
	die('7');
}
//**********************************************************************
if($page>1)
{
	$aid=$_GET['aid'];
	$aid=base64_decode($aid);
	$aid=explode('_',$aid);
	$num=$_GET['num'];
	$rnum=$_GET['rnum'];
	$queryy=$query;
}
else
{
$rnum=0;
$aid=array();
$i=0;
$ex='';

if($sec=='any')
{
	$ex='';
}
else
{
	
	if($cat=='any')
	{
		$ex='section="'.$sec.'" AND';
	}
	else
	{
		$ex='section="'.$sec.'" AND category="'.$cat.'" AND';
	}
}
if(is_numeric($pl)&&$ph!=0)
{
	$ex=$ex.' sp BETWEEN '.$pl.' AND '.$ph.' AND';
}
if($pn=='yes'||$pn=='no')
{
	$ex=$ex.' pn="'.$pn.'" AND';
}
if($war=='yes'||$war=='no')
{
	$ex=$ex.' warranty="'.$war.'" AND';
}
if(is_numeric($age))
{
	$ex=$ex.' age < '.$age.' AND';
}

$q="SELECT id FROM `ads` WHERE ".$ex." `title` LIKE '%".$query."%'";
//echo $q;
$result=mysql_query($q) or die('MySQL Error(search1)!!');
$rnum=mysql_num_rows($result);

while($row=mysql_fetch_array($result))
{
	$aid[$i]=$row['id'];
	$i++;
}
$queryy=$query;
$query=explode(' ',$query);

foreach($query as $qry)
{
	$q="SELECT id FROM `ads` WHERE ".$ex." `title` LIKE '%".$qry."%'";
	$result=mysql_query($q) or die('MySQL Error(search2)!!');
	$rnum+=mysql_num_rows($result);
	
	while($row=mysql_fetch_array($result))
	{
		$aid[$i]=$row['id'];
		$i++;
	}
}

$aid=array_unique($aid);
$rnum=count($aid);
$num=$rnum;
}

if($num)
{
	if($num<$limit)
	{
		$lim=$startpoint+$num;
	}
	else
	{
		$num=$num-$limit;
		$lim=$startpoint+$limit;
	}
	?>
    <table width="797" border="0" cellspacing="0">
    <?
	$sno=$startpoint;
	for($i=$startpoint;$i<$lim;$i++)
	{
		if($aid[$i])
		{	
			$q="SELECT id,alias,title,state FROM `jos_content` WHERE `aid`=".$aid[$i];
			$resultt=mysql_query($q) or die('MySQL Error(112)!!');
			$roww=mysql_fetch_array($resultt);
			
			if($roww['state']) //if published
			{
				$artid=$roww['id'];
		?>
	      <tr>
        <td width="21"><?=$sno+1?>.)</td>
        <td width="624" colspan="2"><a href="../viewad.php?id=<?=$artid?>&&item=<?=$roww['alias']?>"><?=$roww['title']?></a></td>
      </tr>
      <?
	  			$sno++;
			}
		}
	}
	?>
</table>
<p>
  <?
//******************************************************PAGINATION ************************88
$aid=implode('_',$aid);
$aid=base64_encode($aid);
$uri='option=com_content&view=article&id='.$id.'&by='.$by.'&q='.$queryy.'&button=Search';
echo pagination($rnum,$limit,$page,$url='?'.$uri.'&aid='.$aid.'&num='.$num.'&rnum='.$rnum.'&');
/////////////////////////////////////////////////////////////////////////////////////////////
}
else
{
	echo "<br><br>Your Search returned an empty result !!";
	?>
    <a href="request.php">Post a request for this Item</a></br></br>
    <?
}

?>
</p>

    