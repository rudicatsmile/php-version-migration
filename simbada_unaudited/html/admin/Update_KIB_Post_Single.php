<?
	$gReff = fGlobal("Referensi","ta_kib_108","IDT",$rIDT,"=","","");
	if ($gReff!="")
	{
		$SQL = "UPDATE ta_kib_post_108 SET 
		No_Register='$NoREG',
		Tanggal='$gTgl', 
		Tgl_Mutasi='$gTglM', 
		Debet='$gHRG' WHERE Referensi='".$gReff."' AND Crit='SLD'";
		$rst = mysql_query($SQL);
		
		$SQL = "UPDATE ta_kib_post_108 SET Tgl_Mutasi='$gTglM', No_Register='$NoREG' WHERE Referensi='".$gReff."' AND Crit='INV'";
		$rst = mysql_query($SQL);
	}
?>