<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);
$rDTA = explode(':',$rDTA);
$rIdT = $rDTA[0];
$rTbL = $rDTA[1];

$gREF = fGlobal("Referensi","ta_rkpbmd_new_kegiatan","IDT",$kIdT,"=","","");
$KdKG = fGlobal("Kd_Kegiatan","ta_rkpbmd_new_kegiatan","IDT",$kIdT,"=","","");
$TahN = fGlobal("Tahun","ta_rkpbmd_new_kegiatan","IDT",$kIdT,"=","","");

$nSQ = "SELECT Referensi, Kd_UPB, Kd_Aset, No_Register, Nm_Aset, Tgl_Perolehan, Keterangan, Harga FROM ta_kib_".$rTbL." WHERE IDT = '$rIdT'";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$mRo4 = $mRo[4];
	$CeK = fGlobal("IDT","ta_rkpbmd_new_reknaset","Referensi:Ref_Aset",$gREF.":".$mRo[0],"=:=","","");
	if (!$CeK)
	{
		$mRo8 = fGlobal("ifNull(sum(debet),0)","ta_kib_post","Referensi:Kd_UPB",$mRo[0].":".substr($mRo[1],0,11)."%","=:LIKE","","");
		$mRo4 = $mRo[4];
		if ($mRo4==''){$mRo4 = fGlobal("nm_aset","ref_rek_aset5","kd_aset",$mRo[2],"=","","");}
		
		$gTBL = "ta_rkpbmd_new_reknaset";
		$gFLD = "";
		$gVAL = "";
		
		$gFLD = "Referensi";
		$gVAL = "'".$gREF."'";
		
		$gFLD.= ", Ref_Aset";
		$gVAL.= ", '".$mRo[0]."'";
		
		$gFLD.= ", Kd_Unit";
		$gVAL.= ", '".substr($mRo[1],0,11)."'";
		
		$gFLD.= ", Kd_Kegiatan";
		$gVAL.= ", '".$KdKG."'";
		
		$gFLD.= ", Tahun";
		$gVAL.= ", '".$TahN."'";
		
		$gFLD.= ", Kd_Aset";
		$gVAL.= ", '".$mRo[2]."'";
		
		$gFLD.= ", No_Register";
		$gVAL.= ", '".$mRo[3]."'";
		
		$gFLD.= ", Nm_Aset";
		$gVAL.= ", '".$mRo4."'";
		
		$gFLD.= ", Tgl_Perolehan";
		$gVAL.= ", '".$mRo[5]."'";
		
		$gFLD.= ", Uraian";
		$gVAL.= ", '".mysql_real_escape_string($mRo[6])."'";
		
		$gFLD.= ", Harga";
		$gVAL.= ", '".$mRo[7]."'";
		
		$gFLD.= ", Nilai_Akhir";
		$gVAL.= ", '".$mRo8."'";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
	}
}
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>');
</script>
