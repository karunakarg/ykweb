<?
$query=$_GET['q'];
$sec=$_GET['section'];
$cat=$_GET['category'];
//$brand='any';

$pl=$_GET['pl'];
$ph=$_GET['ph'];
$war=$_GET['war'];
$pn=$_GET['pn'];
$age=$_GET['age'];

//*******************************security measures********************
$query=preg_replace('/[^A-Za-z0-9 ]/','',$query); //disallow anything but characters and numerals
if(!is_numeric($sec)&&$sec!='any')
	die('1');
if(!is_numeric($cat)&&$cat!='any')
	die('2');
$adv_search_params="";

if(isset($pl))
{
	if(!is_numeric($pl)&&$pl!='any')
		die('3');
	else
		$adv_search_params=$adv_search_params.'&pl='.$pl;
}
if(isset($ph))
{
	if(!is_numeric($ph)&&$ph!='any')
		die('4');
	else
		$adv_search_params=$adv_search_params.'&ph='.$ph;
}
if(isset($war))
{
	if($war!='yes'&&$war!='no'&&$war!='any')
		die('5');
	else
		$adv_search_params=$adv_search_params.'&war='.$war;
}
if(isset($pn))
{
	if($pn!='yes'&&$pn!='no'&&$pn!='any')
		die('6');
	else
		$adv_search_params=$adv_search_params.'&pn='.$pn;
}
if(isset($age))
{
	if(!is_numeric($age)&&$age!='')
		die('7');
	else
		$adv_search_params=$adv_search_params.'&age='.$age;
}
//**********************************************************************
if($page>1)
{
	$aid=$_GET['aid'];
	$aid=base64_decode($aid);
	$aid=explode('_',$aid);
	$num=$_GET['num'];
	$rnum=$_GET['rnum'];
	$queryy=$query;
}
else
{
	$q="INSERT INTO `search_log` (`id`, `query`, `sec`, `cat`, `brand`) VALUES (NULL, '".$query."', '".$sec."', '".$cat."', '".$brand."')";
mysql_query($q) or die('MySQL Error(query logging mod_jresult)!!');

$rnum=0;
$aid=array();
$i=0;
$ex='';

if($sec=='any')
{
	$ex='';
}
else
{
	if($cat=='any')
	{
		$ex='section="'.$sec.'" AND';
	}
	else
	{
		$ex='section="'.$sec.'" AND category="'.$cat.'" AND';
	}
}
if(is_numeric($pl)&&$ph!=0)
{
	$ex=$ex.' sp BETWEEN '.$pl.' AND '.$ph.' AND';
}
if($pn=='yes'||$pn=='no')
{
	$ex=$ex.' pn="'.$pn.'" AND';
}
if($war=='yes'||$war=='no')
{
	$ex=$ex.' warranty="'.$war.'" AND';
}
if(is_numeric($age))
{
	$ex=$ex.' age < '.$age.' AND';
}

$q="SELECT id FROM `ads` WHERE `group`=".$_SESSION['gid']." AND ".$ex." `title` LIKE '%".$query."%' ORDER BY id desc";
//echo $q;
$result=mysql_query($q) or die('MySQL Error(search1)!!');
$rnum=mysql_num_rows($result);

while($row=mysql_fetch_array($result))
{
	$aid[$i]=$row['id'];
	$i++;
}
$queryy=$query;
$query=explode(' ',$query);

foreach($query as $qry)
{
	$q="SELECT id FROM `ads` WHERE `group`=".$_SESSION['gid']." AND ".$ex." `title` LIKE '%".$qry."%' ORDER BY id desc";
	$result=mysql_query($q) or die('MySQL Error(search2)!!');
	$rnum+=mysql_num_rows($result);
	
	while($row=mysql_fetch_array($result))
	{
		$aid[$i]=$row['id'];
		$i++;
	}
}

$aid=array_unique($aid);
$rnum=count($aid);
$num=$rnum;
}

if($num)
{
	if($num<$limit)
	{
		$lim=$startpoint+$num;
	}
	else
	{
		$num=$num-$limit;
		$lim=$startpoint+$limit;
	}
	?>
    <table width="797" border="0" cellspacing="0">
    <?
	$sno=$startpoint;
	for($i=$startpoint;$i<$lim;$i++)
	{
		if($aid[$i])
		{
			$q="SELECT * FROM `ads` WHERE `id`=".$aid[$i];
			$result=mysql_query($q) or die('MySQL Error(111)!!');
			$row=mysql_fetch_array($result);
			
			$q="SELECT id,alias,state,hits FROM `jos_content` WHERE `aid`=".$aid[$i];
			$resultt=mysql_query($q) or die('MySQL Error(112)!!');
			$roww=mysql_fetch_array($resultt);
			
			if($roww['state']) //if published
			{
				$artid=$roww['id'];
				
				$link="viewad.php?id=".$roww['id']."&&item=".$roww['alias'];
				
		?>
	      <tr>
        <td width="21" rowspan="6"><?=$sno+1?>.)</td>
        <td width="144" rowspan="5"><a href="<?=$link?>"><img src="<?=$row['timg']?>" width="140" height="140" style="border:double" /></a></td>
        <td colspan="2"><font size="+1"><a href="<?=$link?>" target="_new"><?=$row['title']?></a></font>&nbsp;<font color="#666666">(<?=$roww['hits']?> views)</font></td>
      </tr>
	      <tr>
	        <td width="411" class="cs"><? echo substr($row['info'],0,150)."..."?></td>
	        <td width="213"><font size="+1" color="#FF6600">Rs <?=$row['sp']?>/-</font>
            <?
    			if($row['pn']=='yes')
				{
					echo '( Price Negotiable )';
				}
			?>
            </td>
      </tr>
	      <tr>
	        <td><strong>Age : </strong>
      <?=$row['age']?> months old</td>
	        <td><!-- <a data-lightbox="width:1000;height:700" href="kart/contact.php?aid=<?=$row['id']?>" class="myButton">Contact Seller</a> --></td>
      </tr>
	      <tr>
	        <td><strong>Under Warranty : </strong><?=$row['warranty']?></td>
	        <td>&nbsp;</td>
      </tr>
	      <tr>
	        <td colspan="2"><font size="-1" color="#333333">Posted On :</font> <font size="-1" color="#666666"><?=$row['date']?></font> &nbsp;&nbsp;<font size="-1" color="#333333">under</font>&nbsp;: <font size="-1" color="#666666"><?=getsec($row['section'])?> &gt;&gt; 
    <a href="results.php?q=&section=<?=$row['section']?>&category=<?=$row['category']?>" target="_parent"><?=getcat($row['category'])?></a></font></td>
      </tr>
	      <tr>
	        <td width="144"><hr  /></td>
	        <td colspan="2"><hr  /></td>
      </tr>
      
	  <?
	  			$sno++;
			}
		}
	}
	?>
</table>
<p>
  <?
//******************************************************PAGINATION ************************88
$aid=implode('_',$aid);
$aid=base64_encode($aid);
$uri='q='.$queryy.'&button=Search'.$adv_search_params;
echo pagination($rnum,$limit,$page,$url='?'.$uri.'&type='.$_GET['type'].'&aid='.$aid.'&num='.$num.'&rnum='.$rnum.'&'.'&gid='.$_SESSION['gid'].'&'.'&section='.$sec.'&'.'&category='.$cat.'&');
/////////////////////////////////////////////////////////////////////////////////////////////
}
else
{
	echo "<br><br>Your Search returned an empty result !!";
	?>
    <a href="request.php">Post a request for this Item</a></br></br>
    <?
}

?>
</p>