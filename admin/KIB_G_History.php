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
</head>
<?php
$rIDT = $_REQUEST['rIDT'];
$rRef = fGlobal("Referensi","Ta_Kib_108","IDT",$rIDT,"=","","");
?>
<body>
<table border="0" width="750" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
		<tr>
			<td width="23"><img src="css/images/hara.gif" width="12" height="11" /></td>
			<td width="637">PERUBAHAN NILAI</td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
				<tr bgcolor="#FF0033" style="color:#FFFFFF">
					<td width="11%">TANGGAL</td>
					<td width="38%">URAIAN</td>
					<td width="15%" align="right">DEBET</td>
					<td width="14%" align="right">KREDIT</td>
				    <td width="2%" align="right">&nbsp;</td>
				    <td width="20%">KETERANGAN</td>
			    </tr>
				<?php
				$SQL = "SELECT * FROM ta_kib_post_108 where Referensi='".$rRef."' ORDER BY Tanggal";
				$nRs = mysql_query($SQL) or die(mysql_error());
				$mRo = mysql_fetch_assoc($nRs);
				$mRw = mysql_num_rows($nRs);
				if ($mRw > 0)
				{
					do
					{
						if ($mRo['Crit']=="SLD")
						{$gMem = "Nilai Perolehan";}
						else
						{$gMem = $mRo['Uraian'];}
						
						$rDB = $mRo['Debet'];
						$rKR = $mRo['Kredit'];
						if ($mRo['DK']=="D")
						{
							$nDB = $rDB;
							$nKR = 0;
						}
						else
						{
							$nDB = 0;
							$nKR = $rKR;
						}
						?>
						<tr>
							<td valign="top"><?php echo fConvertDateShort($mRo['Tanggal'])?></td>
							<td valign="top"><?php echo $gMem?></td>
							<td valign="top" align="right"><?php if ($nDB!=0) {echo fConvertToRupiah($nDB);}?></td>
							<td valign="top" align="right"><?php if ($nKR!=0) {echo fConvertToRupiah($nKR);}?></td>
						    <td valign="top" align="right">&nbsp;</td>
						    <td valign="top"><?php echo $mRo['Keterangan']?></td>
					    </tr>
						<?php
					}
					while ($mRo = mysql_fetch_assoc($nRs));
				}
				
				?>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
			    </tr>
			</table>		  </td>
  		</tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>-</td>
  </tr>
		<tr>
			<td width="23">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
  </tr>
	</table>
</body>
</html>

<?php require('Connection_Close.php');?>
