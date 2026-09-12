<?php
function ProsesDataBaruTahunan($AbiS,$fUnt,$gMsA,$gLaP,$gRef,$mTS,$ExtR,$DatabaseSB,$ConSB)
{
	mysql_select_db($DatabaseSB,$ConSB);
	$fUnt = substr($fUnt,0,11);
	
	#if ($gLaP==2013)
	#{
	#	$iGA = 1;
	#	$nSQ = "SELECT 
	#	Referensi as A0, 
	#	Kd_UPB as A1, 
	#	Kd_Aset_108 as A2, 
	#	No_Register as A3, 
	#	Tanggal as A4, 
	#	IfNull(sum(Debet),0) as A5 
	#	FROM ta_kib_post_108".$mTS." WHERE Kd_UPB LIKE '".$fUnt."%' AND Referensi='".$gRef."' AND Tanggal<='".$gLaP."-12-31' 
	#	GROUP BY Referensi ORDER BY Referensi";
	#}
	#else 
	#{
		$nSQ = "SELECT 
		Referensi as A0, 
		Kd_UPB as A1, 
		Kd_Aset_108 as A2, 
		No_Register as A3, 
		Tanggal as A4, 
		IfNull(sum(Debet),0) as A5 
		FROM ta_kib_post_108".$mTS." WHERE Kd_UPB LIKE '".$fUnt."%' AND Referensi='".$gRef."' AND (Tanggal BETWEEN '".$gLaP."-01-01' AND '".$gLaP."-12-31') 
		GROUP BY Referensi ORDER BY Referensi";
	#}
	#echo $nSQ;
	$nRs = mysql_query($nSQ) or die(mysql_error());
	while ($nRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$Ref  = $nRo[0];
		$gUP  = $nRo[1];
		$KdA  = $nRo[2];
		$ReG  = $nRo[3];
		$TgL  = $nRo[4];
		$Thn  = substr($TgL,0,4);
		$Hrg  = $nRo[5];
		$NilP = $Hrg;
		
		$MiN  = 0;
		$MaX  = 0;
		$KdR  = checkMasaManfaat108($KdA,$DatabaseSB,$ConSB);
		if ($KdR)
		{
			$MiN = fGlobalNEW("min(tA)","ta_masa_manfaat_108","Kode",$KdR,"=","",$DatabaseSB,$ConSB,"");	//min prosentase penambahan
			$MaX = fGlobalNEW("max(tB)","ta_masa_manfaat_108","Kode",$KdR,"=","",$DatabaseSB,$ConSB,"");	//max prosentase penambahan
		}
		
		$KdU  = "";
		$PrOA = 0;
		$PrO  = 0;
		$UmR  = $gMsA;
		$UmRT = 0;	#tambah ms umur
		$UmRA = $UmR;	#umur awal
		$UmRK = ($gLaP-$Thn)+1;	#umur berkurang
		if ($UmRK>$UmRA){$UmRK=$UmRA;}
		$UmRS = $UmRA-$UmRK;	#sisa umur
		$NilBA= $NilP;
		
		$NilPK = 0;
		$NilBB = 0;
		if ($UmRA > 0){
			$NilPK  = floor(($NilP/$UmRA)*$UmRK);
			$NilPKT = $NilPK;
			$NilBB  = floor($NilBA-$NilPK);
		}
		$UrA = 'Nilai perolehan awal';
		$iG  = 1;
		insertDataTahunan($iG,$Ref,$gUP,$KdA,$ReG,$gLaP,$Thn,$TgL,$Hrg,$NilP,$KdU,$PrOA,$PrO,$UmR,$UmRT,$UmRA,$UmRK,$UmRS,$NilBA,$NilPK,$NilPKT,$NilBB,$UrA,$ExtR,$DatabaseSB,$ConSB);
	}
}

function ProsesDataLamaTahunan($AbiS,$fUnt,$gMsA,$gLaP,$gRef,$mTS,$ExtR,$DatabaseSB,$ConSB)
{
	$fUnt = substr($fUnt,0,11);
	
	mysql_select_db($DatabaseSB,$ConSB);
	$iG=1;
	$nSQR ="SELECT Referensi as A0, 
	Kd_UPB as A1,
	Kd_Aset_108 as A2,
	No_Register as A3, 
	Nilai_Perolehan as A4, 
	Nilai_Buku_Akhir as A5, 
	Umur_Sisa as A6,
	IndexData as A7,
	Penyusutan_Akumulasi as A8,
	Penyusutan as A9 
	FROM ta_kib_post_penyusutan_108 WHERE Kd_UPB LIKE '".$fUnt."%' AND Referensi='$gRef' AND PerLap='".($gLaP-1)."'";
	#echo $nSQ."<br>";
	$nRsR = mysql_query($nSQR) or die(mysql_error());
	while ($nRoR = mysql_fetch_array($nRsR, MYSQL_BOTH))
	{
		$Ref = $nRoR[0];
		$gUP = $nRoR[1];
		$KdA = $nRoR[2];
		$ReG = $nRoR[3];
		$NiL = $nRoR[4];
		$NiB = $nRoR[5];
		$UsI = $nRoR[6];
		$iG  = $nRoR[7]+1;
		$NilPKT = $nRoR[8];
		$NilPK = $nRoR[9];
		
		$Hrg = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108".$mTS,"Kd_UPB:Referensi:Tanggal:Tanggal",$gUP.":".$Ref.":".$gLaP."-01-01:".$gLaP."-12-31","=:=:>=:<=","",$DatabaseSB,$ConSB,"");
		
		$Thn = $gLaP;
		$TgL = $gLaP."-12-31";
		
		$KdU  = "";
		
		$UmR  = $gMsA;
		
		#Prosentase Awal
		$PrOA = 0;
		$PrO  = 0;
		$UmRT = 0;
		if ($Hrg>0 && $NiL>0){
			$PrOA = ($Hrg/$NiL)*100;
			$PrO  = fGlobalNEW("tB","ta_masa_manfaat_108","Kode:tA",$KdA.":".$PrOA,"=:<=","tB DESC LIMIT 0,1",$DatabaseSB,$ConSB,"");	//maksimal prosentase penambahan
			$UmRT = fGlobalNEW("tUmur","ta_masa_manfaat_108","Kode:tA",$KdA.":".$PrOA,"=:<=","tB DESC LIMIT 0,1",$DatabaseSB,$ConSB,"");	//maksimal prosentase penambahan
		}
		
		
		$UmRA = $UsI+$UmRT;	#umur awal
		
		$UmRK = 1;		#umur berkurang
		if ($UmRA==0){$UmRK = 0;}
		
		if ($UmRA>$gMsA){$UmRA=$gMsA;}
		
		$UmRS = $UmRA-$UmRK;	#sisa umur
		if ($UmRS < 0) {$UmRS=0;}
		$NilP = $NiL+$Hrg;
		$NilBA= $NiB+$Hrg;
		
		#$NilPK = 0;
		$NilBB = 0;
		if ($UmRA > 0)
		{
			if ($Hrg!=0)
			{
				$NilPK  = floor(($NilBA/$UmRA)*$UmRK);
				$NilPKT = floor($NilPKT + $NilPK);
				$NilBB  = floor($NilBA - $NilPK);
			}
			else if ($UsI==1)
			{
				$NilPK  = round(($NilBA/$UmRA)*$UmRK);
				$NilPKT = round($NilPKT + $NilPK);
				$NilBB  = round($NilBA - $NilPK);
			}
			else
			{
				$NilPK  = $NilPK;	#ambil ke beban tahun sebelumnya
				$NilPKT = floor($NilPKT + $NilPK);
				$NilBB  = floor($NilBA - $NilPK);
				#$NilPK  = ($NilBA/$UmRA)*$UmRK;
				#$NilPKT = $NilPKT + $NilPK;
				#$NilBB  = $NilBA - $NilPK;
			}
		}
		
		$UrA = 'Atribusi';
		if ($AbiS=='YA')
		{
			$UmRS  = $UmRS+$UmRK;
			$UmRK  = 0;
			$NilPKT= $NilPKT-$NilPK;
			$NilBB = $NilBB+$NilPK;
			$NilPK = 0;
		}
		
		insertDataTahunan($iG,$Ref,$gUP,$KdA,$ReG,$gLaP,$Thn,$TgL,$Hrg,$NilP,$KdU,$PrOA,$PrO,$UmR,$UmRT,$UmRA,$UmRK,$UmRS,$NilBA,$NilPK,$NilPKT,$NilBB,$UrA,$ExtR,$DatabaseSB,$ConSB);
	}
}

function insertDataTahunan($iG,$Ref,$gUP,$KdA,$ReG,$LaP,$Thn,$Tgl,$Hrg,$NilP,$KdU,$PrOA,$PrO,$UmR,$UmRT,$UmRA,$UmRK,$UmRS,$NilBA,$NilPK,$NilPKT,$NilBB,$UrA,$ExtR,$DatabaseSB,$ConSB)
{
	mysql_select_db($DatabaseSB,$ConSB);
	if ($iG==""){$iG=0;}
	if ($PrO==""){$PrO=0;}
	if ($PrOA==""){$PrOA=0;}
	if ($UmRT==""){$UmRT=0;}
	if ($NilPKT==""){$NilPKT=0;}
	
	/***********/
	if ($NilBA==0){$NilPK=0;}	//merubah nilai penyusutan per tahun
	/***********/
	
	$nSQI = "INSERT INTO ta_kib_post_penyusutan_108 SET 
	Referensi='$Ref',
	IndexData='$iG',
	Kd_UPB='$gUP',
	Kd_Aset_108='$KdA',
	No_Register='$ReG',
	PerLap='$LaP',
	Tahun='$Thn',
	Tanggal='$Tgl',
	
	Harga='$Hrg',
	Nilai_Perolehan='$NilP',
	Kd_Umur='$KdU',
	Tahun_Akhir='$LaP',
	Prosentase_Awal='$PrOA',
	Prosentase='$PrO',
	Umur='$UmR',
	Umur_Tambah='$UmRT',
	Umur_Awal='$UmRA',
	Umur_Terpakai='$UmRK',
	Umur_Sisa='$UmRS',
	Nilai_Buku_Awal='$NilBA',
	Penyusutan='$NilPK',
	Penyusutan_Akumulasi='$NilPKT',
	Nilai_Buku_Akhir='$NilBB',
	Uraian='$UrA',
	extracom='$ExtR'";
	if ($KdA!='') {
		$nRsR = mysql_query($nSQI) or die(mysql_error());
	}
}

?>