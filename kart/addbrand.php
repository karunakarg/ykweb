<?
include('sqlcon.php');
$new=$_POST['new'];
if(isset($new))
{
$category=$_POST['state'];
$new=explode(',',$new);
foreach($new as $val)
{
$q="INSERT INTO `brand` (`bid`, `catid`, `name`) VALUES (NULL, '$category', '$val')";	
mysql_query($q) or die('MySQL Error(1)!!');
}
echo '<script type="text/javascript"> alert("Saved Successfully!!"); </script>';
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
<form id="form1" name="form1" method="post" action="addbrand.php">
  <table width="630" border="0" cellspacing="0">
    <tr>
      <td width="157">Select Category</td>
      <td width="161">
      <select name="country" onChange="getState(this.value)">
	<option value="">Select Category</option>
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
      <td width="306"><div id="statediv"><select name="state" >
	<option value=""></option>
        </select></div></td>
    </tr>
    <tr>
      <td>Existing Brands</td>
      <td colspan="2"><div id="citydiv"><select name="city">
	<option value="">Select Category First</option>
        </select></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>New Brands</td>
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
