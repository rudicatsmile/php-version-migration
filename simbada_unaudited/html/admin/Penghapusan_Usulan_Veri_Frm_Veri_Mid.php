<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

require('Penghapusan_Usulan_Veri_Frm_Veri_Imp.php');

$gH = fGetDate('mday');
$gB = fGetDate('mon');
$gT = fGetDate('year');
if ($rID)
{
	$nSQ = "SELECT Referensi,Ref_Usulan,Kd_UPB,Nomor,Tanggal,Jenis,Nma_Verifikator,Jab_Verifikator,Nip_Verifikator,Uraian 
	FROM ta_usulan_verifikasi_108 WHERE IDT='$rID'";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mRo0 = $mRo[0];
		$mRo1 = $mRo[1];
		$KdUP = $mRo[2];
		$mRo2 = strtoupper(fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo[2],0,11),"=","",""));
		$mRo3 = $mRo[3];
		$mRo4 = $mRo[4];
		$mRo4 = explode('-',$mRo4);
		$gH = $mRo4[2];
		$gB = $mRo4[1];
		$gT = $mRo4[0];
		$mRo5 = fGlobal("Deskripsi","ref_usulan_jenis","Kode",$mRo[5],"=","","");
		$mRo6 = $mRo[6];
		$mRo7 = $mRo[7];
		$mRo8 = $mRo[8];
		$mRo9 = $mRo[9];
		//$mRo10= $mRo[10];
	}
}
?>
<body>
<br>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1080px; height:120px; background:#729d65; color:#fff">
  <tr height="15">
    <td width="10"></td>
    <td width="74"></td>
    <td width="11"></td>
    <td colspan="4"></td>
    <td colspan="2"></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">TANGGAL</td>
    <td>&nbsp;</td>
    <td width="294">
	<select class="boxs" name="fH" tabindex="0" style="width:50px" onclick="RefreshDATA('<?=$IdL?>')">
      <?
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gH) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fB" tabindex="0" style="width:80px" onclick="RefreshDATA('<?=$IdL?>')">
	<?
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gB) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fT" style="width: 60px" tabindex="0" onclick="RefreshDATA('<?=$IdL?>')">
 	<?
	for($i=2014; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gT) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>	</td>
    <td width="103" align="right">VERIFIKATOR</td>
    <td width="18">&nbsp;</td>
    <td width="217"><input name="fNmA" type="text" value="<?=$mRo6?>" maxlength="150" style="padding-left:5px; height:15px; width:187px; border: 1px solid #C0C0C0"/></td>
    <td width="49">MEMO</td>
    <td width="304" rowspan="3" valign="top"><textarea name="fMeM" style="border: 1px solid #C0C0C0; height:68px; width:260px"><?=$mRo9?></textarea></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">NOMOR</td>
    <td>&nbsp;</td>
    <td><input name="fNoM" type="text" value="<?=$mRo3?>" style="padding-left:5px; height:15px; width:187px; border: 1px solid #C0C0C0"/></td>
    <td align="right">JABATAN</td>
    <td>&nbsp;</td>
    <td><input name="fJbT" type="text" value="<?=$mRo7?>" maxlength="100" style="padding-left:5px; height:15px; width:187px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right"> USULAN</td>
    <td>&nbsp;</td>
    <td><input name="fJeN" type="text" value="<?=$mRo5?>" readonly style="padding-left:5px; height:15px; width:187px; border: 1px solid #C0C0C0"/></td>
    <td align="right">NIP</td>
    <td>&nbsp;</td>
    <td><input name="fNiP" type="text" value="<?=$mRo8?>" maxlength="35" style="padding-left:5px; height:15px; width:187px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">SKPD</td>
    <td>&nbsp;</td>
    <td><input name="fSkP" type="text" value="<?=$mRo2?>" readonly style="padding-left:5px; height:15px; width:280px; border: 1px solid #C0C0C0"/></td>
    <td align="right">
	<div id="loadingImg" style="width:40px; height:10px; display:none"><img src="Images/loading3.gif" alt="" width="30" height="30"></div>
	</td>
    <td>&nbsp;</td>
    <td><input type="button" name="B3923" value="SAVE" onClick="SaveDATA('<?=$ReO?>','<?=$PgE?>','<?=$rID?>','<?=$IdT?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B39232" value="REFRESH" onClick="showFORM('<?=$ReO?>','refr','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
	</td>
    <td align="right" colspan="2" style="padding-right:38px">
	<? if ($UID=='creator'){?>
	<input type="button" name="B39233" value="Creator Verifikasi All" onClick="creatorEXE('<?=$mRo0?>','<?=$IdL?>')" style="width: 150px; height: 21px; color:#FF0000" />
	<? } ?>
	</td>
  </tr>
  <tr height="15">
    <td></td>
    <td></td>
    <td></td>
    <td colspan="4"></td>
    <td colspan="2"></td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1080px; height:23px; background-color:#C9DCD8">
  <tr>
  <td style="padding-left:10px; font-weight:bold; font-size:13px; text-shadow: #fff 1px 1px 1px">RINCIAN ASET YANG DIUSULKAN
	<div id="exceMstVeri" class="creator0Veri" style="background-color: #C9DCD8">
		<div id="exceDiv1Veri" class="creator1Veri"></div>
		<div id="exceDiv2Veri" class="creator2Veri" style="background-color: #C9DCD8"></div>
		<div id="exceDiv3Veri" class="creator3Veri" style="background-color: #C9DCD8"></div>
	</div>	
	
  </td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1080px; height:220px">
  <tr>
    <td>
	<div id="ViewDETA" style="height:227px; width:100%; overflow:auto; border:0px">
	<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="100%" style="border:0px">
	<?
	$iG=$PgE+1;
	$SQ = "SELECT IDT,Ref_Usulan,Ref_Aset,Kd_Aset,No_Register,Nm_Aset,Tgl_Perolehan,Kd_Rinci,Harga,Verifikasi 
	FROM ta_usulan_verifikasi_rinci_108 WHERE Referensi='$mRo0' ORDER BY IDT LIMIT $PgE,100";
	//echo $SQ;
	$Rs = mysql_query($SQ);
	while ($nRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$tID = $nRo[0];
		$gBG  = fBackCLR($iG);
		
		$mSG = "";
		?>
		<tr height="23">
		  <td valign="top" <?=$gBG?> width="30" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$iG?>.</td>
		  <td valign="top" <?=$gBG?> width="110" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$nRo[1]?></td>
		  <td valign="top" <?=$gBG?> width="100" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$nRo[2]?></td>
		  <td valign="top" <?=$gBG?> width="85" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$nRo[3]?></td>
		  <td valign="top" <?=$gBG?> width="50" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$nRo[4]?></td>
		  <td valign="top" <?=$gBG?> style="border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$nRo[5]?></td>
		  <td valign="top" <?=$gBG?> width="90" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc; text-align:right"><?=fConvertToRupiahBulat($nRo[8])?></td>
		  <td valign="top" <?=$gBG?> width="90" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc; font-size:8pt; color:#FF0000"><?=strtoupper($nRo[9])?></td>
		  <td valign="top" <?=$gBG?> width="150" style="border-bottom: 1px dotted #999; text-align:center">
		  <a href="#" onClick="editFORM('','<?=$mSG?>','<?=$tID?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;Edit</a>&nbsp;&nbsp;
		  <a href="#" onClick="showIMG('Img','<?=$tID?>','<?=$IdL?>'); return false" class="ico img">&nbsp;&nbsp;IMG</a>&nbsp;&nbsp;
		  <a href="#" onClick="showIMG('Pdf','<?=$tID?>','<?=$IdL?>'); return false" class="ico pdf">&nbsp;&nbsp;PDF</a>
		  </td>
		</tr>
		<?
		$iG++;
	}
	?>
	<tr height="100%">
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td></td>
	</tr>
	</table>
	</div>
	</td>
  </tr>
</table>
</body>	

