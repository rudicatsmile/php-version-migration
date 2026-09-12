<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_mid.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?
$IDO  = $_GET['IDO'];
$zUpb = $_GET['zUpb'];
$zKeg = $_GET['zKeg'];
$zThn = $_GET['zThn'];
$gFin  = $_POST['fFind'];
$TakeOff = $_GET['TakeOff'];

$dKib = $_POST['radiobutton'];
if ($_GET['dKib']!="") {$dKib=$_GET['dKib'];}
if ($dKib=="") {$dKib="ta_kib_a";}

#echo $dKib;
if ($TakeOff=="Ya")
{
	$gIdT = $_GET['gIdT'];
	$gKd  = $_GET['gKd'];
	
	$gNm  = fGlobal("Nm_Aset",$dKib,"IDT",$gIdT,"=","","");
	$gRef = fGlobal("Referensi",$dKib,"IDT",$gIdT,"=","","");
	$gDeb = fGlobal("IfNull(sum(Debet),0)","Ta_Kib_Post","Referensi:Kd_Upb",$gRef.":".$zUpb,"=:=","","");
	$gKre = fGlobal("IfNull(sum(Kredit),0)","Ta_Kib_Post","Referensi:Kd_Upb",$gRef.":".$zUpb,"=:=","","");
	$gNil = $gDeb-$gKre;
	if ($gNm=="") {$gNm=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$gKd,"=","","");}
	
	$SQL  = "update ta_rkpbmd set Kd_Aset='".$gKd."', Ref_Kib='".$gRef."', Nm_Aset='".$gNm."', Nilai='".$gNil."' WHERE IDO='".$IDO."'";
	$rst  = mysql_query($SQL) or die(mysql_error());
	
	$URLK = "RKPBMD_Mid.php?JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
	?>
	<script language="JavaScript">  	
	this.window.open ('<?=$URLK ?>','WinOpenRKPB_Mid')
	this.window.focus()
	this.window.document.clear()
	this.window.document.close() 
	this.setTimeout("self.close()",1)
	</script>
	<?
}
?>

<body>
  <div class="table">
  <table width="900" border="0" align="center">
    <?
	if ($gFin=="") {$gLimit=" LIMIT 0,100";} else {$gLimit="";}
	$iG=1;
	$nSQL= "SELECT * FROM ".$dKib." where Kd_Upb='".$zUpb."' AND (Kd_Aset LIKE '%".$gFin."%' OR Nm_Aset LIKE '%".$gFin."%') ORDER BY Kd_Aset, Nm_Aset".$gLimit;
	$nSQL= "SELECT P1.* FROM ".$dKib." P1, ref_rek_aset5 P2 
	where P2.Kd_Aset=P1.Kd_Aset and P1.Kd_Upb='".$zUpb."' AND (P1.Kd_Aset LIKE '%".$gFin."%' OR P1.Nm_Aset LIKE '%".$gFin."%' OR P2.Nm_Aset LIKE '%".$gFin."%') 
	ORDER BY Kd_Aset, Nm_Aset".$gLimit;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$gIdT = $mRo['IDT'];
			$gKd  = $mRo['Kd_Aset'];
			$gReg = $mRo['No_Register'];
			$gRef = $mRo['Referensi'];
			$NmAss= $mRo['Nm_Aset'];
			$gOlh = substr($mRo['Tgl_Perolehan'],0,4);
			if ($dKib=="ta_kib_a")
			{$gRin = $mRo['Alamat'];}
			else if ($dKib=="ta_kib_b")
			{$gRin = "Merk: ".$mRo['Merk'].", Tipe: ".$mRo['Type'];}
			else if ($dKib=="ta_kib_c")
			{$gRin = "Lokasi: ".$mRo['Lokasi'].", Luas Lantai: ".fConvertToRupiah($mRo['Luas_Lantai'])." m<sup>2</sup>";}
			else {$gRin = "";}
			
			if ($NmAss=="") {$NmAss = fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$gKd,"=","","");}
			
			$gDeb = fGlobal("IfNull(sum(Debet),0)","Ta_Kib_Post","Referensi:Kd_Upb",$gRef.":".$zUpb,"=:=","","");
			$gKre = fGlobal("IfNull(sum(Kredit),0)","Ta_Kib_Post","Referensi:Kd_Upb",$gRef.":".$zUpb,"=:=","","");
			$gNil = $gDeb-$gKre;
	
			$URL = "Find_AssRKPB_Mid.php?TakeOff=Ya&gIdT=".$gIdT."&gKd=".$gKd."&dKib=".$dKib."&IDO=".$IDO."&JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
			?>
			<tr> 
			<td width="10%" height="18" valign="top"><a href="<? echo $URL?>" target="_top"><? echo $mRo['Kd_Aset']?></a></td>
			<td width="8%" valign="top" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;)"><a href="<? echo $URL?>" target="_top"><? echo $gReg?></a></td>
			<td width="29%" valign="top" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;)"><a href="<? echo $URL?>" target="_top"><? echo $NmAss?></a>&nbsp;</td>
			<td width="38%" valign="top" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;)"><a href="<? echo $URL?>" target="_top"><? echo $gRin?></a></td>
			<td width="4%" valign="top" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;)"><a href="<? echo $URL?>" target="_top"><? echo $gOlh?></a></td>
			<td width="11%" valign="top" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;)" align="right"><a href="<? echo $URL?>" target="_top"><? echo fConvertToRupiah($gNil)?></a></td>
			</tr>
			<?
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));	
	}
	?>
    <? function ViewObject($xA,$xB) {?>
    <tr> 
      <td height="18" valign="top" style="font-weight: bold"><? echo $xA?></td>
      <td valign="top" style="font-weight: bold"><? echo $xB?>&nbsp;</td>
      <td valign="top" style="font-weight: bold">&nbsp;</td>
      <td valign="top" style="font-weight: bold">&nbsp;</td>
      <td valign="top" style="font-weight: bold">&nbsp;</td>
      <td valign="top" style="font-weight: bold">&nbsp;</td>
    </tr>
    <? } ?>
  </table>
  </div>
</body>
</html>
<?php require('Connection_Close.php');?>
