<?php 
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";

#echo $ReO;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
$rIDT = $_GET['rIDT'];
$rKib = $_GET['rKib'];
$KeY = "N";

$nSQ = "SELECT * FROM ta_kib_108 WHERE IDT='".$rIDT."'";
$nRs = mysql_query($nSQ) or die(mysql_error());
$mRo = mysql_fetch_assoc($nRs);
$tRo = mysql_num_rows($nRs);
if ($tRo > 0)
{
	$gREF  = $mRo['Referensi'];
	$gTmP  = $mRo['Ref_Temp'];
	$gKDB  = $mRo['Kd_Aset_108'];
	$gREG  = $mRo['No_Register'];
	$gUnt  = substr($mRo['Kd_UPB'],0,11);
	$gUpb  = $mRo['Kd_UPB'];
	
	#$SQE="UPDATE ta_kib_post_108 set Kd_UPB='".$gUpb."' WHERE Referensi='".$gREF."' AND Kd_UPB LIKE '".$gUnt."%' AND Kd_UPB <> '".$gUpb."'";
	#$eRs = mysql_query($SQE);
	
	if ($mRo['Nm_Aset']=="") {$gNMA = fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
	else {$gNMA = $mRo['Nm_Aset'];}
	$gHRG  = $mRo['Harga'];
	
	$gNIa = fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","referensi:kd_upb",$gREF.":".$gUpb,"=:=","","");
	$gNIb = fGlobal("IfNull(sum(kredit),0)","ta_kib_post_108","referensi:kd_upb",$gREF.":".$gUpb,"=:=","","");
	if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
	else {$gAKH=$gNIa;}
	
	$eUpB = $mRo['Kd_UPB'];
	
	$gUnt = substr($mRo['Kd_UPB'],0,11);
	$gThn = substr($mRo['Tgl_Perolehan'],0,4);
	$tKib = substr(strtoupper($rKib),-1,1);
	$KeY = CekKey($gUnt,$gThn,'Kib_'.$tKib,'');
	#$KeY = "N";
}
if ($UID=="creator"){$KeY = "N";}
if ($KeY=='Y') {$del="lock";} else {$del="del";}
?>

<body>
<form name="myfrm" method="post" action="<?="Form_Invent_Asset_Ubh_.php?IdL=".$_GET['IdL']."&rIDT=".$rIDT."&rREF=".$gREF."&rKib=".$rKib ?>">
<input type="hidden" name="Simpan">
<input type="hidden" name="CritIDT" size="10">
<table align="center" border="0" width="900" cellspacing="1" style="font-family: Calibri; font-size:9pt; border-collapse: collapse">
	
	<tr>
		<td width="98">REFERENSI</td>
	    <td width="119"><input name="fNama2" type="text" class="text" readonly value="<?=$gREF?>" style="width:100px; font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
		<td width="74">NILAI AWAL </td>
	  <td width="596"><input name="fNama222" type="text" class="text" readonly value="<?=fConvertToRupiah($gHRG)?>" style="width:110px; text-align: right; font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
	</tr>
	<tr>
	  <td>NOMOR REGISTER </td>
	  <td><input name="fNama22" type="text" class="text" readonly value="<?=$gREG?>" style="width:100px; font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
	  <td>NILAI AKHIR</td>
	  <td><input name="fNama223" type="text" class="text" readonly value="<?=fConvertToRupiah($gAKH)?>" style="width:110px; text-align: right; font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
	<tr>
		<td>NAMA BARANG </td>
		<td colspan="3"><input name="fNama23" type="text" class="text" readonly="readonly" value="<?=$gKDB?>" style="width:100px; font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
		<input name="fNama3" type="text" class="text" readonly value="<?=$gNMA?>" style="width:400px; font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
	</tr>
	<tr height="5">
		<td></td>
		<td></td>
		<td width="74"></td>
		<td width="596"></td>
	</tr>
	<tr>
		<td colspan="4">
	  <table width="100%" border="0" cellspacing="0" class="table-list" cellpadding="0" style="border-collapse:collapse; font-size: 9pt; font-family: Calibri">
		<tr> 
		  <th width="25" class="ac" style="color:#FFFFFF">No</th>
		  <th width="60" class="ac" style="color:#FFFFFF">Tanggal</th>
		  <th width="300" class="ac" style="color:#FFFFFF">Uraian</th>
		  <th width="90" class="ac" style="color:#FFFFFF">Nilai</th>
		  <th width="46" class="ac" style="color:#FFFFFF">Criteria</th>
		  <th class="ac" style="color:#FFFFFF">Actions</th>
		</tr>
		<?php
		$iG=1;
		#$nSQL= "SELECT * FROM ta_kib_post_108 WHERE Referensi='".$gREF."' AND Kd_UPB LIKE '".$gUnt."%' AND Ref_Temp = '".$gTmP."' ORDER BY Tanggal, Tanggal_BAST";
		#$nSQL= "SELECT * FROM ta_kib_post_108 WHERE Referensi='".$gREF."' AND Kd_UPB LIKE '".$gUnt."%' AND Kd_Aset_108='".$gKDB."' ORDER BY Tanggal, Tanggal_BAST";
		$nSQL= "SELECT * FROM ta_kib_post_108 WHERE Referensi='".$gREF."' AND Kd_UPB LIKE '".$gUpb."%' AND Kd_Aset_108='".$gKDB."' ORDER BY Tanggal, Tanggal_BAST, IDT";
		#echo $nSQL;
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			
			$CrT = "YA";
			if ($mRo['Crit']=="SLD") {
				#$CrT ="NO";
				$CrT = "YA";
			}
			
			$BV = "";
			$gCeU = $mRo['Ref_Mutasi'];
			$gAsL = fGlobal("perolehan","ref_perolehan","IDT",$mRo['IdAsalUsul'],"=","","");
			
			$TBa = CekRefToNmTbl($mRo['Referensi']);
			if ($gCeU!=""){
				$TB = CekRefToNmTbl($gCeU);
				#$SG = fGlobal("Kd_UPB","ta_kib_".$TB."_mutasi".$tMuTZ,"Referensi:Kd_UPB_To",$gCeU.":".substr($mRo['Kd_UPB'],0,11)."%","=:LIKE","","");
				#$AS = fGlobal("Kd_Aset_To","ta_kib_".$TB."_mutasi".$tMuTZ,"Referensi:Kd_UPB_To",$gCeU.":".substr($mRo['Kd_UPB'],0,11)."%","=:LIKE","","");
				
				$SG = fGlobal("Kd_UPB","ta_kib_108_mutasi".$tMuTZ,"Referensi:Kd_UPB_To",$gCeU.":".substr($mRo['Kd_UPB'],0,11)."%","=:LIKE","","");
				$AS = fGlobal("Kd_Aset_108_To","ta_kib_108_mutasi".$tMuTZ,"Referensi:Kd_UPB_To",$gCeU.":".substr($mRo['Kd_UPB'],0,11)."%","=:LIKE","","");
				
				$SG = "<i>".fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($SG,0,11),"=","","")."</i>";
				$BV = "<font style='background:#000000; color:#fff'>Mutasi masuk dari ".strtolower($SG)."<br>Ref : ".$mRo['Ref_Mutasi']."<br>Usulan : ".$mRo['Ref_Usulan']."</font><br>";
				if ($AS!=$gKDB){
					$BV.= "<font style='color:#ff0000'>Kode Aset : ".strtolower($AS)."</font><br>";
				}
				if ($mRo['Tgl_Mutasi']=="0000-00-00"){
					$BV.= "<font style='color:#ff0000'>Tgl Mutasi : 0000-00-00</font><br>";
				}
			}
			
			if ($mRo['HasilMerger']=="Y" && $TBa!='g') {
				$CrT ="NO";
				if ($UID=='creator'){$CrT ="YA";}
				
				$gCeM = $mRo['Mrg_Ref_History'];
				
				if (substr($gCeM,0,3)=="TNH" || substr($gCeM,0,3)=="BNG" || substr($gCeM,0,3)=="JLN")
				{
					$eIdT = fGlobal("IDT","ta_kib_108_merger_his","Referensi",$gCeM,"=","","");
					if ($eIdT){
						if ($eUpB!=""){
							#$SQE="UPDATE ta_kib_108_merger_his set Kd_UPB='".$eUpB."' WHERE IDT='".$eIdT."'";
							#$eRs = mysql_query($SQE);
						}
					}
				}
			}
			?>
            <tr height="20" style="cursor: pointer" <?=fBackCLR($iG)?>> 
              <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; text-align:center"><?=$iG?>.</td>
              <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; text-align:center"><?=fConvertDateShort($mRo['Tanggal'])?></td>
              <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; padding-left:3px <?=$fCl?>"><?=$BV.$mRo['Uraian']?><?php if ($mRo['Keterangan']!='') {echo "<br><i>".$mRo['Keterangan']."</i>";}?><?php if ($mRo['No_Pengadaan']!="" && $mRo['No_Pengadaan']!="-") {echo "<br>No. Pengadaan: ".$mRo['No_Pengadaan']."<br>";}?><?php if ($mRo['HasilMerger']=="Y") {echo "<br>".$mRo['Mrg_Ref_History'];}?><?php if ($gAsL!='') {echo "<br>Asal-usul : ".$gAsL;}?></td>
              <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; text-align:right; padding-right:3px"><?php if ($mRo['Debet']!=0) {echo fConvertToRupiah($mRo['Debet']);} else {echo "-";}?></td>
              <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; text-align:center"><?=$mRo['Crit']?></td>
              <td valign="top" style="border-bottom:1px dotted #ccc; padding-left:15px">
			  
			  <a href="#" class="ico <?=$del?>" onclick="P_DeleteR('<?=$ReO?>','<?=$KeY?>','<?=$mRo['IDT']?>','<?=$CrT?>'); return false;">&nbsp;Delete</a>&nbsp;&nbsp;
			  <a href="#" class="ico edit" onclick="EditData('<?=$ReO?>','','850','450','<?=$mRo['IDT']?>','<?=$gREF?>','<?=$rKib?>','<?=$gUnt?>'); return false;">Edit</a>&nbsp;&nbsp;
			  <!--a href="#" class="ico stat" onclick="EditTGR('<?=$ReO?>','','850','450','<?=$mRo['IDT']?>','<?=$gREF?>','<?=$rKib?>','<?=$gUnt?>'); return false;">&nbsp;TGR</a>&nbsp;&nbsp;-->
			  <?php
				if ($mRo['HasilMerger']=="Y" && $TBa!='g') {
					?>
						<a href="#" class="ico merg" onclick="P_RestoreR('<?=$ReO?>','<?=$UID?>','<?=$KeY?>','<?=$mRo['IDT']?>'); return false;">Restore</a>&nbsp;&nbsp;
						<a href="#" class="ico merg" onclick="P_Kapitalisasi('<?=$ReO?>','<?=$UID?>','<?=$KeY?>','<?=$mRo['IDT']?>'); return false;">Kapitalisasi</a>
					<?php
				 }
			  ?>			  </td>
            </tr>
            <?php
			  $iG++;
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		else
		{
		?>
            <tr> 
              <td></td>
              <td colspan="4">Data tidak ditemukan..!!</td>
              <td>&nbsp;</td>
            </tr>
            <?php
		}
		?>
            <tr height="30"> 
              <td colspan="6" class="ac" style="border-top:1px solid #ccc"> [&nbsp;&nbsp;<a href="<?="Form_Invent_Asset_Ubh.php?IdL=".$_GET['IdL']."&rIDT=".$rIDT."&rKib=".$rKib ?>" class="ico reff">REFRESH</a>&nbsp;&nbsp;]&nbsp;&nbsp;
			  [&nbsp;&nbsp;<a href="#" class="ico edit" onclick="AddData('<?=$ReO?>','<?=$KeY?>','850','450','center'); return false;">TAMBAH BARU</a>&nbsp;&nbsp;] </td>
            </tr>
          </table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td width="74">&nbsp;</td>
		<td width="596">&nbsp;</td>
	</tr>
</table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function AddData(ReO,KeY,w,h,pos)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (KeY=='Y') {alert('Access denied, data sudah terkunci..!!'); return false;}
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
					<?php
						$URL_Top = "Form_Invent_Asset_Ubh_Top.php?FrmG=".$_GET['FrmG'];
						$URL_Mid = "Form_Invent_Asset_Ubh_Mid.php?gUnt=".$gUnt."&rRef=".$gREF."&IdL=".$_GET['IdL']."&rKib=".$rKib;
						$URL_Bot = "Form_Invent_Asset_Ubh_Bot.php";
					?>       			
				txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormUBH_Top' noresize src='<?=$URL_Top?>' scrolling='no'><frame name='WinFormUBH_Mid' src='<?=$URL_Mid?>' scrolling='auto'><frame name='WinFormUBH_Bot' src= '<?=$URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
				win.focus()
				win.window.document.clear()
				win.window.document.write(txtHTML)
				win.window.document.close() 
				win.setTimeout("self.close()",200000000)
			}
	}

	function P_DeleteR(ReO,KeY,xA,xB)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (KeY=='Y') {alert('Access denied, data sudah terkunci..!!'); return false;}
		if (xB=="NO")
			{window.alert("Access denied ...!");}
		else
		{
			var AN = confirm("Delete data..?!!");
			if (AN)
			{
			objfrm.CritIDT.value = xA;
			objfrm.Simpan.value = "DeleteRecord";
			objfrm.submit();
			}
		}
	}

	function P_RestoreR(ReO,uid,KeY,xA)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (KeY=='Y') {alert('Access denied, data sudah terkunci..!!'); return false;}
		var AN = confirm("Proses ini akan mengembalikan data keposisi semula saat \nsebelum dimerger, lanjutkan proses..?!!");
		if (AN)
		{
			objfrm.CritIDT.value = xA;
			objfrm.Simpan.value = "RestoreRecord";
			objfrm.submit();
		}
	}

	function P_Kapitalisasi(ReO,uid,KeY,xA)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		var AN = confirm("Proses ini akan menghilangkan data histori merger dan tidak bisa direstore kembali, lanjutkan proses..?!!");
		if (AN)
		{
			objfrm.CritIDT.value = xA;
			objfrm.Simpan.value = "Kapitalisasi";
			objfrm.submit();
		}
	}

	function EditData(ReO,KeY,w,h,IDT,gREF,rKib,gUnt)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (KeY=='Y') {alert('Access denied, data sudah terkunci..!!'); return false;}
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
					URL_Top = 'Form_Invent_Asset_Ubh_Top.php?'+'<?="FrmG=".$_GET['FrmG']?>';
					URL_Mid = 'Form_Invent_Asset_Ubh_Mid.php?rIDT='+IDT+'&rRef='+gREF+'&rKib='+rKib+'&gUnt='+gUnt+'<?="&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>';
					URL_Bot = 'Form_Invent_Asset_Ubh_Bot.php';
				txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
				win.focus()
				win.window.document.clear()
				win.window.document.write(txtHTML)
				win.window.document.close() 
				win.setTimeout("self.close()",200000000)
			}
	}
</script>

<?php require('Connection_Close.php');?>
