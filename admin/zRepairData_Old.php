<?php
require "CheckLogin.php";

$RepairMsMf 		= "YAx";
$RepairOverHaul 	= "YAx";
$RepairMsManfaat	= "YAx";
$RepairPNG			= "YAx";
$Repair07			= "YAx";
$Repair108KOSOSNG	= "YA_xxxxxxxxxxxxxxxxxxxxxxxx";
$RepairBNG			= "YAx";
$CopyRek			= "YAx";
$ClearRek			= "YAx";
$NilaiAKHIE			= "YAx";
$NilaiAKHIR			= "YAx";
$Repair_simbada_barsel_data_print_ke2_03052018_2231="YAxx";
$JalanSTU		= "YAxx";
$JalanDELL		= "YAxxx";
$JalanReAT		= "YAx";
$JalanMOHO		= "YAxx";
$ResetEXTRACOM	= "YAxxx";
$RepairMelaluiDokRekapMutasi="YAxxx";
$JalanNILB	= "YAxxxx";
$JalanNILA	= "YAxxx";
$JalanAUPB	= "YAxxxx";
$JalanASTO	= "YAxxx";
$JalanMTS	= "YAxxxxxxxx";	#NoDelete AutoRepair->blm dipake diserver
$CopyRek108_45 ="YAxx";
$CopyRek108_6 ="YAxx";
$CopyRek108_7 ="YAxx";

$RepairAtribusiSKPDC ="YAxx";
$RepairAtribusiSKPDD ="YAxx";
$RepairAtribusiSKPDB ="YAxx";
$RepairAtribusiSKPDE ="YAxx";

$RepairAtribusiRegisterC ="YAxx";
$RepairAtribusiRegisterD ="YAxx";
$RepairAtribusiRegisterB ="YAxx";
$RepairAtribusiRegisterE ="YAxxxxx";
$RepairTglPerolehanC ="YAxx";
$RepairTglPerolehanD ="YAxx";
$RepairTglPerolehanE ="YAxx";
$RepairLAINLAIN="YAx";
$RepairLAINLAINATL="YAxx";
$InsertTahun26082021="YAx";
$PIndahKIB_BkeC="YAxx";
$PIndahKIB_BkeE="YAxx";
$UpdateSkpdPenyusutan="YAxxx";
$UpdateUPB="YAXX";
$UpdateUPBpost="YAXXXXX";
$UpdateRekMap90="YAxx";

$CopyMasaManfaatLAINLAIN="YAxx";

if ($UpdateRekMap90=="YA" && $UID =="creator")
{
	$SQA = "select left(kdRekening,15) from ta_apbd_rekening_skpd group by left(kdRekening,15)";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$ReK13 = $mRo[0];
		$ReK90 = fGlobal("Kd_Rek_90","ref_rek_90_6_mapping_13","Kd_Rek_13",$mRo[0],"=","","s");
		
		if ($ReK90)
		{
			$NmK90 = fGlobal("Nm_Rek","ref_rek_90_6","Kd_Rek",$ReK90,"=","","");
			
			$SQ = "UPDATE ta_apbd_rekening_skpd SET kdRekening90='".$ReK90."', nmRekening90='".$NmK90."' WHERE kdRekening LIKE '".$ReK13."%'";
			echo $SQ."<br>";
			$nR = mysql_query($SQ);
		}
		#echo $ReK13." : ".$ReK90."->".$NmK90."<br>";
	}
}


if ($UpdateUPBpost=="YA" && $UID =="creator")
{
	$iG=1;
	$SQA = "select IDT, referensi, ref_usulan from ta_kib_post_108 WHERE kd_upb='' order by IDT";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$UpR = fGlobal("To_UPB","ta_usulan_rinci_108","referensi:ref_aset",$mRo[2].":".$mRo[1],"=:=","IDT DESC","s");
		echo $iG.". ".$mRo[0]." : ".$mRo[1]." : ".$mRo[2]." : ".$UpR."<br>";
		
		$SQ = "UPDATE ta_kib_post_108 SET Kd_UPB='".$UpR."' WHERE IDT='".$mRo[0]."'";
		echo $SQ."<br>";
		$nR = mysql_query($SQ);
		
		$iG++;
	}
}

if ($UpdateUPB=="YA" && $UID =="creator")
{
	$iG=1;
	$SQA = "select IDT, referensi, ref_usulan from ta_kib_108 where kd_upb='' order by IDT";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$UpR = fGlobal("To_UPB","ta_usulan_rinci_108","referensi:ref_aset",$mRo[2].":".$mRo[1],"=:=","IDT DESC","s");
		echo $iG.". ".$mRo[1]." : ".$mRo[2]." : ".$UpR."<br>";
		
		$SQ = "UPDATE ta_kib_108 SET Kd_UPB='".$UpR."' WHERE IDT='".$mRo[0]."'";
		echo $SQ."<br>";
		$nR = mysql_query($SQ);
		
		$iG++;
	}
}

if ($UpdateSkpdPenyusutan=="YA" && $UID =="creator")
{
	$SQA = "SELECT Referensi, Kd_UPB FROM ta_kib_108 WHERE Kd_UPB LIKE '24.04.04.01.02%' GROUP BY Referensi";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$SQ = "UPDATE ta_kib_post_penyusutan_108 SET Kd_UPB='".$mRo[1]."' WHERE Referensi='".$mRo[0]."' AND Kd_UPB <> '".$mRo[1]."'";
		echo $SQ."<br>";
		$nR = mysql_query($SQ);
	}
}



if ($CopyMasaManfaatLAINLAIN=="YA" && $UID =="creator")
{
	$KdR = '1.5.4.01';
	$KdR = '1.5.4.02';
	$KdR = '1.5.4.03';
	$KdR = '1.5.4.04';
	$KdR = '1.5.4.05';
	$KdR = '1.5.4.06';
	
	$SQA = "SELECT IDT, kd_aset, link_kib_ae FROM ref_rek_aset108_7 WHERE kd_aset LIKE '".$KdR.".%' AND kd_aset NOT LIKE '".$KdR.".01%' AND CopyOverHaul='N' ORDER BY IDT LIMIT 0,5000";
	echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$MsM = fGlobal("ms_manfaat","ref_rek_aset108_7","kd_aset",$mRo[2],"=","","");
		
		#Overhaul
		$SQ = "DELETE FROM ta_masa_manfaat_108 WHERE kode='".$mRo[1]."'";
		echo $SQ."<br>";
		$nR = mysql_query($SQ);
		
		$SQ = "SELECT tA, tB, tUmur FROM ta_masa_manfaat_108 WHERE kode='".$mRo[2]."' ORDER BY IDT";
		echo $SQ."<br>";
		$nR = mysql_query($SQ);
		while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
		{
			$SA = "INSERT INTO ta_masa_manfaat_108 SET 
			kode='".$mRo[1]."',
			tA='".$mR[0]."',
			tB='".$mR[1]."',
			tUmur='".$mR[2]."'";
			echo $SA."<br>";
			$nA = mysql_query($SA);
			
		}
		
		$SQ = "UPDATE ref_rek_aset108_7 SET ms_manfaat='".$MsM."', CopyOverHaul='Y' WHERE IDT='".$mRo[0]."'";
		echo $SQ."<br>";
		$nR = mysql_query($SQ);
	}
}

if ($PIndahKIB_BkeE=="YA" && $UID =="creator")
{
	$iG=1;
	$SQA = "SELECT referensi, kd_upb, no_register FROM ta_kib_108 WHERE kd_upb LIKE '24.04.08.01.%' AND referensi LIKE 'ALT%' AND extracom='Y' AND nm_aset LIKE 'Keprek (rawis)'
	ORDER BY Kd_Aset_108, No_Register";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		#echo $iG.". ".$mRo[0]."<br>";
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","referensi","ATL%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","referensi","ATL%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		$NewK = $NewK + 1;
		$NewRefKIB = "ATL.".fMakeReferensi($NewK,11);
		
		$SW = "UPDATE ta_kib_108 SET referensi='".$NewRefKIB."', Kd_Aset_108='1.3.5.01.01.01.014', Pencatat='RepairKibBkeE' 
		WHERE referensi='".$mRo[0]."' AND kd_upb='".$mRo[1]."' AND no_register='".$mRo[2]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
		
		$SW = "UPDATE ta_kib_post_108 SET referensi='".$NewRefKIB."', Kd_Aset_108='1.3.5.01.01.01.014', Pencatat='RepairKibBkeE' 
		WHERE referensi='".$mRo[0]."' AND kd_upb='".$mRo[1]."' AND no_register='".$mRo[2]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
		
		$iG++;
	}
}

if ($PIndahKIB_BkeC=="YA" && $UID =="creator")
{
	$iG=1;
	$SQA = "SELECT referensi, kd_upb, no_register FROM ta_kib_108 WHERE kd_upb LIKE '24.04.06.01.%' AND referensi LIKE 'ALT%' AND extracom='Y' 
	AND no_register<>'0071100' 
	AND no_register<>'0071112' 
	AND no_register<>'0087808' 
	AND no_register<>'0087809' 
	AND no_register<>'0087810' 
	AND no_register<>'0087811' 
	
	ORDER BY Kd_Aset_108, No_Register";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		#echo $iG.". ".$mRo[0]."<br>";
		
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi","BNG%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi","BNG%","LIKE","","");
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi","BNG%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		$NewRefKIB = "BNG.".fMakeReferensi($NewK,11);
		
		$SW = "UPDATE ta_kib_108 SET referensi='".$NewRefKIB."', Kd_Aset_108='1.3.3.03.01.05.001', Pencatat='RepairKibBkeC' 
		WHERE referensi='".$mRo[0]."' AND kd_upb='".$mRo[1]."' AND no_register='".$mRo[2]."'";
		echo $SW."<br>";
		#$ns = mysql_query($SW);
		
		$SW = "UPDATE ta_kib_post_108 SET referensi='".$NewRefKIB."', Kd_Aset_108='1.3.3.03.01.05.001', Pencatat='RepairKibBkeC' 
		WHERE referensi='".$mRo[0]."' AND kd_upb='".$mRo[1]."' AND no_register='".$mRo[2]."'";
		echo $SW."<br>";
		#$ns = mysql_query($SW);
		
		$iG++;
	}
}

if ($InsertTahun26082021=="YA" && $UID =="creator")
{
	$SQA = "SELECT IDT, KD_SKPD, LREF, REGISTERNEW FROM z_pengadaan_26agustus2021 ORDER BY REGISTERNEW";
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
			$SW = "UPDATE z_pengadaan_26agustus2021 SET 
			KE_REFERENSI='".$DT[0]."',
			KE_KODE='".$DT[1]."',
			KE_UPB='".$DT[2]."' 
			WHERE IDT='".$Idt."'";
			echo $SW."<br>";
			$ns = mysql_query($SW);
		}
	}
	/*
	$SQA = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$SW = "UPDATE z_pengadaan_26agustus2021 SET KD_SKPD='".$mRo[0]."', KD_UPB='".$mRo[0].".01.001' WHERE SKPD='".$mRo[1]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
	*/
}

if ($RepairLAINLAINATL=="YA" && $UID =="creator")
{
	/*
	$SQA = "SELECT IDT, KODE_108MAP, '1.5.4.01' FROM asetlainlainatl ORDER BY IDT";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$KdMap = fGlobal("Kd_Aset","ref_rek_aset108_7_barsel","Link_Kib_AE:Kd_Aset",$mRo[1].":".$mRo[2]."%","=:LIKE","","");
		
		$SW = "UPDATE asetlainlainatl SET KODE_108MAPLAIN='".$KdMap."' WHERE IDT='".$mRo[0]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
	*/
	/*
	$SQA = "SELECT IDT, KODENEW FROM asetlainlainatl ORDER BY IDT";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$KdMap = fGlobal("Kd_Aset108","ref_rek_aset5_maping","Kd_Aset17",$mRo[1],"=","","");
		$SW = "UPDATE asetlainlainatl SET KODE_108MAP='".$KdMap."' WHERE IDT='".$mRo[0]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
	*/
}

if ($RepairLAINLAIN=="YA" && $UID =="creator")
{
	/*
	$SQA = "SELECT IDT, KODE_108MAP, KEADAAN_REK FROM asetlainlaingabung ORDER BY IDT";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$KdMap = fGlobal("Kd_Aset","ref_rek_aset108_7_barsel","Link_Kib_AE:Kd_Aset",$mRo[1].":".$mRo[2]."%","=:LIKE","","");
		
		$SW = "UPDATE asetlainlaingabung SET KODE_108MAPLAIN='".$KdMap."' WHERE IDT='".$mRo[0]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
	*/
	/*
	$SQA = "SELECT IDT, KODENEW FROM asetlainlaingabung ORDER BY IDT";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$KdMap = fGlobal("Kd_Aset108","ref_rek_aset5_maping","Kd_Aset17",$mRo[1],"=","","");
		$SW = "UPDATE asetlainlaingabung SET KODE_108MAP='".$KdMap."' WHERE IDT='".$mRo[0]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
	*/
	/*
	$SQA = "SELECT IDT, KODE FROM asetlainlaingabung ORDER BY IDT";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$KdNew = substr($mRo[1],0,11).".".substr('00'.substr($mRo[1],-2,2),-3,3);
		$SW = "UPDATE asetlainlaingabung SET KODENEW='".$KdNew."' WHERE IDT='".$mRo[0]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
	*/
	/*
	$SQA = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$SW = "UPDATE asetlainlaingabung SET KD_SKPD='".$mRo[0]."', KD_UPB='".$mRo[0].".01.001' WHERE SKPD='".$mRo[1]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
	*/
}

if ($RepairTglPerolehanC=="YA" && $UID =="creator")
{
	$SQA = "SELECT IDT, Tahun_Anggaran FROM atribusi_c WHERE Tgl_Perolehan='0000-00-00' ORDER BY IDT LIMIT 0,5000";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$NewT = $mRo[1]."-12-31";
		echo $mRo[1]." : ".$NewT."<br>";
		$SW = "UPDATE atribusi_c SET Tgl_Perolehan='".$NewT."' WHERE IDT='".$mRo[0]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
}

if ($RepairTglPerolehanE=="YA" && $UID =="creator")
{
	$SQA = "SELECT IDT, Tahun_Anggaran FROM atribusi_e WHERE Tgl_Perolehan='0000-00-00' ORDER BY IDT LIMIT 0,5000";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$NewT = $mRo[1]."-12-31";
		echo $mRo[1]." : ".$NewT."<br>";
		$SW = "UPDATE atribusi_e SET Tgl_Perolehan='".$NewT."' WHERE IDT='".$mRo[0]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
}

if ($RepairTglPerolehanD=="YA" && $UID =="creator")
{
	$SQA = "SELECT IDT, Tahun_Anggaran FROM atribusi_d WHERE Tgl_Perolehan='0000-00-00' ORDER BY IDT LIMIT 0,5000";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$NewT = $mRo[1]."-12-31";
		echo $mRo[1]." : ".$NewT."<br>";
		$SW = "UPDATE atribusi_d SET Tgl_Perolehan='".$NewT."' WHERE IDT='".$mRo[0]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
}

if ($RepairAtribusiRegisterE=="YA" && $UID =="creator")
{
	$SQA = "SELECT IDT, Register FROM atribusi_e WHERE Register_New='' ORDER BY IDT LIMIT 0,1000";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$NewR = substr('0000000'.$mRo[1],-7,7);
		echo $mRo[1]." : ".$NewR."<br>";
		$SW = "UPDATE atribusi_e SET Register_New='".$NewR."' WHERE IDT='".$mRo[0]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
}

if ($RepairAtribusiRegisterB=="YA" && $UID =="creator")
{
	$SQA = "SELECT IDT, Register FROM atribusi_b WHERE Register_New='' ORDER BY IDT LIMIT 0,10000";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$NewR = substr('0000000'.$mRo[1],-7,7);
		echo $mRo[1]." : ".$NewR."<br>";
		$SW = "UPDATE atribusi_b SET Register_New='".$NewR."' WHERE IDT='".$mRo[0]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
}

if ($RepairAtribusiRegisterC=="YA" && $UID =="creator")
{
	$SQA = "SELECT IDT, Register FROM atribusi_c WHERE Register_New='' ORDER BY IDT LIMIT 0,5000";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$NewR = substr('0000000'.$mRo[1],-7,7);
		echo $mRo[1]." : ".$NewR."<br>";
		$SW = "UPDATE atribusi_c SET Register_New='".$NewR."' WHERE IDT='".$mRo[0]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
}

if ($RepairAtribusiRegisterD=="YA" && $UID =="creator")
{
	$SQA = "SELECT IDT, Register FROM atribusi_d WHERE Register_New='' ORDER BY IDT LIMIT 0,5000";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$NewR = substr('0000000'.$mRo[1],-7,7);
		echo $mRo[1]." : ".$NewR."<br>";
		$SW = "UPDATE atribusi_d SET Register_New='".$NewR."' WHERE IDT='".$mRo[0]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
}

if ($RepairAtribusiSKPDE=="YA" && $UID =="creator")
{
	$SQA = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$SW = "UPDATE atribusi_e SET Kode_SKPD='".$mRo[0]."' WHERE Nama_SKPD='".$mRo[1]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
}

if ($RepairAtribusiSKPDB=="YA" && $UID =="creator")
{
	$SQA = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$SW = "UPDATE atribusi_b SET Kode_SKPD='".$mRo[0]."' WHERE Nama_SKPD='".$mRo[1]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
}

if ($RepairAtribusiSKPDC=="YA" && $UID =="creator")
{
	$SQA = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$SW = "UPDATE atribusi_c SET Kode_SKPD='".$mRo[0]."' WHERE Nama_SKPD='".$mRo[1]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
}

if ($RepairAtribusiSKPDD=="YA" && $UID =="creator")
{
	$SQA = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$SW = "UPDATE atribusi_d SET Kode_SKPD='".$mRo[0]."' WHERE Nama_SKPD='".$mRo[1]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
	}
}


if ($CopyRek108_6=="YA" && $UID =="creator")
{
	$SQA = "DELETE FROM ref_rek_aset108_6 WHERE kd_aset LIKE '1.5.4.%'";
	$nRs = mysql_query($SQA);
	
	$SQA = "SELECT Kd_Aset, Nm_Aset, LinkKeAsetTetap FROM ref_rek_aset108_6_barsel WHERE kd_aset LIKE '1.5.4.%' ORDER BY kd_aset";
	echo $SQA."<br>";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		//echo $iG.". ".$mRo[0]." : ".$mRo[1]."<br>";
		$SW = "INSERT INTO ref_rek_aset108_6 SET 
		kd_aset='".$mRo[0]."',
		nm_aset='".$mRo[1]."',
		LinkKeAsetTetap='".$mRo[2]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
		
	}
}

if ($CopyRek108_45=="YA" && $UID =="creator")
{
	$SQA = "DELETE FROM ref_rek_aset108_4 WHERE kd_aset LIKE '1.5.4.%'";
	$nRs = mysql_query($SQA);
	
	$SQA = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4_barsel WHERE kd_aset LIKE '1.5.4.%' ORDER BY kd_aset";
	echo $SQA."<br>";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		//echo $iG.". ".$mRo[0]." : ".$mRo[1]."<br>";
		$SW = "INSERT INTO ref_rek_aset108_4 SET 
		kd_aset='".$mRo[0]."',
		nm_aset='".$mRo[1]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
		
	}
	
	$SQA = "DELETE FROM ref_rek_aset108_5 WHERE kd_aset LIKE '1.5.4.%'";
	$nRs = mysql_query($SQA);
	
	$SQA = "SELECT Kd_Aset, Nm_Aset, LinkKeAsetTetap FROM ref_rek_aset108_5_barsel WHERE kd_aset LIKE '1.5.4.%' ORDER BY kd_aset";
	echo $SQA."<br>";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		//echo $iG.". ".$mRo[0]." : ".$mRo[1]."<br>";
		$SW = "INSERT INTO ref_rek_aset108_5 SET 
		kd_aset='".$mRo[0]."',
		nm_aset='".$mRo[1]."',
		LinkKeAsetTetap='".$mRo[2]."'";
		echo $SW."<br>";
		$ns = mysql_query($SW);
		
	}
}

if ($CopyRek108_7=="YA" && $UID =="creator")
{
	$ReKA = "1.5.4.01";
	$ReKA = "1.5.4.02";
	$ReKA = "1.5.4.03";
	$ReKA = "1.5.4.04";
	$ReKA = "1.5.4.05";
	$ReKA = "1.5.4.06";
	
	$iG=1;
	$SQA = "SELECT Kd_Aset, LinkKeAsetTetap FROM ref_rek_aset108_6 WHERE kd_aset LIKE '".$ReKA."%' ORDER BY kd_aset";
	#echo $SQA."<br>";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		#echo $iG.". ".$mRo[0]." : ".$mRo[1]."<br>";
		Copy108_7($mRo[0],$mRo[1],"");
		$iG++;
		
	}
}

function Copy108_7($mRo0,$mRo1,$fX)
{
	$SQB = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_7 WHERE kd_aset LIKE '".$mRo1."%' ORDER BY kd_aset";
	if ($fX!='') echo $SQB."<br>";
	$nR = mysql_query($SQB);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$nEWk = $mRo0.".".substr($mR[0],-3,3);
		#echo $mR[0]." : ".$nEWk ." : ".$mR[1]."<br>";
		$mSF = fGlobal("IDT","ref_rek_aset108_7","kd_aset",$nEWk,"=","","");
		if ($mSF==''){
			$SW = "INSERT INTO ref_rek_aset108_7 SET 
			kd_aset='".$nEWk."',
			nm_aset='".$mR[1]."',
			link_kib_ae='".$mR[0]."'";
			echo $SW."<br>";
			$ns = mysql_query($SW);
			
		}
	}
}

if ($RepairMsMf=="YA" && $UID =="creator")
{
	$SQA = "select IDT, kd_aset_108 FROM ta_kib_108 WHERE referensi NOT LIKE 'KDP%' AND referensi NOT LIKE 'TNH%' AND referensi NOT LIKE 'ATL%' AND referensi NOT LIKE 'KDL%' AND Masa_Manfaat='0' ORDER BY kd_aset_108 LIMIT 0,1000";
	#echo $SQA."<br>";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mSF = fGlobal("Ms_Manfaat","ref_rek_aset108_7","kd_aset",$mRo[1],"=","","");
		$SW = "UPDATE ta_kib_108 SET Masa_Manfaat='".$mSF."' WHERE IDT='".$mRo[0]."'";
		$ns = mysql_query($SW);
		echo $SW."<br>";
	}
}

if ($RepairOverHaul=="YA" && $UID =="creator")
{
	$SQA = "select kd_aset, Link_Kib_AE, IDT FROM ref_rek_aset108_7 WHERE kd_aset LIKE '1.5.4.%' AND (Link_Kib_AE LIKE '1.3.2%' OR Link_Kib_AE LIKE '1.3.3%' OR Link_Kib_AE LIKE '1.3.4%') AND Ms_Manfaat<>'0' AND DuplikatOverHaul='N' order by IDT LIMIT 0,3000";
	#echo $SQA."<br>";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdA = fGlobal("count(*)","ta_masa_manfaat_108","kd_aset",$mRo[0],"=","","");
		if ($IdA==0){
			$SQ = "SELECT tA, tB, tUmur FROM ta_masa_manfaat_108 WHERE kode='".$mRo[1]."' ORDER BY IDT";
			$nR = mysql_query($SQ);
			while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
			{
				$SW="INSERT INTO ta_masa_manfaat_108 SET 
				Kode='".$mRo[0]."',
				tA='".$mR[0]."', 
				tB='".$mR[1]."', 
				tUmur='".$mR[2]."'";
				echo $SW."<br>";
				$rw = mysql_query($SW);
			}
		}
		
		$SQ = "UPDATE ref_rek_aset108_7 SET DuplikatOverHaul='Y' WHERE IDT='".$mRo[2]."'";
		$nR = mysql_query($SQ);
	}
}

if ($RepairMsManfaat=="YA")
{
	$SQA = "select IDT, Link_Kib_AE FROM ref_rek_aset108_7 WHERE kd_aset LIKE '1.5.4.%' AND (Link_Kib_AE LIKE '1.3.2%' OR Link_Kib_AE LIKE '1.3.3%' OR Link_Kib_AE LIKE '1.3.4%') AND Ms_Manfaat='0' order by IDT LIMIT 0,5000";
	#echo $SQA."<br>";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$MsA = fGlobal("Ms_Manfaat","ref_rek_aset108_7","kd_aset",$mRo[1],"=","","");
		
		if ($MsA!=0){
			$SW="UPDATE ref_rek_aset108_7 SET Ms_Manfaat='".$MsA."' WHERE IDT='".$mRo[0]."'";
			echo $SW."<br>";
			$rw = mysql_query($SW);
		}

	}
}

if ($RepairPNG=="YA")
{
	$SQA = "select IDT, kd_aset FROM ta_pengadaan WHERE Nm_Aset_108='' order by IDT";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$Kd108 = fGlobal("kd_aset108","ref_rek_aset5_maping","kd_aset17",$mRo[1],"=","","");
		$Nm108 = fGlobal("nm_aset","ref_rek_aset108_7","kd_aset",$Kd108,"=","","");
		
		if ($Kd108!=''){
			$SW="UPDATE ta_pengadaan SET Kd_Aset_108='".$Kd108."', Nm_Aset_108='".$Nm108."' WHERE IDT='".$mRo[0]."'";
			echo $SW."<br>";
			$rw = mysql_query($SW);
		}
	}
}

if ($Repair07=="YA")
{
	$SQA = "select IDT, kd_aset from ta_kib_108 WHERE kd_aset LIKE '07.%' AND kd_aset_108 NOT LIKE '1.5.%' order by IDT";
	#echo $SQA."<br>";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$Kd108 = fGlobal("kd_aset108","ref_rek_aset5_maping","kd_aset17",$mRo[1],"=","","");
		
		if ($Kd108!=''){
			$SW="UPDATE ta_kib_108 SET kd_aset_108='".$Kd108."' WHERE IDT='".$mRo[0]."'";
			echo $SW."<br>";
			$rw = mysql_query($SW);
		}
	}
	
	$SQA = "select IDT, kd_aset from ta_kib_post_108 WHERE kd_aset LIKE '07.%' AND kd_aset_108 NOT LIKE '1.5.%' order by IDT";
	#echo $SQA."<br>";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$Kd108 = fGlobal("kd_aset108","ref_rek_aset5_maping","kd_aset17",$mRo[1],"=","","");
		
		if ($Kd108!=''){
			$SW="UPDATE ta_kib_post_108 SET kd_aset_108='".$Kd108."' WHERE IDT='".$mRo[0]."'";
			echo $SW."<br>";
			$rw = mysql_query($SW);
		}
	}
}

if ($Repair108KOSOSNG=="YA")
{
	$SQA = "select IDT, kd_aset from ta_kib_post_108 WHERE kd_aset_108='' order by IDT";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$Kd108 = fGlobal("kd_aset108","ref_rek_aset5_maping","kd_aset17",$mRo[1],"=","","");
		
		if ($Kd108!=''){
			$SW="UPDATE ta_kib_post_108 SET kd_aset_108='".$Kd108."' WHERE IDT='".$mRo[0]."'";
			#echo $SW."<br>";
			$rw = mysql_query($SW);
		}
	}

	$SQA = "select IDT, kd_aset from ta_kib_108 WHERE kd_aset_108='' order by IDT";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$Kd108 = fGlobal("kd_aset108","ref_rek_aset5_maping","kd_aset17",$mRo[1],"=","","");
		
		if ($Kd108!=''){
			$SW="UPDATE ta_kib_108 SET kd_aset_108='".$Kd108."' WHERE IDT='".$mRo[0]."'";
			#echo $SW."<br>";
			$rw = mysql_query($SW);
		}
	}
}

if ($RepairBNG=="YA")
{
	$SQA = "select referensi, kd_aset_108 from ta_kib_108 WHERE referensi like 'BNG%' AND kd_aset_108 LIKE '1.3.2%' order by referensi LIMIT 0,100";
	echo $SQA."<br>";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		echo $mRo[0]." : ".$mRo[1]."<br>";
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi","ALT%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi","ALT%","LIKE","","");
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi","ALT%","LIKE","","");
		
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		$NewRefKIB = "ALT.".fMakeReferensi($NewK,11);
		echo $NewRefKIB."<br>";
		
		$SW="UPDATE ta_kib_108 SET referensi='".$NewRefKIB."' WHERE referensi='".$mRo[0]."'";
		echo $SW."<br>";
		$rw = mysql_query($SW);
		
		$SW="UPDATE ta_kib_post_108 SET referensi='".$NewRefKIB."', referensi_17='".$mRo[0]."' WHERE referensi='".$mRo[0]."'";
		echo $SW."<br>";
		$rw = mysql_query($SW);
	}
}

if ($CopyRek=="YA" && $UID =="creator")
{
	$rCeK = fGlobal("IDT","ref_rek_aset108_5","kd_aset","1.5.4.06%","LIKE","","");
	if ($rCeK==''){
		$SQA = "select kd_aset, nm_aset FROM ref_rek_aset108_5 WHERE kd_aset LIKE '1.5.4.01%' ORDER BY kd_aset";
		$nRs = mysql_query($SQA);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$eNew = "1.5.4.06.".substr($mRo[0],-2,2);
			$SW = "INSERT INTO ref_rek_aset108_5 set kd_aset='".$eNew."', nm_aset='".$mRo[1]."'";
			echo $SW."<br>";
			$rs = mysql_query($SW);
		}
	}
}

if ($ClearRek=="YA" && $UID =="creator")
{
	$SQA = "select kd_aset, count(*) as jmrek from ref_rek_aset5 group by kd_aset order by jmrek desc limit 0,5000";
	#$SQA = "select kd_aset, count(*) as jmrek from ref_rek_aset5 group by kd_aset order by jmrek desc limit 0,2";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mKD = $mRo[0];
		$jRK = $mRo[1];
		if ($jRK > 1)
		{
			echo $mKD."<br>";
			$iA=1;
			$SQAa = "select IDT from ref_rek_aset5 WHERE kd_aset='".$mKD."' ORDER BY IDT";
			$nRsa = mysql_query($SQAa);
			while ($mRoa = mysql_fetch_array($nRsa, MYSQL_BOTH))
			{
				if ($iA>=2){
					$SQAb = "DELETE FROM ref_rek_aset5 WHERE IDT='".$mRoa[0]."'";
					echo $SQAb."<BR>";
					$nRsb = mysql_query($SQAb);
				}
				$iA++;
			}
		}
	}
}


if ($NilaiAKHIE=="YA" && $UID =="creator")
{
	$SQA = "select IDT, Harga FROM ta_kib_e WHERE Harga>'0' and nilai_akhir='0' order by IDT";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mIDT = $mRo[0];
		$mHRG = $mRo[1];
		
		$SW = "update ta_kib_e set nilai_akhir='$mHRG' WHERE IDT='".$mIDT."'";
		$rs = mysql_query($SW);
	}
}

if ($NilaiAKHIR=="YA" && $UID =="creator")
{
	$SQA = "select IDT, Harga FROM ta_kib_g WHERE nilai_akhir='0' order by IDT";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mIDT = $mRo[0];
		$mHRG = $mRo[1];
		
		$SW = "update ta_kib_g set Nilai_Akhir='$mHRG' WHERE IDT='".$mIDT."'";
		$rs = mysql_query($SW);
	}
}

if ($Repair_simbada_barsel_data_print_ke2_03052018_2231=="YA" && $UID =="creator")
{
	$iz=0;
	for ($i=255191; $i<=255851; $i++){
		$Reff = "KDL.00000".$i;
		$a = "";
		$rCeK = fGlobal("IDT","ta_kib_g","Referensi:Kd_UPB",$Reff.":24.04.13.01%","=:LIKE","","");
		if ($rCeK){
			$rHis = fGlobal("ref_history","ta_kib_post","Referensi:Kd_UPB",$Reff.":24.04.13.01%","=:LIKE","","");
			if ($rHis){
				$SW="update ta_kib_g SET ref_history='$rHis' where referensi='$Reff'";
				$rw = mysql_query($SW);
			}
		}
	}

	$SW="update ta_kib_g SET ref_history='' where referensi='KDL.00000140673'";
	$rw = mysql_query($SW);
	
	$SW="update ta_kib_g SET ref_history='' where referensi='KDL.00000140687'";
	$rw = mysql_query($SW);
	
	$SW="update ta_kib_g SET ref_history='' where referensi='KDL.00000140702'";
	$rw = mysql_query($SW);
	
	$SW="update ta_kib_g SET ref_history='' where referensi='KDL.00000140703'";
	$rw = mysql_query($SW);
	
	$SW="update ta_kib_g SET ref_history='' where referensi='KDL.00000140706'";
	$rw = mysql_query($SW);
	
	$SW="update ta_kib_g SET ref_history='' where referensi='KDL.00000140707'";
	$rw = mysql_query($SW);
	
	$SW="update ta_kib_g SET ref_history='' where referensi='KDL.00000140729'";
	$rw = mysql_query($SW);
	
	$SW="update ta_kib_g SET ref_history='' where referensi='KDL.00000140730'";
	$rw = mysql_query($SW);
}

if ($JalanSTU=="YA" && $UID =="creator")
{
	$SQA = "select Referensi, Kd_UPB FROM ta_kib_post WHERE debet='1' order by Referensi";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mRef = $mRo[0];
		$mUpb = $mRo[1];
		
		$SW = "update ta_kib_post set ReValue='Y' WHERE Referensi='".$mRef."' AND Kd_UPB LIKE '".substr($mUpb,0,11)."%'";
		$rs = mysql_query($SW);
	}
}


if ($JalanDELL=="YA" && $UID =="creator")
{
	$SW="delete from ta_kib_post_penyusutan_bulanan where kd_aset=''";
	$rw = mysql_query($SW);
	
	$SW="delete from ta_kib_a where kd_upb=''";
	$rw = mysql_query($SW);
	
	$SW="delete from ta_kib_b where kd_upb=''";
	$rw = mysql_query($SW);
	
	$SW="delete from ta_kib_c where kd_upb=''";
	$rw = mysql_query($SW);
	
	$SW="delete from ta_kib_d where kd_upb=''";
	$rw = mysql_query($SW);
	
	$SW="delete from ta_kib_e where kd_upb=''";
	$rw = mysql_query($SW);
	
	$SW="delete from ta_kib_f where kd_upb=''";
	$rw = mysql_query($SW);
	
	$SW="delete from ta_kib_g where kd_upb=''";
	$rw = mysql_query($SW);
	
	$SW="delete from ta_kib_post where kd_upb=''";
	$rw = mysql_query($SW);
}

if ($JalanReAT=="YA")
{
	$eTbL="a";
	$eTbL="b";
	$eTbL="c";
	$eTbL="d";
	$eTbL="e";
	$eTbL="g";
	$eTbL="post";
	if ($eTbL=="post")
	{
		#kib~
		$SQ="select IDT, Referensi, Ref_History, Kd_UPB, Kd_Aset FROM ta_kib_".$eTbL." WHERE ref_usulan='' and Ref_History<>'' ORDER BY IDT LIMIT 0,1000";
		$nRs = mysql_query($SQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$rIdX = $mRo[0];
			$rReA = $mRo[1];
			$rReT = $mRo[2];
			$rUpB = $mRo[3];
			$rAsT = $mRo[4];
			
			$trEU = fGlobal("Ref_Usulan","ta_kib_post_mutasi","Referensi_To:Referensi:Kd_UPB_To:Kd_Aset_To",$rReA.":".$rReT.":".$rUpB.":".$rAsT,"=:=:=:=","IDT LIMIT 0,1","");
			if ($trEU){
				$SW="update ta_kib_".$eTbL." SET ref_usulan='$trEU', ref_mutasi='$rReT' where IDT='".$rIdX."'";
				echo $SW."<br>";
				$rw = mysql_query($SW);
			}
			else{
				$SW="update ta_kib_".$eTbL." SET ref_usulan='PHM.POST.TIDAKADA', ref_mutasi='$rReT' where IDT='".$rIdX."'";
				echo $SW."<br>";
				$rw = mysql_query($SW);
			}
		}
	}
	else
	{
		#kib ~ mutasi
		$SQ="select IDT, Referensi, Referensi_To, Kd_UPB, Kd_Aset FROM ta_kib_".$eTbL."_mutasi WHERE ref_usulan='' ORDER BY IDT LIMIT 0,1000";
		$nRs = mysql_query($SQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$rIdX = $mRo[0];
			$rReA = $mRo[1];
			$rReT = $mRo[2];
			$rUpB = $mRo[3];
			$rAsT = $mRo[4];
			
			$trEU = fGlobal("Ref_Usulan","ta_kib_post_mutasi","Referensi:Referensi_To:Kd_UPB:Kd_Aset",$rReA.":".$rReT.":".$rUpB.":".$rAsT,"=:=:=:=","IDT LIMIT 0,1","");
			if ($trEU){
				$SW="update ta_kib_".$eTbL."_mutasi SET ref_usulan='$trEU' where IDT='".$rIdX."'";
				echo $SW."<br>";
				$rw = mysql_query($SW);
			}
			else{
				$SW="update ta_kib_".$eTbL."_mutasi SET ref_usulan='PHM.POST.TIDAKADA' where IDT='".$rIdX."'";
				echo $SW."<br>";
				$rw = mysql_query($SW);
			}
		}
		
		#kib~
		$SQ="select IDT, Referensi, Ref_Mutasi, Kd_UPB, Kd_Aset FROM ta_kib_".$eTbL." WHERE ref_usulan='' and Ref_Mutasi<>'' ORDER BY IDT LIMIT 0,1000";
		$nRs = mysql_query($SQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$rIdX = $mRo[0];
			$rReA = $mRo[1];
			$rReT = $mRo[2];
			$rUpB = $mRo[3];
			$rAsT = $mRo[4];
			
			$trEU = fGlobal("Ref_Usulan","ta_kib_post_mutasi","Referensi_To:Referensi:Kd_UPB_To:Kd_Aset_To",$rReA.":".$rReT.":".$rUpB.":".$rAsT,"=:=:=:=","IDT LIMIT 0,1","");
			if ($trEU){
				$SW="update ta_kib_".$eTbL." SET ref_usulan='$trEU' where IDT='".$rIdX."'";
				echo $SW."<br>";
				$rw = mysql_query($SW);
			}
			else{
				$SW="update ta_kib_".$eTbL." SET ref_usulan='PHM.POST.TIDAKADA' where IDT='".$rIdX."'";
				echo $SW."<br>";
				$rw = mysql_query($SW);
			}
		}
	}
	
}

if ($JalanMOHO=="YA")
{
	$SQ="select IDT, Referensi, Kd_UPB, Kd_Aset FROM ta_kib_post_mutasi WHERE ref_usulan='' AND ref_history<>'' ORDER BY IDT LIMIT 0,1000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIDX = $mRo[0];
		$rReA = $mRo[1];
		$rUPB = $mRo[2];
		$rAST = $mRo[3];
		echo $rReA."<br>";
		$trEU = fGlobal("Ref_Usulan","ta_usulan_verifikasi_rinci","Ref_Aset:kd_UPB:Kd_Aset",$rReA.":".$rUPB.":".$rAST,"=:=:=","","yyyyy");
		echo $trEU."<br>";
		if ($trEU){
			$SW="update ta_kib_post_mutasi SET ref_usulan='$trEU' where IDT='".$rIDX."'";
			echo $SW."<br>";
			$rw = mysql_query($SW);
		}
	}
}

if ($ResetEXTRACOM=="YA")
{
	$SQ="UPDATE ta_kib_a SET extracom='N'";
	$nRs = mysql_query($SQ);
	$SQ="UPDATE ta_kib_b SET extracom='N'";
	$nRs = mysql_query($SQ);
	$SQ="UPDATE ta_kib_c SET extracom='N'";
	$nRs = mysql_query($SQ);
	$SQ="UPDATE ta_kib_d SET extracom='N'";
	$nRs = mysql_query($SQ);
	$SQ="UPDATE ta_kib_e SET extracom='N'";
	$nRs = mysql_query($SQ);
	$SQ="UPDATE ta_kib_post SET extracom='N'";
	$nRs = mysql_query($SQ);
}

if ($RepairMelaluiDokRekapMutasi=="YA")
{
	$kib="a";
	$SQ="select IDT, Referensi, Kd_Upb, Ref_Mutasi, Kd_Aset FROM ta_kib_".$kib." WHERE Ref_Mutasi <> '' ORDER BY IDT";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rRdT = $mRo[0];
		$rRff = $mRo[1];
		$rRpb = $mRo[2];
		$rMUT = $mRo[3];
		$rAST = $mRo[4];
		$tMUT = fGlobal("Tgl_Mutasi","ta_kib_post_mutasi","Referensi_To:Kd_Aset_To:Kd_Upb_To",$rRff.":".$rAST.":".$rRpb,"=:=:=","","");
		
		$SW="update ta_kib_".$kib." SET Tgl_Mutasi='$tMUT' where IDT='".$rRdT."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
		
		$SW="update ta_kib_post SET Ref_Mutasi='$rMUT', Tgl_Mutasi='$tMUT' where Referensi='".$rRff."' AND Kd_UPB='".$rRpb."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
	}
	
	$kib="b";
	$SQ="select IDT, Referensi, Kd_Upb, Ref_Mutasi, Kd_Aset FROM ta_kib_".$kib." WHERE Ref_Mutasi <> '' ORDER BY IDT";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rRdT = $mRo[0];
		$rRff = $mRo[1];
		$rRpb = $mRo[2];
		$rMUT = $mRo[3];
		$rAST = $mRo[4];
		$tMUT = fGlobal("Tgl_Mutasi","ta_kib_post_mutasi","Referensi_To:Kd_Aset_To:Kd_Upb_To",$rRff.":".$rAST.":".$rRpb,"=:=:=","","");
		
		$SW="update ta_kib_".$kib." SET Tgl_Mutasi='$tMUT' where IDT='".$rRdT."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
		
		$SW="update ta_kib_post SET Ref_Mutasi='$rMUT', Tgl_Mutasi='$tMUT' where Referensi='".$rRff."' AND Kd_UPB='".$rRpb."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
	}
	
	$kib="c";
	$SQ="select IDT, Referensi, Kd_Upb, Ref_Mutasi, Kd_Aset FROM ta_kib_".$kib." WHERE Ref_Mutasi <> '' ORDER BY IDT";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rRdT = $mRo[0];
		$rRff = $mRo[1];
		$rRpb = $mRo[2];
		$rMUT = $mRo[3];
		$rAST = $mRo[4];
		$tMUT = fGlobal("Tgl_Mutasi","ta_kib_post_mutasi","Referensi_To:Kd_Aset_To:Kd_Upb_To",$rRff.":".$rAST.":".$rRpb,"=:=:=","","");
		
		$SW="update ta_kib_".$kib." SET Tgl_Mutasi='$tMUT' where IDT='".$rRdT."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
		
		$SW="update ta_kib_post SET Ref_Mutasi='$rMUT', Tgl_Mutasi='$tMUT' where Referensi='".$rRff."' AND Kd_UPB='".$rRpb."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
	}
	
	$kib="d";
	$SQ="select IDT, Referensi, Kd_Upb, Ref_Mutasi, Kd_Aset FROM ta_kib_".$kib." WHERE Ref_Mutasi <> '' ORDER BY IDT";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rRdT = $mRo[0];
		$rRff = $mRo[1];
		$rRpb = $mRo[2];
		$rMUT = $mRo[3];
		$rAST = $mRo[4];
		$tMUT = fGlobal("Tgl_Mutasi","ta_kib_post_mutasi","Referensi_To:Kd_Aset_To:Kd_Upb_To",$rRff.":".$rAST.":".$rRpb,"=:=:=","","");
		
		$SW="update ta_kib_".$kib." SET Tgl_Mutasi='$tMUT' where IDT='".$rRdT."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
		
		$SW="update ta_kib_post SET Ref_Mutasi='$rMUT', Tgl_Mutasi='$tMUT' where Referensi='".$rRff."' AND Kd_UPB='".$rRpb."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
	}
	
	$kib="e";
	$SQ="select IDT, Referensi, Kd_Upb, Ref_Mutasi, Kd_Aset FROM ta_kib_".$kib." WHERE Ref_Mutasi <> '' ORDER BY IDT";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rRdT = $mRo[0];
		$rRff = $mRo[1];
		$rRpb = $mRo[2];
		$rMUT = $mRo[3];
		$rAST = $mRo[4];
		$tMUT = fGlobal("Tgl_Mutasi","ta_kib_post_mutasi","Referensi_To:Kd_Aset_To:Kd_Upb_To",$rRff.":".$rAST.":".$rRpb,"=:=:=","","");
		
		$SW="update ta_kib_".$kib." SET Tgl_Mutasi='$tMUT' where IDT='".$rRdT."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
		
		$SW="update ta_kib_post SET Ref_Mutasi='$rMUT', Tgl_Mutasi='$tMUT' where Referensi='".$rRff."' AND Kd_UPB='".$rRpb."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
	}
	
	$kib="g";
	$SQ="select IDT, Referensi, Kd_Upb, Ref_Mutasi, Kd_Aset FROM ta_kib_".$kib." WHERE Ref_Mutasi <> '' ORDER BY IDT";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rRdT = $mRo[0];
		$rRff = $mRo[1];
		$rRpb = $mRo[2];
		$rMUT = $mRo[3];
		$rAST = $mRo[4];
		$tMUT = fGlobal("Tgl_Mutasi","ta_kib_post_mutasi","Referensi_To:Kd_Aset_To:Kd_Upb_To",$rRff.":".$rAST.":".$rRpb,"=:=:=","","");
		
		$SW="update ta_kib_".$kib." SET Tgl_Mutasi='$tMUT' where IDT='".$rRdT."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
		
		$SW="update ta_kib_post SET Ref_Mutasi='$rMUT', Tgl_Mutasi='$tMUT' where Referensi='".$rRff."' AND Kd_UPB='".$rRpb."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
	}
}

if ($JalanNILB=="YA")
{
	$SQ="select IDT, Ref_Usulan, Ref_Aset, Kd_UPB from ta_usulan_verifikasi_rinci WHERE Nilai_Akhir < Harga ORDER BY IDT LIMIT 0,1000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIDX = $mRo[0];
		$rUSU = $mRo[1];
		$rAST = $mRo[2];
		$rUPB = $mRo[3];
		$tDTA = fGlobal("Harga:Nilai_Akhir","ta_usulan_rinci","Referensi:Ref_Aset:kd_UPB",$rUSU.":".$rAST.":".$rUPB,"=:=:=","","");
		if ($tDTA){
			$tDT = explode(":",$tDTA);
			$HrA = $tDT[0];
			$HrB = $tDT[1];
			if ($HrA>$HrB){
				$SW="update ta_usulan_rinci SET Harga='$HrA', Nilai_Akhir='$HrA' where Referensi='$rUSU' AND Ref_Aset='$rAST' AND kd_UPB='".$rUPB."'";
				echo $SW."<br>";
				$rw = mysql_query($SW);
				$SW="update ta_usulan_verifikasi_rinci SET Harga='$HrA', Nilai_Akhir='$HrA' where IDT='".$rIDX."'";
				echo $SW."<br>";
				$rw = mysql_query($SW);
			}
		}
	}
}

if ($JalanNILA=="YA")
{
	$SQ="select IDT, Ref_Usulan, Ref_Aset, Kd_UPB from ta_usulan_verifikasi_rinci WHERE Harga='0' ORDER BY IDT LIMIT 0,1000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIDX = $mRo[0];
		$rUSU = $mRo[1];
		$rAST = $mRo[2];
		$rUPB = $mRo[3];
		$tDTA = fGlobal("Harga:Nilai_Akhir","ta_usulan_rinci","Referensi:Ref_Aset:kd_UPB",$rUSU.":".$rAST.":".$rUPB,"=:=:=","","");
		if ($tDTA){
			$tDT = explode(":",$tDTA);
			$HrA = $tDT[0];
			$HrB = $tDT[1];
			#echo $tDTA."<br>";
			$SW="update ta_usulan_verifikasi_rinci SET Harga='$HrA', Nilai_Akhir='$HrB' where IDT='".$rIDX."'";
			echo $SW."<br>";
			$rw = mysql_query($SW);
		}
	}
}

if ($JalanAUPB=="YA")
{
	$SQ="select IDT, Referensi from ta_kib_post WHERE Kd_UPB='' ORDER BY Referensi LIMIT 0,1000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIDX = $mRo[0];
		$rREF = $mRo[1];
		$rFR  = substr($rREF,0,3);
		if ($rFR=="TNH"){$rTbL = "a";}
		if ($rFR=="ALT"){$rTbL = "b";}
		if ($rFR=="BNG"){$rTbL = "c";}
		if ($rFR=="JLN"){$rTbL = "d";}
		if ($rFR=="ATL"){$rTbL = "e";}
		if ($rFR=="KDL"){$rTbL = "g";}
		
		$tUPB = fGlobal("Kd_UPB","ta_kib_".$rTbL,"Referensi",$rREF,"=","","");
		$SW="update ta_kib_post set Kd_UPB='$tUPB' where IDT='".$rIDX."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
	}
	$SQ="select IDT, Referensi from ta_kib_post WHERE Kd_Aset='' ORDER BY Referensi LIMIT 0,1000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIDX = $mRo[0];
		$rREF = $mRo[1];
		$rFR  = substr($rREF,0,3);
		if ($rFR=="TNH"){$rTbL = "a";}
		if ($rFR=="ALT"){$rTbL = "b";}
		if ($rFR=="BNG"){$rTbL = "c";}
		if ($rFR=="JLN"){$rTbL = "d";}
		if ($rFR=="ATL"){$rTbL = "e";}
		if ($rFR=="KDL"){$rTbL = "g";}
		
		$tAST = fGlobal("Kd_Aset","ta_kib_".$rTbL,"Referensi",$rREF,"=","","");
		$SW="update ta_kib_post set Kd_Aset='$tAST' where IDT='".$rIDX."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
	}
}

if ($JalanASTO=="YA")
{
	$SQ="select IDT, Referensi from ta_kib_post_mutasi WHERE Kd_Aset_To='' AND Jns_Mutasi = 'MS' ORDER BY Referensi LIMIT 0,1000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIDX = $mRo[0];
		$rREF = $mRo[1];
		$rFR  = substr($rREF,0,3);
		if ($rFR=="TNH"){$rTbL = "a";}
		if ($rFR=="ALT"){$rTbL = "b";}
		if ($rFR=="BNG"){$rTbL = "c";}
		if ($rFR=="JLN"){$rTbL = "d";}
		if ($rFR=="ATL"){$rTbL = "e";}
		if ($rFR=="KDL"){$rTbL = "g";}
		
		$rMTS = fGlobal("Kd_Aset_To","ta_kib_".$rTbL."_mutasi","Referensi",$rREF,"=","","");
		$SW="update ta_kib_post_mutasi set Kd_Aset_To='$rMTS' where IDT='".$rIDX."'";
		#echo $SW."<br>";
		$rw = mysql_query($SW);
	}
}

#REPAIR TANGGAL MUTASI POST
if ($JalanMTS=="YA")
{
	$SQ="select IDT, Referensi, Crit, Tanggal from ta_kib_post WHERE Tgl_Mutasi='0000-00-00' AND Referensi NOT LIKE 'KDP.%' ORDER BY Referensi LIMIT 0,3000";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIDX = $mRo[0];
		$rREF = $mRo[1];
		$rCRT = $mRo[2];
		$rTGL = $mRo[3];
		$rFR  = substr($rREF,0,3);
		if ($rFR=="TNH"){$rTbL = "a";}
		if ($rFR=="ALT"){$rTbL = "b";}
		if ($rFR=="BNG"){$rTbL = "c";}
		if ($rFR=="JLN"){$rTbL = "d";}
		if ($rFR=="ATL"){$rTbL = "e";}
		if ($rFR=="KDL"){$rTbL = "g";}
		
		$rMTS = fGlobal("Tgl_Mutasi","ta_kib_".$rTbL,"Referensi",$rREF,"=","","df");
		if ($rMTS=="NULL" || $rMTS==""){
			$UpdD="Ya";
			$yTGL=$rTGL;
		}
		else if ($rMTS=="0000-00-00"){
			$UpdD="Ya";
			$yTGL=$rTGL;
		}
		else{
			$UpdD="No";
			$yTGL=$rMTS;
		}
		
		if ($rCRT=="SLD" && $UpdD=="Ya"){
			$SW="update ta_kib_".$rTbL." set Tgl_Mutasi='$yTGL' where Referensi='".$rREF."'";
			$rw = mysql_query($SW);
		}
		$SW="update ta_kib_post set Tgl_Mutasi='$yTGL' where IDT='".$rIDX."'";
		echo $SW."<br>";
		$rw = mysql_query($SW);
	}
}


?>