<?
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);
$rDTA = explode(':',$rDTA);
$rIdT = $rDTA[0];
$rTbL = $rDTA[1];

$gREF = fGlobal("Referensi","ta_usulan_108","IDT",$IdT,"=","","");
$gJNS = fGlobal("Jenis","ta_usulan_108","IDT",$IdT,"=","","");

$nSQ = "SELECT Referensi,Kd_UPB,Kd_Aset_108,No_Register,Nm_Aset,Tgl_Perolehan,Keterangan,Harga,Ref_Mutasi,Ref_Usulan,extracom FROM ta_kib_108 WHERE IDT = '$rIdT'";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$CeK = fGlobal("IDT","ta_usulan_rinci_108","Referensi:Ref_Aset:No_Register",$gREF.":".$mRo[0].":".$mRo[3],"=:=:=","","");
	if (!$CeK)
	{
		$gKDA = "";
		if ($gJNS=='RB'){
			#RUSAK BERAT
			$gKDA = fGlobal("Kd_Aset","ref_rek_aset108_7","Link_Kib_AE:Kd_Aset",$mRo[2].":1.5.4.01.%","=:LIKE","","");
			if ($gKDA==""){$gKDA="9.9.9.99.99.99.999";}
		}
		if ($gJNS=='HB'){
			#HIBAH
			$gKDA = fGlobal("Kd_Aset","ref_rek_aset108_7","Link_Kib_AE:Kd_Aset",$mRo[2].":1.5.4.02.%","=:LIKE","","");
			if ($gKDA==""){$gKDA="9.9.9.99.99.99.999";}
		}
		if ($gJNS=='LE'){
			#LELATNG
			$gKDA = fGlobal("Kd_Aset","ref_rek_aset108_7","Link_Kib_AE:Kd_Aset",$mRo[2].":1.5.4.03.%","=:LIKE","","");
			if ($gKDA==""){$gKDA="9.9.9.99.99.99.999";}
		}
		if ($gJNS=='AR'){
			#ASET RENOVASI
			$gKDA = fGlobal("Kd_Aset","ref_rek_aset108_7","Link_Kib_AE:Kd_Aset",$mRo[2].":1.5.4.04.%","=:LIKE","","");
			if ($gKDA==""){$gKDA="9.9.9.99.99.99.999";}
		}
		if ($gJNS=='PL'){
			#DALAM PENELUSURAN
			$gKDA = fGlobal("Kd_Aset","ref_rek_aset108_7","Link_Kib_AE:Kd_Aset",$mRo[2].":1.5.4.05.%","=:LIKE","","");
			if ($gKDA==""){$gKDA="9.9.9.99.99.99.999";}
		}
		
		if ($gJNS=='PH'){
			$mRo8 = fGlobal("ifNull(sum(debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Ref_Mutasi:Ref_Usulan",$mRo[0].":".substr($mRo[1],0,18)."%:".$mRo[8].":".$mRo[9],"=:LIKE:=:=","","");
			if ($mRo8==0){
				$mRo8 = fGlobal("ifNull(sum(debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$mRo[0].":".substr($mRo[1],0,18)."%","=:LIKE","","");
			}
		}
		else{
			$mRo8 = fGlobal("ifNull(sum(debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$mRo[0].":".substr($mRo[1],0,18)."%","=:LIKE","","");
		}
		
		if ($mRo8==0){
			$mRo8 = $mRo[7];
		}
		
		$gTBL = "ta_usulan_rinci_108";
		$gFLD = "";
		$gVAL = "";
		
		$gFLD = "Referensi";
		$gVAL = "'$gREF'";
		
		$gFLD.= ", Ref_Aset";
		$gVAL.= ", '".$mRo[0]."'";
		
		$gFLD.= ", Kd_UPB";
		$gVAL.= ", '".$mRo[1]."'";
		
		$gFLD.= ", Kd_Aset";
		$gVAL.= ", '".$mRo[2]."'";
		
		$gFLD.= ", No_Register";
		$gVAL.= ", '".$mRo[3]."'";
		
		$gFLD.= ", Nm_Aset";
		$gVAL.= ", '".mysql_real_escape_string($mRo[4])."'";
		
		$gFLD.= ", Tgl_Perolehan";
		$gVAL.= ", '".$mRo[5]."'";
		
		$gFLD.= ", Uraian";
		$gVAL.= ", '".mysql_real_escape_string($mRo[6])."'";
		
		$gFLD.= ", Harga";
		$gVAL.= ", '".$mRo[7]."'";
		
		$gFLD.= ", Nilai_Akhir";
		$gVAL.= ", '".$mRo8."'";
		
		$gFLD.= ", KIB_From";
		$gVAL.= ", '".substr($mRo[2],0,2)."'";
		
		$gFLD.= ", KIB_To";
		$gVAL.= ", '".substr($gKDA,0,2)."'";
		
		$gFLD.= ", To_Kd_Aset";
		$gVAL.= ", '".$gKDA."'";
		
		$gFLD.= ", extracom";
		$gVAL.= ", '".$mRo[10]."'";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
	}
}
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>','0');
</script>
