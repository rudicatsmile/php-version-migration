<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

if ($mID){
	$DT  = fGlobal("Referensi:Kd_Kegiatan:Kd_Upb","ta_rkpbmd","IDO",$mID,"=","","");
	$DT = explode(":",$DT);
	$gRf = $DT[0];
	$gKe = $DT[1];
	$gUp = $DT[2];
	
	$NmR = fGlobal("nmRekening","ta_apbd_rekening_skpd","kdRekening:kdUnit",$KdR.":".substr($gUp,0,11)."%","=:LIKE","","");
	
	$SQL = "INSERT INTO ta_rkpbmd_rinci SET 
	Referensi='$gRf',
	Rekening='$KdR',
	Nm_Rekening='$NmR',
	Deskripsi='',
	Lokasi='',
	Qty='0',
	Satuan='',
	Harga='0',
	Jumlah='0',
	Pencatat='$UID', Recorded=now()";
	$rst = mysql_query($SQL);
}
	
?>
<script languange="javascript">
	//P_Next('<?=$MsG?>','<?=$IdL?>');
	P_EditItemAset('refr','<?=$mID?>','','<?=$IdL?>')
</script>