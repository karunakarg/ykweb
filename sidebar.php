<?
if (isset($_SESSION['gid'])) {
    $gid = $_SESSION['gid'];
  }
  else
    $gid=0;
?>
<div class="nav nav-stacked" id="sidebar2" style="width:228px;margin-top:20px;">
<?
include('grouplist.php');
?>

</div>
<?
if ($gid) {
?>
<div class="nav nav-stacked" id="sidebar">
<?
include('catmenu.php');
?>
</div>     
<?
}
?> 	