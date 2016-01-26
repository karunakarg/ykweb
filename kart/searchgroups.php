<?
include('framework.php');
include('kartlib.php');
include('sqlcon.php');
include('function.php');                    ////////////////////////////////////////////////// <== Pagination
$uid="{$user->id}";

//*****************************Pagination ****************************

$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit = 10;
$startpoint = ($page * $limit) - $limit;
if(!is_numeric($page))
	die('-1');
?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" /> <!--<<<<<<<<<<<<<<<<<<PAGINATION -->
<link href="css/C_yellow.css" rel="stylesheet" type="text/css" />     <!--<<<<<<<<<<<<<<<<<<PAGINATION -->
<p></p>
<form id="form1" name="form1" method="get" action="">
  <table width="374" border="0">
    <tr>
      <td width="144"><label>
        <input type="text" name="query" id="textfield" />
      </label></td>
      <td width="108"><input type="submit" name="button" id="button" value="Search Groups" /></td>
      <td width="108"><a href="searchgroups.php?query=">show all groups</a></td>
    </tr>
  </table>
</form>
<?
$query=strip_tags($_GET['query']);
$query=preg_replace('/[^A-Za-z0-9 ]/','',$query); //disallow anything but characters and numerals

if(isset($query))
{
$st="FROM `groups` WHERE `name` LIKE '%$query%' ORDER BY members DESC";
$q="SELECT * FROM `groups` WHERE `name` LIKE '%$query%' ORDER BY members DESC LIMIT $startpoint, $limit";
$result=mysql_query($q) or die();

if (mysql_num_rows($result)) 
{
	?>
    <table width="430" border="1">
  <tr>
    <td width="44">S. No.</td>
    <td width="374">Group Name</td>
    </tr>
    <?
	$i=$startpoint;                    ////////////////////////////////////////////////// <== Pagination
	while($row=mysql_fetch_array($result)) 
	{
		$i++;
	?>
  <tr>
    <td><?=$i?></td>
    <td><a href="../index.php?option=com_content&view=article&id=30&gid=<?=$row['id']?>" style="text-decoration:none" target="_parent"><?=$row['name']?></a></td>
    </tr>	
    <?
	
	}
	?>
    </table>
    <?
//******************************************************PAGINATION ************************88
echo pagination($st,$limit,$page,$url='?query='.$query.'&&');
/////////////////////////////////////////////////////////////////////////////////////////////

}
else
{
	error('No Results found !!');
	}
}
	?>


