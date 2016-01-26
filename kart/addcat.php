<?
include('sqlcon.php');
include('kartlib.php');
$new=$_POST['new'];
if(isset($new))
{
$sec=$_POST['sec'];
$new=explode(',',$new);
foreach($new as $val)
{
	$str=strtolower($val);
	$alias-str_replace('&','n',$str);
	$alias=preg_replace('/[^A-Za-z0-9]/','-',$str);
$q="INSERT INTO `jos_categories` (`id`, `parent_id`, `title`, `name`, `alias`, `image`, `section`, `image_position`, `description`, `published`, `checked_out`, `checked_out_time`, `editor`, `ordering`, `access`, `count`, `params`) VALUES (NULL, '0', '$val', '', '$alias', '', '$sec', 'left', '', '1', '0', '0000-00-00 00:00:00', NULL, '0', '0', '0', '')";	
mysql_query($q) or die('MySQL Error(1)!!');
}
message('All categories added !!');
}
?>
<script language="javascript" type="text/javascript">
// Roshan's Ajax dropdown code with php
// This notice must stay intact for legal use
// Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
// If you have any problem contact me at http://roshanbh.com.np
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
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
	
	function getState(countryId) {		
		
		var strURL="findState.php?country="+countryId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('statediv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	function getCity(countryId,stateId) {		
		var strURL="findCity.php?country="+countryId+"&state="+stateId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
</script>
<form id="form1" name="form1" method="post" action="addcat.php">
  <table width="630" border="0" cellspacing="0">
    <tr>
      <td width="157">Select Section</td>
      <td width="161">
      <select name="sec">
	<option value="">Select section</option>
	<?
    $q="SELECT * FROM `jos_sections`";
	$result=mysql_query($q) or die('MySQL Error(1)!!');
	while($row=mysql_fetch_array($result))
	{
	?>
    <option value="<?=$row['id']?>"><?=$row['title']?></option>
    <?
	}
	?>
        </select> &nbsp;&nbsp;</td>
      <td width="306"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>New Categories</td>
      <td colspan="2"><textarea name="new" id="textarea" cols="50" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><input type="submit" name="button" id="button" value="Save" /></td>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</form>
