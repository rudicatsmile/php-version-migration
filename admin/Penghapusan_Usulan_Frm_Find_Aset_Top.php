<?php
require('Connection.php');
require("CheckLogin.php");
extract($_GET);
$gUNT = substr(fGlobal("kd_upb","ta_usulan_108","IDT",$IdT,"=","",""),0,11);
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
  <tr height="35">
    <td width="5" style="text-align:center">&nbsp;</td>
    <!--? if ($Jns=='PH' || $Jns=='MK') {?-->
    <?php if ($Jns=='PH') {?>
		<td width="150" style="font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="g" onclick="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>')" checked />
		  ASET LAINNYA</label></td>
		<!--td width="60" style="font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="c" onclick="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>')" /> C</label></td-->
	<?php } else {?>
		<td width="50" style="font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="a" onclick="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>')" checked />A</label></td>
		<td width="50" style="font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="b" onclick="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>')" />B</label></td>
		<td width="50" style="font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="c" onclick="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>')" />C</label></td>
		<td width="50" style="font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="d" onclick="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>')" />D</label></td>
		<td width="50" style="font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="e" onclick="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>')" />E</label></td>
		<?php if ($Jns=='MS') {?>
			<td width="50" style="font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="f" onclick="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>')" />F</label></td>
		<?php } ?>
	    <td width="70" style="font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="g" onclick="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>')" />LAINNYA</label></td>
	<?php } ?>
    <td width="20">&nbsp;</td>
    <td width="30" align="right" style="color:#0000FF">TAHUN</td>
    <td width="15">&nbsp;</td>
    <td width="50" style="font-family:arial; font-size:8pt"><select class="boxs" name="fThnAst" id="fThnAst" style="width: 60px" tabindex="0" onchange="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>'); return false;">
      <option value="">ALL</option>
      <?php
	for($i=1980; $i<=2030; $i++)
	{
		$sel ="";
		if ($i==$gTH) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select></td>
    <td width="10">&nbsp;</td>
    <td width="40" style="color:#0000FF">DATA</td>
    <td width="110">
	<select class="boxs" name="fExtra" id="fExtra" style="background:#999900; color:#FFFFFF; width:100px" tabindex="0" onchange="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>'); return false;">
      <option value="">ALL</option>
      <option value="Y">Extracom</option>
      <option value="N">Intracom</option>
    </select></td>
    <td width="50" style="color:#0000FF">TAMPIL</td>
    <td width="50"><select class="boxs" name="fTmpRec" id="fTmpRec" style="width:73px" tabindex="0" onchange="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>'); return false;">
	<option value="50">50</option>
	<option value="100">100</option>
	<option value="200">200</option>
	<option value="400">400</option>
	<option value="800">800</option>
	<option value="1000">1.000</option>
	<option value="2000">2.000</option>
	<option value="4000">4.000</option>
	<option value="5000">5.000</option>
	<option value="7000">7.000</option>
	<option value="8000">8.000</option>
	<option value="9000">9.000</option>
	<option value="10000">10.000</option>
	<option value="15000">15.000</option>
	<option value="20000">20.000</option>
	<option value="25000">25.000</option>
	<option value="30000">30.000</option>
    </select></td>
    <td width="40" align="right" style="color:#0000FF">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="180"></td>
    <td></td>
    <td width="60" style="text-align:right; padding-right:6px"><a href="#" onclick="closeCLICK('aset'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
  <tr height="35">
    <td width="66" align="right">U P B</td>
    <td width="14">&nbsp;</td>
    <td width="504">
	<select class="boxs" name="rUpb" id="rUpb" tabindex="0" style="width: 450px; background:#CCFF00" onchange="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>'); return false;">
        <?php
		echo "<option value='All'>All</option>";
		$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUNT."%' ORDER BY Kd_Upb";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
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
      </select>	</td>
    <td width="49">FIND</td>
    <td width="218"><input type="text" name="fFindP" id="fFindP" placeholder='Search' onkeypress="if (event.keyCode==13){showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('aset'); return false}" style="width:200px" /></td>
    <td width="466"><a href="#" onclick="showASET('<?=$ReO?>','find','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>'); return false;" class="ico prev">GO</a></td>
  </tr>
 </table>
<script languange="javascript">
$("#fFindP").focus();
</script>