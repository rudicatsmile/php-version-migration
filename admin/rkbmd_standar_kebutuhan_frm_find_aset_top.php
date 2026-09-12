<?php
require('Connection.php');
require("CheckLogin.php");
extract($_GET);
#$gUNT = substr(fGlobal("kd_upb","ta_rkbmd_standar_kebutuhan","IDT",$IdT,"=","",""),0,11);
#$gJNS = fGlobal("jenis","ta_rkbmd_standar_kebutuhan","IDT",$IdT,"=","","");
?>

<table border="0" width="1000" cellspacing="0" cellpadding="0" align="center">
  <tr height="30">
    <td width="70" align="right">Rekening</td>
    <td width="10">&nbsp;</td>
    <td width="268" style="font-family:arial; font-size:8pt">
	<select class="boxs" name="fAsT" id="fAsT" tabindex="0" style="width:250px" onchange="showASET('find','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>'); return false;">
      <?php
		echo "<option value='All'>All</option>";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE (Kd_Aset='1.3.1' OR Kd_Aset='1.3.2' OR Kd_Aset='1.3.3' OR Kd_Aset='1.3.4' OR Kd_Aset='1.3.5' OR Kd_Aset='1.5.3') ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel ="";
			if ($mRo[0]==$gAsT) 
			{
			$sel ="selected";
			$zUpb=$mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
		}
	  ?>
    </select></td>
    <td width="53">Search</td>
    <td width="227"><span style="font-family:arial; font-size:8pt">
      <input type="text" name="fFindP" id="fFindP" placeholder='Search' onkeypress="if (event.keyCode==13){showASET('find','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('aset'); return false}" style="width:200px" />
    </span></td>
    <td width="97"><a href="#" onclick="showASET('find','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>'); return false;" class="ico prev">GO</a></td>
    <td width="48">Tampil</td>
    <td width="145"><select class="boxs" name="fTmpRec" id="fTmpRec" style="width:73px" tabindex="0" onchange="showASET('find','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>'); return false;">
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
    </select></td>
    <td width="82" style="text-align:right; padding-right:6px"><a href="#" onclick="closeCLICK('aset'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script languange="javascript">
$("#fFindP").focus();
</script>