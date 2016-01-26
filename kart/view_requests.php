<?
include('kartlib.php');
$r_id=$_GET['rid'];
if(is_numeric($r_id))
{
$q="SELECT * FROM `requests` WHERE `id`=".$r_id;
$result=mysql_query($q) or die("mysql error view_requests 1");
$row=mysql_fetch_array($result);
?>
<table width="615" border="1">
<tr>
        <td colspan="3" class="cs" bgcolor="#CCCCCC"><strong><?=$row['desc']?></strong></td>
      </tr>
	      <tr>
	        <td colspan="2"><strong>Phone No. :</strong><?=$row['contact']?></td>
	        <td width="365"><strong>Email : </strong><?=$row['email']?></td>
      </tr>
	      <tr>
	        <td colspan="3"><font size="-1" color="#333333">Posted On :</font> <font size="-1" color="#666666"><?=$row['timestamp']?></font> &nbsp;&nbsp;<font size="-1" color="#333333">under</font>&nbsp;: <font size="-1" color="#666666"><?=getsec($row['sec'])?> &gt;&gt; 
    <?=getcat($row['cat'])?></font></td>
      </tr>
	      <tr>
	        <td colspan="3"><hr  /></td>
      </tr>
    </table>
<?
}
else
	die('Invalid Request Id');
?>