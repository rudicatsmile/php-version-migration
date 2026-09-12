<?
require('Connection.php');
require "FileFunction.php";
require "CheckLogin.php";
extract($_POST);
extract($_GET);
if ($Simpan=="Save") 
{
	if ($rIDT!="" && $rIDT2!="")
	{
		#$rUID = fGlobalNEW("User_ID","ta_user_log","IDT",$IdL,"=","",DatabaseSB,$ConSB,"");
		if ($CeBOX=="ON") {$rBX="YA";} else {$rBX="TIDAK";}
		
		//Data Pengganti
		$NewRf = fGlobalNEW("Referensi","ta_kib_108","IDT",$rIDT2,"=","",DatabaseSB,$ConSB,"");
		$NewKd = fGlobalNEW("Kd_Aset_108","ta_kib_108","IDT",$rIDT2,"=","",DatabaseSB,$ConSB,"");
		$NewK7 = fGlobalNEW("Kd_Aset","ta_kib_108","IDT",$rIDT2,"=","",DatabaseSB,$ConSB,"");
		$NewRg = fGlobalNEW("No_Register","ta_kib_108","IDT",$rIDT2,"=","",DatabaseSB,$ConSB,"");
		$NeUpb = fGlobalNEW("Kd_UPB","ta_kib_108","IDT",$rIDT2,"=","",DatabaseSB,$ConSB,"");
		//
		
		$gKeT = fGlobalNEW("Keterangan","ta_kib_108","IDT",$rIDT,"=","",DatabaseSB,$ConSB,"");
		$gRef = fGlobalNEW("Referensi","ta_kib_108","IDT",$rIDT,"=","",DatabaseSB,$ConSB,"");
		$gSkP = fGlobalNEW("Kd_UPB","ta_kib_108","IDT",$rIDT,"=","",DatabaseSB,$ConSB,"");
		$NewTg= fGlobalNEW("Tgl_Perolehan","ta_kib_108","IDT",$rIDT,"=","",DatabaseSB,$ConSB,"");
		
		$rNaM = fGlobalNEW("Nm_Aset","ta_kib_108","IDT",$rIDT,"=","",DatabaseSB,$ConSB,"");
		if ($rNaM=="") {$rNaM = fGlobalNEW("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$NewKd,"=","",DatabaseSB,$ConSB,"");}
		if ($gKeT!=""){
			$rNaM = $rNaM."/".$gKeT;
		}
		
		
		if ($gRef!="" && $NewRf!="")
		{
			$nSQ = "SELECT IDT, Crit, Keterangan, Tmbh_Ms_Manfaat, Uraian FROM ta_kib_post_108 WHERE Referensi='$gRef' AND Kd_UPB LIKE '".substr($gSkP,0,11)."%' ORDER BY IDT";
			#echo $nSQ."<br>";
			#return false;
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$gID = $mRo[0];
				$gCR = $mRo[1];
				$gBX = $mRo[3];
				$gKD = $mRo[5];
				
				if ($gCR=="SLD") 
				{
					$gUR = $gKeT; 
					$gMP=$rBX;
				}
				else 
				{
					$gUR = $mRo[2]; 
					$gMP=$gBX;
					if ($gUR=="") {$gUR=$mRo[4];}
				}
				
				if ($gID)
				{
					$gUR = atasiKutif($gUR);
					$SW="UPDATE ta_kib_post_108 SET 
					Referensi='$NewRf', 
					Tanggal_BAST='$NewTg', 
					Kd_Aset='$NewK7', 
					Kd_Aset_108='$NewKd', 
					Kd_UPB='$NeUpb', 
					No_Register='$NewRg', 
					Uraian='$rNaM', 
					Keterangan='$gUR', 
					Tmbh_Ms_Manfaat='$gMP',
					Crit='INV', 
					HasilMerger='Y',
					Mrg_Ref_History='$gRef', 
					Mrg_Crit_History='$gCR',
					Mrg_Tmbh_Ms_Manfaat_History='$gBX',
					Pencatat='".$gPCT.":HslMrg', 
					Recorded=now() 
					WHERE IDT='$gID'";
					#echo $SW;
					$rs = mysql_query($SW) or die(mysql_error());
				}
			}
		}
		
		//return false;
		
		//Pindah record ke ta_kib_a,b,c,d,e_merger_his
		$NmFL= array();
		$iG  = 0;
		
		#return false;
		
		$SQL ="SHOW Fields FROM ta_kib_108";
		$nRs = mysql_query($SQL) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$iG++;
			$NmFL[$iG] = $mRo['Field'];
		}
		
		if ($gRef)
		{
			$nSQ = "SELECT * FROM ta_kib_108 WHERE Referensi='$gRef'";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					$ySQ = "";
					for ($i=2; $i<=$iG; $i++)
					{
						$fVaL = mysql_real_escape_string($mRo[$NmFL[$i]]);
						if (is_null($mRo[$NmFL[$i]])) 
						{
							if ($NmFL[$i]=="Kd_Tanah1" || $NmFL[$i]=="Kd_Tanah2" || $NmFL[$i]=="Kd_Tanah3" || $NmFL[$i]=="Kd_Tanah4" || $NmFL[$i]=="Kd_Tanah5" || $NmFL[$i]=="Kode_Tanah_Old") {
								$fVaL = 0;
							}
							else if ($NmFL[$i]=="Luas_Tanah" || $NmFL[$i]=="Luas_Lantai")
							{
								$fVaL = 0;
							}
						}
						
						if ($i == 2) {
							$ySQ.="INSERT INTO ta_kib_108_merger_his SET ".$NmFL[$i]."='".$fVaL."'";
						} else {
							$ySQ.=", ".$NmFL[$i]."='".$fVaL."'";
						}
					}
					//Proses insert ke tabel merger history
					$SWD = $ySQ;
					$Rs = mysql_query($SWD) or die(mysql_error());
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
			
			//Delete record di ta_kib_a,b,c,d,e
			if ($gRef!=""){
				$SD="DELETE FROM ta_kib_108 WHERE Referensi='$gRef'";
				$Rs = mysql_query($SD) or die(mysql_error());
			}
		}
		echo "<script language='JavaScript'> ";
		echo "this.setTimeout('self.close()',0)";
		echo "</script>";
	}
}
else if ($Simpan=="Batal") 
{
	echo "<script language='JavaScript'> ";
	echo "this.setTimeout('self.close()',0)";
	echo "</script>";
}
?>
