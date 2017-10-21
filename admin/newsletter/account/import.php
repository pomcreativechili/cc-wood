<?php
	include('../../config/chksession.php');
	require_once('../../../Connections/dgz.php');
	
	$egid = $_REQUEST['egid'];
	$_SESSION['sess_padmin'] = "newsletter/account/import.php?egid=$egid";

	$chk = $_POST['chk'];
	if ($chk == "1")	{
		$emset = date("ymdHis");

		$emfile = $_FILES['emfile']['tmp_name'];
		$emfilename = $_FILES['emfile']['name'];
		if ($emfile != "")	{
			$emnew = $emset."_".str_replace(" ","_","$emfilename");
			if (is_uploaded_file($emfile)) copy($emfile,"sources/".$emnew);
		}

		// Import excel
		require_once('classes/PHPExcel.php');
		include('classes/PHPExcel/IOFactory.php');
		
		$inputFileName = "sources/".$emnew;  
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
		$objReader->setReadDataOnly(true);  
		$objPHPExcel = $objReader->load($inputFileName);  
		
		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
		$highestRow = $objWorksheet->getHighestRow();
		$highestColumn = $objWorksheet->getHighestColumn();
		
		$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
		$headingsArray = $headingsArray[1];
		
		$r = -1;
		$namedDataArray = array();
		for ($row = 2; $row <= $highestRow; ++$row) {
			$dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
			if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
				++$r;
				foreach($headingsArray as $columnKey => $columnHeading) {
					$namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
				}
			}
		}
		
		echo '
		<p style="text-align:center; font-size:16px; font-family:Trebuchet MS; padding:20px;">
		<img src="../../images/tools/loading.gif" alt="" style="vertical-align:text-bottom;"/>&nbsp; 
		Please wait ...
		</p>
		';
		
		$num = 0;
		foreach ($namedDataArray as $result) {
			$num++;
			$emid = $emset.$num;
			$sqlem = "INSERT INTO tb_email_account VALUES ";
			$sqlem .= "('$emid','$emset','$egid','".$result["Name"]."','".$result["Email Address"]."','".date("Y-m-d H:i:s")."','1')";
			$resultem = mysql_query($sqlem, $dgz);
			if ($resultem) { continue; } 
			else { print "<meta http-equiv=\"refresh\"content=\"0; URL=import.php?egid=$egid&err=1\">"; exit(); } 
		}
		
		if (unlink($inputFileName)) print "<meta http-equiv=\"refresh\"content=\"0; URL=index.php?egid=$egid\">";
		exit();
	}

	$sqleg = "select * from tb_email_group WHERE egid='$egid'";
	$resulteg = mysql_query($sqleg, $dgz) or die(mysql_error());
	$eg = mysql_fetch_array($resulteg);
	
	$err = $_GET['err'];
	if ($err == "1") $error = "<p class='err'><img src='../../images/tools/err.png' alt='' />&nbsp; ERROR : Can not post new account.</p>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function check()	{
	if (document.form1.emfile.value == "")	{
		alert("Please choose an Excel file.");
		document.form1.emfile.focus();
		return false;
	}
	if (confirm("Do you confirm to import this Excel?")) return true;
	else return false;
}
</script> 
</head>

<body>
	<p id="nav">
    	<a href="../group/update.php?egid=<?php echo $egid;?>"><?php echo $eg[egtitle];?></a> &nbsp;&gt;&nbsp; 
    	<a href="index.php?egid=<?php echo $egid;?>">All Accounts</a> &nbsp;&gt;&nbsp; 
		<strong>Import from Excel</strong>
	</p>
	
	<div id="content">
        <form action="import.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check();">
		<?php echo $error;?>
		<h3><img src="../../images/tools/add.png" alt="" />&nbsp; Import from Excel</h3>	
		<table cellpadding="0" cellspacing="0" class="contentinfo">
			<tr>
				<td style="padding-top:25px; width:160px;">Choose / Excel (File) :</td>
				<td style="padding-top:25px; width:740px;"><input name="emfile" type="file" class="box" value="" style="width:400px;" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="tip">
				^ The first column must be "Name", The second column must be "Email Address"<br />
                ^ .XLS, .XLSX for file type<br />
                </td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
                <input type="submit" name="Submit1" value="Import" class="but"/>
                <input type="reset" name="Submit2" value="Reset" class="but"/>
                <input name="chk" type="hidden" value="1" />
                <input name="egid" type="hidden" value="<?php echo $egid;?>" />
				</td>
			</tr>
		</table>
        </form>
	</div>
	
</body>
</html>