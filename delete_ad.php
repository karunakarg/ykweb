<? session_start(); 

include('kart/kartlib.php');
include_once('kart/sqlcon.php');

$unique_id=$_GET['token'];
//get data on basis of uniq id
if($_POST['ch']=='Yes')
{
	$unique_id=$_POST['token'];
	$q="select id,artid,timg,mimg,img1,img2 from ads where uniqueid='$unique_id'";
	$result=mysql_query($q) or die('delete_ad sqlerr');
	$row=mysql_fetch_array($result);
	$ad_id=$row['id'];
	$art_id=$row['artid'];
	delete($row['mimg']);
	delete($row['timg']);
	delete($row['img1']);
	delete($row['img2']);
	$q1="DELETE FROM `ads` WHERE `ads`.`uniqueid` = '$unique_id'";
	$q2="DELETE FROM `ad_visibility` WHERE `ad_visibility`.`aid` = $ad_id";
	$q3="DELETE FROM `jos_content` WHERE `jos_content`.`id` = $art_id";
	mysql_query($q1) or die('delete_ad sqlerr 1');
	mysql_query($q2) or die('delete_ad sqlerr 2');
	mysql_query($q3) or die('delete_ad sqlerr 3');
	message('Ad Deleted Successfully !!');
}
else
{
	if($_POST['ch']=='No')
	{
		$unique_id=$_POST['token'];
	}
	$q="select artid,title from ads where uniqueid='$unique_id'";
	$result=mysql_query($q) or die('delete_ad sqlerr 0');
	$row1=mysql_fetch_array($result);
	if(mysql_num_rows($result)==0)
	{
		error('Invalid token Id !!');
		die();
	}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Delete Ad YourKart.com</title>
        
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
                       
                      <div class="panel-heading">Delete Ad</div>
                      <div class="panel-body">

                        
<form id="form1" name="form1" method="post" action="">
You are going to delete the following ad :<br />
<a href="viewad.php?id=<?=$row1['artid']?>" target="_blank"><?=$row1['title']?></a><br />
Are you Sure ? 
  <table width="200" border="0">
    <tr>
      <td><label>
        <input type="submit" class="btn btn-danger" name="ch" id="button" value="Yes" />
        <input name="token" type="hidden" id="hiddenField" value="<?=$unique_id?>" />
      </label></td>
      <td>&nbsp;</td>
      <td><input type="submit" class="btn btn-primary" name="ch" id="button2" value="No" /></td>
    </tr>
  </table>
</form>
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
    <? include('endinc.php'); }?>
    </body>
</html>