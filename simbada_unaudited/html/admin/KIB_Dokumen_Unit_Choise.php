<?
if (isset($gUnt)) {$gUnt=$gUnt;}
if (isset($gSub)) {$gSub=$gSub;}
if (isset($gUpb)) {$gUpb=$gUpb;}

if (isset($gKel)) {$gKel=$gKel;}
if (isset($gJns)) {$gJns=$gJns;}
if (isset($gOBJ)) {$gOBJ=$gOBJ;}
if (isset($gRin)) {$gRin=$gRin;}

if (isset($gMLK)) {$gMLK=$gMLK;}

if ($gUnt=="All")
{
	$gUpb   = "%";
	$gNmUNT = "Semua Unit";
	$gNmSUB = "Semua Sub Unit";
	$gNmUPB = "Semua UPB";
}
else
{
	$gNmUNT = fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$gUnt,"=","","");
	if ($gSub=="All") 
	{
		$gUpb   = $gUnt."%";
		$gNmSUB = "Semua Sub Unit";
		$gNmUPB = "Semua UPB";
	}
	else 
	{
		$gNmSUB = fGlobal("Nm_Sub","Ref_Sub_Unit","Kd_Sub",$gSub,"=","","");
		if ($gUpb=="All")
		{
			$gUpb   = $gSub."%";
			$gNmUPB = "Semua UPB";
		}
		else
		{
			$gUpb=$gUpb;
			$gNmUPB = fGlobal("Nm_Upb","Ref_Upb","Kd_Upb",$gUpb,"=","","");
		}
	}
}

if ($gKel=="All")
{
	$gAss = $gBid."%";
	$nAs1 = fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",$gBid,"=","","");
	$nAs2 = "Semua Kelompok";
	$nAs3 = "Semua Jenis";
	$nAs4 = "Semua Objek";
	$nAs5 = "Semua Rincian";
}
else
{
	if ($gJns=="All")
	{
		$gAss = $gKel."%";
		$nAs1 = fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",$gBid,"=","","");
		$nAs2 = fGlobal("Nm_Aset","ref_rek_aset108_4","Kd_Aset",$gKel,"=","","");
		$nAs3 = "Semua Jenis";
		$nAs4 = "Semua Objek";
		$nAs5 = "Semua Rincian";
	}
	else
	{
		if ($gOBJ=="All")
		{
			$gAss = $gJns."%";
			$nAs1 = fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",$gBid,"=","","");
			$nAs2 = fGlobal("Nm_Aset","ref_rek_aset108_4","Kd_Aset",$gKel,"=","","");
			$nAs3 = fGlobal("Nm_Aset","ref_rek_aset108_5","Kd_Aset",$gJns,"=","","");
			$nAs4 = "Semua Objek";
			$nAs5 = "Semua Rincian";
		}
		else
		{
			if ($gRin=="All")
			{
				$gAss = $gOBJ."%";
				$nAs1 = fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",$gBid,"=","","");
				$nAs2 = fGlobal("Nm_Aset","ref_rek_aset108_4","Kd_Aset",$gKel,"=","","");
				$nAs3 = fGlobal("Nm_Aset","ref_rek_aset108_5","Kd_Aset",$gJns,"=","","");
				$nAs4 = fGlobal("Nm_Aset","ref_rek_aset108_6","Kd_Aset",$gOBJ,"=","","");
				$nAs5 = "Semua Rincian";
			}
			else
			{
				$gAss = $gRin;
				$nAs1 = fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",$gBid,"=","","");
				$nAs2 = fGlobal("Nm_Aset","ref_rek_aset108_4","Kd_Aset",$gKel,"=","","");
				$nAs3 = fGlobal("Nm_Aset","ref_rek_aset108_5","Kd_Aset",$gJns,"=","","");
				$nAs4 = fGlobal("Nm_Aset","ref_rek_aset108_6","Kd_Aset",$gOBJ,"=","","");
				$nAs5 = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$gRin,"=","","");
			}
		}
	}
}
	
if ($gMLK=="All") {$gMLK="__";}

if ($gMLK=="__")
	{$nMLK="-";}
else
	{$nMLK=strtoupper(fGlobal("Nm_Pemilik","ref_pemilik","Kd_Pemilik",$gMLK,"=","",""));}

?>