<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

#$IdT = 1;
if ($IdT=='')
{
	$frmRefe = "BMD.XXXXXXXXXXX";
	$CkKon1 = "checked";
	$CkKon2 = "";
	$CkKon3 = "";
	$frmJumb= 0;
	$frmHarg= fConvertToRupiah(0);
	$frmNila= fConvertToRupiah(0);
}
else
{
	#$frmRefe = fGlobal("Referensi","tb_lembar_kerja_belum_tercatat","IDT",$IdT,"=","","s");
	$nSQ = "SELECT 
	KdUPB as A0,
	Referensi as A1,
	KdBarang as A2,
	NmBarang as A3,
	NmBarang_Spec as A4,
	KdRegister as A5,
	Merk as A6,
	Type as A7,
	NoPolisi as A8,
	NoRangka as A9,
	NoMesin as A10,
	JmlBarang as A11,
	SatuanBarang as A12,
	HargaSatuan as A13,
	NilaiPerolehan as A14,
	TglPerolehan as A15,
	Alamat as A16,
	DasarPencatatan as A17,
	KondisiBarang as A18,
	Lainnya as A19,
	Keterangan as A20,
	TanggalSensus as A21,
	
	PetugasSensus_1 as A22,
	PetugasSensus_2 as A23,
	PetugasSensus_3 as A24,
	PetugasSensus_4 as A25,
	PetugasSensus_ttd as A26,
	DataSensusFix as A267 
	
	FROM tb_lembar_kerja_belum_tercatat WHERE IDT='".$IdT."'";
	#echo $nSQ;
	$nRs = mysql_query($nSQ) or die(mysql_error());
	#$mRw = mysql_fetch_row($nRs);
	$mRo = mysql_fetch_array($nRs, MYSQL_BOTH);

	$frmKUPB = $mRo[0];
	$frmRefe = $mRo[1];
	$frmKode = $mRo[2];
	$frmNama = $mRo[3];
	$frmSpec = $mRo[4];
	$frmRegi = $mRo[5];
	$frmMerk = $mRo[6];
	$frmType = $mRo[7];
	$frmNopo = $mRo[8];
	$frmNora = $mRo[9];
	$frmNome = $mRo[10];
	
	$frmJumb = $mRo[11];
	$frmSatu = $mRo[12];
	$frmHarg = fConvertToRupiah($mRo[13]);
	$frmNila = fConvertToRupiah($mRo[14]);
	
	$mRo15 = $mRo[15];
	$mRo15 = explode('-',$mRo15);
	$frmTahu = $mRo15[0];
	$frmBula = $mRo15[1];
	$frmHari = $mRo15[2];
	
	$frmAlam =  $mRo[16];
	$frmDasa =  $mRo[17];
	
	$CkKon1 = ""; 
	$CkKon2 = ""; 
	$CkKon3 = ""; 
	
	if ($mRo[18]=='B') {
		$CkKon1 = "checked";
	}
	elseif ($mRo[18]=='RR') {
		$CkKon2 = "checked";
	}
	else {
		$CkKon3 = "checked";
	}
	
	$frmLain =  $mRo[19];
	$frmKetr =  $mRo[20];
	
	$gTG = $mRo[21];
	$gTG = explode('-',$gTG);
	$gTH = $gTG[0];
	$gBL = $gTG[1];
	$gHR = $gTG[2];
	
	$Petugas1 = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$mRo[22],"=","","");
	$Petugas2 = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$mRo[23],"=","","");
	$Petugas3 = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$mRo[24],"=","","");
	$Petugas4 = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$mRo[25],"=","","");
	$Petugas5 = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$mRo[26],"=","","");
		
}
?>
<table border="0" width="800" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="170">&nbsp;</td>
    <td width="24">&nbsp;</td>
    <td colspan="3">
	<div id="loadMstCri" class="loadRekn0Cri">
		<div id="loadDiv1Cri" class="loadRekn1Cri"></div>
		<div id="loadDiv2Cri" class="loadRekn2Cri"></div>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Referensi</td>
    <td align="center">:</td>
    <td><input type="text" name="frmRefe" id="frmRefe" value="<?=$frmRefe?>" readonly style="width:115px" /></td>
    <td width="144">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Kode Barang</td>
    <td align="center">:</td>
    <td width="123"><input type="text" name="frmKode" id="frmKode" value="<?=$frmKode?>" readonly style="width:115px" /></td>
    <td colspan="2"><input name="button" type="button" onclick="P_LoadKd('','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>')" value="..." style="width:22px; height:22px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Nama Barang</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmNama" id="frmNama" value="<?=$frmNama?>" style="width:350px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Nama Spesifikasi Barang</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmSpec" id="frmSpec" value="<?=$frmSpec?>" style="width:350px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Kode Register</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmRegi" id="frmRegi" value="<?=$frmRegi?>" style="width:80px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Merk</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmMerk" id="frmMerk" value="<?=$frmMerk?>" style="width:280px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Tipe</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmType" id="frmType" value="<?=$frmType?>" style="width:280px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Nomor Polisi</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmNopo" id="frmNopo" value="<?=$frmNopo?>" style="width:150px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Nomor Rangka</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmNora" id="frmNora" value="<?=$frmNora?>" style="width:280px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Nomor Mesin</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmNome" id="frmNome" value="<?=$frmNome?>" style="width:280px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Jumlah</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmJumb" id="frmJumb" value="<?=$frmJumb?>" style="width:50px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Satuan Barang</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmSatu" id="frmSatu" value="<?=$frmSatu?>" style="width:180px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Harga Satuan Barang</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmHarg" id="frmHarg" value="<?=$frmHarg?>" style="width:90px; text-align:right; padding-right:3px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Nilai Perolehan Barang</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmNila" id="frmNila" value="<?=$frmNila?>" style="width:90px; text-align:right; padding-right:3px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Tanggal Perolehan</td>
    <td align="center">:</td>
    <td colspan="3">
	<select class="boxs" name="frmHari" id="frmHari" tabindex="0" style="width:50px">
	<option value="00"></option>
	<?
	for($i=1; $i<=31; $i++)
	{
		$sel ="";
		if ($i==$frmHari) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select>
	<select class="boxs" name="frmBula" id="frmBula" tabindex="0" style="width:95px">
	<option value="00"></option>
  	<?
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$frmBula) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="frmTahu" id="frmTahu" style="width: 60px" tabindex="0">
	<option value="0000"></option>
  	<?
	for($i=2020; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$frmTahu) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Alamat</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmAlam" id="frmAlam" value="<?=$frmAlam?>" style="width:350px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Dasar Pencatatan</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmDasa" id="frmDasa" value="<?=$frmDasa?>" style="width:350px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Kondisi Barang</td>
    <td align="center">:</td>
    <td colspan="3">
	<label><input type="radio" name="radioKon" value="B" <?=$CkKon1?> />Baik (B)</label>&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input type="radio" name="radioKon" value="RR" <?=$CkKon2?> />Rusak Ringan (RR)</label>&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input type="radio" name="radioKon" value="RB" <?=$CkKon3?> />Rusak Berat(RB)</label>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Lainnya</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmLain" id="frmLain" value="<?=$frmLain?>" style="width:350px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Keterangan</td>
    <td align="center">:</td>
    <td colspan="3"><input type="text" name="frmKetr" id="frmKetr" value="<?=$frmKetr?>" style="width:350px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="3"><input name="butSave" type="button" onclick="P_SaveNewAset('<?=$ReO?>','<?=$IdT?>','<?=$IdL?>')" value="SIMPAN" style="width:80px; height:35px; background:#FFFF00" />
    <input name="butRefr" type="hidden" onclick="NewAset('reset','<?=$ReO?>','','<?=$IdL?>')" value="RESET" style="width:80px; height:35px; background:#FFFF00" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<?=$NmIbuk?>,&nbsp;&nbsp;&nbsp;
	<select class="boxs" name="fHR" tabindex="0" style="width:50px" onchange="saveDATANewAset('TanggalSensusHR',this,'<?=$IdT?>','<?=$ReO?>','<?=$IdL?>')">
	<option value="00"></option>
	<?
	for($i=1; $i<=31; $i++)
	{
		$sel ="";
		if ($i==$gHR) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select>
	<select class="boxs" name="fBL" tabindex="0" style="width:95px" onchange="saveDATANewAset('TanggalSensusBL',this,'<?=$IdT?>','<?=$ReO?>','<?=$IdL?>')">
	<option value="00"></option>
  	<?
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH" style="width: 60px" tabindex="0" onchange="saveDATANewAset('TanggalSensusTH',this,'<?=$IdT?>','<?=$ReO?>','<?=$IdL?>')">
	<option value="0000"></option>
  	<?
	for($i=2020; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="3" style="font-weight:bold">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center"><img src="css/images/adm.gif" /></td>
    <td colspan="3" style="font-weight:bold">Pelaksana/Petugas Inventarisasi :</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center">1.</td>
    <td colspan="2">
	<input type="text" name="Petugas1" id="Petugas1" readonly value="<?=$Petugas1?>" style="width:250px" />	</td>
    <td width="299"><input type="button" value="..." onclick="showPetugasNewAset('','PetugasSensus_1','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>')" style=" height:22px; width:23px"></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center">2.</td>
    <td colspan="2">
	<input type="text" name="Petugas2" id="Petugas2" readonly value="<?=$Petugas2?>" style="width:250px" />	</td>
    <td><input name="button2" type="button" style=" height:22px; width:23px" onclick="showPetugasNewAset('','PetugasSensus_2','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>')" value="..." /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center">3.</td>
    <td colspan="2">
	<input type="text" name="Petugas3" id="Petugas3" readonly value="<?=$Petugas3?>" style="width:250px" />	</td>
    <td><input name="button2" type="button" style=" height:22px; width:23px" onclick="showPetugasNewAset('','PetugasSensus_3','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>')" value="..." /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center">4.</td>
    <td colspan="2">
	<input type="text" name="Petugas4" id="Petugas4" readonly value="<?=$Petugas4?>" style="width:250px" />	</td>
    <td><input name="button2" type="button" style=" height:22px; width:23px" onclick="showPetugasNewAset('','PetugasSensus_4','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>')" value="..." /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center"><img src="css/images/adm.gif" /></td>
    <td colspan="3" style="font-weight:bold">Penandatangan:</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="2">
	<input type="text" name="Petugas1" id="Petugas1" readonly value="<?=$Petugas5?>" style="width:250px" />	</td>
    <td width="299"><input type="button" value="..." onclick="showPetugasNewAset('','PetugasSensus_ttd','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>')" style=" height:22px; width:23px"></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right">Foto/denah</td>
    <td align="center">:</td>
    <td colspan="3">
	<input id="imgfile" name="imgfile" type="file">
	<input type="button" value="Upload" onclick="P_UploadAstNew('Img','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>')">	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right"></td>
    <td align="center">&nbsp;</td>
    <td colspan="3"><div id="loadImgLokasi" class="loadImgLokasi" style="border:1px solid; width:454px; height:150px" >
      <table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="150" border="0">
        <?
		$iG=1;
		$nSX = "SELECT IDT, file_name, file_content, file_type, file_size FROM tb_lembar_kerja_foto_denah WHERE Referensi='".$frmRefe."' AND KdUPB='".$frmKUPB."' ORDER BY file_name";
		#echo $nSX;
		$nRx = mysql_query($nSX);
		while ($mRx = mysql_fetch_array($nRx, MYSQL_BOTH))
		{
			$gBG  = fBackCLR($iG);
			$rIdT= $mRx[0];
			$gNm = $mRx[1];
			$gCn = $mRx[2];
			$gTy = $mRx[3];
			
			$gSz = fConvertToRupiah($mRx[4]/1025);
			?>
			<tr height="18">
			  <td valign="top" width="17" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"><?=$iG?>.</td>
			  <td valign="top" width="70" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"><img src="<?="Lembar_Kerja_Frm_Data_New_Mid_Img_Load.php?CrT=Img&rIdT=".$rIdT?>" height="40" width="40" style="border:1px #999999 solid" /> </td>
			  <td width="185" valign="top" <?=$gBG?>style="border-bottom:1px dotted #CCCCCC; padding-top:5px; padding-bottom:5px"><?=$gNm?></td>
			  <td valign="top" width="87" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; padding-right:15px; padding-top:5px; padding-bottom:5px; text-align:right"><?=$gSz?> KB</td>
			  <td valign="top" width="93" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
			  <a href="#" onclick="viewIMGnewAst('Img','<?=$rIdT?>','600','400','<?=$IdL?>'); return false;" class="ico prev">&nbsp;</a>&nbsp;&nbsp;
			  <a href="#" onclick="remoIMGnewAst('Img','<?=$ReO?>','<?=$rIdT?>','<?=$IdT?>','<?=$IdL?>'); return false;" class="ico dele">&nbsp;</a></td>
			</tr>
			<?
			$iG++;
		}
		?>
        <? if ($iG==1) {?>
        <tr height="20">
          <td colspan="5" style="text-align:center; vertical-align:middle">Hasil upload tidak ditemukan..!!</td>
        </tr>
        <? } ?>
        <tr height="100%">
          <td colspan="5" style="text-align:center">&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right"></td>
    <td align="center">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right"></td>
    <td align="center">&nbsp;</td>
    <td colspan="3">Upload Dokumen (<i> yang sudah ditandatangan </i>) :</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right"></td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input id="imgfile2" name="imgfile2" type="file">
	<input type="button" value="Upload" onclick="P_UploadAstNew('Pdf','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>')">	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right"></td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<div id="loadImgDokumen" class="loadImgLokasi" style="border:1px solid; width:454px; height:70px" >
		<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="70" border="0">
		  <?
			$iG=1;
			$nSX = "SELECT IDT, file_name, file_content, file_type, file_size FROM tb_lembar_kerja_dokumen WHERE Referensi='".$frmRefe."' AND KdUPB='".$frmKUPB."' ORDER BY file_name";
			$nRx = mysql_query($nSX);
			while ($mRx = mysql_fetch_array($nRx, MYSQL_BOTH))
			{
				$gBG  = fBackCLR($iG);
				$rIdT= $mRx[0];
				$gNm = $mRx[1];
				$gCn = $mRx[2];
				$gTy = $mRx[3];
				
				$gSz = fConvertToRupiah($mRx[4]/1025);
				?>
			  <tr height="18">
				<td valign="top" width="17" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"><?=$iG?>.</td>
				<td valign="top" width="10" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"><!--img src="<?="Lembar_Kerja_Frm_Data_New_Mid_Img_Load.php?CrT=Pdf&rIdT=".$rIdT?>" height="40" width="40" style="border:1px #999999 solid" /--> </td>
				<td width="185" valign="top" <?=$gBG?>style="border-bottom:1px dotted #CCCCCC; padding-top:5px; padding-bottom:5px"><?=$gNm?></td>
				<td valign="top" width="87" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; padding-right:15px; padding-top:5px; padding-bottom:5px; text-align:right"><?=$gSz?> KB</td>
				<td valign="top" width="93" <?=$gBG?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
				<a href="#" onclick="viewIMGnewAst('Pdf','<?=$rIdT?>','600','400','<?=$IdL?>'); return false;" class="ico prev">&nbsp;</a>&nbsp;&nbsp; 
				<a href="#" onclick="remoIMGnewAst('Pdf','<?=$ReO?>','<?=$rIdT?>','<?=$IdT?>','<?=$IdL?>'); return false;" class="ico dele">&nbsp;</a></td>
			  </tr>
			  <?
				$iG++;
			}
			?>
		  <? if ($iG==1) {?>
		  <tr height="20">
			<td colspan="5" style="text-align:center; vertical-align:middle">Hasil upload tidak ditemukan..!!</td>
		  </tr>
		  <? } ?>
		  <tr height="100%">
			<td colspan="5" style="text-align:center">&nbsp;</td>
		  </tr>
		</table>
	  </div>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right"></td>
    <td align="center">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right"></td>
    <td align="center">&nbsp;</td>
    <td colspan="3"><a href="#" class="ico docu" onclick="formCetakDok('Report_Form_LKI_BMD','<?=$IdT?>','900','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;DOKUMEN CETAK</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td align="right"></td>
    <td align="center">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
