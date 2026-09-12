<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$ExTR = fGlobal("nilaiExtracom","ref_rek_aset108_3","Kd_Aset",$gExT,"=","","");
$ExTR13503 = fGlobal("nilaiExtracom","ref_rek_aset108_4","Kd_Aset","1.3.5.03","=","","");
$ExTR13505 = fGlobal("nilaiExtracom","ref_rek_aset108_4","Kd_Aset","1.3.5.05","=","","");
$ExTR13506 = fGlobal("nilaiExtracom","ref_rek_aset108_4","Kd_Aset","1.3.5.06","=","","");
$ExTR13507 = fGlobal("nilaiExtracom","ref_rek_aset108_4","Kd_Aset","1.3.5.07","=","","");

if ($gExT=='1.5.4'){$ExTR=999999999999;}

if ($gUnT=="ALL"){$gUnT="%";}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="355px" style="border:0px">
<?php
$x=array();
$iG=1;

$tJmL=0;
if ($ExTR!=0)
{
	$Nil = 0;
	if ($eMuT){
		$FL10=", P1.Referensi_To as FL10 ";
	}
	else{
		$FL10=", P1.Ref_Mutasi as FL10 ";
	}
	
	if ($gNoN=='Y'){
		$eLMT= "10000";
		$eBY = "P1.Tgl_Perolehan,";
	}
	else{
		$eLMT= "1000";
		$eBY = "";
	}
	if ($eReS=='reset')
	{
		$nSQ = "UPDATE ta_kib_108 SET extracom='N' WHERE Kd_Aset_108 LIKE '".$gExT."%' AND Kd_UPB LIKE '".$gUnT."%'";
		#echo $nSQ."<br>";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "UPDATE ta_kib_post_108 SET extracom='N' WHERE Kd_Aset_108 LIKE '".$gExT."%' AND Kd_UPB LIKE '".$gUnT."%'";
		#echo $nSQ."<br>";
		$nRs = mysql_query($nSQ);
	}
	
	$SyT = "P1.Kd_Aset_108 LIKE '".$gExT."%'";
	if ($gExT=="1.3.5")
	{
		$SyT = "(P1.Kd_Aset_108 LIKE '1.3.5.03.%' OR P1.Kd_Aset_108 LIKE '1.3.5.05.%' OR P1.Kd_Aset_108 LIKE '1.3.5.06.%' OR P1.Kd_Aset_108 LIKE '1.3.5.07.%')";
	}
	
	$nSQ = "SELECT P1.IDT as FL0, 
	P1.Referensi as FL1, 
	P1.Kd_Aset_108 as FL2, 
	P1.No_Register as FL3, 
	P1.Nm_Aset as FL4, 
	P1.Tgl_Perolehan as FL5, 
	P1.Harga as FL6,  
	IfNull(sum(P2.debet),0) as FL7, 
	P1.extracom as FL8, 
	P1.Keterangan as FL9 $FL10
	FROM ta_kib_108".$eMuT." P1 
	LEFT JOIN ta_kib_post_108".$eMuT." P2 ON P2.Referensi=P1.Referensi AND LEFT(P2.Kd_UPB,11)=LEFT(P1.Kd_UPB,11) 
	WHERE $SyT AND P1.Kd_UPB LIKE '".$gUnT."%' AND P2.extracom ='".$gNoN."' GROUP BY P1.Referensi ORDER BY ".$eBY." FL7 LIMIT 0,$eLMT";
	#echo $nSQ;
	#return false;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$xB = "";
		$rCeK = "";
		$rDiS = "disabled";
		$x[1]=""; $x[2]=""; $x[3]=""; $x[4]=""; $x[5]=""; $x[6]=0; $x[7]=0; $x[8]=""; $x[9]="";
		if ($gExT=='1.5.4')
		{
			$Link = substr(fGlobal("Link_Kib_AE","ref_rek_aset108_7","Kd_Aset",$mRo[2],"=","",""),0,5);
			$ExTR = fGlobal("nilaiExtracom","ref_rek_aset108_3","Kd_Aset",$Link,"=","","");
		}
		if ($gExT=='1.3.5')
		{
			$ExTR = 0;
			if (substr($mRo[2],0,8)=='1.3.5.03'){$ExTR = $ExTR13503;}
			if (substr($mRo[2],0,8)=='1.3.5.05'){$ExTR = $ExTR13505;}
			if (substr($mRo[2],0,8)=='1.3.5.06'){$ExTR = $ExTR13506;}
			if (substr($mRo[2],0,8)=='1.3.5.07'){$ExTR = $ExTR13507;}
		}
		
		if ($mRo[7] < $ExTR)
		{
			if ($gNoN=="Y"){
				$gBox ="";
				$rCeK = "checked";
			}
			else{
				$gBox="";
				$rCeK = "";
			}
			$gIDT = $mRo[0];
			$x[1] = $mRo[1];
			$x[2] = $mRo[2];
			$x[3] = $mRo[3];
			$x[4] = $mRo[4];
			$x[5] = fConvertDateShort($mRo[5]);
			$x[6] = $mRo[6];
			$x[7] = $mRo[7];
			
			$x[8] = "<font style='color:#ff0000'>?????</font>";
			if ($mRo[8]=="Y"){
				$x[8] = "<i>extracom</i>";
			}
			else{
				$rCeK = "checked";
			}
			$rDiS = "";
			if ($eMuT!=""){
				$x[9] = $mRo[9]." <font style='background:#000; color:#fff'><i>&nbsp;sudah mutasi&nbsp;</i><font> Ke : ".$mRo[10]."&nbsp;";
			}
			else{
				$x[9] = $mRo[9];
				if ($mRo[10]!=""){
					$x[9] = $mRo[10]." : ".$mRo[9];
				}
			}
			$x[10] = $ExTR;
			rinciDATA($x[1],$x[2],$x[3],$x[4],$x[5],$x[6],$x[7],$x[8],$x[9],$x[10],$iG,$gIDT,$rCeK,$rDiS,$gBox,$xB);
			$Nil = $Nil+$x[7];
			$iG++;
		}
	}
}
?>
<?php function rinciDATA($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$iG,$idt,$rCeK,$rDiS,$gBox,$xB){?>
	<?php
	$gBG  = fBackCLR($iG);
	?>
	<tr height="26"> 
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x1?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x2?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x3?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:left; padding-left:3px"><?=$x4?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x5?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right"><?=fConvertToRupiah($x6)?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right"><?=fConvertToRupiah($x7)?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right">
	  <font style="background-color:#000; color:#fff">&nbsp;
	  <?=fConvertToRupiah($x10)?>
	  </font>
	  </td>
	  
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x8?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px"><?=$x9?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:6px">
	  <input type="checkbox" <?=$gBox?> <?=$rCeK?> <?=$rDiS?> name="fComP" value="<?=$idt?>" /></td>
	</tr>
<?php } ?>
<?php if ($iG==1) {?>
<tr height="95%">
 <td colspan="13" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
<tr height="100%">
 <td width="25" style="border-bottom:0px #999999 dotted">&nbsp;</td>
 <td width="95" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="95" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="64" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="300" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="70" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="100" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="100" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="100" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="80" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="30" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid; padding-left:6px">
 <?php if ($iG==2) {?>
 <input type="checkbox" checked readonly name="fComP" value="<?=$idt?>" />
 <?php } ?> </td>
</tr>
</table>
<script languange="javascript">
	RefreshDATAreff('<?=$Nil?>','<?=$IdL?>');
</script>