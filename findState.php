<?
include_once('include/includes.php');

$brand=intval($_GET['country']);
$prod=intval($_GET['prod']);

$query="SELECT * FROM cart WHERE bid='$brand' AND pid='$prod' AND status=1";
$result=mysql_query($query);
if(!mysql_num_rows($result)){
	echo '1';
	die();
}
$row=mysql_fetch_array($result);

$cartid = $row['id'];
$disc = $row['discount'];
$bdisc = $row['bulkdiscount'];
$wdisc = $row['wholediscount'];
$bq = $row['bulkquant'];
$wq = $row['wholequant'];

$query="SELECT * FROM cartlist WHERE cid='$cartid'";
$result=mysql_query($query);
$i = 0;
$sizedata = array();
$coredata = array();
while($row=mysql_fetch_array($result))
{
	$sizedata[$i] = $row['size'];
	$i++;
}
array_unique($sizedata);

?>
  <table width="100%" border="0" cellpadding="3px">

<tr>
      <td colspan="2">

        <select id="size" name="size" class="form-control" onchange="update()">
        <option value="any">Select Size</option>

          <?php
            foreach ($sizedata as $size) {
          ?>
          <option value="<?=$size?>"><?=size($size)?></option>
          <?php
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div id="corespan">
          <select id="core" name="core" class="form-control">
          <option value="any">Select Core/Pair</option>
          </select>
        </div>
      </td>
    </tr>
    <tr>
      <td><font color="white">Color</font></td>
      <td><input type="text" name="color" id="color" size="9" placeholder="optional" />
    </td>
    </tr>
    <tr>
      <td><font color="white">Quantity</font></td>
      <td>
     <input name="quant" type="number" id="quant" size="9" value="" onchange="calculatesp()" required />
      </td>
    </tr>
    <tr>
      <td><font color="white">Unit</font></td>
      <td><input name="unit" id="unit" value="N/A" size="9" disabled></td>
    </tr>
    <tr>
      <td><font color="white">Market Price</font></td>
      <td><input name="mp" id="mp" value="N/A" size="9" disabled></td>
    </tr>
    <tr>
      <td><font color="white">Discount %</font></td>
      <td><input name="disc" id="disc" value="<?=$disc?>" size="9" disabled></td>
    </tr>
    <tr>
      <td><font color="white">Sale Price</font></td>
      <td><input name="sp" id="sp" value="N/A" size="9" disabled></td>
    </tr>
<!--      <input name="vat" type="hidden" id="vat" value="N/A" />
 -->     <input name="disc_bak" type="hidden" id="disc_bak" value="<?=$disc?>" />
     <input name="bdisc" type="hidden" id="bdisc" value="<?=$bdisc?>" />
      <input name="bq" type="hidden" id="bq" value="<?=$bq?>" />
       <input name="wdisc" type="hidden" id="wdisc" value="<?=$wdisc?>" />
        <input name="wq" type="hidden" id="wq" value="<?=$wq?>" />
    </table>