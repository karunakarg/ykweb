<?
include('sqlcon.php');
$id=$_GET['to'];
if(isset($id)) {
$q="select title,email from ads where artid=$id";
$result=mysql_query($q) or die('mail');
$row=mysql_fetch_array($result);
$to=$row['email'];
$title=$row['title'];
$sub="[YourKart] New comment on your Ad !";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: YourKart <noreply_notif@yourkart.com>' . "\r\n";

$msg = '<html>New Comment on your Ad : <a href="http://www.yourkart.com/index.php?option=com_content&view=article&id='.$id.'">'.$title.'</a></html>';
mail($to,$sub,$msg,$headers);
}
?>