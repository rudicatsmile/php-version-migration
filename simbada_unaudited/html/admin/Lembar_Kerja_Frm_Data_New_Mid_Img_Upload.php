<?
require('Connection.php');
require('FileFunction.php');
$data = array();
extract($_GET);
extract($_POST);

if ($CrT=='Img'){
	$file_name = $_FILES['imgfile']['name']; 		//nama file (tanpa path)
	$tmp_name  = $_FILES['imgfile']['tmp_name']; 	//nama local temp file di server
	$file_size = $_FILES['imgfile']['size']; 		//ukuran file (dalam bytes)
	$file_type = $_FILES['imgfile']['type']; 		//tipe filenya (langsung detect MIMEnya)
	$TbL='tb_lembar_kerja_foto_denah';
}
else{
	$file_name = $_FILES['imgfile2']['name']; 		//nama file (tanpa path)
	$tmp_name  = $_FILES['imgfile2']['tmp_name']; 	//nama local temp file di server
	$file_size = $_FILES['imgfile2']['size']; 		//ukuran file (dalam bytes)
	$file_type = $_FILES['imgfile2']['type']; 		//tipe filenya (langsung detect MIMEnya)
	$TbL='tb_lembar_kerja_dokumen';
}

$fp = fopen($tmp_name, 'r'); 					//open file (read-only, binary)
$file_content = fread($fp, $file_size) or die("Tidak dapat membaca source file..!!"); // read file
$file_content = mysql_real_escape_string($file_content) or die("Tidak dapat membaca source file..!!"); // parse image ke string
fclose($fp);

$eRf = fGlobal("Referensi","tb_lembar_kerja_belum_tercatat","IDT",$IdT,"=","","");
$eRg = '';
$eUp = fGlobal("KdUPB","tb_lembar_kerja_belum_tercatat","IDT",$IdT,"=","","");

$SQ = "INSERT INTO $TbL SET 
Referensi='".$eRf."',
RefGroup='".$eRg."',
KdUPB='".$eUp."',
file_content='".$file_content."', 
file_name='".$file_name."', 
file_type='".$file_type."', 
file_size='".$file_size."'";
$rs = mysql_query($SQ);

?>
<script languange="javascript">
NewAset('refr','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>');
</script>