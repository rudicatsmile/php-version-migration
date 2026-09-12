<?php
include "Connection.php";
include "CheckLogin.php";
include 'Upload_Xls_Code.php';

$gUnt= $_GET['gUnt'];
$gSub= $_GET['gSub'];
$gUpb= $_GET['gUpb'];
$gThn= $_GET['gThn'];
$gKib= $_GET['gKib'];

if (isset($_POST['Simpan']))
{
	if ($_POST['Simpan']=="Close")
	{
		$URLK = "Import_KIB_Mid.php?gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gKib=".$gKib."&IdL=".$_GET['IdL'];
		?>
		<script language="JavaScript">  	
		this.window.open ('<?php echo $URLK ?>','WinOpenXLS_Mid<?=$gKib?>')
		this.window.focus()
		this.window.document.clear()
		this.window.document.close() 
		this.setTimeout("self.close()",1)
		</script>
		<?php
	}
}

if(isset($_POST['upload_file']))
{
	//$user_file = $_FILES["car_info_file"]["name"];
	//upload_files($_FILES["car_info_file"]["name"]);
	upload_files($gUpb,$gThn,$gKib,$UID);
	
}
?>
<link rel="stylesheet" href="css/style_upload_mid.css" type="text/css" media="all" />
<body>
<form name="uploadfile" action="<?php echo "Upload_Xls_Mid.php?gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gKib=".$gKib."&IdL=".$_GET['IdL'] ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="Simpan">
<table>
	<tr>
	<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
      <td width="120" align>Pilih File (*.xls)</td>
      <td><input type="file" name="car_info_file" id="car_info_file" size="45"/></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td><input type="submit" name="upload_file" value="Upload" style="width:90" />
        <input type="button" name="upload_clos" value="Close" onClick="P_Close()" style="width:90" /></td>
	</tr>
</table>
</form>
</body>
<script language="javascript">
	var objfrm=document.uploadfile;
	function P_Close()
	{
		objfrm.Simpan.value = "Close";
		objfrm.target="_top";
		objfrm.submit();
	}
</script>