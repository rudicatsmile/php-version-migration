<?php
if ($gGRP!=""){
	$SQL = "UPDATE ta_kib_post_108 SET 
	Tanggal='$gTgl', 
	Tgl_Mutasi='$gTglM', 
	Debet='$gHRG' WHERE Ref_Group='".$gGRP."' AND Crit='SLD' AND DK='D'";
	$rst = mysql_query($SQL) or die(mysql_error());
}
?>