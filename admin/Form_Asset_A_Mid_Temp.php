<?php
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";
require "FileFormatNum.php";
extract($_GET);

echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>";
echo "<html xml:lang='en'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=windows-1252'>";
?>
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="file_global.js"></script>
</head>
<?php
if (isset($_GET['gIdT'])) {$gIdT = $_GET['gIdT'];}
if (isset($_GET['rIDT'])) {$rIDT = $_GET['rIDT'];}

$gSPP  = "N";
if ($gIdT!="")
{
	$nSQ = "SELECT Kd_Unit, Nilai, SPP, Pros, No_Berkas, Nomor, Uraian FROM ta_pengadaan WHERE IDT='$gIdT'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gUnt = $mRo[0];
		$zUnt = $mRo[0];
		$gNiL = $mRo[1];
		$gSPP = $mRo[2];
		$gPRO = $mRo[3];
		$mUnt = fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$gUnt,"=","",DatabaseSB,$ConSB,"");
		$gBRK = $mRo[4];
		$gNoM = $mRo[5];
		#$gNma = $mRo[6];
		
		if ($gPRO=="70")
		{
			$gR30 = fGlobalNEW("NomPros30","ta_penerimaan_berkas","Nomor",$gBRK,"=","",$DatabaseSB,$ConSB,"");
			$gN30 = fGlobalNEW("Nilai","ta_penerimaan_berkas","Nomor:Pros",$gR30.":30","=:=","",$DatabaseSB,$ConSB,"");
			if ($gN30) {$gNiL = $gNiL + $gN30;}
		}
		if ($gPRO=="100")
		{
			$gR70 = fGlobalNEW("NomPros70","ta_penerimaan_berkas","Nomor",$gBRK,"=","",$DatabaseSB,$ConSB,"");
			$gN70 = fGlobalNEW("Nilai","ta_penerimaan_berkas","Nomor:Pros",$gR70.":70","=:=","",$DatabaseSB,$ConSB,"");
			if ($gN70) {$gNiL = $gNiL + $gN70;}
			
			$gR30 = fGlobalNEW("NomPros30","ta_penerimaan_berkas","Nomor",$gR70,"=","",$DatabaseSB,$ConSB,"");
			$gN30 = fGlobalNEW("Nilai","ta_penerimaan_berkas","Nomor:Pros",$gR30.":30","=:=","",$DatabaseSB,$ConSB,"");
			if ($gN30) {$gNiL = $gNiL + $gN30;}
		}
	}
}

$gReaD= "readonly";
$gDisB= "hidden";
if ($rIDT!="")
{
	$nSQ = "SELECT * FROM ta_kib_108_temp where IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gKDB  = $mRo['Kd_Aset_108'];
		$gUnt  = substr($mRo['Kd_UPB'],0,11);
		$gSub  = substr($mRo['Kd_UPB'],0,14);
		$mSub  = fGlobalNEW("nm_sub","ref_sub_unit","kd_sub",$gSub,"=","",DatabaseSB,$ConSB,"");
		
		$gUpb  = substr($mRo['Kd_UPB'],0,18);
		$mUpb  = fGlobalNEW("nm_upb","ref_upb","kd_upb",$gUpb,"=","",DatabaseSB,$ConSB,"");
		$fNma  = $mRo['Nm_Aset_108'];
		$gKTR  = $mRo['Keterangan'];
		$gLua  = $mRo['Luas_M2'];
		$gHak  = $mRo['Hak_Tanah'];
		$gGna  = $mRo['Penggunaan'];
		$gAlm  = $mRo['Alamat'];
		$gMLK  = $mRo['Kd_Pemilik'];
		$gAUS  = $mRo['Asal_Usul'];
		$gSTN  = $mRo['Jumlah_Bidang'];
		$gTTL  = $mRo['Nilai_Pengadaan'];
	}
}
else
{
	$gLua  = 0;
	$gSTN  = 1;
	$vUse  = fGlobalNEW("IfNull(sum(Nilai_Pengadaan),0)","ta_kib_108_temp","No_Pengadaan",$gNoM,"=","",$DatabaseSB,$ConSB,"");
	$gTTL  = $gNiL-$vUse;
	
	$gMLK  = "12";
	$gAUS  = "APBD";
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_Asset_A_Mid_Temp_.php?gIdT=".$gIdT."&rIDT=".$rIDT."&IdL=".$_GET['IdL'] ?>">
  <input type="hidden" name="Simpan">
  <table border="0" align="center" width="900" style="font-family:Calibri; font-size:10pt">
    <tr>
      <td width="24"></td>
      <td width="150" height="5"></td>
      <td></td>
      <td width="43"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>UNIT KERJA</td>
      <td><input name="f01" type="text" readonly="readonly" value="<?=$gUnt." : ".strtoupper($mUnt)?>" style="width:450px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>SUB UNIT</td>
      <td>
		<?php if ($rIDT!=""){?>
			<input name="fSub" id="fSub" type="hidden" value="<?=$gSub?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
			<input name="mSub" id="mSub" type="text" readonly value="<?=$gSub." : ".strtoupper($mSub)?>" style="width:450px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
		<?php }else{?>
			<select class="boxs" name="fSub" id="fSub" tabindex="0" style="width:450px" onChange="func_select('CrUPB','fSub','fUpb','')">
			<?php
			if ($fSub){$gSub=$fSub;}
			$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				if ($gSub=="") {$gSub=$mRo[0];}
				if (substr($gSub,0,11)!=$zUnt) {$gSub=$mRo[0];}
				
				$sel ="";
				if ($mRo[0]==$gSub) 
				{
					$sel ="selected";
					$zSub=$mRo[0];
				}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper($mRo[1]).'</option>';
			}
			?>
			</select>
		<?php } ?>
		</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>UPB</td>
      <td>
		<?php if ($rIDT!=""){?>
			<input name="fUpb" id="fUpb" type="hidden" value="<?=$gUpb?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
			<input name="mUpb" id="mUpb" type="text" readonly value="<?=$gUpb." : ".strtoupper($mUpb)?>" style="width:450px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
		<?php }else{?>
			<select class="boxs" name="fUpb" id="fUpb" tabindex="0" style="width: 450px">
			<?php
			$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb where Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				if ($gUpb=="") {$gUpb = $mRo[0];}
				if (substr($gUpb,0,14)!=$zSub) {$gUpb = $mRo[0];}
				$sel ="";
				if ($mRo[0]==$gUpb) 
				{
				$sel ="selected";
				$zUpb=$mRo[0];
				}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper($mRo[1]).'</option>';
			}
			?>
			</select>
		<?php } ?>
		</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td> 
      <td>&nbsp;</td>
      <td valign="middle">&nbsp; </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td> 
      <td>NAMA BARANG</td>
      <td><input name="fNama" type="text" class="text" style="widTh:450px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $fNma?>" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td> 
      <td>LUAS TANAH</td>
      <td><input name="fLuas" type="text" class="text" onBlur="NumValidate(this)" style=" text-align:right; width:80px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo fConvertToRupiah($gLua)?>" />
      &nbsp;&nbsp;<font color="#008000"><strong>M<sup>2</sup></strong></font></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td> 
      <td>HAK TANAH</td>
      <td><input name="fHak" type="text" class="text" id="fHak" style="width:450px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gHak ?>" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td> 
      <td>LETAK TANAH </td>
      <td><input name="fAlmt" type="text" class="text" id="fAlmt" style="width:450px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gAlm?>" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td> 
      <td>PENGGUNAAN</td>
      <td><input name="fGuna" type="text" class="text" id="fGuna" style="width:450px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gGna?>" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">KETERANGAN</td>
      <td><textarea name="fKetr" rows="3" style="width: 450px; border: 1px solid #C0C0C0"><?php echo $gKTR ?></textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">KEPEMILIKAN</td>
      <td><select class="boxs" name="fMilik" style="width: 150px" tabindex="0">
          <option value=""></option>
          <?php
		$nSQ = "SELECT * from ref_pemilik ORDER BY Kd_Pemilik";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			//if ($gMLK=="") {$gMLK=$mRo['Kd_Pemilik'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Pemilik']==$gMLK) 
				{
				$sel ="selected";
				$gMLK=$mRo['Kd_Pemilik'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Pemilik'].'">'.$mRo['Nm_Pemilik'].'</option>';
			}
			  while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">ASAL USUL</td>
      <td><select name="fAsalUsul" class="boxs" style="width: 150px" tabindex="0">
          <option value=""></option>
          <?php
		$nSQ = "SELECT * FROM ref_perolehan ORDER BY IDT";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			do
			{
				$sel ="";
				if ($mRo['Perolehan']==$gAUS) 
				{
				$sel ="selected";
				}
				echo '<option '.$sel.' value="'.$mRo['Perolehan'].'">'.$mRo['Perolehan'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">JUMLAH SATUAN</td>
      <td><input name="fSatuan" type="text" id="fSatuan" value="<?php echo $gSTN?>" onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style=" width:50px; text-align : right; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
      BIDANG</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">NILAI (Rp)</td>
      <td><input name="fTotal" type="text" id="fTotal" value="<?php echo fConvertToRupiah($gTTL)?>" onKeyUp="addSeparator(this)" style="width:130px; text-align: right; background-color: #E1F986; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" size="22" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top"><a href="<?="Pengadaan_Mid.php?gIdT=".$gIdT."&IdL=".$_GET['IdL']?>" class="ico back">&nbsp;&nbsp;FORM PENGADAAN</a></td>
      <td>
	  <input type="button" name="B39" value="SIMPAN" onClick="P_Save('<?=$gSPP?>')" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
      <input type="button" name="B40" value="RESET" onClick="P_Reset()" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td>&nbsp;</td> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Save(spp)
	{
		if (spp=="Y")
		{
			window.alert('Access denied, data sudah digunakan di SimKADA..!!'); 
			return false;
		}
		var fLs  = objfrm.fLuas.value;
		var fMil = objfrm.fMilik.selectedIndex;
		var fAsa = objfrm.fAsalUsul.selectedIndex;
		
		if (fMil==0) 
		{
			window.alert("Kode Kepemilikan belum dipilih..!!");
			return false;
		}
		
		if (fAsa==0) 
		{
			window.alert("Asal usul perolehan belum dipilih..!!");
			return false;
		}
		
		if (fLs.length<=0)
		{
			window.alert("Silahkan isi nilai luas tanah..!!");
			return false;
		}
		
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}
	
	function P_Reset()
	{
		objfrm.Simpan.value = "Reset";
		objfrm.submit();
	}
	
</script>
