
<?
if(isset($_POST['button']))
{
//$name=strip_tags($_POST['name']);
$email=$_POST['email'];
$contact=$_POST['contact'];
$desc=strip_tags($_POST['desc']);
$key=strip_tags($_POST['key']);
$sec=strip_tags($_POST['category']);
//$cat=strip_tags($_POST['state']);
$gid=strip_tags($_POST['gid']);
$captcha=$_POST['captcha'];
$e=0;
	if($_SESSION['img_ver']==$captcha)
	{
		//**************************security measures***********************
		$desc=preg_replace('/[^A-Za-z0-9 ]/','',$desc); //disallow anything but characters and numerals
		if(!is_numeric($gid))
			die('1');
		if(!is_numeric($sec)&&$sec!='')
			die('2');
		if(!is_numeric($cat)&&$cat!='')
			die('3');
	
		//******************************************************************
		$timestamp=date('d/m/Y');
		$rand_id=get_rand_id(10);
		$q="INSERT INTO `requests` (`id`, `desc`, `sec`, `cat`, `email`, `contact`, `uid`, `timestamp`, `gid`) VALUES (NULL, '$desc', '$sec', '$cat', '$email', '$contact', '$rand_id', '$timestamp', '$gid')";
		$result=mysql_query($q) or die('sqlerr 1 request');
		
		$q="select id from requests where uid='$rand_id'";
		$result=mysql_query($q) or die('sqlerr 2 request');
		$row=mysql_fetch_array($result);
		$id=$row['id'];
		if(isset($key))
		{
			$key=explode(',',$key);
			
			foreach($key as $keyword)
			{
				$keyword=strip_tags($keyword);
				$q="INSERT INTO `request_keywords` (`id`, `keyword`, `sec`, `cat`) VALUES ('$id', '$keyword', '$sec','$cat')";
				mysql_query($q) or die('sqlerr 3 request');
			}
		}
		message('Request posted Successfully !!');
		
	}
	else
	{//echo "here3";
		$e=1;
		error('Wrong Captcha Code Entered!!');
	}
}
info("Post your request and leave the rest to us. We will notify you instantly when someone is selling what you need.</br> Also, your request will be posted under the group you select for others to view.");
?>
<link rel="stylesheet" href="kart/css/form-field-tooltip.css" media="screen" type="text/css">
	<script type="text/javascript" src="kart/js/rounded-corners.js"></script>
	<script type="text/javascript" src="kart/js/form-field-tooltip.js"></script>

<script type="text/javascript">
function r_getcats(value){
var categories_data= new Array();
categories_data[0] = '<select name="state" id="select2"></select>';
<?
$q="SELECT * FROM `jos_sections`";
$result=mysql_query($q) or die('MySQL Error(1)!!');
while($row=mysql_fetch_array($result))
{
	$data="";
	$q="SELECT * FROM `jos_categories` where section=".$row['id'];
	$result1=mysql_query($q) or die('MySQL Error(1)!!');
	$data = '<select class="form-control" name="state" id="select2">';
	while($row1=mysql_fetch_array($result1))
	{
		$data=$data.'<option value="'.$row1['id'].'">'.$row1['title'].'</option>';
	}
	$data=$data.'</select>';
	
?>
	categories_data[<?=$row['id']?>] = '<?=$data?>';
<?
}
?>
	document.getElementById('r_category').innerHTML = categories_data[value];
}
</script>
    
<div class="row" style="padding-left:3%">
	                      	<div class="col-lg-10">
								<form class="form-horizontal" role="form" method="post" action="request.php">
									<div class="form-group">
						                <label class="col-sm-4">Email*</label>
						                <div class="col-sm-6">
						                	<input name="email" type="email" class="form-control" value="<? if($e){echo $email; }?>" maxlength="200" placeholder="Enter your Email" required/>
						             	</div>
						             </div>
						             <div class="form-group">
						                <label class="col-sm-4">Contact No.</label>
						                <div class="col-sm-6">
						                	<input type="number" name="contact" class="form-control" value="<? if($e){echo $contact; }?>" maxlength="12" placeholder="Enter your Contact No." />
						             	</div>
						             </div>
						             <div class="form-group">
						                <label class="col-sm-4">Description*</label>
						                <div class="col-sm-6">
						                	<textarea name="desc" cols="35" rows="3" class="form-control" placeholder="Write a brief description" tooltipText="Describe what you need. Keep it simple and precise." required><? if($e){echo $desc; }?></textarea>
						             	</div>
						             </div>
						             <div class="form-group">
						                <label class="col-sm-4">Keywords*</label>
						                <div class="col-sm-6">
						                	<input name="key" value="<? if($e){$key=implode(',',$key) ;echo $key; }?>" size="35" class="form-control" placeholder="Enter comma separated keywords" tooltipText="keywords help us to notify you if someone posts what you need" required/>
						             	</div>
						             </div>
						             
						             <div class="form-group">
						             	<div class="col-sm-4">Post Under*</div>
						             	<div class="col-sm-3">
						             		<select class="form-control" name="category" id="gid" onchange="r_getcats(this.value)" required>

						             		<option value="0">Select Category</option>
										          <?
													    $q="SELECT * FROM `jos_sections`";
														$result=mysql_query($q) or die('MySQL Error(1)!!');
														while($row=mysql_fetch_array($result))
														{
														?>
													          <option value="<?=$row['id']?>">
													            <?=$row['title']?>
													          </option>
													          <?
														}
												?>
						             		</select>
						             	</div>

						             		<div class="col-sm-3" id="r_category">
						             			<select class="form-control" name="state" >
        										</select>
        									</div>
						             </div>
						             <div class="form-group">
						             	<div class="col-sm-4">Visibility*</div>
						             	<div class="col-sm-6">
						             		<select class="form-control" name="gid" id="gid" required>
												<?
											        $q="SELECT * FROM `groups`";
													$result=mysql_query($q) or die('MySQL Error(1)!!');
													while($row=mysql_fetch_array($result))
													{
														if($row['id']==$_SESSION['gid'])
														{
															echo '<option value="'.$row['id'].'" selected="selected">'.$row['name'].'</option>';
														}
														else
														{
															echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
														}
													}
												?>
						             		</select>
						             	</div>
						             </div>
						             <div class="form-group">
						                <label class="col-sm-4">Enter Code</label>
						                <div class="col-sm-6">
						                	<img src="kart/captcha.php" alt="Captcha Image" width="80px" height="30px"/>
						                	<input name="captcha" class="form-control" maxlength="12" placeholder="Enter the code in Image" required/>
						             	</div>
						             </div>
						             
									 <div class="form-group">
						                <label class="col-sm-4"></label>
			                      		<div class="col-sm-6" align="left">
			                      			<button type="submit" name="button" class="btn btn-primary"><i class="fa fa-check"></i> Post Request</button>
			                      		</div>
		                      		</div>
		                      		
		                      	</form>
	                      	</div>
                      	</div>
                      </div>
