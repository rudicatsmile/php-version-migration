<?
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);

$rTbL=$gTBL;
#echo $gTBL."<br>";
#echo $gCrID."<br>";
#echo $IdL."<br>";
$JmL  = (substr_count($gCrID, "-")-1);
$gDT  = explode("-",$gCrID);

$SyT = "";
for ($i=0; $i<=$JmL; $i++)
{
	if ($i>0){
		$SyT.= " OR IDT='".$gDT[$i]."'";
	}
	else{
		$SyT = "IDT='".$gDT[$i]."'";
	}
}

$gREF = fGlobal("Referensi","ta_usulan","IDT",$IdT,"=","","");
$gJNS = fGlobal("Jenis","ta_usulan","IDT",$IdT,"=","","");

$nSQ = "SELECT Referensi,Kd_UPB,Kd_Aset,No_Register,Nm_Aset,Tgl_Perolehan,Keterangan,Harga FROM ta_kib_".$rTbL." WHERE (".$SyT.") ORDER BY IDT";
echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$CeK = fGlobal("IDT","ta_usulan_rinci","Referensi:Ref_Aset",$gREF.":".$mRo[0],"=:=","","");
	if (!$CeK)
	{
		$gKDA = "";
		if ($gJNS=='RB'){
			#RUSAK BERAT
			$gKDA = fGlobal("Kd_Aset","ref_rek_aset5","Link_Kib_AE:Kd_Aset",$mRo[2].":07.21.%","=:LIKE","","");
			if ($gKDA==""){$gKDA="99.99.99.99.999";}
		}
		if ($gJNS=='HB'){
			#HIBAH
			$gKDA = fGlobal("Kd_Aset","ref_rek_aset5","Link_Kib_AE:Kd_Aset",$mRo[2].":07.22.%","=:LIKE","","");
			if ($gKDA==""){$gKDA="99.99.99.99.999";}
		}
		if ($gJNS=='AR'){
			#LELATNG
			$gKDA = fGlobal("Kd_Aset","ref_rek_aset5","Link_Kib_AE:Kd_Aset",$mRo[2].":07.23.%","=:LIKE","","");
			if ($gKDA==""){$gKDA="99.99.99.99.999";}
		}
		if ($gJNS=='PL'){
			#ASET RENOVASI
			$gKDA = fGlobal("Kd_Aset","ref_rek_aset5","Link_Kib_AE:Kd_Aset",$mRo[2].":07.25.%","=:LIKE","","");
			if ($gKDA==""){$gKDA="99.99.99.99.999";}
		}
		if ($gJNS=='PL'){
			#DALAM PENELUSURAN
			$gKDA = fGlobal("Kd_Aset","ref_rek_aset5","Link_Kib_AE:Kd_Aset",$mRo[2].":07.26.%","=:LIKE","","");
			if ($gKDA==""){$gKDA="99.99.99.99.999";}
		}
		
		$mRo8 = fGlobal("ifNull(sum(debet),0)","ta_kib_post","Referensi",$mRo[0],"=","","");
		
		$gTBL = "ta_usulan_rinci";
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
		$gVAL.= ", '".$mRo[4]."'";
		
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
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
	}
}
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>','0');
</script>
