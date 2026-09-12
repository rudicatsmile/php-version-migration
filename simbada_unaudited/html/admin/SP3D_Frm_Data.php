<?
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
require("CheckLogin.php");
extract($_GET);

$nSQ = "SELECT IDT, Kd_ReknP90, Nm_ReknP90 FROM ta_sp3d_rinci WHERE Kd_ReknP90 LIKE '_._._.__.__.___' ORDER BY IDT";
#echo $nSQ."<br>";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$IdT = $mRo[0];
	echo $mRo[1]."<br>";
	$NewR = substr($mRo[1],0,4);
	$NewR.= substr("00".substr($mRo[1],4,1),-2,2);
	$NewR.= substr($mRo[1],-10,10);
	echo $NewR."<br>";
	
	$nS = "UPDATE ta_sp3d_rinci SET Kd_ReknP90='".$NewR."' WHERE IDT='".$IdT."'";
	echo $nS."<br>";
	$nR = mysql_query($nS);
}

$nSQ = "SELECT IDT, Kd_ReknP90, Nm_ReknP90 FROM ta_sp3d_spj WHERE Kd_ReknP90 LIKE '_._._.__.__.___' ORDER BY IDT";
#echo $nSQ."<br>";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$IdT = $mRo[0];
	echo $mRo[1]."<br>";
	$NewR = substr($mRo[1],0,4);
	$NewR.= substr("00".substr($mRo[1],4,1),-2,2);
	$NewR.= substr($mRo[1],-10,10);
	echo $NewR."<br>";
	
	$nS = "UPDATE ta_sp3d_spj SET Kd_ReknP90='".$NewR."' WHERE IDT='".$IdT."'";
	echo $nS."<br>";
	$nR = mysql_query($nS);
}

$nSQ = "SELECT IDT, Kd_ReknP90, Kd_ReknP90 FROM ta_sp3d_spj_rinci WHERE Kd_ReknP90 LIKE '_._._.__.__.___' ORDER BY IDT";
#echo $nSQ."<br>";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$IdT = $mRo[0];
	echo $mRo[1]."<br>";
	$NewR = substr($mRo[1],0,4);
	$NewR.= substr("00".substr($mRo[1],4,1),-2,2);
	$NewR.= substr($mRo[1],-10,10);
	echo $NewR."<br>";
	
	$nS = "UPDATE ta_sp3d_spj_rinci SET Kd_ReknP90='".$NewR."' WHERE IDT='".$IdT."'";
	echo $nS."<br>";
	$nR = mysql_query($nS);
}


if (substr($gREF,-8,8)!="XXXXXXXX")
{
	$nSQL= "SELECT Kd_UPB, KdJenis, KdSesi, Tahun FROM ta_sp3d WHERE Referensi='$gREF'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$gUPB = $mRo[0];
	$gJNS = $mRo[1];
	$gSES = $mRo[2];
	$gTH  = $mRo[3];
	$fSLA = fGlobal("Nilai","ta_sp3d_saldo_awal","Kd_UPB:KdJenis:KdTahap:Tahun",$gUPB.":".$gJNS.":".$gSES.":".$gTH,"=:=:=:=","","");
	
	$dJNS = fGlobal("Deskripsi","ref_sp3d_jenis","Kode",$gJNS,"=","","");
	$Lock = fGlobal($dJNS,"ta_sp3d_lock","Kd_UPB:Tahun",$gUPB.":".$gTH,"=:=","","");
	if ($Lock=='N')
	{
		#Lock by tahap selanjutnya
		$Lock = fGlobal("IDT","ta_sp3d","Kd_UPB:Tahun:KdJenis:KdSesi",$gUPB.":".$gTH.":".$gJNS.":".$gSES,"=:=:=:>","IDT LIMIT 0,1","");
		if ($Lock){$Lock='Y';}
	}
	
	$tJm4 = fGlobal("IfNull(sum(Nilai),0)","ta_sp3d_rinci","Referensi:Kd_ReknP90",$gREF.":4%","=:LIKE","","");
	$tJm5 = fGlobal("IfNull(sum(Nilai),0)","ta_sp3d_rinci","Referensi:Kd_ReknP90",$gREF.":5%","=:LIKE","","");
	$fSLD = $fSLA + $tJm4 - $tJm5;
	/*Auto record saldo akhir*/
	if ($gSES<=4)
	{
		$fCeK = fGlobal("IDT","ta_sp3d_saldo_akhir","Kd_UPB:KdJenis:KdTahap:Tahun",$gUPB.":".$gJNS.":".$gSES.":".$gTH,"=:=:=:=","","");
		if ($fCeK==''){
			$gTBL = "ta_sp3d_saldo_akhir";
			$gFLD = "";
			$gVAL = "";
			
			$gFLD = "Kd_UPB";
			$gVAL = "'$gUPB'";
			
			$gFLD.= ", Tahun";
			$gVAL.= ", '$gTH'";
			
			$gFLD.= ", KdJenis";
			$gVAL.= ", '$gJNS'";
			
			$gFLD.= ", KdTahap";
			$gVAL.= ", '".$gSES."'";
			
			$gFLD.= ", Nilai";
			$gVAL.= ", '$fSLD'";
			
			$gFLD.= ", Uraian";
			$gVAL.= ", 'Auto record'";
			
			$gFLD.= ", Pencatat";
			$gVAL.= ", '".$UID."'";
			$gFLD.= ", Recorded";
			$gVAL.= ", now()";
			
			InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
		}
		else
		{
			$gTBL = "ta_sp3d_saldo_akhir";
			$gDTA = "";
			$gDTA.= "Nilai='".$fSLD."'";
			$gIdX = 'IDT';
			$gSyR = $fCeK;
			$gOpR = '=';
			UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,DatabaseSB,$ConSB);
		}
	}
	
	/*Auto record saldo awal untuk tahap berikutnya*/
	if (($gSES+1)<=4)
	{
		$fCeK = fGlobal("IDT","ta_sp3d_saldo_awal","Kd_UPB:KdJenis:KdTahap:Tahun",$gUPB.":".$gJNS.":".($gSES+1).":".$gTH,"=:=:=:=","","");
		if ($fCeK==''){
			$gTBL = "ta_sp3d_saldo_awal";
			$gFLD = "";
			$gVAL = "";
			
			$gFLD = "Kd_UPB";
			$gVAL = "'$gUPB'";
			
			$gFLD.= ", Tahun";
			$gVAL.= ", '$gTH'";
			
			$gFLD.= ", KdJenis";
			$gVAL.= ", '$gJNS'";
			
			$gFLD.= ", KdTahap";
			$gVAL.= ", '".($gSES+1)."'";
			
			$gFLD.= ", Nilai";
			$gVAL.= ", '$fSLD'";
			
			$gFLD.= ", Uraian";
			$gVAL.= ", 'Auto record'";
			
			$gFLD.= ", Pencatat";
			$gVAL.= ", '".$UID."'";
			$gFLD.= ", Recorded";
			$gVAL.= ", now()";
			
			InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
		}
		else
		{
			$gTBL = "ta_sp3d_saldo_awal";
			$gDTA = "";
			$gDTA.= "Nilai='".$fSLD."'";
			$gIdX = 'IDT';
			$gSyR = $fCeK;
			$gOpR = '=';
			UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,DatabaseSB,$ConSB);
		}
	}
	/*End auto record*/
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="250px" style="border:0px">
<?

$iG = 1;
$tJm4 = 0;
$tJm5 = 0;
$nSQ = "SELECT IDT, Kd_ReknP90, Nm_ReknP90, Nilai, Uraian FROM ta_sp3d_rinci WHERE Referensi='".$gREF."' ORDER BY IDT";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$rIdT = $mRo[0];
	$rREK = substr($mRo[1],0,1);
	
	$DeL  = "";
	$rDel = "dell";
	if ($Lock=='Y'){
		$rCek="Y";
		$Cc="; color:#999";
	}
	else{
		$rCek = fGlobal("IDT","ta_sp3d_spj_rinci","Referensi_SP3B:Kd_ReknP90",$gREF.":".$mRo[1],"=:=","IDT LIMIT 0,1","");
	}
	if ($rCek){
		$rDel = "delt";
	}
	?>
	<tr height="26"> 
	  <td width="27" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="97" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="400" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px"><?=$mRo[2]?></td>
	  <td width="280" style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid" <?=$gBG?>>
	  <input name="fUrA" id="fUrA" type="text" value="<?=$mRo[4]?>" 
	  onkeypress="if (event.keyCode==13){ SaveRecord(this,'URA','<?=$Lock?>','<?=$rIdT?>','<?=$IdL?>'); return false;}" 
	  style="padding-left:3px; width:276px; border: 1px solid #C0C0C0; <?=TxBckCLR($iG)?>"/>
	  </td>
	  <td width="112" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <input name="fNiL" id="fNiL" type="text" value="<?=fConvertToRupiah($mRo[3])?>" 
	  onKeyUp="addSeparatorNum(this)" 
	  onkeypress="if (event.keyCode==13){ SaveRecord(this,'JML','<?=$Lock?>','<?=$rIdT?>','<?=$IdL?>'); return false;}" 
	  style="text-align:right; padding-right:3px; width:100px; border: 1px solid #C0C0C0; <?=TxBckCLR($iG)?> <?=$Cc?>" <? if ($Lock=='Y'){echo "readonly";}?>/>
	  </td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="#" onClick="showDELE('<?=$rIdT?>','<?=$Lock?>','<?=$rCek?>','<?=$IdL?>'); return false" class="ico <?=$rDel?>">del</a></td>
	</tr>
	<?
	$iG++;
	if ($rREK=='4'){
		$tJm4 = $tJm4 + $mRo[3];
	}
	else{
		$tJm5 = $tJm5 + $mRo[3];
	}
	
}

$fSLD = $fSLA + $tJm4 - $tJm5;
?>
<? if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 </tr>
<tr height="18">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="4">SALDO AWAL</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($fSLA)?></td>
  <td style="border-left:1px #ccc solid">&nbsp;</td>
</tr>
<tr height="18">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="4">TOTAL PENDAPATAN</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJm4)?></td>
  <td style="border-left:1px #ccc solid">&nbsp;</td>
</tr>
<tr height="18">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="4">TOTAL BELANJA</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJm5)?></td>
  <td style="border-left:1px #ccc solid">&nbsp;</td>
</tr>
<tr height="18">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="4">SALDO AKHIR</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($fSLD)?></td>
  <td style="border-left:1px #ccc solid">&nbsp;</td>
</tr>
<? }else{ ?>
<tr height="100%">
 <td colspan="7" align="center">Data rekening tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
