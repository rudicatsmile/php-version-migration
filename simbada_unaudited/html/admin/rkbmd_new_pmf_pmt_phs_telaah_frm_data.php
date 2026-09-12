<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="100%" style="border:0px">
<?
$iG=$PgE+1;
$tJmL=0;
$nSQ = "SELECT idt as A0,
ref_aset as A1,
kd_aset as A2,
no_register as A3,
tgl_perolehan as A4,
nm_aset as A5,
nilai_perolehan as A6,
lokasi as A7,
referensi as A8,
kd_upb as A9,
ref_group as A10,
extracom as A11,
jml_barang as A12,
peruntukan as A13,
bentuk_pemanfaatan as A14,
jangka_waktu_pemanfaatan as A15,
jangka_waktu_pemanfaatan_disetujui as A16,
bentuk_pemindahtanganan as A17,
alasan_rencana_pemindahtanganan as A18,
alasan_rencana_penghapusan as A19,
keterangan as A20,
LockRecord as A21 

FROM ta_rkbmd_new_pmf_pmt_phs_rinci WHERE referensi='$gREF' ORDER BY idt";
$nRs = mysql_query($nSQ);
#echo $nSQ."<br>";
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$xB   = "<b>";
	$pad  = 5;
	$CrT  = "prog";
	$gBG  = fBackCLR($iG);
	$rIdT = $mRo[0];
	$mRo1 = $mRo[1];
	$mRo2 = $mRo[2];
	$mRo3 = $mRo[3];
	$mRo4 = $mRo[4];
	$mRo5 = $mRo[5];
	$mRo6 = $mRo[6];
	
	if ($gUBH=='0'){
		$eCeK = fGlobal("IDT","ta_rkbmd_new","Referensi:Apbd",$mRo1.":1","=:=","","");
	}
	
	RowList($stLOCK,$CrT,$iG,$mRo1,$mRo2,$mRo3,$mRo4,$mRo5,$mRo6,$mRo7,$mRo8,$mRo9,$rIdT,$IdL,$pad,DatabaseSB,$ConSB,$xB,$Link,$eCeK);
	$iG++;
}

function RowList($stLOCK,$CrT,$iG,$mRo1,$mRo2,$mRo3,$mRo4,$mRo5,$mRo6,$mRo7,$mRo8,$mRo9,$rIdT,$IdL,$pad,$DatabaseSB,$ConSB,$xB,$Link,$eCeK)
{
	$gJnSR = "";
	if ($CrT=='rekn'){
		$LocA = "";
		$LocB = "";
		if ($gLocK=='Y')
		{
			$LocA = "checked";
			$LocB = "";
			
			$CoRA = "FF0000";
			$CoRB = "000000";
		}
		else
		{
			$LocA = "";
			$LocB = "checked";
			
			$CoRA = "000000";
			$CoRB = "0000FF";
		}
	}
	else{
		$gOutP = "";//fGlobalNEW("output","ta_rkbmd_new_kegiatan_sub","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
	}
	
	
	?>
	<tr height="40"> 
	  <td width="25" style="border-bottom:1px #000 dotted; text-align:center" <?=$gBG?>><? if ($iG){echo $iG.".";}?></td>
	  <td width="100" style="border-bottom:1px #000 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo1?></td>
	  <td width="100" style="border-bottom:1px #000 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo2?></td>
	  <td width="60" style="border-bottom:1px #000 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo3?></td>
	  <td width="70" style="border-bottom:1px #000 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo4?></td>
	  <td width="400" style="border-bottom:1px #000 dotted; border-left:1px #ccc solid; text-align:left; padding-left:2px" <?=$gBG?>><?=$mRo5?></td>
	  <td width="100" style="border-bottom:1px #000 dotted; border-left:1px #ccc solid; text-align:right; padding-right:5px" <?=$gBG?>><?=fConvertToRupiah($mRo6)?></td>
	  <td style="border-bottom:1px #000 dotted; padding-left:3px; border-left:1px #ccc solid" <?=$gBG?>>
	  <?
		$delt="dele";
		$eReD="";
		if ($stLOCK=='1'){
			$delt="delt";
			$eReD="readonly";
		}
		if ($Link=='Ya'){
			$delt="delt";
		}
		if ($eCeK!=''){
			$delt="delt";
			$eReD="readonly";
		}
		?>
		</td>
    </tr>
<? } ?>


<? if ($iG>1) {?>
<tr height="100%">
 <td colspan="8" style="border-left:1px #ccc solid; border-bottom:0px #ccc double; text-align:center; color:#fff; font-size:10pt; font-style:italic"><font style="background:#000000">&nbsp;&nbsp;** Tekan <b>ENTER</b> untuk menyimpan data **&nbsp;&nbsp;</font></td>
 </tr>
<!--tr height="20">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="7"><div style="float:left; font-weight:normal; font-style:italic"><font style="color:#FF0000">&nbsp;**</font> &lt;-- Aset sudah tidak ada pada skpd bersangkuatn.</div>
    T O T A L</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmL)?></td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmA)?></td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid">&nbsp;</td>
  <td style="border-left:1px #ccc solid"></td>
  <td colspan="3"></td>
</tr-->
<? }else{ ?>
<tr height="100%">
 <td colspan="9" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
