<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

#$ReU = fGlobal("Referensi",    "ta_usulan_rinci_108","IDT",$rIdT,"=","","");
#$ReA = fGlobal("Ref_Aset",     "ta_usulan_rinci_108","IDT",$rIdT,"=","","");
#$IdTTaKib = fGlobal("IdTTaKib","ta_usulan_rinci_108","IDT",$rIdT,"=","","");

$RetDTA = fGlobal("Referensi:Ref_Aset:IdTTaKib","ta_usulan_rinci_108","IDT",$rIdT,"=","","");
if ($RetDTA)
{
	$ReDTA = explode(":",$RetDTA);
	$ReU   = $ReDTA[0];
	$ReA   = $ReDTA[1];
	$IdTTaKib = $ReDTA[2];

	if ($DelVer=="Ya"){
		#Bila sudah masuk tabel verifikasi
		$nSQ = "DELETE FROM ta_usulan_verifikasi_rinci_108 WHERE Ref_Usulan='$ReU' AND Ref_Aset='$ReA'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_usulan_verifikasi_rinci_syarat_108 WHERE Ref_Usulan='$ReU' AND Ref_Aset='$ReA'";
		$nRs = mysql_query($nSQ);
	}
	
	$nSQ = "DELETE FROM ta_usulan_rinci_file_108 WHERE Referensi='$ReU' AND Ref_Aset='$ReA'";
	$nRs = mysql_query($nSQ);
	
	if ($IdTTaKib!=''){
		$rTbL= CekRefToNmTbl($ReA);
		$eSQ = "UPDATE ta_kib_108 SET MasukKeUsulan='belum' WHERE IDT='".$IdTTaKib."'";
		$eRs = mysql_query($eSQ);
	}
	
	$nSQ = "DELETE FROM ta_usulan_rinci_108 WHERE IDT='$rIdT'";
	$nRs = mysql_query($nSQ);
}

?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>','<?=$PgE?>');
</script>
