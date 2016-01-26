<?php
include('framework.php');
include('sqlcon.php');
include('kartlib.php');

$id=$_GET['id'];
$ad=getad($id);


?>
<script type="text/javascript" src="lightbox.js"></script>
<table width="700" border="0">
  <tr>
    <td><b><font size="+2" color="#333333"><?=$ad['title']?></font></b></td>
  </tr>
</table>
<table width="700" border="0">
  <tr>
    <td width="200"><font size="-1" color="#666666">Click on Pictures to Enlarge them</font></td>
    <td width="500"><font size="-1" color="#333333">Posted On :</font> <font size="-1" color="#666666"><?=$ad['date']?></font> &nbsp;&nbsp;&nbsp;&nbsp;<font size="-1" color="#333333">under</font>&nbsp;: <font size="-1" color="#666666"><?=getsec($ad['section'])?> &gt;&gt; 
    <?=getcat($ad['category'])?> &gt;&gt; 
    <?=getbrand($ad['brand'])?></font></td>
  </tr>
</table>
<table width="711" border="0">
  <tr>
    <td width="304" rowspan="3"><a href="<?=$ad['mimg']?>" rel="lightbox"><img src="<?=$ad['mimg']?>" width="300" style="border:double" /></a></td>
    <td width="397">Selling at &nbsp;<font size="+1" color="#CC0000" style="text-decoration:line-through">Rs <?=$ad['mp']?></font>&nbsp;&nbsp;<font size="+2" color="#FF6600">Rs <?=$ad['sp']?></font>
    <?
    if($ad['pn']=='yes')
	{
		echo '( Price Negotiable )';
	}
	?>
    </td>
  </tr>
  <tr>
    <td><strong>Age : </strong>
      <?=$ad['age']?> months old
    <font><?
    if($ad['warranty']=='yes')
	{
		echo '( Under Warranty Period )';
	}
	?></font>
    </td>
  </tr>
  <tr>
    <td><table width="380" border="0" bordercolor="#000000" style="border:solid">
      <tr>
        <td colspan="3" bgcolor="#999999"><strong>Seller Information :</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td bgcolor="#CCCCCC">Name :</td>
        <td><?=$ad['name']?></td>
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
      <tr>
        <td width="29">&nbsp;</td>
        <td width="90" bgcolor="#CCCCCC">College :</td>
        <td width="239"><?=getgroup($ad['group'])?></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="700" border="0">
  <tr>
    <td width="150" rowspan="2"><a href="<?=$ad['img1']?>" rel="lightbox"><img src="<?=$ad['img1']?>" alt="" width="150" border="1" /></a></td>
    <td width="150" rowspan="2"><a href="<?=$ad['img2']?>" rel="lightbox"><img src="<?=$ad['img2']?>" alt="" width="150" border="1"  /></a></td>
    <td width="400"><strong>Additional Information :</strong></td>
  </tr>
  <tr>
    <td><font color="#333333"><?=$ad['info']?></font></td>
  </tr>
</table>
