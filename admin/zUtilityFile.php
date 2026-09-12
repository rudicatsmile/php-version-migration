<?php
#**********

$z_penerimaan_hibahsd31des2021="YAxx";
if ($z_penerimaan_hibahsd31des2021=="YAx")
{
	/*
	$SQA = "SELECT IDT, KD_SKPD, LREF, REGISTERNEW FROM z_penerimaan_hibahsd31des2021 ORDER BY REGISTERNEW";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$Idt = $mRo[0];
		$Kds = $mRo[1];
		$Lef = $mRo[2];
		$Reg = $mRo[3];
		
		$DtA = fGlobal("referensi:kd_aset_108:kd_upb","ta_kib_108","no_register:kd_upb:referensi",$Reg.":".$Kds."%:".$Lef."%","=:LIKE:LIKE","","");
		if ($DtA)
		{
			$DT = explode(':',$DtA);
			$SW = "UPDATE z_penerimaan_hibahsd31des2021 SET 
			KE_REFERENSI='".$DT[0]."',
			KE_KODE='".$DT[1]."',
			KE_UPB='".$DT[2]."' 
			WHERE IDT='".$Idt."'";
			echo $SW."<br>";
			$ns = mysql_query($SW);
		}
	}
	*/
	
	$SW = "SELECT REGISTERNEW, KE_REFERENSI, LREF FROM z_penerimaan_hibahsd31des2021 WHERE Execute='N' GROUP BY REGISTERNEW";
	echo $SW;
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$ReGi = $mR[0];
		$ReFe = $mR[1];
		$LeFx = $mR[2];
		if ($ReFe!='')
		{
			InsertPOST_HIBAH($ReGi,$ReFe,'');
		}
		else
		{
			InsertKibPOST_HIBAH($ReGi,$LeFx,DatabaseSB,$ConSB,'');
		}
	}
}

#**********
function InsertPOST_HIBAH($ReGi,$ReFe,$SH)
{
	$DtA = fGlobal("referensi:kd_upb:kd_aset_108","ta_kib_108","referensi",$ReFe,"=","","");
	$DtA = explode(':',$DtA);
	$Ref = $DtA[0];
	$upb = $DtA[1];
	$ast = $DtA[2];
	
	$SQW = "SELECT * FROM z_penerimaan_hibahsd31des2021 WHERE REGISTERNEW='".$ReGi."' AND Execute='N' ORDER BY NO";
	#echo $SQW;
	$nRs = mysql_query($SQW);
	while ($mRs = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		#$TGL = $mRs['TAHUN']."-12-31";
		$TGL = $mRs['TGLSP2D'];
		$TGLM= "0000-00-00";
		
		$SQ = "INSERT INTO ta_kib_post_108 SET 
		Referensi='".$Ref."',
		Ref_Group='',
		Kd_UPB='".$upb."',
		Kd_Aset='',
		Kd_Aset_108='".$ast."',
		No_Register='".$ReGi."',
		Crit='INV',
		Tanggal='".$TGL."',
		Tgl_Mutasi='".$TGLM."',
		Uraian='Atribusi: ".mysql_real_escape_string($mRs['KETERANGAN'])."',
		DK='D',
		Debet='".$mRs['HARGA']."',
		Kredit='0',
		No_SP2D='".mysql_real_escape_string($mRs['NOSP2D'])."',
		Keterangan='".mysql_real_escape_string($mRs['NAMA'])."',
		Recorded=now(),
		Pencatat='creator-ImpHibahsd12312021'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		$SQ = "UPDATE z_penerimaan_hibahsd31des2021 SET Execute='Y', RefEND='$Ref' WHERE IDT='".$mRs['IDT']."'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
	}
}

function InsertKibPOST_HIBAH($ReGi,$LeFx,$DatabaseSB,$ConSB,$SH) ##########################
{
	#Hanya record yang diproses
	$SQA = "SELECT * FROM z_penerimaan_hibahsd31des2021 WHERE REGISTERNEW='".$ReGi."' AND KE_REFERENSI='' AND Execute='N' ORDER BY NO LIMIT 0,1";
	#echo $SQA;
	$nRa = mysql_query($SQA);
	while ($mRa = mysql_fetch_array($nRa, MYSQL_BOTH))
	{
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi",$LeFx.".%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi",$LeFx.".%","LIKE","","");
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi",$LeFx.".%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		$NewRf= $LeFx.".".fMakeReferensi($NewK,11);
		
		#$TGL = $mRa['TAHUN']."-12-31";
		$TGL = $mRa['TGLSP2D'];
		$TGLM= "0000-00-00";
		
		$mRSA = findMasaManfaat($mRa['KODE'],$DatabaseSB,$ConSB);
		$CEk = fGlobal("IDT","ta_kib_108","Referensi",$NewRf,"=","","");
		if ($CEk=='')
		{
			$SQa = "INSERT INTO ta_kib_108 SET 
			Referensi='".$NewRf."',
			Ref_Group='',
			Ref_Mutasi='',
			Ref_Usulan='',
			Ref_History='',
			Ref_Usulan_His='',
			Kd_UPB='".$mRa['Kd_UPB']."',
			Kd_Aset='',
			Kd_Aset_108='".$mRa['KODE']."',
			Kd_Ruang='',
			No_Register='".$ReGi."',
			No_Pengadaan='".mysql_real_escape_string($mRa['NOKONTRAK'])."',
			Ref_Temp='',
			Nm_Aset='".mysql_real_escape_string($mRa['NAMA'])."',
			Kd_Pemilik='12',
			Tgl_Perolehan='".$TGL."',
			Tgl_Mutasi='".$TGLM."',
			Tgl_Mulai='0000-00-00',
			Tahun='".$mRa['TAHUN']."',
			Luas_M2='0',
			Alamat='',
			Hak_Tanah='',
			Sertifikat_Tanggal='0000-00-00',
			Sertifikat_Nomor='',
			Penggunaan='',
			Asal_Usul='".mysql_real_escape_string($mRa['ASALUSUL'])."',
			Harga='".$mRa['HARGA']."',
			No_SP2D='".mysql_real_escape_string($mRa['NOSP2D'])."',
			Merk='',
			Type='',
			Ukuran_CC='',
			Bahan='',
			Nomor_Pabrik='',
			Nomor_Rangka='',
			Nomor_Mesin='',
			Nomor_Polisi='',
			Nomor_BPKB='',
			Kondisi='B',
			Masa_Manfaat='".$mRSA."',
			Nilai_Akhir='".$mRa['HARGA']."',
			Ukuran='',
			Keterangan='".mysql_real_escape_string($mRa['KETERANGAN'])."',
			Post='Y',
			ImportFrom='ExcelHibah',
			Recorded=now(),
			Pencatat='creator-ImpHibahsd12312021'";
			echo $SQa."<br>";
			$rs = mysql_query($SQa);
				
			$SQ = "INSERT INTO ta_kib_post_108 SET 
			Referensi='".$NewRf."',
			Ref_Group='',
			Kd_UPB='".$mRa['Kd_UPB']."',
			Kd_Aset='',
			Kd_Aset_108='".$mRa['KODE']."',
			No_Register='".$ReGi."',
			Crit='SLD',
			Tanggal='".$TGL."',
			Tgl_Mutasi='".$TGLM."',
			Uraian='Saldo Awal: ".mysql_real_escape_string($mRa['KETERANGAN'])."',
			DK='D',
			Debet='".$mRa['HARGA']."',
			Kredit='0',
			No_SP2D='".mysql_real_escape_string($mRa['NOSP2D'])."',
			Keterangan='".mysql_real_escape_string($mRa['NAMA'])."',
			Recorded=now(),
			Pencatat='creator-ImpHibahsd12312021'";
			echo $SQ."<br>";
			$rs = mysql_query($SQ);
		}

		$SQ = "UPDATE z_penerimaan_hibahsd31des2021 SET Execute='Y', RefEND='$NewRf' WHERE IDT='".$mRa['IDT']."'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		#Lanjut ke record berikutnya
		InsertPOST_HIBAH($ReGi,$NewRf,$SH);
	}
}
#**********


$z_penerimaan_hutangsd31des2021="YAxx";
if ($z_penerimaan_hutangsd31des2021=="YA")
{
	/*
	$SQA = "SELECT IDT, KD_SKPD, LREF, REGISTERNEW FROM z_penerimaan_hutangsd31des2021 ORDER BY REGISTERNEW";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$Idt = $mRo[0];
		$Kds = $mRo[1];
		$Lef = $mRo[2];
		$Reg = $mRo[3];
		
		$DtA = fGlobal("referensi:kd_aset_108:kd_upb","ta_kib_108","no_register:kd_upb:referensi",$Reg.":".$Kds."%:".$Lef."%","=:LIKE:LIKE","","");
		if ($DtA)
		{
			$DT = explode(':',$DtA);
			$SW = "UPDATE z_penerimaan_hutangsd31des2021 SET 
			KE_REFERENSI='".$DT[0]."',
			KE_KODE='".$DT[1]."',
			KE_UPB='".$DT[2]."' 
			WHERE IDT='".$Idt."'";
			echo $SW."<br>";
			$ns = mysql_query($SW);
		}
	}
	*/
	
	$SW = "SELECT REGISTERNEW, KE_REFERENSI, LREF FROM z_penerimaan_hutangsd31des2021 WHERE Execute='N' GROUP BY REGISTERNEW";
	echo $SW;
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$ReGi = $mR[0];
		$ReFe = $mR[1];
		$LeFx = $mR[2];
		if ($ReFe!='')
		{
			InsertPOST_HUTANG($ReGi,$ReFe,'');
		}
		else
		{
			InsertKibPOST_HUTANG($ReGi,$LeFx,DatabaseSB,$ConSB,'');
		}
	}
}

#**********
function InsertPOST_HUTANG($ReGi,$ReFe,$SH)
{
	$DtA = fGlobal("referensi:kd_upb:kd_aset_108","ta_kib_108","referensi",$ReFe,"=","","");
	$DtA = explode(':',$DtA);
	$Ref = $DtA[0];
	$upb = $DtA[1];
	$ast = $DtA[2];
	
	$SQW = "SELECT * FROM z_penerimaan_hutangsd31des2021 WHERE REGISTERNEW='".$ReGi."' AND Execute='N' ORDER BY NO";
	#echo $SQW;
	$nRs = mysql_query($SQW);
	while ($mRs = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		#$TGL = $mRs['TAHUN']."-12-31";
		$TGL = $mRs['TGLSP2D'];
		$TGLM= "0000-00-00";
		
		$SQ = "INSERT INTO ta_kib_post_108 SET 
		Referensi='".$Ref."',
		Ref_Group='',
		Kd_UPB='".$upb."',
		Kd_Aset='',
		Kd_Aset_108='".$ast."',
		No_Register='".$ReGi."',
		Crit='INV',
		Tanggal='".$TGL."',
		Tgl_Mutasi='".$TGLM."',
		Uraian='Atribusi: ".mysql_real_escape_string($mRs['KETERANGAN'])."',
		DK='D',
		Debet='".$mRs['HARGA']."',
		Kredit='0',
		No_SP2D='".mysql_real_escape_string($mRs['NOSP2D'])."',
		Keterangan='".mysql_real_escape_string($mRs['NAMA'])."',
		Recorded=now(),
		Pencatat='creator-ImpHutangsd12312021'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		$SQ = "UPDATE z_penerimaan_hutangsd31des2021 SET Execute='Y', RefEND='$Ref' WHERE IDT='".$mRs['IDT']."'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
	}
}

function InsertKibPOST_HUTANG($ReGi,$LeFx,$DatabaseSB,$ConSB,$SH) ##########################
{
	#Hanya record yang diproses
	$SQA = "SELECT * FROM z_penerimaan_hutangsd31des2021 WHERE REGISTERNEW='".$ReGi."' AND KE_REFERENSI='' AND Execute='N' ORDER BY NO LIMIT 0,1";
	#echo $SQA;
	$nRa = mysql_query($SQA);
	while ($mRa = mysql_fetch_array($nRa, MYSQL_BOTH))
	{
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi",$LeFx.".%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi",$LeFx.".%","LIKE","","");
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi",$LeFx.".%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		$NewRf= $LeFx.".".fMakeReferensi($NewK,11);
		
		#$TGL = $mRa['TAHUN']."-12-31";
		$TGL = $mRa['TGLSP2D'];
		$TGLM= "0000-00-00";
		
		$mRSA = findMasaManfaat($mRa['KODE'],$DatabaseSB,$ConSB);
		$CEk = fGlobal("IDT","ta_kib_108","Referensi",$NewRf,"=","","");
		if ($CEk=='')
		{
			$SQa = "INSERT INTO ta_kib_108 SET 
			Referensi='".$NewRf."',
			Ref_Group='',
			Ref_Mutasi='',
			Ref_Usulan='',
			Ref_History='',
			Ref_Usulan_His='',
			Kd_UPB='".$mRa['Kd_UPB']."',
			Kd_Aset='',
			Kd_Aset_108='".$mRa['KODE']."',
			Kd_Ruang='',
			No_Register='".$ReGi."',
			No_Pengadaan='".mysql_real_escape_string($mRa['NOKONTRAK'])."',
			Ref_Temp='',
			Nm_Aset='".mysql_real_escape_string($mRa['NAMA'])."',
			Kd_Pemilik='12',
			Tgl_Perolehan='".$TGL."',
			Tgl_Mutasi='".$TGLM."',
			Tgl_Mulai='0000-00-00',
			Tahun='".$mRa['TAHUN']."',
			Luas_M2='0',
			Alamat='',
			Hak_Tanah='',
			Sertifikat_Tanggal='0000-00-00',
			Sertifikat_Nomor='',
			Penggunaan='',
			Asal_Usul='".mysql_real_escape_string($mRa['ASALUSUL'])."',
			Harga='".$mRa['HARGA']."',
			No_SP2D='".mysql_real_escape_string($mRa['NOSP2D'])."',
			Merk='',
			Type='',
			Ukuran_CC='',
			Bahan='',
			Nomor_Pabrik='',
			Nomor_Rangka='',
			Nomor_Mesin='',
			Nomor_Polisi='',
			Nomor_BPKB='',
			Kondisi='B',
			Masa_Manfaat='".$mRSA."',
			Nilai_Akhir='".$mRa['HARGA']."',
			Ukuran='',
			Keterangan='".mysql_real_escape_string($mRa['KETERANGAN'])."',
			Post='Y',
			ImportFrom='ExcelHutang',
			Recorded=now(),
			Pencatat='creator-ImpHutangsd12312021'";
			echo $SQa."<br>";
			$rs = mysql_query($SQa);
				
			$SQ = "INSERT INTO ta_kib_post_108 SET 
			Referensi='".$NewRf."',
			Ref_Group='',
			Kd_UPB='".$mRa['Kd_UPB']."',
			Kd_Aset='',
			Kd_Aset_108='".$mRa['KODE']."',
			No_Register='".$ReGi."',
			Crit='SLD',
			Tanggal='".$TGL."',
			Tgl_Mutasi='".$TGLM."',
			Uraian='Saldo Awal: ".mysql_real_escape_string($mRa['KETERANGAN'])."',
			DK='D',
			Debet='".$mRa['HARGA']."',
			Kredit='0',
			No_SP2D='".mysql_real_escape_string($mRa['NOSP2D'])."',
			Keterangan='".mysql_real_escape_string($mRa['NAMA'])."',
			Recorded=now(),
			Pencatat='creator-ImpHutangsd12312021'";
			echo $SQ."<br>";
			$rs = mysql_query($SQ);
		}

		$SQ = "UPDATE z_penerimaan_hutangsd31des2021 SET Execute='Y', RefEND='$NewRf' WHERE IDT='".$mRa['IDT']."'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		#Lanjut ke record berikutnya
		InsertPOST_HUTANG($ReGi,$NewRf,$SH);
	}
}

$Insertz_pengadaan_26agustus31des2021="YAXXXXXX";
if ($Insertz_pengadaan_26agustus31des2021=="YA")
{
	/*
	$SW = "SELECT SKPD as A0, 
	KD_SKPD as A1,
	KD_UPB as A2 
	FROM z_nmskpd ORDER BY KD_SKPD";
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$NmSK = $mR[0];
		$KdSK = $mR[1];
		$KdUP = $mR[2];
		$WS = "UPDATE z_pengadaan_26agustus31des2021 SET 
		KD_SKPD='".$KdSK."',
		Kd_UPB='".$KdUP."' 
		WHERE SKPD='".$NmSK."'";
		echo $WS."<br>";
		$eR = mysql_query($WS);
	}
	*/
	/*
	$SQA = "SELECT IDT, KD_SKPD, LREF, REGISTERNEW FROM z_pengadaan_26agustus31des2021 ORDER BY REGISTERNEW";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$Idt = $mRo[0];
		$Kds = $mRo[1];
		$Lef = $mRo[2];
		$Reg = $mRo[3];
		
		$DtA = fGlobal("referensi:kd_aset_108:kd_upb","ta_kib_108","no_register:kd_upb:referensi",$Reg.":".$Kds."%:".$Lef."%","=:LIKE:LIKE","","");
		if ($DtA)
		{
			$DT = explode(':',$DtA);
			$SW = "UPDATE z_pengadaan_26agustus31des2021 SET 
			KE_REFERENSI='".$DT[0]."',
			KE_KODE='".$DT[1]."',
			KE_UPB='".$DT[2]."' 
			WHERE IDT='".$Idt."'";
			echo $SW."<br>";
			$ns = mysql_query($SW);
		}
	}
	*/
	
	$SW = "SELECT REGISTERNEW, KE_REFERENSI, LREF FROM z_pengadaan_26agustus31des2021 WHERE Execute='N' GROUP BY REGISTERNEW";
	echo $SW;
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$ReGi = $mR[0];
		$ReFe = $mR[1];
		$LeFx = $mR[2];
		if ($ReFe!='')
		{
			InsertPOST_2631($ReGi,$ReFe,'');
		}
		else
		{
			InsertKibPOST_2631($ReGi,$LeFx,DatabaseSB,$ConSB,'');
		}
	}
	
}

function InsertPOST_2631($ReGi,$ReFe,$SH)
{
	$DtA = fGlobal("referensi:kd_upb:kd_aset_108","ta_kib_108","referensi",$ReFe,"=","","");
	$DtA = explode(':',$DtA);
	$Ref = $DtA[0];
	$upb = $DtA[1];
	$ast = $DtA[2];
	
	$SQW = "SELECT * FROM z_pengadaan_26agustus31des2021 WHERE REGISTERNEW='".$ReGi."' AND Execute='N' ORDER BY NO";
	#echo $SQW;
	$nRs = mysql_query($SQW);
	while ($mRs = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		#$TGL = $mRs['TAHUN']."-12-31";
		$TGL = $mRs['TGLSP2D'];
		$TGLM= "0000-00-00";
		
		$SQ = "INSERT INTO ta_kib_post_108 SET 
		Referensi='".$Ref."',
		Ref_Group='',
		Kd_UPB='".$upb."',
		Kd_Aset='',
		Kd_Aset_108='".$ast."',
		No_Register='".$ReGi."',
		Crit='INV',
		Tanggal='".$TGL."',
		Tgl_Mutasi='".$TGLM."',
		Uraian='Atribusi: ".mysql_real_escape_string($mRs['KETERANGAN'])."',
		DK='D',
		Debet='".$mRs['HARGA']."',
		Kredit='0',
		No_SP2D='".mysql_real_escape_string($mRs['NOSP2D'])."',
		Keterangan='".mysql_real_escape_string($mRs['NAMA'])."',
		Recorded=now(),
		Pencatat='creator-Imp2608sd12312021'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		$SQ = "UPDATE z_pengadaan_26agustus31des2021 SET Execute='Y', RefEND='$Ref' WHERE IDT='".$mRs['IDT']."'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
	}
}

function InsertKibPOST_2631($ReGi,$LeFx,$DatabaseSB,$ConSB,$SH) ##########################
{
	#Hanya record yang diproses
	$SQA = "SELECT * FROM z_pengadaan_26agustus31des2021 WHERE REGISTERNEW='".$ReGi."' AND KE_REFERENSI='' AND Execute='N' ORDER BY NO LIMIT 0,1";
	#echo $SQA;
	$nRa = mysql_query($SQA);
	while ($mRa = mysql_fetch_array($nRa, MYSQL_BOTH))
	{
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi",$LeFx.".%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi",$LeFx.".%","LIKE","","");
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi",$LeFx.".%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		$NewRf= $LeFx.".".fMakeReferensi($NewK,11);
		
		#$TGL = $mRa['TAHUN']."-12-31";
		$TGL = $mRa['TGLSP2D'];
		$TGLM= "0000-00-00";
		
		$mRSA = findMasaManfaat($mRa['KODE'],$DatabaseSB,$ConSB);
		$CEk = fGlobal("IDT","ta_kib_108","Referensi",$NewRf,"=","","");
		if ($CEk=='')
		{
			$SQa = "INSERT INTO ta_kib_108 SET 
			Referensi='".$NewRf."',
			Ref_Group='',
			Ref_Mutasi='',
			Ref_Usulan='',
			Ref_History='',
			Ref_Usulan_His='',
			Kd_UPB='".$mRa['Kd_UPB']."',
			Kd_Aset='',
			Kd_Aset_108='".$mRa['KODE']."',
			Kd_Ruang='',
			No_Register='".$ReGi."',
			No_Pengadaan='".mysql_real_escape_string($mRa['NOKONTRAK'])."',
			Ref_Temp='',
			Nm_Aset='".mysql_real_escape_string($mRa['NAMA'])."',
			Kd_Pemilik='12',
			Tgl_Perolehan='".$TGL."',
			Tgl_Mutasi='".$TGLM."',
			Tgl_Mulai='0000-00-00',
			Tahun='".$mRa['TAHUN']."',
			Luas_M2='0',
			Alamat='',
			Hak_Tanah='',
			Sertifikat_Tanggal='0000-00-00',
			Sertifikat_Nomor='',
			Penggunaan='',
			Asal_Usul='".mysql_real_escape_string($mRa['ASALUSUL'])."',
			Harga='".$mRa['HARGA']."',
			No_SP2D='".mysql_real_escape_string($mRa['NOSP2D'])."',
			Merk='',
			Type='',
			Ukuran_CC='',
			Bahan='',
			Nomor_Pabrik='',
			Nomor_Rangka='',
			Nomor_Mesin='',
			Nomor_Polisi='',
			Nomor_BPKB='',
			Kondisi='B',
			Masa_Manfaat='".$mRSA."',
			Nilai_Akhir='".$mRa['HARGA']."',
			Ukuran='',
			Keterangan='".mysql_real_escape_string($mRa['KETERANGAN'])."',
			Post='Y',
			ImportFrom='Excel26082021',
			Recorded=now(),
			Pencatat='creator-Imp2608sd12312021'";
			echo $SQa."<br>";
			$rs = mysql_query($SQa);
				
			$SQ = "INSERT INTO ta_kib_post_108 SET 
			Referensi='".$NewRf."',
			Ref_Group='',
			Kd_UPB='".$mRa['Kd_UPB']."',
			Kd_Aset='',
			Kd_Aset_108='".$mRa['KODE']."',
			No_Register='".$ReGi."',
			Crit='SLD',
			Tanggal='".$TGL."',
			Tgl_Mutasi='".$TGLM."',
			Uraian='Saldo Awal: ".mysql_real_escape_string($mRa['KETERANGAN'])."',
			DK='D',
			Debet='".$mRa['HARGA']."',
			Kredit='0',
			No_SP2D='".mysql_real_escape_string($mRa['NOSP2D'])."',
			Keterangan='".mysql_real_escape_string($mRa['NAMA'])."',
			Recorded=now(),
			Pencatat='creator-Imp2608sd12312021'";
			echo $SQ."<br>";
			$rs = mysql_query($SQ);
		}

		$SQ = "UPDATE z_pengadaan_26agustus31des2021 SET Execute='Y', RefEND='$NewRf' WHERE IDT='".$mRa['IDT']."'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		#Lanjut ke record berikutnya
		InsertPOST_2631($ReGi,$NewRf,$SH);
	}
}

###################

$InsertUsulanKibBDisdik="YAxxxxxx";
if ($InsertUsulanKibBDisdik=="YA")
{
	
	$SW = "SELECT IDT as A0, 
	Referensi as A1,
	Kd_UPB as A2,
	Kd_Aset_108 as A3,
	No_Register as A4,
	Tgl_Perolehan as A5,
	Nm_Aset as A6,
	Harga as A7,
	Keterangan as A8,
	extracom as A9 
	FROM ta_kib_108 
	WHERE Referensi LIKE 'ALT%' 
	AND Kd_UPB LIKE '24.04.08.01%' 
	AND MasukKeUsulan='belum' ORDER BY Referensi LIMIT 0,5000";
	#echo $SW;
	$nR = mysql_query($SW);
	while ($mRo = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$mRoAK = fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","Referensi:No_Register",$mRo[1].":".$mRo[4],"=:=","","");
		
		$SQa = "INSERT INTO ta_usulan_rinci_108 SET 
		Referensi='PHM.2022.00000012',
		Ref_Aset='".$mRo[1]."',
		Kd_UPB='".$mRo[2]."',
		Kd_Aset='".$mRo[3]."',
		To_Kd_Aset='',
		No_Register='".$mRo[4]."',
		Tgl_Perolehan='".$mRo[5]."',
		Nm_Aset='".mysql_real_escape_string($mRo[6])."',
		Harga='".$mRo[7]."',
		Nilai_Akhir='".$mRoAK."',
		Uraian='".mysql_real_escape_string($mRo[8])."',
		To_UPB='',
		KIB_From='',
		KIB_To='',
		Kd_Rinci='',
		Verifikasi_Memo='',
		IdTTaKib='".$mRo[0]."',
		extracom='".$mRo[9]."'";
		echo $SQa."<br>";
		$rsA = mysql_query($SQa);
		
		$SQe = "UPDATE ta_kib_108 SET MasukKeUsulan='sudah' WHERE IDT='".$mRo[0]."'";
		echo $SQe."<br>";
		$rsE = mysql_query($SQe);
		
	}
}


$Insertz_pengadaan_26agustus2021="YAxxxx";
if ($Insertz_pengadaan_26agustus2021=="YA")
{
	$SW = "SELECT REGISTERNEW, KE_REFERENSI, LREF FROM z_pengadaan_26agustus2021 WHERE Execute='N' GROUP BY REGISTERNEW";
	echo $SW;
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$ReGi = $mR[0];
		$ReFe = $mR[1];
		$LeFx = $mR[2];
		if ($ReFe!='')
		{
			InsertPOST($ReGi,$ReFe,'');
		}
		else
		{
			InsertKibPOST($ReGi,$LeFx,DatabaseSB,$ConSB,'');
		}
	}
}

function InsertKibPOST($ReGi,$LeFx,$DatabaseSB,$ConSB,$SH) ##########################
{
	#Hanya record yang diproses
	$SQA = "SELECT * FROM z_pengadaan_26agustus2021 WHERE REGISTERNEW='".$ReGi."' AND KE_REFERENSI='' AND Execute='N' ORDER BY NO LIMIT 0,1";
	#echo $SQA;
	$nRa = mysql_query($SQA);
	while ($mRa = mysql_fetch_array($nRa, MYSQL_BOTH))
	{
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi",$LeFx.".%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi",$LeFx.".%","LIKE","","");
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi",$LeFx.".%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		$NewRf= $LeFx.".".fMakeReferensi($NewK,11);
		
		#$TGL = $mRa['TAHUN']."-12-31";
		$TGL = $mRa['TGLSP2D'];
		$TGLM= "0000-00-00";
		
		$mRSA = findMasaManfaat($mRa['KODE'],$DatabaseSB,$ConSB);
		$CEk = fGlobal("IDT","ta_kib_108","Referensi",$NewRf,"=","","");
		if ($CEk=='')
		{
			$SQa = "INSERT INTO ta_kib_108 SET 
			Referensi='".$NewRf."',
			Ref_Group='',
			Ref_Mutasi='',
			Ref_Usulan='',
			Ref_History='',
			Ref_Usulan_His='',
			Kd_UPB='".$mRa['Kd_UPB']."',
			Kd_Aset='',
			Kd_Aset_108='".$mRa['KODE']."',
			Kd_Ruang='',
			No_Register='".$ReGi."',
			No_Pengadaan='".mysql_real_escape_string($mRa['NOKONTRAK'])."',
			Ref_Temp='',
			Nm_Aset='".mysql_real_escape_string($mRa['NAMA'])."',
			Kd_Pemilik='12',
			Tgl_Perolehan='".$TGL."',
			Tgl_Mutasi='".$TGLM."',
			Tgl_Mulai='0000-00-00',
			Tahun='".$mRa['TAHUN']."',
			Luas_M2='0',
			Alamat='',
			Hak_Tanah='',
			Sertifikat_Tanggal='0000-00-00',
			Sertifikat_Nomor='',
			Penggunaan='',
			Asal_Usul='".mysql_real_escape_string($mRa['ASALUSUL'])."',
			Harga='".$mRa['HARGA']."',
			No_SP2D='".mysql_real_escape_string($mRa['NOSP2D'])."',
			Merk='',
			Type='',
			Ukuran_CC='',
			Bahan='',
			Nomor_Pabrik='',
			Nomor_Rangka='',
			Nomor_Mesin='',
			Nomor_Polisi='',
			Nomor_BPKB='',
			Kondisi='B',
			Masa_Manfaat='".$mRSA."',
			Nilai_Akhir='".$mRa['HARGA']."',
			Ukuran='',
			Keterangan='".mysql_real_escape_string($mRa['KETERANGAN'])."',
			Post='Y',
			ImportFrom='Excel26082021',
			Recorded=now(),
			Pencatat='creator-Imp26082021'";
			echo $SQa."<br>";
			$rs = mysql_query($SQa);
				
			$SQ = "INSERT INTO ta_kib_post_108 SET 
			Referensi='".$NewRf."',
			Ref_Group='',
			Kd_UPB='".$mRa['Kd_UPB']."',
			Kd_Aset='',
			Kd_Aset_108='".$mRa['KODE']."',
			No_Register='".$ReGi."',
			Crit='SLD',
			Tanggal='".$TGL."',
			Tgl_Mutasi='".$TGLM."',
			Uraian='Saldo Awal: ".mysql_real_escape_string($mRa['KETERANGAN'])."',
			DK='D',
			Debet='".$mRa['HARGA']."',
			Kredit='0',
			No_SP2D='".mysql_real_escape_string($mRa['NOSP2D'])."',
			Keterangan='".mysql_real_escape_string($mRa['NAMA'])."',
			Recorded=now(),
			Pencatat='creator-Imp26082021'";
			echo $SQ."<br>";
			$rs = mysql_query($SQ);
		}

		$SQ = "UPDATE z_pengadaan_26agustus2021 SET Execute='Y', RefEND='$NewRf' WHERE IDT='".$mRa['IDT']."'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		#Lanjut ke record berikutnya
		InsertPOST($ReGi,$NewRf,$SH);
	}
	
}

function InsertPOST($ReGi,$ReFe,$SH)
{
	$DtA = fGlobal("referensi:kd_upb:kd_aset_108","ta_kib_108","referensi",$ReFe,"=","","");
	$DtA = explode(':',$DtA);
	$Ref = $DtA[0];
	$upb = $DtA[1];
	$ast = $DtA[2];
	
	$SQW = "SELECT * FROM z_pengadaan_26agustus2021 WHERE REGISTERNEW='".$ReGi."' AND Execute='N' ORDER BY NO";
	#echo $SQW;
	$nRs = mysql_query($SQW);
	while ($mRs = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		#$TGL = $mRs['TAHUN']."-12-31";
		$TGL = $mRs['TGLSP2D'];
		$TGLM= "0000-00-00";
		
		$SQ = "INSERT INTO ta_kib_post_108 SET 
		Referensi='".$Ref."',
		Ref_Group='',
		Kd_UPB='".$upb."',
		Kd_Aset='',
		Kd_Aset_108='".$ast."',
		No_Register='".$ReGi."',
		Crit='INV',
		Tanggal='".$TGL."',
		Tgl_Mutasi='".$TGLM."',
		Uraian='Atribusi: ".mysql_real_escape_string($mRs['KETERANGAN'])."',
		DK='D',
		Debet='".$mRs['HARGA']."',
		Kredit='0',
		No_SP2D='".mysql_real_escape_string($mRs['NOSP2D'])."',
		Keterangan='".mysql_real_escape_string($mRs['NAMA'])."',
		Recorded=now(),
		Pencatat='creator-Imp26082021'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		$SQ = "UPDATE z_pengadaan_26agustus2021 SET Execute='Y', RefEND='$Ref' WHERE IDT='".$mRs['IDT']."'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
	}
}
###############################################

$InsertAtribusiKDP="YAx";
if ($InsertAtribusiKDP=="YA")
{
	$SW = "SELECT REGISTERNEW FROM atribusi_kdp WHERE Execute='N' GROUP BY REGISTERNEW";
	#echo $SW;
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$eFn =fGlobal("IDT","ta_kib_108","no_register:referensi",$mR[0].":KDP.%","=:LIKE","","");
		echo "<br>".$mR[0]." : ".$eFn."<br>";
		if ($eFn!='')
		{
			$DtA = fGlobal("referensi:kd_upb:kd_aset_108","ta_kib_108","IDT",$eFn,"=","","");
			$DtA = explode(':',$DtA);
			$Ref = $DtA[0];
			$upb = $DtA[1];
			$ast = $DtA[2];
			
			$iGA=1;
			$SWE = "SELECT 
			REGISTERNEW as A0, 
			NAMA as A1, 
			TGLKONTRAK as A2, 
			NOKONTRAK as A3, 
			TGLSP2D as A4, 
			NOSP2D as A5, 
			TAHUN as A6, 
			HARGA as A7, 
			KETERANGAN as A8,
			THNMUTASI as A9,
			IDT as A10 
			
			FROM atribusi_kdp WHERE REGISTERNEW='".$mR[0]."' ORDER BY TAHUN, HARGA desc";
			#echo $SW;
			$nRE = mysql_query($SWE);
			while ($mRE = mysql_fetch_array($nRE, MYSQL_BOTH))
			{
				if ($iGA==1)
				{
					$SQ = "UPDATE ta_kib_108 SET Harga='".$mRE[7]."' WHERE referensi='".$Ref."' AND no_register='".$mRE[0]."'";
					echo $SQ."<br>";
					#$rs = mysql_query($SQ);
					
					$SQ = "UPDATE ta_kib_post_108 SET Debet='".$mRE[7]."' WHERE referensi='".$Ref."' AND no_register='".$mRE[0]."'";
					echo $SQ."<br>";
					#$rs = mysql_query($SQ);
				}
				else
				{
					$TGL  = $mRE[6]."-12-31";
					$TGLM = $mRE[6]."-12-31";
					
					$SQ = "INSERT INTO ta_kib_post_108 SET 
					Referensi='".$Ref."',
					Ref_Group='',
					Kd_UPB='".$upb."',
					Kd_Aset='',
					Kd_Aset_108='".$ast."',
					No_Register='".$mRE[0]."',
					Crit='INV',
					Tanggal='".$TGL."',
					Tgl_Mutasi='".$TGLM."',
					Uraian='Atribusi: ".mysql_real_escape_string($mRE[8])."',
					DK='D',
					Debet='".$mRE[7]."',
					Kredit='0',
					Keterangan='".mysql_real_escape_string($mRE[1])."',
					Recorded=now(),
					Pencatat='creator-ImpAtrKDP'";
					echo $SQ."<br>";
					#$rs = mysql_query($SQ);
				}
				#echo $mRE[0]." : ".$mRE[6]." : ".$mRE[7]." : ".$mRE[8]."<br>";
			
				$SQ = "UPDATE atribusi_kdp SET Execute='Y' WHERE IDT='".$mRE[10]."'";
				echo $SQ."<br><br>";
				#$rs = mysql_query($SQ);
				
				$iGA++;
			}
		}
	}
	
}

$InsertKibLAINATL="YAxx";
if ($InsertKibLAINATL=="YA")
{
	$SW = "SELECT 
	IDT as A0,
	KD_SKPD as A1,
	Kd_UPB as A2,
	NAMA as A3,
	KODENEW as A4,
	KODE_108MAPLAIN as A5,
	REGISTERNEW as A6,
	'' as A7,
	'' as A8,
	'' as A9,
	ASALUSUL as A10,
	THNANGGARAN as A11,
	'' as A12,
	'RB' as A13,
	HARGA as A14,
	KETERANGAN as A15,
	TGL_MUTASI as A16,
	KODE as A17 

	FROM asetlainlainatl WHERE Execute='N' ORDER BY IDT LIMIT 0,500";
	#echo $SW;
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi","KDL.%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi","KDL.%","LIKE","","");
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi","KDL.%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		$NewRefKIB = "KDL.".fMakeReferensi($NewK,11);
		
		$TGL = $mR[11]."-12-31";
		
		$mREG = $mR[6];
		$mRSA = findMasaManfaat($mR[4],DatabaseSB,$ConSB);
		
		$SQ = "INSERT INTO ta_kib_108 SET 
		Referensi='".$NewRefKIB."',
		Ref_Group='',
		Ref_Mutasi='',
		Ref_Usulan='',
		Ref_History='',
		Ref_Usulan_His='',
		Kd_UPB='".$mR[2]."',
		Kd_Aset='".$mR[4]."',
		Kd_Aset_108='".$mR[5]."',
		Kd_Ruang='',
		No_Register='".$mREG."',
		No_Pengadaan='',
		Ref_Temp='',
		Nm_Aset='".mysql_real_escape_string($mR[3])."',
		Kd_Pemilik='12',
		Tgl_Perolehan='".$TGL."',
		Tgl_Mutasi='".$mR[16]."',
		Tgl_Mulai='0000-00-00',
		Tahun='".$mR[11]."',
		Luas_M2='0',
		Alamat='',
		Hak_Tanah='',
		Sertifikat_Tanggal='0000-00-00',
		Sertifikat_Nomor='',
		Penggunaan='',
		Asal_Usul='".mysql_real_escape_string($mR[10])."',
		Harga='".$mR[14]."',
		No_SP2D='',
		Merk='".mysql_real_escape_string($mR[7])."',
		Type='',
		Ukuran_CC='',
		Bahan='".mysql_real_escape_string($mR[9])."',
		Nomor_Pabrik='',
		Nomor_Rangka='',
		Nomor_Mesin='',
		Nomor_Polisi='',
		Nomor_BPKB='',
		Kondisi='".$mR[13]."',
		Masa_Manfaat='".$mRSA."',
		Nilai_Akhir='".$mR[14]."',
		Ukuran='".mysql_real_escape_string($mR[12])."',
		Keterangan='".mysql_real_escape_string($mR[15])."',
		Post='Y',
		ImportFrom='ExtraExcel',
		Recorded=now(),
		Pencatat='creator-ImpExtra4'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		$TGLM = $mR[16];
		
		$SLD = 'SLD'; 
		$URA = 'Saldo awal (nilai perolehan)';
		
		$SQ = "INSERT INTO ta_kib_post_108 SET 
		Referensi='".$NewRefKIB."',
		Ref_Group='',
		Kd_UPB='".$mR[2]."',
		Kd_Aset='".$mR[4]."',
		Kd_Aset_108='".$mR[5]."',
		No_Register='".$mREG."',
		Crit='".$SLD."',
		Tanggal='".$TGL."',
		Tgl_Mutasi='".$TGLM."',
		Uraian='".$URA."',
		DK='D',
		Debet='".$mR[14]."',
		Kredit='0',
		Keterangan='".mysql_real_escape_string($mR[15])."',
		Recorded=now(),
		Pencatat='creator-ImpExtra4'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		$SQ = "UPDATE asetlainlainatl SET Execute='Y' WHERE IDT='".$mR[0]."'";
		echo $SQ."<br><br>";
		$rs = mysql_query($SQ);
		
	}
}
################
$InsertKibLAIN="YAxx";
if ($InsertKibLAIN=="YA")
{
	$SW = "SELECT 
	IDT as A0,
	KD_SKPD as A1,
	Kd_UPB as A2,
	NAMA as A3,
	KODENEW as A4,
	KODE_108MAPLAIN as A5,
	REGISTERNEW as A6,
	MERK as A7,
	NOSERTIFIKAT as A8,
	BAHAN as A9,
	ASALUSUL as A10,
	TAHUNANGGARAN as A11,
	UKURAN as A12,
	KEADAANNEW as A13,
	HARGA as A14,
	KETERANGAN as A15,
	TGL_MUTASI as A16,
	KODE as A17 

	FROM asetlainlaingabung WHERE Execute='N' ORDER BY IDT LIMIT 0,500";
	#echo $SW;
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi","KDL.%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi","KDL.%","LIKE","","");
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi","KDL.%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		$NewRefKIB = "KDL.".fMakeReferensi($NewK,11);
		
		$TGL = $mR[11]."-12-31";
		
		$mREG = $mR[6];
		$mRSA = findMasaManfaat($mR[4],DatabaseSB,$ConSB);
		
		$mR14 = fGlobal("HARGA","asetlainlaingabung_rinci","REGISTERNEW:KODE",$mR[6].":".$mR[17],"=:=","IDT ASC","");
		
		$SQ = "INSERT INTO ta_kib_108 SET 
		Referensi='".$NewRefKIB."',
		Ref_Group='',
		Ref_Mutasi='',
		Ref_Usulan='',
		Ref_History='',
		Ref_Usulan_His='',
		Kd_UPB='".$mR[2]."',
		Kd_Aset='".$mR[4]."',
		Kd_Aset_108='".$mR[5]."',
		Kd_Ruang='',
		No_Register='".$mREG."',
		No_Pengadaan='',
		Ref_Temp='',
		Nm_Aset='".mysql_real_escape_string($mR[3])."',
		Kd_Pemilik='12',
		Tgl_Perolehan='".$TGL."',
		Tgl_Mutasi='".$mR[16]."',
		Tgl_Mulai='0000-00-00',
		Tahun='".$mR[11]."',
		Luas_M2='0',
		Alamat='',
		Hak_Tanah='',
		Sertifikat_Tanggal='0000-00-00',
		Sertifikat_Nomor='',
		Penggunaan='',
		Asal_Usul='".mysql_real_escape_string($mR[10])."',
		Harga='".$mR14."',
		No_SP2D='',
		Merk='".mysql_real_escape_string($mR[7])."',
		Type='',
		Ukuran_CC='',
		Bahan='".mysql_real_escape_string($mR[9])."',
		Nomor_Pabrik='',
		Nomor_Rangka='',
		Nomor_Mesin='',
		Nomor_Polisi='',
		Nomor_BPKB='',
		Kondisi='".$mR[13]."',
		Masa_Manfaat='".$mRSA."',
		Nilai_Akhir='".$mR[14]."',
		Ukuran='".mysql_real_escape_string($mR[12])."',
		Keterangan='".mysql_real_escape_string($mR[15])."',
		Post='Y',
		ImportFrom='ExtraExcel',
		Recorded=now(),
		Pencatat='creator-ImpExtra3'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		$iA=1;
		$SWE = "SELECT HARGA, KETERANGAN, TAHUNANGGARAN, THNMUTASI FROM asetlainlaingabung_rinci WHERE REGISTERNEW='".$mR[6]."' AND KODE='".$mR[17]."' ORDER BY IDT";
		#echo $SWE;
		$nRE = mysql_query($SWE);
		while ($mRE = mysql_fetch_array($nRE, MYSQL_BOTH))
		{
			$TGL  = $mRE[2]."-12-31";
			$TGLM = $mR[16];
			
			$SLD = 'INV';
			$URA = 'Atribusi';
			if ($iA==1){$SLD = 'SLD'; $URA = 'Saldo awal (nilai perolehan)';}
			
			$SQ = "INSERT INTO ta_kib_post_108 SET 
			Referensi='".$NewRefKIB."',
			Ref_Group='',
			Kd_UPB='".$mR[2]."',
			Kd_Aset='".$mR[4]."',
			Kd_Aset_108='".$mR[5]."',
			No_Register='".$mREG."',
			Crit='".$SLD."',
			Tanggal='".$TGL."',
			Tgl_Mutasi='".$TGLM."',
			Uraian='".$URA."',
			DK='D',
			Debet='".$mRE[0]."',
			Kredit='0',
			Keterangan='".mysql_real_escape_string($mRE[1])."',
			Recorded=now(),
			Pencatat='creator-ImpExtra3'";
			echo $SQ."<br>";
			$rs = mysql_query($SQ);
			
			$iA++;
		}
		$SQ = "UPDATE asetlainlaingabung SET Execute='Y' WHERE IDT='".$mR[0]."'";
		echo $SQ."<br><br>";
		$rs = mysql_query($SQ);
		
	}
}
#####################
$UpdateTabelExtraExcelKDRNew="YAxx";
if ($UpdateTabelExtraExcelKDRNew=="YA")
{
	$SW = "SELECT KODE FROM z_saldoextra_2 GROUP BY KODE";
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$KdRK = $mR[0];
		$KdNW = substr($KdRK,0,11);
		$KdNW.= '.0'.substr($KdRK,-2,2);
		
		$WS = "UPDATE z_saldoextra_2 SET 
		KODENew='".$KdNW."' WHERE KODE='".$KdRK."' AND KODENew=''";
		echo $WS."<br>";
		$eR = mysql_query($WS);
	}
}

$UpdateTabelExtraExcelKDR="YAxx";
if ($UpdateTabelExtraExcelKDR=="YA")
{
	$SW = "SELECT KODENew FROM z_saldoextra_2 GROUP BY KODENew";
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$Kd17 = $mR[0];
		$Kd08 = fGlobal("Kd_Aset108","ref_rek_aset5_maping","Kd_Aset17",$Kd17,"=","","");
		if ($Kd08!='')
		{
			$WS = "UPDATE z_saldoextra_2 SET 
			KODE_108='".$Kd08."' WHERE KODENew='".$Kd17."' AND KODE_108=''";
			echo $WS."<br>";
			$eR = mysql_query($WS);
		}
	}
}

$UpdateTabelExtraExcelREF="YAxx";
if ($UpdateTabelExtraExcelREF=="YA")
{
	$SW = "SELECT left(KODE_108,5) as A0 FROM z_saldoextra_2 GROUP BY left(KODE_108,5)";
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$Kd5 = $mR[0];
		$LRF = "XXX";
		if ($Kd5=='1.3.2'){$LRF="ALT";}
		if ($Kd5=='1.3.3'){$LRF="BNG";}
		if ($Kd5=='1.3.5'){$LRF="ATL";}
		$WS = "UPDATE z_saldoextra_2 SET LREF='".$LRF."' WHERE KODE_108 LIKE '".$Kd5."%' AND LREF=''";
		echo $WS."<br>";
		$eR = mysql_query($WS);
	}
}

$UpdateTabelExtraExcel="YAxx";
if ($UpdateTabelExtraExcel=="YA")
{
	$SW = "SELECT SKPD as A0, 
	KD_SKPD as A1,
	KD_UPB as A2 
	FROM z_nmskpd ORDER BY KD_SKPD";
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$NmSK = $mR[0];
		$KdSK = $mR[1];
		$KdUP = $mR[2];
		$WS = "UPDATE z_saldoextra_2 SET 
		KD_SKPD='".$KdSK."',
		Kd_UPB='".$KdUP."' 
		WHERE SKPD='".$NmSK."'";
		echo $WS."<br>";
		$eR = mysql_query($WS);
	}
}
############################################
############################################
$UpdateTabelExtraExcelRB="YAxxxxxxxxxx";
if ($UpdateTabelExtraExcelRB=="YA")
{
	$SW = "SELECT SKPD as A0, 
	KD_SKPD as A1,
	KD_UPB as A2 
	FROM z_nmskpd ORDER BY KD_SKPD";
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$NmSK = $mR[0];
		$KdSK = $mR[1];
		$KdUP = $mR[2];
		$WS = "UPDATE z_saldoextra_3_rb SET 
		KD_SKPD='".$KdSK."',
		Kd_UPB='".$KdUP."' 
		WHERE SKPD='".$NmSK."'";
		echo $WS."<br>";
		$eR = mysql_query($WS);
	}
}

$UpdateTabelExtraExcelKDRB="YAxx";
if ($UpdateTabelExtraExcelKDRB=="YA")
{
	$SW = "SELECT KODENew FROM z_saldoextra_3_rb WHERE KEADAAN='Double Catat ' GROUP BY KODENew";
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$Kd17 = $mR[0];
		$Kd08 = fGlobal("Kd_Aset108","ref_rek_aset5_maping","Kd_Aset17",$Kd17,"=","","");
		if ($Kd08!='')
		{
			$Kd08RB = fGlobal("Kd_Aset","ref_rek_aset108_7_barsel","Link_Kib_AE:Kd_Aset",$Kd08.":1.5.4.05%","=:LIKE","","");
			if ($Kd08RB!='')
			{
				$WS = "UPDATE z_saldoextra_3_rb SET 
				KODE_108='".$Kd08RB."' WHERE KODENew='".$Kd17."' AND KEADAAN='Double Catat '";
				echo $WS."<br>";
				$eR = mysql_query($WS);
			}
		}
	}
}

$InsertKibExtracomRB="YAxx";
if ($InsertKibExtracomRB=="YA")
{
	$LREF = 'KDL';
	
	$SW = "SELECT 
	IDT as A0,
	KD_SKPD as A1,
	Kd_UPB as A2,
	NAMA as A3,
	KODENew as A4,
	KODE_108 as A5,
	REGISTERNEW as A6,
	MERK as A7,
	NOSERTIFIKAT as A8,
	BAHAN as A9,
	ASALUSUL as A10,
	TAHUN as A11,
	UKURAN as A12,
	KEADAANNEW as A13,
	HARGA as A14,
	KETERANGAN as A15,
	extracom as A16,
	LREF as A17,
	THNUSUL as A18 
	FROM z_saldoextra_3_rb WHERE LREF='".$LREF."' AND Execute='N' ORDER BY IDT LIMIT 0,500";
	#echo $SW;
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi",$mR[17].".%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi",$mR[17].".%","LIKE","","");
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi",$mR[17].".%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		$NewRefKIB = $mR[17].".".fMakeReferensi($NewK,11);
		
		$TGL = $mR[11]."-12-31";
		$TGM = $mR[18]."-12-31";
		
		$mREG = $mR[6];
		$mRSA = findMasaManfaat($mR[5],DatabaseSB,$ConSB);
		
		$SQ = "INSERT INTO ta_kib_108 SET 
		Referensi='".$NewRefKIB."',
		Ref_Group='',
		Ref_Mutasi='',
		Ref_Usulan='',
		Ref_History='',
		Ref_Usulan_His='',
		Kd_UPB='".$mR[2]."',
		Kd_Aset='".$mR[4]."',
		Kd_Aset_108='".$mR[5]."',
		Kd_Ruang='',
		No_Register='".$mREG."',
		No_Pengadaan='',
		Ref_Temp='',
		Nm_Aset='".mysql_real_escape_string($mR[3])."',
		Kd_Pemilik='12',
		Tgl_Perolehan='".$TGL."',
		Tgl_Mutasi='".$TGM."',
		Tgl_Mulai='0000-00-00',
		Tahun='".$mR[11]."',
		Luas_M2='0',
		Alamat='',
		Hak_Tanah='',
		Sertifikat_Tanggal='0000-00-00',
		Sertifikat_Nomor='',
		Penggunaan='',
		Asal_Usul='".mysql_real_escape_string($mR[10])."',
		Harga='".$mR[14]."',
		No_SP2D='',
		Merk='".mysql_real_escape_string($mR[7])."',
		Type='',
		Ukuran_CC='',
		Bahan='".mysql_real_escape_string($mR[9])."',
		Nomor_Pabrik='',
		Nomor_Rangka='',
		Nomor_Mesin='',
		Nomor_Polisi='',
		Nomor_BPKB='',
		Kondisi='".$mR[13]."',
		Masa_Manfaat='".$mRSA."',
		Nilai_Akhir='".$mR[14]."',
		Ukuran='".mysql_real_escape_string($mR[12])."',
		Keterangan='".mysql_real_escape_string($mR[15])."',
		Post='Y',
		extracom='".$mR[16]."',
		ImportFrom='ExtraExcel',
		Recorded=now(),
		Pencatat='creator-ImpExtra3rb'";
		echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		$SQ = "INSERT INTO ta_kib_post_108 SET 
		Referensi='".$NewRefKIB."',
		Ref_Group='',
		Kd_UPB='".$mR[2]."',
		Kd_Aset='".$mR[4]."',
		Kd_Aset_108='".$mR[5]."',
		No_Register='".$mREG."',
		Crit='SLD',
		Tanggal='".$TGL."',
		Tgl_Mutasi='".$TGM."',
		Uraian='Saldo awal (nilai perolehan)',
		DK='D',
		Debet='".$mR[14]."',
		Kredit='0',
		Keterangan='".mysql_real_escape_string($mR[15])."',
		extracom='".$mR[16]."',
		Recorded=now(),
		Pencatat='creator-ImpExtra3rb'";
		$rs = mysql_query($SQ);
		echo $SQ."<br>";
		
		$SQ = "UPDATE z_saldoextra_3_rb SET Execute='Y' WHERE IDT='".$mR[0]."'";
		$rs = mysql_query($SQ);
	}
}
############################################
############################################

$InsertKibExtracom="YAxxxxx";
if ($InsertKibExtracom=="YA")
{
	#$LREF = 'BNG';
	#$LREF = 'ALT';
	$LREF = 'ATL';
	
	$SW = "SELECT 
	IDT as A0,
	KD_SKPD as A1,
	Kd_UPB as A2,
	NAMA as A3,
	KODENew as A4,
	KODE_108 as A5,
	REGISTER as A6,
	MERK as A7,
	NO_SERTIFIKAT as A8,
	BAHAN as A9,
	ASALUSUL as A10,
	TAHUN as A11,
	UKURAN as A12,
	KEADAANNEW as A13,
	HARGA as A14,
	KETERANGAN as A15,
	extracom as A16,
	LREF as A17 
	FROM z_saldoextra_2 WHERE LREF='".$LREF."' AND Execute='N' ORDER BY IDT LIMIT 0,5000";
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi",$mR[17].".%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi",$mR[17].".%","LIKE","","");
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi",$mR[17].".%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		$NewRefKIB = $mR[17].".".fMakeReferensi($NewK,11);
		
		$TGL = $mR[11]."-12-31";
		
		$mREG = substr("0000000".$mR[6],-7,7);
		$mRSA = findMasaManfaat($mR[5],DatabaseSB,$ConSB);
		
		$SQ = "INSERT INTO ta_kib_108 SET 
		Referensi='".$NewRefKIB."',
		Ref_Group='',
		Ref_Mutasi='',
		Ref_Usulan='',
		Ref_History='',
		Ref_Usulan_His='',
		Kd_UPB='".$mR[2]."',
		Kd_Aset='".$mR[4]."',
		Kd_Aset_108='".$mR[5]."',
		Kd_Ruang='',
		No_Register='".$mREG."',
		No_Pengadaan='',
		Ref_Temp='',
		Nm_Aset='".mysql_real_escape_string($mR[3])."',
		Kd_Pemilik='12',
		Tgl_Perolehan='".$TGL."',
		Tgl_Mutasi='0000-00-00',
		Tgl_Mulai='0000-00-00',
		Tahun='".$mR[11]."',
		Luas_M2='0',
		Alamat='',
		Hak_Tanah='',
		Sertifikat_Tanggal='0000-00-00',
		Sertifikat_Nomor='',
		Penggunaan='',
		Asal_Usul='".mysql_real_escape_string($mR[10])."',
		Harga='".$mR[14]."',
		No_SP2D='',
		Merk='".mysql_real_escape_string($mR[7])."',
		Type='',
		Ukuran_CC='',
		Bahan='".mysql_real_escape_string($mR[9])."',
		Nomor_Pabrik='',
		Nomor_Rangka='',
		Nomor_Mesin='',
		Nomor_Polisi='',
		Nomor_BPKB='',
		Kondisi='".$mR[13]."',
		Masa_Manfaat='".$mRSA."',
		Nilai_Akhir='".$mR[14]."',
		Ukuran='".mysql_real_escape_string($mR[12])."',
		Keterangan='".mysql_real_escape_string($mR[15])."',
		Post='Y',
		extracom='".$mR[16]."',
		ImportFrom='ExtraExcel',
		Recorded=now(),
		Pencatat='creator-ImpExtra2'";
		$rs = mysql_query($SQ);
		
		$SQ = "INSERT INTO ta_kib_post_108 SET 
		Referensi='".$NewRefKIB."',
		Ref_Group='',
		Kd_UPB='".$mR[2]."',
		Kd_Aset='".$mR[4]."',
		Kd_Aset_108='".$mR[5]."',
		No_Register='".$mREG."',
		Crit='SLD',
		Tanggal='".$TGL."',
		Uraian='Saldo awal (nilai perolehan)',
		DK='D',
		Debet='".$mR[14]."',
		Kredit='0',
		Keterangan='".mysql_real_escape_string($mR[15])."',
		extracom='".$mR[16]."',
		Recorded=now(),
		Pencatat='creator-ImpExtra2'";
		$rs = mysql_query($SQ);
		echo $SQ."<br>";
		
		$SQ = "UPDATE z_saldoextra_2 SET Execute='Y' WHERE IDT='".$mR[0]."'";
		$rs = mysql_query($SQ);
	}
}
#####################################################################################

$CopyAsetLainnya108subsub="YA";
if ($CopyAsetLainnya108subsub=="YAx")
{
	$nKD = "1.5.4.01";
	$nKD = "1.5.4.02";
	$nKD = "1.5.4.03";
	$nKD = "1.5.4.04";
	$nKD = "1.5.4.05";
	$nKD = "1.5.4.06";
	$SW = "SELECT Kd_Aset, LinkKeAsetTetap FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$nKD.".%' AND LinkKeAsetTetap<>'' ORDER BY Kd_Aset";
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		#echo $mR[0]." : ".$mR[1]."<br>";
		$CeK = fGlobal("IDT","ref_rek_aset108_7","Kd_Aset",$mR[0]."%","LIKE","","");
		if ($CeK==''){
			#echo "copy<br>";
			$rSW = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_7 WHERE Kd_Aset LIKE '".$mR[1].".%' ORDER BY Kd_Aset";
			$rnR = mysql_query($rSW);
			while ($rmR = mysql_fetch_array($rnR, MYSQL_BOTH))
			{
				$NewKd = functionNewKdsubsub($mR[0]);
				echo $rmR[0]." : ".$NewKd." : ".$rmR[1]."<br>";
				$WS = "INSERT INTO ref_rek_aset108_7 SET Kd_Aset='".$NewKd."', Nm_Aset='".$rmR[1]."', Link_Kib_AE='".$rmR[0]."'";
				$eR = mysql_query($WS);
				echo $WS."<br><br>";
			}
		}
	}
}

$CopyAsetLainnya108sub="YAx";
if ($CopyAsetLainnya108sub=="YA")
{
	$nKD = "1.5.4.01";
	$nKD = "1.5.4.02";
	$nKD = "1.5.4.03";
	$nKD = "1.5.4.04";
	$nKD = "1.5.4.05";
	$nKD = "1.5.4.06";
	$SW = "SELECT Kd_Aset, LinkKeAsetTetap FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$nKD.".%' ORDER BY Kd_Aset";
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$mR0 = $mR[0];
		$mR1 = $mR[1];
		if ($mR1 > 1)
		{
			$CeK = fGlobal("IDT","ref_rek_aset108_6","Kd_Aset",$mR0."%","LIKE","","");
			if ($CeK==''){
				if ($mR1!=''){
					$Link = $mR1;
					$CntR = substr_count($Link,'-');
					if ($CntR > 0){
						$eLin = explode("-",$Link);
						for ($aa=0; $aa<=$CntR; $aa++)
						{
							$eSW = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$eLin[$aa].".%' ORDER BY Kd_Aset";
							$enR = mysql_query($eSW);
							while ($emR = mysql_fetch_array($enR, MYSQL_BOTH))
							{
								$NewKd = functionNewKdsub($mR0);
								echo $emR[0]."=>".$NewKd."<br>";
								$WS = "INSERT INTO ref_rek_aset108_6 SET Kd_Aset='".$NewKd."', Nm_Aset='".$emR[1]."', LinkKeAsetTetap='".$emR[0]."'";
								$eR = mysql_query($WS);
								echo $WS."<br><br>";
							}
							
						}
					}
					else
					{
						$eSW = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$Link.".%' ORDER BY Kd_Aset";
						$enR = mysql_query($eSW);
						while ($emR = mysql_fetch_array($enR, MYSQL_BOTH))
						{
							$NewKd = functionNewKdsub($mR0);
							echo $emR[0]."=>".$NewKd."<br>";
							$WS = "INSERT INTO ref_rek_aset108_6 SET Kd_Aset='".$NewKd."', Nm_Aset='".$emR[1]."', LinkKeAsetTetap='".$emR[0]."'";
							$eR = mysql_query($WS);
							echo $WS."<br><br>";
						}
					}
				}
				echo "<br>";
			}
		}
	}
}


#AddField("ref_rek_aset5_maping","Kd_Aset108","varchar(18)","NULL","","","1",DatabaseSB,$ConSB);

for($eTB=1; $eTB<=20; $eTB++)
{
	#$SQW= "UPDATE ".namaTabel($eTB)." SET kd_upb = REPLACE(kd_upb,'00.000','01.001') WHERE kd_upb like '%.00.000'";
	#$rW = mysql_query($SQW);

	#$SQW= "UPDATE ".namaTabel($eTB)." SET kd_upb = REPLACE(kd_upb,'.000','.001') WHERE kd_upb like '%.000'";
	#$rW = mysql_query($SQW);

	#$SQW= "UPDATE ".namaTabel($eTB)." SET kd_upb = REPLACE(kd_upb,'.00.','.01.') WHERE kd_upb like '%.00.%'";
	#$rW = mysql_query($SQW);
}

function namaTabel($nX)
{
	$nmArr = array ('','ta_kib_a','ta_kib_a_merger_his','ta_kib_a_mutasi','ta_kib_b','ta_kib_b_mutasi','ta_kib_c','ta_kib_c_merger_his','ta_kib_c_mutasi','ta_kib_d','ta_kib_d_merger_his','ta_kib_d_mutasi','ta_kib_e','ta_kib_e_mutasi','ta_kib_f','ta_kib_f_mutasi','ta_kib_g','ta_kib_g_mutasi','ta_kib_post','ta_kib_post_mutasi','ta_usulan_rinci');
	return $nmArr[$nX];
}


/*
AddField("ta_kib_a","MasukKeUsulan","enum('sudah','belum')","NULL","belum","","1",DatabaseSB,$ConSB);
AddField("ta_kib_a_merger_his","MasukKeUsulan","enum('sudah','belum')","NULL","belum","","1",DatabaseSB,$ConSB);
AddField("ta_kib_b","MasukKeUsulan","enum('sudah','belum')","NULL","belum","","1",DatabaseSB,$ConSB);
AddField("ta_kib_c","MasukKeUsulan","enum('sudah','belum')","NULL","belum","","1",DatabaseSB,$ConSB);
AddField("ta_kib_c_merger_his","MasukKeUsulan","enum('sudah','belum')","NULL","belum","","1",DatabaseSB,$ConSB);
AddField("ta_kib_d","MasukKeUsulan","enum('sudah','belum')","NULL","belum","","1",DatabaseSB,$ConSB);
AddField("ta_kib_d_merger_his","MasukKeUsulan","enum('sudah','belum')","NULL","belum","","1",DatabaseSB,$ConSB);
AddField("ta_kib_e","MasukKeUsulan","enum('sudah','belum')","NULL","belum","","1",DatabaseSB,$ConSB);
AddField("ta_kib_g","MasukKeUsulan","enum('sudah','belum')","NULL","belum","","1",DatabaseSB,$ConSB);
AddField("ta_usulan_rinci","IdTTaKib","varchar(30)","NULL","","","1",DatabaseSB,$ConSB);
*/

#AddField("ta_kib_b","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
#AddField("ta_kib_c","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
#AddField("ta_kib_d","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
#AddField("ta_kib_e","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
#AddField("ta_kib_g","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);

/*
$SQW="ALTER TABLE `ta_kib_a_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR','TW') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_kib_b_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR','TW') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_kib_c_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR','TW') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_kib_d_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR','TW') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_kib_e_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR','TW') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_kib_f_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR','TW') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_kib_g_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR','TW') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_kib_post_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR','TW') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_usulan` CHANGE COLUMN `Jenis` `Jenis` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR','TW') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_usulan_verifikasi` CHANGE COLUMN `Jenis` `Jenis` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR','TW') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);
*/

#ChangeNmOrLenghtField("ta_kib_c_merger_his","Referensi","Referensi","15","varchar","17","",DatabaseSB,$ConSB);
#AddField("ta_kib_e","Kd_Ruang","varchar(4)","NULL","","","",DatabaseSB,$ConSB);

#ChangeNmOrLenghtField("ta_rkbmd","Nm_Aset","Nm_Aset","100","varchar","500","",DatabaseSB,$ConSB);
#ChangeNmOrLenghtField("ta_rkbmd","Kd_Kegiatan","Kd_Kegiatan","13","varchar","25","",DatabaseSB,$ConSB);
#ChangeNmOrLenghtField("ta_rkpbmd","Kd_Kegiatan","Kd_Kegiatan","13","varchar","25","",DatabaseSB,$ConSB);
#ChangeNmOrLenghtField("ta_rkpbmd_rinci","Referensi","Referensi","26","varchar","27","",DatabaseSB,$ConSB);

#AddField("ta_kib_post","ReValue","enum('Y','N')","NULL","N","","",DatabaseSB,$ConSB);

#AddField("ta_kib_post_penyusutan_bulanan","Ref_History","varchar(15)","NULL","N","Referensi","1",DatabaseSB,$ConSB);

#AddField("ta_kib_post_penyusutan_bulanan","MshAdaDi_07","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
#AddField("ref_rek_aset5_maping","Kd_Aset13","varchar(11)","NULL","","","1",DatabaseSB,$ConSB);

#AddField("ta_kib_f","Ref_Mutasi","varchar(15)","NULL","","Ref_Group","1",DatabaseSB,$ConSB);
#AddField("ta_kib_f","Ref_Usulan","varchar(17)","NULL","","Ref_Mutasi","1",DatabaseSB,$ConSB);

#AddField("ta_kib_post_penyusutan","SdhMutasi","enum('Y','N')","NULL","N","","",DatabaseSB,$ConSB);
#AddField("ta_kib_post_penyusutan_bulanan","SdhMutasi","enum('Y','N')","NULL","N","","",DatabaseSB,$ConSB);

/*
AddField("ta_kib_a","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
AddField("ta_kib_b","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
AddField("ta_kib_c","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
AddField("ta_kib_d","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
AddField("ta_kib_e","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
AddField("ta_kib_g","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);

AddField("ta_kib_a_mutasi","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
AddField("ta_kib_b_mutasi","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
AddField("ta_kib_c_mutasi","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
AddField("ta_kib_d_mutasi","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
AddField("ta_kib_e_mutasi","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
AddField("ta_kib_g_mutasi","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);

AddField("ta_kib_a_merger_his","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
AddField("ta_kib_c_merger_his","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
AddField("ta_kib_d_merger_his","NilaiBuku","double(19,2)","NULL","0","extracom","",DatabaseSB,$ConSB);
*/
#AddField("ta_usulan_verifikasi_rinci","Recorded","DateTime","NULL","0000-00-00 00:00:00","","",DatabaseSB,$ConSB);
#AddField("ta_usulan_verifikasi_rinci","Pencatat","varchar(30)","NULL","","","",DatabaseSB,$ConSB);

#AddIndex('ta_usulan_verifikasi_rinci','Ref_Aset');
#AddIndex('ta_usulan_verifikasi_rinci','Ref_Usulan');
#AddIndex('ta_usulan_verifikasi_rinci','Kd_Aset');
#AddIndex('ta_usulan_verifikasi_rinci','To_UPB');
#AddIndex('ta_usulan_verifikasi_rinci','Verifikasi');
#AddIndex('ta_usulan_verifikasi_rinci','Eksekusi');

#AddField("ta_kib_g","Ref_Usulan_His","varchar(17)","NULL","","Ref_Usulan","",DatabaseSB,$ConSB);
#AddField("ta_kib_g_mutasi","Ref_Usulan_His","varchar(17)","NULL","","Ref_Usulan","",DatabaseSB,$ConSB);
#AddField("ta_kib_post","Ref_Usulan_His","varchar(17)","NULL","","Ref_Usulan","",DatabaseSB,$ConSB);
#AddField("ta_kib_post_mutasi","Ref_Usulan_His","varchar(17)","NULL","","Ref_Usulan","",DatabaseSB,$ConSB);

#AddField("ta_kib_a_merger_his","Ref_Usulan","varchar(17)","NULL","","Ref_Mutasi","1",DatabaseSB,$ConSB);
#AddField("ta_kib_a_merger_his","Tgl_Mutasi","date","NULL","0000-00-00","Tgl_Perolehan","1",DatabaseSB,$ConSB);
#AddField("ta_kib_c_merger_his","Ref_Usulan","varchar(17)","NULL","","Ref_Mutasi","1",DatabaseSB,$ConSB);
#AddField("ta_kib_d_merger_his","Ref_Usulan","varchar(17)","NULL","","Ref_Mutasi","1",DatabaseSB,$ConSB);

/*
AddIndex('ta_kib_a','Ref_Mutasi');
AddIndex('ta_kib_a','Ref_Usulan');
AddIndex('ta_kib_b','Ref_Mutasi');
AddIndex('ta_kib_b','Ref_Usulan');
AddIndex('ta_kib_c','Ref_Mutasi');
AddIndex('ta_kib_c','Ref_Usulan');
AddIndex('ta_kib_d','Ref_Mutasi');
AddIndex('ta_kib_d','Ref_Usulan');
AddIndex('ta_kib_e','Ref_Mutasi');
AddIndex('ta_kib_e','Ref_Usulan');
AddIndex('ta_kib_g','Ref_Mutasi');
AddIndex('ta_kib_g','Ref_Usulan');
AddIndex('ta_kib_post','Mrg_Ref_History');
AddField("ta_kib_a_mutasi","Tgl_Mutasi_Masuk","date","NULL","0000-00-00","Tgl_Mutasi","1",DatabaseSB,$ConSB);
AddField("ta_kib_b_mutasi","Tgl_Mutasi_Masuk","date","NULL","0000-00-00","Tgl_Mutasi","1",DatabaseSB,$ConSB);
AddField("ta_kib_c_mutasi","Tgl_Mutasi_Masuk","date","NULL","0000-00-00","Tgl_Mutasi","1",DatabaseSB,$ConSB);
AddField("ta_kib_d_mutasi","Tgl_Mutasi_Masuk","date","NULL","0000-00-00","Tgl_Mutasi","1",DatabaseSB,$ConSB);
AddField("ta_kib_e_mutasi","Tgl_Mutasi_Masuk","date","NULL","0000-00-00","Tgl_Mutasi","1",DatabaseSB,$ConSB);
AddField("ta_kib_g_mutasi","Tgl_Mutasi_Masuk","date","NULL","0000-00-00","Tgl_Mutasi","1",DatabaseSB,$ConSB);
AddField("ta_kib_post_mutasi","Tgl_Mutasi_Masuk","date","NULL","0000-00-00","Tgl_Mutasi","1",DatabaseSB,$ConSB);


AddField("ta_kib_a","Ref_Usulan","varchar(17)","NULL","","Ref_Mutasi","1",DatabaseSB,$ConSB);
AddField("ta_kib_a_mutasi","Ref_Usulan","varchar(17)","NULL","","Referensi_To","1",DatabaseSB,$ConSB);

AddField("ta_kib_b","Ref_Usulan","varchar(17)","NULL","","Ref_Mutasi","1",DatabaseSB,$ConSB);
AddField("ta_kib_b_mutasi","Ref_Usulan","varchar(17)","NULL","","Referensi_To","1",DatabaseSB,$ConSB);
AddField("ta_kib_c","Ref_Usulan","varchar(17)","NULL","","Ref_Mutasi","",DatabaseSB,$ConSB);
AddField("ta_kib_c_mutasi","Ref_Usulan","varchar(17)","NULL","","Referensi_To","1",DatabaseSB,$ConSB);

AddField("ta_kib_d","Ref_Usulan","varchar(17)","NULL","","Ref_Mutasi","",DatabaseSB,$ConSB);
AddField("ta_kib_d_mutasi","Ref_Usulan","varchar(17)","NULL","","Referensi_To","1",DatabaseSB,$ConSB);

AddField("ta_kib_e","Ref_Usulan","varchar(17)","NULL","","Ref_Mutasi","",DatabaseSB,$ConSB);
AddField("ta_kib_e_mutasi","Ref_Usulan","varchar(17)","NULL","","Referensi_To","1",DatabaseSB,$ConSB);

############
AddField("ta_kib_g_mutasi","Ref_Usulan_His","varchar(17)","NULL","","Ref_Usulan","",DatabaseSB,$ConSB);
AddField("ta_kib_post_mutasi","Ref_Usulan_His","varchar(17)","NULL","","Ref_Usulan","",DatabaseSB,$ConSB);
############
*/

#$nSQL= "delete from ta_kib_post where Kd_UPB=''";
#$nRs = mysql_query($nSQL);

#AddIndex('ta_kib_group','Kd_UPB');
#AddIndex('ta_kib_group','No_Pengadaan');
#AddIndex('ta_kib_group','Ref_Temp');
#AddIndex('ta_kib_group','Referensi');

#$nSQL= "delete from ta_kib_post where IDT='680079'";
#$nRs = mysql_query($nSQL);

#$nSQL= "delete from ta_pengadaan where IDT='68'";
#$nRs = mysql_query($nSQL) or die(mysql_error());
#$nSQL= "delete from ta_pengadaan_rinci where IDT='8'";
#$nRs = mysql_query($nSQL) or die(mysql_error());

/*
AddField("ta_kib_a","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_a_mutasi","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_b","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_b_mutasi","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_c","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_c_mutasi","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_d","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_d_mutasi","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_e","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_f","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_e_mutasi","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_g","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_g_mutasi","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_post","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
AddField("ta_kib_post_mutasi","extracom","enum('Y','N')","NULL","N","","1",DatabaseSB,$ConSB);
*/

#AddIndex('ta_kib_a','extracom');
#AddIndex('ta_kib_b','extracom');
#AddIndex('ta_kib_c','extracom');
#AddIndex('ta_kib_d','extracom');
#AddIndex('ta_kib_e','extracom');
#AddIndex('ta_kib_post','extracom');

#AddField("ta_kib_post","Ref_Mutasi","varchar(15)","NULL","","Ref_History","1",DatabaseSB,$ConSB);
#AddField("ta_kib_post","Tgl_Mutasi","date","NULL","0000-00-00","Tanggal_BAST","1",DatabaseSB,$ConSB);


#Prtanian
#$SW="update ta_usulan_verifikasi_rinci set Eksekusi='Belum' where IDT='3367'";
#$rw = mysql_query($SW);

#$SW="update ta_usulan_verifikasi_rinci set Eksekusi='Belum' where IDT='3368'";
#$rw = mysql_query($SW);

#AddField("ta_kib_g","Ref_Mutasi","varchar(115)","NULL","","Ref_Group","",DatabaseSB,$ConSB);

#AddIndex('ta_kib_e_mutasi','Kd_UPB_To');
#AddIndex('ta_kib_e_mutasi','Kd_Aset_To');
#AddIndex('ta_kib_e_mutasi','Tgl_Mutasi');
#AddIndex('ta_kib_e_mutasi','Jns_Mutasi');

#AddIndex('ta_kib_a_mutasi','Kd_UPB_To');
#AddIndex('ta_kib_a_mutasi','Kd_Aset_To');
#AddIndex('ta_kib_a_mutasi','Tgl_Mutasi');
#AddIndex('ta_kib_a_mutasi','Jns_Mutasi');

#AddIndex('ta_usulan','Tanggal');
#AddIndex('ta_usulan','Jenis');

#AddIndex('ta_usulan_verifikasi','Tanggal');
#AddIndex('ta_usulan_verifikasi','Jenis');
#AddIndex('ta_usulan_verifikasi','Ref_Usulan');

#AddIndex('ta_usulan_rinci','Referensi');
#AddIndex('ta_usulan_rinci','Ref_Aset');
#AddIndex('ta_usulan_rinci','Kd_Aset');

#AddIndex('ta_usulan_verifikasi_rinci','Ref_Aset');
#AddIndex('ta_usulan_verifikasi_rinci','Ref_Usulan');
#AddIndex('ta_usulan_verifikasi_rinci','Kd_UPB');
#AddIndex('ta_usulan_verifikasi_rinci','Kd_Aset');
#AddField("ta_usulan_verifikasi_rinci","Nilai_Akhir","double(19,2)","NULL","0","Harga","",DatabaseSB,$ConSB);

#Dinsos
#$SW="delete from ta_kib_b_mutasi where IDT='348'";
#$rw = mysql_query($SW);

#Dinsos
#$SW="delete from ta_kib_post_mutasi where IDT='998'";
#$rw = mysql_query($SW);

#$SQ="UPDATE ta_kib_post SET kd_upb='24.04.10.01.02.001' where IDT='125653'";
#$nRs = mysql_query($SQ);

#AddField("ta_kib_post","Tgl_Mutasi","date","NULL","0000-00-00","Tanggal","",DatabaseSB,$ConSB);

#$SW="delete from ta_pengadaan where IDT='132'";
#$rw = mysql_query($SW);

#$SW="delete from ta_pengadaan where IDT='1019'";
#$rw = mysql_query($SW);

#$SW="delete from ta_pengadaan where IDT='435'";
#$rw = mysql_query($SW);

#$SW="delete from ta_pengadaan where IDT='465'";
#$rw = mysql_query($SW);

#$SW="delete from ta_pengadaan where IDT='466'";
#$rw = mysql_query($SW);

#$SW="delete from ta_pengadaan where IDT='305'";
#$rw = mysql_query($SW);

#$SW="delete from ta_kib_post where IDT='649648'";
#$rw = mysql_query($SW);
#$SW="delete from ta_kib_post where IDT='649649'";
#$rw = mysql_query($SW);

#AddField("ta_pengadaan","Kd_Program","varchar(18)","NULL","-","Kd_Unit","",DatabaseSB,$ConSB);
#AddField("ta_pengadaan","Nm_Program","varchar(255)","NULL","-","Kd_Program","",DatabaseSB,$ConSB);
#AddField("ta_pengadaan","Kd_Kegiatan","varchar(22)","NULL","-","Nm_Program","",DatabaseSB,$ConSB);
#AddField("ta_pengadaan","Nm_Kegiatan","varchar(255)","NULL","-","Kd_Kegiatan","",DatabaseSB,$ConSB);
#AddField("ta_pengadaan","Kd_Rek13","varchar(11)","NULL","-","Nm_Kegiatan","",DatabaseSB,$ConSB);
#AddField("ta_pengadaan","Nm_Rek13","varchar(255)","NULL","-","Kd_Rek13","",DatabaseSB,$ConSB);
#AddIndex("ta_kib_post","No_Pengadaan");
#$SW="delete from ta_kib_post where IDT='619895'";
#$rw = mysql_query($SW);

/*
$SQ="select IDT, Tanggal from ta_kib_post WHERE Tanggal_BAST='0000-00-00' ORDER BY IDT LIMIT 0,500";
$nRs = mysql_query($SQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$IdT = $mRo[0];
	$TgL = $mRo[1];
	$SW="update ta_kib_post set Tanggal_BAST='$TgL' where IDT='".$IdT."'";
	$rw = mysql_query($SW);
}
*/
#AddField("ta_kib_post","KdpToAset","enum('Y','N')","NULL","N","","",DatabaseSB,$ConSB);
#$SQ="select Referensi, KdpToAset from ta_kib_f ORDER BY Referensi";
#$nRs = mysql_query($SQ);
#while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
#{
#	$RefR = $mRo[0];
#	$EnuM = $mRo[1];
	
#	$SW="update ta_kib_post set KdpToAset='$EnuM' where Referensi='".$RefR."'";
#	$rw = mysql_query($SW);
#}

#$SQ="DELETE FROM ta_kib_post where IDT='403473'";
#$nRs = mysql_query($SQ);


#$SQ="UPDATE ta_penerimaan_berkas SET Proses='N' where Nomor='24.04.13.01.2018.000001'";
#$nRs = mysql_query($SQ);

#$SQ="UPDATE ta_penerimaan_berkas SET Proses='N' where Nomor='24.04.13.01.2018.000003'";
#$nRs = mysql_query($SQ);

//echo $_GET['IdL']."xxxxxxx";
#$SQ="ALTER TABLE `simbada_barsel_data`.`ta_apbd_kegiatan_skpd` DROP INDEX `idKegiatan`";
#$nRs = mysql_query($SQ);
  
#$SQ="update ta_apbd_program_skpd set kdUnit='24.04.09.02' WHERE idProgram like '1.06.1.06%'";
#$nRs = mysql_query($SQ);

#$SQ="update ta_apbd_kegiatan_skpd set kdUnit='24.04.09.02' WHERE idKegiatan like '1.06.1.06%'";
#$nRs = mysql_query($SQ);

/*
$SQ="select IDT, idProgram, nmProgram from ref_barsel_program WHERE idReferensi='' ORDER BY idProgram";
$nRs = mysql_query($SQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$IdDT = $mRo[1];
	$mL4 = substr($IdDT,0,4);
	$mL8 = substr($IdDT,5,4);
	if ($mL4==$mL8){
		$IdRF = "X.XX.XX.".substr($IdDT,13,15);
	}
	else{
		$IdRF = $mL4.".XX.".substr($IdDT,13,15);
	}
	$SW="update ref_barsel_program set idReferensi='$IdRF' where IDT='".$mRo[0]."'";
	$rw = mysql_query($SW);
}

$SQ="select IDT, idKegiatan, nmKegiatan from ref_barsel_kegiatan WHERE idReferensi='' ORDER BY idKegiatan";
$nRs = mysql_query($SQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$IdDT = $mRo[1];
	$mL4 = substr($IdDT,0,4);
	$mL8 = substr($IdDT,5,4);
	if ($mL4==$mL8){
		$IdRF = "X.XX.XX.".substr($IdDT,13,15);
	}
	else{
		$IdRF = $mL4.".XX.".substr($IdDT,13,15);
	}
	$SW="update ref_barsel_kegiatan set idReferensi='$IdRF' where IDT='".$mRo[0]."'";
	$rw = mysql_query($SW);
}

ChangeNmOrLenghtField("ta_penerimaan_berkas","Kd_Program","Kd_Program","15","varchar","18","",DatabaseSB,$ConSB);
ChangeNmOrLenghtField("ta_penerimaan_berkas","Kd_Kegiatan","Kd_Kegiatan","18","varchar","22","",DatabaseSB,$ConSB);

ChangeNmOrLenghtField("ta_kontrak","Kegiatan","Kegiatan","18","varchar","22","",DatabaseSB,$ConSB);


$SQ="select IDT, idProgram from ta_apbd_program_skpd where kdUnit='' order by idProgram";
$nRs = mysql_query($SQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$IdUnT = substr($mRo[1],5,7);
	$KdUnT = fGlobal("Kd_Unit","ref_unit","Kd_Unit_Link",$IdUnT,"=","","");
	if ($KdUnT!=""){
		#echo $KdUnT."<br>";
		$SW="update ta_apbd_program_skpd set kdUnit='".$KdUnT."' where IDT='".$mRo[0]."'";
		$rw = mysql_query($SW);
	}
}

$SQ="select IDT, idKegiatan from ta_apbd_kegiatan_skpd where kdUnit='' order by idKegiatan";
$nRs = mysql_query($SQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$IdUnT = substr($mRo[1],5,7);
	$KdUnT = fGlobal("Kd_Unit","ref_unit","Kd_Unit_Link",$IdUnT,"=","","");
	if ($KdUnT!=""){
		$SW="update ta_apbd_kegiatan_skpd set kdUnit='".$KdUnT."' where IDT='".$mRo[0]."'";
		$rw = mysql_query($SW);
	}
}

#$SW="update ta_apbd_kegiatan_skpd set apbd='0'";
#$rw = mysql_query($SW);
*/

#UpdateStart 23122017
#AddField("ref_unit","Nm_Unit_Link","varchar(200)","NULL","","Kd_Unit_Link","",DatabaseSB,$ConSB);

#$ScripT="CREATE TABLE `ta_apbd_kegiatan_skpd` (
#  `IDT` int(11) NOT NULL AUTO_INCREMENT,
#  `kdUnit` varchar(255) DEFAULT NULL,
#  `idKegiatan` varchar(20) NOT NULL DEFAULT '',
#  `idReferensi` varchar(13) DEFAULT '',
#  `nmKegiatan` varchar(500) DEFAULT '',
#  `periode` varchar(4) DEFAULT '',
#  `apbd` enum('0','1') DEFAULT NULL,
#  PRIMARY KEY (`IDT`),
#  KEY `Id_Referensi` (`idReferensi`),
#  KEY `Id_Urusan` (`idKegiatan`),
#  KEY `idKegiatan` (`idKegiatan`)
#) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC";

#$SQ ="DROP TABLE ta_apbd_kegiatan_skpd";
#$Rs = mysql_query($SQ);
#AddTable("ta_apbd_kegiatan_skpd",$ScripT,DatabaseSB,$ConSB);

#$ScripT="CREATE TABLE `ta_apbd_program_skpd` (
#  `IDT` int(11) NOT NULL AUTO_INCREMENT,
#  `kdUnit` varchar(255) DEFAULT NULL,
#  `idProgram` varchar(20) NOT NULL DEFAULT '',
#  `idReferensi` varchar(13) DEFAULT '',
#  `nmProgram` varchar(500) DEFAULT '',
#  `periode` varchar(4) DEFAULT '',
#  `apbd` enum('0','1') DEFAULT NULL,
#  PRIMARY KEY (`IDT`),
#  KEY `Id_Referensi` (`idReferensi`),
#  KEY `Id_Urusan` (`idProgram`),
#  KEY `idProgram` (`idProgram`)
#) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC";

#$SQ ="DROP TABLE ta_apbd_program_skpd";
#$Rs = mysql_query($SQ);
#AddTable("ta_apbd_program_skpd",$ScripT,DatabaseSB,$ConSB);

#$ScripT="CREATE TABLE `ta_apbd_rekening_skpd` (
#  `IDT` int(11) NOT NULL AUTO_INCREMENT,
#  `kdUnit` varchar(255) DEFAULT NULL,
#  `idKegiatan` varchar(20) NOT NULL DEFAULT '',
#  `kdRekening` varchar(13) DEFAULT '',
#  `nmRekening` varchar(500) DEFAULT '',
#  `periode` varchar(4) DEFAULT '',
#  `apbd` enum('0','1') DEFAULT NULL,
#  `fnJumlah` double(19,2) DEFAULT '0.00',
#  PRIMARY KEY (`IDT`),
#  KEY `Id_Referensi` (`kdRekening`),
#  KEY `Id_Urusan` (`idKegiatan`),
#  KEY `idKegiatan` (`idKegiatan`)
#) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC";

#$SQ ="DROP TABLE ta_apbd_rekening_skpd";
#$Rs = mysql_query($SQ);
#AddTable("ta_apbd_rekening_skpd",$ScripT,DatabaseSB,$ConSB);

/*
#server updated
ChangeNmOrLenghtField("ta_usulan_rinci","Nm_Aset","Nm_Aset","150","varchar","1000","",DatabaseSB,$ConSB);
ChangeNmOrLenghtField("ta_usulan_verifikasi_rinci","Nm_Aset","Nm_Aset","150","varchar","1000","",DatabaseSB,$ConSB);

$SQW="ALTER TABLE `ta_kib_a_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_kib_b_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_kib_c_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_kib_d_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_kib_e_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_kib_g_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$SQW="ALTER TABLE `ta_kib_post_mutasi` CHANGE COLUMN `Jns_Mutasi` `Jns_Mutasi` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

AddField("ta_kib_a","Ref_Mutasi","varchar(15)","NULL","","Ref_Group","",DatabaseSB,$ConSB);
AddField("ta_kib_a","Tgl_Mutasi","date","NULL","","Tgl_Perolehan","",DatabaseSB,$ConSB);

$SQW="ALTER TABLE `ta_usulan` CHANGE COLUMN `Jenis` `Jenis` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);
$SQW="ALTER TABLE `ta_usulan_verifikasi` CHANGE COLUMN `Jenis` `Jenis` enum('','RB','MS','MK','PL','LE','HB','KR','HL','PH','AR') COLLATE latin1_swedish_ci NULL DEFAULT ''";
$rW = mysql_query($SQW);

$CK = fGlobal("IDT","ref_usulan_jenis","Kode","AR","=","","");
if (!$CK){
	$SW = "INSERT INTO ref_usulan_jenis SET kode='AR', deskripsi='ASET RENOVASI'";
	$rW = mysql_query($SW);
}

$SW = "UPDATE ref_usulan_jenis SET Urut='1' WHERE Kode='RB'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='2' WHERE Kode='MS'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='3' WHERE Kode='MK'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='4' WHERE Kode='LE'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='5' WHERE Kode='HB'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='6' WHERE Kode='AR'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='7' WHERE Kode='KR'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='8' WHERE Kode='PL'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='9' WHERE Kode='HL'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='10' WHERE Kode='PH'";
$rW = mysql_query($SW);
*/
/*
ChangeNmOrLenghtField("ta_kib_c_merger_his","Nm_Aset","Nm_Aset","255","varchar","1000","",DatabaseSB,$ConSB);
ChangeNmOrLenghtField("ta_kib_c_merger_his","Beton","Beton","15","varchar","50","",DatabaseSB,$ConSB);

ChangeNmOrLenghtField("ta_kib_d_merger_his","Nm_Aset","Nm_Aset","150","varchar","1000","",DatabaseSB,$ConSB);
ChangeNmOrLenghtField("ta_kib_d_merger_his","Konstruksi","Konstruksi","20","varchar","100","",DatabaseSB,$ConSB);

$ScripT="CREATE TABLE `ta_kib_a_merger_his` (
  `IDT` int(11) NOT NULL AUTO_INCREMENT,
  `Referensi` varchar(15) DEFAULT '',
  `Ref_Group` varchar(15) DEFAULT '',
  `Ref_Mutasi` varchar(15) DEFAULT '',
  `Kd_UPB` varchar(18) DEFAULT '',
  `Kd_Aset` varchar(15) DEFAULT '',
  `Kd_Ruang` varchar(3) DEFAULT '000',
  `No_Register` varchar(7) DEFAULT '',
  `No_Pengadaan` varchar(23) DEFAULT '',
  `Ref_Temp` varchar(27) DEFAULT '',
  `Nm_Aset` varchar(1000) DEFAULT '',
  `Kd_Pemilik` varchar(2) DEFAULT '00',
  `Tgl_Perolehan` date DEFAULT NULL,
  `Luas_M2` double(11,2) DEFAULT '0.00',
  `Alamat` varchar(255) DEFAULT NULL,
  `Hak_Tanah` varchar(100) DEFAULT NULL,
  `Sertifikat` enum('Ada','Tidak Ada','Dalam Proses') NOT NULL DEFAULT 'Tidak Ada',
  `Sertifikat_Tanggal` date DEFAULT NULL,
  `Sertifikat_Nomor` varchar(225) DEFAULT NULL,
  `Penggunaan` varchar(225) DEFAULT NULL,
  `Asal_Usul` varchar(100) DEFAULT NULL,
  `Harga` double(19,2) DEFAULT '0.00',
  `Keterangan` text,
  `No_SP2D` varchar(50) DEFAULT NULL,
  `Post` enum('Y','N') DEFAULT 'N',
  `Status` varchar(20) DEFAULT '',
  `Recorded` datetime DEFAULT '0000-00-00 00:00:00',
  `Pencatat` varchar(100) DEFAULT NULL,
  `file_content` longblob,
  `file_name` varchar(100) DEFAULT '',
  `file_type` varchar(100) DEFAULT '',
  `file_size` int(11) DEFAULT '0',
  `extracom` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`IDT`),
  KEY `Kd_Aset` (`Kd_Aset`),
  KEY `Kd_UPB` (`Kd_UPB`),
  KEY `No_Register` (`No_Register`),
  KEY `Ref_Group` (`Ref_Group`),
  KEY `Referensi` (`Referensi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC";

$SQ ="DROP TABLE ta_kib_a_merger_his";
$Rs = mysql_query($SQ);
AddTable("ta_kib_a_merger_his",$ScripT,DatabaseSB,$ConSB);
*/
/*
$JalanKan1="NO";
if ($JalanKan1=="YA")
{
	$SQ="SELECT kd_aset, nm_aset FROM ref_rek_aset3 WHERE kd_aset LIKE '07.21%' ORDER BY kd_aset";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rKd = $mRo[0];
		$rNm = $mRo[1];
		#for ($i=22; $i<=26; $i++)
		for ($i=28; $i<=28; $i++)
		{
			$NewK = substr($rKd,0,2).".".substr("00".$i,-2,2).".".substr($rKd,-2,2);
			$CeK = fGlobal("IDT","ref_rek_aset3","kd_aset",$NewK,"=","","");
			if ($CeK=="")
			{
				$SW = "INSERT INTO ref_rek_aset3 SET kd_aset='$NewK', nm_aset='$rNm'";
				//echo $SW."<br>";
				$rW = mysql_query($SW);
			}
		}
	}
}

$JalanKan2="NO";
if ($JalanKan2=="YA")
{	
	$SQ="SELECT kd_aset, nm_aset FROM ref_rek_aset4 WHERE kd_aset LIKE '07.21%' ORDER BY kd_aset";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rKd = $mRo[0];
		$rNm = $mRo[1];
		#echo $rKd." : ".$rNm."<br>";
		#for ($i=22; $i<=26; $i++)
		for ($i=28; $i<=28; $i++)
		{
			$NewK = substr($rKd,0,2).".".substr("00".$i,-2,2).".".substr($rKd,-5,5);
			$CeK = fGlobal("IDT","ref_rek_aset4","kd_aset",$NewK,"=","","");
			if ($CeK=="")
			{
				$SW = "INSERT INTO ref_rek_aset4 SET kd_aset='$NewK', nm_aset='$rNm'";
				#echo $SW."<br>";
				$rW = mysql_query($SW);
			}
		}
	}
}

$JalanKan3="NO";
if ($JalanKan3=="YA")
{	
	$SQ="SELECT kd_aset, nm_aset, Link_Kib_AE FROM ref_rek_aset5 WHERE kd_aset LIKE '07.21%' ORDER BY kd_aset";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rKd = $mRo[0];
		$rNm = $mRo[1];
		$rLn = $mRo[2];
		//echo $rKd." : ".$rNm."<br>";
		#for ($i=22; $i<=26; $i++)
		for ($i=28; $i<=28; $i++)
		{
			$NewK = substr($rKd,0,2).".".substr("00".$i,-2,2).".".substr($rKd,-9,9);
			$CeK = fGlobal("IDT","ref_rek_aset5","kd_aset",$NewK,"=","","");
			if ($CeK=="")
			{
				$SW = "INSERT INTO ref_rek_aset5 SET kd_aset='$NewK', nm_aset='$rNm', Link_Kib_AE='$rLn'";
				//echo $SW."<br>";
				//$rW = mysql_query($SW);
			}
		}
	}
}

AddField("ta_kib_post","Ref_Usulan","varchar(17)","NULL","","Ref_Group","1",DatabaseSB,$ConSB);
AddField("ta_kib_post","Ref_History","varchar(17)","NULL","","Ref_Usulan","1",DatabaseSB,$ConSB);
AddField("ta_kib_post_mutasi","Ref_Usulan","varchar(17)","NULL","","Ref_Group","1",DatabaseSB,$ConSB);
AddField("ta_kib_post_mutasi","Ref_History","varchar(17)","NULL","","Ref_Usulan","1",DatabaseSB,$ConSB);
AddField("ref_usulan_jenis","Urut","int(4)","NULL","","","1",DatabaseSB,$ConSB);

$CK = fGlobal("IDT","ref_usulan_jenis","Kode","LE","=","","");
if (!$CK){
	$SW = "INSERT INTO ref_usulan_jenis SET kode='LE', deskripsi='LELANG'";
	$rW = mysql_query($SW);
}

$CK = fGlobal("IDT","ref_usulan_jenis","Kode","PL","=","","");
if (!$CK){
	$SW = "INSERT INTO ref_usulan_jenis SET kode='PL', deskripsi='DALAM PENELUSURAN'";
	$rW = mysql_query($SW);
}

$SW = "UPDATE ref_usulan_jenis SET Urut='1' WHERE Kode='RB'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='2' WHERE Kode='MS'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='3' WHERE Kode='MK'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='4' WHERE Kode='PL'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='5' WHERE Kode='LE'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='6' WHERE Kode='HB'";
$rW = mysql_query($SW);

$SW = "UPDATE ref_usulan_jenis SET Urut='7' WHERE Kode='PH'";
$rW = mysql_query($SW);

$SQ="ALTER TABLE ta_usulan_rinci DROP COLUMN `Nilai_Akhir`";
$nRs = mysql_query($SQ);

AddField("ta_usulan_rinci","Nilai_Akhir","double(19,2)","NULL","0","Harga","",DatabaseSB,$ConSB);
$SQ="SELECT IDT, Ref_Aset FROM ta_usulan_rinci ORDER BY IDT";
$nRs = mysql_query($SQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$rKey = $mRo[0];
	$NiL = fGlobal("ifNull(sum(debet-kredit),0)","ta_kib_post","Referensi",$mRo[1],"=","","");
	$SW = "UPDATE ta_usulan_rinci SET Nilai_Akhir='$NiL' WHERE IDT='".$rKey."'";
	$rW = mysql_query($SW);
}
ChangeNmOrLenghtField("ta_kib_a_mutasi","Nm_Aset","Nm_Aset","150","varchar","1000","",DatabaseSB,$ConSB);
ChangeNmOrLenghtField("ta_kib_b_mutasi","Nm_Aset","Nm_Aset","150","varchar","1000","",DatabaseSB,$ConSB);
ChangeNmOrLenghtField("ta_kib_c_mutasi","Nm_Aset","Nm_Aset","225","varchar","1000","",DatabaseSB,$ConSB);
ChangeNmOrLenghtField("ta_kib_d_mutasi","Nm_Aset","Nm_Aset","150","varchar","1000","",DatabaseSB,$ConSB);
ChangeNmOrLenghtField("ta_kib_e_mutasi","Nm_Aset","Nm_Aset","150","varchar","1000","",DatabaseSB,$ConSB);
ChangeNmOrLenghtField("ta_kib_g_mutasi","Nm_Aset","Nm_Aset","100","varchar","1000","",DatabaseSB,$ConSB);

AddField("ta_kib_c_merger_his","extracom","enum('Y','N')","NULL","N","","",DatabaseSB,$ConSB);
AddField("ta_kib_d_merger_his","Ref_Mutasi","varchar(15)","NULL","","Ref_Group","",DatabaseSB,$ConSB);
AddField("ta_kib_d_merger_his","Tgl_Mutasi","date","NULL","","Tgl_Perolehan","",DatabaseSB,$ConSB);
AddField("ta_kib_d_merger_his","Kd_Ruang","varchar(3)","NULL","","Kd_Aset","",DatabaseSB,$ConSB);
AddField("ta_kib_d_merger_his","extracom","enum('Y','N')","NULL","N","","",DatabaseSB,$ConSB);

$RepairExtraPost='YAxx';
if ($RepairExtraPost=='YA')
{
	$SQ="SELECT Referensi FROM ta_kib_b WHERE extracom='Y' ORDER BY referensi";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rKey = $mRo[0];
		$SW = "UPDATE ta_kib_post SET extracom='Y' WHERE Referensi='".$rKey."'";
		echo $SW."<br>";
		$rW = mysql_query($SW);
	}
	
	$SQ="SELECT Referensi FROM ta_kib_c WHERE extracom='Y' ORDER BY referensi";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rKey = $mRo[0];
		$SW = "UPDATE ta_kib_post SET extracom='Y' WHERE Referensi='".$rKey."'";
		echo $SW."<br>";
		$rW = mysql_query($SW);
	}
}

AddField("ref_rek_aset1","nilaiExtracom","double(11,2)","NULL","0","","",DatabaseSB,$ConSB);

AddField("ta_kib_b","extracom","enum('Y','N')","NULL","N","","",DatabaseSB,$ConSB);
AddField("ta_kib_c","extracom","enum('Y','N')","NULL","0","","",DatabaseSB,$ConSB);

$ScripT="CREATE TABLE `ta_kib_post_neraca` (
  `IDT` bigint(15) NOT NULL AUTO_INCREMENT,
  `Referensi` varchar(15) DEFAULT '',
  `Kd_UPB` varchar(18) DEFAULT '',
  `Kd_Aset` varchar(15) DEFAULT '',
  `Nm_Aset` varchar(255) DEFAULT NULL,
  `No_Register` varchar(10) DEFAULT '',
  `Tahun_Perolehan` varchar(4) DEFAULT '',
  `Nilai_Perolehan` double(19,2) DEFAULT '0.00' COMMENT 'Nilai perolehan awal',
  `Periode` varchar(4) NOT NULL DEFAULT '',
  `Nilai_Awal` double(19,2) DEFAULT '0.00' COMMENT 'Nilai awal periode',
  `Nilai_Atribusi` double(19,2) DEFAULT '0.00' COMMENT 'Atribusi periode berjalan',
  `Nilai_Aset` double(19,2) DEFAULT '0.00' COMMENT 'Nilai akhir aset setelah atribusi',
  `Beban_Tahun_Berjalan` double(19,2) DEFAULT '0.00' COMMENT 'Beban penyusutan periode berjalan',
  `Akumulasi_Penyusutan` double(19,2) DEFAULT '0.00' COMMENT 'Akumulasi beban penyusutan',
  `Nilai_Buku` double(19,2) DEFAULT '0.00' COMMENT 'Nilai akhir setelah penyusutan',
  `Pencatat` varchar(100) DEFAULT '',
  `Recorded` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`IDT`),
  KEY `Kd_Aset` (`Kd_Aset`),
  KEY `Kd_UPB` (`Kd_UPB`),
  KEY `Referensi` (`Referensi`),
  KEY `Tahun` (`Periode`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC
";

$SQ ="DROP TABLE ta_kib_post_neraca";
$Rs = mysql_query($SQ);
AddTable("ta_kib_post_neraca",$ScripT,DatabaseSB,$ConSB);

$ScripT="CREATE TABLE `ta_kib_g_pdf` (`IDT` int(11) NOT NULL AUTO_INCREMENT,`Referensi` varchar(15) NOT NULL DEFAULT '',`file_content` longblob,`file_name` varchar(100) 
DEFAULT '',`file_type` varchar(100) DEFAULT '',`file_size` int(11) DEFAULT '0',PRIMARY KEY (`IDT`),KEY `Referensi` (`Referensi`)) 
ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC";
AddTable("ta_kib_g_pdf",$ScripT,DatabaseSB,$ConSB);

#$SQ ="UPDATE ta_kib_b set Kd_Ruang='001' where Kd_Ruang=''";
#$Rs = mysql_query($SQ);

AddField("ref_unit","Hp_Pimpinan","varchar(100)","NULL","","","",DatabaseSB,$ConSB);
AddField("ref_unit","Pin_Pimpinan","varchar(100)","NULL","","","",DatabaseSB,$ConSB);
AddField("ref_unit","Ema_Pimpinan","varchar(100)","NULL","","","",DatabaseSB,$ConSB);

AddField("ref_unit","Nm_Pengurus","varchar(100)","NULL","","","",DatabaseSB,$ConSB);
AddField("ref_unit","Nip_Pengurus","varchar(25)","NULL","","","",DatabaseSB,$ConSB);
AddField("ref_unit","Jbt_Pengurus","varchar(100)","NULL","","","",DatabaseSB,$ConSB);
AddField("ref_unit","Hp_Pengurus","varchar(50)","NULL","","","",DatabaseSB,$ConSB);
AddField("ref_unit","Pin_Pengurus","varchar(20)","NULL","","","",DatabaseSB,$ConSB);
AddField("ref_unit","Ema_Pengurus","varchar(50)","NULL","","","",DatabaseSB,$ConSB);

AddField("ref_unit","Nm_Penyimpan","varchar(100)","NULL","","","",DatabaseSB,$ConSB);
AddField("ref_unit","Nip_Penyimpan","varchar(25)","NULL","","","",DatabaseSB,$ConSB);
AddField("ref_unit","Jbt_Penyimpan","varchar(100)","NULL","","","",DatabaseSB,$ConSB);
AddField("ref_unit","Hp_Penyimpan","varchar(50)","NULL","","","",DatabaseSB,$ConSB);
AddField("ref_unit","Pin_Penyimpan","varchar(20)","NULL","","","",DatabaseSB,$ConSB);
AddField("ref_unit","Ema_Penyimpan","varchar(50)","NULL","","","",DatabaseSB,$ConSB);
*/
/*
ChangeNmOrLenghtField("ta_kib_g","Nm_Aset","Nm_Aset","100","varchar","1000","",DatabaseSB,$ConSB);
$RepairKdRuang='YAx';
if ($RepairKdRuang=='YA')
{
	$SQ="SELECT IDT, bp_kode,unit_kode,sunit_kode,ssunit_kode, Kd_Ruang FROM ref_ruangan ORDER BY IDT LIMIT 0,5000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$mR1 = substr("00".$mRo[1],-2,2);
		$mR2 = substr("00".$mRo[2],-2,2);
		$mR3 = substr("00".$mRo[3],-2,2);
		$mR4 = substr("000".$mRo[4],-3,3);
		$mR5 = substr("000".$mRo[5],-3,3);
		
		$KdNew= "24.04.".$mR1.".".$mR2.".".$mR3.".".$mR4;
		$KdNeR= $mR5;
		
		echo $KdNew."<br>";
		$SW = "UPDATE ref_ruangan SET Kd_UPB='".$KdNew."', Kd_Ruang ='$KdNeR' WHERE IDT='".$IdT."'";
		echo $SW."<br>";
		$rW = mysql_query($SW);
	}
}

$RepairKdAsetD='YAX';
if ($RepairKdAsetD=='YA')
{
	$SQ="SELECT IDT, gb_kode,bid_kode,kel_kode,subkel_kode,subsub_kode FROM kib_data_asal_d WHERE KD_ASET='' ORDER BY IDT LIMIT 0,5000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$mR1 = substr("00".$mRo[1],-2,2);
		$mR2 = substr("00".$mRo[2],-2,2);
		$mR3 = substr("00".$mRo[3],-2,2);
		$mR4 = substr("00".$mRo[4],-2,2);
		$mR5 = substr("000".$mRo[5],-3,3);
		
		$KdNew= $mR1.".".$mR2.".".$mR3.".".$mR4.".".$mR5;
		echo $KdNew."<br>";
		$SW = "UPDATE kib_data_asal_d SET KD_ASET='".$KdNew."' WHERE IDT='".$IdT."'";
		echo $SW."<br>";
		$rW = mysql_query($SW);
	}
}

$RepairKdUnitD='YAX';
if ($RepairKdUnitD=='YA')
{
	$SQ="UPDATE kib_data_asal_d SET KD_UNIT=''";
	$nRs = mysql_query($SQ);
	
	$SQ="SELECT IDT, bp_kode,unit_kode,sunit_kode,ssunit_kode FROM kib_data_asal_d WHERE KD_UNIT='' ORDER BY IDT LIMIT 0,5000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$mR1 = substr("00".str_replace(".","",$mRo[1]),-2,2);
		$mR2 = substr("00".str_replace(".","",$mRo[2]),-2,2);
		$mR3 = "00";
		$mR4 = "000";
		
		$KdNew= "24.04.".$mR1.".".$mR2.".".$mR3.".".$mR4;
		echo $KdNew."<br>";
		$SW = "UPDATE kib_data_asal_d SET KD_UNIT='".$KdNew."' WHERE IDT='".$IdT."'";
		echo $SW."<br>";
		$rW = mysql_query($SW);
	}
}

$RepairKdAset='YAok';
if ($RepairKdAset=='YA')
{
	$SQ="SELECT ID, gb_kode,bid_kode,kel_kode,subkel_kode,subsub_kode FROM kib_data_asal WHERE KD_ASET='' ORDER BY ID LIMIT 0,5000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$mR1 = $mRo[1];
		$mR2 = $mRo[2];
		$mR3 = $mRo[3];
		$mR4 = $mRo[4];
		$mR5 = substr("000".$mRo[5],-3,3);
		
		$KdNew= $mR1.".".$mR2.".".$mR3.".".$mR4.".".$mR5;
		
		$SW = "UPDATE kib_data_asal SET KD_ASET='".$KdNew."' WHERE ID='".$IdT."'";
		echo $SW."<br>";
		$rW = mysql_query($SW);
	}
}

$RepairKdUnit='YAok';
if ($RepairKdUnit=='YA')
{
	$SQ="SELECT ID, bp_kode,unit_kode,sunit_kode,ssunit_kode FROM kib_data_asal WHERE KD_UNIT='' ORDER BY ID LIMIT 0,5000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$mR1 = $mRo[1];
		$mR2 = $mRo[2];
		$mR3 = $mRo[3];
		$mR4 = $mRo[4];
		
		$KdNew= "24.04.".$mR1.".".$mR2.".".$mR3.".".$mR4;
		
		$SW = "UPDATE kib_data_asal SET KD_UNIT='".$KdNew."' WHERE ID='".$IdT."'";
		echo $SW."<br>";
		$rW = mysql_query($SW);
	}
}

$RepairSsunit1='YAok';
if ($RepairSsunit1=='YA')
{
	$SQ="SELECT ID FROM kib_data_asal WHERE isnull(ssunit_kode) ORDER BY ID LIMIT 0,5000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$suNew = "000";
		
		$SW = "UPDATE kib_data_asal SET ssunit_kode='".$suNew."' WHERE ID='".$IdT."'";
		echo $SW."<br>";
		$rW = mysql_query($SW);
	}
}

$RepairSsunit2='YAok';
if ($RepairSsunit2=='YA')
{
	$SQ="SELECT ID, ssunit_kode FROM kib_data_asal WHERE ssunit_kode LIKE '__' ORDER BY ID LIMIT 0,5000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$ssu = $mRo[1];
		
		$suNew = substr("0".$ssu,-3,3);
		
		$SW = "UPDATE kib_data_asal SET ssunit_kode='".$suNew."' WHERE ID='".$IdT."'";
		echo $SW."<br>";
		$rW = mysql_query($SW);
	}
}

$RepairSunit='YAx';
if ($RepairSunit=='YA')
{
	$SQ="SELECT ID, sunit_kode FROM kib_data_asal WHERE isnull(sunit_kode) ORDER BY ID LIMIT 0,5000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$ssu = $mRo[1];
		
		$suNew = substr("00".$ssu,-2,2);
		
		$SW = "UPDATE kib_data_asal SET sunit_kode='".$suNew."' WHERE ID='".$IdT."'";
		echo $SW."<br>";
		$rW = mysql_query($SW);
	}
}

$RepairBpKode='YAx';
if ($RepairBpKode=='YA')
{
	$SQ="SELECT ID, gb_kode FROM kib_data_asal WHERE gb_kode LIKE '_' ORDER BY ID LIMIT 0,5000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$gbk = $mRo[1];
		
		$gbkNew = substr("0".$gbk,-2,2);
		
		$SW = "UPDATE kib_data_asal SET gb_kode='".$gbkNew."' WHERE ID='".$IdT."'";
		echo $SW."<br>";
		$rW = mysql_query($SW);
	}
}
############################
$RepairSunit='YAx';
if ($RepairSunit=='YA')
{
	$SQ="SELECT IDT, bp_kode,unit_kode,sunit_kode,sunit_nama FROM ref_sub_unit ORDER BY IDT";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$bdg = $mRo[1];
		$unt = $mRo[2];
		$sub = $mRo[3];
		$New = "24.04.".substr("0".$bdg,-2,2).".".substr("0".$unt,-2,2).".".substr("0".$sub,-2,2);
		
		$SW = "UPDATE ref_sub_unit SET Kd_Sub='".$New."' WHERE IDT='".$IdT."'";
		echo $SW."<br>";
		$rW = mysql_query($SW);
	}
}

$RepairSupb='YAx';
if ($RepairSupb=='YA')
{
	$SQ="SELECT IDT, bp_kode,unit_kode,sunit_kode,ssunit_kode FROM ref_upb ORDER BY IDT";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$bdg = $mRo[1];
		$unt = $mRo[2];
		$sub = $mRo[3];
		$upb = $mRo[4];
		$New = "24.04.".substr("0".$bdg,-2,2).".".substr("0".$unt,-2,2).".".substr("0".$sub,-2,2).".".substr("00".$upb,-3,3);
		
		$SW = "UPDATE ref_upb SET Kd_UPB='".$New."' WHERE IDT='".$IdT."'";
		echo $SW."<br>";
		$rW = mysql_query($SW);
	}
}

$RepairTanggal='YA_';
if ($RepairTanggal=='YA')
{
	$rG=1;
	$SQ="SELECT IDT, Referensi, Dokumen_Tanggal FROM ta_kib_d WHERE Kd_UPB LIKE '24.04.05.01%' AND Tgl_Perolehan LIKE '2015%' ORDER BY IDT";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$Erp = $mRo[1];
		$TgP = $mRo[2];
		$SW = "UPDATE ta_kib_d SET Tgl_Perolehan='".$TgP."' WHERE IDT='".$IdT."'";
		$rW = mysql_query($SW);
		
		$SW = "UPDATE ta_kib_post SET Tanggal='".$TgP."' WHERE Referensi='".$Erp."'";
		$rW = mysql_query($SW);
		$rG++;
	}
}

$RepairMasaManfaat='YAx';
if ($RepairMasaManfaat=='YA')
{
	$SQ="SELECT Kd_Aset from ta_kib_b WHERE Masa_Manfaat='0' GROUP BY Kd_Aset";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mR = $mRo[0];
		$Mm = findMasaManfaat($mR,DatabaseSB,$ConSB);
		
		$SW = "UPDATE ta_kib_b SET Masa_Manfaat='".$Mm."' WHERE Kd_Aset='".$mR."' AND Masa_Manfaat='0'";
		//echo $SW."<br>";
		$rW = mysql_query($SW);
	}
	
	echo "<br>";
	$SQ="SELECT Kd_Aset from ta_kib_c WHERE Masa_Manfaat='0' GROUP BY Kd_Aset";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mR = $mRo[0];
		$Mm = findMasaManfaat($mR,DatabaseSB,$ConSB);
		
		$SW = "UPDATE ta_kib_c SET Masa_Manfaat='".$Mm."' WHERE Kd_Aset='".$mR."' AND Masa_Manfaat='0'";
		//echo $SW."<br>";
		$rW = mysql_query($SW);
	}
	
	echo "<br>";
	$SQ="SELECT Kd_Aset from ta_kib_d WHERE Masa_Manfaat='0' GROUP BY Kd_Aset";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mR = $mRo[0];
		$Mm = findMasaManfaat($mR,DatabaseSB,$ConSB);
		
		$SW = "UPDATE ta_kib_d SET Masa_Manfaat='".$Mm."' WHERE Kd_Aset='".$mR."' AND Masa_Manfaat='0'";
		//echo $SW."<br>";
		$rW = mysql_query($SW);
	}
	
	echo "<br>";
	$SQ="SELECT Kd_Aset from ta_kib_e WHERE Masa_Manfaat='0' GROUP BY Kd_Aset";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mR = $mRo[0];
		$Mm = findMasaManfaat($mR,DatabaseSB,$ConSB);
		
		$SW = "UPDATE ta_kib_e SET Masa_Manfaat='".$Mm."' WHERE Kd_Aset='".$mR."' AND Masa_Manfaat='0'";
		//echo $SW."<br>";
		$rW = mysql_query($SW);
	}
}
*/
$CopyMsManfaatAsLainnya="YAxx";
if ($CopyMsManfaatAsLainnya=="YA")
{
	for ($e=3; $e<=5; $e++)
	{
		$SQW = "SELECT kd_aset, ms_manfaat FROM ref_rek_aset".$e." WHERE Kd_Aset LIKE '07.21%' AND Ms_Manfaat<>'0' ORDER BY kd_aset";
		$nRs = mysql_query($SQW);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$rKd = $mRo[0];
			$rMs = $mRo[1];
			
			for ($i=22; $i<=28; $i++)
			{
				if ($i!=27)
				{
					$LeN = strlen($rKd);
					if ($LeN==8){
						$NewK = substr($rKd,0,2).".".substr("00".$i,-2,2).".".substr($rKd,-2,2);
					}
					else if ($LeN==11){
						$NewK = substr($rKd,0,2).".".substr("00".$i,-2,2).".".substr($rKd,-5,5);
					}
					else if ($LeN==15){
						$NewK = substr($rKd,0,2).".".substr("00".$i,-2,2).".".substr($rKd,-9,9);
					}
					
					$CeK = fGlobal("IDT","ref_rek_aset".$e,"kd_aset",$NewK,"=","","");
					if ($CeK!="")
					{
						$SW = "UPDATE ref_rek_aset".$e." SET ms_manfaat='$rMs' WHERE IDT='$CeK'";
						$rW = mysql_query($SW);
						
						CopyDataMsaManfaat($rKd,$NewK);
					}
				}
			}
		}
	}
}

function CopyDataMsaManfaat($rKd,$NewK)
{
	$SW = "delete from ta_masa_manfaat WHERE Kode='$NewK'";
	$rW = mysql_query($SW);
	
	$SW = "SELECT tA,tB,tUmur FROM ta_masa_manfaat WHERE Kode ='$rKd' ORDER BY IDT";
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$SWe = "INSERT INTO ta_masa_manfaat SET 
		Kode='".$NewK."',
		tA='".$mR[0]."',
		tB='".$mR[1]."',
		tUmur='".$mR[2]."'";
		$rWe = mysql_query($SWe);
	}
}

$CekDoubleDataRK="YAx";
if ($CekDoubleDataRK=="YA")
{
	$SW = "SELECT Kd_Aset, count(*) as JmR FROM ref_rek_aset5 WHERE Kd_Aset LIKE '07.%' GROUP BY Kd_Aset ORDER BY JmR DESC limit 0,3000";
	$nR = mysql_query($SW);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$mR0 = $mR[0];
		$mR1 = $mR[1];
		if ($mR1 > 1)
		{
			$IdT = fGlobal("IDT","ref_rek_aset5","Kd_Aset:Ms_Manfaat",$mR0.":0","=:>","IDT LIMIT 0,1","adf");
			if ($IdT==""){
				$IdT = fGlobal("IDT","ref_rek_aset5","Kd_Aset",$mR0,"=","IDT LIMIT 0,1","adf");
			}
			//echo $IdT." : ";
			if ($IdT){
				$SWe = "DELETE FROM ref_rek_aset5 WHERE Kd_Aset='".$mR0."' AND IDT<>'".$IdT."'";
				echo $SWe."<br>";
				$nRe = mysql_query($SWe);
			}
		}
	}
}

function functionNewKdsub($mR0)
{
	$NewKd = fGlobal("max(Kd_Aset)","ref_rek_aset108_6","Kd_Aset",$mR0."%","LIKE","","");
	if ($NewKd!="")
	{
		$NewKd = ((int)substr($NewKd,-2,2))+1;
	}
	else{
		$NewKd = 1;
	}
	$NewKd = $mR0.".".substr('00'.$NewKd,-2,2);
	return $NewKd;
}

function functionNewKdsubsub($mR0)
{
	$NewKd = fGlobal("max(Kd_Aset)","ref_rek_aset108_7","Kd_Aset",$mR0."%","LIKE","","");
	if ($NewKd!="")
	{
		$NewKd = ((int)substr($NewKd,-3,3))+1;
	}
	else{
		$NewKd = 1;
	}
	$NewKd = $mR0.".".substr('000'.$NewKd,-3,3);
	return $NewKd;
}

function callImportAtribusi_CDE($TBL,$ReG,$Ref,$KdAset,$KdUPB,$Dipla,$Exec)
{
	$iiG=1;
	$rSW = "SELECT 
	Tgl_Perolehan as A0, 
	Harga_Bertambah as A1,
	Keterangan as A2,
	Asal_Usul as A3,
	Nomor_Sp2d as A4,
	Nomor_Kontrak as A5 
	
	FROM $TBL WHERE kode_skpd='".substr($KdUPB,0,11)."' AND register_new = '".$ReG."' ORDER BY tahun_anggaran, harga_bertambah DESC";
	if ($Dipla=='Ya') {echo $rSW."<br>";}
	$rnR = mysql_query($rSW);
	while ($rmR = mysql_fetch_array($rnR, MYSQL_BOTH))
	{
		if ($iiG==1)
		{
			$SQD = "UPDATE ta_kib_108 SET Harga='".$rmR[1]."' WHERE Referensi='".$Ref."' AND Kd_UPB='".$KdUPB."'";
			if ($Dipla=='Ya') {echo $SQD."<br>";}
			if ($Exec=='Ya') {$snR = mysql_query($SQD);}
			
			$SQD = "UPDATE ta_kib_post_108 SET Debet='".$rmR[1]."' WHERE Referensi='".$Ref."' AND Kd_UPB='".$KdUPB."'";
			if ($Dipla=='Ya') {echo $SQD."<br>";}
			if ($Exec=='Ya') {$snR = mysql_query($SQD);}
		}
		else
		{
			$SQD = "INSERT INTO ta_kib_post_108 SET 
			Referensi='".$Ref."',
			Kd_UPB='".$KdUPB."',
			Kd_Aset_108='".$KdAset."',
			No_Register='".$ReG."',
			Crit='INV',
			Tanggal='".$rmR[0]."',
			Uraian='".$rmR[2]."',
			Debet='".$rmR[1]."',
			No_Pengadaan='".$rmR[5]."',
			Keterangan='".$rmR[3]."',
			Pencatat='creator-ImpATR',
			Recorded=now(),
			Tmbh_Ms_Manfaat='YA',
			No_SP2D='".$rmR[4]."'";
			if ($Dipla=='Ya') {echo $SQD."<br>";}
			if ($Exec =='Ya') {$snR = mysql_query($SQD);}
		}
		if ($Exec=='Ya') {echo "UPDATE ".$Ref." done....!!<br>";}
		$iiG++;
	}
	echo "<br>";
}

function callImportAtribusi_B($TBL,$ReG,$Ref,$KdAset,$KdUPB,$TglP,$Dipla,$Exec)
{
	$iiG=1;
	$rSW = "SELECT 
	'' as A0, 
	Harga_Bertambah as A1,
	Nama_Barang as A2,
	Nama_Barang as A3,
	'' as A4,
	'' as A5 
	
	FROM $TBL WHERE kode_skpd='".substr($KdUPB,0,11)."' AND register_new = '".$ReG."' ORDER BY harga_bertambah DESC";
	if ($Dipla=='Ya') {echo $rSW."<br>";}
	$rnR = mysql_query($rSW);
	while ($rmR = mysql_fetch_array($rnR, MYSQL_BOTH))
	{
		if ($iiG==1)
		{
			$SQD = "UPDATE ta_kib_108 SET Harga='".$rmR[1]."' WHERE Referensi='".$Ref."' AND Kd_UPB='".$KdUPB."'";
			if ($Dipla=='Ya') {echo $SQD."<br>";}
			if ($Exec=='Ya') {$snR = mysql_query($SQD);}
			
			$SQD = "UPDATE ta_kib_post_108 SET Debet='".$rmR[1]."' WHERE Referensi='".$Ref."' AND Kd_UPB='".$KdUPB."'";
			if ($Dipla=='Ya') {echo $SQD."<br>";}
			if ($Exec=='Ya') {$snR = mysql_query($SQD);}
		}
		else
		{
			$SQD = "INSERT INTO ta_kib_post_108 SET 
			Referensi='".$Ref."',
			Kd_UPB='".$KdUPB."',
			Kd_Aset_108='".$KdAset."',
			No_Register='".$ReG."',
			Crit='INV',
			Tanggal='".$TglP."',
			Uraian='".$rmR[2]."',
			Debet='".$rmR[1]."',
			No_Pengadaan='".$rmR[5]."',
			Keterangan='".$rmR[3]."',
			Pencatat='creator-ImpATR',
			Recorded=now(),
			Tmbh_Ms_Manfaat='YA',
			No_SP2D='".$rmR[4]."'";
			if ($Dipla=='Ya') {echo $SQD."<br>";}
			if ($Exec =='Ya') {$snR = mysql_query($SQD);}
		}
		if ($Exec=='Ya') {echo "UPDATE ".$Ref." done....!!<br>";}
		$iiG++;
	}
	echo "<br>";
}
?>