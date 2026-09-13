<?php
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";

extract($_GET);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_mid.css" type="text/css" media="all" />
</head>
<?php
if (isset($_GET['IDT'])) {$IDT  = $_GET['IDT'];}

if ($gDL)
{
	$gID = $_GET['gID'];
	$nSQ = "DELETE FROM ta_kib_f_to_aset_rinci WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_Asset_F_KdpToKib_Mid_.php?IDT=".$IDT."&IdL=".$_GET['IdL'] ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CrtKDP">
  <?php if ($IDT) {?>
  <table border="0" align="center" cellpadding="0" cellspacing="0" style="width:870px">
	<?php
	$rRF = fGlobalNEW("Referensi","ta_kib_f_to_aset","IDT",$IDT,"=","",DatabaseSB,$ConSB,"");
	$rUP = fGlobalNEW("Kd_UPB","ta_kib_f_to_aset","IDT",$IDT,"=","",DatabaseSB,$ConSB,"");
	$rAS = substr(fGlobalNEW("Kd_Aset","ta_kib_f_to_aset","IDT",$IDT,"=","",DatabaseSB,$ConSB,""),0,2);
	$iG = 1;
	$nSQ = "SELECT IDT,Ref_KDP,Nilai_KDP,Uraian FROM ta_kib_f_to_aset_rinci WHERE Referensi='$rRF' AND Kd_UPB='$rUP' ORDER BY Ref_KDP";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gDeL= "";
		$gID = $mRo[0];
		?>
		<tr height="18"> 
		  <td valign="top" width="30" <?=fBackCLR($iG)?> style="border-bottom: 1px dotted #999999"><?=$iG?></td>
		  <td valign="top" width="200" <?=fBackCLR($iG)?> style="border-bottom: 1px dotted #999999"><?=$mRo[1]?></td>
		  <td valign="top" width="65" style="border-bottom: 1px dotted #999999; text-align:right; font-weight:bold; padding-right:15px" <?=fBackCLR($iG)?>><?=fConvertToRupiah($mRo[2])?></td>
		  <td valign="top" <?=fBackCLR($iG)?> style="border-bottom: 1px dotted #999999"><?=$mRo[3]?></td>
		  <td valign="top" width="90" <?=fBackCLR($iG)?> style="text-align:center; border-bottom: 1px dotted #999999">
			<a href="#" class="ico del" onclick="DellData('<?=$gDeL?>','<?=$gID?>','<?=$IDT?>','<?=$_GET['IdL']?>'); return false">&nbsp;remove</a>		  </td>
		</tr>
		<?php 
  		$iG++;
	}
	?>
	<tr height="28">
	  <td colspan="4" style="vertical-align:middle; text-align:left; border-bottom: 1px dotted #999999" <?=fBackCLR($iG)?>>&nbsp;
	  <a href="#" class="ico reff" onclick="P_RefRe('<?=$IDT?>','<?=$IdL?>'); return false">&nbsp;&nbsp;REFRESH</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	  <a href="#" class="ico save" onclick="P_Prose('<?=$iG?>','<?=$rAS?>'); return false">&nbsp;&nbsp;PROSES KDP TO ASET</a></td>
      <td width="90" <?=fBackCLR($iG)?> style="vertical-align:middle; text-align:center; border-bottom: 1px dotted #999999"><a href="#" class="ico add" onclick="P_ToKIB('900','400','<?=$IDT?>','<?=$IdL?>'); return false">&nbsp;&nbsp;Add Item KDP</a></td>
      <td <?=fBackCLR($iG)?> style="vertical-align:middle; text-align:center; border-bottom: 1px dotted #999999">&nbsp;</td>
	</tr>
  </table>
  <?php } ?>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Prose(iG,rAS)
	{
		if (iG<=1) {window.alert('Item masih kosong, proses tidak bisa dilanjutkan..!!'); return false;}
		if (rAS!="03" && rAS!="04") 
		{
			window.alert('Maaf, proses form baru bisa untuk Aset Gedung Bangunan, Jalan Irigasi dan Jaringan \nuntuk aset yang lain masih dalam proses pengerjaan..!!');
			return false;
		}
		
		var AN = confirm("Proses KDP to Aset..?!!");
		if (AN)
		{
			var AR = confirm("Hapus sekalian data KDP setelah diproses menjadi aset\n[OK : dihapus] [Cancel : tidak terhapus]..?!!");
			if (AR)
			{
				objfrm.CrtKDP.value = "DellYA";
				objfrm.Simpan.value = "Proses";
				objfrm.target= "_top";
				objfrm.submit();
			}
			else
			{
				objfrm.CrtKDP.value = "DellNO";
				objfrm.Simpan.value = "Proses";
				objfrm.target= "_top";
				objfrm.submit();
			}
		}
	}
	
	function P_RefRe(IDT,IdL)
	{
		open('Form_Asset_F_KdpToKib_Mid.php?IDT='+IDT+'&IdL='+IdL,'_self');
	}
	
	function DellData(gDel,gID,IDT,IdL)
	{
		if (gDel!="") {window.alert('Access denied..!!'); return false;}
		var AN = confirm("Remove data..?!!");
		if (AN)
		{
			window.open('Form_Asset_F_KdpToKib_Mid.php?gDL=YA&gID='+gID+'&IDT='+IDT+'&IdL='+IdL,'_self');
		}
	}
	
	function P_ToKIB(w,h,IDT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_Top = 'Form_Asset_F_KdpToKib_Find_Top.php?IDT='+IDT+'&IdL='+IdL;
			URL_Mid = 'Form_Asset_F_KdpToKib_Find_Mid.php?IDT='+IDT+'&IdL='+IdL;
			URL_Bot = 'Form_Asset_F_KdpToKib_Find_Bot.php';
			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='35,*,30' frameborder='0'>"+
			"<frame name='WinFormFND_Top' noresize src='"+URL_Top+"' scrolling='no'>"+
			"<frame name='WinFormFND_Mid' noresize src='"+URL_Mid+"' scrolling='auto'>"+
			"<frame name='WinFormFND_Bot' noresize src='"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>";
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close() ;
			win.setTimeout("self.close()",200000000);
		}
	}
</script>

