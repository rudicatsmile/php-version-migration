<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php if ($_REQUEST['Simpan']=="Close") {?>
	<script LANGUAGE="JavaScript">            
	this.setTimeout("self.close()",0)
	</script>
<?php } ?>

<?php
$rKib = $_REQUEST['rKib'];
if ($rKib=="Kib_A") {$Lnjt="KIB A (ASET TANAH)";}
if ($rKib=="Kib_B") {$Lnjt="KIB B (PERALATAN DAN MESIN)";}
if ($rKib=="Kib_C") {$Lnjt="KIB C (GEDUNG DAN BANGUNAN)";}
if ($rKib=="Kib_D") {$Lnjt="KIB D (JALAN, IRIGASI DAN JARINGAN)";}
if ($rKib=="Kib_E") {$Lnjt="KIB E (ASET TETAP LAINNYA)";}

$rIDT = $_REQUEST['rIDT'];
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_Invent_Asset_Opt.php?rIDT=".$_REQUEST['rIDT']."&IdL=".$_REQUEST['IdL']."&FrmG=".$_REQUEST['FrmG']."&rKib=".$_REQUEST['rKib']?>">
<input type="hidden" name="Simpan">
<table border="0" width="530" cellspacing="1" style="font-family: Calibri; font-weight: bold; border-collapse: collapse">
	<tr>
		<td width="104">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="112">&nbsp;</td>
	</tr>
	<?php if (gAAAAA==1) {?>
	<tr>
		<td width="104">&nbsp;</td>
		<td><input type="button" name="B1" value="PENGGUNAAN" onclick="P_Penggunaan()" style="width: 400px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
		<td width="112">&nbsp;</td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td><input type="button" name="B2" value="PEMELIHARAAN" onclick="P_Pemeliharaan()" style="width: 400px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
	  <td>&nbsp;</td>
    </tr>
	<?php } ?>
	<tr>
		<td width="104">&nbsp;</td>
		<td><input type="button" name="B3" value="PERUBAHAN NILAI" onclick="P_UbahNilai()" style="width: 400px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
		<td width="112">&nbsp;</td>
	</tr>
	<?php if (gAAAAA==1) {?>
	<tr>
	  <td>&nbsp;</td>
	  <td><input type="button" name="B4" value="PEMINDAHTANGANAN" onclick="P_PindahTangan()" style="width: 400px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
	  <td>&nbsp;</td>
    </tr>
	<?php } ?>
	<tr>
		<td width="104">&nbsp;</td>
		<td><input type="button" name="B5" value="USULAN PENGHAPUSAN" disabled="disabled" onclick="P_Penghapusan()" style="width: 400px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
		<td width="112">&nbsp;</td>
	</tr>
	
	
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td><input type="button" name="B6" value="TUTUP" onclick="P_Close()" style="width: 400px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
  <tr>
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
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
	}
	
	function P_UbahNilai()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
		OpenUbahNilai('950','520','center');
	}

	function P_PindahTangan()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
		OpenPindahTgn('950','520','center');
	}

	function P_Pemeliharaan()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
		OpenPemeliharaan('950','520','center');
	}

	function P_Penggunaan()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
		OpenPenggunaan('950','520','center');
	}

	function P_Penghapusan()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
		OpenHapus('950','520','center');
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
					$URL_Top = "Form_Invent_Asset_Top.php?FrmG=INVENTARISASI -> PERUBAHAN NILAI ->  ".$Lnjt;
					$URL_Mid = "Form_Invent_Asset_Ubh.php?rIDT=".$_REQUEST['rIDT']."&IdL=".$_REQUEST['IdL']."&rKib=".$_REQUEST['rKib'];
					$URL_Bot = "Form_Invent_Asset_Bot.php";
					?>       			
       			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
	
	function OpenPindahTgn(w,h,pos)
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
					$URL_Top = "Form_Invent_Asset_Top.php?FrmG=INVENTARISASI -> PEMINDAHTANGANAN ->  ".$Lnjt;
					$URL_Mid = "Form_Invent_Asset_TGN.php?rIDT=".$_REQUEST['rIDT']."&IdL=".$_REQUEST['IdL']."&rKib=".$_REQUEST['rKib'];
					$URL_Bot = "Form_Invent_Asset_Bot.php";
					?>       			
       			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
	
	function OpenPemeliharaan(w,h,pos)
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
					$URL_Top = "Form_Invent_Asset_Top.php?FrmG=INVENTARISASI -> PEMELIHARAAN -> ".$Lnjt;
					$URL_Mid = "Form_Invent_Asset_PLH.php?rIDT=".$_REQUEST['rIDT']."&IdL=".$_REQUEST['IdL']."&rKib=".$_REQUEST['rKib'];
					$URL_Bot = "Form_Invent_Asset_Bot.php";
					?>       			
       			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
	
	function OpenPenggunaan(w,h,pos)
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
					$URL_Top = "Form_Invent_Asset_Top.php?FrmG=INVENTARISASI -> PENGGUNAAN -> ".$Lnjt;
					$URL_Mid = "Form_Invent_Asset_GNA.php?rIDT=".$_REQUEST['rIDT']."&IdL=".$_REQUEST['IdL']."&rKib=".$_REQUEST['rKib'];
					$URL_Bot = "Form_Invent_Asset_Bot.php";
					?>       			
       			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
	
	function OpenHapus(w,h,pos)
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
					$URL_Top = "Form_Invent_Asset_Top.php?FrmG=INVENTARISASI -> PENGHAPUSAN ->  ".$Lnjt;
					$URL_Mid = "Form_Invent_Asset_HPS.php?rIDT=".$_REQUEST['rIDT']."&IdL=".$_REQUEST['IdL']."&rKib=".$_REQUEST['rKib'];
					$URL_Bot = "Form_Invent_Asset_Bot.php";
					?>       			
       			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
</script>