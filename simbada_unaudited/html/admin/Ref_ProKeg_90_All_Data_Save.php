<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

if ($IdT=='')
{
	$gNeW = 1;
	#if ($Lev=='3' && substr($KdR,0,1)!='X'){$gNeW = 2;}
	if ($Lev=='1')
	{
		$rMax = fGlobal("max(Kode)","ref_keg_90_1","Kode","%","LIKE","","");
		if ($rMax)
		{
			$gNeW = $rMax+1;
		}
		$NewR = $gNeW;
	}
	else if ($Lev=='2')
	{
		if (substr($KdR,0,1)=='X' || substr($KdR,0,1)=='1' || substr($KdR,0,1)=='2' || substr($KdR,0,1)=='3')
		{
			#kode bidang lintas urusan
			#$rMax = fGlobal("max(right(kode,2))","ref_keg_90_2","Kode:Kode:Kode:Kode:Kode:Kode:Kode","4.%:5.%:6.%:7.%:8.%:9.%:X.%","NOT LIKE:NOT LIKE:NOT LIKE:NOT LIKE:NOT LIKE:NOT LIKE:NOT LIKE","","");
			$rMax = fGlobal("max(Kode)","ref_keg_90_2","Kode",substr($KdR,0,1).".%","LIKE","","");
			
		}
		else
		{
			#kode bidang tidak lintas urusan
			$rMax = fGlobal("max(Kode)","ref_keg_90_2","Kode",substr($KdR,0,1).".%","LIKE","","");
		}
		if ($rMax)
		{
			$gNeW = substr($rMax,-2,2)+1;
		}
		$NewR = substr($KdR,0,1).".".substr('00'.$gNeW,-2,2);
	}
	else if ($Lev=='3')
	{
		$rMax = fGlobal("max(Kode)","ref_keg_90_3","Kode",substr($KdR,0,4)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = substr($rMax,-2,2)+1;
		}
		$NewR = substr($KdR,0,4).".".substr('00'.$gNeW,-2,2);
	}
	else if ($Lev=='4')
	{
		$rMax = fGlobal("max(Kode)","ref_keg_90_4","Kode",substr($KdR,0,9)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = substr($rMax,-2,2)+1;
		}
		$NewR = substr($KdR,0,9).".".substr('00'.$gNeW,-2,2);
	}
	else if ($Lev=='5')
	{
		#$rMax = fGlobal("max(Kode)","ref_keg_90_5","Kode",substr($KdR,0,12)."%","LIKE","","");
		#if ($rMax)
		#{
		#	$gNeW = substr($rMax,-2,2)+1;
		#}
		#$NewR = substr($KdR,0,12).".".substr('00'.$gNeW,-2,2);
		
		$rMax = fGlobal("max(Kode)","ref_keg_90_5","Kode",substr($KdR,0,12)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = substr($rMax,-4,4)+1;
		}
		$NewR = substr($KdR,0,12).".".substr('0000'.$gNeW,-4,4);
	}
	#else if ($Lev=='6')
	#{
	#	$rMax = fGlobal("max(Kode)","ref_keg_90_6","Kode",substr($KdR,0,11)."%","LIKE","","");
	#	if ($rMax)
	#	{
	#		$gNeW = substr($rMax,-3,3)+1;
	#	}
	#	$NewR = substr($KdR,0,11).".".substr('000'.$gNeW,-3,3);
	#}
	
	$nSQ = "INSERT INTO ref_keg_90_$Lev SET 
	Kode='".$NewR."', Deskripsi='".ReplaceTextPHP($NmR)."'";
	$nRs = mysql_query($nSQ);
	$IdT = fGlobal("max(IDT)","ref_keg_90_".$Lev,"IDT","%","LIKE","","");
}
else
{
	$nSQ = "UPDATE ref_keg_90_$Lev SET Deskripsi='".ReplaceTextPHP($NmR)."' WHERE IDT='".$IdT."'";
	$nRs = mysql_query($nSQ);
}
?>
<script type="text/javascript">
	editDATA('<?=$ReO?>','<?=$Lev?>','refr','<?=$IdT?>','','<?=$IdL?>');
	//alert('<?=$ReO?>'+'<?=$Lev?>'+'refr'+'<?=$IdT?>'+''+'<?=$IdL?>');
	//alert('xx');
	//return false;
</script>

