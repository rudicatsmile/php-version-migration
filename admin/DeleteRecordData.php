<?php
function DeleteData($NmTBL,$rIDT,$gNoM,$RfTMP,$DatabaseSB,$ConSB)
{
	if ($gNoM!="")
	{
		CallConnection($DatabaseSB,$ConSB);
		$SQL = "DELETE FROM ".$NmTBL." WHERE No_Pengadaan='$gNoM' AND Ref_Temp='$RfTMP'";	//''''''''''''' {Ref_Temp}
		$nRs = mysql_query($SQL) or die(mysql_error());
		if ($RfTMP!=""){
			$SQL = "DELETE FROM ta_kib_post_108 WHERE No_Pengadaan='$gNoM' AND Ref_Temp='$RfTMP'";	//''''''''''''' {Ref_Temp}
			$nRs = mysql_query($SQL) or die(mysql_error());
		}
		$SQL = "DELETE FROM ta_kib_group WHERE No_Pengadaan='$gNoM' AND Ref_Temp='$RfTMP'";	//''''''''''''' {Ref_Temp}
		$nRs = mysql_query($SQL) or die(mysql_error());
		
		$rCEK= fGlobalNEW("IDT",$NmTBL,"No_Pengadaan:Ref_Temp",$gNoM.":".$RfTMP,"=:<>","",DatabaseSB,$ConSB,"");	//'''''''''''''
		if (!$rCEK)
		{
			$SQL = "UPDATE ".$NmTBL."_temp SET Extract='Belum' WHERE IDT='$rIDT'";
			$nRs = mysql_query($SQL) or die(mysql_error());
		}
	}
}
?>