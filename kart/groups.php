<?
include('framework.php');
include('kartlib.php');
include('sqlcon.php');

$uid="{$user->id}";
$q="SELECT `group` FROM `jos_users` WHERE `id`=".$uid;
$result=mysql_query($q) or die('mysql error groups.php');
$row=mysql_fetch_array($result);

if (!$row['group']) {
	?>
<p>Welcome to YourKart Groups !!</p>
<p>It seems you don't have a membership of any group. Click below to search for groups to join or create your own group.</p>
<p>
      <?
}
include('groupmenu.php');
?>


