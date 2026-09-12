<?
require('Connection.php');
extract($_GET);
$fld = str_replace('**',' ',$fld);

if ($rIdT){
	if ($crt=='usulan_jumlah' || $crt=='usulan_satuan' || $crt=='maksimum_jumlah' || $crt=='maksimum_satuan' || $crt=='optimalisasi_jumlah' || $crt=='optimalisasi_satuan' || $crt=='cara_pemenuhan' || $crt=='keterangan')
	{
		$DtA = fGlobalNEW("Kd_Unit:Tahun:Apbd:Kd_Rekening","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$DtA = explode(':',$DtA);
		$SkP = $DtA[0];
		$ThN = $DtA[1];
		$ApB = $DtA[2];
		$ReK = $DtA[3];
		
	
		if ($crt=='usulan_jumlah' || $crt=='maksimum_jumlah' || $crt=='optimalisasi_jumlah')
		{
			$fld = fConvertToNumeric($fld);
		}
		
		if ($crt=='usulan_jumlah')
		{
			$MaX = fGlobalNEW("maksimum_jumlah","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
			$OpT = fGlobalNEW("optimalisasi_jumlah","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
			$Oth = fGlobalNEW("IfNull(sum(usulan_jumlah),0)","ta_rkbmd_new_rekening","Kd_Unit:Tahun:Apbd:Kd_Rekening:IDT",$SkP.":".$ThN.":".$ApB.":".$ReK.":".$rIdT,"=:=:=:=:<>","",DatabaseSB,$ConSB,"");
			$SiS = $MaX-($OpT+$Oth);
			//echo $MaX.":".$OpT.":".$Oth."=".$SiS;
			 
			if ($fld > $SiS)
			{
				$fld = $SiS;
			}
			#$Opt = fGlobalNEW("Optimalisasi_Jumlah","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
			#$MaK = $Opt+$fld;
			#$Scp = "";
		}
		
		if ($crt=='optimalisasi_jumlah')
		{
			#$Opt = fGlobalNEW("usulan_jumlah","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
			#$MaK = $Opt+$fld;
			#$Scp = "";
			
			$SQ = "UPDATE ta_rkbmd_new_rekening SET optimalisasi_jumlah='".$fld."' 
			WHERE Kd_Unit='".$SkP."' AND Tahun='".$ThN."' AND Apbd='".$ApB."' AND Kd_Rekening='".$ReK."'";
			$rs = mysql_query($SQ);
		}
		
		if ($crt=='maksimum_jumlah')
		{
			$Opt = fGlobalNEW("Optimalisasi_Jumlah","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
			$Usu = $fld-$Opt;
			$Scp = "";//", usulan_jumlah='".$Usu."', KebutuhanReal_Jumlah='".$Rea."'";
			
			$SQ = "UPDATE ta_rkbmd_new_rekening SET maksimum_jumlah='".$fld."' 
			WHERE Kd_Unit='".$SkP."' AND Tahun='".$ThN."' AND Apbd='".$ApB."' AND Kd_Rekening='".$ReK."'";
			$rs = mysql_query($SQ);
		}
		
		$nSQ = "UPDATE ta_rkbmd_new_rekening SET $crt='".$fld."' $Scp WHERE IDT = '$rIdT'";
		$nRs = mysql_query($nSQ);
		
		//$Uss = fGlobalNEW("Usulan_Jumlah","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$Max = fGlobalNEW("Maksimum_Jumlah","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$Opt = fGlobalNEW("Optimalisasi_Jumlah","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$SaT = fGlobalNEW("Usulan_Satuan","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$Rea = $Max-$Opt;
		
		$nSQ = "UPDATE ta_rkbmd_new_rekening SET KebutuhanReal_Jumlah='".$Rea."', KebutuhanReal_Satuan='".$SaT."' WHERE IDT = '$rIdT'";
		$nRs = mysql_query($nSQ);
	}
	else if ($crt=='harga')
	{
		$fld = fConvertToNumeric($fld);
		$nSQ = "UPDATE ta_rkbmd_new_rekening SET Usulan_Harga='".$fld."' WHERE IDT = '$rIdT'";
		$nRs = mysql_query($nSQ);
	}
	else if ($crt=='output')
	{
		$nSQ = "UPDATE ta_rkbmd_new_kegiatan_sub SET Output='".$fld."' WHERE IDT = '$rIdT'";
		$nRs = mysql_query($nSQ);
	}
}
?>

<script languange="javascript">
	RefreshDATA('<?=$stLOCK?>','<?=$IdL?>');
</script>