<?php
	$gReff = fGlobal("Referensi","ta_kib_post_108","Ref_Group",$gGRP,"=","IDT limit 0,1","");
	if ($gReff!="")
	{
		$SQL = "UPDATE ta_kib_post_108 SET 
		Tanggal='$gTgl', 
		Tgl_Mutasi='$gTglM', 
		Debet='$gHRG', Ref_Group='' WHERE Referensi='".$gReff."' AND Crit='SLD' AND DK='D'";
		$rst = mysql_query($SQL) or die(mysql_error());
	
		$SQL = "UPDATE ta_kib_post_108 SET Tgl_Mutasi='$gTglM' WHERE Referensi='".$gReff."' AND Crit<>'SLD' AND DK='D'";
		$rst = mysql_query($SQL) or die(mysql_error());
	}
?>