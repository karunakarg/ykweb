<?
include('sqlcon.php');
include('kartlib.php');
$step=$_GET['step'];
if($step==2)
{
$sid=$_POST['state'];
if($_POST['save'])
{
$cities=$_POST['cities'];
$cities=explode(',',$cities);
foreach($cities as $val)
	{
		$q="INSERT INTO `city` (
`cid` ,
`sid` ,
`name`
)
VALUES (
NULL , '$sid', '$val'
)";
mysql_query($q) or die('MySQL Error(3)!!');
	}
}

$state=getstate($sid);
$city=getcity(0,$sid,0);
$city=implode(',',$city);
?>
<form id="form2" name="form2" method="post" action="addcity.php?step=2">
  <table width="612" border="0" cellspacing="0">
    <tr>
      <td width="171">State :</td>
      <td width="437"><?=$state?><input name="state" type="hidden" id="hiddenField" value="<?=$sid?>" />
      <input name="save" type="hidden" id="hiddenField2" value="1" /></td>
    </tr>
    <tr>
      <td>Current Cities :</td>
      <td><textarea name="show" cols="60" rows="6" readonly="readonly" id="textarea"><?=$city?></textarea></td>
    </tr>
    <tr>
      <td>New Cities :</td>
      <td><textarea name="cities" id="textarea2" cols="60" rows="6"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button2" id="button2" value="Save" /></td>
    </tr>
  </table>
</form>

<?
}
else
{
$state=getstate(0,1);
?>
<form id="form1" name="form1" method="post" action="addcity.php?step=2">
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
