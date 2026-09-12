<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
</head>
</head>
<?php
$zKeg = $_GET['zKeg'];
$zUpb = $_GET['zUpb'];
$zThn = $_GET['zThn'];
$JusV = $_GET['JusV'];
?>
<body>
<?php if ($JusV=="0") { ?>
<form name="myfrm" method="post" action="<?php echo "RKPBMD_Mid_.php?JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'] ?>">
<input type="hidden" name="Simpan">
<input type="hidden" name="FormCr">
<table border="0" width="1220" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
	<?php
	$JmlRc = fGlobal("COUNT(*)","ta_rkpbmd","Kd_UPB:Kd_Kegiatan:Tahun",$zUpb.":".$zKeg.":".$zThn,"=:=:=","","");
	if ($JmlRc==0)
	{
		$DibB = "disabled";
	}
	else
	{
		$DibB = "";
	}
	?>
	<?php
	$rtJml=0;
	$nSQL= "SELECT * FROM ta_rkpbmd WHERE Kd_UPB='".$zUpb."' AND Kd_Kegiatan = '".$zKeg."' AND Tahun = '".$zThn."' ORDER BY IDO";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
	$iG=1;
	do
		{
			$IDO  = $mRo['IDO'];
			$zRef = $mRo['Referensi'];
			$gKd  = $mRo['Kd_Aset'];
			$rView1 = $mRo['Kd_Aset'];
			$rView2 = "";
			$rView5 = "";
			$rView6 = "";
			$rView7 = "";
			$rView8 = "";
			if ($gKd!="")
			{
				if (substr($gKd,0,2)=="01") {$dKib   = "ta_kib_a";}
				if (substr($gKd,0,2)=="02") {$dKib   = "ta_kib_b";}
				if (substr($gKd,0,2)=="03") {$dKib   = "ta_kib_c";}
				if (substr($gKd,0,2)=="04") {$dKib   = "ta_kib_d";}
				if (substr($gKd,0,2)=="05") {$dKib   = "ta_kib_e";}
				$gRef   = $mRo['Ref_Kib'];
				$rDT = fGlobal("No_Register:Kondisi:Tgl_Perolehan:Kd_Pemilik:Keterangan",$dKib,"Referensi:Kd_UPB",$gRef.":".substr($zUpb,0,11)."%","=:LIKE","","");
				if ($rDT){
					$rDT = explode(":",$rDT);
					$rView2 = $rDT[0];
					$rView5 = $rDT[4];
					$rView6 = substr($rDT[2],0,4);
					$rView7 = $rDT[3];
					$rView8 = $rDT[1];
				}
			}
			$rView3 = $mRo['Nm_Aset'];
			$rView9 = $mRo['Nilai'];
			?>
			<script Language="javascript">
			function P_Ass<?php echo $IDO?>(w,h,xR)
			{
				if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
				var win=null;
				var txtHTML = "";
				var iErrors=0;
				LeftPosition = (screen.width-w)/2;
				TopPosition	 = (screen.height-h)/2;
				settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=yes,menubar=no,toolbar=no,resizable=yes';
				win=window.open('','',settings);
				if (win!=null)
				{
				win.window.document.open()
				<?php
					$URL_Top = "Find_AssRKPB_Top.php?IDO=".$IDO."&JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
					$URL_Mid = "Find_AssRKPB_Mid.php?IDO=".$IDO."&JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
					$URL_Bot = "Find_AssRKPB_Bot.php";
				?>       			
				txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title><meta name='GENERATOR' content='Microsoft FrontPage 5.0'><meta name='ProgId' content='FrontPage.Editor.Document'></head><frameset framespacing='0' border='0' rows='55,*,25' frameborder='0'><frame name='FormRKPBTop' target='FormRKPBMid' noresize scrolling='no' src='<?php echo $URL_Top?>'><frame name='FormRKPBMid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='FormRKPBBot' src='<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>This page uses frames, but your browser doesn't support them.</p></body></noframes></frameset></html>"            
				win.focus()
				win.window.document.clear()
				win.window.document.write(txtHTML)
				win.window.document.close() 
				win.setTimeout("self.close()",200000000)
				}
			}
			</script>
			<tr>
				<td bgcolor="#CCCCCC"><input type="text" name="fNomo" value="<?php echo $iG?>." style="width:30px; text-align:center; font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background: #C0C0C0" /></td>
			  <td width="92"><input type="text" name="fView1" value="<?php echo $rView1?>" readonly onclick="P_Ass<?php echo $IDO?>('900','500'); return false" style="width:90px; font-family: Arial; color:#000; font-size: 9pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background: #99CC00" /></td>
				<td width="48"><input type="text" name="fView2" value="<?php echo $rView2?>" readonly="readonly" style="width:48px; font-family: calibri; color:#000; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background:#99CC00" /></td>
				<td><input type="text" name="fView3" value="<?php echo $rView3?>" readonly style="width:350px; font-family: calibri; color:#000; font-size: 9pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background: #99CC00" /></td>
				<td><input type="text" name="fView5" value="<?php echo $rView5?>" readonly="readonly" style="width:230px; font-family: calibri; color:#000; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background: #99CC00" /></td>
				<td><input type="text" name="fView6" size="4" value="<?php echo $rView6?>" readonly="readonly" style="font-family: calibri; color:#000; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background: #99CC00" /></td>
				<td><input type="text" name="fView7" size="15" value="<?php echo $rView7?>" readonly="readonly" style="font-family: calibri; color:#000; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background: #99CC00" /></td>
				<td><input type="text" name="fView8" size="13" value="<?php echo $rView8?>" readonly="readonly" style="font-family: calibri; color:#000; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background: #99CC00" /></td>
				<td><input type="text" name="fView9" value="<?php echo fConvertToRupiah($rView9)?>" readonly style=" width:130px; font-family: calibri; color:#000; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background: #99CC00; text-align: right" /></td>
			  <td width="22"><input type="button" name="B352" value="...." onclick="P_Ass<?=$IDO?>('900','500','<?=$ReO?>'); return false" style="width: 20px; height: 19px; border: 1px solid #99CC00; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
			  <td width="20"><input type="checkbox" name="CheckB<?php echo $IDO?>" value="ON" /></td>
			</tr>
			<tr>
			  <td height="3" bgcolor="#CCCCCC"></td>
			  <td colspan="8"></td>
			  <td></td>
			  <td></td>
		    </tr>
			<tr>
			  <td bgcolor="#CCCCCC">&nbsp;</td>
			  <td colspan="8" style="border: 1px solid #99CC00">
				<table border="0" width="100%" cellspacing="1" cellpadding="0" style="font-family: Arial; font-size: 8pt; border-collapse: collapse">
					<tr style="font-weight:bold">
					  <td width="72">Rekening</td>
					  <td width="26">&nbsp;</td>
					  <td width="180">Rincian Belanja</td>
					  <td>Uraian Pemeliharaan</td>
					  <td>Lokasi</td>
					  <td align="center">Qty</td>
					  <td>Satuan</td>
					  <td align="right">Harga</td>
					  <td align="right">Jumlah</td>
					  <td>&nbsp;</td>
					</tr>
					<?php
					$tJml=0;
					$rnSQL= "SELECT * FROM ta_rkpbmd_rinci WHERE Referensi='".$zRef."' ORDER BY IDO";
					$rnRs = mysql_query($rnSQL) or die(mysql_error());
					$rmRo = mysql_fetch_assoc($rnRs);
					$rtRo = mysql_num_rows($rnRs);
					if ($rtRo > 0)
					{
					do
						{
							$rIDO = $rmRo['IDO'];
							$rCod = $rmRo['Rekening'];
							$rNma = $rmRo['Nm_Rekening'];
							$rDes = $rmRo['Deskripsi'];
							$rLok = $rmRo['Lokasi'];
							$rQty = $rmRo['Qty'];
							$rSat = $rmRo['Satuan'];
							$rHrg = $rmRo['Harga'];
							$rJml = $rmRo['Jumlah'];
							$tJml = $tJml + $rJml;
							?>
							<script Language="javascript">
							function P_Acc<?php echo $IDO.$rIDO?>(w,h,xR)
							{
								if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
								var win=null;
								var txtHTML = "";
								var iErrors=0;
								LeftPosition = (screen.width-w)/2;
								TopPosition	 = (screen.height-h)/2;
								settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=yes,menubar=no,toolbar=no,resizable=yes';
								win=window.open('','',settings);
								if (win!=null)
								{
									win.window.document.open()
									<?php
										$rURL_Top = "Find_AccRKPB_Top.php?IDO=".$rIDO."&JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
										$rURL_Mid = "Find_AccRKPB_Mid.php?IDO=".$rIDO."&JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
										$rURL_Bot = "Find_AccRKPB_Bot.php";
									?>       			
									txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title><meta name='GENERATOR' content='Microsoft FrontPage 5.0'><meta name='ProgId' content='FrontPage.Editor.Document'></head><frameset framespacing='0' border='0' rows='35,*,25' frameborder='0'><frame name='FormRKPBrTop' target='FormRKPBrMid' noresize scrolling='no' src='<?php echo $rURL_Top?>'><frame name='FormRKPBrMid' src='<?php echo $rURL_Mid?>' scrolling='auto'><frame name='FormRKPBrBot' src='<?php echo $rURL_Bot?>' scrolling='no'><noframes><body><p>This page uses frames, but your browser doesn't support them.</p></body></noframes></frameset></html>"            
									win.focus()
									win.window.document.clear()
									win.window.document.write(txtHTML)
									win.window.document.close() 
									win.setTimeout("self.close()",200000000)
								}
							}
							</script>
							<tr>
							   <td><input type="text" name="fKode" size="8" value="<?php echo $rCod?>" readonly="readonly" onclick="P_Acc<?php echo $IDO.$rIDO?>('600','500','<?=$ReO?>'); return false" style="font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
								<td><input type="button" name="B3525" value="...." onclick="P_Acc<?php echo $IDO.$rIDO?>('600','500','<?=$ReO?>'); return false" style="width: 20px; height: 19px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
								<td><input type="text" name="fNama<?php echo $rIDO?>" size="33" value="<?php echo $rNma?>" readonly="readonly" style="font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986; color:#000" /></td>
								<td><input type="text" name="fDesk<?php echo $rIDO?>" size="25" value="<?php echo $rDes?>" style="font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color:#000" /></td>
							    <td><input type="text" name="fLoka<?php echo $rIDO?>" size="20" value="<?php echo $rLok?>" style="font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color:#000" /></td>
								<td><input type="text" name="fQuan<?php echo $rIDO?>" size="5"  value="<?php echo $rQty?>" onBlur="NumValidate(this)" style="font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color:#000; text-align:center" /></td>
								<td><input type="text" name="fSatu<?php echo $rIDO?>" size="10" value="<?php echo $rSat?>" style="font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color:#000; text-align: center" /></td>
								<td><input type="text" name="fHarg<?php echo $rIDO?>" size="17" value="<?php echo fConvertToRupiah($rHrg)?>" onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style="font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color:#000; text-align: right" /></td>
								<td><input type="text" name="fJuml<?php echo $rIDO?>" size="17" value="<?php echo fConvertToRupiah($rJml)?>" readonly="readonly" style="font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986; text-align: right" /></td>
								<td><input type="checkbox" name="CheckD<?php echo $rIDO?>" value="ON" /></td>
							</tr>
							<?php
							}
							while ($rmRo = mysql_fetch_assoc($rnRs));	
						}
					?>
					
					<tr>
					  <td colspan="3">
						<input type="button" name="B35252" value="Save" onclick="P_SaveAccR('<?php echo $zRef?>','<?=$ReO?>')" style="width: 50px; height: 19px; border: 1px solid #C0C0C0C; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
						<input type="button" name="B35253" value="Add Item" onclick="P_AddAccR('<?php echo $zRef?>','<?=$ReO?>')" style="width: 50px; height: 19px; border: 1px solid #C0C0C0C; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
						<input type="button" name="B352522" value="Delete" onclick="P_DeleteR('<?php echo $zRef?>','<?=$ReO?>')" style="width: 50px; height: 19px; border: 1px solid #C0C0C0C; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
						<td width="124">&nbsp;</td>
						<td width="105">&nbsp;</td>
						<td width="105">&nbsp;</td>
						<td width="82">&nbsp;</td>
						<td width="97">SUB TOTAL </td>
						<td><input type="text" name="fJuml<?php echo $rIDO?>2" size="17" value="<?php echo fConvertToRupiah($tJml)?>" readonly="readonly" style="font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #999966; text-align: right" /></td>
						<td width="33">&nbsp;</td>
					</tr>
			  </table>			  </td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td height="5" bgcolor="#CCCCCC"></td>
			  <td colspan="8"></td>
			  <td></td>
			  <td></td>
		    </tr>
			<?php
			$iG++;
			$rtJml= $rtJml + $tJml;
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	?>
    <tr>
		<td width="32">&nbsp;</td>
		<td colspan="2">&nbsp;</td>
		<td width="254">&nbsp;</td>
		<td width="212">&nbsp;</td>
		<td width="150">&nbsp;</td>
		<td width="60">&nbsp;</td>
		<td width="115">&nbsp;</td>
		<td width="143">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
	  <td height="10" colspan="11"><hr color="#C0C0C0" size="1" /></td>
    </tr>
	<tr>
	  <td height="27" colspan="11">
	  <table border="0" width="100%" cellpadding="0" style="font-family: Arial; font-size: 8pt; border-collapse: collapse">
	<tr>
		<td width="630">
	    <input type="button" name="B3522" value="SIMPAN" <?php echo $DibB?> onclick="P_Save('<?=$ReO?>')" style="width: 80px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	    <input type="button" name="B3523" value="TAMBAH ITEM" onclick="P_Add('<?=$ReO?>')" style="width: 80px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	    <input type="button" name="B3524" value="HAPUS ITEM" <?php echo $DibB?> onclick="P_Del('<?=$ReO?>')" style="width: 80px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />		</td>
		<td width="260">TOTAL RENCANA KEBUTUHAN PEMELIHARAAN </td>
		<td width="316"><input type="text" name="fJuml<?php echo $rIDO?>22" size="22" value="<?php echo fConvertToRupiah($rtJml)?>" readonly="readonly" style="font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #999966; text-align: right" /></td>
	</tr>
	</table>	  </td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td colspan="2">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td colspan="2">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
</table>
</form>
<?php } ?>
</body>
</html>
<script language="JavaScript">
	var objfrm=document.myfrm;
	function P_Save(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.FormCr.value = "";
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}	
	
	function P_Add(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.Simpan.value = "Add";
		objfrm.submit();
	}	
	
	function P_Del(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		var AN = confirm("Hapus baris data yang ditandai..?!!");
		if (AN)	
		{
		objfrm.Simpan.value = "Del";
		objfrm.submit();
		}
	}	

	function P_AddAccR(nRe,xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.FormCr.value = nRe;
		objfrm.Simpan.value = "Add";
		objfrm.submit();
	}	

	function P_SaveAccR(nRe,xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.FormCr.value = nRe;
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}	

	function P_DeleteR(nRe,xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		var AN = confirm("Hapus data rincian yang ditandai..?!!");
		if (AN)	
		{
		objfrm.FormCr.value = nRe;
		objfrm.Simpan.value='Del';
		objfrm.submit();
	 	}
	}
	
	function P_CkAll()
	{
		<?php
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			do
				{
					$IDO = $mRo['IDO'];
					?>
					if (objfrm.CheckAll.checked==false)
						{objfrm.CheckB<?php echo $IDO ?>.checked=false;}
					else
						{objfrm.CheckB<?php echo $IDO ?>.checked=true;}
					
					<?php
				}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		?>
	}
</script>
<?php require "FileFormatNum.php"?>
<?php require('Connection_Close.php');?>