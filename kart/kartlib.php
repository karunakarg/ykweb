<?
include_once('sqlcon.php');
if( ! ini_get('date.timezone') )
{
   date_default_timezone_set('Asia/Calcutta');
}
//ldfnldjg8fdugofdijv34dfj09
// signal value RnVjayBZb3UgSGFja2VyISE=
//**************************mail wrapper***************************
function ykmail($to, $from, $subject, $message)
{
	$issmtp = getset('usesmtp');
	$date = date('d/m/Y');

	if ($issmtp == 0) {
		$headers = 'MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From: YourKart <noreply_notif@yourkart.com>'."\r\n";
		$headers .="Message-ID: <".md5($date)."@..................>"."\r\n";
		$headers .= "Reply-To: $from"."\r\n";
		$headers .= "Return-Path: admin@yourkart.com"."\r\n";
		$headers .= "X-Priority: 3\r\nX-MSMail-Priority: Normal"."\r\n";
		$headers .= "X-Mailer: PHP/".phpversion()."\r\n";
												
		
		mail($to, $subject, $message, $headers);
	}
	else //smtp is enabled
	{
		 $host = getset('smtphost');
		 $port = getset('smtpport');
		 $username = getset('smtpuname');
		 $password = getset('smtppass');
		 
		 $headers = array ('MIME-Version' => '1.0rn',
        	'Content-Type' => "text/html; charset=ISO-8859-1rn",
        'From' => 'Yourkart.com <noreply@yourkart.com>',
        'To' => $to,
        'Subject' => $subject);

		 $smtp = Mail::factory('smtp',
		   array ('host' => $host,
		     'port' => $port,
		     'auth' => true,
		     'username' => $username,
		     'password' => $password));
		 
		 $mail = $smtp->send($to, $headers, $message);
	}
}

//**************************Create Joomla Style Alias**************
function get_alias($str)
{
	$str=strtolower($str);
	$alias=str_replace('&','n',$str);
	$alias=preg_replace('/[^A-Za-z0-9]/','-',$str);
	return $alias;
}
//**************************add to delete queue********************
function delete($path)
{
	if(strpos($path,'kart/nimg.jpg')==FALSE)
	{
		$q="INSERT INTO `delete` (`id`, `path`) VALUES (NULL, '$path')";
		mysql_query($q) or die('delete img');
		return 1;
	}
	else
		return 0;
}
//****************************SHow if error ***********************
function show_on_error($error,$data)
{
	if($error)
	{
		echo $data;
	}
}

//****************************Check active ad**********************
function check_active($id)
{
	$q="select state from jos_content where id=$id";
	$result=mysql_query($q) or die('sqlerr check-active kartlib');
	$row=mysql_fetch_array($result);
	return $row['state'];
}
//****************************Verify Parent*************************
function verifyparent()
{
	if(!checkurl())
	{
		error('Access Denied! Try to refresh the page');
		die();
	}
	signalurl();
}
function checkurl()
{
	$url=base64_decode(base64_decode(base64_decode($_SESSION['ldfnldjg8fdugofdijv34dfj09'])));
	if(strpos($url,'com_wrapper')==FALSE)
	{
		if(strpos($url,'com_content')==FALSE)
		{
			return 0;
		}
		else
			return 1;
	}
	else
		return 1;
}
function signalurl()
{
	$_SESSION['ldfnldjg8fdugofdijv34dfj09']='RnVjayBZb3UgSGFja2VyISE=';
}
//****************************Current URL****************************
function cururl() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
//******************************Check Requests***********************
function check_requests($title,$artid,$gid,$sec,$cat)
{
	$title_bak=$title;
	$title=preg_replace('/[^A-Za-z0-9 ]/','',$title);
	$title=explode(' ',$title);
	
	$id=array();
	$i=0;
	foreach($title as $keyword)
	{
		$q="select id from request_keywords where keyword='$keyword' and sec=$sec and cat=$cat";
		$result=mysql_query($q) or die('sqlerr check_req kartlib');
		while($row=mysql_fetch_array($result)) 
		{
			$id[$i]=$row['id'];
			$i++;
		}
	}
	$id=array_unique($id);
	
//	echo $id[0];
	foreach($id as $rid)
	{
		$q="select email from requests where id=$rid and gid=$gid";
		$result=mysql_query($q) or die('sqlerr check_req sendmail kartlib');
		$row=mysql_fetch_array($result);
		
		$body="<html><p>Hi ,</p>
<p>Looks like someone is selling what you were looking for. This item's title matched with one or more keywords </p>
<p>you mentioned in your request. Check out the link below :</p>
<p><a href=".'"'."http://www.yourkart.com/viewad.php?id=$artid".'"'.">".$title_bak."</a></p>
<p>Regards</p>
<p>YourKart Team</p></html>";

		$to=$row['email'];
		$sub="Ad matching your request found ! [YourKart]";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: YourKart <request_notif@yourkart.com>' . "\r\n";
		
		mail($to,$sub,$body,$headers);
	}
	

}
//******************************Leave Joined Group*******************
function leavegroup($uid,$gid)
{
	//check if joined
	if(checkjoin($uid,$gid))
	{
		//remove as a group member
		$q="DELETE FROM `group_members` WHERE `group_members`.`uid` = $uid AND `group_members`.`gid` = $gid";
		mysql_query($q) or die('leavegroup sqlerr1');
		//decrement member count in group
		$q="SELECT `members` FROM `groups` WHERE `id`=$gid";
		$result=mysql_query($q) or die('leavegroup sqlerr2');
		$row=mysql_fetch_array($result);
		
		$mem=$row['members']-1;
		$q="UPDATE `groups` SET  `members` =  '$mem' WHERE  `groups`.`id` =$gid";
		$result=mysql_query($q) or die('leave group sqlerr3');
	}
	else
	{
		error('You are not a member of this group !!');
		}
	
}
//******************************Join Group*******************
function joingroup($uid,$gid)
{
	//add as a group member
	$q="INSERT INTO `group_members` (`uid`, `gid`) VALUES ('$uid', '$gid');";
	mysql_query($q) or die('joingroup sqlerr1');
	//increment member count in group
	$q="SELECT `members` FROM `groups` WHERE `id`=$gid";
	$result=mysql_query($q) or die('joingroup sqlerr2');
	$row=mysql_fetch_array($result);
	
	$mem=$row['members']+1;
	$q="UPDATE `groups` SET  `members` =  '$mem' WHERE  `groups`.`id` =$gid";
	$result=mysql_query($q) or die('join group sqlerr3');
}
//******************************Check Joined Group*******************
function checkjoin($uid,$gid)
{
	$q="SELECT * FROM `group_members` WHERE `uid`=$uid AND `gid`=$gid";
	$result=mysql_query($q) or die();
	if(mysql_num_rows($result))
	{
		return 1;
	}
	else return 0;

}
//******************************Get Group Name***********************
function getgroup($id)
{
	$q="SELECT name FROM `group` WHERE `id`=".$id;
	$result=mysql_query($q) or die('MySQL Error(getcol)!!');
	$row=mysql_fetch_array($result);
	return $row['name'];
}
//******************************Get Section***********************
function getsec($id)
{
	$q="SELECT title FROM `jos_sections` WHERE `id`=".$id;
	$result=mysql_query($q) or die('MySQL Error(getsec)!!');
	$row=mysql_fetch_array($result);
	return $row['title'];
}
//******************************Get Category***********************
function getcat($id)
{
	$q="SELECT title FROM `jos_categories` WHERE `id`=".$id;
	$result=mysql_query($q) or die('MySQL Error(getcat)!!');
	$row=mysql_fetch_array($result);
	return $row['title'];
}
//******************************Get Brand***********************
function getbrand($id)
{
	$q="SELECT name FROM `brand` WHERE `bid`=".$id;
	$result=mysql_query($q) or die('MySQL Error(getbrand)!!');
	$row=mysql_fetch_array($result);
	return $row['name'];
}
//****************************** Check active ********************
function checkact($id)
{
	$uzere=getuser($id);
	if(!$uzere['active'])
	{
		error('Please Complete your profile first !!');
		message(' ');
		echo '<a href="'.kbase().'/index.php?option=com_wrapper&view=wrapper&Itemid=85" target="_parent">Click here to complete it now !!</a>';
		die();
	}
	
}
//******************************CREATE AD*************************8
function createad($title,$section,$category,$age,$sp,$info,$mimg,$img1,$img2,$group,$contact,$email,$warranty,$pn,$date,$timg)
{
	$created=date("Y-m-d").' 00:00:00';
	$day=date("d")-1;
	$publish_up=date("Y-m").'-'.$day.' 00:00:00';
	$uniqueid=get_rand_id(16);
	$q="INSERT INTO `ads` (`id`, `title`, `section`, `category`, `age`, `sp`, `info`, `mimg`, `img1`, `img2`, `group`, `contact`, `email`, `warranty`, `pn`, `date`, `uniqueid`, `timg`) VALUES (NULL, '$title', '$section', '$category', '$age', '$sp', '$info', '$mimg', '$img1', '$img2', '$group', '$contact', '$email', '$warranty', '$pn', '$date', '$uniqueid', '$timg')";
	mysql_query($q) or die('MySQL Error( Submit Ad )!!');
	
	$q="SELECT id FROM `ads` WHERE `uniqueid`='".$uniqueid."'";
	$result=mysql_query($q) or die('MySQL Error(3)!!');
	$row=mysql_fetch_array($result);
	
	$aid=$row['id'];
	$alias=get_alias($title);
	$mdesc=$info;
	$mkey=preg_replace('/^(A-Za-z0-9)*/',',',$title);
	if(!$uid)
	{
		$uid=62;
	}
	
	//$dt=strtotime($created)+($valid*24*3600);
//$valid=date("Y-m-d H:i:s", $dt);

	$q="INSERT INTO `jos_content` (
`id` ,
`title` ,
`alias` ,
`title_alias` ,
`introtext` ,
`fulltext` ,
`state` ,
`sectionid` ,
`mask` ,
`catid` ,
`created` ,
`created_by` ,
`created_by_alias` ,
`modified` ,
`modified_by` ,
`checked_out` ,
`checked_out_time` ,
`publish_up` ,
`publish_down` ,
`images` ,
`urls` ,
`attribs` ,
`version` ,
`parentid` ,
`ordering` ,
`metakey` ,
`metadesc` ,
`access` ,
`hits` ,
`metadata`,
`aid`
)
VALUES (
NULL , '".$title."', '".$alias."', '', '<p>{module View Ads}</p>', '', '1', '".$section."', '0', '".$category."', '".$created."', '".$uid."', '', '".$created."', '0', '0', '0000-00-00 00:00:00', '".$publish_up."', '0000-00-00 00:00:00', '', '', 'show_title=0
link_titles=0
show_intro=1
show_section=0
link_section=
show_category=0
link_category=
show_vote=0
show_author=0
show_create_date=0
show_modify_date=0
show_pdf_icon=0
show_print_icon=0
show_email_icon=0
language=en-GB
keyref=
readmore=', '1', '0', '1', '".$mkey."', '".$mdesc."', '0', '0', 'robots=
author=', '".$aid."'
)";
	
	$result=mysql_query($q) or die('MySQL Error(2)!!');
	
		$q="SELECT id FROM `jos_content` WHERE `aid`=".$aid;
		$resultt=mysql_query($q) or die('MySQL Error(112)!!');
		$roww=mysql_fetch_array($resultt);
	
	$q="UPDATE `ads` SET  `artid` =  '".$roww['id']."' WHERE  `ads`.`id` =$aid";
	$result=mysql_query($q) or die('sqlerr 121 createad');
	
	$q="INSERT INTO `ad_visibility` (`aid`, `gid`) VALUES ('$aid', '$group')";
	$result=mysql_query($q) or die('sqlerr 122 creatad');
	
	/*echo '<script type="text/javascript"> alert("Ad Submitted Successfully !!"); </script>';*/
	message('Ad Submitted Successfully !!  An e-mail with information regarding managing this Ad has been sent to you. If you can\'t find the email in your inbox then check your spam folder.');
	return $roww['id'].":".$uniqueid;
	
}
function kbase()
{
$q="SELECT `value` FROM `settings` WHERE `name`='sitename'";
$result=mysql_query($q) or die('MySQL Error(2)!!');
$row=mysql_fetch_array($result);
return $row['value'];
}
//*****************************Get Settings ********************

function getset($name)
{
	$q="SELECT `value` FROM `settings` WHERE `name`='".$name."'";
	$result=mysql_query($q) or die('MySQL Error(show setting)!!');
	$row=mysql_fetch_array($result);
	return $row['value'];
}
//****************************Get Extension***********************

function checkex($name)
{
	$res=preg_match('/[A-Za-z0-9]*.jpg|jpeg|png|bmp|gif|PNG|JPEG|JPG|GIF|BMP/',$name);
	if($res)
	{
		return 1;
	}
	else return 0;
}

//*************************Get User Info ******************************
function getuser($id)
{
	$q="SELECT * FROM `jos_users` WHERE `id`=$id";
	$result=mysql_query($q) or die('MySQL Error(user info)!!');
	$row=mysql_fetch_array($result);
	return $row;
}
//*************************************************GET STATE *****************
function getstate($id,$r=0)
{
if($id)
{
$q="SELECT * FROM `state` WHERE `sid`=$id";
$result=mysql_query($q) or die('MySQL Error(1)!!');
$row=mysql_fetch_array($result);
return $row['name'];
}
else
{
$q="SELECT * FROM `state`";
$result=mysql_query($q) or die('MySQL Error(1)!!');
$states=array();
$i=0;
if($r)
{
while($row=mysql_fetch_array($result))
{
	$states[$i]=$row['sid'].":".$row['name'];
	$i++;
}
}
else
{
while($row=mysql_fetch_array($result))
{
	$states[$i]=$row['name'];
	$i++;
}
}
return $states;
}
}
//*************************************GET CITY *******************************
function getcity($id,$sid,$r)
{
if($id)
{
$q="SELECT * FROM `city` WHERE `cid`=$id";
$result=mysql_query($q) or die('MySQL Error(1)!!');
$row=mysql_fetch_array($result);
return $row['name'];
}
else if($sid)
{
$q="SELECT * FROM `city` WHERE `sid`=$sid";
$result=mysql_query($q) or die('MySQL Error(1)!!');
$city=array();
$i=0;
if($r)
{
while($row=mysql_fetch_array($result))
{
	$city[$i]=$row['cid'].':'.$row['name'];
	$i++;
}
}
else
{
while($row=mysql_fetch_array($result))
{
	$city[$i]=$row['name'];
	$i++;
}	
}
return $city;
}
else
{
$q="SELECT * FROM `city`";
$result=mysql_query($q) or die('MySQL Error(1)!!');
$city=array();
$i=0;
if($r)
{
while($row=mysql_fetch_array($result))
{
	$city[$i]=$row['cid'].':'.$row['name'];
	$i++;
}
}
else
{
while($row=mysql_fetch_array($result))
{
	$city[$i]=$row['name'];
	$i++;
}	
}
return $city;
}
}
//***********************************************GETLOCALITY ****************************8
function getlocality($id,$cid,$r)
{
if($id)
{
$q="SELECT * FROM `locality` WHERE `lid`=$id";
$result=mysql_query($q) or die('MySQL Error(1)!!');
$row=mysql_fetch_array($result);
return $row['name'];
}
else if($cid)
{
$q="SELECT * FROM `locality` WHERE `cid`=$cid";
$result=mysql_query($q) or die('MySQL Error(1)!!');
$city=array();
$i=0;
if($r)
{
while($row=mysql_fetch_array($result))
{
	$city[$i]=$row['cid'].':'.$row['name'];
	$i++;
}
}
else
{
while($row=mysql_fetch_array($result))
{
	$city[$i]=$row['name'];
	$i++;
}	
}
return $city;
}
else
{
$q="SELECT * FROM `locality`";
$result=mysql_query($q) or die('MySQL Error(1)!!');
$city=array();
$i=0;
if($r)
{
while($row=mysql_fetch_array($result))
{
	$city[$i]=$row['cid'].':'.$row['name'];
	$i++;
}
}
else
{
while($row=mysql_fetch_array($result))
{
	$city[$i]=$row['name'];
	$i++;
}	
}
return $city;
}
}
//*****************************************GET AD ***********************
function getad($id)
{
	$q="SELECT * FROM `ads` WHERE `id`=".$id;
$result=mysql_query($q) or die('MySQL Error(getads)!!');
$row=mysql_fetch_array($result);
return $row;
}

//***************************************** CHECK EMAIL ******************
function checkemail($email)
{
	$apos=strpos($email,'@');
	$dotpos=strrpos($email,'.');
	if (($apos<1)||($dotpos-$apos<2))
	{
		return 0;
	}
	else
	{
		return 1;
	}
}
//************************************** RANDOM CODE GENERATOR***************

function assign_rand_value($num)
{
// accepts 1 - 36
  switch($num)
  {
    case "1":
     $rand_value = "a";
    break;
    case "2":
     $rand_value = "b";
    break;
    case "3":
     $rand_value = "c";
    break;
    case "4":
     $rand_value = "d";
    break;
    case "5":
     $rand_value = "e";
    break;
    case "6":
     $rand_value = "f";
    break;
    case "7":
     $rand_value = "g";
    break;
    case "8":
     $rand_value = "h";
    break;
    case "9":
     $rand_value = "i";
    break;
    case "10":
     $rand_value = "j";
    break;
    case "11":
     $rand_value = "k";
    break;
    case "12":
     $rand_value = "l";
    break;
    case "13":
     $rand_value = "m";
    break;
    case "14":
     $rand_value = "n";
    break;
    case "15":
     $rand_value = "o";
    break;
    case "16":
     $rand_value = "p";
    break;
    case "17":
     $rand_value = "q";
    break;
    case "18":
     $rand_value = "r";
    break;
    case "19":
     $rand_value = "s";
    break;
    case "20":
     $rand_value = "t";
    break;
    case "21":
     $rand_value = "u";
    break;
    case "22":
     $rand_value = "v";
    break;
    case "23":
     $rand_value = "w";
    break;
    case "24":
     $rand_value = "x";
    break;
    case "25":
     $rand_value = "y";
    break;
    case "26":
     $rand_value = "z";
    break;
    case "27":
     $rand_value = "0";
    break;
    case "28":
     $rand_value = "1";
    break;
    case "29":
     $rand_value = "2";
    break;
    case "30":
     $rand_value = "3";
    break;
    case "31":
     $rand_value = "4";
    break;
    case "32":
     $rand_value = "5";
    break;
    case "33":
     $rand_value = "6";
    break;
    case "34":
     $rand_value = "7";
    break;
    case "35":
     $rand_value = "8";
    break;
    case "36":
     $rand_value = "9";
    break;
  }
return $rand_value;
}

function get_rand_id($length)
{
  if($length>0) 
  { 
  $rand_id="";
   for($i=1; $i<=$length; $i++)
   {
   mt_srand((double)microtime() * 1000000);
   $num = mt_rand(1,39);
   $rand_id .= assign_rand_value($num);
   }
  }
return $rand_id;
}
//********************************************** Messages ******************
function message($msg)
{
	echo '<div class="success">'.$msg.'</div>';
}
function error($msg)
{
	echo '<div class="error">'.$msg.'</div>';
}
function info($msg)
{
	echo '<div class="info">'.$msg.'</div>';
}
function warning($msg)
{
	echo '<div class="warning">'.$msg.'</div>';
}
?>