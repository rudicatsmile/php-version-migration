<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

#echo $gRF."<br>";
#echo $IdT;

if ($IdT!='')
{
	$ReN = fGlobal("referensi","ta_rkbmd_new_pmf_pmt_phs_rinci","idt",$IdT,"=","","");
	$JeN = fGlobal("jenis","ta_rkbmd_new_pmf_pmt_phs","referensi",$ReN,"=","","");
	#echo $JeN;
	
	$DtA = fGlobal("peruntukan:bentuk_pemanfaatan:jangka_waktu_pemanfaatan:bentuk_pemindahtanganan:alasan_rencana_pemindahtanganan:alasan_rencana_penghapusan","ta_rkbmd_new_pmf_pmt_phs_rinci","idt",$IdT,"=","","");
	$DtA = explode(':',$DtA);
	{
		$peru = $DtA[0];
		$bent = $DtA[1];
		$wakt = $DtA[2];
		$wakt = explode(' ',$wakt);
		$tme = $wakt[0];
		$wkt = $wakt[1];
		
		$pindr = $DtA[3];
		$alasr = $DtA[4];
		$alasp = $DtA[5];
	}
}
?>
<table align="center" cellpadding="0" class="table-form" cellspacing="0" border="0" style="width:550px">
<tr>
  <td width="30"></td>
  <td width="120"></td>
  <td width="20"></td>
  <td>&nbsp;</td>
</tr>
<?php if ($JeN=='PMF'){?>
<tr>
  <td></td>
  <td>Peruntukan</td>
  <td>:</td>
  <td><textarea name="fPeru" id="fPeru" style="width:300px; height:50px" onkeypress="if (event.keyCode==13){B40.click(); return false;}"><?=$peru?></textarea></td>
  </tr>
<tr>
  <td></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td></td>
  <td>Bentuk Pemanfaatan</td>
  <td>:</td>
  <td><textarea name="fBent" id="fBent" style="width:300px; height:50px" onkeypress="if (event.keyCode==13){B40.click(); return false;}"><?=$bent?></textarea></td>
</tr>
<tr>
  <td></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td></td>
  <td>Jangka Waktu</td>
  <td>:</td>
  <td>
  <select name="fJml" id="fJml" style="width:50px; text-align:center">
  <option value=""></option>
  <?php for ($i=1; $i<=20; $i++){?>
  <option value="<?=$i?>" <?php if ($i==$tme) {echo "selected";}?>><?=$i?></option>
  <?php } ?>
  </select>
  <select name="fWkt" id="fWkt" style="width:80px; text-align:center">
  <option value=""></option>
  <option value="Hari"  <?php if ($wkt=='Hari') {echo "selected";}?>>Hari</option>
  <option value="Bulan" <?php if ($wkt=='Bulan'){echo "selected";}?>>Bulan</option>
  <option value="Tahun" <?php if ($wkt=='Tahun'){echo "selected";}?>>Tahun</option>
  </select>
  </td>
  </tr>
<tr>
  <td></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<?php } ?>
<?php if ($JeN=='PMT'){?>
<tr>
  <td></td>
  <td>Bentuk Pemindahtanganan</td>
  <td>:</td>
  <td><textarea name="fBenP" id="fBenP" style="width:300px; height:50px" onkeypress="if (event.keyCode==13){B40.click(); return false;}"><?=$pindr?></textarea></td>
  </tr>
<tr>
  <td></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td></td>
  <td>Alasan Pemindahtanganan</td>
  <td>:</td>
  <td><textarea name="fAlaP" id="fAlaP" style="width:300px; height:50px" onkeypress="if (event.keyCode==13){B40.click(); return false;}"><?=$alasr?></textarea></td>
</tr>
<tr>
  <td></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<?php } ?>
<?php if ($JeN=='PHS'){?>
<tr>
  <td></td>
  <td>Alasan Penghapusan</td>
  <td>:</td>
  <td><textarea name="fAlaD" id="fAlaD" style="width:300px; height:50px" onkeypress="if (event.keyCode==13){B40.click(); return false;}"><?=$alasp?></textarea></td>
</tr>
<tr>
  <td></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<?php } ?>
<tr>
  <td></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>
  <input type="button" name="B40" value="Save" onclick="SaveEDIT('<?=$gRF?>','<?=$JeN?>','<?=$IdT?>','<?=$IdL?>' )" style="width: 80px; height: 21px" />
  <input type="button" name="B41" value="Close" onclick="B11.click(); dispNO('edtMstCri')" style="width: 80px; height: 21px" />
  
  </td>
</tr>
<tr>
  <td></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
