<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$gDT = fGlobal("referensi:kd_aset:ref_aset:ref_usulan:kib_to:to_kd_aset:mutasi_tanggal:kd_upb:no_register","ta_usulan_verifikasi_rinci_108","IDT",$tID,"=","","");
if ($gDT){
	$gDT = explode(":",$gDT);
	$RfV = $gDT[0];
	
	$RfA = $gDT[2];
	$RfU = $gDT[3];
	$TbK = fNmHuruf((int)substr($gDT[1],0,2));
	$ToKiB  = $gDT[4];
	$ToAsT  = $gDT[5];
	$TglMts = $gDT[6];
	$frUPB  = substr($gDT[7],0,11);
	$NoRG   = $gDT[8];
	
	$UdTRCI = 'NO';
	$gJN = fGlobal("Jenis","ta_usulan_verifikasi_108","Referensi",$RfV,"=","","");
	
	if ($gJN=="RB")			#RUSAK BERAT #R
	{
		require('Invent_Usulan_Exec_Frm_Save_RB.php');
		if ($rBatal=='YA'){
			UnExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="HB")	#HIBAH
	{
		require('Invent_Usulan_Exec_Frm_Save_HB.php');
		if ($rBatal=='YA'){
			UnExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="LE")	#LELANG #R
	{
		require('Invent_Usulan_Exec_Frm_Save_LE.php');
		if ($rBatal=='YA'){
			UnExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="PL")	#DALAM PENELUSURAN #R
	{
		require('Invent_Usulan_Exec_Frm_Save_PL.php');
		if ($rBatal=='YA'){
			UnExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="KR")	#KOREKSI / DOBEL CATAT #R
	{
		require('Invent_Usulan_Exec_Frm_Save_KR.php');
		if ($rBatal=='YA'){
			UnExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="TG")	#ASET TETAP YANG TIDAK DIGUNAKAN DALAM OPERASIONAL PEMERINTAH #R
	{
		require('Invent_Usulan_Exec_Frm_Save_TG.php');
		if ($rBatal=='YA'){
			UnExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="MS")	#MUTASI ANTAR SKPD #R
	{
		require('Invent_Usulan_Exec_Frm_Save_MS.php');
		if ($rBatal=='YA'){
			UnExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="AR")	#ASET RENOVASI
	{
		#require('Invent_Usulan_Exec_Frm_Save_AR.php');
		if ($rBatal=='YA'){
			##UnExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			##ExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="MK")	#MUTASI ANTAR KIB 	#R
	{
		require('Invent_Usulan_Exec_Frm_Save_MK.php');
		if ($rBatal=='YA'){
			UnExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="KP")	#KEMITERAAN
	{
		require('Invent_Usulan_Exec_Frm_Save_KP.php');
		if ($rBatal=='YA'){
			UnExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="HL")	#HILANG / TIDAK DIKETAHUI
	{
		#require('Invent_Usulan_Exec_Frm_Save_HL.php');
		if ($rBatal=='YA'){
			##UnExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			##ExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="TW")	#ASET TIDAK BERWUJUD
	{
		#require('Invent_Usulan_Exec_Frm_Save_TW.php');
		if ($rBatal=='YA'){
			##UnExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			##ExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
	}
}
?>
<script languange="javascript">
	showEXEC_RefR('','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>');
</script>