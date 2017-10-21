<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');

	if ($_SESSION['sess_wid'] == "") { $_SESSION['sess_wid'] = date("ymdHis"); } $sess_wid = $_SESSION['sess_wid'];
	$_SESSION['sess_padmin'] = "site/work/add.php";
	
	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$wposted = date("Y-m-d H:i:s");

		// English
		$wtitle_en = $_POST['wtitle_en'];
		$wtitle_en = str_replace('"',"&quot;","$wtitle_en");
		$wtitle_en = str_replace("'","&rsquo;","$wtitle_en");

		$wurl = preg_replace('/[^a-zA-Z0-9\-]/', '_', $wtitle_en);
		$wurl = str_replace(" ","_","$wurl");
		$wurl = strtolower($wurl);

		$wtopic1_en = $_POST['wtopic1_en'];
		$wtext1_en = $_POST['wtext1_en'];
		$wtopic2_en = $_POST['wtopic2_en'];
		$wtext2_en = $_POST['wtext2_en'];
		$wtopic3_en = $_POST['wtopic3_en'];
		$wtext3_en = $_POST['wtext3_en'];
		$wtopic4_en = $_POST['wtopic4_en'];
		$wtext4_en = $_POST['wtext4_en'];

		$wdetail_en = $_POST['wdetail_en'];
		$wdetail_en = str_replace('"',"&quot;","$wdetail_en");
		$wdetail_en = str_replace("'","&rsquo;","$wdetail_en");

		// Thai
		$wtitle_th = $_POST['wtitle_th'];
		$wtitle_th = str_replace('"',"&quot;","$wtitle_th");
		$wtitle_th = str_replace("'","&rsquo;","$wtitle_th");

		$wtopic1_th = $_POST['wtopic1_th'];
		$wtext1_th = $_POST['wtext1_th'];
		$wtopic2_th = $_POST['wtopic2_th'];
		$wtext2_th = $_POST['wtext2_th'];
		$wtopic3_th = $_POST['wtopic3_th'];
		$wtext3_th = $_POST['wtext3_th'];
		$wtopic4_th = $_POST['wtopic4_th'];
		$wtext4_th = $_POST['wtext4_th'];

		$wdetail_th = $_POST['wdetail_th'];
		$wdetail_th = str_replace('"',"&quot;","$wdetail_th");
		$wdetail_th = str_replace("'","&rsquo;","$wdetail_th");

		$sqlw = "INSERT INTO tb_work VALUES ('$sess_wid','$wurl','$wtitle_en','$wtitle_th','$wtopic1_en','$wtopic1_th','$wtext1_en','$wtext1_th','$wtopic2_en','$wtopic2_th','$wtext2_en','$wtext2_th','$wtopic3_en','$wtopic3_th','$wtext3_en','$wtext3_th','$wtopic4_en','$wtopic4_th','$wtext4_en','$wtext4_th','$wdetail_en','$wdetail_th','','$wposted','0','0')";
		$resultw = mysql_query($sqlw,$dgz);
		if ($resultw) { header("Location:add.php"); }
		else { echo "ERROR : Can not post new work."; exit(); }
	}

	// Page Content
	$pid = 4000;
	include("../../config/page.info.php");

	error_reporting (E_ALL ^ E_NOTICE);
	session_start(); 
	//Do not remove this
	//only assign a new timestamp if the session variable is empty
	if (!isset($_SESSION['random_key']) || strlen($_SESSION['random_key'])==0){
		$_SESSION['random_key'] = $sess_wid; //assign the timestamp to the session variable
		$_SESSION['user_file_ext']= "";
	}
	
	// CONSTANTS
	$upload_dir = "../../resources/work";
	$upload_path = $upload_dir."/";						// The path to where the image will be saved
	$large_image_prefix = "";			// The prefix name to large image
	$thumb_image_prefix = "th";			// The prefix name to the thumb image
	$large_image_name = $large_image_prefix.$_SESSION['random_key'];     // New name of the large image (append the timestamp to the filename)
	$thumb_image_name = $thumb_image_prefix.$_SESSION['random_key'];     // New name of the thumbnail image (append the timestamp to the filename)
	$max_file = "1"; 							// Maximum file size in MB
	$max_width = "600";							// Max width allowed for the large image
	$thumb_width = "265";						// Width of thumbnail image
	$thumb_height = "200";						// Height of thumbnail image
	// Only one of these image types should be allowed for upload
	$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
	$allowed_image_ext = array_unique($allowed_image_types); // do not change this
	$image_ext = "";	// initialise variable, do not change this.
	foreach ($allowed_image_ext as $mime_type => $ext) {
		$image_ext.= strtoupper($ext)." ";
	}
	
	// IMAGE FUNCTIONS
	function resizeImage($image,$width,$height,$scale) {
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		$imageType = image_type_to_mime_type($imageType);
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch($imageType) {
			case "image/gif":
				$source=imagecreatefromgif($image); 
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image); 
				break;
			case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image); 
				break;
		}
		imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
		
		switch($imageType) {
			case "image/gif":
				imagegif($newImage,$image); 
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				imagejpeg($newImage,$image,90); 
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$image);  
				break;
		}
		
		chmod($image, 0777);
		return $image;
	}
	
	//You do not need to alter these functions
	function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		$imageType = image_type_to_mime_type($imageType);
		
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch($imageType) {
			case "image/gif":
				$source=imagecreatefromgif($image); 
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image); 
				break;
			case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image); 
				break;
		}
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		switch($imageType) {
			case "image/gif":
				imagegif($newImage,$thumb_image_name); 
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				imagejpeg($newImage,$thumb_image_name,90); 
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$thumb_image_name);  
				break;
		}
		chmod($thumb_image_name, 0777);
		return $thumb_image_name;
	}
	
	//You do not need to alter these functions
	function getHeight($image) {
		$size = getimagesize($image);
		$height = $size[1];
		return $height;
	}
	
	//You do not need to alter these functions
	function getWidth($image) {
		$size = getimagesize($image);
		$width = $size[0];
		return $width;
	}
	
	//Image Locations
	$large_image_location = $upload_path.$large_image_name.$_SESSION['user_file_ext'];
	$thumb_image_location = $upload_path.$thumb_image_name.$_SESSION['user_file_ext'];
	
	//Create the upload directory with the right permissions if it doesn't exist
	if(!is_dir($upload_dir)){
		mkdir($upload_dir, 0777);
		chmod($upload_dir, 0777);
	}
	
	//Check to see if any images with the same name already exist
	if (file_exists($large_image_location)){
		if(file_exists($thumb_image_location)){
			$thumb_photo_exists = "<img src=\"".$upload_path.$thumb_image_name.$_SESSION['user_file_ext']."\" alt=\"Thumbnail Image\"/>";
		}else{
			$thumb_photo_exists = "";
		}
		$large_photo_exists = "<img src=\"".$upload_path.$large_image_name.$_SESSION['user_file_ext']."\" alt=\"Large Image\"/>";
	} else {
		$large_photo_exists = "";
		$thumb_photo_exists = "";
	}
	
	if (isset($_POST["upload"])) { 
		//Get the file information
		$userfile_name = $_FILES['image']['name'];
		$userfile_tmp = $_FILES['image']['tmp_name'];
		$userfile_size = $_FILES['image']['size'];
		$userfile_type = $_FILES['image']['type'];
		$filename = basename($_FILES['image']['name']);
		$file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
		
		//Only process if the file is a JPG, PNG or GIF and below the allowed limit
		if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
			
			foreach ($allowed_image_types as $mime_type => $ext) {
				//loop through the specified image types and if they match the extension then break out
				//everything is ok so go and check file size
				if($file_ext==$ext && $userfile_type==$mime_type){
					$error = "";
					break;
				}else{
					$error = "Only <strong>".$image_ext."</strong> images accepted for upload<br />";
				}
			}
			//check if the file size is above the allowed limit
			if ($userfile_size > ($max_file*1048576)) {
				$error.= "Images must be under ".$max_file."MB in size";
			}
			
		}else{
			$error= "Select an image for upload";
		}
		//Everything is ok, so we can upload the image.
		if (strlen($error)==0){
			
			if (isset($_FILES['image']['name'])){
				//this file could now has an unknown file extension (we hope it's one of the ones set above!)
				$large_image_location = $large_image_location.".".$file_ext;
				$thumb_image_location = $thumb_image_location.".".$file_ext;
				
				//put the file ext in the session so we know what file to look for once its uploaded
				$_SESSION['user_file_ext']=".".$file_ext;
				
				move_uploaded_file($userfile_tmp, $large_image_location);
				chmod($large_image_location, 0777);
				
				$width = getWidth($large_image_location);
				$height = getHeight($large_image_location);
				//Scale the image if it is greater than the width set above
				if ($width > $max_width){
					$scale = $max_width/$width;
					$uploaded = resizeImage($large_image_location,$width,$height,$scale);
				}else{
					$scale = 1;
					$uploaded = resizeImage($large_image_location,$width,$height,$scale);
				}
				//Delete the thumbnail file so the user can create a new one
				if (file_exists($thumb_image_location)) {
					unlink($thumb_image_location);
				}
			}
			//Refresh the page to show the new uploaded image
			header("location:".$_SERVER["PHP_SELF"]);
			exit();
		}
	}
	
	if (isset($_POST["upload_thumbnail"]) && strlen($large_photo_exists)>0) {
		//Get the new coordinates to crop the image.
		$x1 = $_POST["x1"];
		$y1 = $_POST["y1"];
		$x2 = $_POST["x2"];
		$y2 = $_POST["y2"];
		$w = $_POST["w"];
		$h = $_POST["h"];
		
		//Scale the image to the thumb_width set above
		$scale = $thumb_width/$w;
		$cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
		//Reload the page again to view the thumbnail
		header("location:".$_SERVER["PHP_SELF"]);
		exit();
	}
	
	
	if ($_GET['a']=="delete" && strlen($_GET['t'])>0){
	//get the file locations 
		$large_image_location = $upload_path.$large_image_prefix.$_GET['t'];
		$thumb_image_location = $upload_path.$thumb_image_prefix.$_GET['t'];
		if (file_exists($large_image_location)) {
			unlink($large_image_location);
		}
		if (file_exists($thumb_image_location)) {
			unlink($thumb_image_location);
		}
		header("location:".$_SERVER["PHP_SELF"]);
		exit(); 
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php include("../menu.php");?>
	<script type="text/javascript" src="../../js/jquery-pack.js"></script>
    <script type="text/javascript" src="../../js/jquery.imgareaselect.min.js"></script>

	<p id="nav">
		<a href="../content/update.php?pid=<?php echo $pid;?>"><?php echo $p[ptopic_en];?></a> &nbsp;&gt;&nbsp; 
        <a href="index.php">All Works</a> &nbsp;&gt;&nbsp; 
		<strong>Post new Info</strong>
	</p>
    
	<div id="content">
		<?php
		//Only display the javacript if an image has been uploaded
		if (strlen($large_photo_exists) > 0)	{
			$current_large_image_width = getWidth($large_image_location);
			$current_large_image_height = getHeight($large_image_location); ?>
			
			<script type="text/javascript">
			function preview(img, selection) { 
				var scaleX = <?php echo $thumb_width;?> / selection.width; 
				var scaleY = <?php echo $thumb_height;?> / selection.height; 
				
				$('#thumbnail + div > img').css({ 
					width: Math.round(scaleX * <?php echo $current_large_image_width;?>) + 'px', 
					height: Math.round(scaleY * <?php echo $current_large_image_height;?>) + 'px',
					marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
					marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
				});
				$('#x1').val(selection.x1);
				$('#y1').val(selection.y1);
				$('#x2').val(selection.x2);
				$('#y2').val(selection.y2);
				$('#w').val(selection.width);
				$('#h').val(selection.height);
			} 
			
			$(document).ready(function () { 
				$('#save_thumb').click(function() {
					var x1 = $('#x1').val();
					var y1 = $('#y1').val();
					var x2 = $('#x2').val();
					var y2 = $('#y2').val();
					var w = $('#w').val();
					var h = $('#h').val();
					if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
						alert("You must make a selection first");
						return false;
					}else{
						return true;
					}
				});
			}); 
			
			$(window).load(function () { 
				$('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?php echo $thumb_height/$thumb_width;?>', onSelectChange: preview }); 
			});
			</script>
		<?php }?>
		
		<?php
		//Display error message if there are any
		if (strlen($error) > 0)	{ echo "<ul><li><strong>Error!</strong></li><li>".$error."</li></ul>"; }
		
		if (strlen($large_photo_exists) > 0 && strlen($thumb_photo_exists) > 0)	{
		
			$thname = $thumb_image_name."".$_SESSION['user_file_ext'];
			
			$sqlw = "UPDATE tb_work SET wpic='$thname' WHERE wid='$sess_wid'";
			$resultw = mysql_query($sqlw,$dgz);
			if ($resultw) {
				//Clear the time stamp session and user file extension
				unlink($upload_path.$large_image_name.$_SESSION['user_file_ext']);

				$_SESSION['random_key']= "";
				$_SESSION['user_file_ext']= "";
				$_SESSION['sess_wid']= "";
				
				unset($_SESSION['random_key']);
				unset($_SESSION['user_file_ext']);
				unset($_SESSION['sess_wid']);
				
				if ($_SESSION['sess_wid'] == "") print "<meta http-equiv=\"refresh\"content=\"0; URL=index.php\">";
			} else {
				echo "ERROR : Cannot post a picture.";
			}
		
		}	else	{
			if (strlen($large_photo_exists) > 0)	{	?>
			
			<form name="thumbnail" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" <?php if ($_SESSION['user_file_ext'] == "") { echo "style='display:none;'"; } ?> >
			<table cellpadding="0" cellspacing="0" class="contentinfo">
				<tr>
                	<td class="tip">
                    <strong>Cropping :</strong><br/>
                    Click cursor on the image below, hold down button &amp; drag cursor across to show crop area. Note: area is locked as a proportional shape.
                    </td>
                </tr>
				<tr>
				  	<td>
					<img src="<?php echo $upload_path.$large_image_name.$_SESSION['user_file_ext'];?>" id="thumbnail" alt="" />
					<div style="position:relative; margin-top:10px; overflow:hidden; width:<?php echo $thumb_width; ?>px; height:<?php echo $thumb_height; ?>px;"><img src="<?php echo $upload_path.$large_image_name.$_SESSION['user_file_ext']; ?>" style="position:relative;" alt="" /></div>
					</td>
				</tr>
				<tr><td><img src="../../images/tools/del.png" alt="" />&nbsp; <a href="conn/clear.php?pic=<?php echo $large_image_name.$_SESSION['user_file_ext'];?>" onclick="return confirm('Do you want to change picture ?');">Change Picture</a></td></tr>
				<tr>
				  	<td style="padding:10px;">
					<input type="submit" name="upload_thumbnail" value="Save a Picture" id="save_thumb" class="but" />
					<input type="hidden" name="x1" value="" id="x1" />
					<input type="hidden" name="y1" value="" id="y1" />
					<input type="hidden" name="x2" value="" id="x2" />
					<input type="hidden" name="y2" value="" id="y2" />
					<input type="hidden" name="w" value="" id="w" />
					<input type="hidden" name="h" value="" id="h" />
				  	</td>
				</tr>
			</table>
			</form>
			
		<?php } ?>
			<script language="javascript">
			function check()	{
				if (document.photo.wtitle_en.value == "")	{
					alert("Please fill in title.");
					document.photo.wtitle_en.focus();
					return false;
				}
				if (document.photo.wtitle_th.value == "")	{
					alert("Please fill in title.");
					document.photo.wtitle_th.focus();
					return false;
				}
				if (document.photo.image.value == "")	{
					alert("Please choose a picture");
					document.photo.image.focus();
					return false;
				}
				return true;
			}
			</script>
		
			<form name="photo" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" <?php if ($_SESSION['user_file_ext'] != "") { echo "style='display:none;'"; } ?> onsubmit="return check();">
            <h3><img src="../../images/tools/add.png" alt="" />&nbsp; Post new Work</h3>	
			<table cellpadding="0" cellspacing="0" class="contentinfo">
                <tr><td class="contenttitle" colspan="2"><img src="../../images/tools/en.jpg" alt="" /> ENGLISH</td></tr>
                <tr>
                    <td style="padding-top:25px; width:160px;">Project / Title :</td>
                    <td style="padding-top:25px; width:740px;"><input name="wtitle_en" type="text" class="box" value="" size="" style="width:700px;" /></td>
                </tr>
                <tr>
                    <td>Topic 1 / Text 1 :</td>
                    <td><input name="wtopic1_en" type="text" class="box" value="" size="" style="width:330px;" /> &nbsp; <input name="wtext1_en" type="text" class="box" value="" size="" style="width:330px;" /></td>
                </tr>
                <tr>
                    <td>Topic 2 / Text 2 :</td>
                    <td><input name="wtopic2_en" type="text" class="box" value="" size="" style="width:330px;" /> &nbsp; <input name="wtext2_en" type="text" class="box" value="" size="" style="width:330px;" /></td>
                </tr>
                <tr>
                    <td>Topic 3 / Text 3 :</td>
                    <td><input name="wtopic3_en" type="text" class="box" value="" size="" style="width:330px;" /> &nbsp; <input name="wtext3_en" type="text" class="box" value="" size="" style="width:330px;" /></td>
                </tr>
                <tr>
                    <td>Topic 4 / Text 4 :</td>
                    <td><input name="wtopic4_en" type="text" class="box" value="" size="" style="width:330px;" /> &nbsp; <input name="wtext4_en" type="text" class="box" value="" size="" style="width:330px;" /></td>
                </tr>
                <tr>
                    <td>Detail / Info :</td>
                    <td><textarea name="wdetail_en" class="box" rows="5" style="width:700px;"></textarea></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
                </tr>
                <tr><td class="contenttitle" colspan="2"><img src="../../images/tools/th.jpg" alt="" /> THAI</td></tr>
                <tr>
                    <td style="padding-top:25px; width:160px;">Project / Title :</td>
                    <td style="padding-top:25px; width:740px;"><input name="wtitle_th" type="text" class="box" value="" size="" style="width:700px;" /></td>
                </tr>
                <tr>
                    <td>Topic 1 / Text 1 :</td>
                    <td><input name="wtopic1_th" type="text" class="box" value="" size="" style="width:330px;" /> &nbsp; <input name="wtext1_th" type="text" class="box" value="" size="" style="width:330px;" /></td>
                </tr>
                <tr>
                    <td>Topic 2 / Text 2 :</td>
                    <td><input name="wtopic2_th" type="text" class="box" value="" size="" style="width:330px;" /> &nbsp; <input name="wtext2_th" type="text" class="box" value="" size="" style="width:330px;" /></td>
                </tr>
                <tr>
                    <td>Topic 3 / Text 3 :</td>
                    <td><input name="wtopic3_th" type="text" class="box" value="" size="" style="width:330px;" /> &nbsp; <input name="wtext3_th" type="text" class="box" value="" size="" style="width:330px;" /></td>
                </tr>
                <tr>
                    <td>Topic 4 / Text 4 :</td>
                    <td><input name="wtopic4_th" type="text" class="box" value="" size="" style="width:330px;" /> &nbsp; <input name="wtext4_th" type="text" class="box" value="" size="" style="width:330px;" /></td>
                </tr>
                <tr>
                    <td>Detail / Info :</td>
                    <td><textarea name="wdetail_th" class="box" rows="5" style="width:700px;"></textarea></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="tip">^ Any copied text (from Microsoftword or other program) MUST be pasted into "Micosoft Note Pad application" first, then re-copied into the text area editor below. This is to stop uni-code (which is in Word) getting into the system.</td>
                </tr>
        		<tr><td class="contenttitle" colspan="2"><img src="../../images/tools/img.jpg" alt="" /> Picture</td></tr>
                <tr>
                    <td style="padding-top:25px;">Choose (File) :</td>
                    <td style="padding-top:25px;"><input name="image" type="file" class="box" size="" style="width:400px;" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
					<td class="tip">
					^ 600 Pixels for maximum of width size (265 x 200 Pixels for Thumbnail size)<br />
					^ 1 MB for file size and .JPG, .PNG, GIF for file type
					</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                    <input type="submit" name="upload" value="Post" class="but"/>
                    <input type="reset" name="Reset" value="Reset" class="but"/>
                    <input name="chk" type="hidden" value="1" />
                    </td>
                </tr>
            </table>
			</form>
			
		<?php } ?>
	</div>
	
</body>
</html>