<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$mRf = fGlobalNEW("Referensi","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
$eXe = fGlobalNEW("Execute","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
$mJM = fGlobalNEW("ifNull(sum(Nilai),0)","ta_kib_kdptoaset_data_post","Referensi",$mRf,"=","",DatabaseSB,$ConSB,"");
$mCT = fGlobalNEW("count(*)","ta_kib_kdptoaset_data","Referensi",$mRf,"=","",DatabaseSB,$ConSB,"");

$Ref = fGlobalNEW("KeReferensi","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
$Reg = fGlobalNEW("KeRegister","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");

?>
<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="341" class="al" style="padding-left:10px">
	<a href="#" class="ico add" onclick="findKDP('','<?=$eXe?>','<?=$IdT?>','find','<?=$IdL?>'); return false;">Add Item KDP</a>	</td>
    <td class="al" width="45" style="padding-left:3px">Status</td>
    <td class="al" width="11" style="padding-left:3px">:</td>
    <td class="al" width="126" style="padding-left:3px"><?php if ($eXe=='Y'){echo "Executed";} else {echo "-";}?></td>
    <td class="al" width="73" style="padding-left:3px">Ke Referensi</td>
    <td class="al" width="13" style="padding-left:3px">:</td>
    <td width="156" class="al" style="padding-left:3px"><?=$Ref?></td>
    <td class="al" width="74" style="padding-left:3px">Ke Regsiter</td>
    <td class="al" width="13" style="padding-left:3px">:</td>
    <td width="124" class="al" style="padding-left:3px"><?=$Reg?></td>
    <td width="63" class="al" style="padding-left:3px"><input name="tCnT" id="tCnT" type="hidden" value="<?=$mCT?>" readonly style="padding-left:5px; height:15px; width:40px; border: 1px solid #C0C0C0"/></td>
    <td width="83" class="al" style="padding-left:3px">&nbsp;</td>
    <td width="61" style="padding-left:3px">T O T A L</td>
    <td width="22" style="padding-left:3px">:</td>
    <td width="112" style="text-align:right; padding-right:6px"><?=fConvertToRupiah($mJM)?></td>
  </tr>
</table>
