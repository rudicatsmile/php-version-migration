<?php
require('Connection.php');
require('FileFunction.php');
$data = array();
extract($_GET);
extract($_POST);

if ($CrT=='Img')
{
	$file_name = $_FILES['imgfile']['name']; 		//nama file (tanpa path)
	$tmp_name  = $_FILES['imgfile']['tmp_name']; 	//nama local temp file di server
	$file_size = $_FILES['imgfile']['size']; 		//ukuran file (dalam bytes)
	$file_type = $_FILES['imgfile']['type']; 		//tipe filenya (langsung detect MIMEnya)
	#$TbL='tb_lembar_kerja_foto_denah';
	$TbL='tb_lembar_kerja_upload_img';
	$FbR='upload_img';
}
else
{
	$file_name = $_FILES['imgfile2']['name']; 		//nama file (tanpa path)
	$tmp_name  = $_FILES['imgfile2']['tmp_name']; 	//nama local temp file di server
	$file_size = $_FILES['imgfile2']['size']; 		//ukuran file (dalam bytes)
	$file_type = $_FILES['imgfile2']['type']; 		//tipe filenya (langsung detect MIMEnya)
	#$TbL='tb_lembar_kerja_dokumen';
	$TbL='tb_lembar_kerja_upload_pdf';
	$FbR='upload_pdf';
}

$arr = array('png','jpg','pdf');
$fel = explode('.', $file_name); 
$eks = strtolower(end($fel));

$OrigName = str_replace('.','',$file_name);
$OrigName = str_replace('.','-',$OrigName);
$OrigName = str_replace($eks,'',$OrigName);
$OrigName.= ".".$eks;

$MsG = "";
if ($file_size<=2100000)
{
	$eRf = fGlobal("Referensi","tb_lembar_kerja","IDT",$SnsIDT,"=","","");
	$eRg = fGlobal("RefGroup","tb_lembar_kerja","IDT",$SnsIDT,"=","","");
	$eUp = fGlobal("KdUPB","tb_lembar_kerja","IDT",$SnsIDT,"=","","");
	
	$NewNomo = "";
	$NoM  = fGlobal("max(filename)",$TbL,"referensi",$eRf,"=","","");
	if (!$NoM)
	{
		$NoM = 1;
	}
	else
	{
		$NoM = substr($NoM,17,3);
		$NoM = (int)(substr($NoM,-3,3))+1;
	}
	
	$NewName = $eRf."-".substr('000'.$NoM,-3,3).".".$eks;
	
	$SQ = "INSERT INTO $TbL SET 
	Referensi='".$eRf."',
	RefGroup='".$eRg."',
	KdUPB='".$eUp."',
	Periode='2026',
	deskripsi='',
	filename='".$NewName."',
	filename_asli='".$file_name."',
	filetype='".$file_type."',
	filesize='".$file_size."'";
	mysql_query($SQ);
	
	move_uploaded_file($tmp_name, $FbR.'/'.$NewName);
	
	/*
	$SQ = "INSERT INTO $TbL SET 
	Referensi='".$eRf."',
	RefGroup='".$eRg."',
	KdUPB='".$eUp."',
	file_content='".$file_content."', 
	file_name='".$file_name."', 
	file_type='".$file_type."', 
	file_size='".$file_size."'";
	$rs = mysql_query($SQ);
	*/
}
else
{
	$MsG = "Maksimal ukuran file foto (2 MB)...proses dibatalkan..!!";
}

?>
<script languange="javascript">
showLKI('refr','<?=$AsT?>','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>');
</script>