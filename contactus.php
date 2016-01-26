<? session_start(); 
include_once('kart/kartlib.php');
//include('kart/simpleimage.php');


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title> YourKart.com</title>
        
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
                       
                      <div class="panel-heading">Contact Us</div>
                      <div class="panel-body">

                        <? include('contact_content.php'); ?>
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