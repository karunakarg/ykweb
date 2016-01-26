<?
include('sqlcon.php');
include('kartlib.php');
$id=$_GET['aid'];
$q="SELECT `email`,`contact` FROM `ads` WHERE `id`=".$id;
$result=mysql_query($q) or die('MySQL Error(1)!!');
$ad=mysql_fetch_array($result);

?>
<table width="380" border="0" bordercolor="#000000" style="border:solid">
  <tr>
    <td colspan="3" bgcolor="#999999"><strong>Seller Information :</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#CCCCCC">E-Mail :</td>
    <td><?=$ad['email']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#CCCCCC">Phone No. :</td>
    <td><?=$ad['contact']?></td>
  </tr>
</table>
