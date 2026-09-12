<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="100%" style="border:0px">
<?

$iG=$PgE+1;
$tJmL=0;
$nSQ = "SELECT IDT, Referensi, Kd_Program, Nm_Program, LinkMurni 
FROM ta_rkbmd_new_program WHERE Referensi='$gREF' AND Tahun='$gTHN' AND Apbd='$gUBH' ORDER BY IDT";
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
	$Link = $mRo[4];
	
	if ($gUBH=='0'){
		$eCeK = fGlobal("IDT","ta_rkbmd_new","Referensi:Apbd",$mRo1.":1","=:=","","");
	}
	
	RowList($stLOCK,$CrT,$iG,$mRo1,$mRo2,$mRo3,$rIdT,$IdL,$pad,DatabaseSB,$ConSB,$xB,$Link,$eCeK);
	viewKEG($stLOCK,$gREF,$mRo2,$gTHN,$gUBH,$eCeK,$IdL,DatabaseSB,$ConSB,"");
	AddKEG($stLOCK,$rIdT,$IdL);
	$iG++;
}

function viewKEG($stLOCK,$gREF,$mRo2,$gTHN,$gUBH,$eCeK,$IdL,$DatabaseSB,$ConSB,$fH)
{
	if (substr($mRo2,0,3)=='000'){
		$mRo2 = "___.".substr($mRo2,-2,2);
	}
	$mSQ = "SELECT IDT, Referensi, Kd_Kegiatan, Nm_Kegiatan, LinkMurni 
	FROM ta_rkbmd_new_kegiatan WHERE Referensi='$gREF' AND Kd_Kegiatan LIKE '$mRo2%' 
	AND Tahun='$gTHN' AND Apbd='$gUBH' ORDER BY IDT";
	if ($fH) echo $mSQ."<br>";
	$nR = mysql_query($mSQ);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		#$CeK = fGlobalNEW("count(*)","ta_rkbmd_new_rekening","Referensi:Kd_Kegiatan:Tahun:Apbd",$gREF.":".$mR[2].":".$gTHN.":".$gUBH,"=:=:=:=","",$DatabaseSB,$ConSB,"");
		$CeK = fGlobalNEW("count(*)","ta_rkbmd_new_kegiatan_sub","Referensi:Kd_Kegiatan:Tahun:Apbd",$gREF.":".$mR[2].":".$gTHN.":".$gUBH,"=:=:=:=","",$DatabaseSB,$ConSB,"");
		if ($CeK>0){
			$xB   = "<b>";
		}
		else{
			$xB   = "";
		}
		$pad  = 5;
		$CrT  = "kegi";
		$gBG  = fBackCLR($iG);
		$rIdT = $mR[0];
		$mRo1 = $mR[1];
		$mRo2 = $mR[2];
		$mRo3 = "<u>Kegiatan</u> :<br>".strtoupper($mR[3]);
		$Link = $mR[4];
		RowList($stLOCK,$CrT,'',$mRo1,$mRo2,$mRo3,$rIdT,$IdL,$pad,$DatabaseSB,$ConSB,$xB,$Link,$eCeK);
		viewSUB($stLOCK,$gREF,$mRo2,$gTHN,$gUBH,$eCeK,$IdL,$DatabaseSB,$ConSB,"");
		AddSUB($stLOCK,$rIdT,$IdL);
	}
}

function viewSUB($stLOCK,$gREF,$mRo2,$gTHN,$gUBH,$eCeK,$IdL,$DatabaseSB,$ConSB,$fH)
{
	$mSR = "SELECT IDT, Referensi, Kd_Sub_Kegiatan, Nm_Sub_Kegiatan, LinkMurni 
	FROM ta_rkbmd_new_kegiatan_sub WHERE Referensi='$gREF' AND Kd_Sub_Kegiatan LIKE '$mRo2%' 
	AND Tahun='$gTHN' AND Apbd='$gUBH' ORDER BY IDT";
	if ($fH) echo $mSR."<br>";
	$nE = mysql_query($mSR);
	while ($mE = mysql_fetch_array($nE, MYSQL_BOTH))
	{
		#$CeK = fGlobalNEW("count(*)","ta_rkbmd_new_rekening","Referensi:Kd_Sub_Kegiatan:Tahun:Apbd",$gREF.":".$mE[2].":".$gTHN.":".$gUBH,"=:=:=:=","",$DatabaseSB,$ConSB,"");
		#if ($CeK>0){
		#	$xB   = "<b>";
		#}
		#else{
		#	$xB   = "";
		#}
		$xB   = "<b>";
		$pad  = 5;
		$CrT  = "subk";
		$gBG  = fBackCLR($iG);
		$rIdT = $mE[0];
		$mRo1 = $mE[1];
		$mRo2 = $mE[2];
		$mRo3 = "<u>Sub Kegiatan</u> :<br>".strtoupper($mE[3]);
		$Link = $mE[4];
		RowList($stLOCK,$CrT,'',$mRo1,$mRo2,$mRo3,$rIdT,$IdL,$pad,$DatabaseSB,$ConSB,$xB,$Link,$eCeK);
		viewREK($stLOCK,$gREF,$mRo2,$gTHN,$gUBH,$eCeK,$IdL,$DatabaseSB,$ConSB,"");
		AddREK($stLOCK,$rIdT,$IdL);
	}
}

function viewREK($stLOCK,$gREF,$mRo2,$gTHN,$gUBH,$eCeK,$IdL,$DatabaseSB,$ConSB,$fH)
{
	$mSW = "SELECT IDT, Referensi, Kd_Rekening, Nm_Rekening, LinkMurni 
	FROM ta_rkbmd_new_rekening WHERE Referensi='$gREF' AND Kd_Sub_Kegiatan = '$mRo2' 
	AND Tahun='$gTHN' AND Apbd='$gUBH' ORDER BY IDT";
	if ($fH) echo $mSW."<br>";
	$nW = mysql_query($mSW);
	while ($mW = mysql_fetch_array($nW, MYSQL_BOTH))
	{
		$xB   = "";
		$pad  = 5;
		$CrT  = "rekn";
		$gBG  = fBackCLR($iG);
		$rIdT = $mW[0];
		$mRo1 = $mW[1];
		$mRo2 = $mW[2];
		$mRo3 = "<u>Rekening</u> :<br>".$mW[3];
		$Link = $mW[4];
		RowList($stLOCK,$CrT,'',$mRo1,$mRo2,$mRo3,$rIdT,$IdL,$pad,$DatabaseSB,$ConSB,$xB,$Link,$eCeK);
	}
}

function RowList($stLOCK,$CrT,$iG,$mRo1,$mRo2,$mRo3,$rIdT,$IdL,$pad,$DatabaseSB,$ConSB,$xB,$Link,$eCeK)
{
	$gJnSR = "";
	if ($CrT=='rekn'){
		$DtA = fGlobalNEW("
		referensi:usulan_jumlah:usulan_satuan:usulan_harga:maksimum_jumlah:maksimum_satuan:optimalisasi_jumlah:optimalisasi_satuan:cara_pemenuhan:keterangan:LockRecord:Kd_Unit:Tahun:Apbd:Kd_Rekening","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		$DtA = explode(':',$DtA);
		$RefR  = $DtA[0];
		$gUsuL = $DtA[1];
		$gUsuT = $DtA[2];
		$gHarG = $DtA[3];
		$gKebU = $DtA[4];
		$gKebT = $DtA[5];
		$gOptI = $DtA[6];
		$gOptT = $DtA[7];
		$gPenU = $DtA[8];
		$gKetR = $DtA[9];
		$gLokR = $DtA[10];
		
		$SkP = $DtA[11];
		$ThN = $DtA[12];
		$ApB = $DtA[13];
		$ReK = $DtA[14];
		######
		$gOLD = fGlobalNEW("IDT","ta_rkbmd_new_rekening","Kd_Unit:Tahun:Apbd:Kd_Rekening:IDT",$SkP.":".$ThN.":".$ApB.":".$ReK.":".$rIdT,"=:=:=:=:<","IDT LIMIT 0,1",$DatabaseSB,$ConSB,"");
		
		#$gUsuL = fGlobalNEW("usulan_jumlah","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		#$gUsuT = fGlobalNEW("usulan_satuan","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		#$gHarG = fGlobalNEW("usulan_harga","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");

		#$gKebU = fGlobalNEW("maksimum_jumlah","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		#$gKebT = fGlobalNEW("maksimum_satuan","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");

		#$gOptI = fGlobalNEW("optimalisasi_jumlah","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		#$gOptT = fGlobalNEW("optimalisasi_satuan","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		
		#$gPenU = fGlobalNEW("cara_pemenuhan","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		#$gKetR = fGlobalNEW("keterangan","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		
		#$gLokR = fGlobalNEW("LockRecord","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		
		$gJnSR = "<br><i>Jenis : ".fGlobalNEW("nm_aset","ref_rek_aset108_5","kd_aset",substr($mRo2,0,11),"=","",$DatabaseSB,$ConSB,"");
		$gJnSR.= "<br><i>Objek : ".fGlobalNEW("nm_aset","ref_rek_aset108_6","kd_aset",substr($mRo2,0,14),"=","",$DatabaseSB,$ConSB,"");
		
	}
	else{
		$gOutP = fGlobalNEW("output","ta_rkbmd_new_kegiatan_sub","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
	}
	?>
	<tr height="40"> 
	  <td width="25" style="border-bottom:1px #999 dotted; text-align:center" <?=$gBG?>><? if ($iG){echo $iG.".";}?></td>
	  <td width="110" style="border-bottom:1px #000 dotted; border-left:1px #ccc solid; text-align:left; padding-left:2px" <?=$gBG?>><?=$xB.$mRo2?></td>
	  <td width="450" style="border-bottom:1px #000 dotted; padding-left:<?=$pad?>px; border-left:1px #ccc solid" <?=$gBG?>><? if ($CrT=='rekn') {echo $xB."<font style='color:#0000ff'>".$mRo3."</font>".$gJnSR;} else {echo $xB.$mRo3;}?></td>
	  <td style="border-bottom:1px #000 dotted; padding-left:3px; border-left:1px #ccc solid" <?=$gBG?>>
	  <?
		$delt="dele";
		$eReD="";
		$eReDB="";
		if ($stLOCK=='1' || $gLokR=='Y'){
			$delt ="delt";
			$eReD ="readonly";
			$eReDB="readonly";
		}
		if ($Link=='Ya'){
			$delt="delt";
		}
		if ($eCeK!='' || $gLokR=='Y'){
			$delt ="delt";
			$eReD ="readonly";
			$eReDB="readonly";
		}
		
		 if ($gOLD!='')
		 {
			$eReDB="readonly";
		 }
		 
	   if ($CrT=='subk'){
			?>
			<table align="center" border="0" width="100%" cellspacing="0" cellpadding="0" height="100%" style="border:0px">
			<tr height="22">
			  <td width="100">OUTPUT</td>
			  <td width="15">:</td>
			  <td><input name="fOutP" id="fOutP" type="text" <?=$eReD?> value="<?=$gOutP?>" onkeypress="if (event.keyCode==13) {saveRECO('<?=$stLOCK?>','output',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; padding-left:5px; width:530px; border: 1px solid #C0C0C0; background:#FFFF99"/></td>
			</tr>
			</table>
			<?
	   }
	   if ($CrT=='rekn'){
			?>
			<table align="center" border="0" width="100%" cellspacing="0" cellpadding="0" height="100%" style="border:0px">
			<tr height="5">
			  <td colspan="10"></td>
			</tr>
			<tr height="22">
			  <td width="100">Usulan RKBMD</td>
			  <td width="15">:</td>
			  <td width="215"><input name="fUsuL" id="fUsuL" type="text" <?=$eReD?> value="<?=$gUsuL?>" onkeypress="if (event.keyCode==13) {saveRECO('<?=$stLOCK?>','usulan_jumlah',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" onkeyup="NumValidate(this)" style="height:15px; border-radius:0px; text-align:center; width:40px; border: 1px solid #C0C0C0; background:#CCFF99"/>
		      <input name="fUsuT" id="fUsuT" type="text" <?=$eReD?> value="<?=$gUsuT?>" onkeypress="if (event.keyCode==13) {saveRECO('<?=$stLOCK?>','usulan_satuan',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; text-align:left; width:70px; border: 1px solid #C0C0C0; background:#99FF66"/></td>
			  <td width="100">Keb. Maksimum</td>
			  <td width="15">:</td>
			  <td><input name="fKebU" id="fKebU" type="text" <?=$eReDB?> value="<?=$gKebU?>" onkeypress="if (event.keyCode==13) {saveRECO('<?=$stLOCK?>','maksimum_jumlah',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" onkeyup="NumValidate(this)" style="height:15px; border-radius:0px; text-align:center; width:40px; border: 1px solid #C0C0C0 <? if ($gOLD==''){?>; background:#CCFF99<? } ?>"/>
		      <input name="fKebT" id="fKebT" type="text" <?=$eReD?> value="<?=$gKebT?>" onkeypress="if (event.keyCode==13) {saveRECO('<?=$stLOCK?>','maksimum_satuan',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; text-align:left; width:70px; border: 1px solid #C0C0C0<? if ($gOLD==''){?>; background:#99FF66<? } ?>"/></td>
			  </tr>
			<tr height="22">
			  <td>Dipenuhi dgn cara </td>
			  <td>:</td>
			  <td>
			  
			  	<!--input name="fPenU" id="fPenU" type="text" <?=$eReD?> value="<?=$gPenU?>" onkeypress="if (event.keyCode==13) {saveRECO('<?=$stLOCK?>','cara_pemenuhan',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; text-align:left; width:190px; border: 1px solid #C0C0C0; background:#CCFF99"/-->
				
				<select name="fPenU" id="fPenU" tabindex="0" style="width:125px; background:#CCFF99" onchange="saveRECO('<?=$stLOCK?>','cara_pemenuhan',this,'<?=$rIdT?>','<?=$_GET['IdL']?>')">
				<option value="" <? if ($gPenU==''){ echo "selected";}?>></option>
				<option value="Belanja Modal" <? if ($gPenU=='Belanja Modal'){ echo "selected";}?>>Belanja Modal</option>
				<option value="Hibah" <? if ($gPenU=='Hibah'){ echo "selected";}?>>Hibah</option>
				<option value="Tukar Guling" <? if ($gPenU=='Tukar Guling'){ echo "selected";}?>>Tukar Guling</option>
				<option value="Lainnya" <? if ($gPenU=='Lainnya'){ echo "selected";}?>>Lainnya</option>
				</select>
				
			  </td>
			  <td>Optimalisasi (<i>auto</i>)</td>
			  <td>:</td>
			  <td><input name="fOptI" id="fOptI" type="text" <?=$eReDB?> value="<?=$gOptI?>" onkeypress="if (event.keyCode==13) {saveRECO('<?=$stLOCK?>','optimalisasi_jumlah',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" onkeyup="NumValidate(this)" style="height:15px; border-radius:0px; text-align:center; width:40px; border: 1px solid #C0C0C0 <? if ($gOLD==''){?>; background:#CCFF99<? } ?>"/>
		      <input name="fOptT" id="fOptT" type="text" <?=$eReD?> value="<?=$gOptT?>" onkeypress="if (event.keyCode==13) {saveRECO('<?=$stLOCK?>','optimalisasi_satuan',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; text-align:left; width:70px; border: 1px solid #C0C0C0<? if ($gOLD==''){?>; background:#99FF66<? } ?>"/></td>
			  </tr>
			<tr height="22">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>Keterangan</td>
			  <td>:</td>
			  <td><input name="fKetR" id="fKetR" type="text" <?=$eReD?> value="<?=$gKetR?>" onkeypress="if (event.keyCode==13) {saveRECO('<?=$stLOCK?>','keterangan',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; text-align:left; width:200px; border: 1px solid #C0C0C0; background:#CCFF99"/></td>
			</tr>
			<tr height="5">
			  <td colspan="10"></td>
			</tr>
			</table>
	  <?
	   }
	  ?>
	  </td>
	  <td width="50" style="border-bottom:1px #000 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:center" <?=$gBG?>>
	  <a href="#" onClick="remoPKRK('<?=$stLOCK?>','<?=$Link?>','<?=$eCeK?>','<?=$CrT?>','<?=$rIdT?>','<?=$IdL?>'); return false" class="ico <?=$delt?>">&nbsp;&nbsp;Rem</a>	  </td>
	</tr>
<? } ?>

<?
function AddKEG($stLOCK,$rIdT,$IdL)
{
	?>
	<tr height="20">
	 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td colspan="2" style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; padding-left:5px">
	 <a href="#" onClick="showKEGI('<?=$stLOCK?>','','<?=$rIdT?>','<?=$IdL?>'); return false" class="ico add">&nbsp;&nbsp;Add KEGIATAN</a>	 </td>
	 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	</tr>
	<?
}
?>
<?
function AddREK($stLOCK,$rIdT,$IdL)
{
	?>
	<tr height="20">
	 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td colspan="2" style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; padding-left:5px">
	 <a href="#" onClick="showREKN('<?=$stLOCK?>','','<?=$rIdT?>','<?=$IdL?>'); return false" class="ico add">&nbsp;&nbsp;Add REKENING</a>	 </td>
	 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	</tr>
	<?
}
?>
<?
function AddSUB($stLOCK,$rIdT,$IdL)
{
	?>
	<tr height="20">
	 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td colspan="2" style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; padding-left:5px">
	 <a href="#" onClick="showSUBK('<?=$stLOCK?>','','<?=$rIdT?>','<?=$IdL?>'); return false" class="ico add">&nbsp;&nbsp;Add SUB KEGIATAN</a></td>
	 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	</tr>
	<?
}
?>
<? if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td colspan="2" style="border-left:1px #ccc solid; border-bottom:0px #ccc double; vertical-align:top; text-align:center; color:#fff; font-size:10pt; font-style:italic"><font style="background:#000000">&nbsp;&nbsp;** Tekan <b>ENTER</b> untuk menyimpan data **&nbsp;&nbsp;</font></td>
 <td style="border-left:0px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
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
