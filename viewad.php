<? session_start(); 
include_once('kart/kartlib.php');
$id=$_GET['id'];
  $id_bak = $id;
  if(is_numeric($id))
  {
    $q="SELECT `alias`,`metadesc`,`metakey`,`aid`,`hits`,`visitors` FROM `jos_content` WHERE `id`=".$id;
    $result=mysql_query($q) or die('MySQL Error(1)!!');
    $row=mysql_fetch_array($result);
  }
  else
  {
    die('Invalid Ad Id !!');
  }

  $id=$row['aid'];
  $ad=getad($id);


  $hits=$row['hits'];
  $hits = $hits+1;
  $visitors = $row['visitors'];
  $visited = 0;

  if (!isset($_SESSION['ip'])) { // if new user
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
  }
  if (!isset($_SESSION['visited'])) {
    $_SESSION['visited'] = array();
  }

  if ($_SESSION['visited'][$id_bak]==1) {
    $visited = 1;
  }
  else{
    $visited = 0;
    $_SESSION['visited'][$id_bak] = 1;
  }

  if ($visited == 0) {
    $visitors = $visitors+1;
    $q="UPDATE `jos_content` SET `hits` = '$hits', `visitors` = '$visitors' WHERE `id` =".$_GET['id'];
  }
  else
  {
    $q="UPDATE `jos_content` SET `hits` = '$hits' WHERE `id` =".$_GET['id'];
  }
   mysql_query($q) or die('error updating hits');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title><?=$ad['title']?> | YourKart.com</title>
        <meta name="description" content="<?=$ad['title']?> - <?=$row['metadesc']?>" />
        <meta name="keys" content="<?=$row['metakey']?>" />
    <?
      include('inc.php');
    ?>
        
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
    <body>

<?
  include('header.php');
  

?>
<!-- Begin Body -->
<div id="wrap">   
<div class="container">
	<div class="row">
  			<div class="col-md-3" id="leftCol">
              
              	<? include('sidebar.php'); ?>
              
      		</div>  
      		<div class="col-md-9">
              	<br>
              	<div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                       
                      <div class="panel-heading"><b><font size="+1" color="#333333"><a href="viewad.php?id=<?=$_GET['id']?>&&item=<?=$_GET['item']?>"><?=$ad['title']?></a></font></b>&nbsp;<b><font color="#666666">(<?=$hits?> views)</font></b> <fb:like href="http://www.yourkart.com/viewad.php?id=<?=$_GET['id']?>&&item=<?=$row['alias']?>" send="true" layout="button_count" width="450" show_faces="false" font="arial"></fb:like></div>
                      <div class="panel-body">

                        <? include('pm.php'); ?>
                        <? include('viewad_content.php'); ?>
                      </div>
                    </div>
                  </div> 
              	</div>
              
              	<hr>
              
              	
      		</div> 
  	</div>
</div>



        
<div id="fb-root"></div>
<script>
function getXMLHTTP() { //fuction to return the xml http object
    var xmlhttp=false;  
    try{
      xmlhttp=new XMLHttpRequest();
    }
    catch(e)  {   
      try{      
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e){
        try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e1){
          xmlhttp=false;
        }
      }
    }
      
    return xmlhttp;
    }
    
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '154894791343035', // App ID
      channelURL : 'www.yourkart.com/channel.php', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      oauth      : true, // enable OAuth 2.0
      xfbml      : true  // parse XFBML
    });
var req = getXMLHTTP();
var strURL="http://www.yourkart.com/kart/mail.php?to="+<?=$ad['artid']?>;
    // Additional initialization code here
    FB.Event.subscribe('comment.create',function(response) {
        req.open("GET", strURL, true);req.send(null);
    }
);
    
  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     d.getElementsByTagName('head')[0].appendChild(js);
   }(document));
</script>

<div id="push"></div>
</div>
  <? include('footer.php'); ?>
    <? include('endinc.php'); ?>
    </body>
</html>