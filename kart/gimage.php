<?

$data=file_get_contents('1.html');
$images=preg_match('/imgurl=(.)*(\.jpg)?(\.png)?(\.bmp)?(\.jpeg)?(\.JPEG)?(\.JPG)?(\.BMP)?(\.PNG)?(\.GIF)?(\.gif)/',$data,$matches);
foreach($matches as $img)
{
	echo $img.'<br />';
}

?>