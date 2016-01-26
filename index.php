<? session_start();
if( ! ini_get('date.timezone') )
{
   date_default_timezone_set('Asia/Calcutta');
}
$gid=$_GET['gid'];

if(!isset($gid)){
  if (isset($_SESSION['gid'])) {
    $gid = $_SESSION['gid'];
  }
  else if (isset($_COOKIE['gid'])) {
    $_SESSION['gid'] = $_COOKIE['gid'];
    $gid = $_SESSION['gid'];
  }
  else
    $gid=0;
}
else{
  $_SESSION['gid'] = $gid;
  setcookie( "gid", $gid, strtotime( '+5000 days' ) ); 
}
$class = 'col-md-12';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Marketplace for college students |Buy/Sell used Mobile phones/Books| YourKart.com</title>
        <meta name="description" content="Buy/Sell/Trade used books/mobile phones/laptops/calculators etc. An online marketplace for students." />
    <?
      include('inc.php');
    ?>
        
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
    <body>
<?  include('header.php');  ?>
<!-- Begin Body -->

<div id="wrap">
<div class="container">
  <div class="row">
    <? if($gid!=0) { 
      $class = 'col-md-9';
      ?>
        <div class="col-md-3" id="leftCol">
              
                <? include('sidebar.php'); ?>
              
          </div>  
          <? }?>
          <div class="<?=$class?>">
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-heading" <? if($gid==0) echo 'align="center"'; ?>><b><? if($gid==0) echo "Select your college"; else echo "Ads from Selected College";?></b></div>
                      <div class="panel-body" <? if($gid==0) echo 'align="center"'; ?>>
                        <? if($gid==0) include('selectgroup.php'); else include('group.php'); ?>
                      </div>
                    </div>
                  </div> 
                </div>
                <hr>
          </div> 
    </div>
</div>
<div id="push"></div>
</div>
    <? include('footer.php'); ?>

    <? include('endinc.php'); ?>
    </body>
</html>