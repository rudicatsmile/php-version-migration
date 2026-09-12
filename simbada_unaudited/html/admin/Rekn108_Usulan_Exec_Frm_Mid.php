<?
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);
//echo $crt."#".$PgE."#".$IdT."#".$IdL;
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (Kd_Rekening_17 LIKE '%".$FnD."%' OR Kd_Rekening_108 LIKE '%".$FnD."%')";
}

$RefU = fGlobal("Referensi","ta_permohonan_repla_rek_aset","IDT",$IdT,"=","","");
$UnT  = fGlobal("Kd_Unit","ta_permohonan_repla_rek_aset","IDT",$IdT,"=","","");

?>
<body>
<br>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1080px; height:380px">
  <tr>
    <td>
	<div id="ViewDETA" style="height:380px; width:100%; overflow:auto; border:0px">
	<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="100%" style="border:0px">
	<tr height="25" style="font-size:8pt; font-weight:bold; text-align:center; background-color: #ABD6CD">
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">NO</td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">KODE 17</td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">DESKRIPSI</td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">KODE 108</td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">DESKRIPSI</td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">JML.REK</td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">VERIFIKASI</td>
	  <td style="border-right: 0px solid #ccc; border-bottom: 1px solid #ccc">
	  <? if ($UID=='creator'){?>
	  <a href="#" onClick="execFORM_All('<?=$RefU?>','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>'); return false" class="ico mess">
	  <? }?>
	  ACTION
	  <? if ($UID=='creator'){?>
	  </a>
	  <? } ?>	  </td>
	</tr>
	<?
	$iG = $PgE+1;
	$nSQ = "SELECT IDT, Kd_Rekening_17, Kd_Rekening_108, CheckList, Status, Executed 
	FROM ta_permohonan_repla_rek_aset_rinci 
	WHERE Referensi='".$RefU."' $CrT ORDER BY IDT LIMIT $PgE,50";
	$nRs = mysql_query($nSQ);
	#echo $nSQ;
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gBG  = fBackCLR($iG);
		$gIDT = $mRo[0];
		$mRo1 = $mRo[1];
		$mRo2 = $mRo[2];
		$mRo3 = $mRo[3];
		$mRo4 = $mRo[4];
		$mRo5 = $mRo[5];
		
		$nX = (int)substr($mRo1,0,2);
		$gNmA = fGlobal("Nm_Aset","ref_rek_aset5","Kd_Aset",$mRo1,"=","","");
		$gCnT = fGlobal("IfNull(count(*),0)","ta_kib_".fNmHuruf($nX),"Kd_Aset:Kd_UPB",$mRo1.":".$UnT."%","=:LIKE","","");
		
		$gNmB = "-";
		if ($mRo2){
			$gNmB = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$mRo2,"=","","");
		}else{
			$mRo2 = "<font style='color:#ff0000'>???</font>";
		}
		
		if ($mRo5=='Y'){
			$rIco="oke";
			$rCap="Executed";
		}
		else{
			$rIco="edit";
			$rCap="Execute";
		}
		$ePros = "none";
		if ($mRo4=='Disetujui'){
			$ePros = "";
		}
		?>
		<tr height="23">
		  <td valign="top" <?=$gBG?> width="30" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$iG?></td>
		  <td valign="top" width="100" <?=$gBG?> style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$mRo1?></td>
		  <td valign="top" width="280" <?=$gBG?> style="border-bottom: 1px dotted #999; border-right: 1px solid #ccc; padding-left:3px"><?=$gNmA?></td>
		  <td valign="top" width="110" <?=$gBG?> style="border-bottom: 1px dotted #999; border-right: 1px solid #ccc; text-align:center"><?=$mRo2?></td>
		  <td valign="top" width="280" <?=$gBG?> style="border-bottom: 1px dotted #999; border-right: 1px solid #ccc; padding-left:3px"><?=$gNmB?></td>
		  <td valign="top" width="80" <?=$gBG?> style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$gCnT?> item</td>
		  <td valign="top" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc <? if ($mRo4=='Ditolak'){echo "; color:#ff0000";} if ($mRo4=='Belum'){echo "; color:#0000ff";}?>" <?=$gBG?>><?=$mRo4?></td>
		  <td valign="top" <?=$gBG?> style="border-bottom: 1px dotted #999; text-align:center">
		  <a href="#" onClick="exeRECORD('<?=$ePros?>','<?=$gIDT?>','<?=$gFnD?>','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>'); return false" class="ico <?=$rIco?>"><?=$rCap?></a>
		  </td>
		</tr>
		<? 
		$iG++;
	} ?>
	<tr height="100%">
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td valign="top" align="center">
	  <? if ($UID=='creator'){?>
	  <a href="#" onClick="execFORM_All('<?=$RefU?>','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>'); return false" class="ico mess">&nbsp;
	  <?
	  if ($tUnExe){
	  	echo "Execute";
	  	#echo $tUnExe;
	  }
	  else{
	  	echo "Execute";
	  }
	  ?> All <? } ?></a></td>
	</tr>
	</table>
	</div>
	</td>
  </tr>
</table>
</body>	

