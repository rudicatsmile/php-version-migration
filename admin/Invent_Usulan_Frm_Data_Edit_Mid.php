<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
?>
<?php if ($CrT=='Edit') {?>
	<?php
	$gJN  = fGlobal("Jenis","ta_usulan_108","Referensi",$gRF,"=","","");
	$gALS = fGlobal("Kd_Rinci","ta_usulan_rinci_108","IDT",$gIdT,"=","","");
	$dALS = fGlobal("Deskripsi","ref_usulan_jenis_rinci","Kode",$gALS,"=","","");
	
	?>
	<table align="center" cellpadding="0" class="table-form" cellspacing="0" width="100%" height="245" border="0">
	<tr height="10">
	  <td width="30"></td>
	  <td width="60"></td>
	  <td width="20"></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<?php if ($gJN=="MS") {?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td colspan="3" class="al">MUTASI KE : </td>
	  <td>&nbsp;</td>
	</tr>
	<?php
	$gKdU = fGlobal("To_UPB","ta_usulan_rinci_108","IDT",$gIdT,"=","","");
	$gUnT = "";
	$dUnT = "";
	if (strlen($gKdU)>=11)
	{
		$gUnT = substr($gKdU,0,11);
		$dUnT = strtoupper(fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUnT,"=","",""));
	}
	?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">UNIT</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="fUnT" id="fUnT" type="text" value="<?=$gUnT?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
      <input name="dUnT" id="dUnT" type="text" value="<?=$dUnT?>" readonly onClick="findEDIT('','skpd','','<?=$gIdT?>','<?=$_GET['IdL']?>')" style="padding-left:5px; width:280px; border: 1px solid #C0C0C0"/></td>
	  <td>&nbsp;</td>
	</tr>
	<?php
	$gSuB = "";
	$dSuB = "";
	if (strlen($gKdU)>=14)
	{
		$gSuB = substr($gKdU,0,14);
		$dSuB = strtoupper(fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSuB,"=","",""));
	}
	?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">SUB UNIT</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="fSuB" id="fSuB" type="text" value="<?=$gSuB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
      <input name="dSuB" id="dSuB" type="text" value="<?=$dSuB?>" readonly onClick="findEDIT('fUnT','skpd','','<?=$gIdT?>','<?=$_GET['IdL']?>')" style="padding-left:5px; width:280px; border: 1px solid #C0C0C0"/></td>
	  <td>&nbsp;</td>
	</tr>
	<?php
	$gUpB = "";
	$dUpB = "";
	if (strlen($gKdU)>=18)
	{
		$gUpB = substr($gKdU,0,18);
		$dUpB = strtoupper(fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUpB,"=","",""));
	}
	?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">UPB</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="fUpB" id="fUpB" type="text" value="<?=$gUpB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
      <input name="dUpB" id="dUpB" type="text" value="<?=$dUpB?>" readonly onClick="findEDIT('fSuB','skpd','','<?=$gIdT?>','<?=$_GET['IdL']?>')" style="padding-left:5px; width:280px; border: 1px solid #C0C0C0"/></td>
	  <td>&nbsp;</td>
	</tr>
	<?php } ?>
	<?php if ($gJN=="MK" || $gJN=="TW" || $gJN=="RP") {?>
	<?php
	#$gKIa = fGlobal("Kd_Aset","ta_usulan_rinci_108","IDT",$gIdT,"=","","");
	$gKIa = CekRefToNmTbl(substr(fGlobal("ref_aset","ta_usulan_rinci_108","IDT",$gIdT,"=","",""),0,3));
	$gKIb = fGlobal("KIB_To","ta_usulan_rinci_108","IDT",$gIdT,"=","","");
	$dKIa = "KIB-".strtoupper($gKIa);//strtoupper(fNmHuruf((int)substr($gKIa,0,2)))." : ASET ".strtoupper(fGlobal("Nm_Aset","ref_rek_aset1","Kd_Aset",substr($gKIa,0,2),"=","",""));
	
	$dKIb = "";
	//echo $gKIb;
	if ($gKIb) {
		$dKIb = "KIB-".strtoupper(fNmHuruf((int)substr($gKIb,-1,1)))." : ASET ".strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",substr($gKIb,0,5),"=","",""));
		if (substr($gKIb,0,6)=='1.1.12')
		{
			$dKIb = "PERSEDIAAN";
		}
	}
	?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">DARI KIB</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="fKIBa" id="fKIBa" type="hidden" value="<?=$gKIa?>" readonly="readonly" style="padding-left:5px; width:250px; border: 1px solid #C0C0C0"/>
	  <input name="dKIBa" id="dKIBa" type="text" value="<?=$dKIa?>" readonly="readonly" style="padding-left:5px; width:250px; border: 1px solid #C0C0C0"/>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">KE KIB </td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="fKIBb" id="fKIBb" type="hidden" value="<?=$gKIb?>" readonly="readonly" style="padding-left:5px; width:250px; border: 1px solid #C0C0C0"/>
	  <input name="dKIBb" id="dKIBb" type="text" value="<?=$dKIb?>" readonly="readonly" onClick="findEDIT('','kib','','<?=$gIdT?>','<?=$_GET['IdL']?>'); return false;" style="padding-left:5px; width:250px; border: 1px solid #C0C0C0"/>
	  &nbsp;&nbsp;<a href="#" class="ico prev" onClick="findEDIT('','kib','','<?=$gIdT?>','<?=$_GET['IdL']?>'); return false;"></a></td>
	  <td>&nbsp;</td>
	</tr>
	<?php
	$gKdA = fGlobal("To_Kd_Aset","ta_usulan_rinci_108","IDT",$gIdT,"=","","");
	#echo $gKdA;
	$gBiD = "";
	$dBiD = "";
	if (strlen($gKdA)>=5)
	{
		if (substr($gKdA,0,6)=='1.1.12')
		{
			$gBiD = substr($gKdA,0,6);
			$dBiD = strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",substr($gBiD,0,6),"=","",""));
		}
		else
		{
			$gBiD = substr($gKdA,0,5);
			$dBiD = strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",substr($gBiD,0,5),"=","",""));
		}
	}
	?>
	<tr height="10">
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	</tr>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">JENIS.</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="fBiD" id="fBiD" type="text" value="<?=$gBiD?>" style="padding-left:5px; width:90px; border: 1px solid #C0C0C0"/>
	  <input name="dBiD" id="dBiD" type="text" value="<?=$dBiD?>" readonly onClick="findEDIT('fKIBb','rekn','','<?=$gIdT?>','<?=$_GET['IdL']?>')" style="padding-left:5px; width:270px; border: 1px solid #C0C0C0"/>&nbsp;&nbsp;<a href="#" class="ico prev" onClick="findEDIT('fKIBb','rekn','','<?=$gIdT?>','<?=$_GET['IdL']?>'); return false;"></a>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<?php
	$gKeL = "";
	$dKeL = "";
	if (strlen($gKdA)>=8)
	{
		if ($gBiD=='1.1.12')
		{
			$gKeL = substr($gKdA,0,9);
		}
		else
		{
			$gKeL = substr($gKdA,0,8);
		}
		$dKeL = strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_4","Kd_Aset",$gKeL,"=","",""));
	}
	?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">OBJEK</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="fKeL" id="fKeL" type="text" value="<?=$gKeL?>" style="padding-left:5px; width:90px; border: 1px solid #C0C0C0"/>
	  <input name="dKeL" id="dKeL" type="text" value="<?=$dKeL?>" readonly onClick="findEDIT('fBiD','rekn','','<?=$gIdT?>','<?=$_GET['IdL']?>')" style="padding-left:5px; width:270px; border: 1px solid #C0C0C0"/>&nbsp;&nbsp;<a href="#" class="ico prev" onClick="findEDIT('fBiD','rekn','','<?=$gIdT?>','<?=$_GET['IdL']?>'); return false;"></a>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<?php
	$gJeN = "";
	$dJeN = "";
	if (strlen($gKdA)>=11)
	{
		if ($gBiD=='1.1.12')
		{
			$gJeN = substr($gKdA,0,12);
		}
		else
		{
			$gJeN = substr($gKdA,0,11);
		}
		$dJeN = strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_5","Kd_Aset",$gJeN,"=","",""));
	}
	?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">R.OBJ</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="fJeN" id="fJeN" type="text" value="<?=$gJeN?>" style="padding-left:5px; width:90px; border: 1px solid #C0C0C0"/>
	  <input name="dJeN" id="dJeN" type="text" value="<?=$dJeN?>" readonly onClick="findEDIT('fKeL','rekn','','<?=$gIdT?>','<?=$_GET['IdL']?>')" style="padding-left:5px; width:270px; border: 1px solid #C0C0C0"/>&nbsp;&nbsp;<a href="#" class="ico prev" onClick="findEDIT('fKeL','rekn','','<?=$gIdT?>','<?=$_GET['IdL']?>'); return false;"></a>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<?php
	$gObJ = "";
	$dObJ = "";
	if (strlen($gKdA)>=14)
	{
		if ($gBiD=='1.1.12')
		{
			$gObJ = substr($gKdA,0,15);
		}
		else
		{
			$gObJ = substr($gKdA,0,14);
		}
		$dObJ = strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_6","Kd_Aset",$gObJ,"=","",""));
	}
	?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">SUB R.OBJ</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="fObJ" id="fObJ" type="text" value="<?=$gObJ?>" style="padding-left:5px; width:90px; border: 1px solid #C0C0C0"/>
	  <input name="dObJ" id="dObJ" type="text" value="<?=$dObJ?>" readonly onClick="findEDIT('fJeN','rekn','','<?=$gIdT?>','<?=$_GET['IdL']?>')" style="padding-left:5px; width:270px; border: 1px solid #C0C0C0"/>&nbsp;&nbsp;<a href="#" class="ico prev" onClick="findEDIT('fJeN','rekn','','<?=$gIdT?>','<?=$_GET['IdL']?>'); return false;"></a>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<?php
	$gRiN = "";
	$dRiN = "";
	if (strlen($gKdA)>=18)
	{
		if ($gBiD=='1.1.12')
		{
			$gRiN = substr($gKdA,0,19);
		}
		else
		{
			$gRiN = substr($gKdA,0,18);
		}
		$dRiN = strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$gRiN,"=","",""));
	}
	?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">SUBSUB R.OBJ</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="fRiN" id="fRiN" type="text" value="<?=$gRiN?>" style="padding-left:5px; width:90px; border: 1px solid #C0C0C0"/>
	  <input name="dRiN" id="dRiN" type="text" value="<?=$dRiN?>" readonly onClick="findEDIT('fObJ','rekn','','<?=$gIdT?>','<?=$_GET['IdL']?>')" style="padding-left:5px; width:270px; border: 1px solid #C0C0C0"/>&nbsp;&nbsp;<a href="#" class="ico prev" onClick="findEDIT('fObJ','rekn','','<?=$gIdT?>','<?=$_GET['IdL']?>'); return false;"></a>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<?php } ?>
	<?php if ($gJN=="RB") {?>
	<tr height="10">
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	</tr>
	<?php
	$gKdA = fGlobal("To_Kd_Aset","ta_usulan_rinci_108","IDT",$gIdT,"=","","");
	$xBiD = "";
	if (strlen($gKdA)>=5)
	{
		$xBiD = strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",substr($gKdA,0,5),"=","",""));
	}
	?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">JENIS</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="gBiD" id="gBiD" type="text" value="<?=substr($gKdA,0,5)?>" style="padding-left:5px; width:105px; border: 1px solid #C0C0C0"/>
	  <input name="xBiD" id="xBiD" type="text" value="<?=$xBiD?>" readonly style="padding-left:5px; width:270px; border: 1px solid #C0C0C0"/></td>
	  <td>&nbsp;</td>
	</tr>
	<?php
	$xKeL = "";
	if (strlen($gKdA)>=8)
	{
		$xKeL = strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_4","Kd_Aset",substr($gKdA,0,8),"=","",""));
	}
	?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">OBJEK</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="gKeL" id="gKeL" type="text" value="<?=substr($gKdA,0,8)?>" style="padding-left:5px; width:105px; border: 1px solid #C0C0C0"/>
	  <input name="xKeL" id="xKeL" type="text" value="<?=$xKeL?>" readonly style="padding-left:5px; width:270px; border: 1px solid #C0C0C0"/></td>
	  <td>&nbsp;</td>
	</tr>
	<?php
	$xJeN = "";
	if (strlen($gKdA)>=11)
	{
		$xJeN = strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_5","Kd_Aset",substr($gKdA,0,11),"=","",""));
	}
	?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">R.OBJ</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="gJeN" id="gJeN" type="text" value="<?=substr($gKdA,0,11)?>" style="padding-left:5px; width:105px; border: 1px solid #C0C0C0"/>
	  <input name="xJeN" id="xJeN" type="text" value="<?=$xJeN?>" readonly style="padding-left:5px; width:270px; border: 1px solid #C0C0C0"/></td>
	  <td>&nbsp;</td>
	</tr>
	<?php
	$xObJ = "";
	if (strlen($gKdA)>=14)
	{
		$xObJ = strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_6","Kd_Aset",substr($gKdA,0,14),"=","",""));
	}
	?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">SUB R.OBJ</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="gObJ" id="gObJ" type="text" value="<?=substr($gKdA,0,14)?>" style="padding-left:5px; width:105px; border: 1px solid #C0C0C0"/>
	  <input name="xObJ" id="xObJ" type="text" value="<?=$xObJ?>" readonly style="padding-left:5px; width:270px; border: 1px solid #C0C0C0"/></td>
	  <td>&nbsp;</td>
	</tr>
	<?php
	$xRiN = "";
	if (strlen($gKdA)>=18)
	{
		$xRiN = strtoupper(fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",substr($gKdA,0,18),"=","",""));
	}
	?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">SUBSUB R.OBJ</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="gRiN" id="gRiN" type="text" value="<?=substr($gKdA,0,18)?>" style="padding-left:5px; width:105px; border: 1px solid #C0C0C0"/>
	  <input name="xRiN" id="xRiN" type="text" value="<?=$xRiN?>" readonly style="padding-left:5px; width:270px; border: 1px solid #C0C0C0"/></td>
	  <td>&nbsp;</td>
	</tr>
	<?php } ?>
	<tr height="10">
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	</tr>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">KRITERIA</td>
	  <td>&nbsp;</td>
	  <td>
	  <input name="fALS" type="hidden" value="<?=$gALS?>" style="padding-left:5px; width:40px; border: 1px solid #C0C0C0"/>
	  <input name="dALS" type="text" value="<?=$dALS?>" readonly onClick="findEDIT('','alas','','<?=$gIdT?>','<?=$_GET['IdL']?>')" style="padding-left:5px; width:300px; border: 1px solid #C0C0C0"/>&nbsp;&nbsp;<a href="#" class="ico prev" onClick="findEDIT('','alas','','<?=$gIdT?>','<?=$_GET['IdL']?>'); return false;"></a>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<tr height="20">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	</table>
<?php } else { ?>

	<?php
	$gRA = fGlobal("Ref_Aset","ta_usulan_rinci_108","IDT",$gIdT,"=","","");
	?>
	<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="245" border="0">
		<?php
		$iG=1;
		$nSQ = "SELECT IDT, file_name, file_content, file_type, file_size FROM ta_usulan_rinci_file_108 WHERE Referensi='$gRF' AND Ref_Aset ='$gRA' AND Crit='$CrT' ORDER BY file_name";
		//echo $nSQ;
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$gBG  = fBackCLR($iG);
			$rIdT= $mRo[0];
			$gNm = $mRo[1];
			$gCn = $mRo[2];
			$gTy = $mRo[3];
			
			$gSz = fConvertToRupiah($mRo[4]/1025);
			if ($CrT=='Img') {$gCL=70;} else {$gCL=20;}
			?>
			<tr height="18">
				<td valign="top" width="15" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"><?=$iG?>.</td>
				<td valign="top" width="<?=$gCL?>" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
				<?php if ($CrT=='Img') {?><img src="<?="Invent_Usulan_Frm_Data_Edit_Upl_Mid_Src.php?rIdT=".$rIdT?>" height="50" width="50" style="border:1px #999999 solid" ><?php } ?>
				</td>
				<td valign="top" <?=$gBG?>style="border-bottom:1px dotted #CCCCCC; padding-top:5px; padding-bottom:5px"><?=$gNm?></td>
				<td valign="top" width="50" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; padding-right:15px; padding-top:5px; padding-bottom:5px; text-align:center"><?=$gSz?> KB</td>
				<td valign="top" width="130" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
				<a href="#" onclick="viewIMG('<?=$rIdT?>','600','400','<?=$IdL?>'); return false;" class="ico prev">View</a>&nbsp;|&nbsp;
				<a href="#" onclick="remoIMG('<?=$CrT?>','<?=$gIdT?>','<?=$rIdT?>','<?=$IdL?>'); return false;" class="ico dele">Remove</a>
				</td>
			</tr>
			<?php
			$iG++;
		}
		?>
		<?php if ($iG==1) {?>
		<tr height="20">
			<td colspan="5" style="text-align:center; vertical-align:middle">Hasil upload tidak ditemukan..!!</td>
		</tr>
		<?php } ?>
		<tr height="20">
			<td colspan="5" style="text-align:center"><a href="#" onclick="addIMG('<?=$CrT?>','<?=$gIdT?>'); return false;" class="ico add">Upload file ( <?php if ($CrT=='Pdf') {echo "PDF";} else {echo "JPG, JPEG, PNG, BMP, GIF";}?> )</a></td>
		</tr>
		<tr height="100%">
			<td colspan="5" style="text-align:center">&nbsp;</td>
		</tr>
	</table>
<?php } ?>