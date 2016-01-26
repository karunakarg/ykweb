<?
include('kartlib.php');
include('sqlcon.php');

$unique_id=$_GET['token'];
//get data on basis of uniq id
if($_POST['ch']=='Yes')
{
	$unique_id=$_POST['token'];
	$q="select id,artid,timg,mimg,img1,img2 from ads where uniqueid='$unique_id'";
	$result=mysql_query($q) or die('delete_ad sqlerr');
	$row=mysql_fetch_array($result);
	$ad_id=$row['id'];
	$art_id=$row['artid'];
	delete($row['mimg']);
	delete($row['timg']);
	delete($row['img1']);
	delete($row['img2']);
	$q1="DELETE FROM `ads` WHERE `ads`.`uniqueid` = '$unique_id'";
	$q2="DELETE FROM `ad_visibility` WHERE `ad_visibility`.`aid` = $ad_id";
	$q3="DELETE FROM `jos_content` WHERE `jos_content`.`id` = $art_id";
	mysql_query($q1) or die('delete_ad sqlerr 1');
	mysql_query($q2) or die('delete_ad sqlerr 2');
	mysql_query($q3) or die('delete_ad sqlerr 3');
	message('Ad Deleted Successfully !!');
}
else
{
	if($_POST['ch']=='No')
	{
		$unique_id=$_POST['token'];
	}
	$q="select artid,title from ads where uniqueid='$unique_id'";
	$result=mysql_query($q) or die('delete_ad sqlerr 0');
	$row=mysql_fetch_array($result);
	if(mysql_num_rows($result)==0)
	{
		error('Invalid token Id !!');
		die();
	}
?>
<form id="form1" name="form1" method="post" action="">
You are going to delete the following ad :<br />
<a href="<?=kbase()?>/index.php?option=com_content&view=article&id=<?=$row['artid']?>" target="_blank"><?=$row['title']?></a><br />
Are you Sure ? 
  <table width="200" border="0">
    <tr>
      <td><label>
        <input type="submit" name="ch" id="button" value="Yes" />
        <input name="token" type="hidden" id="hiddenField" value="<?=$unique_id?>" />
      </label></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="ch" id="button2" value="No" /></td>
    </tr>
  </table>
</form>
<?
}
?>