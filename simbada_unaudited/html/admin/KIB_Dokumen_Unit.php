<?
if ($gUnt=="All")
{
	$gUpb   = "%";
	$gNmUNT = "<i>SEMUA UNIT</i>";
	$gNmSUB = "<i>SEMUA SUB UNIT</i>";
	$gNmUPB = "<i>SEMUA UPB</i>";
}
else
{
	$gNmUNT = strtoupper(fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$gUnt,"=","",""));
	if ($gSub=="All") 
	{
		$gUpb   = $gUnt."%";
		$gNmSUB = "<i>SEMUA SUB UNIT</i>";
		$gNmUPB = "<i>SEMUA UPB</i>";
	}
	else 
	{
		$gNmSUB = strtoupper(fGlobal("Nm_Sub","Ref_Sub_Unit","Kd_Sub",$gSub,"=","",""));
		if ($gUpb=="All")
		{
			$gUpb=$gSub."%";
			$gNmUPB = "<i>SEMUA UPB</i>";
		}
		else
		{
			$gNmUPB = strtoupper(fGlobal("Nm_Upb","Ref_Upb","Kd_Upb",$gUpb,"=","",""));
		}
	}
	if ($gNmSUB=="") {$gNmSUB="-";}
	if ($gNmUPB=="") {$gNmUPB="-";}
	
}
?>