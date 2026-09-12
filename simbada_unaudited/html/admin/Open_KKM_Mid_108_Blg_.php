<?
require "Connection.php";
require "FileFunction.php";
require "Open_KKM_Mid_Bulanan_108_Blg_.php";
extract($_GET);
extract($_POST);
$ExtR = $ExtR;
$gLaP = $fThn;
$gRef = $fRef;

#echo $gRef;
#return false;

$testRef = "%";
if ($gRef!='')
{
	$testRef = $gRef;
}

if ($Simpan=="Repair")
{

	mysql_select_db(DatabaseSB,$ConSB);
	$UID = fGlobal("User_ID","ta_user_log","IDT",$_GET['IdL'],"=","","");
	if ($gLaP==2013)
	{
		$ThA = substr(fGlobalNEW("min(Tgl_Perolehan)","ta_kib_108","Kd_UPB:Tgl_Perolehan NOT",$fUnt."%:0000%","LIKE:LIKE","",DatabaseSB,$ConSB,""),0,4);
		$ThB = $gLaP;
		#echo $ThA.":".$ThB;
	}
	else 
	{
		$ThA = $gLaP;
		$ThB = $gLaP;
	}
	
	#return false;
	#echo $ThA." : ".$ThB."<br>";
	
	for ($iJ=$ThA; $iJ<=$ThB; $iJ++)
	{
		$gLaP = $iJ;
		
		if ($gRef=='') #Diloading jika tidak per referensi aset
		{
			$mSQ ="DELETE FROM ta_kib_post_penyusutan_recorded_108 WHERE Kd_UPB ='".$fUnt."' AND Kd_Bidang='".substr($fAst,0,5)."' AND Tahun='".$gLaP."'";
			$mRs = mysql_query($mSQ);
			
			$mSQ ="INSERT INTO ta_kib_post_penyusutan_recorded_108 SET 
			Kd_UPB ='".$fUnt."', 
			Kd_Bidang='".substr($fAst,0,5)."',
			Tahun='".$gLaP."',
			Pencatat='".$UID."',
			Recorded=now()";
			$mRs = mysql_query($mSQ);
		}
		
		$mSQ ="DELETE FROM ta_kib_post_penyusutan_108 WHERE Kd_UPB LIKE '".substr($fUnt,0,11)."%' AND Kd_Aset_108 LIKE '".$fAst."%' AND PerLap='".$gLaP."' 
		AND extracom='".$ExtR."' 
		AND Referensi LIKE '".$testRef."'";
		$mRs = mysql_query($mSQ) or die(mysql_error());
		
		if ($fAst=="1.3.5")
		{
			//ASET LAINNYA
			$mTS="";
			$mSQ ="SELECT Referensi, Kd_Aset_108 FROM ta_kib_108 WHERE extracom='".$ExtR."' 
			AND Kd_UPB LIKE '".$fUnt."%' AND Kd_Aset_108 LIKE '".$fAst."%' AND Tgl_Perolehan <= '".$gLaP."-12-31' 
			AND Referensi LIKE '".$testRef."' 
			GROUP BY Referensi 
			ORDER BY Referensi";
			$mRs = mysql_query($mSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($mRs, MYSQL_BOTH))
			{
				$gRef = $mRo[0];
				$gAsT = $mRo[1];
				$CekST= checkSusutkanTidak($gAsT,DatabaseSB,$ConSB,"");
				if ($CekST>0){
					$AbiS = "NO";
					$gMsA = findMasaManfaat($gAsT,DatabaseSB,$ConSB);
					ProsesDataBulanan($AbiS,$fUnt,$gMsA,$gLaP,$gRef,$mTS,$ExtR,DatabaseSB,$ConSB);
				}
			}
		}
		
		if ($fAst!="1.3.5")
		{	
			//NON ASET LAINNYA
			$mTS="";
			if ($fAst=="1.5.4")
			{
				#AND Kd_Aset_108 NOT LIKE '1.5.4.06%' 
				$mSQ ="SELECT Referensi, Kd_Aset_108, Tgl_Mutasi FROM ta_kib_108 WHERE extracom='".$ExtR."' 
				AND Kd_UPB LIKE '".$fUnt."%' 
				AND Kd_Aset_108 LIKE '".$fAst."%' 
				
				AND Kd_Aset_108 NOT LIKE '1.5.4.01.01%' 
				AND Kd_Aset_108 NOT LIKE '1.5.4.02.01%' 
				AND Kd_Aset_108 NOT LIKE '1.5.4.03.01%' 
				AND Kd_Aset_108 NOT LIKE '1.5.4.04.01%' 
				AND Kd_Aset_108 NOT LIKE '1.5.4.05.01%' 
				AND Kd_Aset_108 NOT LIKE '1.5.4.06.01%' 
				
				AND Kd_Aset_108 NOT LIKE '1.5.4.02.74%' 
				AND Kd_Aset_108 NOT LIKE '1.5.4.02.81%' 
				AND Kd_Aset_108 NOT LIKE '1.5.4.01.82.01.001' 
				
				AND Tgl_Perolehan <= '".$gLaP."-12-31' 
				
				AND Referensi LIKE '".$testRef."' 
				
				GROUP BY Referensi 
				ORDER BY Referensi";
				
				#AND Referensi='KDL.00000013206' 
			}
			else
			{
				$mSQ ="SELECT Referensi, Kd_Aset_108, Tgl_Mutasi FROM ta_kib_108 WHERE extracom='".$ExtR."' 
				AND Kd_UPB LIKE '".$fUnt."%' AND Kd_Aset_108 LIKE '".$fAst."%' AND Tgl_Perolehan <= '".$gLaP."-12-31' 
				
				AND Referensi LIKE '".$testRef."' 
				
				GROUP BY Referensi 
				ORDER BY Referensi";
			}
			#echo $mSQ."<br>";
			$mRs = mysql_query($mSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($mRs, MYSQL_BOTH))
			{
				$gRef = $mRo[0];
				$gAsT = $mRo[1];
				$tMuT = $mRo[2];
				
				$ProS = "YA";
				$AbiS = "NO";
				
				if (substr($gAsT,0,5)=='1.5.4')
				{
					if ($tMuT=='0000-00-00')
					{
						$ProS = "NO";
					}
					else
					{
						$ThnMuT = substr($tMuT,0,4);
						#echo $ThnMuT."<br>";
						$Kd8    = substr($gAsT,0,8);
						
						#if ($Kd8=='1.5.4.01' || $Kd8=='1.5.4.06') sblm 2025 / bulanan
						if ($Kd8=='1.5.4.01' || $Kd8=='1.5.4.02' || $Kd8=='1.5.4.03' || $Kd8=='1.5.4.04' || $Kd8=='1.5.4.05' || $Kd8=='1.5.4.06' || $Kd8=='1.5.4.07')
						{
							if ($gLaP <= ($ThnMuT-1))	#Kondisi untuk aset lainnya (rusak berat dll 1.5.4.01-rusak berat, 1.5.4.06-tidak digunakan dalam..) disusutkan sampai dengan (tahun-1 pada tanggal mutasi)
							{
								$ProS = "YA"; $AbiS = "NO";
							}
							else						#Penyusutan tidak diproses lagi, hanya mengambil data akumulasi dan sisa nilai buku pada tahun sebelumnya
							{
								$ProS = "YA"; $AbiS = "YA";
							}
						}
						else
						{
							$ProS = "YA"; $AbiS = "NO";
						}
					}
				}
				if ($ProS == "YA")
				{
					$gMsA = findMasaManfaat($gAsT,DatabaseSB,$ConSB);
					ProsesDataBulanan($AbiS,$fUnt,$gMsA,$gLaP,$gRef,$mTS,$ExtR,DatabaseSB,$ConSB);
				}
			}
		}
	}
		
	$MsG = "Proses rekap selesai....!!";
}
if ($Simpan=="Close") 
{
	echo "<script LANGUAGE='JavaScript'>";
	echo "this.setTimeout('self.close()',0)";
	echo "</script>";
}

function ProsesDataBulanan($AbiS,$fUnt,$gMsA,$gLaP,$gRef,$mTS,$ExtR,$DatabaseSB,$ConSB)
{
	$CeKD = fGlobalNEW("IDT","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap",$fUnt."%:".$gRef.":".($gLaP-1),"LIKE:=:=","",$DatabaseSB,$ConSB,"");	//Cek data lama atau data baru thn berjalan
	if (!$CeKD) {
		ProsesDataBaruBulanan($AbiS,$fUnt,$gMsA,$gLaP,$gRef,$mTS,$ExtR,$DatabaseSB,$ConSB);
	}
	else {
		ProsesDataLamaBulanan($AbiS,$fUnt,$gMsA,$gLaP,$gRef,$mTS,$ExtR,$DatabaseSB,$ConSB);
	}
}

?>