<?php require "Connection.php"; ?>
<?php
if (isset($_GET['rCRT'])) {
	$rCRT = $_GET['rCRT'];
}
if (isset($_GET['rIDT'])) {
	$rIDT = $_GET['rIDT'];
}
#$query = "SELECT file_content, file_type, file_name, file_size FROM ta_kib_".strtolower(substr($rCRT,0,1))." where IDT='".$rIDT."'";
$query = "SELECT file_content, file_type, file_name, file_size FROM ta_kib_108 where IDT='" . $rIDT . "'";
$data = mysql_query($query);
$data = mysql_fetch_array($data);
$gCont = $data[0];
$gType = $data[1];
$nName = $data[2];
$nSize = $data[3];
if ($nName != "") {
	//Jika field file_content ada isi, maka tampilkan isi field tersebut
	if (!empty($gCont)) {
		header("Content-length: $nSize");
		header("Content-type: $gType");   // parsing ke mime tipe
		echo $gCont;
	} else {
		$nName = $rIDT . "xyz" . $nName;
		$nPath = "../simandor/images/$nName";

		if (file_exists($nPath)) {
			if ($gType != "") {
				header("Content-type: $gType");
			}
			readfile($nPath);
		}
	}
} else {
	echo "<img src='Images/FileLogin_70' height='20' width='20'>";
}
?>