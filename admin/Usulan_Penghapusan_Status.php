<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
if (isset($_POST['fThn'])) {$gThn  = $_POST['fThn'];}
if (isset($_REQUEST['gThn'])) {$gThn  = $_REQUEST['gThn'];}
if ($gThn=="") {$gThn  = fGetDate('year');}
?>
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "Usulan_Penghapusan_Status.php?FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL'] ?>">
  <input type="hidden" name="Simpan">
  <table border="0" align="center" width="900px">
    <tr> 
      <td width="81">TAHUN</td>
      <td width="506">
	  <select class="boxs" name="fThn" style="width: 60px" tabindex="0" onchange="P_Change()">
        <?php
		for($nThn=1900; $nThn<=2030; $nThn++)
		{
		$sel ="";
		if ($nThn==$gThn) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
      </select></td>
      <td width="669">&nbsp;</td>
    </tr>
  </table>
	
        <!-- Content -->
        <!-- Table -->
        <div class="table"> 
          
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <th width="28">No</th>
        <th width="110">Referensi</th>
        <th width="83">Tanggal</th>
        <th width="133">Nomor</th>
        <th width="233">Keterangan</th>
        <th width="97" class="ar">Nilai</th>
        <th width="13" class="ac">&nbsp;</th>
        <th width="266">SKPD/UPB</th>
        <th width="73" class="ac">Status</th>
        <th width="94" class="ac">Execute</th>
        <th width="140" class="ac">Actions</th>
      </tr>
      <?php
	  	$gTtL = 0;
	  	$iG = 1;
		$nSQL= "SELECT * FROM ta_penghapusan_usulan WHERE Tahun LIKE '".$gThn."' ORDER BY Tanggal";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			$rIDT= $mRo['IDT'];
			$NiL = fGlobal("IfNull(sum(Nilai),0)","ta_penghapusan_usulan_rinc","Referensi",$mRo['Referensi'],"=","","");
			$SKP = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$mRo['Kd_UPB'],"=","","");
			$gTtL = $gTtL + $NiL;
			$rSTA= $mRo['Status'];
			$rEXE= $mRo['Eksekusi'];
			if ($rSTA=="") {$rSTA="..?????";}
			if ($rEXE=="N") {$rEXE="..?????";} else {$rEXE="<i>Executed</i>";}
			?>
			  <tr style="cursor: pointer" onmouseover="this.style.cursor=&#39;pointer&#39"> 
				<td valign="top"><?php echo $iG++?>.</td>
				<td valign="top"><?php echo $mRo['Referensi']?></td>
				<td valign="top"><?php echo fConvertDateShort($mRo['Tanggal'])?></td>
				<td valign="top"><?php echo $mRo['Nomor'] ?></td>
				<td valign="top"><?php echo $mRo['Keterangan']?></td>
				<td valign="top" class="ar"><?php echo fConvertToRupiah($NiL)?></td>
				<td valign="top">&nbsp;</td>
				<td valign="top"><?=$SKP?></td>
				<td valign="top" class="ac"><a href="#" class="ico stat" onclick="P_STA('600','400','center','<?=$rIDT?>'); return false">&nbsp;<?=$rSTA?></a></td>
				<td valign="top" class="ac"><a href="#" class="ico exec" onclick="P_EXE('900','500','center','<?=$rIDT?>','<?=$rSTA?>'); return false">&nbsp;<?=$rEXE?></a></td>
				<td valign="top" align="center">
				<a href="#" class="ico docu" onclick="P_DOC('800','400','center','<?=$rIDT?>'); return false">&nbsp;DOKUMEN</a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo "Usulan_Penghapusan.php?rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_REQUEST['IdL'];?>" class="ico edit">&nbsp;EDIT</a></td>
			  </tr>
			  <?php
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		else
		{
		?>
      <tr> 
        <td></td>
        <td colspan="3">Data tidak ditemukan..!!</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <?php
		}
		?>
      <tr>
        <td colspan="11"><hr size="0" /></td>
      </tr>
      <tr> 
        <td colspan="5" style="font-weight:bold; text-align:center">TOTAL</td>
        <td style="text-align:right; font-weight:bold"><?=fConvertToRupiah($gTtL)?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="11">&nbsp;
		<a href="#" class="ico reff" onclick="P_Refresh()">&nbsp;&nbsp;REFRESH</a></td>
      </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Change()
	{
		objfrm.submit();
	}
	function P_Refresh()
	{
		
		window.open('<?php echo $_SERVER['PHP_SELF']."?FrmG=".$_REQUEST['FrmG']."&gThn=".$gThn."&IdL=".$_REQUEST['IdL'];?>','_self');
	}
	
	function P_Comming()
	{
		window.alert('Under construction...!!');
	}
	
	function P_DOC(w,h,pos,IDT)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL="Usulan_Penghaspusan_Doc.php?rIDT="+IDT+"<?="&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$_REQUEST['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}

	function P_STA(w,h,pos,rIDT)
	{	var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
			win=window.open('','',settings);
			if (win!=null)
			{
				win.window.document.open()       			
				URL_Top = "Form_Status_Usulan_Top.php?"+"<?="FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']?>";
				URL_Mid = "Form_Status_Usulan_Mid.php?rIDT="+rIDT+"<?="&gThn=".$gThn."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']?>";
				URL_Bot = "Form_Status_Usulan_Bot.php";
				txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='35,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+ URL_Top +"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>" 
				win.focus()
				win.window.document.clear()
				win.window.document.write(txtHTML)
				win.window.document.close() 
				win.setTimeout("self.close()",200000000)
			}
	}

	function P_EXE(w,h,pos,rIDT,rSTA)
	{
		if (rSTA!="DISETUJUI")
		{window.alert('Status tidak disetujui, proses eksekusi dibatalkan..!!');}
		else
		{
			var win=null;
			var txtHTML = "";
			var iErrors=0;
			LeftPosition=(screen.width)?(screen.width-w)/2:100; 
			TopPosition=(screen.height)?(screen.height-h)/2:100;
			settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
			win=window.open('','',settings);
			if (win!=null)
			{
				win.window.document.open()       			
				URL_Top = "Form_Execute_Usulan_Top.php?"+"<?="FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']?>";
				URL_Mid = "Form_Execute_Usulan_Mid.php?rIDT="+rIDT+"<?="&gThn=".$gThn."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']?>";
				URL_Bot = "Form_Execute_Usulan_Bot.php";
				txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='35,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+ URL_Top +"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>" 
				win.focus()
				win.window.document.clear()
				win.window.document.write(txtHTML)
				win.window.document.close() 
				win.setTimeout("self.close()",200000000)
			}
		}
	}
</script>
<?php require "Connection_Close.php"?>

