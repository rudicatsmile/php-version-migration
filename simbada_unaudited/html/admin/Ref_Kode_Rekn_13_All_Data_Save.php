<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

if ($IdT=='')
{
	$gNeW = 1;
	if ($Lev=='1')
	{
		$rMax = fGlobal("max(Kd_Rek)","ref_rek_1","Kd_Rek","%","LIKE","","");
		if ($rMax)
		{
			$gNeW = $rMax+1;
		}
		$NewR = $gNeW;
	}
	else if ($Lev=='2')
	{
		$rMax = fGlobal("max(Kd_Rek)","ref_rek_2","Kd_Rek",substr($KdR,0,1)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = substr($rMax,-1,1)+1;
		}
		$NewR = substr($KdR,0,1).".".$gNeW;
	}
	
	##############
	else if ($Lev=='3')
	{
		$rMax = fGlobal("max(Kd_Rek)","ref_rek_3","Kd_Rek",substr($KdR,0,3)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = ((int)substr($rMax,-2,2))+1;
		}
		$NewR = substr($KdR,0,3).".".substr('00'.$gNeW,-2,2);
	}
	##############
	
	##############
	else if ($Lev=='4')
	{
		$rMax = fGlobal("max(Kd_Rek)","ref_rek_4","Kd_Rek",substr($KdR,0,6)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = ((int)substr($rMax,-3,3))+1;
		}
		$NewR = substr($KdR,0,6).".".substr('000'.$gNeW,-3,3);
	}
	##############
	
	##############
	else if ($Lev=='5')
	{
		$rMax = fGlobal("max(Kd_Rek)","ref_rek_5","Kd_Rek",substr($KdR,0,10)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = ((int)substr($rMax,-4,4))+1;
		}
		$NewR = substr($KdR,0,10).".".substr('0000'.$gNeW,-4,4);
	}
	##############
	
	##############
	/*
	else if ($Lev=='6')
	{
		$rMax = fGlobal("max(Kd_Rek)","ref_rek_6","Kd_Rek",substr($KdR,0,12)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = ((int)substr($rMax,-4,4))+1;
		}
		$NewR = substr($KdR,0,12).".".substr('0000'.$gNeW,-4,4);
	}
	*/
	##############
	
	$nSQ = "INSERT INTO ref_rek_$Lev SET 
	Kd_Rek='".$NewR."', Nm_Rek='".ReplaceTextPHP($NmR)."'";
	$nRs = mysql_query($nSQ);
	
	$IdT = fGlobal("max(IDT)","ref_rek_".$Lev,"IDT","%","LIKE","","");
}
else
{
	$nSQ = "UPDATE ref_rek_$Lev SET Nm_Rek='".ReplaceTextPHP($NmR)."' WHERE IDT='".$IdT."'";
	$nRs = mysql_query($nSQ);
}
?>
<script type="text/javascript">
	editDATA('<?=$Lev?>','refr','<?=$IdT?>','','<?=$IdL?>');
</script>

