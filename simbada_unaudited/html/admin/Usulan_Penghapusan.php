<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?
if (isset($_REQUEST['gUnt'])) {$gUnt  = $_REQUEST['gUnt'];} else {$gUnt  ="";}
if (isset($_REQUEST['gSub'])) {$gSub  = $_REQUEST['gSub'];} else {$gSub  ="";}
if (isset($_REQUEST['gUpb'])) {$gUpb  = $_REQUEST['gUpb'];} else {$gUpb  ="";}

if (isset($_REQUEST['rIDT'])) {$rIDT  = $_REQUEST['rIDT'];} else {$rIDT  ="";}

if ($rIDT=="")
{
	$gHri  = fGetDate('mday');
	$gBln  = fGetDate('mon');
	$gThn  = fGetDate('year');
}
else
{
	$nSQ = "SELECT * FROM ta_penghapusan_usulan WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gHri  = (int)substr($mRo['Tanggal'],8,10);
		$gBln  = (int)substr($mRo['Tanggal'],5,-3);
		$gThn  = (int)substr($mRo['Tanggal'],0,-6);
		$gRef  = $mRo['Referensi'];
		$gNom  = $mRo['Nomor'];
		$gKet  = $mRo['Keterangan'];
		
		$gUnt  = substr($mRo['Kd_UPB'],0,11);
		$gSub  = substr($mRo['Kd_UPB'],0,14);
		$gUpb  = $mRo['Kd_UPB'];
	}
}
?>

<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "Usulan_Penghapusan_.php?rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL'] ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
  <table border="0" align="center" width="900px">
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="265">&nbsp;</td>
      <td width="187">&nbsp;</td>
      <td width="125">&nbsp;</td>
    </tr>
    <tr> 
      <td width="67">UNIT</td>
      <td width="517"> 
        <select class="boxs" name="fUnt" tabindex="0" style="width: 470px" onchange="this.form.submit()">
        <?
		if ($Lev > 1 )
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit WHERE Kd_Unit = '".substr($SkP,0,11)."' ORDER BY Kd_Unit";}
		else
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUnt=="") {$gUnt=$mRo['Kd_Unit'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Unit']==$gUnt) 
				{
				$sel ="selected";
				$zUnt=$mRo['Kd_Unit'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".$mRo['Nm_Unit'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
      <td width="83">TANGGAL</td>
      <td><select class="boxs" name="fHri" tabindex="0">
        <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
		$sel ="";
		if ($nHri==$gHri) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>
        &nbsp;
        <select class="boxs" name="fBln" tabindex="0">
          <?
		for($nBln=1; $nBln<=12; $nBln++)
		{
		$sel ="";
		if ($nBln==$gBln) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
        </select>
&nbsp;
<select class="boxs" name="fThn" style="width: 60px" tabindex="0">
  <?
		for($nThn=1900; $nThn<=2030; $nThn++)
		{
		$sel ="";
		if ($nThn==$gThn) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
</select></td>
      <td>&nbsp;</td>
      <td align="right"><input type="button" name="B36" value="LIST DATA" onclick="P_ListData()" style="width: 90px; height: 20px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td width="67">SUB UNIT</td>
      <td width="517"> 
        <select class="boxs" name="fSub" tabindex="0" style="width: 470px" onchange="this.form.submit()">
          <?
		if ($Lev <=3 ) {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";}
		else {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".".substr($SkP,12,2)."' ORDER BY Kd_Sub";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
			if (substr($gSub,0,11)!=$gUnt) {$gSub=$mRo['Kd_Sub'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Sub']==$gSub) 
				{
				$sel ="selected";
				$zSub=$mRo['Kd_Sub'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Sub'].'">'.$mRo['Kd_Sub']." : ".$mRo['Nm_Sub'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
      <td width="83">NOMOR</td>
      <td><input name="fNom" type="text" id="fNom" style="border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gNom?>" size="50" width="100px"/>	  </td>
      <td>&nbsp;</td>
      <td align="right"><input type="button" name="B362" value="RESET FORM" onclick="P_Change()" style="width: 90px; height: 20px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td width="67">UPB</td>
      <td width="517"> 
        <select class="boxs" name="fUpb" tabindex="0" style="width: 470px" onchange="this.form.submit()">
          <?
		$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUpb=="") {$gUpb = $mRo['Kd_Upb'];}
			if (substr($gUpb,0,14)!=$gSub) {$gUpb = $mRo['Kd_Upb'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Upb']==$gUpb) 
				{
				$sel ="selected";
				$zUpb=$mRo['Kd_Upb'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Upb'].'">'.$mRo['Kd_Upb']." : ".$mRo['Nm_Upb'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
      <td width="83">KETERANGAN</td>
      <td colspan="2"><input name="fKet" type="text" id="fKet" style="border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gKet?>" size="254" width="100px"/></td>
      <td align="right"><input type="button" name="B1" value="SIMPAN" onclick="P_Save('<?=$ReO?>')" style="width: 90px; height: 20px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
	
        <!-- Content -->
        <!-- Table -->
        <div class="table"> 
          
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <th width="37" align="left">No</th>
        <th width="86" align="left">Kode</th>
        <th width="57" align="left">Register</th>
        <th width="238" align="left">Nama Barang</th>
        <th width="76" align="left">Tgl.Perolehan</th>
        <th width="42">Kondisi</th>
        <th width="84" class="ar">Nilai</th>
        <th width="11">&nbsp;</th>
        <th width="269">Alasan</th>
        <th width="234">Keterangan</th>
        <th width="136" class="ac">Actions</th>
      </tr>
      <?
	  	$iG = 1;
		$gtNil=0;
		$nSQL= "SELECT * FROM ta_penghapusan_usulan_rinc WHERE Kd_UPB='".$zUpb."' AND Referensi LIKE '".$gRef."' ORDER BY Kd_Aset, No_Register";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			if ($mRo['Ref_Group']!="")
				{$RegGrp=$mRo['Ref_Group'];}
			else
				{$RegGrp="";}
			
			$NmB=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");
			?>
			  <tr style="cursor: pointer" onmouseover="this.style.cursor=&#39;pointer&#39" <?=fBackCLR($iG)?>> 
				<td valign="top"><? echo $iG++?>.</td>
				<td valign="top"><? echo $mRo['Kd_Aset']?></td>
				<td valign="top"><? echo $mRo['No_Register']?></td>
				<td valign="top"><? echo $NmB ?></td>
				<td valign="top" class="ac"><? echo fConvertDateShort($mRo['Tgl_Perolehan'])?></td>
				<td valign="top" class="ac"><? echo $mRo['Kondisi']?></td>
				<td valign="top" class="ar"><? echo fConvertToRupiah($mRo['Nilai'])?></td>
				<td valign="top">&nbsp;</td>
				<td valign="top"><? echo $mRo['Alasan']?></td>
				<td valign="top"><? echo $mRo['Keterangan']?></td>
				<td valign="top" align="center">
				<a href="#" class="ico del" onclick="P_RemoveR('<? echo $mRo['IDT']?>','<? echo $RegGrp?>','<?=$ReO?>'); return false">REMOVE</a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#" class="ico edit" onclick="EditData('700','400','center','<? echo $mRo['IDT']?>','<? echo $rIDT?>'); return false">EDIT</a></td>
			  </tr>
			  <?
			  $gtNil=$gtNil+$mRo['Nilai'];
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
      <?
		}
		?>
      <tr> 
        <td colspan="11" style="font-weight:bold; text-align:center"><hr size="0" /></td>
      </tr>
      <tr> 
        <td colspan="6" style="font-weight:bold; text-align:center">TOTAL</td>
        <td class="ar" style="font-weight:bold"><?=fConvertToRupiah($gtNil)?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="11">&nbsp;
		<a href="#" class="ico reff" onclick="P_Refresh()">&nbsp;&nbsp;REFRESH</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="#" class="ico docu" onclick="P_DOC('800','400','center'); return false">&nbsp;&nbsp;DOKUMEN</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="#" class="ico add" onclick="AddItem('950','520','center','<?=$ReO?>'); return false">&nbsp;&nbsp;ADD ITEM</a></td>
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
	
	function P_Save(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}
	
	function P_RemoveR(xA,xB,xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		if (xB!="")
			{window.alert("Access denied...!");}
		else
		{
			var AN = confirm("Remove item ..?!!");
			if (AN)
			{
			objfrm.CritIDT.value = xA;
			objfrm.Simpan.value = "RemoveRecord";
			objfrm.submit();
			}
		}
	}
	
	function P_ListData()
	{
		
		window.open('<?php echo "Usulan_Penghapusan_List.php?FrmG=".$_REQUEST['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_REQUEST['IdL'];?>','_self');
	}
	
	function P_Refresh()
	{
		
		window.open('<?php echo $_SERVER['PHP_SELF']."?rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_REQUEST['IdL'];?>','_self');
	}
	
	function P_Comming()
	{
		window.alert('Under construction...!!');
	}
	
	function P_DOC(w,h,pos)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		<?
		$URL="Usulan_Penghaspusan_Doc.php?rIDT=".$rIDT."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$_REQUEST['IdL'];
		?>
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open('<?php echo $URL?>','',settings);
	}
	
	function AddItem(w,h,pos,xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		<? if ($rIDT=="") {?>
		{window.alert('Data usulan belum disimpan..!!');}
		<? } else {?>
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
						<?
							$URL_Top = "Find_Item_Top.php?rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_REQUEST['IdL'];
							$URL_Mid = "Find_Item_Mid.php?rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_REQUEST['IdL'];
							$URL_Bot = "Find_Item_Bot.php";
						?>       			
					txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='35,*,30' frameborder='0'><frame name='WinFindItem_Top' noresize src='<? echo $URL_Top?>' scrolling='no'><frame name='WinFindItem_Mid' src='<? echo $URL_Mid?>' scrolling='auto'><frame name='WinFindItem_Bot' src= '<? echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
					win.focus()
					win.window.document.clear()
					win.window.document.write(txtHTML)
					win.window.document.close() 
					win.setTimeout("self.close()",200000000)
				}
		}
		<? } ?>
	}
	
	function EditData(w,h,pos,gIDT,rIDT)
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
				URL_Top = "Form_Edit_Usulan_Top.php?"+"<?="FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']?>";
				URL_Mid = "Form_Edit_Usulan_Mid.php?gIDT="+gIDT+"&rIDT="+rIDT+"<?="&IdL=".$_REQUEST['IdL']?>";
				URL_Bot = "Form_Edit_Usulan_Bot.php";
				txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+ URL_Top +"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>" 
				win.focus()
				win.window.document.clear()
				win.window.document.write(txtHTML)
				win.window.document.close() 
				win.setTimeout("self.close()",200000000)
			}
	}
</script>
<?php require "Connection_Close.php"?>

