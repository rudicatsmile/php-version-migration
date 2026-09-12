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
</head>
<?php

function fConvertDateLongsBlnWithTime($mDt)
{
	$mD = (int)substr($mDt,8,10);
	$mB = (int)substr($mDt,5,-3);
	$mT = (int)substr($mDt,0,-3);

	$arr_waktu = explode (" ",$mDt);

	return substr("00".$mD,-2,2)." ".fNmBulanShort($mB)." ".$mT.' : '.$arr_waktu[1];
}

if (isset($_GET['rIDT'])) {$rIDT = $_GET['rIDT'];}
$gReaD= "readonly";
$gDisB= "hidden";
$KeY  = "N";
if ($rIDT!="")
{
	$nSQ = "SELECT * FROM ta_kib_108 where IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gNoR  = $mRo['No_Register'];
		$gIMG  = $mRo['file_name'];	
		$gREF  = $mRo['Referensi'];
		$gGRP  = $mRo['Ref_Group'];
		$gKDB  = $mRo['Kd_Aset_108'];
		$gRua  = $mRo['Kd_Ruang'];
		$gREG  = $mRo['No_Register'];
		$gKDBAR  = $mRo['kode_bar'];

		$gRecorded_map = fConvertDateLongsBlnWithTime(fGlobal("recorded_map","ta_kib_108_barcode","kode_bar",$gKDBAR,"=","",""));
		$gPencatat_map = fGlobal("userName","ta_kib_108_barcode","kode_bar",$gKDBAR,"=","","");
		//$gPencatat_map = $mRo['Pencatat'];
		
		if ($gGRP!="")
		{
			$gReaD="";
			$gDisB="";
			$gTexB="UPDATE SEMUA ITEM";
		}
		
		$gUnt  = substr($mRo['Kd_UPB'],0,11);
		$gSub  = substr($mRo['Kd_UPB'],0,14);
		$gUpb  = substr($mRo['Kd_UPB'],0,18);
	
		$gBid  = substr($mRo['Kd_Aset_108'],0,8);
		$gKel  = substr($mRo['Kd_Aset_108'],0,11);
		$gOBJ  = substr($mRo['Kd_Aset_108'],0,14);
		$gRin  = substr($mRo['Kd_Aset_108'],0,18);
		
		if ($mRo['Nm_Aset']=="") {$fNma = fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
		else {$fNma = $mRo['Nm_Aset'];}
		
		$gMrk  = $mRo['Merk'];
		$gTyp  = $mRo['Type'];
		$gUcc  = $mRo['Ukuran_CC'];
		$gBHN  = $mRo['Bahan'];
		$gPBR  = $mRo['Nomor_Pabrik'];
		$gRKA  = $mRo['Nomor_Rangka'];
		$gMSN  = $mRo['Nomor_Mesin'];
		$gPLS  = $mRo['Nomor_Polisi'];
		$gPLSL = $mRo['Nomor_Polisi_Lama'];
		if ($gPLS==""){$gPLS="-";}
		$gBPK  = $mRo['Nomor_BPKB'];
		if ($gBPK==""){$gBPK="-";}
		
		$gPMG  = $mRo['Pemegang'];
		$gPMGL = $mRo['Pemegang_Lama'];
		
		$gKTR  = $mRo['Keterangan'];
		
		$gMLK  = $mRo['Kd_Pemilik'];
		$gKDS  = $mRo['Kondisi'];
		$gAUS  = $mRo['Asal_Usul'];
		$gMSM  = $mRo['Masa_Manfaat'];
		
		$gHri  = (int)substr($mRo['Tgl_Perolehan'],8,10);
		$gBln  = (int)substr($mRo['Tgl_Perolehan'],5,-3);
		$gThn  = (int)substr($mRo['Tgl_Perolehan'],0,-6);
		
		$gHriM = (int)substr($mRo['Tgl_Mutasi'],8,10);
		$gBlnM = (int)substr($mRo['Tgl_Mutasi'],5,-3);
		$gThnM = (int)substr($mRo['Tgl_Mutasi'],0,-6);
		
		$tKib= "B";
		$KeY = CekKey($gUnt,$gThn,'Kib_'.$tKib,'');
		
		#if ($gThn<=2014){
		#	$KeY="Y";
		#}
		
		#########
		if ($UID=="creator"){$KeY="N";}
		#########
		
		if ($gGRP!="")		//Jika input rombongan / Nilai Jumlah_Satuan lebih dari 1 (satu) --> Maka Field Ref_Group tidak kosong.
		{
			$gREGa = fMakeRegister(fGlobal("RegFrom","Ta_Kib_Group","Referensi",$gGRP,"=","",""),7);
			$gREGb = fMakeRegister(fGlobal("RegTo","Ta_Kib_Group","Referensi",$gGRP,"=","",""),7);
			
			$gSTN = fGlobal("Jml_Item","Ta_Kib_Group","Referensi",$gGRP,"=","","");
			$gTTL = fGlobal("Nilai_Total","Ta_Kib_Group","Referensi",$gGRP,"=","","");
			$gHRG = $mRo['Harga'];
		}
		else
		{
			$gGRP = "NON GROUP";
			$gSTN = 1;
			$gTTL = $mRo['Harga'];
			$gHRG = $mRo['Harga'];
		}
		$gNIa = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi",$gREF,"=","","");
		$gNIb = fGlobal("IfNull(sum(Kredit),0)","ta_kib_post_108","Referensi",$gREF,"=","","");
		if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
		else {$gNIL=$gNIa;}
	}
}
else
{
	$gSTN  = 0;
	$gTTL  = 0;
	$gHRG  = 0;
	
	$gUnt  = $_GET['gUnt'];
	$gSub  = $_GET['gSub'];
	$gUpb  = $_GET['gUpb'];
	$gThn  = $_GET['gThn'];
	
	$gBid  = $_GET['gBid'];
	$gKel  = $_GET['gKel'];
	$gOBJ  = $_GET['gOBJ'];
	$gRin  = $_GET['gRin'];
	
	$gHri  = fGetDate('mday');
	$gBln  = fGetDate('mon');
	$gThn  = fGetDate('year');
	
	$gHriM = "00";
	$gBlnM = "00";
	$gThnM = "0000";
}
?>
<body>

  <table border="0" align="center" width="1165">
    <tr>
      <td></td>
      <td></td>
    </tr>
    <tr> 
      <td colspan="2"> <table border="0" width="430" style="border-collapse: collapse; color: #CC0000; border: 1px solid #8FA908; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
          <tr> 
            <td width="12" bgcolor="#8FA908">&nbsp;</td>
            <td width="108" bgcolor="#8FA908">DATA SIMANDOR</td>
            <td width="15" bgcolor="#8FA908">&nbsp;</td>
            <td colspan="2" bgcolor="#8FA908">&nbsp;</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">REFERENSI</td>
            <td width="15">:</td>
            <td colspan="2"> 
              <?php echo $gREF?>            </td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">KODE BARANG</td>
            <td width="15">:</td>
            <td colspan="2"> 
              <?php echo $gKDB.".".$gREG?>            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>REGISTER</td>
            <td>:</td>
            <td colspan="2"> 
              <?php echo $gREG?>            </td>
          </tr>
          
          <tr> 
            <td>&nbsp;</td>
            <td>KODE BAR</td>
            <td>:</td>
            <td colspan="2"><?php echo $gKDBAR?></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>NILAI AKHIR </td>
            <td>:</td>
            <td colspan="2"> Rp.&nbsp;
              <?php echo fConvertToRupiah($gNIL)?>            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td width="116" rowspan="7" align="center" valign="middle">
			<table border="0" width="97" bgcolor="#FFFFFF" cellpadding="0" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
			  <tr>
			    <td height="15" align="center" valign="middle" style="border: 1px solid #C0C0C0"></td>
			  </tr>
			  <tr>
			    <td height="100" align="center" valign="middle" style="border: 1px solid #C0C0C0">
				<?php if ($gIMG!="") {?>
					<a href="#">
				<img src="<?="SourceIMG.php?rCRT=b&rIDT=".$rIDT?>" height="75" width="80" onclick="PreviewIMG('400','300','center')"?>" height="75" width="80" onclick="PreviewIMG('400','300','center')"?>" height="75" width="80" onclick="PreviewIMG('400','300','center')"></a>
				<?php } else {?>
					<img src="Images/FileLogin_70.gif" width="20" height="20">
				<?php } ?>				</td>
			  </tr>
			</table>			</td>
          </tr>
          
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">&nbsp;</td>
            <td width="15">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">RECORDED</td>
            <td width="15">:</td>
            <td><?php echo $gRecorded_map ?></td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">PENCATAT</td>
            <td width="15">:</td>
            <td><?php echo $gPencatat_map?></td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">&nbsp;</td>
            <td width="15">&nbsp;</td>
            <td width="155">&nbsp;</td>
          </tr>
         
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>

</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Save(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		var fMil = objfrm.fMilik.selectedIndex;
		var fKon = objfrm.fKondisi.selectedIndex;
		var fAsa = objfrm.fAsalUsul.selectedIndex;
		
		var fMer = objfrm.fMerk.value.length;
		var fTyp = objfrm.fType.value.length;
		var fRan = objfrm.fRangka.value.length;
		var Mes = objfrm.fMesin.value.length;
		var fPol = objfrm.fPolisi.value.length;
		var fBPK = objfrm.fBPKB.value.length;
		
		if (fMil==0) {
		window.alert("Kode Kepemilikan belum dipilih..!!");
		return false;}
		
		if (fKon==0) {
		window.alert("Kondisi barang belum dipilih..!!");
		return false;}
		
		if (fAsa==0) {
		window.alert("Asal usul perolehan belum dipilih..!!");
		return false;}
		
		if (fMer==0) {
		window.alert("Data merk barang belum terisi..!!");
		return false;}
		
		if (fTyp==0) {
		window.alert("Data tipe barang belum terisi..!!");
		return false;}
		
		if (fRan==0) {
		window.alert("Nomor rangka belum terisi..!!");
		return false;}
		
		if (Mes==0) {
		window.alert("Nomor mesin belum terisi..!!");
		return false;}
		
		if (fPol==0) {
		window.alert("Nomor polisi belum terisi..!!");
		return false;}
		
		if (fBPK==0) {
		window.alert("Nomor BPKB belum terisi..!!");
		return false;}
		
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}

	function P_Reset(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.Simpan.value = "Reset";
		objfrm.submit();
	}
	
	function OpenAccNumb(w,h,pos)
	{
		var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100;
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			<?php
				$URL_Top = "Find_Acc_Top.php?CrAcc=Form_Asset_B_Mid&IdL=".$_GET['IdL']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb;
				$URL_Mid = "Find_Acc_Mid.php?CrAcc=Form_Asset_B_Mid&IdL=".$_GET['IdL']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb;
				$URL_Bot = "Find_Acc_Bot.php";
			?>       			
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}

	function OpenUbahNilai(w,h,pos)
	{	var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
			if (win!=null)
    			{
      				win.window.document.open()       			
					<?php
					$URL_Top = "Form_Invent_Asset_Top.php?FrmG=INVENTARISASI -> PERUBAHAN NILAI -> KIB B (Peralatan dan Mesin)";
					$URL_Mid = "Form_Invent_Asset_Ubh.php?rKib=Kib_B&IdL=".$_GET['IdL']."&rIDT=".$rIDT;
					$URL_Bot = "Form_Invent_Asset_Bot.php";
					?>       			
       			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
	
	function P_ViewHistory(w,h,pos)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		<?php
			{
			$URL="KIB_B_History.php?rIDT=".$rIDT."&IdL=".$_GET['IdL'];
			}
		?>
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open('<?php echo $URL?>','',settings);
	}
	
	function P_MoveAccount(KeY,w,h,rIDT,IdL)
	{
		if (KeY=='Y') {alert('Access denied, data sudah terkunci..!!'); return false;}
		var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = 'Move_Account_Top.php?FrmG=PEMINDAHAN REKENING ASET -> KIB B (Peralatan dan Mesin)';
			URL_Mid = 'Move_Account_Mid.php?rKib=Kib_B&IdL='+IdL+'&rIDT='+rIDT;
			URL_Bot = 'Move_Account_Bot.php';
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinReplAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinReplAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinReplAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function P_MoveUPB(KeY,w,h,rIDT,IdL)
	{
		if (KeY=='Y') {alert('Access denied, data sudah terkunci..!!'); return false;}
		var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = 'Move_Upb_Kib_Top.php?FrmG=PEMINDAHAN KODE UPB -> KIB B (Peralatan dan Mesin)';
			URL_Mid = 'Move_Upb_Kib_Mid.php?rKib=Kib_B&IdL='+IdL+'&rIDT='+rIDT;
			URL_Bot = 'Move_Upb_Kib_Bot.php';
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinReplAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinReplAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinReplAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
		
	function OpenAccIMG(w,h,pos)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		<?php
			{
			$URL="TestIMG.php?rIDT=".$rIDT."&IdL=".$_GET['IdL'];
			}
		?>
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open('<?php echo $URL?>','',settings);
	}
   
	function PreviewIMG(w,h,pos)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		<?php
			{
			$URL="PreviewIMG.php?rCRT=b&rIDT=".$rIDT."&IdL=".$_GET['IdL'];
			}
		?>
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open('<?php echo $URL?>','',settings);
	}

	function OpenAccIMG(w,h,pos)
	{	var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = "UploadIMG_Top.php?FrmG=UPLOAD FOTO ASET -> KIB B (PERLATAN DAN MESIN)";
			URL_Mid = "UploadIMG_Mid.php?"+"<?="rCRT=b&rIDT=".$rIDT."&IdL=".$_GET['IdL']?>";
			URL_Bot = "UploadIMG_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFindAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function P_PDF(crt,w,h,rIdT,gIdT,IdL)
	{
		var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = 'UploadPDF_Top.php?FrmG=UPLOAD PDF';
			URL_Mid = 'UploadPDF_Mid.php?crt='+crt+'&rIdT='+rIdT+'&gIdT='+gIdT+'&IdL='+IdL;
			URL_Bot = 'UploadPDF_Bot.php';
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFindAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function P_PRE(crt,w,h,rIdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='UploadPDF_Pre.php?crt='+crt+'&rIdT='+rIdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}

	
	function P_OpenDoc(w,h,doc)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= doc +"<?=".php?rIDT=".$rIDT."&gMLK=".$gMLK."&IdL=".$_GET['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
</script>
