<?php

$alias=array();

		$q="SELECT * FROM `groups`";
		$result=mysql_query($q) or die('MySQL Error(curcol)!!');
		$count=mysql_num_rows($result);
?>

                          <table width="<?=60*$count?>" border="1">
  <?
  
  while($row=mysql_fetch_array($result)) 
  {$i=0;
     $alias[$i]=$row['alias'];
    
        $link="index.php?gid=".$row['id'];
      
?>
  <tr>
    <td>
    <center>
    <a href="<?=$link?>"><img 
    <?
    if($row['id']==$_SESSION['gid'])
    echo 'style="border:double #F00"';
  ?>
    width="70" height="70" src="kart/groupimage/<?=$row['pic']?>" /></a></center></td>
    <td>&nbsp;</td>
    <?
  $i++;
    $row=mysql_fetch_array($result);
  $alias[$i]=$row['alias'];
  ?>
    <td>
        <center>
    <a href="<?=$link?>"><img <?
    if($row['id']==$_SESSION['gid'])
    echo 'style="border:double #F00"';
  ?>width="70" height="70" src="kart/groupimage/<?=$row['pic']?>" /></a></center></td>
  </tr>
  <tr>
  <?
  $j=0;
  foreach($alias as $a)
  {
  ?>
  <td><center><?=$a?></center></td>
    <?
    if($j==0){
  ?>
    <td>&nbsp;</td>
  <?
  }
  $j++;
  } // foreach end
  ?>
  </tr>
  <?
 } //while loop end
  ?>
</table>
</br>
&nbsp;&nbsp;<a class="btn btn-success" href="addcampus.php">Add Your College</a>