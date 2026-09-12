<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
$SQL="CREATE TABLE `ta_upload_excel` (
  `IDT` int(11) NOT NULL AUTO_INCREMENT,
  `Kd_UPB` varchar(17) DEFAULT '',
  `KIB` varchar(1) DEFAULT '',
  `Tahun` varchar(4) DEFAULT '',
  `Nm_File` varchar(255) DEFAULT '',
  `Size` int(11) DEFAULT '0',
  `Imported` enum('Y','N') DEFAULT 'N',
  `Recorded` datetime DEFAULT '0000-00-00 00:00:00',
  `Pencatat` varchar(60) DEFAULT '',
  PRIMARY KEY (`IDT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC";
//$rs = mysql_query($SQL) or die(mysql_error());

if (isset($_GET['gUnt'])) {$gUnt= $_GET['gUnt'];} else {$gUnt = "";}
if (isset($_GET['gSub'])) {$gSub= $_GET['gSub'];} else {$gSub = "";}
if (isset($_GET['gUpb'])) {$gUpb= $_GET['gUpb'];} else {$gUpb = "";}
if (isset($_GET['gThn'])) {$gThn= $_GET['gThn'];} else {$gThn = "";}
if (isset($_GET['gKib'])) {$gKib= $_GET['gKib'];} else {$gKib = "";}

if (isset($_GET['gDEL']))
{
	$gIDT= $_GET['gIDT'];
	$gNmF= fGlobal("Nm_File","ta_upload_excel","IDT",$gIDT,"=","","");
	unlink("xls_file/kib_".strtolower($gKib)."_xls_file/".$gNmF);
	$SQ = "DELETE FROM ta_upload_excel WHERE IDT='".$gIDT."'";
	$rs = mysql_query($SQ) or die(mysql_error());
}
?>
<body>
<form name="myfrm" method="POST" action="<?php echo "Import_KIB_Mid.php?gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gKib=".$gKib."&IdL=".$_GET['IdL']?>">
<input type="hidden" name="fImport">
<?php if (isset($_GET['gUnt'])) {?>
  <table border="0" width="1050" cellspacing="0" bgcolor="#FFFFFF" style="font-size:10pt; font-family:calibri; border-collapse: collapse" id="table1">
    <tr> 
      <th width="25" class="al">NO</th>
      <th class="al">NAMA FILE</th>
      <th width="60" class="al">UKURAN</th>
      <th width="120" class="al">RECORDED</th>
      <th width="70" class="al">PENCATAT</th>
      <th width="150" class="al">STATUS</th>
      <th width="124" class="ac">ACTION</th>
    </tr>
    <?php
	$iG=1;
	$nSQ = "SELECT * FROM ta_upload_excel WHERE Kd_Upb = '".$gUpb."' AND Tahun='".$gThn."' AND KIB='".$gKib."' ORDER BY IDT";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$gNm = $mRo['Nm_File'];
			$gFD = 'xls_file/kib_'.strtolower($gKib).'_xls_file/'.$gNm;
			if (!file_exists($gFD)) 
			{
				$gCK="&nbsp;&nbsp;<i><font color='#FF0000'>Error : File is not exist...!!</font></i>";
				$gIM="None";
			}
			else
			{
				$gCK="";
				$gIM="";
			}
			if ($mRo['Imported']=="Y") {$gST="<i>Imported</i>";} else {$gST="";}
			$gURL = "Import_KIB_Source.php?gIDT=".$mRo['IDT']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gKib=".$gKib."&IdL=".$_GET['IdL'];
			?>
			<tr> 
			  <td style="border-top: 1px dotted #000000"><?php echo $iG?>.</td>
			  <td style="border-top: 1px dotted #000000"><?php echo substr($gNm,17,100).$gCK?></td>
			  <td style="border-top: 1px dotted #000000"><?php echo $mRo['Size']?></td>
			  <td style="border-top: 1px dotted #000000"><?php echo $mRo['Recorded']?></td>
			  <td style="border-top: 1px dotted #000000"><?php echo $mRo['Pencatat']?></td>
			  <td style="border-top: 1px dotted #000000"><?php echo $gST?>
			  </td>
			  <td class="ac" style="border-top: 1px dotted #000000"><a href="<?php echo $gURL?>" class="ico upl">&nbsp;Import</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="ico del" onClick="P_Delete('<?php echo $mRo['IDT']?>')">&nbsp;Delete</a></td>
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
      <td colspan="7">Filex tidak ditemukan...!!!</td>
    </tr>
    <?php } ?>
    <tr> 
      <td colspan="7" class="al" style="border-top: 1px solid #000000"><a href="#" class="ico add" onClick="WinUPLOAD('500','250','center'); return false">&nbsp;&nbsp;Add 
        File (*.xls)</a></td>
    </tr>
  </table>
<?php } ?>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function WinUPLOAD(w,h,pos)
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
			URL_Top = "Upload_Xls_Top.php?FrmG=UPLOAD FILE (*.XLS)"+"<?php echo "&IdL=".$_GET['IdL']?>";
			URL_Mid = "Upload_Xls_Mid.php?"+"<?php echo "gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gKib=".$gKib."&IdL=".$_GET['IdL']?>";
			URL_Bot = "Upload_Xls_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='40,*,30' frameborder='0'><frame name='WinUplXLS_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinUplXLS_Mid' src='"+URL_Mid+"'><frame name='WinUplXLS_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}

	function P_Delete(id)
	{
		var AN = confirm("Hapus file..?!!");
		if (AN)	
		{
			window.open("Import_KIB_Mid.php?gDEL=YA&gIDT="+id+"<?php echo "&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gKib=".$gKib."&IdL=".$_GET['IdL']?>","_self");
		}
	}
</script>
<?php require('Connection_Close.php');?>
