<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
$IdRef1=$_GET['IdRef1'];
$IdRef2=$_GET['IdRef2'];
?>
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "Ref_ProKeg_3_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG']."&IdRef1=".$IdRef1."&IdRef2=".$IdRef2 ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
	<table border="0" align="center" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse; text-transform: uppercase; font-weight: bold; width:99%">
    <tr> 
      <td width="92"><a href="<?php echo "Ref_ProKeg_1.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>">&lt;&lt; - URUSAN</a></td>
      <td width="15">&nbsp;</td>
      <td width="970"><a href="<?php echo "Ref_ProKeg_1.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>"><?=$IdRef1." : ".fGlobal("Nm_Referensi","Ref_Kegiatan","Id_Referensi",$IdRef1,"=","","")?></a></td>
    </tr>
    <tr> 
      <td><a href="<?php echo "Ref_ProKeg_2.php?IdRef1=".$IdRef1."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>">&lt;&lt; - PROGRAM</a></td>
      <td>&nbsp;</td>
      <td><a href="<?php echo "Ref_ProKeg_2.php?IdRef1=".$IdRef1."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>"><?=$IdRef2." : ".fGlobal("Nm_Referensi","Ref_Kegiatan","Id_Referensi",$IdRef2,"=","","")?></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
    <table align="center" class="table-list" border="0" cellspacing="0" cellpadding="0" style="width:99%">
      <tr> 
        <th width="39" class="ac">NO</th>
        <th width="60" align="left">KODE</th>
        <th width="801" align="left">KEGIATAN</th>
        <th width="145" class="ac">ACTIONS</th>
      </tr>
      <?php
		$DataPerPageF = 17;
		include "FilePagingTop.php";

		$nSQL= "SELECT * FROM ref_kegiatan WHERE Id_Referensi LIKE '".$IdRef2.".__' ORDER BY Id_Referensi LIMIT $Offset, $DataPerPage";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			$nDel="";
			if ($Lev>1){$nDel="NoDell";}
			?>
      <tr height="22" style="cursor: pointer" onmouseover="this.style.cursor=&#39;pointer&#39"> 
        <td <?=fBackCLR($iG)?> style="border-bottom: 1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
        <td style="border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$mRo['Id_Referensi']?></td>
        <td style="border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$mRo['Nm_Referensi']?></td>
        <td align="center" style="border-bottom: 1px dotted #CCCCCC" <?=fBackCLR($iG)?>>
		[&nbsp;<a href="#" class="ico edit" onclick="EditData('800','450','<?=$Lev?>','<?=$mRo['IDO']?>','<?=$IdRef2?>','<?=$_GET['FrmG']?>','<?=$_GET['IdL']?>'); return false;">EDIT</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;
		[&nbsp;<a href="#" class="ico del" onclick="P_DeleteR('<?=$mRo['IDO']?>','<?=$nDel?>','<?=$ReO?>')">DELETE</a>&nbsp;]
		</td>
      </tr>

      <?php
			  $iG++;
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		else
		{
		?>
      <tr> 
        <td></td>
        <td colspan="2">Data tidak ditemukan..!!</td>
        <td>&nbsp;</td>
      </tr>
      <?php
		}
		?>
      <tr height="30">
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
        <td colspan="2" style="border-top:1px solid #CCCCCC">
		[&nbsp;<a href="#" class="ico add" onclick="AddItem('800','450','<?=$Lev?>','<?=$IdRef2?>','<?=$_GET['FrmG']?>','<?=$_GET['IdL']?>'); return false;">&nbsp;ADD ITEM</a>&nbsp;]&nbsp;&nbsp;&nbsp;
		[&nbsp;<a href="<?=$_SERVER['PHP_SELF']."?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG']."&IdRef1=".$IdRef1."&IdRef2=".$IdRef2?>" class="ico reff">&nbsp;REFRESH</a>&nbsp;]</td>
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
      </tr>
    </table>
	  <?php
		$nSQL= "SELECT COUNT(*) AS JmlRc FROM ref_kegiatan WHERE Id_Referensi LIKE '".$IdRef2.".__'";
		echo $nSQL;
		$fUlrR= "FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&IdRef1=".$IdRef1."&IdRef2=".$IdRef2."&";
		include "FilePagingBot.php";
	  ?>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_DeleteR(xA,xB,xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		if (xB!="")
			{window.alert("Access Denied...!!");}
		else
		{
			var AN = confirm("Hapus data ..?!!");
			if (AN)
			{
			objfrm.CritIDT.value = xA;
			objfrm.Simpan.value = "DeleteRecord";
			objfrm.submit();
			}
		}
	}

	function P_Comming()
	{
		window.alert('Under construction...!!');
	}
	
	function AddItem(w,h,Lev,IdRef2,FrmG,IdL)
	{
		if (Lev>1){alert('Access denied..!!');return false;}
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = "Form_ProKeg3_Top.php?FrmG="+FrmG+"&IdL="+IdL;
			URL_Mid = "Form_ProKeg3_Mid.php?IdRef2="+IdRef2+"&IdL="+IdL;
			URL_Bot = "Form_ProKeg3_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}

	function EditData(w,h,Lev,IDO,IdRef2,FrmG,IdL)
	{
		if (Lev>1){alert('Access denied..!!');return false;}
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = "Form_ProKeg3_Top.php?FrmG="+FrmG+"&IdL="+IdL;
			URL_Mid = "Form_ProKeg3_Mid.php?rIDO="+IDO+"&IdRef2="+IdRef2+"&IdL="+IdL;
			URL_Bot = "Form_ProKeg3_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}

</script>
