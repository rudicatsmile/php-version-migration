<?php
require_once "Connection.php";

$rIDT = $_GET['rIDT'] ?? '';
$rCRT = $_GET['rCRT'] ?? '';
$IdL  = $_GET['IdL'] ?? '';
$Simpan = $_POST['Simpan'] ?? '';

$targetDir = __DIR__ . "/../simandor/images/";
if (!is_dir($targetDir)) {
	@mkdir($targetDir, 0755, true);
}

if ($Simpan == "Upload")
{
	if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
		$err = $_FILES['file']['error'] ?? 'No File';
		echo "<script>alert('Gagal upload file gambar (Kode error: $err).'); history.back();</script>";
		exit;
	}

	$origName = $_FILES['file']['name'];
	$tmpName  = $_FILES['file']['tmp_name'];
	$fileSize = (int)$_FILES['file']['size'];

	// Validasi ukuran file (Max 5 MB)
	$maxBytes = 5 * 1024 * 1024;
	if ($fileSize <= 0 || $fileSize > $maxBytes) {
		echo "<script>alert('Ukuran file tidak valid atau melebihi batas 5 MB.'); history.back();</script>";
		exit;
	}

	// Validasi ekstensi file
	$allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
	$rawExt = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
	if (!in_array($rawExt, $allowedExts)) {
		echo "<script>alert('Format file tidak didukung. Harap upload gambar JPG, PNG, GIF, atau WebP.'); history.back();</script>";
		exit;
	}

	// Deteksi MIME type secara riil dari file temp
	$fileType = '';
	if (function_exists('finfo_open')) {
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$fileType = finfo_file($finfo, $tmpName);
		finfo_close($finfo);
	} elseif (function_exists('mime_content_type')) {
		$fileType = mime_content_type($tmpName);
	} else {
		$fileType = $_FILES['file']['type'] ?? 'image/jpeg';
	}

	$allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp', 'image/x-ms-bmp'];
	if (!in_array(strtolower((string)$fileType), $allowedMimes)) {
		echo "<script>alert('File bukan merupakan gambar yang valid.'); history.back();</script>";
		exit;
	}

	// Hapus file fisik lama jika ada sebelumnya untuk rIDT ini
	deleteExistingPhysicalFile($targetDir, $rIDT);

	// Generate nama file baru yang aman dan unik
	$cleanBase = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
	$uniqueSuffix = date('Ymd_His') . '_' . substr(md5(uniqid((string)mt_rand(), true)), 0, 8);
	$storedNameToDB = $cleanBase . '_' . $uniqueSuffix . '.' . $rawExt;
	$physicalFileName = $rIDT . 'xyz' . $storedNameToDB;
	$destination = $targetDir . $physicalFileName;

	if (!move_uploaded_file($tmpName, $destination)) {
		echo "<script>alert('Gagal menyimpan file gambar ke server.'); history.back();</script>";
		exit;
	}

	// Update database: simpan nama/path file fisik ke file_name dan file_content
	$cleanDbName = mysql_real_escape_string($storedNameToDB);
	$cleanType   = mysql_real_escape_string($fileType);
	$cleanSize   = (int)$fileSize;

	$nSQL = "UPDATE ta_kib_108 SET 
	file_content='$cleanDbName', 
	file_name='$cleanDbName', 
	file_type='$cleanType', 
	file_size='$cleanSize' WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQL) or die(mysql_error());


	echo CloseWin($rIDT, $rCRT, $IdL);
}

if ($Simpan == "Delete")
{
	// Hapus file fisik dari disk
	deleteExistingPhysicalFile($targetDir, $rIDT);

	// Reset kolom di database
	$nSQL = "UPDATE ta_kib_108 SET 
	file_content='', 
	file_name='', 
	file_type='', 
	file_size='0' WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQL) or die(mysql_error());

	echo CloseWin($rIDT, $rCRT, $IdL);
}

function deleteExistingPhysicalFile($targetDir, $rIDT)
{
	if (empty($rIDT)) return;

	$rIDTEsc = mysql_real_escape_string($rIDT);
	$q = mysql_query("SELECT file_name FROM ta_kib_108 WHERE IDT='$rIDTEsc'");
	if ($q && $row = mysql_fetch_assoc($q)) {
		$oldName = $row['file_name'];
		if (!empty($oldName)) {
			$candidates = [
				$targetDir . $rIDT . 'xyz' . $oldName,
				$targetDir . $oldName
			];
			foreach ($candidates as $f) {
				if (file_exists($f) && is_file($f)) {
					@unlink($f);
				}
			}
		}
	}

	// Hapus juga file dengan pola IDTxyz* yang mungkin tersisa
	$pattern = $targetDir . $rIDT . 'xyz*';
	$matches = glob($pattern);
	if (is_array($matches)) {
		foreach ($matches as $match) {
			if (is_file($match)) {
				@unlink($match);
			}
		}
	}
}

function CloseWin($rIDT, $rCRT, $IdL)
{
	$URL = "Form_Asset_" . strtoupper((string)$rCRT) . "_Mid.php?rIDT=" . $rIDT . "&IdL=" . $IdL;
	?>
	<script language='JavaScript'>
	if (window.opener && !window.opener.closed) {
		try { window.opener.location.href = '<?=$URL?>'; } catch(e) {}
	}
	try {
		var targetFrame = window.parent.frames['WinFormKIB_Mid'] || (window.top && window.top.frames['WinFormKIB_Mid']);
		if (targetFrame) {
			targetFrame.location.href = '<?=$URL?>';
		}
	} catch(e) {}
	this.window.open('<?=$URL?>','WinFormKIB_Mid');
	this.window.focus();
	this.setTimeout('self.close()', 100);
	</script>
	<?php
}
?>
