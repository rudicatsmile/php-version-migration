<?php require "Connection.php"; ?>
<?php
if (isset($_GET['rCRT'])) {
	$rCRT = $_GET['rCRT'];
}
if (isset($_GET['rIDT'])) {
	$rIDT = $_GET['rIDT'];
}
#$query = "SELECT file_content, file_type, file_name FROM ta_kib_".strtolower(substr($rCRT,0,1))." where IDT='".$rIDT."'";
$query = "SELECT file_content, file_type, file_name FROM ta_kib_108 where IDT='" . $rIDT . "'";
// echo $query;
$data = mysql_query($query);
$data = mysql_fetch_array($data);
$gCont = $data[0];
$gType = $data[1];
$nName = $data[2];

// DEBUG MODE
// echo "IDT: " . $rIDT . "<br>";
// echo "Query: " . $query . "<br>";
// echo "Name from DB: " . $nName . "<br>";
// echo "Has Content: " . (!empty($gCont) ? "YES" : "NO") . "<br>";

//$idt = $data[3];
if ($nName != "") {
	//Jika field file_content ada isi, maka tampilkan isi field tersebut
	if (!empty($gCont)) {
		header("Content-type: $gType");   // parsing ke mime tipe
		echo $gCont;

	} else {
		//Jika field file_content tidak ada isi, maka cek apakah file ada di folder images

		// $aa = "279xyzIMG-20260203-WA0008.jpg";
		// $Ar = explode("xyz", $aa);
		// $Val1 = $Ar[0]; // 279
		// $Val2 = $Ar[1]; // IMG-20260203-WA0008.jpg


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
	header("Content-type: image/gif");   // parsing ke mime tipe
	readfile("Images/FileLogin_14.gif");
}
?>