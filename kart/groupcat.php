<?
session_start();
include('framework.php');
include('kartlib.php');
include('sqlcon.php');
include('function.php');                    ////////////////////////////////////////////////// <== Pagination
$uid="{$user->id}";
$q1="select * from jos_sections order by ordering";
$result=mysql_query($q1) or die('sql err group cat 1');
$count=mysql_num_rows($result);
$num=ceil($count/3);
?>
<table width="600" border="1" style="border:thin">
  <tr>
    <td><?
	for($i=$num;$i!=0;$i--)
	{
		$row=mysql_fetch_array($result);
    	echo "<b>".$row['title'].'</b><br>'.'<br>';
		$q="select * from jos_categories where section=".$row['id'];
		$result1=mysql_query($q) or die('sqlerr2 groupcat');
		while($row1=mysql_fetch_array($result1)) 
		{
		?>
			<a href="../results.php?q=&section=<?=$row['id']?>&category=<?=$row1['id']?>&type=2&gid=<?=$_SESSION['gid']?>" target="_parent"><?=$row1['title']?></a><br>
		<?
        }
		echo "<hr />";
	}
	?></td>
    <td><?
	for($i=$num;$i!=0;$i--)
	{
		$row=mysql_fetch_array($result);
    	echo "<b>".$row['title'].'</b><br>'.'<br>';
		$q="select * from jos_categories where section=".$row['id'];
		$result1=mysql_query($q) or die('sqlerr2 groupcat');
		while($row1=mysql_fetch_array($result1)) 
		{
		?>
			<a href="../results.php?q=&section=<?=$row['id']?>&category=<?=$row1['id']?>&type=2&gid=<?=$_SESSION['gid']?>" target="_parent"><?=$row1['title']?></a><br>
		<?
        }
		echo "<hr />";
	}
	?></td>
    <td><?
	for($i=$num;$i!=0;$i--)
	{
		$row=mysql_fetch_array($result);
    	echo "<b>".$row['title'].'</b><br>'.'<br>';
		$q="select * from jos_categories where section=".$row['id'];
		$result1=mysql_query($q) or die('');
		while($row1=mysql_fetch_array($result1)) 
		{
		?>
			<a href="../results.php?q=&section=<?=$row['id']?>&category=<?=$row1['id']?>&type=2&gid=<?=$_SESSION['gid']?>" target="_parent"><?=$row1['title']?></a><br>
		<?
        }
		echo "<hr />";
	}
	?></td>
  </tr>
</table>