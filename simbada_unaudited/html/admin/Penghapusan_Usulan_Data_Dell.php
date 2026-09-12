<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
#echo $IdT;
if ($IdT)
{
	$Ref = fGlobal("Referensi","ta_usulan_108","IDT",$IdT,"=","","");
	if ($Ref){
		#verifikasi
		$nSQ = "DELETE FROM ta_usulan_verifikasi_108 WHERE Ref_Usulan='$Ref'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_usulan_verifikasi_rinci_108 WHERE Ref_Usulan='$Ref'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_usulan_verifikasi_rinci_syarat_108 WHERE Ref_Usulan='$Ref'";
		$nRs = mysql_query($nSQ);
		
		$eSQ = "SELECT Ref_Aset,IdTTaKib FROM ta_usulan_rinci_108 WHERE Referensi='".$Ref."' AND IdTTaKib<>'' ORDER BY IdTTaKib";
		$eRs = mysql_query($eSQ);
		while ($eRo = mysql_fetch_array($eRs, MYSQL_BOTH))
		{
			$ReA = $eRo[0];
			$IdTTaKib = $eRo[1];
			$rTbL= CekRefToNmTbl($ReA);
			$SQ = "UPDATE ta_kib_108 SET MasukKeUsulan='belum' WHERE IDT='".$IdTTaKib."'";
			$rs = mysql_query($SQ);
		}
		
		#usulan
		$nSQ = "DELETE FROM ta_usulan_rinci_108 WHERE Referensi='$Ref'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_usulan_rinci_file_108 WHERE Referensi='$Ref'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_usulan_108 WHERE IDT='$IdT'";
		$nRs = mysql_query($nSQ);
	}
}
/*
$gDT = fGlobal("referensi:kd_aset:ref_aset:ref_usulan:to_upb:kib_to:to_kd_aset:mutasi_tanggal","ta_usulan_verifikasi_rinci","IDT",$tID,"=","","");
if ($gDT){
	$gDT = explode(":",$gDT);
	$RfV = $gDT[0];
	
	$RfA = $gDT[2];
	$RfU = $gDT[3];
	$TbK = fNmHuruf((int)substr($gDT[1],0,2));
	$UpB = $gDT[4];
	$NewUpB = $UpB;
	$ToKiB  = $gDT[5];
	$ToAsT  = $gDT[6];
	$TglMts = $gDT[7];
	
	$UdTRCI = 'NO';
	$gJN = fGlobal("Jenis","ta_usulan_verifikasi","Referensi",$RfV,"=","","");
	
	if ($gJN=="RB")	//rusak berat (OK)
	{
		require('Invent_Usulan_Exec_Frm_Save_RB.php');
		if ($rBatal=='YA'){
			UnExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="PL")
	{
		//dalam penelusuran
		require('Invent_Usulan_Exec_Frm_Save_PL.php');
		if ($rBatal=='YA'){
			UnExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="AR")
	{
		//aset renovasi
		require('Invent_Usulan_Exec_Frm_Save_AR.php');
		if ($rBatal=='YA'){
			UnExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="LE")
	{
		//Usulan Lelang
		require('Invent_Usulan_Exec_Frm_Save_LE.php');
		if ($rBatal=='YA'){
			UnExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="MK")
	{
		//mutasi antar kib ##############################
		require('Invent_Usulan_Exec_Frm_Save_MK.php');
		if ($rBatal=='YA'){
			UnExecuteRC($RfA,$TbK,$ToKiB,$tID,$UID);
		}
		else{
			ExecuteRC($RfA,$TbK,$TglMts,$ToKiB,$ToAsT,$tID,$UID);
		}
	}
	else if ($gJN=="KR")
	{
		//mutasi koreksi/dobel pencatatan (OK)
		require('Invent_Usulan_Exec_Frm_Save_KR.php');
		if ($rBatal=='YA'){
			#UnExecuteRC($RfA,$TbK,$tID,$UID);
			UnExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="HL")
	{
		//Hilang / tidak diketahui (OK)
		require('Invent_Usulan_Exec_Frm_Save_HL.php');
		if ($rBatal=='YA'){
			UnExecuteRC($RfA,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="MS")
	{
		//mutasi antar skpd (OK)
		require('Invent_Usulan_Exec_Frm_Save_MS.php');
		if ($rBatal=='YA'){
			UnExecuteRC($RfA,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($RfA,$RfU,$TbK,$NewUpB,$tID,$UID);
		}
	}
	else if ($gJN=="HB")
	{
		//hibah
		require('Invent_Usulan_Exec_Frm_Save_HB.php');
		if ($rBatal=='YA'){
			UnExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
	}
	else if ($gJN=="PH")
	{
		//penghapusan (OK)
		require('Invent_Usulan_Exec_Frm_Save_PH.php');
		if ($rBatal=='YA'){
			UnExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
		else{
			ExecuteRC($RfA,$RfU,$TbK,$tID,$UID);
		}
	}
}
*/
?>
<script languange="javascript">
	RefreshDATA('<?=$FrmG?>','<?=$IdL?>');
</script>