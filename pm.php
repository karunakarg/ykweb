<?
if (isset($_POST['send'])) {
	//$name = strip_tags($_POST['name']) ;
	$msg = strip_tags($_POST['message']);
	$from = strip_tags($_POST['email']);
	//$ph = strip_tags($_POST['ph']);
	//$q="";
	$to = $ad['email'];
	//$to = "karunakar.gautam@gmail.com";

	$subject = "A reply on your Ad [YourKart]";
	$htmlx = file_get_contents('email/pm.html');

	$adlink = 'http://www.yourkart.com/viewad.php?id='.$id_bak;

	$params = array("{adlink}","{adtitle}","{message}","{sender}");
	$values = array($adlink,$ad['title'],$msg,$from);
	$htmlx = str_replace($params, $values, $htmlx);

	ykmail($to,$from,$subject,$htmlx);
	message("Message Sent Successfully ! Please check your email periodically for reply from Seller.");
}
?>