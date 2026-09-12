<?php
$Col[15];
$iG = 1;
$gHrg = 0;
$rTH = $rTH;
function ClrVr()
{
	for($nG=0; $nG<=15; $nG++)
	{
		$Col[$nG]="";
	}
}

$gRf = $_GET['ref'];

if ($CriT=="BPK")
{
	if ($gUpb=="All") {$gUpb = $gSub.".%";}
	if ($gSub=="All") {$gUpb = $gUnt.".%.%";}
	if ($gExt=="All") {$gExt = "%";} else {$gExt=$gExt;}
	
	if ($gThn=="All")
		{$rThn="____";}
	else
		{$rThn=$gThn;}
	
	if ($gBid=="All")
	{
		$rBid="_._._.__";
		$rKel="__";
		$rOBJ="__";
		$rRin="___";
	}
	else
	{
		if ($gKel=="All")
		{
			$rBid=$gBid;
			$rKel="__";
			$rOBJ="__";
			$rRin="___";
		}
		else
		{
			if ($gOBJ=="All")
			{
				$rBid=$gBid;
				$rKel=substr($gKel,-2,2);
				$rOBJ="__";
				$rRin="___";
			}
			else
			{
				if ($gRin=="All")
				{
					$rBid=$gBid;
					$rKel=substr($gKel,-2,2);
					$rOBJ=substr($gOBJ,-2,2);
					$rRin="___";
				}
				else
				{
					$rBid=$gBid;
					$rKel=substr($gKel,-2,2);
					$rOBJ=substr($gOBJ,-2,2);
					$rRin=substr($gRin,-3,3);
				}
			}
		}
	}
	
	if ($gFin!="")
	{
		$fFindSy = "AND (Nm_Aset LIKE '%".$gFin."%' OR Harga LIKE '%".$gFin."%' OR Referensi LIKE '%".$gFin."%' OR Nomor_Polisi LIKE '%".$gFin."%' OR Nomor_Rangka LIKE '%".$gFin."%' OR Nomor_BPKB LIKE '%".$gFin."%' OR Nomor_Mesin LIKE '%".$gFin."%' OR Kd_Aset_108 LIKE '%".$gFin."%' OR Keterangan LIKE '%".$gFin."%' OR Merk LIKE '%".$gFin."%')";
	}
	else
	{
		$fFindSy = "";
	}
	
	if ($gThnA){
		$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan >= '".$gThnA."-01-01' AND Tgl_Perolehan <= '".$gThn."-12-31' ".$fFindSy." ORDER BY Kd_UPB, Tgl_Perolehan, Kd_Aset_108, No_Register";
	}
	else{
		$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." ORDER BY Kd_UPB, Tgl_Perolehan, Kd_Aset_108, No_Register";
	}
}
else
{
	if ($rIDT!="") 
	{
		$nSQL= "SELECT * FROM ta_kib_108 WHERE IDT='".$rIDT."' ORDER BY Kd_UPB, Tgl_Perolehan, Kd_Aset_108, No_Register";
	}
	else 
	{
		if ($gThnA){
			$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Tgl_Perolehan >= '".$gThnA."-01-01' AND Tgl_Perolehan <= '".$gThn."-12-31' AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' ORDER BY Kd_UPB, Tgl_Perolehan, Kd_Aset_108, No_Register";
		}
		else{
			$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND Tgl_Perolehan LIKE '".$gThn."-__-__' AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' ORDER BY Kd_UPB, Tgl_Perolehan, Kd_Aset_108, No_Register";
		}
	}
}
?>