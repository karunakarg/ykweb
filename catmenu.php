<?
$q1="select * from jos_sections order by ordering";
$result=mysql_query($q1) or die('sql err group cat 1');

?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><b>Categories</b></div>
      <div class="panel-body">
        <ul class="nav nav-stacked nav-pills" id="sidebar">
          <?
            while($row=mysql_fetch_array($result)){

          ?>
          <li <? if($_GET['section']==$row['id']) echo 'class="active"'; ?> ><a href="results.php?q=&section=<?=$row['id']?>&category=any&type=2&gid=<?=$_SESSION['gid']?>" target="_parent"><?=$row['title']?></a></li>
          <? } ?>
        </ul>          
      </div>
    </div>
  </div>
</div>
