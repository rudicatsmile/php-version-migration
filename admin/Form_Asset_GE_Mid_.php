<?php
require "Connection.php";
require "FileFunction.php";

extract($_POST);
extract($_GET);
$tKib   = "GE";
$rIDT   = $rIDT;
$Smp    = $Simpan;

$gUnt   = $fUnt;
$gSub   = $fSub;
$gUpb   = $fUpb;
$gThn   = $fThn;

$gBid   = $fBid;
$gKel   = $fKel;
$gOBJ   = $fOBJ;
$gRin   = $fRin;
$gNma   = $fNama;
if (!$gNma) {$gNma = fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$gRin,"=","","");}

$gJDL   = $fJudul;
$gSPS   = $fSpesi;
$gBHN   = $fBahan;
$gThnC  = fConvertToNumeric($fThnCetak);
$gDRH   = $fAsalD;
$gJNS   = $fJenis;
$gPCP   = $fCipta;
$gUKU   = fConvertToNumeric($fUkura);

$gKTR   = $fKeterangan;
$gMLK   = $fMilik;
$gKND   = $fKondisi;
$gAUS   = $fAsalUsul;

$gMSM   = $fManfaat;
$gMSM  = findMasaManfaat($gRin,DatabaseSB,$ConSB);
if (!$gMSM) {$gMSM=0;}

$gSTN   = fConvertToNumeric($fSatuan);
$gHRG   = fConvertToNumeric($fHarga);
$gTTL  = $gSTN * $gHRG;

$gHri = $fHri;
$gBln = $fBln;
$gThn = $fThn;

$gHriM = $fHriM;
$gBlnM = $fBlnM;
$gThnM = $fThnM;
$gTglM= $gThnM."-".$gBlnM."-".$gHriM;

$gTgl = $gThn."-".$gBln."-".$gHri;
$gTglD= $gThnD."-".$gBlnD."-".$gHriD;
$gChoiceGRP = $fChoise;
$FldUpdt="";
if ($gBid=="05.17") {$FldUpdt="Judul='$gJDL',Spesifikasi='$gSPS',Bahan='$gBHN',Tahun='$gThnC'";}
if ($gBid=="05.18") {$FldUpdt="Daerah_Asal='$gDRH',Pencipta='$gPCP',Bahan='$gBHN'";}
if ($gBid=="05.19") {$FldUpdt="Jenis='$gJNS',Ukuran='$gUKU'";}

if ($Smp=="Save")
	{
		if ($rIDT!="")
		{
			$gGRP=fGlobal("Ref_Group","ta_kib_g","IDT",$rIDT,"=","","");
			if ($gGRP!="")
			{
				if ($gChoiceGRP=="ON")		//PILIHAN EDIT GROUP ATAU TIDAK
				{
					$gSTN_Old=fGlobal("Jml_Item","Ta_KIB_Group","Referensi",$gGRP,"=","","");
					if ($gSTN <=0 ) {$gSTN=$gSTN_Old;}	//ANTISIPASI JIKA NILAI DIJADIKAN NOL
					
					//$gHRG = $gTTL/$gSTN;
					$gTTL = $gHRG * $gSTN;
					if ($gSTN==$gSTN_Old)	//JIKA JUMLAH ITEM TIDAK ADA PERUBAHAN
					{
						//UPDATE GROUP
						$SQL = "UPDATE ta_kib_group SET 
						Jml_Item='$gSTN',
						Nilai_Total='$gTTL' WHERE Referensi='".$gGRP."'";
						$rst = mysql_query($SQL) or die(mysql_error());
						
						//UPDATE MULTIPLE ENTRY
						$SQL = "UPDATE ta_kib_ge SET 
						Nm_Aset='".mysql_real_escape_string($gNma)."',
						".$FldUpdt.",
						Keterangan='$gKTR',
						Tgl_Perolehan='$gTgl',
						Tgl_Mutasi='$gTglM',
						Kd_Pemilik='$gMLK',
						Kondisi='$gKND',
						Asal_Usul='$gAUS',
						Masa_Manfaat='$gMSM',
						Harga='$gHRG',
						Nilai_Akhir='$gHRG' WHERE Ref_Group='".$gGRP."'";
						$rst = mysql_query($SQL) or die(mysql_error());
						
						require "Update_KIB_Post_Group.php";
					}
					else if ($gSTN > $gSTN_Old)		//JIKA JUMLAH ITEM YANG BARU LEBIH BESAR MAKA TAMBAH RECORD BARU
					{
						$TmbRec = $gSTN - $gSTN_Old;
						
						//CARI REGISTER RERAKHIR BARANG DI TABEL KIB
						$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_ge WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
						$nRst = mysql_query($nSQL) or die(mysql_error());
						$nRow = mysql_fetch_assoc($nRst);
						$NewG = $nRow['LasReG'];
						$LastReGrp = ((int)$NewG) + 1;
						$NewReGrp  = ($LastReGrp + $TmbRec)-1;
					
						//UPDATE GROUP
						$SQL = "UPDATE ta_kib_group SET 
						Jml_Item='$gSTN',
						Nilai_Total='$gTTL',
						RegTo='$NewReGrp' WHERE Referensi='".$gGRP."'";
						$rst = mysql_query($SQL) or die(mysql_error());
						
						//INSERT RECORD TAMBAHAN
						$NewRefGrp = $gGRP;
						for($iG=$LastReGrp; $iG<=$NewReGrp; $iG++)
						{
							$NewReGAset = fMakeRegister($iG,7);
							require "Insert_KIB_GE.php";
						}
						
						//UPDATE MULTIPLE ENTRY DENGAN HARGA BARU
						$SQL = "UPDATE ta_kib_ge SET 
						Nm_Aset='".mysql_real_escape_string($gNma)."',
						".$FldUpdt.",
						Keterangan='$gKTR',
						Tgl_Perolehan='$gTgl',
						Tgl_Mutasi='$gTglM',
						Kd_Pemilik='$gMLK',
						Kondisi='$gKND',
						Asal_Usul='$gAUS',
						Masa_Manfaat='$gMSM',
						Harga='$gHRG',
						Nilai_Akhir='$gHRG' WHERE Ref_Group='".$gGRP."'";
						$rst = mysql_query($SQL) or die(mysql_error());
						
						require "Update_KIB_Post_Group.php";
					}
					else if ($gSTN < $gSTN_Old)		//JIKA JUMLAH ITEM YANG BARU LEBIH KECIL, MAKA ADA PENGHAPUSAN RECORD SEJUMLAH PERBEDAANYA
					{
						$SisaRec = $gSTN;
						if ($SisaRec > 1)			//MASIH DALAM KORIDOR ENTRY GROUP
						{
							//CARI NILAI PENGURANG
							$HpsRec = abs($gSTN - $gSTN_Old);
							
							//HAPUS SEBAGIAN RECORD
							for($iG=1; $iG<=$HpsRec; $iG++)
							{
								//$DeLIDT = fGlobal("IDT","ta_kib_ge","Ref_Group",$gGRP,"=","IDT desc limit 1","");
								//$SQL = "delete from ta_kib_ge where IDT='".$DeLIDT."'";
								//$rst = mysql_query($SQL) or die(mysql_error());
								
								$DeLIDT = fGlobal("IDT:Referensi:Ref_Group","ta_kib_ge","Ref_Group",$gGRP,"=","IDT desc limit 1","");
								if ($DeLIDT!="")
								{
									$DeLIDG = explode(':', $DeLIDT);
									$DeLRec = $DeLIDG[0];
									$DeLReF = $DeLIDG[1];
									$DeLReG = $DeLIDG[2];
									
									$SQL = "DELETE FROM ta_kib_ge WHERE IDT='".$DeLRec."'";
									$rst = mysql_query($SQL) or die(mysql_error());
									if ($DeLReF!="" && $DeLReG!=""){
										$SQL = "DELETE FROM ta_kib_post WHERE Referensi='".$DeLReF."' AND Ref_Group='".$DeLReG."'";
										$rst = mysql_query($SQL) or die(mysql_error());
									}
								}
							}
							
							$gRegTo_Old = fGlobal("RegTo","Ta_KIB_Group","Referensi",$gGRP,"=","","");
							$gRegTo_New = $gRegTo_Old-$HpsRec;
							
							//UPDATE GROUP
							$SQL = "UPDATE ta_kib_group SET 
							Jml_Item='$gSTN',
							Nilai_Total='$gTTL',
							RegTo='$gRegTo_New' WHERE Referensi='".$gGRP."'";
							$rst = mysql_query($SQL) or die(mysql_error());
						
							//UPDATE MULTIPLE ENTRY DENGAN HARGA BARU KARENA PENGURANGAN ITEM
							$SQL = "UPDATE ta_kib_ge SET 
							Nm_Aset='".mysql_real_escape_string($gNma)."',
							".$FldUpdt.",
							Keterangan='$gKTR',
							Tgl_Perolehan='$gTgl',
							Tgl_Mutasi='$gTglM',
							Kd_Pemilik='$gMLK',
							Kondisi='$gKND',
							Asal_Usul='$gAUS',
							Masa_Manfaat='$gMSM',
							Harga='$gHRG',
							Nilai_Akhir='$gHRG' WHERE Ref_Group='".$gGRP."'";
							$rst = mysql_query($SQL) or die(mysql_error());
							
							require "Update_KIB_Post_Group.php";
						}
						else if ($SisaRec <= 1)	//HILANGKAN SIFAT ENTRY GROUP MENJADI SINGLE GROUP
						{
							//CARI NILAI PENGURANG
							$HpsRec = abs($gSTN - $gSTN_Old);
							
							//HAPUS SEBAGIAN RECORD
							for($iG=1; $iG<=$HpsRec; $iG++)
							{
								//$DeLIDT = fGlobal("IDT","ta_kib_ge","Ref_Group",$gGRP,"=","IDT desc limit 1","");
								//$SQL = "delete from ta_kib_ge where IDT='".$DeLIDT."'";
								//$rst = mysql_query($SQL) or die(mysql_error());
								
								$DeLIDT = fGlobal("IDT:Referensi:Ref_Group","ta_kib_ge","Ref_Group",$gGRP,"=","IDT desc limit 1","");
								if ($DeLIDT!="")
								{
									$DeLIDG = explode(':', $DeLIDT);
									$DeLRec = $DeLIDG[0];
									$DeLReF = $DeLIDG[1];
									$DeLReG = $DeLIDG[2];
									
									$SQL = "DELETE FROM ta_kib_ge WHERE IDT='".$DeLRec."'";
									$rst = mysql_query($SQL) or die(mysql_error());
									if ($DeLReF!="" && $DeLReG!=""){
										$SQL = "DELETE FROM ta_kib_post WHERE Referensi='".$DeLReF."' AND Ref_Group='".$DeLReG."'";
										$rst = mysql_query($SQL) or die(mysql_error());
									}
								}
							}
							//HAPUS DATA MASTER REF GROUP
							$SQL = "DELETE FROM ta_kib_group WHERE Referensi='".$gGRP."'";
							$rst = mysql_query($SQL) or die(mysql_error());
						
							//UPDATE KIB & HAPUS DATA PADA FIELD REF_GROUP DI KIB
							$SQL = "UPDATE ta_kib_ge SET 
							Ref_Group='',
							Nm_Aset='".mysql_real_escape_string($gNma)."',
							".$FldUpdt.",
							Keterangan='$gKTR',
							Tgl_Perolehan='$gTgl',
							Tgl_Mutasi='$gTglM',
							Kd_Pemilik='$gMLK',
							Kondisi='$gKND',
							Asal_Usul='$gAUS',
							Masa_Manfaat='$gMSM',
							Harga='$gHRG',
							Nilai_Akhir='$gHRG' WHERE Ref_Group='".$gGRP."'";
							$rst = mysql_query($SQL) or die(mysql_error());
							
							require "Update_KIB_Post_GroupToSingle.php";
						}
						
					}
				}
				else
				{
					//UPDATE SINGLE ENTRY (DALAM KORIDOR MULTIPLE ENTRY)
					$SQL = "UPDATE ta_kib_ge SET 
					Nm_Aset='".mysql_real_escape_string($gNma)."',
					".$FldUpdt.",
					Keterangan='$gKTR',
					Tgl_Perolehan='$gTgl',
					Tgl_Mutasi='$gTglM',
					Kd_Pemilik='$gMLK',
					Kondisi='$gKND',
					Asal_Usul='$gAUS',
					Masa_Manfaat='$gMSM',
					Harga='$gHRG', Nilai_Akhir='$gHRG' WHERE IDT='".$rIDT."'";
					$rst = mysql_query($SQL) or die(mysql_error());
					
					require "Update_KIB_Post_Single.php";
				}
			}
			else
			{
				//UPDATE SINGLE ENTRY
				//$gHRG = $gTTL;	//HARGA ARAHKAN LANGSUNG KE NILAI PEROLEHAN
				$gTTL = $gHRG;		//NILAI ARAHKAN LANGSUNG KE HARGA SATUAN
				$SQL = "UPDATE ta_kib_ge SET 
				Nm_Aset='".mysql_real_escape_string($gNma)."',
				".$FldUpdt.",
				Keterangan='$gKTR',
				Tgl_Perolehan='$gTgl',
				Tgl_Mutasi='$gTglM',
				Kd_Pemilik='$gMLK',
				Kondisi='$gKND',
				Asal_Usul='$gAUS',
				Masa_Manfaat='$gMSM',
				Harga='$gHRG', Nilai_Akhir='$gHRG' WHERE IDT='".$rIDT."'";
				$rst = mysql_query($SQL) or die(mysql_error());
				
				require "Update_KIB_Post_Single.php";
			}
		}
		else
		{
			$NewRefGrp ="";
			$NewReGAset="";
			
			if ($gSTN > 1)		//MODUL ENTRY GROUP
			{
				//CARI REGISTER RERAKHIR BARANG DI TABEL KIB
				$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_ge WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
				$nRst = mysql_query($nSQL) or die(mysql_error());
				$nRow = mysql_fetch_assoc($nRst);
				$NewG = $nRow['LasReG'];
				$LastReGrp = ((int)$NewG) + 1;
				$NewReGrp  = ($LastReGrp + $gSTN)-1;
				
				//MAKE REFERENSI GROUP
				$nSQL = "SELECT IFNULL(MAX(Referensi),0) AS LasRef FROM ta_kib_group";
				$nRst = mysql_query($nSQL) or die(mysql_error());
				$nRow = mysql_fetch_assoc($nRst);
				$NewK = $nRow['LasRef'];
				$NewK = substr($NewK, 5,11);
				$NewK = ((int)$NewK) + 1;
				$NewRefGrp = "GRP.".fMakeReferensi($NewK,11);
				
				//INSERT
				$SQL = "INSERT INTO ta_kib_group SET 
				Referensi='$NewRefGrp',
				Kd_UPB='$gUpb',
				Kd_Aset='$gRin',
				Jml_Item='$gSTN',
				Nilai_Total='$gTTL',
				RegFrom='$LastReGrp',
				RegTo='$NewReGrp'";
				$rst = mysql_query($SQL) or die(mysql_error());
				
				//$gHRG = $gTTL/$gSTN;
				$gTTL = $gHRG * $gSTN;
				for($iG=$LastReGrp; $iG<=$NewReGrp; $iG++)
				{
					$NewReGAset = fMakeRegister($iG,7);
					require "Insert_KIB_GE.php";
				}
				
				//AMBIL IDT PALING AWAL SESUAI REFERENSI GROUP
				$rIDT = fGlobal("IDT","ta_kib_ge","Ref_Group",$NewRefGrp,"=","IDT asc limit 1","");
			}
			else		//MODUL SINGLE ENTRY
			{
				//CARI REGISTER RERAKHIR BARANG DI TABEL KIB
				$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_ge WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
				$nRst = mysql_query($nSQL) or die(mysql_error());
				$nRow = mysql_fetch_assoc($nRst);
				$NewG = $nRow['LasReG'];
				$LastReG = ((int)$NewG) + 1;
				$NewReGAset = fMakeRegister($LastReG,7);
				
				//HARGA ARAHKAN LANGSUNG KE NILAI PEROLEHAN
				//$gHRG = $gTTL;
				$gTTL = $gHRG;
				
				//LIBATKAN FILE INSERT BARU	
				require "Insert_KIB_GE.php";
				
				//AMBIL IDT PALING AWAL SESUAI SINGLE REFERENSI
				$rIDT = fGlobal("IDT","ta_kib_ge","Referensi",$NewRefKIB,"=","","");
			}
		}
	}
else if ($Smp=="Reset")
	{
		$rIDT="";
	}
$URL="Form_Asset_E_Mid.php?rIDT=".$rIDT."&IdL=".$IdL."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gBid=".$gBid."&gKel=".$gKel."&gOBJ=".$gOBJ."&gRin=".$gRin."&gFin=".$gFin;
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
