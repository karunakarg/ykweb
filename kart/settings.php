<?
include('sqlcon.php');
include('kartlib.php');
$base=$_POST['base'];

if(isset($base))
{
$q="UPDATE `settings` SET `value` = '$base' WHERE `name` ='sitename'";
mysql_query($q) or die('MySQL Error(1)!!');
echo '<script type="text/javascript"> alert("Saved Successfully !!"); </script>';
}

$base=kbase();
?>
<form id="form1" name="form1" method="post" action="settings.php">
  <table width="500" border="0" cellspacing="0">
    <tr>
      <td width="96">Base URL :</td>
      <td width="400"><input name="base" type="text" id="textfield" value="<?=$base?>" size="40" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="SAVE" /></td>
    </tr>
  </table>
</form>
