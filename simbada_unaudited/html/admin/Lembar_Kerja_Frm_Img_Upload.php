<?
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
	$TbL='tb_lembar_kerja_foto_denah';
}
else
{
	$file_name = $_FILES['imgfile2']['name']; 		//nama file (tanpa path)
	$tmp_name  = $_FILES['imgfile2']['tmp_name']; 	//nama local temp file di server
	$file_size = $_FILES['imgfile2']['size']; 		//ukuran file (dalam bytes)
	$file_type = $_FILES['imgfile2']['type']; 		//tipe filenya (langsung detect MIMEnya)
	$TbL='tb_lembar_kerja_dokumen';
}
#echo $TbL;
$fp = fopen($tmp_name, 'r'); 					//open file (read-only, binary)
$file_content = fread($fp, $file_size) or die("Tidak dapat membaca source file..!!"); // read file
$file_content = mysql_real_escape_string($file_content) or die("Tidak dapat membaca source file..!!"); // parse image ke string
fclose($fp);

#echo "xxxxxxxx ".$ImgIDT;

if ($ImgIDT)
{
	$SQ = "UPDATE $TbL SET 
	file_content='".$file_content."', 
	file_name='".$file_name."', 
	file_type='".$file_type."', 
	file_size='".$file_size."' WHERE IDT='".$ImgIDT."'";
	$rs = mysql_query($SQ);
}
else
{
	#$eRf = fGlobal("Referensi","ta_kib_post_108_sensus_2023","IDT",$IdT,"=","","");
	#$eRg = fGlobal("Ref_Group","ta_kib_post_108_sensus_2023","IDT",$IdT,"=","","");
	#$eUp = fGlobal("Kd_UPB","ta_kib_post_108_sensus_2023","IDT",$IdT,"=","","");
	
	$eRf = fGlobal("Referensi","tb_lembar_kerja","IDT",$SnsIDT,"=","","");
	$eRg = fGlobal("RefGroup","tb_lembar_kerja","IDT",$SnsIDT,"=","","");
	$eUp = fGlobal("KdUPB","tb_lembar_kerja","IDT",$SnsIDT,"=","","");
	
	$SQ = "INSERT INTO $TbL SET 
	Referensi='".$eRf."',
	RefGroup='".$eRg."',
	KdUPB='".$eUp."',
	file_content='".$file_content."', 
	file_name='".$file_name."', 
	file_type='".$file_type."', 
	file_size='".$file_size."'";
	#echo $SQ;
	$rs = mysql_query($SQ);
}
?>
<script languange="javascript">
showLKI('refr','<?=$AsT?>','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>');
</script>