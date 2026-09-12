<?php
require('Connection.php');
require('CheckLogin.php');
require('FileFunction.php');

extract($_POST);
$Smp    = $_POST['Proses'];
$gUnt   = $_POST['fUnt'];
$gThn   = $_POST['fThn'];

$ImportFromKibOld           = "Ya";		#Dari KIB lama
$Ta_kib_postINV             = "Yax";	#Penambahan Nilai
$ta_kib_108_back_sdhada2020 = "YaX";	#Dari tabel ta_kib_108_back_sdhada2020
$ProsesYgMerger             = "YaX";	#Data Merger History

if ($Smp=="Proses")
{
	if ($Ta_kib_postINV=="Ya")
	{
		$iG = 0;
		$SQ ="SHOW Fields FROM ta_kib_post";
		$nR = mysql_query($SQ) or die(mysql_error());
		while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
		{
			if ($mR['Field']!='ImportFrom'){
				$iG++;
				$nmF[$iG] = $mR['Field'];
			}
		}
		
		$iG=$iG-1;
		
		$SQL ="SELECT * FROM ta_kib_post WHERE kd_upb LIKE '".$gUnt.".%' AND Crit='INV' AND tanggal like '2020-%-%' AND TarikKeTakKib108='N' ORDER BY IDT LIMIT 0,100";
		$nRo = mysql_query($SQL) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRo, MYSQL_BOTH))
		{
			for ($iA=2; $iA<=$iG; $iA++)
			{
				if ($iA==2){
					$gFLD = $nmF[$iA];
					$gVAL = "'".$mRo[$nmF[$iA]]."'";
				}
				else{	# > 2
					$gFLD.= ", ".$nmF[$iA];
					$gVAL.= ", '".mysql_real_escape_string($mRo[$nmF[$iA]])."'";
				}
			}
			
			$gFLD.= ", ImportFrom";
			$gVAL.= ", 'ta_kib_post IDT->".$mRo['IDT']."'";
			
			$SQG = "INSERT INTO ta_kib_post_108 (".$gFLD.") values(".$gVAL.")";
			$rsG = mysql_query($SQG) or die(mysql_error());
			
			$SQ ="UPDATE ta_kib_post SET TarikKeTakKib108='Y' WHERE IDT='".$mRo['IDT']."'";
			$nR = mysql_query($SQ);
		}
	}
	
	if ($ta_kib_108_back_sdhada2020=="Ya")
	{
		$iG = 0;
		$SQ ="SHOW Fields FROM ta_kib_108";
		$nR = mysql_query($SQ) or die(mysql_error());
		while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
		{
			if ($mR['Field']!='ImportFrom'){
				$iG++;
				$nmF[$iG] = $mR['Field'];
			}
		}
		
		$iG=$iG-1;
		
		$SQL ="SELECT * FROM ta_kib_108_back_sdhada2020 WHERE kd_upb LIKE '".$gUnt.".%' AND tgl_perolehan like '2020-%-%' AND isNull(ImportFrom) AND TarikKeTakKib108='N' ORDER BY IDT LIMIT 0,3000";
		$nRo = mysql_query($SQL) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRo, MYSQL_BOTH))
		{
			for ($iA=2; $iA<=$iG; $iA++)
			{
				if ($iA==2){
					if ($nmF[$iA]=='Referensi' || $nmF[$iA]=='referensi')
					{
						$gFLD = $nmF[$iA];
						
						#Cek referensi:
						$eCeK = fGlobal("IDT","ta_kib_108","referensi",$mRo[$nmF[$iA]],"=","","");
						if ($eCeK==''){
							$gVAL = "'".$mRo[$nmF[$iA]]."'";
							$PostRf = $mRo[$nmF[$iA]];
						}
						else
						{
							#Buat baru referensi:
							$qRef = substr($mRo[$nmF[$iA]],0,3);
							$NewK = fGlobal("IfNull(max(referensi),0)","ta_kib_108","referensi",$qRef.".%","LIKE","","");
							$NewB = fGlobal("IfNull(max(referensi),0)","ta_kib_108_mutasi","referensi",$qRef.".%","LIKE","","");
							$NewC = fGlobal("IfNull(max(referensi),0)","ta_kib_108_merger_his","referensi",$qRef.".%","LIKE","","");
							
							$NewK = (int)substr($NewK,-11,11);
							$NewB = (int)substr($NewB,-11,11);
							$NewC = (int)substr($NewC,-11,11);
							if ($NewB > $NewK){$NewK = $NewB;}
							if ($NewC > $NewK){$NewK = $NewC;}
							$NewK = $NewK + 1;
							$NewRefKIB = $qRef.".".fMakeReferensi($NewK,11);
							
							$gVAL = "'".$NewRefKIB."'";
							$PostRf = $NewRefKIB;
						}
					}
					else{
						$gFLD = $nmF[$iA];
						$gVAL = "'".$mRo[$nmF[$iA]]."'";
					}
				}
				else{	# > 2
					if ($nmF[$iA]=='Kd_Tanah1' || $nmF[$iA]=='Kd_Tanah2' || $nmF[$iA]=='Kd_Tanah3' || $nmF[$iA]=='Kd_Tanah4' || $nmF[$iA]=='Kd_Tanah5' || $nmF[$iA]=='Kode_Tanah_Old')
					{
						$gFLD.= ", ".$nmF[$iA];
						$gVAL.= ", '0'";
					}
					else if ($nmF[$iA]=='Post' || $nmF[$iA]=='post')
					{
						$gFLD.= ", ".$nmF[$iA];
						$gVAL.= ", 'N'";
					}
					else{
						$gFLD.= ", ".$nmF[$iA];
						$gVAL.= ", '".mysql_real_escape_string($mRo[$nmF[$iA]])."'";
					}
				}
			}
			
			$gFLD.= ", ImportFrom";
			$gVAL.= ", 'ta_kib_108_back_sdhada2020 IDT->".$mRo['IDT']."'";
			
			$SQG = "INSERT INTO ta_kib_108 (".$gFLD.") values(".$gVAL.")";
			$rsG = mysql_query($SQG) or die(mysql_error());
			
			$SQ ="UPDATE ta_kib_108_back_sdhada2020 SET TarikKeTakKib108='Y' WHERE IDT='".$mRo['IDT']."'";
			$nR = mysql_query($SQ);
			
			#POSTING
			$nSQA= "SELECT Referensi as A0, Ref_Group as A1, No_Register as A2, Kd_UPB as A3, Kd_Aset as A4, Kd_Aset_108 as A5, Tgl_Perolehan as A6, Harga as A7, No_Pengadaan as A8 
			FROM ta_kib_108 WHERE referensi='".$PostRf."'";
			$nRsA= mysql_query($nSQA) or die(mysql_error());
			while ($mRoA = mysql_fetch_array($nRsA, MYSQL_BOTH))
			{
				$mRoRf = $mRoA[0];
				$gCeK = fGlobalNEW("IDT","ta_kib_post_108","Referensi",$mRoRf,"=","",DatabaseSB,$ConSB,"");
				if ($gCeK==""){
					$gREF = $mRoA[0];
					$gGRP = $mRoA[1];
					$gREG = $mRoA[2];
					$gUPB = $mRoA[3];
					$gAST = $mRoA[4];
					$g108 = $mRoA[5];
					$gTGL = $mRoA[6];
					$gNIL = $mRoA[7];
					$gNOM = $mRoA[8];
					
					$gURA = "Saldo awal (nilai perolehan)";
					$gKTR = "";
					
					PostingFromKIB($gREF,$gGRP,$gREG,$gUPB,$gAST,$g108,$gTGL,$gURA,$gNIL,$gNOM,$gKTR,DatabaseSB,$ConSB);
				}
			}
		}
	}
	
	if ($ImportFromKibOld=='Ya')
	{
		$gFLD="";
		$gVAL="";
		for ($i=7; $i<=7; $i++)
		{
			$tb = "ta_kib_".fNmHuruf($i);
			$iG = 0;
			$SQ ="SHOW Fields FROM ".$tb;
			$nR = mysql_query($SQ) or die(mysql_error());
			while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
			{
				$iG++;
				$nmF[$iG] = $mR['Field'];
			}
			
			$iG=$iG-1;
			
			#$SQL ="SELECT * FROM ".$tb." WHERE kd_upb LIKE '".$gUnt."%' AND TarikKeTakKib108='N' AND tgl_perolehan LIKE '2020-%-%' AND No_Pengadaan<>'' ORDER BY IDT LIMIT 0,1000";
			$SQL ="SELECT * FROM ".$tb." WHERE kd_upb LIKE '".$gUnt."%' AND TarikKeTakKib108='N' AND tgl_perolehan LIKE '%-%-%' ORDER BY IDT LIMIT 0,1000";
			$nRo = mysql_query($SQL) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRo, MYSQL_BOTH))
			{
				for ($iA=2; $iA<=$iG; $iA++)
				{
					if ($iA==2){
						if ($nmF[$iA]=='Referensi' || $nmF[$iA]=='referensi')
						{
							#$gFLD.= ", ".$nmF[$iA];
							$gFLD = $nmF[$iA];
							
							#Cek referensi:
							$eCeK = fGlobal("IDT","ta_kib_108","referensi",$mRo[$nmF[$iA]],"=","","");
							if ($eCeK==''){
								$gVAL = "'".$mRo[$nmF[$iA]]."'";
								$PostRf = $mRo[$nmF[$iA]];
							}
							else
							{
								#Buat baru referensi:
								$qRef = substr($mRo[$nmF[$iA]],0,3);
								$NewK = fGlobal("IfNull(max(referensi),0)","ta_kib_108","referensi",$qRef.".%","LIKE","","");
								$NewB = fGlobal("IfNull(max(referensi),0)","ta_kib_108_mutasi","referensi",$qRef.".%","LIKE","","");
								$NewC = fGlobal("IfNull(max(referensi),0)","ta_kib_108_merger_his","referensi",$qRef.".%","LIKE","","");
								
								$NewK = (int)substr($NewK,-11,11);
								$NewB = (int)substr($NewB,-11,11);
								$NewC = (int)substr($NewC,-11,11);
								if ($NewB > $NewK){$NewK = $NewB;}
								if ($NewC > $NewK){$NewK = $NewC;}
								$NewK = $NewK + 1;
								$NewRefKIB = $qRef.".".fMakeReferensi($NewK,11);
								
								$gVAL = "'".$NewRefKIB."'";
								$PostRf = $NewRefKIB;
							}
						}
						else{
							$gFLD = $nmF[$iA];
							$gVAL = "'".$mRo[$nmF[$iA]]."'";
						}
					}
					else{	# > 2
						if ($nmF[$iA]=='Kd_Tanah1' || $nmF[$iA]=='Kd_Tanah2' || $nmF[$iA]=='Kd_Tanah3' || $nmF[$iA]=='Kd_Tanah4' || $nmF[$iA]=='Kd_Tanah5' || $nmF[$iA]=='Kode_Tanah_Old')
						{
							$gFLD.= ", ".$nmF[$iA];
							$gVAL.= ", '0'";
						}
						else if ($nmF[$iA]=='Post' || $nmF[$iA]=='post')
						{
							$gFLD.= ", ".$nmF[$iA];
							$gVAL.= ", 'N'";
						}
						else{
							$gFLD.= ", ".$nmF[$iA];
							$gVAL.= ", '".mysql_real_escape_string($mRo[$nmF[$iA]])."'";
						}
					}
				}
				
				$gFLD.= ", ImportFrom";
				$gVAL.= ", '".$tb." IDT->".$mRo['IDT']."'";
				
				$SQG = "INSERT INTO ta_kib_108 (".$gFLD.") values(".$gVAL.")";
				$rsG = mysql_query($SQG) or die(mysql_error());
				
				$SQ ="UPDATE ".$tb." SET TarikKeTakKib108='Y' WHERE IDT='".$mRo['IDT']."'";
				$nR = mysql_query($SQ);
				
				#POSTING
				$nSQA= "SELECT Referensi as A0, Ref_Group as A1, No_Register as A2, Kd_UPB as A3, Kd_Aset as A4, Kd_Aset_108 as A5, Tgl_Perolehan as A6, Harga as A7, No_Pengadaan as A8 
				FROM ta_kib_108 WHERE referensi='".$PostRf."'";
				$nRsA= mysql_query($nSQA) or die(mysql_error());
				while ($mRoA = mysql_fetch_array($nRsA, MYSQL_BOTH))
				{
					$mRoRf = $mRoA[0];
					$gCeK = fGlobalNEW("IDT","ta_kib_post_108","Referensi",$mRoRf,"=","",DatabaseSB,$ConSB,"");
					if ($gCeK==""){
						$gREF = $mRoA[0];
						$gGRP = $mRoA[1];
						$gREG = $mRoA[2];
						$gUPB = $mRoA[3];
						$gAST = $mRoA[4];
						$g108 = $mRoA[5];
						$gTGL = $mRoA[6];
						$gNIL = $mRoA[7];
						$gNOM = $mRoA[8];
						
						$gURA = "Saldo awal (nilai perolehan)";
						$gKTR = "";
						
						PostingFromKIB($gREF,$gGRP,$gREG,$gUPB,$gAST,$g108,$gTGL,$gURA,$gNIL,$gNOM,$gKTR,DatabaseSB,$ConSB);
					}
				}
				#
				
			}
		}
	}
	
	if ($ProsesYgMerger == 'Ya')
	{
		/**/
		$tb = "ta_kib_a_merger_his";
		$iG = 0;
		$SQ ="SHOW Fields FROM ".$tb;
		$nR = mysql_query($SQ) or die(mysql_error());
		while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
		{
			$iG++;
			$nmF[$iG] = $mR['Field'];
		}
		
		$iG=$iG-1;
		
		$SQL ="SELECT * FROM ".$tb." WHERE kd_upb LIKE '".$gUnt."%' AND TarikKeTakKib108='N' ORDER BY IDT LIMIT 0,5000";
		$nRo = mysql_query($SQL) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRo, MYSQL_BOTH))
		{
			for ($iA=2; $iA<=$iG; $iA++)
			{
				
				if ($iA==2){
					$gFLD = $nmF[$iA];
					$gVAL = "'".mysql_real_escape_string($mRo[$nmF[$iA]])."'";
				}
				else{
					if ($nmF[$iA]=='Kd_Tanah1' || $nmF[$iA]=='Kd_Tanah2' || $nmF[$iA]=='Kd_Tanah3' || $nmF[$iA]=='Kd_Tanah4' || $nmF[$iA]=='Kd_Tanah5' || $nmF[$iA]=='Kode_Tanah_Old')
					{
						$gFLD.= ", ".$nmF[$iA];
						$gVAL.= ", '0'";
					}
					else{
						$gFLD.= ", ".$nmF[$iA];
						$gVAL.= ", '".mysql_real_escape_string($mRo[$nmF[$iA]])."'";
					}
				}
			}
			
			$gFLD.= ", ImportFrom";
			$gVAL.= ", '".$tb." IDT->".$mRo['IDT']."'";
			
			$SQG = "INSERT INTO ta_kib_108_merger_his (".$gFLD.") values(".$gVAL.")";
			$rsG = mysql_query($SQG) or die(mysql_error());
			
			$SQ ="UPDATE ".$tb." SET TarikKeTakKib108='Y' WHERE IDT='".$mRo['IDT']."'";
			$nR = mysql_query($SQ);
		}
		/**/
		
		/**/
		$tb = "ta_kib_c_merger_his";
		$iG = 0;
		$SQ ="SHOW Fields FROM ".$tb;
		$nR = mysql_query($SQ) or die(mysql_error());
		while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
		{
			$iG++;
			$nmF[$iG] = $mR['Field'];
		}
		
		$iG=$iG-1;
		
		$SQL ="SELECT * FROM ".$tb." WHERE kd_upb LIKE '".$gUnt."%' AND TarikKeTakKib108='N' ORDER BY IDT LIMIT 0,5000";
		$nRo = mysql_query($SQL) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRo, MYSQL_BOTH))
		{
			for ($iA=2; $iA<=$iG; $iA++)
			{
				
				if ($iA==2){
					$gFLD = $nmF[$iA];
					$gVAL = "'".mysql_real_escape_string($mRo[$nmF[$iA]])."'";
				}
				else{
					if ($nmF[$iA]=='Kd_Tanah1' || $nmF[$iA]=='Kd_Tanah2' || $nmF[$iA]=='Kd_Tanah3' || $nmF[$iA]=='Kd_Tanah4' || $nmF[$iA]=='Kd_Tanah5' || $nmF[$iA]=='Kode_Tanah_Old')
					{
						$gFLD.= ", ".$nmF[$iA];
						$gVAL.= ", '0'";
					}
					else{
						$gFLD.= ", ".$nmF[$iA];
						$gVAL.= ", '".mysql_real_escape_string($mRo[$nmF[$iA]])."'";
					}
				}
			}
			
			$gFLD.= ", ImportFrom";
			$gVAL.= ", '".$tb." IDT->".$mRo['IDT']."'";
			
			$SQG = "INSERT INTO ta_kib_108_merger_his (".$gFLD.") values(".$gVAL.")";
			$rsG = mysql_query($SQG) or die(mysql_error());
			
			$SQ ="UPDATE ".$tb." SET TarikKeTakKib108='Y' WHERE IDT='".$mRo['IDT']."'";
			$nR = mysql_query($SQ);
		}
		/**/
		
		/**/
		$tb = "ta_kib_d_merger_his";
		$iG = 0;
		$SQ ="SHOW Fields FROM ".$tb;
		$nR = mysql_query($SQ) or die(mysql_error());
		while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
		{
			$iG++;
			$nmF[$iG] = $mR['Field'];
		}
		
		$iG=$iG-1;
		
		$SQL ="SELECT * FROM ".$tb." WHERE kd_upb LIKE '".$gUnt."%' AND TarikKeTakKib108='N' ORDER BY IDT LIMIT 0,5000";
		$nRo = mysql_query($SQL) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRo, MYSQL_BOTH))
		{
			for ($iA=2; $iA<=$iG; $iA++)
			{
				
				if ($iA==2){
					$gFLD = $nmF[$iA];
					$gVAL = "'".mysql_real_escape_string($mRo[$nmF[$iA]])."'";
				}
				else{
					if ($nmF[$iA]=='Kd_Tanah1' || $nmF[$iA]=='Kd_Tanah2' || $nmF[$iA]=='Kd_Tanah3' || $nmF[$iA]=='Kd_Tanah4' || $nmF[$iA]=='Kd_Tanah5' || $nmF[$iA]=='Kode_Tanah_Old')
					{
						$gFLD.= ", ".$nmF[$iA];
						$gVAL.= ", '0'";
					}
					else{
						$gFLD.= ", ".$nmF[$iA];
						$gVAL.= ", '".mysql_real_escape_string($mRo[$nmF[$iA]])."'";
					}
				}
			}
			
			$gFLD.= ", ImportFrom";
			$gVAL.= ", '".$tb." IDT->".$mRo['IDT']."'";
			
			$SQG = "INSERT INTO ta_kib_108_merger_his (".$gFLD.") values(".$gVAL.")";
			$rsG = mysql_query($SQG) or die(mysql_error());
			
			$SQ ="UPDATE ".$tb." SET TarikKeTakKib108='Y' WHERE IDT='".$mRo['IDT']."'";
			$nR = mysql_query($SQ);
		}
		/**/
	}
	/****************/
	
	$URL="TarikDataAsetKe108_Mid.php?gUnt=".$gUnt."&gThn=".$gThn."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}
else if ($Smp=="Close")
{
	?>
	<script LANGUAGE="JavaScript">            
	this.setTimeout("self.close()",0)
	</script>
	<?php
}
else
{
	$URL="TarikDataAsetKe108_Mid.php?gUnt=".$gUnt."&gThn=".$gThn."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}
?>

<?php require('Connection_Close.php');?>
