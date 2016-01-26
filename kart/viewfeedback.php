<?php
include('framework.php');
include('sqlcon.php');
$id="{$user->id}";
if(!id)
{
	die('You Must Register or Log in First !!');
}
$uid=$_GET['uid'];
if(!isset($uid))
{
	$uid="{$user->username}";
}
$q="SELECT * FROM `feedback` WHERE `username`='$uid' ORDER BY `fid` DESC";
$result=mysql_query($q) or die('Mysql Error(1) !!');
$i=1;
if(!mysql_num_rows($result))
{
	echo "$uid has No feedbacks !!";
	die();
}
?>
<table width="509" border="1" cellspacing="0" bordercolor="#000000">
  <tr bgcolor="#00CCFF">
    <td width="53"><center>S. No.</center></td>
    <td width="248"><center>Feedback</center></td>
    <td width="39">Score</td>
    <td width="57"><center>Date</center></td>
    <td width="90">Submitted By</td>
  </tr>
<?php
while($row=mysql_fetch_array($result))
{
?>
  <tr>
    <td><center><?php echo $i;?></center></td>
    <td><center><?php echo $row['feedback']; ?></center></td>
    <td>
    <center>
	<?php 
	if($row['score'])
	{
		echo "<font color='green' size='+1'>+</font>";
	}
	else
	{
		echo "<font color='red' size='+1'>-</font>";
	}
	?>
    </center>
    </td>
    <td><center><?php echo $row['date']; ?></center></td>
    <td><center><?php echo $row['submitted_by']; ?></center></td>
  </tr>
  <?php
$i++;
}
?>
</table>
