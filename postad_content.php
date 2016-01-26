<?
if (isset($_POST['post'])) {
				$title    = strip_tags($_POST['title']);
				$section  = $_POST['country'];
				$category = $_POST['state'];
				//$brand=$_POST['city'];
				$age      = $_POST['age'];
				//$condition=$_POST['cond'];
				//$mp=$_POST['mp'];
				$sp       = $_POST['sp'];
				$info     = strip_tags($_POST['info']);
				$warranty = $_POST['warranty'];
				$pn       = $_POST['pn'];
				$group    = $_POST['group'];
				$captcha  = $_POST['captcha'];
				//$valid=$_POST['valid'];
				$date     = date('d/m/Y');
				$email    = $_POST['email'];
				$contact  = $_POST['contact'];
/* ----------------------------------------------------- RECAPTCHA CODE Snippet-----------------------------------------------*/				
				$privatekey = "6Ler0uYSAAAAANG__pGQUqA0YOvhII27raAIPsOS ";
				$resp = recaptcha_check_answer ($privatekey,
				$_SERVER["REMOTE_ADDR"],
				$_POST["recaptcha_challenge_field"],
				$_POST["recaptcha_response_field"]);
/*----------------------------------------------------------------------------------------------------------------------------*/
				//echo '#'.$captcha.'#'.$_SESSION['img_ver'];
				/*if ($_SESSION['img_ver'] == $captcha) */if ($resp->is_valid){
								$s0 = 0;
								if (isset($_FILES['mimg'])) {
												$mimg = $_FILES['mimg'];
								}
								if (isset($_FILES['img1'])) {
												$img1 = $_FILES['img1'];
								}
								if (isset($_FILES['img2'])) {
												$img2 = $_FILES['img2'];
								}
								
								//if(!$uid)
								//{
								//	$uid=0;
								//$uname=strip_tags($_POST['name']);
								//$college=$_POST['college'];
								//	$email=$_POST['email'];
								//$contact=$_POST['contact'];
								//$s0=1;
								//}
								/*else
								{
								$uzer=getuser($uid);
								//$uname=$uzer['name'];
								//$college=$uzer['college'];
								$email=$uzer['email'];
								$contact=$uzer['contact'];
								$s0=1;
								}
								*/
//*************************************************** Image Upload ********************************************************
								
								// **************************Image 1**********************
								$target = "itemimage/";
								if (basename($_FILES['mimg']['name'])) {
												$name = basename($_FILES['mimg']['name']);
												$res  = checkex($name);
												$s1   = 1;
												if (!$res) {
																error('File Type not allowed!! You can only upload JPEG,PNG,BMP and GIF images.');
																$s1 = 0;
												}
												$name   = str_replace(' ', '_', $name);
												$name   = get_rand_id(15) . '_' . $name;
												$target = $target . $name;
												$mimg   = kbase() . '/kart/' . $target;
												$target="kart/".$target;
												$timg   = kbase() . '/kart/' . "itemimage/thumb_" . $name;
												if (move_uploaded_file($_FILES['mimg']['tmp_name'], $target)) {
																$s2    = 1;
																$path  = "kart/itemimage/thumb_" . $name;
																$image = new SimpleImage();
																$image->load($target);
																$image->resize(150, 100);
																$image->save($path);
												} else {
																error('Error Uploading Main Image !!');
																$s2 = 0;
												}
								} else {
												$mimg = kbase() . '/kart/nimg.jpg';
												$timg = kbase() . '/kart/nimg_small.jpg';
												$s1   = 1;
												$s2   = 1;
								}
								// ***************************** Image 2 ********************
								if (basename($_FILES['img1']['name'])) {
												$target = "itemimage/";
												$name   = basename($_FILES['img1']['name']);
												$res    = checkex($name);
												$s3     = 1;
												if (!$res) {
																error('File Type not allowed!! You can only upload JPEG,PNG,BMP and GIF images.');
																$s3 = 0;
												}
												$name   = str_replace(' ', '_', $name);
												$name   = get_rand_id(15) . '_' . $name;
												$target = $target . $name;
												$img1   = kbase() . '/kart/' . $target;
												$target="kart/".$target;
												if (move_uploaded_file($_FILES['img1']['tmp_name'], $target)) {
																$s4 = 1;
												} else {
																error('Error Uploading Image 2 !!');
																$s4 = 0;
												}
								} else {
												$img1 = kbase() . '/kart/nimg.jpg';
												$s3   = 1;
												$s4   = 1;
								}
								//************************** Image 3 ***************************
								if (basename($_FILES['img2']['name'])) {
												$target = "itemimage/";
												$name   = basename($_FILES['img2']['name']);
												$res    = checkex($name);
												$s5     = 1;
												if (!$res) {
																error('Error Uploading Image 3 :');
																error('File Type not allowed!! You can only upload JPEG,PNG,BMP and GIF images.');
																$s5 = 0;
												}
												$name   = str_replace(' ', '_', $name);
												$name   = get_rand_id(15) . '_' . $name;
												$target = $target . $name;
												$img2   = kbase() . '/kart/' . $target;
												$target="kart/".$target;
												if (move_uploaded_file($_FILES['img2']['tmp_name'], $target)) {
																$s6 = 1;
												} else {
																error('Error Uploading Image 3 !!');
																$s6 = 0;
												}
								} else {
												$img2 = kbase() . '/kart/nimg.jpg';
												$s5   = 1;
												$s6   = 1;
								}
								//**************************************************************************************************************************************
								$error = 1;
								if ($s1 && $s2 && $s3 && $s4 && $s5 && $s6) {
												$error = 0;
												
												$arr        = createad($title, $section, $category, $age, $sp, $info, $mimg, $img1, $img2, $group, $contact, $email, $warranty, $pn, $date, $timg);
												$arr        = explode(":", $arr);
												$article_id = $arr[0];
												$uniq_id    = $arr[1];
												$body       = "<html><p>Hi ,</p>
		<p>You've just posted an ad on YourKart.com . If you need to find your ad, you can find it at the link below :</p>
		<p><a href=" . '"' . "http://www.yourkart.com/viewad.php?id=$article_id" . '"' . ">$title</a></p>
		<p>To edit your Ad, use the link below :</p>
		<p><a href=" . '"' . "http://www.yourkart.com/editad.php?id=56&token=$uniq_id" . '"' . ">Click Here to Edit Your Ad</a></p>
		<p></p><p>When you have sold your item, you can delete the ad using the link below :</p>
		<p><a href=" . '"' . "http://www.yourkart.com/delete_ad.php?id=57&token=$uniq_id" . '"' . ">Click Here to Delete Your Ad</a></p>
		<p></p><p>We wish you good luck in finding the seller for your item. We are happy to be of any help in this procedure.</p>
		<p>Regards</p>
		<p>YourKart Team</p></html>";
												
												$to  = $email;
												$sub = "Ad successfully posted on YourKart.com";	
												$headers = 'MIME-Version: 1.0'."\r\n";
												$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
												$headers .= 'From: YourKart <noreply_notif@yourkart.com>'."\r\n";
												$headers .="Message-ID: <".md5($date)."@..................>"."\r\n";
												$headers .= "Reply-To: admin@yourkart.com"."\r\n";
												$headers .= "Return-Path: admin@yourkart.com"."\r\n";
												$headers .= "X-Priority: 3\r\nX-MSMail-Priority: Normal"."\r\n";
												$headers .= "X-Mailer: PHP/".phpversion()."\r\n";
												mail($to, $sub, $body, $headers);
												
												$msg = '<a href="http://www.yourkart.com/viewad.php?id=' . $article_id . '" target="_new">Click here to view your Ad</a></br> <b>Spread the word !! Share your Ad on Facebook</b> </br> <fb:like href="http://www.yourkart.com/viewad.php/?id='.$article_id.'" send="true" layout="button_count" width="450" show_faces="false" font="arial"></fb:like>';
												info($msg);
												check_requests($title, $article_id, $group, $section, $category);
								} else {
												error('Sorry, Something went wrong. Please try again !!');
												$error = 1;
												
								}
				} else {
								$error = 1;
								error('Wrong Captcha Code Entered!!');
				}
}
?>

<form action="postad.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <p><strong>Item Details --- Fields with * mark are required</strong></p>
  <table width="613" border="0" cellspacing="2">
    
    <tr>
      <td width="184">Ad Title *</td>
      <td colspan="3">
        <input name="title" type="text" id="text2" value="<?= show_on_error($error, $title) ?>" size="40" maxlength="40" tooltipText="Give your ad a suitable title. for e.g. Samsung Galaxy S for Sale" required/>
     </td>
    </tr>
    <tr>
      <td>Category *</td>
      <td width="230">
      	<select  id="select2" name="country" onChange="r_getcats(this.value)" required>
	<option value="">Select Category</option>
	<?
$q = "SELECT * FROM `jos_sections`";
$result = mysql_query($q) or die('MySQL Error(1)!!');
while ($row = mysql_fetch_array($result)) {
?>
    <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
    <?
}
?>
      </select> 
      &nbsp;&nbsp;
      </td>
      <td width="230"><div id="r_category"><select name="state" >
	<option value=""></option>
      </select></div></td>
    </tr>
    <tr>
      <td>Item Age *</td>
      <td colspan="3"><span id="sprytextfield1">
      <input name="age" type="text" id="text1" value="<?= show_on_error($error, $age) ?>" size="10" tooltipText="How old is your item ?" />
      <span class="textfieldRequiredMsg">Age is required</span><span class="textfieldInvalidFormatMsg">Invalid age.</span></span> &nbsp;Months Old</td>
    </tr>
    <tr>
      <td>Selling Price *</td>
      <td colspan="3">Rs. <span id="sprytextfield4">
      <input name="sp" type="text" id="text4" value="<?= show_on_error($error, $sp) ?>" maxlength="9" tooltipText="At what price you wish to sell it ?"/>
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid price.</span></span></td>
    </tr>
    <tr>
      <td>Price Negotiable</td>
      <td colspan="3"><label>
        <select name="pn" id="select3" tooltipText="Please specify if price is negotiable.">
          <option value="yes">Yes</option>
          <option value="no">No</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td>Under Warranty</td>
      <td colspan="3"><label>
        <select name="warranty" id="select4" tooltipText="Specify if your Item is still under Warranty.">
          <option value="yes">Yes</option>
          <option value="no">No</option>
          </select>
        </label></td>
    </tr>
    <tr>
      <td>Visibility</td>
<td colspan="3"><span id="spryselect1">
	      <select name="group" id="select1" tooltipText="Select the group where this ad will be visible.">
		<?
$q = "SELECT *
FROM `groups`";
$result = mysql_query($q) or die('MySQL Error(1)!!');
while ($row = mysql_fetch_array($result)) {
				if ($row['id'] == $_SESSION['gid']) {
								echo '<option value="' . $row['id'] . '" selected="selected">' . $row['name'] . '</option>';
				} else {
								echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
}
?>
          </select>
      <span class="selectRequiredMsg">Please select an item.</span></span></td>
    </tr>
    <tr>
      <td>Additional  Information</td>
      <td colspan="3"><textarea name="info" id="textarea" cols="30" rows="3" tooltipText="You can tell your buyers more about the item 
     for e.g. its condition,color,accessories,
      features etc."><?= show_on_error($error, $info) ?></textarea></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><strong>Upload some pictures of your item. It helps in gaining attention of Buyers.</strong></td>
      
    </tr>
    <tr>
      <td>Main Image (max. 1MB)</td>
      <td colspan="3"><input type="file" name="mimg" id="fileField" /></td>
    </tr>
    <tr>
      <td>Image 2 (max. 1MB)</td>
      <td colspan="3"><input type="file" name="img1" id="fileField2" /></td>
    </tr>
    <tr>
      <td>Image 3 (max. 1MB)</td>
      <td colspan="3"><input type="file" name="img2" id="fileField3" /></td>
    </tr>
    
  </table>

  <?
if (!$uid) {
?>
  <strong>Contact Details</strong>
  <table width="593" border="0" cellspacing="0">
	  <tr>
	    <td width="151">E-Mail *</td>
	    <td width="438"><span id="sprytextfield6">
        <input name="email" type="text" id="text5" value="<?= show_on_error($error, $email) ?>" size="40" maxlength="400" tooltipText="Please enter your E-mail Id. Buyers will use it to contact you."/>
        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid E-Mail .</span></span>
        
    </td>
      </tr>
      <tr>
	    <td>Contact No. (optional)</td>
	    <td><span id="sprytextfield7">
        <input name="contact" type="text" id="text6" value="<?= show_on_error($error, $contact) ?>" maxlength="12" tooltipText="Please enter your contact number. Buyers prefer to call."/>
<span class="textfieldInvalidFormatMsg">Invalid Phone Number.</span><span class="textfieldMinCharsMsg">Invalid Phone Number.</span></span></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
    </tr>
	  <tr>
	    <td>Enter Captcha</td>
	    <td>
		<?
          $publickey = "6Ler0uYSAAAAAAOtGWvHD6rNzKR2nSLviQiaDj_f"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        ?>
</td>
    </tr>
    </table>
  
    <p>
      <?
}

?>
    </p>
    <p>
      <input type="submit" name="post" id="button" value="Post Ad" />
      <?
      if($sef_url){ $link="index.php/terms-of-use";} else {$link="index.php?option=com_content&view=article&id=33&Itemid=96";}
      ?>
    (By Posting this Ad, You Agree to Our <a target="_parent" href="<?=$link?>">Terms of Use</a>.)</p>
</form>