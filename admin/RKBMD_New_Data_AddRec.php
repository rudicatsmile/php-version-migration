<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$gKd  = str_replace('**',' ',$gKd);
$gNm  = str_replace('**',' ',$gNm);

$nSQ = "INSERT INTO ta_rkbmd SET 
Kd_Upb='$gUPB',
Kd_Kegiatan='$gKEG',
Tahun='$gTHN',
Kd_Aset='$gKd',
Nm_Aset='$gNm',
Deskripsi='',
Merk_Type='',
Ukuran='',
Qty='0',
Satuan='',
Harga='0',
Jumlah='0',
Pencatat='$UID', Recorded=now()";
$nRs = mysql_query($nSQ);
$MsG="Penambahan item baru berhasi..!!";
?>
<script languange="javascript">
	P_Next('<?=$MsG?>','<?=$IdL?>');
</script>