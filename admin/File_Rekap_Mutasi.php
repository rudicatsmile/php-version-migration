<?php
$gUID = fFindUID($_REQUEST['IdL'],"User_ID");
$xUpb  = $_REQUEST['fUpb'];
$xThn  = $_REQUEST['fThn'];
if ($xThn =="" || $xThn =="All") {$xThn  = fGetDate('year');}
if ($xUpb =="" || $xUpb =="All") {$xUpb  = "%";}

fRekaMutasi($xUpb,$xThn);
function fRekaMutasi($xUpb,$xThn)
{
	$nSQ = "DELETE FROM ta_rekap_mutasi WHERE Tahun='".$xThn."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());

	$gnSQL= "SELECT Kd_UPB, Kd_Aset, SUBSTR(Tanggal,1,4) as Tahun, 
	IFNULL(SUM(Debet),0) as Debet, IFNULL(SUM(Kredit),0) as Kredit from ta_kib_post  
	WHERE Tanggal LIKE '".$xThn."-%-%' GROUP BY Kd_UPB, SUBSTR(Tanggal,1,4), Kd_Aset";
	$gnRs = mysql_query($gnSQL) or die(mysql_error());
	$gmRo = mysql_fetch_assoc($gnRs);
	$gtRo = mysql_num_rows($gnRs);
	if ($gtRo > 0)
	{
		do
		{
			$gUPB = $gmRo['Kd_UPB'];
			$gAST = $gmRo['Kd_Aset'];
			$gTHN = $gmRo['Tahun'];
			$gHRD = $gmRo['Debet'];
			$gHRK = $gmRo['Kredit'];
			
			if (substr($gAST,0,2)=="01") {$gITM = fGlobal("IfNull(count(*),0)","ta_kib_a","Kd_UPB:Kd_Aset:Tgl_Perolehan",$gUPB.":".$gAST.":".$gTHN."-%-%","=:=:LIKE","","");}
			if (substr($gAST,0,2)=="02") {$gITM = fGlobal("IfNull(count(*),0)","ta_kib_b","Kd_UPB:Kd_Aset:Tgl_Perolehan",$gUPB.":".$gAST.":".$gTHN."-%-%","=:=:LIKE","","");}
			if (substr($gAST,0,2)=="03") {$gITM = fGlobal("IfNull(count(*),0)","ta_kib_c","Kd_UPB:Kd_Aset:Tgl_Perolehan",$gUPB.":".$gAST.":".$gTHN."-%-%","=:=:LIKE","","");}
			if (substr($gAST,0,2)=="04") {$gITM = fGlobal("IfNull(count(*),0)","ta_kib_d","Kd_UPB:Kd_Aset:Tgl_Perolehan",$gUPB.":".$gAST.":".$gTHN."-%-%","=:=:LIKE","","");}
			if (substr($gAST,0,2)=="05") {$gITM = fGlobal("IfNull(count(*),0)","ta_kib_e","Kd_UPB:Kd_Aset:Tgl_Perolehan",$gUPB.":".$gAST.":".$gTHN."-%-%","=:=:LIKE","","");}
			if (substr($gAST,0,2)=="06") {$gITM = fGlobal("IfNull(count(*),0)","ta_kib_f","Kd_UPB:Kd_Aset:Tgl_Perolehan",$gUPB.":".$gAST.":".$gTHN."-%-%","=:=:LIKE","","");}
			
			$gITN = fGlobal("IfNull(count(*),0)","ta_penghapusan_rinc_new","Kd_UPB:Kd_Aset:Tahun",$gUPB.":".$gAST.":".$gTHN,"=:=:=","","");			
			$nSQ = "INSERT INTO ta_rekap_mutasi set 
			Kd_UPB='$gUPB', 
			Kd_Aset='$gAST', 
			Tahun='$gTHN', 
			Total_Item_D='$gITM', 
			Total_Item_K='$gITN', 
			Total_Harga_D='$gHRD',
			Total_Harga_K='$gHRK',
			Recorded=now(),
			Pencatat='$gUID'";
			$nRs = mysql_query($nSQ) or die(mysql_error());
		}
		while ($gmRo = mysql_fetch_assoc($gnRs));	
	}
}
?>
