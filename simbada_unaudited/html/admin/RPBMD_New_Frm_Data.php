<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="100%" style="border:0px">
<?
$iG=1;
$tJmL=0;

$nSQ = "SELECT IDT, Ref_Aset, Kd_Aset, Nm_Aset, No_Register, Harga,Nilai_Akhir, Uraian, Kondisi, Asal_Usul  
FROM ta_rpbmd_new_aset WHERE Referensi='$gREF' ORDER BY IDT";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$xB   = "";
	$pad  = 5;
	$CrT  = "aset";
	$gBG  = fBackCLR($iG);
	$rIdT = $mRo[0];
	$mRo1 = $mRo[1];
	$mRo2 = $mRo[2];
	$mRo3 = $mRo[3];
	$mRo4 = $mRo[4];
	$mRo5 = $mRo[5];
	$mRo6 = $mRo[6];
	$mRo7 = $mRo[7];
	$mRo8 = $mRo[8];
	$mRo9 = $mRo[9];
	RowList($stLOCK,$CrT,$iG,$mRo1,$mRo2,$mRo3,$mRo4,$mRo5,$mRo6,$mRo7,$mRo8,$mRo9,$rIdT,$IdL,$pad,DatabaseSB,$ConSB,$gBG,$xB);
	$iG++;
}

function RowList($stLOCK,$CrT,$iG,$mRo1,$mRo2,$mRo3,$mRo4,$mRo5,$mRo6,$mRo7,$mRo8,$mRo9,$rIdT,$IdL,$pad,$DatabaseSB,$ConSB,$gBG,$xB)
{
	$gJnSR = "";
	$span  = 1;
	?>
	<tr height="25"> 
	  <td width="29" rowspan="<?=$span?>" style="border-bottom:1px #999999 dotted; text-align:center" <?=$gBG?>><? if ($iG){echo $iG.".";}?></td>
	  <td width="90" rowspan="<?=$span?>" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$xB.$mRo2?></td>
	  <td rowspan="<?=$span?>" style="border-bottom:1px #999999 dotted; padding-left:<?=$pad?>px; border-left:1px #ccc solid" <?=$gBG?>><? if ($CrT=='rekn') {echo $xB."<b>".$mRo3."</b>".$gJnSR;} else {echo strtoupper($xB.$mRo3);}?></td>
	  <td width="750" style="border-bottom:1px #999999 dotted; padding-left:3px; border-left:1px #ccc solid" <?=$gBG?>>
	  <?
	   if ($CrT=='kegi'){
	   		echo "OUTPUT&nbsp;&nbsp;==>&nbsp;&nbsp;";
			?>
			<input name="fOutP" id="fOutP" type="text" value="<?=$gOutP?>" onkeypress="if (event.keyCode==13) {saveRECO('','output',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; padding-left:5px; width:542px; border: 1px solid #C0C0C0; background:#FFFF99"/>
			<?
	   }
	   if ($CrT=='aset'){
			?>
			<table width="100%" cellpadding="0" cellspacing="1" style="font-family:arial narrow; font-size:8pt">
			<tr height="15" valign="top">
			  <td width="80" align="right">Nilai</td>
			  <td width="15" align="center">:</td>
			  <td width="84" align="right"><?=fConvertToRupiah($mRo5)?></td>
			  <td width="5">&nbsp;</td>
			  <td width="100" align="right">No. Register</td>
			  <td width="15" align="center">:</td>
			  <td><?=$mRo4?></td>
			</tr>
			<tr height="15" valign="top">
			  <td align="right">Nilai Akhir</td>
			  <td align="center">:</td>
			  <td align="right"><?=fConvertToRupiah($mRo6)?></td>
			  <td>&nbsp;</td>
			  <td align="right">Asal-Usul</td>
			  <td align="center">:</td>
			  <td><?=$mRo9?></td>
			</tr>
			<tr height="15" valign="top">
			  <td align="right">Kondisi</td>
			  <td align="center">:</td>
			  <td colspan="2"><?=$mRo8?></td>
			  <td align="right">Keterangan</td>
			  <td align="center">:</td>
			  <td><?=$mRo7?></td>
			</tr>
			</table>
	  <? }
	  
	   $delt="dele";
	   if ($stLOCK=='1'){
		   $delt="delt";
	   }
	  ?>	  </td>
	  <td width="90" rowspan="<?=$span?>" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:center" <?=$gBG?>>
	  <a href="#" onClick="remoPKRK('<?=$stLOCK?>','<?=$rIdT?>','<?=$IdL?>'); return false" class="ico <?=$delt?>">&nbsp;&nbsp;Remove</a>	  </td>
	</tr>
<? } ?>

<?
function AddKEG($rIdT,$IdL)
{
	?>
	<tr height="30">
	 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; padding-left:20px">
	 <a href="#" onClick="showKEGI('','<?=$rIdT?>','<?=$IdL?>'); return false" class="ico add">&nbsp;&nbsp;Add KEGIATAN</a>	 </td>
	 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; padding-left:20px">&nbsp;</td>
	 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	</tr>
	<?
}
?>
<?
function AddREK($kIdT,$IdL)
{
	?>
	<tr height="20">
	 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; padding-left:40px">
	 <a href="#" onClick="showREKN('','<?=$kIdT?>','<?=$IdL?>'); return false" class="ico add">&nbsp;&nbsp;Add REKENING</a>	 
	 <!--ngdep ke aset : a href="#" onClick="showASET('','<?=$kIdT?>','<?=$IdL?>'); return false" class="ico add">&nbsp;&nbsp;Add ASET</a-->	 </td>
	 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; padding-left:40px">&nbsp;</td>
	 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	</tr>
	<?
}
?>
<? if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double; vertical-align:top; text-align:center; color:#fff; font-size:10pt; font-style:italic"><!--font style="background:#000000">&nbsp;&nbsp;** Tekan <b>ENTER</b> untuk menyimpan data **&nbsp;&nbsp;</font--></td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double; vertical-align:top; text-align:center; color:#fff; font-size:10pt; font-style:italic">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
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
 <td colspan="6" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
