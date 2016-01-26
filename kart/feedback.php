<?
include('framework.php');include('sqlcon.php');
?>
<table width="586" border="1" cellspacing="0" bordercolor="#000000">
  <tr background="top.png">
    <th width="39">S.No.</th>
    <th width="343">Book Title</th>
    <th width="81">You Were</th>
    <th width="105">Give Feedback</th>
  </tr>
<?
$i=0;
$id="{$user->id}";
$q1="SELECT * FROM `exchange` WHERE `sellerid`=$id AND `successful`=1 AND `feedback_seller`=0";
$q2="SELECT * FROM `exchange` WHERE `buyerid`=$id AND `successful`=1 AND `feedback_buyer`=0";
$result1=mysql_query($q1) or die('MySQL Error(11)!!');
$result2=mysql_query($q2) or die('MySQL Error(12)!!');


while($row=mysql_fetch_array($result2))
{
	$bid=$row['bid'];
	$q="SELECT `title` FROM `books` WHERE `bid`=$bid";
	$result=mysql_query($q) or die('MySQL Error(13)!!');
	$row1=mysql_fetch_array($result);
	$i++;
?>

  <tr>
    <td><center><?=$i?></center></td>
    <td><center><?=$row1['title']?></center></td>
    <td><center>Buyer</center></td>
    <td><center>
      <form id="form1" name="form1" method="post" action="writefeedback.php?code=<?=$row['code']?>">
        <input type="submit" name="button" id="button" value="Give Feedback" />
      </form>
    </center></td>
  </tr>

<?
}
?>
<?
$i=0;
while($row=mysql_fetch_array($result1))
{
	$bid=$row['bid'];
	$q="SELECT `title` FROM `books` WHERE `bid`=$bid";
	$result=mysql_query($q) or die('MySQL Error(13)!!');
	$row1=mysql_fetch_array($result);
	$i++;
?>

  <tr>
    <td><center><?=$i?></center></td>
    <td><center><?=$row1['title']?></center></td>
    <td><center>Seller</center></td>
    <td><center>
      <form id="form1" name="form1" method="post" action="writefeedback.php?code=<?=$row['code']?>">
        <input type="submit" name="button" id="button" value="Give Feedback" />
      </form>
    </center></td>
  </tr>

<?
}
?>
</table>