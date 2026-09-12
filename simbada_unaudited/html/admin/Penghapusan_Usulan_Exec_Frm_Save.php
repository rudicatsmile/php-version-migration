<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$gDT = fGlobal("referensi:kd_aset:ref_aset:ref_usulan:kib_to:to_kd_aset:mutasi_tanggal:kd_upb:no_register","ta_usulan_verifikasi_rinci_108","IDT",$tID,"=","","");
if ($gDT)
{
	$gDT = explode(":",$gDT);
	$RfV = $gDT[0];
	$RfA = $gDT[2];
	$RfU = $gDT[3];
	$frUPB = substr($gDT[7],0,11);
	$NoRG  = $gDT[8];
	$gJN = fGlobal("Jenis","ta_usulan_verifikasi_108","Referensi",$RfV,"=","","");
	
	if ($gJN=="PH")
	{
		require('Penghapusan_Usulan_Exec_Frm_Save_PH.php');
		if ($rBatal=='YA')
		{
			UnExecuteRC($NoRG,$frUPB,$RfA,$RfU,$tID,$UID);
		}
		else
		{
			ExecuteRC($NoRG,$frUPB,$RfA,$RfU,$tID,$UID);
		}
	}
}
?>
<script languange="javascript">
	showEXEC_RefR('','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>');
</script>