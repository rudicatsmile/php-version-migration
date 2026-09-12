<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
#echo $IdT
if ($IdT)
{
	$Ref = fGlobal("Referensi","ta_permohonan_repla_rek_aset","IDT",$IdT,"=","","");
	if ($Ref){
		#verifikasi
		#$nSQ = "DELETE FROM ta_usulan_verifikasi WHERE Ref_Usulan='$Ref'";
		#$nRs = mysql_query($nSQ);
		
		#$nSQ = "DELETE FROM ta_usulan_verifikasi_rinci WHERE Ref_Usulan='$Ref'";
		#$nRs = mysql_query($nSQ);
		
		#$nSQ = "DELETE FROM ta_usulan_verifikasi_rinci_syarat WHERE Ref_Usulan='$Ref'";
		#$nRs = mysql_query($nSQ);
		
		#$eSQ = "SELECT Ref_Aset,IdTTaKib FROM ta_usulan_rinci WHERE Referensi='".$Ref."' AND IdTTaKib<>'' ORDER BY IdTTaKib";
		#$eRs = mysql_query($eSQ);
		#while ($eRo = mysql_fetch_array($eRs, MYSQL_BOTH))
		#{
		#	$ReA = $eRo[0];
		#	$IdTTaKib = $eRo[1];
		#	$rTbL= CekRefToNmTbl($ReA);
		#	$SQ = "UPDATE ta_kib_".$rTbL." SET MasukKeUsulan='belum' WHERE IDT='".$IdTTaKib."'";
		#	$rs = mysql_query($SQ);
		#}
		
		#usulan
		$nSQ = "DELETE FROM ta_permohonan_repla_rek_aset_rinci WHERE Referensi='$Ref'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_permohonan_repla_rek_aset WHERE IDT='$IdT'";
		$nRs = mysql_query($nSQ);
	}
}
?>
<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
</script>