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

<body>
<?php require "FileMenu.php"?>
<table border="0" cellpadding="0" style="border-collapse: collapse; width:1200px">
	<tr>
		<td width="60">NO</td>
		<td width="118">REFERENSI</td>
		<td width="101">KODE</td>
		<td width="54">REG.</td>
		<td>NAMA</td>
		<td width="120" align="right">HARGA</td>
		<td width="120" align="right">NILAI AKHIR</td>
		<td width="120" align="right">POSTING</td>
	</tr>
	<?php
	$iG=1;
	$nSQL= "SELECT * FROM Ta_Kib_A where Post='N' order by IDT limit 0,2000";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$Post = $mRo['Harga'];
			$RefR = $mRo['Referensi'];
			$RefG = $mRo['Ref_Group'];
			$gUPB = $mRo['Kd_UPB'];
			$gAss = $mRo['Kd_Aset'];
			$gReG = $mRo['No_Register'];
			$gTGL = $mRo['Tgl_Perolehan'];
			
			$gNoM = $mRo['No_Pengadaan'];
			$gTeM = $mRo['Ref_Temp'];
			
			$gKET = mysql_real_escape_string($mRo['Ketarangan']);
			
			$eINS = fGlobal("IDT","Ta_Kib_Post","Referensi",$RefR,"=","","");
			if ($eINS == "")
			{
				//INSERT
				$SQ = "insert into Ta_Kib_Post set 
				Referensi='$RefR',
				Ref_Group='$RefG',
				Kd_UPB='$gUPB',
				Kd_Aset='$gAss',
				No_Register='$gReG',
				No_Pengadaan='$gNoM',
				Ref_Temp='$gTeM',
				Crit='SLD',
				Tanggal='$gTGL',
				Debet='$Post',
				Kredit='0',
				Keterangan='$gKET'";
				$rs = mysql_query($SQ) or die(mysql_error());		
			}
			else{
				//UPDATE 
				$SQ = "update Ta_Kib_Post set 
				Debet='$Post',
				Kredit='0' WHERE IDT='$eINS'";
				$rs = mysql_query($SQ) or die(mysql_error());		
			}
			//UPDATE
			$SQ = "update Ta_Kib_A set Post='Y' where IDT='".$mRo['IDT']."'";
			$rs = mysql_query($SQ) or die(mysql_error());		
			?>
			<tr>
				<td width="42"><?php echo $iG?>.</td>
				<td width="118"><?php echo $mRo['Referensi']?></td>
				<td width="101"><?php echo $mRo['Kd_Aset']?></td>
				<td width="54"><?php echo $mRo['No_Register']?></td>
				<td width="347"><?php echo $mRo['Nm_Aset']?></td>
				<td width="109" align="right"><?php echo fConvertToRupiah($mRo['Harga'])?></td>
				<td align="right"><?php echo fConvertToRupiah($mRo['Harga'])?></td>
				<td width="110" align="right"><?php echo fConvertToRupiah($Post)?></td>
			</tr>
			<?php
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));	
	}
	?>
	<tr>
		<td width="42">&nbsp;</td>
		<td width="118">&nbsp;</td>
		<td width="101">&nbsp;</td>
		<td width="54">&nbsp;</td>
		<td width="347">&nbsp;</td>
		<td width="109">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="110">&nbsp;</td>
	</tr>
</table></body>
</html>

<?php require('Connection_Close.php');?>
