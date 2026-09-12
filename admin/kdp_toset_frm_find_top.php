<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
#$gThn = $tTbl;
?>
<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="13" class="ac" style="padding-left:3px">&nbsp;</td>
    <td width="52" class="al">Tahun</td>
    <td width="96" class="al">
	<select class="boxs" name="eThn" id="eThn" style="width:50px; text-align:center" tabindex="0" onchange="B40.click()">
	<option value="">ALL</option>
	<?php
	for($nThn=2020; $nThn<=2030; $nThn++)
	{
		$sel ="";
		if ($nThn==$gThn) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
	}
	?>
	</select>
	</td>
    <td width="55" class="al">Search</td>
    <td width="182" class="al">
	<input type="text" name="fFndDTA" id="fFndDTA" placeholder='search' onKeyPress="if (event.keyCode==13){findDATA('find','<?=$CrDiv?>','<?=$IdL?>');return false;} else if (event.keyCode==27){globalClose('<?=$CrDiv?>MstDiv0');return false;}" style="width:170px; height:14px; padding-left:20px; background-image: url('css/images/prev.gif'); background-position:2px 2px; background-repeat: no-repeat" tabindex="30"/>	</td>
    <td width="853" class="al">
	<input type="button" name="B40" id="B40" value="GO" onclick="findDATA('find','<?=$CrDiv?>','<?=$IdL?>')" style="width: 30px; height:20px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />	</td>
    <td width="66" style="text-align:right; padding-right:6px"><a href="#" onclick="globalClose('<?=$CrDiv?>MstDiv0'); return false" class="ico clos" tabindex="30"><u>C</u>LOSE</a></td>
  </tr>
</table>
<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center" style="background:#009933; color:#fff">
  <tr style="text-align:center">
    <td width="27" style="border-right:1px solid #ccc; text-shadow:1px 1px 1px #000">NO</td>
    <td width="65" style="border-right:1px solid #ccc; text-shadow:1px 1px 1px #000">TANGGAL</td>
    <td width="97" style="border-right:1px solid #ccc; text-shadow:1px 1px 1px #000">REFERENSI</td>
    <td width="140" style="border-right:1px solid #ccc; text-shadow:1px 1px 1px #000">NOMOR</td>
    <td width="284" style="border-right:1px solid #ccc; text-shadow:1px 1px 1px #000">UPB / REKENING</td>
    <td width="113" style="border-right:1px solid #ccc; text-shadow:1px 1px 1px #000">NILAI AWAL</td>
    <td width="113" style="border-right:1px solid #ccc; text-shadow:1px 1px 1px #000">NILAI AKHIR</td>
    <td>ACTION</td>
  </tr>
</table>
<script languange="javascript"> 
$('#fFndDTA').focus();
</script>