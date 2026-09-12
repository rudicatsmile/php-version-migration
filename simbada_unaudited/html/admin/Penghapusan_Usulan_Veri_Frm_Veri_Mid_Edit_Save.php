<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$qRY = "";
if ($gVer=="NO"){
	if ($fLD=='Memo') 
	{
		$rVal = str_replace('**',' ',$rVal);
	}
	else if ($fLD=='Fisik')
	{
		if ($rVal=='0') {$rVal="Ada";} 
		else {$rVal="Tidak Ada";}
		if ($rVal=="Tidak Ada") {$qRY=", Status='Tidak Memenuhi'";}
	}
	else if ($fLD=='Status')
	{
		if ($rVal=='0') {$rVal="Memenuhi";} 
		else {$rVal="Tidak Memenuhi";}
		
		if ($rVal=="Memenuhi") 
		{
			$CeK = fGlobal("Fisik","ta_usulan_verifikasi_rinci_syarat_108","IDT",$mID,"=","","");
			if ($CeK=='Tidak Ada'){$rVal="Tidak Memenuhi";}
		}
	}
	
	$SQ = "UPDATE ta_usulan_verifikasi_rinci_syarat_108 SET $fLD='$rVal' $qRY WHERE IDT='$mID'";
	$Rs = mysql_query($SQ);
}
else{
	if ($fLD=='Mutasi_HRI' || $fLD=='Mutasi_BLN' || $fLD=='Mutasi_THN') 
	{
		$DaT = fGlobal("Mutasi_Tanggal","ta_usulan_verifikasi_rinci_108","IDT",$tID,"=","","");
		$DaT = explode("-",$DaT);
		if ($fLD=='Mutasi_HRI'){
			$rTG = $DaT[0]."-".$DaT[1]."-".substr("0".$rVal,-2,2);
		}
		else if ($fLD=='Mutasi_BLN'){
			$rTG = $DaT[0]."-".substr("0".$rVal,-2,2)."-".$DaT[2];
		}
		else if ($fLD=='Mutasi_THN'){
			$rTG = $rVal."-".$DaT[1]."-".$DaT[2];
		}
		
		$SQ = "UPDATE ta_usulan_verifikasi_rinci_108 SET Mutasi_Tanggal='$rTG' WHERE IDT='$tID'";
		$Rs = mysql_query($SQ);
	}
	else {
		$SQ = "UPDATE ta_usulan_verifikasi_rinci_108 SET $fLD='$rVal' WHERE IDT='$tID'";
		$Rs = mysql_query($SQ);
		
		if ($fLD=='Verifikasi' && $rVal=='Disetujui')	#reupdate no rekening tujuan
		{
			$DaT = fGlobal("Ref_Usulan:Ref_Aset","ta_usulan_verifikasi_rinci_108","IDT",$tID,"=","","");
			if ($DaT){
				$DaT = explode("-",$DaT);
				$RekN= fGlobal("To_Kd_Aset","ta_usulan_rinci_108","Referensi:Ref_Aset",$DaT[0].":".$DaT[1],"=:=","","");
				if ($RekN){
					$SQ = "UPDATE ta_usulan_verifikasi_rinci_108 SET To_Kd_Aset='$RekN' WHERE IDT='$tID'";
					$Rs = mysql_query($SQ);
				}
			}
		}
	}
}
?>
<script languange="javascript">
	editFORM('refr','','<?=$tID?>','<?=$IdL?>');
</script>