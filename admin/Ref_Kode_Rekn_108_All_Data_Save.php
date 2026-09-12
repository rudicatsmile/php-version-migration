<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
//echo $Lev;
if ($IdT=='')
{
	$gNeW = 1;
	$fLD  = "";
	if ($Lev=='1')
	{
		$rMax = fGlobal("max(Kd_Aset)","ref_rek_aset108_2","Kd_Aset",substr($KdR,0,1)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = substr($rMax,-1,1)+1;
		}
		$NewR = substr($KdR,0,1).".".$gNeW;
	}
	else if ($Lev=='2')
	{
		$rMax = fGlobal("max(Kd_Aset)","ref_rek_aset108_3","Kd_Aset",substr($KdR,0,3)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = substr($rMax,-1,1)+1;
		}
		$NewR = substr($KdR,0,3).".".$gNeW;
	}
	
	else if ($Lev=='3')
	{
		$rMax = fGlobal("max(Kd_Aset)","ref_rek_aset108_4","Kd_Aset",substr($KdR,0,5)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = ((int)substr($rMax,-2,2))+1;
		}
		$NewR = substr($KdR,0,5).".".substr('00'.$gNeW,-2,2);
	}
	
	else if ($Lev=='4')
	{
		$rMax = fGlobal("max(Kd_Aset)","ref_rek_aset108_5","Kd_Aset",substr($KdR,0,8)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = ((int)substr($rMax,-2,2))+1;
		}
		$NewR = substr($KdR,0,8).".".substr('00'.$gNeW,-2,2);
	}
	
	else if ($Lev=='5')
	{
		$rMax = fGlobal("max(Kd_Aset)","ref_rek_aset108_6","Kd_Aset",substr($KdR,0,11)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = ((int)substr($rMax,-2,2))+1;
		}
		$NewR = substr($KdR,0,11).".".substr('00'.$gNeW,-2,2);
	}
	
	else if ($Lev=='6')
	{
		$rMax = fGlobal("max(Kd_Aset)","ref_rek_aset108_7","Kd_Aset",substr($KdR,0,14)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = ((int)substr($rMax,-3,3))+1;
		}
		$NewR = substr($KdR,0,14).".".substr('000'.$gNeW,-3,3);
		$fLD = ", Link_Kib_AE='".$KdT."', Ms_Manfaat='".$UmR."'";
	}
	
	$nSQ = "INSERT INTO ref_rek_aset108_".($Lev+1)." SET 
	Kd_Aset='".$NewR."', Nm_Aset='".ReplaceTextPHP($NmR)."' $fLD";
	$nRs = mysql_query($nSQ);
	$IdT = fGlobal("max(IDT)","ref_rek_aset108_".($Lev+1),"IDT","%","LIKE","","");
}
else
{

	$fLD = "";
	if ($Lev=='6')
	{
		$fLD = ", Link_Kib_AE='".$KdT."', Ms_Manfaat='".$UmR."'";
	}
	$nSQ = "UPDATE ref_rek_aset108_".($Lev+1)." SET Nm_Aset='".ReplaceTextPHP($NmR)."' $fLD WHERE IDT='".$IdT."'";
	//echo $nSQ;
	$nRs = mysql_query($nSQ);
}
?>
<script type="text/javascript">
	editDATA('<?=$ReO?>','<?=$Lev?>','refr','<?=$IdT?>','','<?=$IdL?>');
</script>

