<?php
include_once('kart/kartlib.php');

$gid=$_GET['gid'];

if(!isset($gid)){
	if (isset($_SESSION['gid'])) {
		$gid = $_SESSION['gid'];
	}
}
if(isset($gid))
{
	if(!is_numeric($gid))
		die('01');
		
	$_SESSION['gid']=$gid;
/*if(isset($_POST['join']))
{
	joingroup($uid,$gid);
}
if($_GET['action']=='leave')
{
	leavegroup($uid,$gid);
}*/
$q="SELECT * FROM `groups` WHERE id=$gid";
$result=mysql_query($q) or die('sql error mod_group 1');
$row=mysql_fetch_array($result);
?>
<script type="text/javascript">
function selectmenu(id)
{
	if(id==1)
	{
		document.getElementById('1').setAttribute('bgcolor','#FFFF99');
		document.getElementById('2').setAttribute('bgcolor','#FFFFFF');
		document.getElementById('3').setAttribute('bgcolor','#FFFFFF');
	}
	else if(id==2)
	{
		document.getElementById('2').setAttribute('bgcolor','#FFFF99');
		document.getElementById('1').setAttribute('bgcolor','#FFFFFF');
		document.getElementById('3').setAttribute('bgcolor','#FFFFFF');
	}
	else if(id==3)
	{
		document.getElementById('3').setAttribute('bgcolor','#FFFF99');
		document.getElementById('2').setAttribute('bgcolor','#FFFFFF');
		document.getElementById('1').setAttribute('bgcolor','#FFFFFF');
	}

}
</script>
<table width="767" border="1">
  <tr>
    <td width="153"><img src="kart/groupimage/<?=$row['pic']?>" height="150" width="150" /></td>
    <td width="598" colspan="2"><? $txt="Yourkart.com enables you to Buy and Sell used books/mobile phones/laptops/calculators etc within your college. This is a group for ".$row['name']." . Use \"Post a Free Ad\" button above to post your ad in this group or Use \"Post a Request\" button to post a Request."; info($txt); ?>
    <font size="+2"><a href="index.php?gid=<?=$row['id']?>&&n=<?=$row['name']?>"><?=$row['name']?></a></font>
    <br />
    
    <table width="598" border="1">
      <tr>
        <th width="208" bgcolor="#FFFF99" id="2"><a href="kart/groupads.php?gid=<?=$gid?>" target="group" onclick="selectmenu(2)">Browse  Ads</a></th>
        <th width="192" bgcolor="#FFFFFF" id="1"><a href="kart/groupcat.php" target="group" onclick="selectmenu(1)">Browse Categories</a></th>
        <th width="176" bgcolor="#FFFFFF" id="3"><a href="kart/grouprequest.php?gid=<?=$gid?>" target="group" onclick="selectmenu(3)">Browse Requests</a></th>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><iframe name="group" src="kart/groupads.php?gid=<?=$gid?>" width="754" height="1360"scrolling="no"></iframe>&nbsp;</td>
  </tr>
</table>
<?
}
?>