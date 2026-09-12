<?php 
require('Connection.php');
require('FileFunction.php');
$gUser = 'xxxxx';//base64_decode($gUser); 

extract($_GET);
#if (isset($_GET['IdL'])) {$IdL = $_GET['IdL'];}
#if (isset($_GET['IdT'])) {$IdT = $_GET['IdT'];}
#if (isset($_GET['Ref'])) {$Ref = $_GET['Ref'];}

$fBK = ReplaceTextPHP($fBK);
$Tg  = fMakeDate($fRa,$fRb,$fRc);

$SQ = "UPDATE ta_pengadaan SET 
Tgl_Cair='".$Tg."',
No_BKU='".$fBK."',
JmlPencairan='".fConvertToNumeric($fNI)."',
Recorded_Rekon=now(),
Pencatat_Rekon='$gUser' WHERE IDT='".$IdT."'";
$rs = mysql_query($SQ);

?>
<script languange="javascript"> 
showRECO('refr','<?=$Ref?>','<?=$IdT?>','<?=$IdL?>');
</script>