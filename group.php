<?php
include_once('kart/kartlib.php');

$gid=$_GET['gid'];
$op = $_GET['op'];
if (!isset($op)) {
	$op=1;
}
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
	$q="SELECT * FROM `groups` WHERE id=$gid";
	$result=mysql_query($q) or die('sql error mod_group 1');
	$row=mysql_fetch_array($result);
?>
	<div class="row">
		<div class="col-sm-3">
			<img src="kart/groupimage/<?=$row['pic']?>" height="150" width="150" />
		</div>
		<div class="col-sm-9">
			<div class="row">
				<? $txt="Yourkart.com enables you to Buy and Sell used books/mobile phones/laptops/calculators etc within your college. This is a group for ".$row['name']." . Use \"Post a Free Ad\" button above to post your ad in this group or Use \"Post a Request\" button to post a Request."; info($txt); ?>
			</div>
			<div class="row">
				<font size="+2"><a href="index.php?gid=<?=$row['id']?>&n=<?=$row['name']?>"><?=$row['name']?></a></font>
			</div>
			<div class="row">
				<ul class="nav nav-tabs">
				  <li <? if($op==1) echo 'class="active"'; ?>><a href="index.php?gid=<?=$row['id']?>&n=<?=$row['name']?>&op=1&opname=Browse_Ads">Browse Ads</a></li>
				  <li <? if($op==3) echo 'class="active"'; ?>><a href="index.php?gid=<?=$row['id']?>&n=<?=$row['name']?>&op=3&opname=Browse_Requests">Browse Requests</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<?
			if ($op==1) {
				include_once('groupads.php');
			}
			if ($op==2) {
				message('Congratulations!! You have reached end of internet !! Contact Us with the page URL. You might get a chance to work with us !');
				//include_once('groupcat.php');
			}
			if ($op==3) {
				include_once('grouprequest.php');
			}
		?>
	</div>
<?
}
?>