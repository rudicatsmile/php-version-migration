<?
if ($fUpb=='00.00.00.00.00.000')
{
	$nmUP = "Semua";
}
else
{
	$nmUP = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$fUpb,"=","","");
}

if ($fSub=='00.00.00.00.00')
{
	$nmSB = "Semua";
}
else
{
	$nmSB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$fSub,"=","","");
}

$nmUN = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($fUnt,0,11),"=","","");
if ($fUnt=='__.__.__.__'){$nmUN = "Semua";}

$Leb = 173;

$TxtA = 'Kondisi Fisik Sebelum Inventarisasi';
$TxtB = 'Kondisi Fisik Sesudah Inventarisasi';

$TtkA = ':';
$TtkB = ':';

$NmKA = $NmKA;
$NmKB = $NmKB;

if ($doc=='Report_LHI_III_B_11')
{
	$Leb = 65;
	$TxtA = 'Kondisi Fisik';
	$TxtB = '';
	
	$TtkA = ':';
	$TtkB = '&nbsp;';
	
	$NmKA = $NmKA;
	$NmKB = '&nbsp;';
}
?>
<table align="center" cellpadding="0" cellspacing="0" border="0" width="<?=$tWide?>" style="font-family:calibri; font-weight:bold; font-size:9pt">
<tr height="20">
  <td width="120">Unit Kerja</td>
  <td width="30" align="center">:</td>
  <td width="422"><?=$nmUN?></td>
  <td width="50">&nbsp;</td>
  <td width="<?=$Leb?>"><?=$TxtA?></td>
  <td width="30" align="center"><?=$TtkA?></td>
  <td><?=$NmKA?></td>
</tr>
<tr height="20">
  <td>Sub Unit</td>
  <td align="center">:</td>
  <td><?=$nmSB?></td>
  <td>&nbsp;</td>
  <td><?=$TxtB?></td>
  <td align="center"><?=$TtkB?></td>
  <td><?=$NmKB?></td>
</tr>
<tr height="20">
  <td>UPB</td>
  <td align="center">:</td>
  <td><?=$nmUP?></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr height="20">
  <td>Kuasa Pengguna Barang</td>
  <td align="center">:</td>
  <td>-</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr height="20">
  <td>Pengguna Barang</td>
  <td align="center">:</td>
  <td><?=fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",$fUnt,"=","","")?></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr height="20">
  <td>Pengelola Barang</td>
  <td align="center">:</td>
  <td><?=fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit","24.04.04.01","=","","")?></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
