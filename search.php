<?php
//session_start();

if(isset($_SESSION['gid']))
{
  $gid=$_SESSION['gid'];
}
else
  $gid=0;
if($gid)
{
//$id=trim($params->get('id'));
$mode=$_GET['mode'];
?>
<div class="col-lg-3 hidden-sm hidden-xs">
     <form class="navbar-form navbar-left" role="search" method="get" action="results.php">
          <input name="gid" type="hidden" id="gid" value="<?=$_SESSION['gid']?>" />
          <input name="section" type="hidden" id="section" value="any" />
          <input name="category" type="hidden" id="category" value="any" />
          <input name="type" type="hidden" id="type" value="1" />
    <div class="input-group">
          <input type="text" name="q" class="form-control visible-sm visible-xs col-sm-3" placeholder="Search for an item">
          <input type="text" size="30" name="q" class="form-control visible-md visible-lg" placeholder="Search for an item">
      <span class="input-group-btn">
        <button type="submit" name="button" id="button" value="Search" class="btn btn-warning"><i class="fa fa-search"></i></button>
      </span>
    </div><!-- /input-group -->

      </form>
</div>
<?
}
else
  echo "<font color='white'>Select a group from Group List to enable Search</font>";
?>
