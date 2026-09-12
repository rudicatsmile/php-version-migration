<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);

$gREF = fGlobal("Referensi","ta_usulan_108","IDT",$IdT,"=","","");
$gJNS = fGlobal("Jenis","ta_usulan_108","IDT",$IdT,"=","","");
$rTbL = $gTBL;

$AmBiL = $AmBiL;
if ($AmBiL=="ALL")
{
	if ($rUPB!='All' && $rUPB!=''){$gUNT=$rUPB;}
	
	$CrT = "";
	$FnD = str_replace('**',' ',$gFnD);
	if ($FnD)
	{
		$CrT ="AND (Referensi LIKE '%$FnD%' OR Kd_Aset LIKE '%$FnD%' OR Nm_Aset LIKE '%$FnD%'";
		if ($gTBL=='a') {$CrT.=" OR Alamat LIKE '%$FnD%' OR Luas_M2 LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
		if ($gTBL=='b') {$CrT.=" OR Merk LIKE '%$FnD%' OR Type LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
		if ($gTBL=='c') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Luas_Lantai LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
		if ($gTBL=='d') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Konstruksi LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
		if ($gTBL=='e') {$CrT.=" OR Bahan LIKE '%$FnD%' OR Judul LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
		if ($gTBL=='f') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Dokumen_Nomor LIKE '%$FnD%'";}
		if ($gTBL=='g') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Dokumen_Nomor LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
		$CrT.=")";
	}
	
	$eRf = "";
	if ($gTBL=='a') {$eRf ="TNH";}
	if ($gTBL=='b') {$eRf ="ALT";}
	if ($gTBL=='c') {$eRf ="BNG";}
	if ($gTBL=='d') {$eRf ="JLN";}
	if ($gTBL=='e') {$eRf ="ATL";}
	if ($gTBL=='f') {$eRf ="KDP";}
	if ($gTBL=='g') {$eRf ="KDL";}
	
	$nMB = "";
	if ($gTBL=='f') {
		$nMB=" AND KdpToAset='N' ";
	}
	if ($gTHN==""){$gTHN="____";}
	
	if ($gTBL=='g') 
	{
		$nSQ = "SELECT Referensi,Kd_UPB,Kd_Aset_108,No_Register,Nm_Aset,Tgl_Perolehan,Keterangan,Harga,IDT,Ref_Mutasi,Ref_Usulan,extracom FROM ta_kib_108 
		WHERE (Referensi LIKE '$eRf%' OR Referensi LIKE 'ATB%')
		AND Kd_UPB LIKE '$gUNT%' 
		AND Tgl_Perolehan LIKE '$gTHN-%-%' 
		AND MasukKeUsulan LIKE '%' $CrT $nMB 
		ORDER BY Kd_Aset_108, No_Register, Tgl_Perolehan";// LIMIT 0,$gLST";
	}
	else
	{
		$nSQ = "SELECT Referensi,Kd_UPB,Kd_Aset_108,No_Register,Nm_Aset,Tgl_Perolehan,Keterangan,Harga,IDT,Ref_Mutasi,Ref_Usulan,extracom FROM ta_kib_108 
		WHERE Referensi LIKE '$eRf%' 
		AND Kd_UPB LIKE '$gUNT%' 
		AND Tgl_Perolehan LIKE '$gTHN-%-%' 
		AND MasukKeUsulan LIKE '%' $CrT $nMB 
		ORDER BY Kd_Aset_108, No_Register, Tgl_Perolehan";// LIMIT 0,$gLST";
	}
	#echo $nSQ;
	#return false;
}
else
{
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
	$nSQ = "SELECT Referensi,Kd_UPB,Kd_Aset_108,No_Register,Nm_Aset,Tgl_Perolehan,Keterangan,Harga,IDT,Ref_Mutasi,Ref_Usulan,extracom 
	FROM ta_kib_108 
	WHERE (".$SyT.") ORDER BY IDT";
}
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$eUpB = substr($mRo[1],0,11);
	$eIdT = $mRo[8];
	$eReH = $mRo[9];
	$eReU = $mRo[10];
	$CeK = fGlobal("IDT","ta_usulan_rinci_108","Referensi:Ref_Aset",$gREF.":".$mRo[0],"=:=","","");
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
			#LELANG
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
			$mRo8 = fGlobal("ifNull(sum(debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Ref_Mutasi:Ref_Usulan",$mRo[0].":".$eUpB."%:".$eReH.":".$eReU,"=:LIKE:=:=","","");
			if ($mRo8==0){
				$mRo8 = fGlobal("ifNull(sum(debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$mRo[0].":".$eUpB."%","=:LIKE","","");
			}
		}
		else{
			$mRo8 = fGlobal("ifNull(sum(debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$mRo[0].":".$eUpB."%","=:LIKE","","");
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
		
		$gFLD.= ", IdTTaKib";
		$gVAL.= ", '".$eIdT."'";
		
		$gFLD.= ", extracom";
		$gVAL.= ", '".$mRo['extracom']."'";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
		
		$eSQL= "UPDATE ta_kib_108 SET MasukKeUsulan='sudah' WHERE IDT='".$eIdT."'";
		$eRs = mysql_query($eSQL);
	}
}
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>','0');
</script>
