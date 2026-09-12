<?
function ProsesDataBaruBulanan($AbiS,$fUnt,$gMsA,$gLaP,$gRef,$mTS,$ExtR,$DatabaseSB,$ConSB)
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
		$UmRb = $gMsA*12;
		$UmRT = 0;		#tambah ms umur
		$UmRA = $UmR;	#umur awal
		$UmRAb= $UmRb;
		
		$UmRK  = ($gLaP-$Thn)+1;		#umur berkurang
		if ($UmRK>$UmRA){$UmRK=$UmRA;}
		
		$TglB  = $gLaP."-12-31";
		
		if ($gLaP < 2013)
		{
			$UmRKb = 12;
		}
		else
		{
			$UmRKb = HitJmlBulan($TgL,$TglB,"")+1;	#+1 untuk menghabiskan umur
		}
		
		$UmRS = $UmRA -$UmRK;	#sisa umur
		$UmRSb= $UmRAb-$UmRKb;	#sisa umur
		
		$NilBA = $NilP;
		$NilBAb= $NilP;
		
		$NilPK = 0;
		$NilBB = 0;
		if ($UmRA > 0){
			#$NilPK  = floor(($NilP/$UmRA)*$UmRK);
			$NilPK  = round(($NilP/$UmRA)*$UmRK,2);
			$NilPKT = $NilPK;
			#$NilBB  = floor($NilBA-$NilPK);
			$NilBB  = round($NilBA-$NilPK,2);
		}
		
		if ($UmRAb > 0){
			#$NilPKb  = floor(($NilP/$UmRAb)*$UmRKb);
			$NilPKb  = round(($NilP/$UmRAb)*$UmRKb,2);
			$NilPKTb = $NilPKb;
			#$NilBBb  = floor($NilBAb-$NilPKb);
			$NilBBb  = round($NilBAb-$NilPKb,2);
		}
		
		$UrA = 'Nilai perolehan awal';
		$iG  = 1;
		insertDataBulanan($iG,$Ref,$gUP,$KdA,$ReG,$gLaP,$Thn,$TgL,$Hrg,$NilP,$KdU,$PrOA,$PrO,$UmR,$UmRb,$UmRT,'0',$UmRA,$UmRAb,$UmRK,$UmRKb,$UmRS,$UmRSb,$NilBA,$NilBAb,$NilPK,$NilPKb,$NilPKT,$NilPKTb,$NilBB,$NilBBb,$UrA,$ExtR,$DatabaseSB,$ConSB);
	}
}

function ProsesDataLamaBulanan($AbiS,$fUnt,$gMsA,$gLaP,$gRef,$mTS,$ExtR,$DatabaseSB,$ConSB)
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
	Penyusutan as A9,
	
	Nilai_Buku_Akhir as A10, 
	Umur_Sisa as A11,
	Penyusutan_Akumulasi as A12,
	Penyusutan as A13,
	Umur_Terpakai as A14 
	
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
		
		$NiB  = $nRoR[5];
		$NiBb = $nRoR[10];
		
		#$Nul='N';
		#if ($NiBb==0)
		#{
			#Jika ada atribusi dan nilai buku akhir 0, maka ambil nilai buku tahun-2
		#	$NiBb = fGlobalNEW("Nilai_Buku_Akhir","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap",$fUnt."%:".$gRef.":".($gLaP-2),"LIKE:=:=","",$DatabaseSB,$ConSB,"");	//maksimal prosentase penambahan
		#	$Null = 'Y';
		#}
		
		$UsI = $nRoR[6];
		$UsIb= $nRoR[11];
		
		$iG  = $nRoR[7]+1;
		
		$NilPKT = $nRoR[8];
		$NilPKTb= $nRoR[12];
		
		$NilPK = $nRoR[9];
		$NilPKb= 0;
		if ($nRoR[13]!=0 && $nRoR[14]!=0)
		{
			$NilPKb= $nRoR[13]/$nRoR[14];
		}
		$Hrg = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108".$mTS,"Kd_UPB:Referensi:Tanggal:Tanggal",$gUP.":".$Ref.":".$gLaP."-01-01:".$gLaP."-12-31","=:=:>=:<=","",$DatabaseSB,$ConSB,"");
		
		$Thn = $gLaP;
		$TgL = $gLaP."-12-31";
		
		$KdU  = "";
		
		$gMsA = $gMsA;
		$gMsAb= $gMsA*12;
		
		$UmR  = $gMsA;
		$UmRb = $gMsA*12;
		
		$PrOA = 0;
		if ($Hrg>0 && $NiBb==0)
		{
			$PrOA = 100;
		}
		else if ($Hrg>0 && $NiBb>0)
		{
			$PrOA = ($Hrg/$NiBb)*100;
		}
		
		$PrO  = 0;
		$UmRT = 0;
		$UmRTb= 0;
		
		if ($PrOA > 0)
		{
			$PrO  = fGlobalNEW("tB","ta_masa_manfaat_108","Kode:tA",$KdA.":".$PrOA,"=:<=","tB DESC LIMIT 0,1",$DatabaseSB,$ConSB,"");		//maksimal prosentase penambahan
			$UmRT = fGlobalNEW("tUmur","ta_masa_manfaat_108","Kode:tA",$KdA.":".$PrOA,"=:<=","tB DESC LIMIT 0,1",$DatabaseSB,$ConSB,"");	//maksimal prosentase penambahan
			$UmRTb= $UmRT*12;
		}
		
		$UmRA = $UsI +$UmRT;	#umur awal
		$UmRAb= $UsIb+$UmRTb;	#umur awal bulan
		
		$UmRK = 1;			#umur berkurang
		$UmRKb= $UmRK*12;	#umur berkurang bulan
		
		if ($UmRA==0){$UmRK = 0;}
		if ($UmRAb==0){$UmRKb = 0;}
		
		if ($UmRA>$gMsA){$UmRA=$gMsA;}
		if ($UmRAb>$gMsAb){$UmRAb=$gMsAb;}
		
		$UmRS = $UmRA -$UmRK;	#sisa umur
		$UmRSb= $UmRAb-$UmRKb;	#sisa umur bulan
		
		if ($UmRS < 0) {$UmRS=0;}
		if ($UmRSb < 0) {$UmRSb=0;}
		
		$NilP  = $NiL +$Hrg;
		$NilBA = $NiB +$Hrg;
		$NilBAb= $NiBb+$Hrg;
		
		$NilBB = 0;
		if ($UmRA > 0)
		{
			if ($Hrg!=0)
			{
				#$NilPK  = floor(($NilBA/$UmRA)*$UmRK);
				#$NilPKT = floor($NilPKT + $NilPK);
				#$NilBB  = floor($NilBA - $NilPK);
				
				$NilPK  = round(($NilBA/$UmRA)*$UmRK,2);
				$NilPKT = round($NilPKT + $NilPK,2);
				$NilBB  = round($NilBA - $NilPK,2);
			}
			else if ($UsI==1)
			{
				$NilPK  = round(($NilBA/$UmRA)*$UmRK,2);
				$NilPKT = round($NilPKT + $NilPK,2);
				$NilBB  = round($NilBA - $NilPK,2);
			}
			else
			{
				$NilPK  = $NilPK;	#ambil ke beban tahun sebelumnya
				#$NilPKT = floor($NilPKT + $NilPK);
				#$NilBB  = floor($NilBA - $NilPK);
				
				$NilPKT = round($NilPKT + $NilPK,2);
				$NilBB  = round($NilBA - $NilPK,2);
			}
		}
		
		$NilBBb = 0;
		if ($UmRAb > 0)
		{
			if ($Hrg!=0)
			{
				#$NilPKb  = floor(($NilBAb/$UmRAb)*$UmRKb);
				#$NilPKTb = floor($NilPKTb + $NilPKb);
				#$NilBBb  = floor($NilBAb - $NilPKb);
				
				$NilPKb  = round(($NilBAb/$UmRAb)*$UmRKb,2);
				$NilPKTb = round($NilPKTb + $NilPKb,2);
				$NilBBb  = round($NilBAb - $NilPKb,2);
			}
			else if ($UsIb==1)
			{
				$NilPKb  = round(($NilBAb/$UmRAb)*$UmRKb,2);
				$NilPKTb = round($NilPKTb + $NilPKb,2);
				$NilBBb  = round($NilBAb - $NilPKb,2);
			}
			else
			{
				$NilPKb  = $NilPKb*$UmRKb;	#ambil ke beban tahun sebelumnya
				#$NilPKTb = floor($NilPKTb + $NilPKb);
				#$NilBBb  = floor($NilBAb - $NilPKb);
				
				$NilPKTb = round($NilPKTb + $NilPKb,2);
				$NilBBb  = round($NilBAb - $NilPKb,2);
			}
		}
		else
		{
			$NilPKb = 0;
		}
		
		$UrA = 'Atribusi';
		if ($AbiS=='YA')
		{
			$UmRS  = $UmRS +$UmRK;
			$UmRSb = $UmRSb+$UmRKb;
			
			$UmRK  = 0;
			$UmRKb = 0;
			
			$NilPKT = $NilPKT - $NilPK;		#s/d 2024
			if ($NilBAb!=0)
			{
				$NilPKTb= $NilPKTb - $NilPKb;	#s/d 2024
			}
			else
			{
				$NilPKTb= $NilPKTb;				#m/d 2030
			}
			
			$NilBB = $NilBB +$NilPK;		#s/d 2024
			#$NilBBb= $NilBBb+$NilPKb; 		#s/d 2024
			$NilBBb= $NilBAb;				#m/d 2030
			
			$NilPK = 0;
			$NilPKb= 0;
		}
		
		insertDataBulanan($iG,$Ref,$gUP,$KdA,$ReG,$gLaP,$Thn,$TgL,$Hrg,$NilP,$KdU,$PrOA,$PrO,$UmR,$UmRb,$UmRT,$UmRTb,$UmRA,$UmRAb,$UmRK,$UmRKb,$UmRS,$UmRSb,$NilBA,$NilBAb,$NilPK,$NilPKb,$NilPKT,$NilPKTb,$NilBB,$NilBBb,$UrA,$ExtR,$DatabaseSB,$ConSB);
	}
}

function insertDataBulanan($iG,$Ref,$gUP,$KdA,$ReG,$LaP,$Thn,$Tgl,$Hrg,$NilP,$KdU,$PrOA,$PrO,$UmR,$UmRb,$UmRT,$UmRTb,$UmRA,$UmRAb,$UmRK,$UmRKb,$UmRS,$UmRSb,$NilBA,$NilBAb,$NilPK,$NilPKb,$NilPKT,$NilPKTb,$NilBB,$NilBBb,$UrA,$ExtR,$DatabaseSB,$ConSB)
{
	mysql_select_db($DatabaseSB,$ConSB);
	if ($iG==""){$iG=0;}
	if ($PrO==""){$PrO=0;}
	if ($PrOA==""){$PrOA=0;}
	if ($PrOA>100){$PrOA=100;}
	if ($UmRT==""){$UmRT=0;}
	if ($NilPKT==""){$NilPKT=0;}
	
	/***********/
	if ($NilBA==0){$NilPK=0;}	//merubah nilai penyusutan per tahun
	/***********/
	
	/*
	if ($NilBBb == 0 && $NilBAb==0)
	{
		$NilPKb  = 0;
	}
	else 
	*/
	if ($NilBBb < 10)
	{
		$NilPKb  = $NilPKb+$NilBBb;
		$NilPKTb = $NilPKTb+$NilBBb;
		$NilBBb  = 0;
	}
	
	if ($UmRKb > $UmRAb){$UmRKb = $UmRAb;}
	
	if ($NilPKb==''){$NilPKb=0;}
	if ($NilPKTb==''){$NilPKTb=0;}
	if ($NilBBb==''){$NilBBb=0;}
	
	
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
	Umur='$UmRb',
	Umur_Tambah='$UmRTb',
	Umur_Awal='$UmRAb',
	Umur_Terpakai='$UmRKb',
	Umur_Sisa='$UmRSb',
	Nilai_Buku_Awal='$NilBAb',
	Penyusutan='$NilPKb',
	Penyusutan_Akumulasi='$NilPKTb',
	Nilai_Buku_Akhir='$NilBBb',
	
	Uraian='$UrA',
	extracom='$ExtR'";
	#echo $nSQI."<br>";
	if ($KdA!='') {
		$nRsR = mysql_query($nSQI) or die(mysql_error());
	}
}

?>