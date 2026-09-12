<?
require('Connection.php');
require('FileFunction.php');
require('Connection_PostgreSQL.php');
extract($_GET);
$IdPostG = fGlobal("IdPostgreSQL","ref_upb","Kd_UPB",$gUpB,"=","","");
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="385px" style="border:0px">
<?
	$x=array();
	$iG=1;
	$nSQ = "SELECT 
	P1.id as A0, 
	P1.nama_barang as A1, 
	P1.letak_alamat as A2, 
	P1.penggunaan as A3, 
	P3.kode_barang as A4,
	P4.kode_barang_108 as A5 

	FROM tanah P1 
	LEFT JOIN kode_barang P3 ON P3.id=P1.id_kode_barang 
	LEFT JOIN kode_barang_108 P4 ON P4.id=P1.id_kode_barang_108 
	WHERE P1.id_sub_skpd='".$IdPostG."' 
	ORDER BY P1.tahun";
	$nRs = pg_prepare($PgConn, "MyQuery", $nSQ);
	$nRs = pg_execute($PgConn, "MyQuery", array());
	while ($mRo = pg_fetch_array($nRs))
	{
		$x[0] = ""; $x[1] = ""; $x[2] = ""; $x[3] = ""; $x[4] = ""; $x[5] = ""; $x[6] = ""; $x[7] = ""; $x[8] = ""; $x[9] = ""; $x[10] = ""; $x[11] = "";
		$gIDT = $mRo[0];
		
		$x[0] = $mRo[0];
		
		$Rek17   = substr($mRo[4],0,14);
		$Rek1108 = substr($mRo[5],0,19);
		if ($Rek1108==""){
			$Rek1108="<font style='color:#ff0000'>Kd Aset 108..??????</font>";
		}
		$x[1] = $mRo[1]."<br><i>".substr($mRo[4],0,14)."<br><i>".substr($mRo[4],15,200)."<br><i>".$Rek1108."<br><i>".substr($mRo[5],19,200);
		
		
		$x[2] = $mRo[2];
		$x[3] = $mRo[3];
		
		$CekK = fGlobal("IDT","ta_kib_108","IdTabelMaster","tnh-".$gIDT,"=","","");
		$TnD = "";
		if ($CekK=='')
		{
			$TnD = "<font style='color:#0000ff'> **";
		}
		rinciDATA($x[0],$x[1],$x[2],$x[3],$x[4],$x[5],$x[6],$x[7],$x[8],$x[9],$x[10],$x[11],$iG,$xB,$TnD,$PgConn);
		$iG++;
	}

?>
<? function rinciDATA($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$iG,$xB,$TnD,$PgConn){?>
	<?
	$gBG  = fBackCLR($iG);
	?>
	<tr height="22"> 
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999 dotted; text-align:center"><?=$iG?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x0.$TnD?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999 dotted; border-left:1px #ccc solid; padding-left:2px"><?=$x1?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999 dotted; border-left:1px #ccc solid; padding-left:2px"><?=$x2?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999 dotted; border-left:1px #ccc solid; padding-left:3px"><?=$x3?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999 dotted; border-left:1px #ccc solid">
	  <table align="center" border="0" width="100%" height="100%" cellspacing="0" cellpadding="0" style="border:0px">
	  <?
		$i=1;
		$SQ = "SELECT * FROM harga_tanah 
		WHERE id_tanah='".$x0."' ORDER BY id, tahun";
		$nR = pg_prepare($PgConn,"MyQuer".$x0, $SQ);
		$nR = pg_execute($PgConn,"MyQuer".$x0, array());
		while ($mR = pg_fetch_array($nR))
		{
		$dt=0;
		if ($i>1){$dt=1;}
		?>
		<tr height="22">
		<td <?=$gBG?> style="border-top:<?=$dt?>px #999 dotted; border-right:1px #ccc solid; text-align:center"><?=$mR['tahun']?></td>
		<td <?=$gBG?> style="border-top:<?=$dt?>px #999 dotted; border-right:1px #ccc solid; padding-left:3px"><?=$mR['catatan']?></td>
		<td <?=$gBG?> style="border-top:<?=$dt?>px #999 dotted; border-right:1px #ccc solid; text-align:right; padding-right:3px"><?=fConvertToRupiah($mR['harga_bertambah'])?></td>
		<td <?=$gBG?> style="border-top:<?=$dt?>px #999 dotted; text-align:right; padding-right:3px"><?=fConvertToRupiah($mR['harga_berkurang'])?></td>
		</tr>
		<?
	  	$i++;
		}
		?>
		<tr height="100%">
		<td width="50" <?=$gBG?> style="border-right:1px #ccc solid; text-align:center">&nbsp;</td>
		<td <?=$gBG?> style="border-right:1px #ccc solid; padding-left:3px">&nbsp;</td>
		<td width="100" <?=$gBG?> style="border-right:1px #ccc solid; text-align:right; padding-right:3px">&nbsp;</td>
		<td width="100" <?=$gBG?> style="text-align:right; padding-right:3px">&nbsp;</td>
		</tr>
	  </table>
	  </td>
	</tr>
<? } ?>
<? if ($iG==1) {?>
<tr height="100%">
 <td colspan="7" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
<tr height="100%">
 <td width="25" style="border-bottom:0px #999 dotted">&nbsp;</td>
 <td width="50" style="border-bottom:0px #999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="250" style="border-bottom:0px #999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="250" style="border-bottom:0px #999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td style="border-bottom:0px #999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="500" style="border-bottom:0px #999 dotted; border-left:0px #ccc solid">&nbsp;</td>
</tr>
</table>
<script languange="javascript">
$("#fUPB").focus();
</script>