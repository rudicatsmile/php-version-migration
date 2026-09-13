<?php
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
$rIDT = $_GET['rIDT'] ?? '';
$rRef = $_GET['rRef'] ?? '';
$rKib = $_GET['rKib'] ?? '';
$gUnt = $_GET['gUnt'] ?? '';
$gNOM = $_GET['gNOM'] ?? '';

$gNIL = 0;
$DisB ="";

$gHriB = fGetDate('mday');
$gBlnB = fGetDate('mon');
$gThnB = fGetDate('year');

$gHri  = fGetDate('mday');
$gBln  = fGetDate('mon');
$gThn  = fGetDate('year');

$gHriM = "00";
$gBlnM = "00";
$gThnM = "0000";

$gHriD = "00";
$gBlnD = "00";
$gThnD = "0000";
$gNoD  = "";
$rMRG  = "";
$gCR   = "INV";
if ($gNOM)
{
	$gTGL = fGlobalNEW("Tanggal","ta_pengadaan","Nomor",$gNOM,"=","",DatabaseSB,$ConSB,"");
	$gTGL = explode("-", $gTGL);
	$gHri = $gTGL[2];
	$gBln = $gTGL[1];
	$gThn = $gTGL[0];
	
	#$gHriB = $gTGL[2];
	#$gBlnB = $gTGL[1];
	#$gThnB = $gTGL[0];
	
	$gNIL = fGlobalNEW("IfNull(sum(Jumlah),0)","daftar_spp","Pengadaan",$gNOM,"=","",DatabaseSA,$ConSA,"");
	$gNIK = 0;
	$gDK  = "D";
	$gCR  = "INV";
	$gURA = fGlobalNEW("Nm_Aset","ta_pengadaan","Nomor",$gNOM,"=","",DatabaseSB,$ConSB,"");
	$gKET = fGlobalNEW("Uraian","ta_pengadaan","Nomor",$gNOM,"=","",DatabaseSB,$ConSB,"");
}

if ($rIDT!="")
{
	$nSQ = "SELECT * FROM ta_kib_post_108 WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$KdA = $mRo['Kd_Aset_108'];
		$gCrT = $mRo['Crit'];
		$gNOM = $mRo['No_Pengadaan'];
		if ($gCrT=="SLD") {$DisB="";}
		
		$gURA = $mRo['Uraian'];
		$gAsl = $mRo['IdAsalUsul'];
		$gKET = $mRo['Keterangan'];
		$gDK  = $mRo['DK'];
		$gCR  = $mRo['Crit'];
		
		#if ($gDK=="D") {$gNIL = $mRo['Debet'];}
		#else {$gNIL = $mRo['Kredit'];}
		
		$gNIL = $mRo['Debet'];
		$gNIK = $mRo['Kredit'];
		
		$gHri  = (int)substr($mRo['Tanggal'],8,10);
		$gBln  = (int)substr($mRo['Tanggal'],5,-3);
		$gThn  = (int)substr($mRo['Tanggal'],0,-6);
		
		$gHriB  = (int)substr($mRo['Tanggal_BAST'],8,10);
		$gBlnB  = (int)substr($mRo['Tanggal_BAST'],5,-3);
		$gThnB  = (int)substr($mRo['Tanggal_BAST'],0,-6);
		
		$gHriM = (int)substr($mRo['Tgl_Mutasi'],8,10);
		$gBlnM = (int)substr($mRo['Tgl_Mutasi'],5,-3);
		$gThnM = (int)substr($mRo['Tgl_Mutasi'],0,-6);
		
		$gMsA  = $mRo['Tmbh_Ms_Manfaat'];
		$rMRG  = $mRo['HasilMerger'];
		if ($rMRG=="Y"){
			$RefMR = $mRo['Mrg_Ref_History'];
			if ($RefMR){
				if(substr($KdA,0,2)=="01"){
					$NmD  = "SERTIFIKAT";
					$gNoD = fGlobalNEW("Sertifikat_Nomor","ta_kib_108_merger_his","Referensi:Kd_UPB",$RefMR.":".$gUnt."%","=:LIKE","",DatabaseSB,$ConSB,"");
					$gTGM = fGlobalNEW("Sertifikat_Tanggal","ta_kib_108_merger_his","Referensi:Kd_UPB",$RefMR.":".$gUnt."%","=:LIKE","",DatabaseSB,$ConSB,"");
					if ($gTGM)
					{
						$gTGM = explode("-",$gTGM);
						$gHriD = (int)$gTGM[2];
						$gBlnD = (int)$gTGM[1];
						$gThnD = (int)$gTGM[0];
					}
				}
				if(substr($KdA,0,2)=="03"){
					$NmD  = "DOKUMEN";
					$gNoD = fGlobalNEW("Dokumen_Nomor","ta_kib_108_merger_his","Referensi:Kd_UPB",$RefMR.":".$gUnt."%","=:LIKE","",DatabaseSB,$ConSB,"");
					$gTGM = fGlobalNEW("Dokumen_Tanggal","ta_kib_108_merger_his","Referensi:Kd_UPB",$RefMR.":".$gUnt."%","=:LIKE","",DatabaseSB,$ConSB,"");
					if ($gTGM)
					{
						$gTGM = explode("-",$gTGM);
						
						$gHriD = (int)$gTGM[2];
						$gBlnD = (int)$gTGM[1];
						$gThnD = (int)$gTGM[0];
					}
				}
			}
		}
	}
}

if ($gMsA=='YA')
{
	$CKA = "checked";
	$CKB = "";
}
else
{
	$CKA = "";
	$CKB = "checked";
}
?>
<body>
<form name="myfrm" method="post" action="<?="Form_Invent_Asset_Ubh_Mid_.php?rIDT=".$rIDT."&rRef=".$rRef."&rKib=".$rKib."&gUnt=".$gUnt."&IdL=".($_GET['IdL'] ?? '')?>">
<input type="hidden" name="Simpan">
  <table border="0" width="800" cellpadding="0" style="border-collapse: collapse">
    <tr>
      <td width="12">&nbsp;</td>
      <td width="115">&nbsp;</td>
      <td width="18">&nbsp;</td>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr height="26">
      <td>&nbsp;</td>
      <td class="ar">TGL. BAST</td>
      <td>&nbsp;</td>
      <td width="223">
	  <select class="boxs" name="fHriB" style="width: 45px">
	  <option value="00"></option>
        <?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHriB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>&nbsp;
	  <select class="boxs" name="fBlnB" style="width: 90px">
	  <option value="00"></option>
	  <?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$gBlnB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>&nbsp;
		<select class="boxs" name="fThnB" style="width: 60px" tabindex="0">
	  <option value="0000"></option>
		<?php
			for($nThn=1900; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($nThn==$gThnB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
		</select>      </td>
      <td width="119" class="ar"><?php if ($rMRG=="Y"){echo "TGL. ".$NmD;}?></td>
      <td width="23">&nbsp;</td>
      <td width="274">
	  <?php if ($rMRG=="Y") {?>
	  <select class="boxs" name="fHriD" style="width: 45px">
	  <option value="00"></option>
        <?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHriD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>&nbsp;
	  <select class="boxs" name="fBlnD" style="width: 90px">
	  <option value="00"></option>
	  <?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==(int)$gBlnD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>&nbsp;
		<select class="boxs" name="fThnD" style="width: 60px" tabindex="0">
	    <option value="0000"></option>
		<?php
			for($nThn=1900; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($nThn==(int)$gThnD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
		</select>
		<?php } else {?> 
			<input name="fHriD" type="hidden" class="text" style=" width:100px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="00" /> 
			<input name="fBlnD" type="hidden" class="text" style=" width:100px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="00" /> 
			<input name="fThnD" type="hidden" class="text" style=" width:100px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="0000" /> 
		<?php } ?>
	  </td>
    </tr>
    <tr height="26">
      <td>&nbsp;</td>
      <td class="ar">TGL. PEROLEHAN</td>
      <td>&nbsp;</td>
      <td>
	  <select class="boxs" name="fHri" style="width: 45px">
        <?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>&nbsp;
	  <select class="boxs" name="fBln" style="width: 90px">
	  <?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$gBln) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>&nbsp;
		<select class="boxs" name="fThn" style="width: 60px" tabindex="0">
		<?php
			for($nThn=1900; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($nThn==$gThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
		</select>      </td>
      <td class="ar"><?php if ($rMRG=="Y"){echo "NO. ".$NmD;}?></td>
      <td>&nbsp;</td>
      <td>
	  <?php if ($rMRG=="Y") {?>
		  <input name="fNOD" type="text" class="text" style=" width:202px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gNoD?>" />
	  <?php }else{ ?>
		  <input name="fNOD" type="hidden" class="text" style=" width:202px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gNoD?>" />
	  <?php } ?>
	  </td>
    </tr>
    <tr height="26">
      <td>&nbsp;</td>
      <td class="ar">TGL. MUTASI </td>
      <td>&nbsp;</td>
      <td>
	  <select class="boxs" name="fHriM" style="width: 45px">
	  <option value="00"></option>
        <?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHriM) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>&nbsp;
	  <select class="boxs" name="fBlnM" style="width: 90px">
	  <option value="00"></option>
	  <?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$gBlnM) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>&nbsp;
		<select class="boxs" name="fThnM" style="width: 60px" tabindex="0">
		<option value="0000"></option>
		<?php
			for($nThn=1900; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($nThn==$gThnM) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
		</select>      </td>
      <td class="ar">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr height="26">
      <td>&nbsp;</td>
      <td class="ar">URAIAN</td>
      <td>&nbsp;</td>
      <td colspan="4"><input name="fUraian" type="text" class="text" style="width:450px; height:19px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gURA?>" /></td>
    </tr>
    <tr height="26">
      <td>&nbsp;</td>
      <td class="ar">ASAL USUL</td>
      <td>&nbsp;</td>
      <td colspan="4">
		<select class="boxs" name="fAsal" tabindex="0" style="width:250px">
		<!--option value=""></option-->
		<?php
			$nSQ="SELECT idt, perolehan FROM ref_perolehan ORDER BY perolehan";
			$nRs = mysql_query($nSQ);
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$sel ="";
				if ($gAsl==$mRo[0]){
					$sel  = "selected";
				}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[1].'</option>';
			}
			?>
		</select>	  
	  </td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td class="ar">NO. PENGADAAN</td>
      <td>&nbsp;</td>
      <td colspan="3"><input name="fNOM" readonly type="text" class="text" style=" width:246px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gNOM?>" /></td>
      <td><input type="hidden" name="B3922" value="...." onclick="FindNOMOR('850','450','<?=$rIDT?>')" style="width: 30px; height: 19px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td class="ar">NILAI</td>
      <td>&nbsp;</td>
      <td colspan="4"><input name="fNilai" type="text" class="text" id="fNilai" onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style="text-align: right; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px" value="<?php echo fConvertToRupiah($gNIL)?>" size="19" maxlength="19" /></td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td class="ar">KRITERIA NILAI </td>
      <td>&nbsp;</td>
      <td colspan="4">
	  <select name="fCriteria" class="boxs" id="fCriteria" style="width: 193px" tabindex="0">
      <option <?php if ($gCR=="SLD") {echo "selected";}?> value="SLD">SALDO AWAL</option>
      <option <?php if ($gCR=="INV") {echo "selected";}?> value="INV">ATRIBUSI</option>
      </select></td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td style="vertical-align:top" class="ar">KETERANGAN</td>
      <td>&nbsp;</td>
      <td colspan="4"><textarea name="fKeterangan" style="width:450px; height:70px; border: 1px solid #C0C0C0"><?php echo $gKET ?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="4" style="color:#FF0000"><?php echo $_REQUEST['MsG'] ?? ''?>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="4">
	  <input type="button" name="B39" value="SIMPAN" onclick="P_Save('<?=$ReO?>')" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
      <input type="button" name="B393" value="TUTUP" onclick="P_Close()" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="4">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Save(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		<?php if ($DisB!="") {?>
		{window.alert("Access denied ...!");}
		<?php } else {?>
		{
		objfrm.Simpan.value = "Save";
		objfrm.submit();
		}
		<?php } ?>
	}

	function P_Close()
	{
		objfrm.Simpan.value = "Close";
		objfrm.target="_top";
		objfrm.submit();
	}
	
	function FindNOMOR(w,h,idt)
	{	
		if (idt) {window.alert('Access denied..!!'); return false;}
		var win=null;
		var txtHTML = "";
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
			if (win!=null)
    			{
      				win.window.document.open()       			
					<?php
						$URL_Top = "Form_Invent_Asset_Ubh_Mid_Top.php?rIDT=".$rIDT."&rRef=".$rRef."&rKib=".$rKib."&IdL=".($_GET['IdL'] ?? '');
						$URL_Mid = "Form_Invent_Asset_Ubh_Mid_Mid.php?rIDT=".$rIDT."&rRef=".$rRef."&rKib=".$rKib."&IdL=".($_GET['IdL'] ?? '');
						$URL_Bot = "Form_Invent_Asset_Ubh_Mid_Bot.php";
					?>       			
       			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindBBB_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindBBB_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindBBB_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
</script>
<?php require "FileFormatNum.php"?>
<?php require('Connection_Close.php');?>
