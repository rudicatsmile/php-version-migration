<?
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
require("CheckLogin.php");
extract($_POST);
extract($_GET);
#echo $fJNS;
#return false;

if ($fSave=='Save' || $fSave=='Load')
{
	$gTGL = $fTH."-".$fBL."-".$fHR;
	$gTGD = $fTHd."-".$fBLd."-".$fHRd;
	if ($IdT)
	{
		if ($fSave=='Save')
		{
			$gTBL = "ta_permohonan_repla_rek_aset";
			$gDTA = "";
			$gDTA = "Tanggal='".$gTGL."' ";
			$gDTA.= ", Kd_Unit='".$fUNT."'";
			$gDTA.= ", Dokumen_Nom='".$fNOd."'";
			$gDTA.= ", Dokumen_Tgl='".$gTGD."'";
			$gDTA.= ", Uraian='".mysql_real_escape_string($fURA)."'";
			
			$gIdX = 'IDT';
			$gSyR = $IdT;
			$gOpR = '=';
			UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,DatabaseSB,$ConSB);
			
			$nSQ = "SELECT IDT FROM ta_permohonan_repla_rek_aset_rinci WHERE Referensi = '".$fREF."' ORDER BY IDT";
			$nRs = mysql_query($nSQ);
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$iD = $mRo[0];
				if ($_POST["check".$iD]=="ON")
				{
					$cK = "Y";
				}
				else{
					$cK = "N";
				}
				$SQ = "UPDATE ta_permohonan_repla_rek_aset_rinci SET CheckList='$cK' WHERE IDT = '".$iD."'";
				$Rs = mysql_query($SQ);
			}
		}
		else if ($fSave=='Load')
		{
			for ($i=1; $i<=7; $i++)
			{
				$nSQ = "SELECT Kd_Aset FROM ta_kib_".fNmHuruf($i)." WHERE Kd_UPB LIKE '".$fUNT."%' GROUP BY Kd_Aset";
				$nRs = mysql_query($nSQ);
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$rCeK = fGlobal("IDT","ta_permohonan_repla_rek_aset_rinci","Referensi:Kd_Rekening_17",$fREF.":".$mRo[0],"=:=","","");
					if (!$rCeK)
					{
						$m108 = fGlobal("Kd_Aset108","ref_rek_aset5_maping","Kd_Aset17",$mRo[0],"=","","");
						$gTBL = "ta_permohonan_repla_rek_aset_rinci";
						$gFLD = "";
						$gVAL = "";
						$gFLD = "Referensi";
						$gVAL = "'$fREF'";
						$gFLD.= ", Kd_Rekening_17";
						$gVAL.= ", '".$mRo[0]."'";
						
						$gFLD.= ", Kd_Rekening_108";
						$gVAL.= ", '".$m108."'";
						
						$gFLD.= ", CheckList";
						$gVAL.= ", 'Y'";
						
						$gFLD.= ", Pencatat";
						$gVAL.= ", '".$UID."'";
						$gFLD.= ", Recorded";
						$gVAL.= ", now()";
						
						InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
					}
				}
			}
		}
	}
	else
	{
		$gNeW = 1;
		$rMax = fGlobal("max(Referensi)","ta_permohonan_repla_rek_aset","Referensi","PRB.".fGetDate('year')."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,-8,8)+1;
		}
		$gREF = "PRB.".fGetDate('year').".".substr(str_repeat('0',8).$gNeW,-8,8);
		
		$gNeW = 1;
		$rMax = fGlobal("max(Nomor)","ta_permohonan_repla_rek_aset","Nomor","%/PRB/".fGetDate('year'),"LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,0,8)+1;
		}
		$gNOM = substr(str_repeat('0',8).$gNeW,-8,8)."/PRB/".fGetDate('year');
		
		$gTBL = "ta_permohonan_repla_rek_aset";
		$gFLD = "";
		$gVAL = "";
		$gFLD = "Referensi";
		$gVAL = "'$gREF'";
		$gFLD.= ", Kd_Unit";
		$gVAL.= ", '$fUNT'";
		$gFLD.= ", Nomor";
		$gVAL.= ", '$gNOM'";
		$gFLD.= ", Tanggal";
		$gVAL.= ", '$gTGL'";
		$gFLD.= ", Dokumen_Nom";
		$gVAL.= ", '$fNOd'";
		$gFLD.= ", Dokumen_Tgl";
		$gVAL.= ", '$gTGD'";
		$gFLD.= ", Uraian";
		$gVAL.= ", '".mysql_real_escape_string($fURA)."'";
		$gFLD.= ", Pencatat";
		$gVAL.= ", '".$UID."'";
		
		$gFLD.= ", Recorded";
		$gVAL.= ", now()";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
		
		$IdT = fGlobal("max(IDT)","ta_permohonan_repla_rek_aset","IDT","%","LIKE","","");
	}
	$URL="Rekn108_Usulan_Frm.php?IdT=".$IdT."&FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
else
{
	$URL="Rekn108_Usulan_Frm.php?FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
?>