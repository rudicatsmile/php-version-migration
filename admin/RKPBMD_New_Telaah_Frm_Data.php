<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="100%" style="border:0px">
<?php
$iG=$PgE+1;
$tJmL=0;

$nSQ = "SELECT IDT, Referensi, Kd_Program, Nm_Program, LinkMurni  
FROM ta_rkpbmd_new_program WHERE Referensi='$gREF' AND Tahun='$gTHN' AND Apbd='$gUBH' ORDER BY IDT";
$nRs = mysql_query($nSQ);
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
	
	$eCeK = "";
	if ($gUBH=='0'){
		$eCeK = fGlobal("IDT","ta_rkpbmd_new","referensi:tahun:apbd",$mRo1.":".$gTHN.":1","=:=:=","","");
	}
	
	RowList($stLOCK,$CrT,$iG,$mRo1,$mRo2,$mRo3,$rIdT,$gTHN,$gUBH,$IdL,$pad,DatabaseSB,$ConSB,$xB,$Link,$eCeK);
	viewKEG($stLOCK,$gREF,$gTHN,$gUBH,$mRo2,$eCeK,$IdL,DatabaseSB,$ConSB);
	#AddKEG($stLOCK,$rIdT,$IdL);
	$iG++;
}

function viewKEG($stLOCK,$gREF,$gTHN,$gUBH,$mRo2,$eCeK,$IdL,$DatabaseSB,$ConSB){
	$mSQ = "SELECT IDT, Referensi, Kd_Kegiatan, Nm_Kegiatan, LinkMurni  
	FROM ta_rkpbmd_new_kegiatan WHERE Referensi='$gREF' AND Kd_Kegiatan LIKE '$mRo2%' AND Tahun='$gTHN' AND Apbd='$gUBH' ORDER BY IDT";
	$nR = mysql_query($mSQ);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$xB   = "<b>";
		$pad  = 5;
		$CrT  = "kegi";
		$gBG  = fBackCLR($iG);
		$rIdT = $mR[0];
		$mRo1 = $mR[1];
		$mRo2 = $mR[2];
		$mRo3 = $mR[3];
		$Link = $mR[4];
	
		RowList($stLOCK,$CrT,'',$mRo1,$mRo2,$mRo3,$rIdT,$gTHN,$gUBH,$IdL,$pad,$DatabaseSB,$ConSB,$xB,$Link,$eCeK);
		viewSUB($stLOCK,$gREF,$gTHN,$gUBH,$mRo2,$eCeK,$IdL,$DatabaseSB,$ConSB);
		#AddSUB($stLOCK,$rIdT,$IdL);
	}
}

function viewSUB($stLOCK,$gREF,$gTHN,$gUBH,$mRo2,$eCeK,$IdL,$DatabaseSB,$ConSB){
	$mSK = "SELECT IDT, Referensi, Kd_Sub_Kegiatan, Nm_Sub_Kegiatan, LinkMurni  
	FROM ta_rkpbmd_new_kegiatan_sub WHERE Referensi='$gREF' AND Kd_Sub_Kegiatan LIKE '$mRo2%' AND Tahun='$gTHN' AND Apbd='$gUBH' ORDER BY IDT";
	$nK = mysql_query($mSK);
	while ($mK = mysql_fetch_array($nK, MYSQL_BOTH))
	{
		$xB   = "<b>";
		$pad  = 5;
		$CrT  = "subk";
		$gBG  = fBackCLR($iG);
		$rIdT = $mK[0];
		$mRo1 = $mK[1];
		$mRo2 = $mK[2];
		$mRo3 = $mK[3];
		$Link = $mK[4];
	
		RowList($stLOCK,$CrT,'',$mRo1,$mRo2,$mRo3,$rIdT,$gTHN,$gUBH,$IdL,$pad,$DatabaseSB,$ConSB,$xB,$Link,$eCeK);
		viewREK($stLOCK,$gREF,$gTHN,$gUBH,$mRo2,$eCeK,$IdL,$DatabaseSB,$ConSB);
		#AddREK($stLOCK,$rIdT,$IdL);
	}
}

function viewREK($stLOCK,$gREF,$gTHN,$gUBH,$mRo2,$eCeK,$IdL,$DatabaseSB,$ConSB){
	$mSW = "SELECT IDT, Referensi, Kd_Rekening, Nm_Rekening, LinkMurni  
	FROM ta_rkpbmd_new_rekening WHERE Referensi='$gREF' AND Kd_Sub_Kegiatan = '$mRo2' AND Tahun='$gTHN' AND Apbd='$gUBH' ORDER BY IDT";
	#echo $mSQ."<br>";
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
		$mRo3 = $mW[3];
		$Link = $mW[4];
		RowList($stLOCK,$CrT,'',$mRo1,$mRo2,$mRo3,$rIdT,$gTHN,$gUBH,$IdL,$pad,$DatabaseSB,$ConSB,$xB,$Link,$eCeK);
	}
}

function RowList($stLOCK,$CrT,$iG,$mRo1,$mRo2,$mRo3,$rIdT,$gTHN,$gUBH,$IdL,$pad,$DatabaseSB,$ConSB,$xB,$Link,$eCeK)
{
	$gJnSR = "";
	if ($CrT=='rekn'){
		
		$gUsuL = fGlobalNEW("usulan_jumlah","ta_rkpbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		$gUsuT = fGlobalNEW("usulan_satuan","ta_rkpbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");

		$gKebU = fGlobalNEW("usulankebthan_jumlah","ta_rkpbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		$gKebT = fGlobalNEW("usulankebthan_satuan","ta_rkpbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");

		$gStaT = fGlobalNEW("status_barang","ta_rkpbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		$gKonD = fGlobalNEW("kondisi_barang","ta_rkpbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		
		$gPenU = fGlobalNEW("nama_pemeliharaan","ta_rkpbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		$gKetR = fGlobalNEW("keterangan","ta_rkpbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		
		$gSetL = fGlobalNEW("jumlah_yg_disetujui","ta_rkpbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		$gSetT = fGlobalNEW("disetujui_satuan","ta_rkpbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		
		$gLocK = fGlobalNEW("LockRecord","ta_rkpbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		
		$gJnSR = "<br><i>Jenis : ".fGlobalNEW("nm_aset","ref_rek_aset108_4","kd_aset",substr($mRo2,0,8),"=","",$DatabaseSB,$ConSB,"");
		$gJnSR.= "<br><i>Objek : ".fGlobalNEW("nm_aset","ref_rek_aset108_5","kd_aset",substr($mRo2,0,11),"=","",$DatabaseSB,$ConSB,"");
		
		$gHrgT = fGlobalNEW("Usulan_Harga","ta_rkpbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		
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
		
		$span  = 1;
	}
	else{
		$gOutP = fGlobalNEW("output","ta_rkpbmd_new_kegiatan_sub","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
		$span  = 1;
	}
	?>
	<tr height="25"> 
	  <td width="36" rowspan="<?=$span?>" style="border-bottom:1px #999999 dotted; text-align:center" <?=$gBG?>><?php if ($iG){echo $iG.".";}?></td>
	  <td width="132" rowspan="<?=$span?>" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:left; padding-left:2px" <?=$gBG?>><?=$xB.$mRo2?></td>
	  <td width="415" rowspan="<?=$span?>" style="border-bottom:1px #999999 dotted; padding-left:<?=$pad?>px; border-left:1px #ccc solid" <?=$gBG?>><?php if ($CrT=='rekn') {echo $xB."<b>".$mRo3."</b>".$gJnSR;} else {echo strtoupper($xB.$mRo3);}?></td>
	  <td width="717" style="border-bottom:1px #999999 dotted; padding-left:3px; border-left:1px #ccc solid" <?=$gBG?>>
	  <?php
	   if ($CrT=='subk'){
	   		echo "OUTPUT&nbsp;&nbsp;==>&nbsp;&nbsp;";
			?>
			<input name="fOutP" id="fOutP" type="text" value="<?=$gOutP?>" onkeypress="if (event.keyCode==13) {saveRECO('<?=$stLOCK?>','','output',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; padding-left:5px; width:495px; border: 1px solid #C0C0C0"/>
			<?php
	   }
		$eReD="";
		$eDis="";
		$delt="dele";
		if ($stLOCK=='1'){
			$delt="delt";
			$eReD="readonly";
			$eDis="disabled";
		}
		if ($Link=='Ya'){
			$delt="delt";
		}
		if ($eCeK!=''){
			$delt="delt";
			$eReD="readonly";
			$eDis="disabled";
		}
	   if ($CrT=='rekn'){
			?>
			<table width="100%" cellpadding="0" cellspacing="1">
			<tr>
			  <td width="77" align="right">RKPBMD</td>
			  <td width="12">&nbsp;</td>
			  <td width="113">
			  <input name="fUsuL" id="fUsuL" type="text" <?=$eReD?> value="<?=$gUsuL?>" onkeypress="if (event.keyCode==13) {saveRECOx('<?=$stLOCK?>','','usulan_jumlah',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" onkeyup="NumValidate(this)" style="height:15px; border-radius:0px; text-align:center; width:40px; border: 1px solid #C0C0C0"/>
			  <input name="fUsuT" id="fUsuT" type="text" <?=$eReD?> value="<?=$gUsuT?>" onkeypress="if (event.keyCode==13) {saveRECOx('<?=$stLOCK?>','','usulan_satuan',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; text-align:left; width:56px; border: 1px solid #C0C0C0"/>			  </td>
			  <td width="99" align="right">Nama Pemeliharaan</td>
			  <td width="12">&nbsp;</td>
			  <td width="289"><input name="fPenU" id="fPenU" type="text" <?=$eReD?> value="<?=$gPenU?>" onkeypress="if (event.keyCode==13) {saveRECOx('<?=$stLOCK?>','','nama_pemeliharaan',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; text-align:left; width:245px; border: 1px solid #C0C0C0"/></td>
			  <td width="101">Kunci Record : </td>
			</tr>
			<tr>
			  <td align="right">Status Barang</td>
			  <td>&nbsp;</td>
			  <td><input name="fStaT" id="fStaT" type="text" <?=$eReD?> value="<?=$gStaT?>" onkeypress="if (event.keyCode==13) {saveRECOx('<?=$stLOCK?>','','status_barang',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; text-align:left; width:105px; border: 1px solid #C0C0C0"/>			  </td>
			  <td align="right">Jumlah/Satuan</td>
			  <td>&nbsp;</td>
			  <td><input name="fKebU" id="fKebU" type="text" <?=$eReD?> value="<?=$gKebU?>" onkeypress="if (event.keyCode==13) {saveRECOx('<?=$stLOCK?>','','usulankebthan_jumlah',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" onkeyup="NumValidate(this)" style="height:15px; border-radius:0px; text-align:center; width:40px; border: 1px solid #C0C0C0"/>
		      <input name="fKebT" id="fKebT" type="text" <?=$eReD?> value="<?=$gKebT?>" onkeypress="if (event.keyCode==13) {saveRECOx('<?=$stLOCK?>','','usulankebthan_satuan',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; text-align:left; width:80px; border: 1px solid #C0C0C0"/>			  </td>
			  <td><label style="color:#<?=$CoRA?>"><input name="radiobutton<?=$rIdT?>" type="radio" value="Y" <?=$LocA?> onclick="saveRECO('<?=$stLOCK?>','','LockRecord',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;" />Lock</label></td>
			</tr>
			<tr>
			  <td align="right">Kondisi Barang</td>
			  <td>&nbsp;</td>
			  <td>
			  <label><input name="fRadio<?=$rIdT?>" <?=$eDis?> type="radio" onclick="saveRECOx('<?=$stLOCK?>','rb','kondisi_barang','B','<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;" value="B" <?php if ($gKonD=='B'){echo "checked";}?> />B</label>
			  <label><input name="fRadio<?=$rIdT?>" <?=$eDis?> type="radio" onclick="saveRECOx('<?=$stLOCK?>','rb','kondisi_barang','RR','<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;" value="RR" <?php if ($gKonD=='RR'){echo "checked";}?> />RR</label>
			  <label><input name="fRadio<?=$rIdT?>" <?=$eDis?> type="radio" onclick="saveRECOx('<?=$stLOCK?>','rb','kondisi_barang','RB','<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;" value="RB" <?php if ($gKonD=='RB'){echo "checked";}?> />RB</label>			  </td>
			  <td align="right">Keterangan</td>
			  <td>&nbsp;</td>
			  <td><input name="fKetR" id="fKetR" type="text" <?=$eReD?> value="<?=$gKetR?>" onkeypress="if (event.keyCode==13) {saveRECOx('<?=$stLOCK?>','','keterangan',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; text-align:left; width:245px; border: 1px solid #C0C0C0"/></td>
			  <td><label style="color:#<?=$CoRB?>"><input name="radiobutton<?=$rIdT?>" type="radio" value="N" <?=$LocB?> onclick="saveRECO('<?=$stLOCK?>','','LockRecord',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;" />Unlock</label></td>
			</tr>
			<tr>
			  <td align="right">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td align="right">Disetujui</td>
			  <td>&nbsp;</td>
			  <td>
			  <input name="fSetL" id="fSetL" type="text" <?=$eReD?> value="<?=$gSetL?>" onkeypress="if (event.keyCode==13) {saveRECO('<?=$stLOCK?>','','jumlah_yg_disetujui',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" onkeyup="NumValidate(this)" style="height:15px; border-radius:0px; text-align:center; width:40px; border: 1px solid #C0C0C0; background:#CCFF99"/>
			  <input name="fSetT" id="fSetT" type="text" <?=$eReD?> value="<?=$gSetT?>" onkeypress="if (event.keyCode==13) {saveRECO('<?=$stLOCK?>','','disetujui_satuan',this,'<?=$rIdT?>','<?=$_GET['IdL']?>'); return false;}" style="height:15px; border-radius:0px; text-align:left; width:56px; border: 1px solid #C0C0C0; background:#CCFF99"/>			  </td>
			  <td>&nbsp;</td>
			</tr>
			</table>
	  <?php }
	  ?>	  </td>
    </tr>
<?php } ?>

<?php
function AddKEG($stLOCK,$rIdT,$IdL)
{
	?>
	<tr height="30">
	 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td colspan="2" style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; padding-left:5px">
	 <a href="#" onClick="showKEGI('<?=$stLOCK?>','','<?=$rIdT?>','<?=$IdL?>'); return false" class="ico add">&nbsp;&nbsp;Add KEGIATAN</a>	 </td>
    </tr>
	<?php
}
?>
<?php
function AddSUB($stLOCK,$kIdT,$IdL)
{
	?>
	<tr height="20">
	 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td colspan="2" style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; padding-left:5px">
	 <a href="#" onClick="showSUBK('<?=$stLOCK?>','','<?=$kIdT?>','<?=$IdL?>'); return false" class="ico add">&nbsp;&nbsp;Add SUB KEGIATAN</a>	 
	 <!--ngdep ke aset : a href="#" onClick="showASET('','<?=$kIdT?>','<?=$IdL?>'); return false" class="ico add">&nbsp;&nbsp;Add ASET</a-->	 </td>
    </tr>
	<?php
}
?>
<?php
function AddREK($stLOCK,$kIdT,$IdL)
{
	?>
	<tr height="20">
	 <td style="border-left:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td style="border-left:1px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
	 <td colspan="2" style="border-left:1px #ccc solid; border-bottom:1px #ccc solid; padding-left:5px">
	 <a href="#" onClick="showREKN('<?=$stLOCK?>','','<?=$kIdT?>','<?=$IdL?>'); return false" class="ico add">&nbsp;&nbsp;Add REKENING</a>	 
	 <!--ngdep ke aset : a href="#" onClick="showASET('','<?=$kIdT?>','<?=$IdL?>'); return false" class="ico add">&nbsp;&nbsp;Add ASET</a-->	 </td>
    </tr>
	<?php
}
?>
<?php if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td colspan="2" style="border-left:1px #ccc solid; border-bottom:0px #ccc double; vertical-align:middel; text-align:center; color:#fff; font-size:10pt; font-style:italic"><font style="background:#000000">&nbsp;&nbsp;** Tekan <b>ENTER</b> untuk menyimpan data **&nbsp;&nbsp;</font></td>
 </tr>
<?php }else{ ?>
<tr height="100%">
 <td colspan="5" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
