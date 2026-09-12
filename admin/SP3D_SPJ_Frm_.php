<?php
require('Connection.php');
require('FileFunction.php');
extract($_POST);
extract($_GET);

if ($fSave=='Upload')
{
	$file_name = $_FILES['imgfile']['name']; 		//nama file (tanpa path)
	$tmp_name  = $_FILES['imgfile']['tmp_name']; 	//nama local temp file di server
	$file_size = $_FILES['imgfile']['size']; 		//ukuran file (dalam bytes)
	$file_type = $_FILES['imgfile']['type']; 		//tipe filenya (langsung detect MIMEnya)
	$fp = fopen($tmp_name, 'r'); 				// open file (read-only, binary)
	$file_content = fread($fp, $file_size) or die("Tidak dapat membaca source file..!!"); // read file
	$file_content = mysql_real_escape_string($file_content) or die("Tidak dapat membaca source file..!!"); // parse image ke string
	fclose($fp);
	
	$gRA = fGlobal("Referensi","ta_sp3d_spj_rinci","IDT",$UplIdT,"=","","");
	$nSQL = "INSERT INTO ta_sp3d_spj_rinci_file SET 
	Referensi='$gRA',
	Kd_UPB='$fUPB',
	Memo='x-x-x',
	file_content='$file_content', 
	file_name='$file_name', 
	file_type='$file_type', 
	file_size='$file_size'";
	$nRs = mysql_query($nSQL);
	$URL="SP3D_SPJ_Frm.php?IdT=".$IdT."&LoadfIdT=".$fIdT."&FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
else if ($fSave=='Refresh'){
	$URL="SP3D_SPJ_Frm.php?IdT=".$IdT."&LoadfIdT=".$fIdT."&FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
else if ($fSave=='Reset'){
	$URL="SP3D_SPJ_Frm.php?FrmG=".$FrmG."&gUPB=".$fUPB."&IdL=".$IdL;
	header("Location: ".$URL);
}

?>