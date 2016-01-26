<?
//include_once('framework.php');
include_once('kart/kartlib.php');
include_once('kart/sqlcon.php');
include_once('kart/function.php');                    ////////////////////////////////////////////////// <== Pagination
$uid="{$user->id}";

//*****************************Pagination ****************************

$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit = 10;
$startpoint = ($page * $limit) - $limit;
if(!is_numeric($page))
	die('-1');
$gid=$_GET['gid'];
if(!is_numeric($gid))
	die('2 groupreq');
?>
<link href="kart/css/pagination.css" rel="stylesheet" type="text/css" /> <!--<<<<<<<<<<<<<<<<<<PAGINATION -->
<link href="kart/css/C_yellow.css" rel="stylesheet" type="text/css" />     <!--<<<<<<<<<<<<<<<<<<PAGINATION -->
<p></p>
<form id="form1" name="form1" method="get" action="index.php">
  <table width="390" border="0">
    <tr>
      <td width="151"><label>
        <input type="text" name="query" id="textfield" />
        <input name="gid" type="hidden" id="gid" value="<?=$gid?>" />
        <input name="op" type="hidden" id="gid" value="3" />
      </label></td>
      <td width="115"><input type="submit" name="button" id="button" value="Search Requests" /></td>
      <td width="110"><a href="grouprequest.php?gid=<?=$gid?>&&query=">show all requests</a></td>
    </tr>
  </table>
</form>
<?
$query=strip_tags($_GET['query']);
$query=preg_replace('/[^A-Za-z0-9 ]/','',$query); //disallow anything but characters and numerals

if(isset($query))
{
$st="FROM `requests` WHERE gid=$gid AND `desc` LIKE '%$query%' ORDER BY id DESC";
$q="SELECT * FROM `requests` WHERE gid=$gid AND `desc` LIKE '%$query%' ORDER BY id DESC LIMIT $startpoint, $limit";
$result=mysql_query($q) or die();

if (mysql_num_rows($result)) 
{
	?>
    <table width="100%" border="0">
    <?
	$i=$startpoint;                    ////////////////////////////////////////////////// <== Pagination
	while($row=mysql_fetch_array($result)) 
	{
		$i++;
	?>
   <tr>
        <td width="25" rowspan="4"><?=$i?>.)</td>
        <td colspan="3" class="cs" bgcolor="#CCCCCC"><?=$row['desc']?></td>
      </tr>
	      <tr>
	        <td colspan="2"><strong>Phone No. :</strong><?=$row['contact']?></td>
	        <td width="472"><strong>Email : </strong><?=$row['email']?></td>
      </tr>
	      <tr>
	        <td colspan="3"><font size="-1" color="#333333">Posted On :</font> <font size="-1" color="#666666"><?=$row['timestamp']?></font> &nbsp;&nbsp;<font size="-1" color="#333333">under</font>&nbsp;: <font size="-1" color="#666666"><?=getsec($row['sec'])?> &gt;&gt; 
    <?=getcat($row['cat'])?></font></td>
      </tr>
	      <tr>
	        <td colspan="3"><hr  /></td>
      </tr>
    <?
	
	}
	?>
    </table>
    <?
//******************************************************PAGINATION ************************88
echo pagination($st,$limit,$page,$url='?op=3&gid='.$gid.'&&query='.$query.'&&');
/////////////////////////////////////////////////////////////////////////////////////////////

}
else
{
	error('No Requests found !!');
	}
}
	?>


