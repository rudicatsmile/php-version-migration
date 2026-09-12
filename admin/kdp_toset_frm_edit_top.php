<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
#echo $Upb."<br>";
#echo $Rin;

$gH = date('d'); 
$gB = date('m'); 
$gT = date('Y'); 

$eRef = "KDPTA.XXXXXXXX";
$eNom = "XXXX/HST/KDPTA/".$gB."/".$gT;

//echo $IdT." Xxxxxx";

if ($IdT)
{
	$nSQ = "SELECT 
	Kd_UPB as A0,
	Kd_REK as A1,
	Referensi as A2,
	Nomor as A3,
	Tanggal as A4,
	Uraian as A5,
	Execute as A6 
	FROM ta_kib_kdptoaset WHERE IDT='".$IdT."'";
	$nRs = mysql_query($nSQ); 
	$mRo = mysql_fetch_array($nRs); 
	$kUpb = $mRo[0]; 
	$kRin = $mRo[1];
	$eRef = $mRo[2];
	$eNom = $mRo[3];
	$eTgl = $mRo[4];
	$eMem = $mRo[5];
	$eXec = $mRo[6];
	
	$eTgl = explode('-',$eTgl);
	$gH = $eTgl[2]; 
	$gB = $eTgl[1]; 
	$gT = $eTgl[0]; 
}

$eUpb = fGlobalNEW("Nm_UPB","ref_upb","Kd_UPB",$kUpb,"=","",DatabaseSB,$ConSB,"");
$eRin = fGlobalNEW("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$kRin,"=","",DatabaseSB,$ConSB,"");
?>
<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td class="al" style="padding-left:3px; font-size:12pt; font-weight:bold">&nbsp;<img src="css/images/bukk.png" />&nbsp;&nbsp;FORMULIR KDP TO ASET</td>
    <td width="60" style="text-align:right; padding-right:6px"><a href="#" onclick="globalClose('<?=$CrDiv?>MstDiv0'); return false" class="ico clos" tabindex="30"><u>C</u>LOSE</a></td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1148px; background-color:#D2DAC4">
  <tr height="15">
    <td width="9"></td>
    <td width="76"></td>
    <td width="10"></td>
    <td width="200">
	<div id="findMstDiv0" class="finddata0KDP"> 
		<div id="findMstDiv1" class="finddata1KDP"></div> 
		<div id="findMstDiv2" class="finddata2KDP"></div> 
	</div>	</td>
    <td width="90">
	<div id="astMstDiv0" class="prosdata0AST"> 
		<div id="astMstDiv1" class="prosdata1AST"></div> 
		<div id="astMstDiv2" class="prosdata2AST"></div> 
	</div>	
	</td>
    <td width="10"></td>
    <td width="403">
	<div id="upbMstDiv0" class="finddata0GNR"> 
		<div id="upbMstDiv1" class="finddata1GNR"></div> 
		<div id="upbMstDiv2" class="finddata2GNR"></div> 
	</div>	
	</td>
    <td width="20"></td>
    <td width="45"></td>
    <td></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td align="right">Referensi</td>
    <td>&nbsp;</td>
    <td>
	<input name="fRef" id="fRef" type="text" value="<?=$eRef?>" readonly style="padding-left:5px; height:15px; width:158px; border: 1px solid #C0C0C0"/>
	<input type="button" name="B392322" value="..." onclick="findDATA('','find','<?=$IdL?>'); return false;" style="width:25px; color:#FF0000; height: 21px" />	</td>
    <td align="right">U P B</td>
    <td>&nbsp;</td>
    <td>
	<input name="kUpb" id="kUpb" type="hidden" value="<?=$kUpb?>" readonly style="padding-left:5px; height:15px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="eUpb" id="eUpb" type="text" value="<?=$eUpb?>" readonly <?php if (!$IdT){?> onclick="findUPB('','upb','<?=$IdL?>'); return false;" <?php } ?> style="padding-left:5px; height:15px; width:400px; border: 1px solid #C0C0C0"/>
	<div id="rekMstDiv0" class="finddata0GNR"> 
		<div id="rekMstDiv1" class="finddata1GNR"></div> 
		<div id="rekMstDiv2" class="finddata2GNR"></div> 
	</div>	
	</td>
    <td>&nbsp;</td>
    <td>Uraian</td>
    <td rowspan="3" valign="top">
	<textarea name="fMem" id="fMem" style="border: 1px solid #C0C0C0; height:60px; width:240px"><?=$eMem?></textarea>	</td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td align="right">Tanggal</td>
    <td>&nbsp;</td>
    <td>
	<select class="boxs" name="fH" id="fH" tabindex="0" style="width:50px">
      <?php
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gH) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fB" id="fB" tabindex="0" style="width:80px">
	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gB) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fT" id="fT" style="width: 60px" tabindex="0">
 	<?php
	for($i=2020; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gT) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>	</td>
    <td align="right">Sub-Sub OBJ</td>
    <td>&nbsp;</td>
    <td>
	<input name="kRin" id="kRin" type="hidden" value="<?=$kRin?>" readonly style="padding-left:5px; height:15px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="eRin" id="eRin" type="text" value="<?=$eRin?>" readonly <?php if (!$IdT){?> onclick="findREK('','rek','<?=$IdL?>'); return false;" <?php } ?> style="padding-left:5px; height:15px; width:400px; border: 1px solid #C0C0C0"/>
	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td align="right">Nomor</td>
    <td>&nbsp;</td>
    <td><input name="fNom" id="fNom" type="text" value="<?=$eNom?>" style="padding-left:5px; height:15px; width:186px; border: 1px solid #C0C0C0"/></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<input type="button" name="B3923" value="SAVE" <?php if ($eXec=='Y'){echo "disabled";}?> onclick="SaveDATA('<?=$CrDiv?>','<?=$IdT?>','<?=$IdL?>')" style="width:70px; height: 21px" />
	<input type="button" name="B3923" value="RESET" onclick="showKDPTA('reset','','kdpt','<?=$IdL?>')" style="width:70px; height: 21px" />
    <input type="button" name="B39232" value="REFRESH" onclick="showKDPTA('refr','<?=$IdT?>','kdpt','<?=$IdL?>')" style="width:70px; height: 21px" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div style="float:right">
	<input type="button" name="B392322" value="PROSES KDP TO ASET" onclick="prosToAset('','<?=$IdT?>','ast','<?=$IdL?>')" style="width:130px; color:#ff0000; height: 21px" />
	</div>	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="15">
    <td></td>
    <td></td>
    <td></td>
    <td colspan="5"></td>
    <td colspan="2"></td>
  </tr>
</table>
<table border="0" width="100%" height="23" cellspacing="0" cellpadding="0" align="center">
  <tr style="font-weight:bold; font-size:10pt; text-shadow: #666 0px 0px; text-align:center">
    <td width="26" style="border-right:1px solid #999">No</td>
    <td width="95" style="border-right:1px solid #999">Referensi</td>
    <td width="55" style="border-right:1px solid #999">Register</td>
    <td width="65" style="border-right:1px solid #999">Tanggal</td>
    <td style="border-right:1px solid #999">Nama Aset / Lokasi</td>
    <td width="93" style="border-right:1px solid #999">Nilai Awal</td>
    <td width="93" style="border-right:1px solid #999">Nilai Akhir</td>
    <td width="60" style="border-right:1px solid #999">Induk</td>
    <td width="82" style="">Action</td>
  </tr>
</table>
<script languange="javascript">
	$('#fNom').focus();
</script>