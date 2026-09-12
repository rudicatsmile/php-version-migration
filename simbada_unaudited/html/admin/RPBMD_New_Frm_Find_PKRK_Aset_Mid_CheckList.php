<?
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);

$rTbL=$gTBL;

#echo $gTBL."<br>";
#echo $gCrID."<br>";
#echo $IdL."<br>";
#return false;

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

$gREF = fGlobal("Referensi","ta_rpbmd_new","IDT",$IdT,"=","","");
$TahN = fGlobal("Tahun","ta_rpbmd_new","IDT",$IdT,"=","","");

#if ($rTbL!='a'){
if ($rTbL!='TNH'){
	$kond="kondisi";
}
else{
	$kond="idt";
}

#$nSQ = "SELECT Referensi, Kd_UPB, Kd_Aset, No_Register, Nm_Aset, Tgl_Perolehan, Keterangan, Harga, $kond, Asal_Usul FROM ta_kib_".$rTbL." WHERE (".$SyT.") ORDER BY IDT";
$nSQ = "SELECT Referensi, Kd_UPB, Kd_Aset_108, No_Register, Nm_Aset, Tgl_Perolehan, Keterangan, Harga, $kond, Asal_Usul FROM ta_kib_108 WHERE (".$SyT.") ORDER BY IDT";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$CeK = fGlobal("IDT","ta_rpbmd_new_aset","Referensi:Ref_Aset",$gREF.":".$mRo[0],"=:=","","");
	if (!$CeK)
	{
		
		#if ($rTbL!='a'){
		if ($rTbL!='TNH'){
			$KonD = $mRo[8];
		}
		else{
			$KonD = "";
		}
		
		$AsaL = $mRo[9];
		
		$mRo8 = fGlobal("ifNull(sum(debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$mRo[0].":".substr($mRo[1],0,11)."%","=:LIKE","","");
		$mRo4 = $mRo[4];
		#if ($mRo4==''){$mRo4 = fGlobal("nm_aset","ref_rek_aset5","kd_aset",$mRo[2],"=","","");}
		if ($mRo4==''){$mRo4 = fGlobal("nm_aset","ref_rek_aset108_7","kd_aset",$mRo[2],"=","","");}
		
		$gTBL = "ta_rpbmd_new_aset";
		$gFLD = "";
		$gVAL = "";
		
		$gFLD = "Referensi";
		$gVAL = "'".$gREF."'";
		
		$gFLD.= ", Kd_Unit";
		$gVAL.= ", '".substr($mRo[1],0,11)."'";
		
		$gFLD.= ", Ref_Aset";
		$gVAL.= ", '".$mRo[0]."'";
		
		$gFLD.= ", Kd_Aset";
		$gVAL.= ", '".$mRo[2]."'";
		
		$gFLD.= ", No_Register";
		$gVAL.= ", '".$mRo[3]."'";
		
		$gFLD.= ", Tgl_Perolehan";
		$gVAL.= ", '".$mRo[5]."'";
		
		$gFLD.= ", Nm_Aset";
		$gVAL.= ", '".$mRo4."'";
		
		$gFLD.= ", Harga";
		$gVAL.= ", '".$mRo[7]."'";
		
		$gFLD.= ", Nilai_Akhir";
		$gVAL.= ", '".$mRo8."'";
		
		$gFLD.= ", Uraian";
		$gVAL.= ", '".mysql_real_escape_string($mRo[6])."'";
		
		$gFLD.= ", Tahun";
		$gVAL.= ", '".$TahN."'";
		
		$gFLD.= ", Kondisi";
		$gVAL.= ", '".$KonD."'";
		
		$gFLD.= ", Asal_Usul";
		$gVAL.= ", '".$AsaL."'";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
	}
}
?>
<script type="text/javascript">
	RefreshDATA('<?=$stLOCK?>','<?=$IdL?>');
</script>
