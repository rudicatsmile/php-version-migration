<?php
	#*************
	$NewK = fGlobal("count_referensi","ta_kib_108_count_referensi","ref_crit","BNG","=","","");
	if ($NewK==0)
	{
		$NewK = fGlobal("IfNull(max(referensi),0)","ta_kib_108","referensi","BNG%","LIKE","","");
		$NewB = fGlobal("IfNull(max(referensi),0)","ta_kib_108_mutasi","referensi","BNG%","LIKE","","");
		$NewC = fGlobal("IfNull(max(referensi),0)","ta_kib_108_merger_his","referensi","BNG%","LIKE","","");
		
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
			$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
	}
		
	$NewK = $NewK + 1;

	$SQ="UPDATE ta_kib_108_count_referensi SET count_referensi='".$NewK."' WHERE ref_crit='BNG'";
	mysql_query($SQ);
	#*************
	
	$NewRefKIB = "BNG.".fMakeReferensi($NewK,11);
	
	$gNmB=$gNma;
	if ($gNmB==""){
		$gNmB=fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$gRin,"=","","");
	}
	if ($gTglM==""){$gTglM="0000-00-00";}
	
	//INSERT
	$SQL = "INSERT INTO ta_kib_108".$fL." SET 
	Referensi='$NewRefKIB',
	Ref_Group='$NewRefGrp',
	Kd_UPB='$gUpb',
	Kd_Aset_108='$gRin',
	Nm_Aset='$gNmB',
	No_Register='$NewReGAset',
	Bertingkat='$gTKT',
	Beton='$gBTN',
	Keterangan='$gKTR',
	Tgl_Perolehan='$gTgl',
	Tgl_Mutasi='$gTglM',
	Dokumen_Tanggal='$gTglD',
	Dokumen_Nomor='$gNoD',
	Luas_Lantai='$gLti',
	Status_Tanah='$gSTT',
	Kode_Tanah='$gKOT',
	Lokasi='$gLKS',
	Kd_Pemilik='$gMLK',
	Kondisi='$gKND',
	Asal_Usul='$gAUS',
	Masa_Manfaat='$gMSM',
	Harga='$gHRG',
	Post='Y',
	Recorded=now(),
	Pencatat='$gPCT'";
	$rst = mysql_query($SQL) or die(mysql_error());
	
	//INSERT TA-KIB-POST
	$SQL = "INSERT INTO ta_kib_post_108".$fL." SET 
	Referensi='$NewRefKIB',
	Ref_Group='$NewRefGrp',
	Kd_UPB='$gUpb',
	Kd_Aset_108='$gRin',
	No_Register='$NewReGAset',
	Crit='SLD',
	Tanggal='$gTgl',
	Tgl_Mutasi='$gTglM',
	Uraian='Saldo awal (nilai perolehan)',
	DK='D',
	Debet='$gHRG',
	Kredit='0',
	Keterangan='$gKTR',
	Recorded=now(),
	Pencatat='$gPCT'";
	$rst = mysql_query($SQL) or die(mysql_error());
?>
