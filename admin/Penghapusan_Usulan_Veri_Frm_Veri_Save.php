<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$nO  = str_replace('**',' ',$nO);
$mE  = str_replace('**',' ',$mE);
$gNm = str_replace('**',' ',$gNm);
$gJb = str_replace('**',' ',$gJb);
$gNi = str_replace('**',' ',$gNi);

$TgL = $gT."-".$gB."-".$gH;
$nSQ = "UPDATE ta_usulan_verifikasi_108 SET Tanggal='$TgL', Nomor='$nO', Nma_Verifikator='$gNm', Jab_Verifikator='$gJb',Nip_Verifikator='$gNi', Uraian='$mE', 
Pencatat='$UID',
Recorded=now() 
WHERE IDT='$rID'";
$nRs = mysql_query($nSQ);
?>
<script languange="javascript">
	showFORM('<?=$ReO?>','refr','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>');
</script>