<?php

include_once('kart/kartlib.php');
//$uid="{$user->id}";
$uid = $_GET['admin'];
if($uid==62||$uid==63||$uid==64||$uid==1)
{
	$admin=1;
}
else
{
	$admin=0;
}
?>
<style type="text/css">
<!--
.myButton {
  -moz-box-shadow:inset 0px 1px 0px 0px #c1ed9c;
  -webkit-box-shadow:inset 0px 1px 0px 0px #c1ed9c;
  box-shadow:inset 0px 1px 0px 0px #c1ed9c;
  background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #9dce2c), color-stop(1, #8cb82b) );
  background:-moz-linear-gradient( center top, #9dce2c 5%, #8cb82b 100% );
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#9dce2c', endColorstr='#8cb82b');
  background-color:#9dce2c;
  -moz-border-radius:6px;
  -webkit-border-radius:6px;
  border-radius:6px;
  border:1px solid #83c41a;
  display:inline-block;
  color:#ffffff;
  font-family:arial;
  font-size:15px;
  font-weight:bold;
  padding:6px 24px;
  text-decoration:none;
  text-shadow:1px 1px 0px #689324;
}.myButton:hover {
  background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8cb82b), color-stop(1, #9dce2c) );
  background:-moz-linear-gradient( center top, #8cb82b 5%, #9dce2c 100% );
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8cb82b', endColorstr='#9dce2c');
  background-color:#8cb82b;
}.myButton:active {
  position:relative;
  top:1px;
}
.seller {
  font-family: "Comic Sans MS", cursive;
}
.rev {
  font-size: 12px;
}
.cs {
  font-family: "Comic Sans MS", cursive;
  font-size: 14px;
}
-->
</style>
<?

$link="../viewad.php/".$row['alias']."/?id=".$id;

$q="SELECT * FROM `groups` WHERE id=".$ad['group'];
$result=mysql_query($q) or die('sql error mod_group 1');
$row=mysql_fetch_array($result);

$group_link="index.php?n=".get_alias($row['alias'])."&&gid=".$row['id'];

?>
    <?
    if($admin)
	{
		?>
        <a href="delete_ad.php?token=<?=$ad['uniqueid']?>" target="_new">Delete Ad</a> <a href="editad.php?token=<?=$ad['uniqueid']?>" target="_blank">Edit Ad</a>
        <?
	}
	?>
<table width="700" border="0">
  <tr>
    <td width="200"><font size="-1" color="#666666">Click on Pictures to Enlarge them</font></td>
    <td width="500" align="right"><font size="-1" color="#333333">Posted On :</font> <font size="-1" color="#666666"><?=$ad['date']?></font> &nbsp;&nbsp;<font size="-1" color="#333333">under</font>&nbsp;: <font size="-1" color="#666666"><?=getsec($ad['section'])?> &gt;&gt; 
    <a href="results.php?q=&type=2&section=<?=$ad['section']?>&category=<?=$ad['category']?>" target="_parent"><?=getcat($ad['category'])?></a></font></td>
  </tr>
</table>
<table width="711" border="0">
  <tr>
    <td width="304" rowspan="8"><a data-toggle="modal" data-target="#mimg" href="<?=$ad['mimg']?>"><img class="img-responsive" src="<?=$ad['mimg']?>" width="300" style="border:double" /></a></td>
    <td>Location :</td>
    <td><a href="<?=$group_link?>"><?=$row['name']?></a></td>
  </tr>
  <tr>
    <td><strong>Selling at :</strong></td>
    <td><font size="+2" color="#FF6600">Rs
        <?=$ad['sp']?>
    </font>
 &nbsp;&nbsp;&nbsp; <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#contact">
  Contact Seller
</button></td>
  </tr>
  <tr>
    <td width="125"><strong>Age :</strong></td>
    <td width="268"><strong> </strong>
      <?=$ad['age']?>
months old</td>
  </tr>
  <tr>
    <td><strong>Under Warranty :</strong></td>
    <td><?=$ad['warranty']?></td>
  </tr>
  <tr>
    <td><strong>Price Negotiable :</strong></td>
    <td><?=$ad['pn']?></td>
  </tr>
  
  <tr>
    <td><strong>Contact No.</strong></td>
    <td><?=$ad['contact']?></td>
  </tr>
  <tr>
    <td colspan="2"></tr>
</table>
<table width="700" border="0">
  <tr>
    <td width="150" rowspan="3"><a data-toggle="modal" data-target="#img1" href="<?=$ad['img1']?>"><img class="img-responsive" src="<?=$ad['img1']?>" alt="" width="150" border="1" /></a></td>
    <td width="150" rowspan="3"><a data-toggle="modal" data-target="#img2" href="<?=$ad['img2']?>"><img class="img-responsive" src="<?=$ad['img2']?>" alt="" width="150" border="1"  /></a></td>
    <td width="400"><strong>Additional Information :</strong></td>
  </tr>
  <tr>
    <td><font color="#333333"><?=$ad['info']?></font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<div class="modal fade" id="mimg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=$ad['title']?></h4>
      </div>
      <div class="modal-body" align="center">
        <!-- Carousel start -->
            <img class="img-responsive" src="<?=$ad['mimg']?>" data-toggle="modal" data-target="#img1" data-dismiss="modal"/>
        <!-- Carousel End -->
      </div>
      <div class="modal-footer">
        <a class="btn btn-success" href="<?=$ad['mimg']?>" target="_blank">Full Image</a>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#img2" data-dismiss="modal">Prev</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#img1" data-dismiss="modal">Next</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="img1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=$ad['title']?></h4>
      </div>
      <div class="modal-body" align="center">
        <!-- Carousel start -->
            <img class="img-responsive" src="<?=$ad['img1']?>" data-toggle="modal" data-target="#img2" data-dismiss="modal"/>
        <!-- Carousel End -->
      </div>
      <div class="modal-footer">
        <a class="btn btn-success" href="<?=$ad['img1']?>" target="_blank">Full Image</a>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mimg" data-dismiss="modal">Prev</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#img2" data-dismiss="modal">Next</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="img2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=$ad['title']?></h4>
      </div>
      <div class="modal-body" align="center">
        <!-- Carousel start -->
            <img class="img-responsive" src="<?=$ad['img2']?>" data-toggle="modal" data-target="#mimg" data-dismiss="modal"/>
        <!-- Carousel End -->
      </div>
      <div class="modal-footer">
        <a class="btn btn-success" href="<?=$ad['img2']?>" target="_blank">Full Image</a>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#img1" data-dismiss="modal">Prev</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mimg" data-dismiss="modal">Next</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Contact Seller</h4>
      </div>
      <div id="target" class="modal-body">
                                <form id="pm" name="pm" method="post" role="form" data-async data-target="#contact" method="POST">
                                  
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email" required>
                          </div><!-- 
                          <div class="form-group">
                            <label for="ph">Contact No.</label>
                            <input name="ph" type="number" class="form-control" id="ph" placeholder="Your Contact No." required>
                          </div> -->
                          <div class="form-group">
                            <label for="exampleInputPassword1">Message</label>
                            <textarea class="form-control" id="msg" name="message" placeholder="Enter your message here" rows="3" required></textarea>
                          </div>
                          

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="send" class="btn btn-primary">Send Message</button>
      </div>
</form>

    </div>
  </div>
</div>
<p><!-- 
<b>Comments<b>
</p>
<div class="fb-comments" data-href="http://www.yourkart.com/viewad.php?id=<?=$_GET['id']?>" data-width="600" data-num-posts="10"></div> -->