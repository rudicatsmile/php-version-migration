<?
require('Connection.php');
require("CheckLogin.php");
extract($_GET);
$gUNT = substr(fGlobal("kd_unit","ta_rkbmd_new_pmf_pmt_phs","IDT",$IdT,"=","",""),0,11);
$gJNS = fGlobal("jenis","ta_rkbmd_new_pmf_pmt_phs","IDT",$IdT,"=","","");
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
  <tr height="30">
    <td width="66" align="right">ASET</td>
    <td width="14">&nbsp;</td>
    <td width="110">
	<select class="boxs" name="fAsT" id="fAsT" style="background:#999900; color:#FFFFFF; width:100px" tabindex="0" onchange="showASET('find','<?=$PgE?>','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>'); return false;">
      <? if ($gJNS!='PHS'){?>
	  <option value="1.3.1" <? if ($gAsT=='1.3.1'){echo "selected";}?>>TNH</option>
      <option value="1.3.2" <? if ($gAsT=='1.3.2'){echo "selected";}?>>ALT</option>
      <option value="1.3.3" <? if ($gAsT=='1.3.3'){echo "selected";}?>>BNG</option>
      <option value="1.3.4" <? if ($gAsT=='1.3.4'){echo "selected";}?>>JLN</option>
      <option value="1.3.5" <? if ($gAsT=='1.3.5'){echo "selected";}?>>ATL</option>
      <option value="1.3.6" <? if ($gAsT=='1.3.6'){echo "selected";}?>>KDP</option>
      <option value="1.5.3" <? if ($gAsT=='1.5.3'){echo "selected";}?>>ATB</option>
      <option value="1.5.4" <? if ($gAsT=='1.5.4'){echo "selected";}?>>KDL</option>
      <? }else{?>
      <option value="1.5.4" <? if ($gAsT=='1.5.4'){echo "selected";}?>>KDL</option>
      <? } ?>
    </select>	</td>
    <td width="30" align="right">TAHUN</td>
    <td width="15">&nbsp;</td>
    <td width="50" style="font-family:arial; font-size:8pt"><select class="boxs" name="fThnAst" id="fThnAst" style="width: 60px" tabindex="0" onchange="showASET('find','<?=$PgE?>','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>'); return false;">
      <option value="">ALL</option>
      <?
	for($i=1980; $i<=2030; $i++)
	{
		$sel ="";
		if ($i==$gTH) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select></td>
    <td width="10">&nbsp;</td>
    <td width="40">DATA</td>
    <td width="110">
	<select class="boxs" name="fExtra" id="fExtra" style="background:#999900; color:#FFFFFF; width:100px" tabindex="0" onchange="showASET('find','<?=$PgE?>','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>'); return false;">
      <option value="">ALL</option>
      <option value="Y">Extracom</option>
      <option value="N">Intracom</option>
    </select></td>
    <td width="50">TAMPIL</td>
    <td width="50"><select class="boxs" name="fTmpRec" id="fTmpRec" style="width:73px" tabindex="0" onchange="showASET('find','<?=$PgE?>','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>'); return false;">
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
    <td width="40" align="right" style="color:#0000FF">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="180"></td>
    <td></td>
    <td width="60" style="text-align:right; padding-right:6px"><a href="#" onclick="closeCLICK('aset'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="66" align="right">U P B</td>
    <td width="14">&nbsp;</td>
    <td width="504">
	<select class="boxs" name="rUpb" id="rUpb" tabindex="0" style="width: 450px; background:#CCFF00" onchange="showASET('find','<?=$PgE?>','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>'); return false;">
        <?
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
    <td width="218"><input type="text" name="fFindP" id="fFindP" placeholder='Search' onkeypress="if (event.keyCode==13){showASET('find','<?=$PgE?>','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('aset'); return false}" style="width:200px" /></td>
    <td width="466"><a href="#" onclick="showASET('find','<?=$PgE?>','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>'); return false;" class="ico prev">GO</a></td>
  </tr>
</table>
<script languange="javascript">
$("#fFindP").focus();
</script>