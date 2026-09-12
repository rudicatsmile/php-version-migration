<?php
require('Connection.php');
require "FileFunction.php";

extract($_POST);
extract($_GET);

$SmpP = $Simpan;
$rIDT = $rIDT;
$rRef = $rREF;
$rKib = $rKib;
$DeLIDT = $CritIDT;
if ($SmpP=="Kapitalisasi")
{
	$RefHs = fGlobal("Mrg_Ref_History","ta_kib_post_108","IDT",$DeLIDT,"=","","");
	if ($RefHs!='')
	{
		$SkH = fGlobal("Kd_UPB","ta_kib_post_108","IDT",$DeLIDT,"=","","");
		$SQL = "DELETE FROM ta_kib_108_merger_his WHERE referensi='".$RefHs."' AND Kd_UPB LIKE '".substr($SkH,00,11)."%'";
		$nRs = mysql_query($SQL) or die(mysql_error());
		
		$SQL = "UPDATE ta_kib_post_108 SET HasilMerger='N', Mrg_Ref_History='', Mrg_Crit_History='', Mrg_Tmbh_Ms_Manfaat_History='' WHERE IDT='".$DeLIDT."'";
		$nRs = mysql_query($SQL) or die(mysql_error());
	}
	//return false;
}

if ($SmpP=="RestoreRecord")
{
	$RefHs = fGlobal("Mrg_Ref_History","ta_kib_post_108","IDT",$DeLIDT,"=","","");
	if ($RefHs!='')
	{
		$SkHs = fGlobal("Kd_UPB","ta_kib_post_108","IDT",$DeLIDT,"=","","");
		$nKoD = fGlobal("Kd_Aset_108","ta_kib_108_merger_his","Referensi:Kd_UPB",$RefHs.":".substr($SkHs,0,11)."%","=:LIKE","","");
		$nReG = fGlobal("No_Register","ta_kib_108_merger_his","Referensi:Kd_UPB",$RefHs.":".substr($SkHs,0,11)."%","=:LIKE","","");
		$nUpB = fGlobal("Kd_UPB","ta_kib_108_merger_his","Referensi:Kd_UPB",$RefHs.":".substr($SkHs,0,11)."%","=:LIKE","","");
		
		$SQL = "SELECT IDT, Tmbh_Ms_Manfaat, Mrg_Crit_History, Mrg_Tmbh_Ms_Manfaat_History, Tanggal_BAST, Ref_Usulan,Ref_History,Ref_Mutasi,Tanggal,Tgl_Mutasi 
		FROM ta_kib_post_108 WHERE Mrg_Ref_History='".$RefHs."' AND Kd_UPB LIKE '".substr($SkHs,0,11)."%' ORDER BY IDT";
		$nRs = mysql_query($SQL) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$gID = $mRo[0];
			$gMP = $mRo[1];
			$INV = $mRo[2]; 
			$gBX = $mRo[3]; 
			$gTG = $mRo[4]; 
			
			$grU = $mRo[5]; 
			$grH = $mRo[6]; 
			$grM = $mRo[7]; 
			
			$gTP = $mRo[8]; 
			$gTM = $mRo[9]; 
			
			if ($gID)
			{
				$SW ="UPDATE ta_kib_post_108 SET 
				Referensi='".$RefHs."', 
				Ref_Usulan='".$grU."',
				Ref_History='".$grH."',
				Ref_Mutasi='".$grM."',
				Kd_UPB='".$nUpB."',
				Tanggal='".$gTP."', 
				Tanggal_BAST='".$gTG."', 
				Tgl_Mutasi='".$gTM."', 
				Kd_Aset_108='".$nKoD."', 
				No_Register='".$nReG."', 
				Tmbh_Ms_Manfaat='".$gMP."',
				Crit='".$INV."', 
				HasilMerger='N', 
				Mrg_Ref_History='', 
				Mrg_Crit_History='',
				Mrg_Tmbh_Ms_Manfaat_History='',
				Pencatat='".$rUID.":HasilRestore', 
				Recorded=now()  
				WHERE IDT='".$gID."'";
				$Rs = mysql_query($SW) or die(mysql_error());
			}
		}
	}
	
	//Kembalikan record ke ta_kib_a,b,c,d,e
	$NmFL= array();
	$iG  = 0;
	
	$SQL ="SHOW Fields FROM ta_kib_108_merger_his";
	$nRs = mysql_query($SQL) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$iG++;
		$NmFL[$iG] = $mRo['Field'];
	}
	
	if ($RefHs)
	{
		$nSQ = "SELECT * FROM ta_kib_108_merger_his WHERE Referensi='".$RefHs."' AND Kd_UPB LIKE '".substr($SkHs,0,11)."%'";
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
					}
					
					if ($i == 2) {
						$ySQ.="INSERT INTO ta_kib_108 SET ".$NmFL[$i]."='".$fVaL."'";
					} else {
						$ySQ.=", ".$NmFL[$i]."='".$fVaL."'";
					}
				}
				//Proses insert ke tabel ta_kib_a,b,c,d,e
				$SWD = $ySQ;
				$Rs = mysql_query($SWD) or die(mysql_error());
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		
		//Delete record di ta_kib_a,b,c,d,e_merger history
		$SD="DELETE FROM ta_kib_108_merger_his WHERE Referensi='".$RefHs."' AND Kd_UPB like '".substr($SkHs,0,11)."%'";
		$Rs = mysql_query($SD) or die(mysql_error());
	}
}
	
if ($SmpP=="DeleteRecord")
{
	if ($DeLIDT!=""){
		$SQL = "DELETE FROM ta_kib_post_108 WHERE IDT='".$DeLIDT."'";
		$rst = mysql_query($SQL) or die(mysql_error());
	}
}
$URL="Form_Invent_Asset_Ubh.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&rIDT=".$rIDT."&rKib=".$rKib;
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
