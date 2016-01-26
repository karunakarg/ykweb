<?
include('sqlcon.php');
include('kartlib.php');
$step=$_GET['step'];
if($step==3)
{
$cid=$_POST['city'];
if($_POST['save'])
{
$localities=$_POST['locality'];
$localities=explode(',',$localities);
foreach($localities as $val)
	{
		$q="INSERT INTO `locality` (
`lid` ,
`cid` ,
`name`
)
VALUES (
NULL , '$cid', '$val'
)";
mysql_query($q) or die('MySQL Error(3)!!');
	}
}

$city=getcity($cid,0,0);
$locality=getlocality(0,$cid,0);
$locality=implode(',',$locality);
?>
<form id="form2" name="form2" method="post" action="addlocality.php?step=3">
  <table width="629" border="0" cellspacing="0">
    <tr>
      <td width="229">City :</td>
      <td width="396"><?=$city?><input name="city" type="hidden" id="hiddenField" value="<?=$cid?>" />
      <input name="save" type="hidden" id="hiddenField2" value="1" /></td>
    </tr>
    <tr>
      <td>Current Localities :</td>
      <td><textarea name="show" cols="60" rows="6" readonly="readonly" id="textarea"><?=$locality?></textarea></td>
    </tr>
    <tr>
      <td>New Localities :</td>
      <td><textarea name="locality" id="textarea2" cols="60" rows="6"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button2" id="button2" value="Save" /></td>
    </tr>
  </table>
</form>

<?
}
else if($step==2)
{
$sid=$_POST['state'];
$city=getcity(0,$sid,1);
?>
<form id="form3" name="form3" method="post" action="addlocality.php?step=3">
  <table width="500" border="0" cellspacing="0">
    <tr>
      <td width="112">Select City</td>
      <td width="384"><select name="city" id="select2">
        <?
      foreach($city as $val)
	  {
		 $val=explode(':',$val) ;
		 echo '<option value="'.$val[0].'">'.$val[1].'</option>';
		 
	  }
	  ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input type="submit" name="button3" id="button3" value="Next -&gt;" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?	
}
else
{
$state=getstate(0,1);
?>
<form id="form1" name="form1" method="post" action="addlocality.php?step=2">
  <table width="500" border="0" cellspacing="0">
    <tr>
      <td width="112">Select State</td>
      <td width="384"><select name="state" id="select">
      <?
      foreach($state as $val)
	  {
		 $val=explode(':',$val) ;
		 echo '<option value="'.$val[0].'">'.$val[1].'</option>';
		 
	  }
	  ?>
        
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input type="submit" name="button" id="button" value="Next -&gt;" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
  <? }?>
