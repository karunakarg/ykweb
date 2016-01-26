<?
include_once('kart/kartlib.php');
include_once('kart/sqlcon.php');
include_once('kart/function.php');                    ////////////////////////////////////////////////// <== Pagination
$uid="{$user->id}";
$sef_url=1;
?>
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
<link href="kart/css/pagination.css" rel="stylesheet" type="text/css" /> <!--<<<<<<<<<<<<<<<<<<PAGINATION -->
<link href="kart/css/C_yellow.css" rel="stylesheet" type="text/css" />     <!--<<<<<<<<<<<<<<<<<<PAGINATION -->
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All Ads in this Group</strong>
<?
include_once('kart/function.php');                    ////////////////////////////////////////////////// <== Pagination
//*****************************Pagination ****************************

$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit = 10;
$startpoint = ($page * $limit) - $limit;

////////////////////////////////////////////////////////////////////

$gid=$_GET['gid'];
if (!isset($gid)) {
	if (isset($_SESSION['gid'])) {
		$gid = $_SESSION[gid];
	}
	else
		die('Select a group first');
}
if(!is_numeric($gid))
	die();
if(!is_numeric($page))
	die();
?>
    <table width="705" border="0" cellspacing="0">
    <?
	$st="FROM `ad_visibility` WHERE `gid`=$gid ORDER BY aid DESC";
	$q="SELECT * FROM `ad_visibility` WHERE `gid`=$gid ORDER BY aid DESC LIMIT $startpoint,$limit";
	$result=mysql_query($q) or die('sqlerr 1 groupads');
	$i=$startpoint;
	while($ad=mysql_fetch_array($result)) 
	{
		
		$row=getad($ad['aid']);
		
		$artid=$row['artid'];
		$q="select alias,hits from jos_content where id=$artid";
		$result1=mysql_query($q) or die('groupads sqlerr 12');
		$row1=mysql_fetch_array($result1);
		if(check_active($artid))
		{
			$i++;
			
			$link="viewad.php?id=".$artid."&&item=".$row1['alias'];

		?>
	      <tr>
        <td width="21" rowspan="4"><?=$i?>.)</td>
        <td width="144" rowspan="3"><a href="<?=$link?>" target="_top"><img src="<?=$row['timg']?>" width="120" height="80" style="border:double" /></a></td>
        <td colspan="2"><font size="+1"><a href="<?=$link?>" target="_top"><?=$row['title']?></a></font>&nbsp;<font color="#666666">(<?=$row1['hits']?> views)</font></td>
      </tr>
	      <tr>
	        <td width="380" class="cs"><? echo substr($row['info'],0,150)."..."?></td>
	        <td width="152"><font size="+1" color="#FF6600">Rs <?=$row['sp']?>/-</font>
            <?
    if($row['pn']=='yes')
	{
		echo '( Price Negotiable )';
	}
	?>
            </td>
      </tr>
	      <tr>
	        <td colspan="2"><font size="-1" color="#333333">Posted On :</font> <font size="-1" color="#666666"><?=$row['date']?></font> &nbsp;&nbsp;<font size="-1" color="#333333">under</font>&nbsp;: <font size="-1" color="#666666"><?=getsec($row['section'])?> &gt;&gt; 
     <a href="results.php?q=&section=<?=$row['section']?>&category=<?=$row['category']?>" target="_parent" style="text-decoration:none"><?=getcat($row['category'])?></a></font></td>
      </tr>
	      <tr>
	        <td width="144"><hr  /></td>
	        <td colspan="2"><hr  /></td>
      </tr>
      
	  <?
			}
		}
	
	?>
    </table>
    <?
    if(!mysql_num_rows($result))
	{
		error('There are no ads to display !');
	}
	?>
<p>
  <?
//******************************************************PAGINATION **************************
echo pagination($st,$limit,$page,$url='?op=1&gid='.$gid.'&');
/////////////////////////////////////////////////////////////////////////////////////////////

?>
  </p>

    