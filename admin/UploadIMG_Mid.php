<?php
require_once "Connection.php";
$rIDT = $_GET['rIDT'] ?? '';
$rCRT = $_GET['rCRT'] ?? '';
$IdL  = $_GET['IdL'] ?? '';

$currentFile = "";
$currentSize = 0;
if ($rIDT != "") {
	$q = mysql_query("SELECT file_name, file_size FROM ta_kib_108 WHERE IDT='".mysql_real_escape_string($rIDT)."'");
	if ($q && $row = mysql_fetch_assoc($q)) {
		$currentFile = $row['file_name'] ?? '';
		$currentSize = (int)($row['file_size'] ?? 0);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
</head>
<body>
<table align="center" style="width:420px; font-family: Calibri, sans-serif; font-size: 10pt;">
<tr>
  <td width="30" align="center">&nbsp;</td>
  <td align="left">&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td><b>Pilih File Foto (Max 5 MB, Format: JPG/PNG/GIF/WebP):</b></td>
</tr>
<?php if (!empty($currentFile)) { ?>
<tr>
  <td>&nbsp;</td>
  <td style="color: #006600; padding: 4px 0;">
    Foto terpasang: <b><?=htmlspecialchars($currentFile)?></b> <?php if ($currentSize > 0) { echo "(".round($currentSize/1024, 1)." KB)"; } ?>
  </td>
</tr>
<?php } ?>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>
    <form method="post" name="myfrm" action="UploadIMG_Mid_.php?rIDT=<?=urlencode($rIDT)?>&rCRT=<?=urlencode($rCRT)?>&IdL=<?=urlencode($IdL)?>" enctype="multipart/form-data">
      <input name="file" type="file" accept="image/jpeg,image/png,image/gif,image/webp" style="width: 350px;" /><br /><br />
      <input type="hidden" name="Simpan" />
      <input type="button" value="Upload" onclick="P_Save()" style="padding: 3px 15px; font-weight: bold;" />
      <?php if (!empty($currentFile)) { ?>
      <input type="button" value="Delete" onclick="P_Dele()" style="padding: 3px 15px; color: #cc0000;" />
      <?php } ?>
    </form>
  </td>
</tr>
</table>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Save()
	{
		if (objfrm.file.value=="")
		{
			window.alert('Silahkan pilih file gambar terlebih dahulu..!!');
		}
		else
		{
			objfrm.Simpan.value = "Upload";
			objfrm.submit();
		}
	}
	
	function P_Dele()
	{
		var AN = confirm("Hapus foto objek aset ini dari server..?!!");
		if (AN)
		{
			objfrm.Simpan.value = "Delete";
			objfrm.submit();
		}
	}
</script>
