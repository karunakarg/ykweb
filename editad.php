<? session_start(); 
include_once('kart/kartlib.php');
include('kart/simpleimage.php');
$unique_id=$_GET['token'];
//get data on basis of uniq id
if(strlen($unique_id)!=0)
{
  $q="select * from ads where uniqueid='$unique_id'";
  $result=mysql_query($q) or die('editad');
  $row=mysql_fetch_array($result);
  if(mysql_num_rows($result)==0)
  {
    error('Invalid ID');
    die();
  }
  $aid=$row['artid'];
  $title=$row['title'];//
  $age=$row['age'];//
  $section=$row['section'];
  $group=$row['group'];
  $category=$row['category'];
  $sp=$row['sp'];//
  $info=$row['info'];//
  $warranty=$row['warranty'];//
  $pn=$row['pn'];//
  $date=$row['date'];
  $email=$row['email'];//
  $contact=$row['contact'];//
  $timg=$row['timg'];
  $mimg=$row['mimg'];//
  $img1=$row['img1'];//
  $img2=$row['img2'];//
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Edit Ad - YourKart.com</title>
        
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
                       
                      <div class="panel-heading"><b><font size="+1" color="#333333"><a href="viewad.php?id=<?=$_GET['id']?>"><?=$title?></a></font></b>&nbsp; <fb:like href="http://www.yourkart.com/viewad.php?id=<?=$_GET['id']?>&&item=<?=$row['alias']?>" send="true" layout="button_count" width="450" show_faces="false" font="arial"></fb:like></div>
                      <div class="panel-body">

                        <? include('editad_content.php'); ?>
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
 <? include('footer.php'); ?>
    <? include('endinc.php'); ?>
    </body>
</html>