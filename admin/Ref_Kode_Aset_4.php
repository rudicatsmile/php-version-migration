<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<?php
extract($_GET);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
$KdAst1=$_GET['KdAst1'];
$KdAst2=$_GET['KdAst2'];
$KdAst3=$_GET['KdAst3'];
?>
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?="Ref_Kode_Aset_4_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG']."&KdAst1=".$KdAst1."&KdAst2=".$KdAst2."&KdAst3=".$KdAst3 ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
  <table border="0" align="center" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse; text-transform: uppercase; font-weight: bold; width:99%">
    <tr> 
      <td width="92"><a href="<?="Ref_Kode_Aset_1.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>">&lt;&lt; - BIDANG</a></td>
      <td width="15">&nbsp;</td>
      <td width="970"><a href="<?="Ref_Kode_Aset_1.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>"><?=$KdAst1." : ".fGlobal("Nm_Aset","Ref_Rek_Aset1","Kd_Aset",$KdAst1,"=","","")?></a></td>
    </tr>
    <tr> 
      <td><a href="<?="Ref_Kode_Aset_2.php?KdAst1=".$KdAst1."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>">&lt;&lt; - KELOMPOK</a></td>
      <td>&nbsp;</td>
      <td><a href="<?="Ref_Kode_Aset_2.php?KdAst1=".$KdAst1."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>"><?=$KdAst2." : ".fGlobal("Nm_Aset","Ref_Rek_Aset2","Kd_Aset",$KdAst2,"=","","")?></a></td>
    </tr>
    <tr> 
      <td><a href="<?="Ref_Kode_Aset_3.php?KdAst1=".$KdAst1."&KdAst2=".$KdAst2."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>">&lt;&lt; - JENIS</a></td>
      <td>&nbsp;</td>
      <td><a href="<?="Ref_Kode_Aset_3.php?KdAst1=".$KdAst1."&KdAst2=".$KdAst2."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>"><?=$KdAst3." : ".fGlobal("Nm_Aset","Ref_Rek_Aset3","Kd_Aset",$KdAst3,"=","","")?></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
    <table align="center" class="table-list" border="0" cellspacing="0" cellpadding="0" style="width:99%">
      <tr> 
        <th width="46" align="left">No.</th>
        <th width="100" align="left">Kode</th>
        <th width="521" align="left">Objek</th>
        <th width="117" class="ar"> extra Komtable </th>
        <th width="170" class="ac">Umur Ekonomis</th>
        <th width="138" class="ac">Tabel Atribusi</th>
        <th width="216" class="ac">Actions</th>
      </tr>
      <?php
		$DataPerPageF = 15;
		include "FilePagingTop.php";

		$nSQL= "SELECT * FROM ref_rek_aset4 WHERE Kd_Aset LIKE '".$KdAst3.".__' ORDER BY Kd_Aset LIMIT $Offset, $DataPerPage";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			if ($Lev > 1) 
			{
				$nDel="NoDel";
			}
			else
			{
				$mSQL= "SELECT * FROM ref_rek_aset5 WHERE Kd_Aset LIKE '".$mRo['Kd_Aset'].".___' ORDER BY Kd_Aset";
				$mRs = mysql_query($mSQL) or die(mysql_error());
				$rRo = mysql_fetch_assoc($mRs);
				$zRo = mysql_num_rows($mRs);
				if ($zRo > 0)
				{$nDel="NoDel";}
				else
				{$nDel="";}
			}
			
			$gRC = fGlobal("IDT","ta_masa_manfaat","Kode",$mRo['Kd_Aset'],"=","","");
			if ($gRC){
				$gADA="<img src='Images/okey.gif' />";
			}
			else{
				$gADA="";
			}
			?>
      <tr height="22" style="cursor: pointer" title="clik disini untuk melihat rincian...!" onmouseover="this.style.cursor=&#39;pointer&#39"> 
        <td <?=fBackCLR($iG)?> style="border-bottom: 1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
        <td style="border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$mRo['Kd_Aset']?></td>
        <td style="border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$mRo['Nm_Aset']?></td>
        <td style="border-bottom: 1px dotted #CCCCCC; text-align:right" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=fConvertToRupiah($mRo['nilaiExtracom'])?></td>
        <td style="text-align:center; border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?php if ($mRo['Ms_Manfaat']>0) {echo $mRo['Ms_Manfaat']." Tahun";}?></td>
        <td style="text-align:center; border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$gADA?></td>
        <td style="border-bottom: 1px dotted #CCCCCC" class="ac" <?=fBackCLR($iG)?>>
		[&nbsp;<a href="<?="Ref_Kode_Aset_5.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&KdAst1=".$_GET['KdAst1']."&KdAst2=".$_GET['KdAst2']."&KdAst3=".$_GET['KdAst3']."&KdAst4=".$mRo['Kd_Aset']?>" class="ico prev">VIEW</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;
		[&nbsp;<a href="#" class="ico edit" onclick="EditData('800','450','<?=$Lev?>','<?=$mRo['IDT']?>'); return false">EDIT</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;
		[&nbsp;<a href="#" class="ico del" onclick="P_DeleteR('<?=$mRo['IDT']?>','<?=$nDel?>','<?=$ReO?>'); return false">DELETE</a>&nbsp;]
		</td>
      </tr>
      <tr> 
        <td colspan="7"> <table id="detail<?=$iG?>" cellpadding="3" border="0" width="900" style="border:1px solid #C0C0C0; font-family: Calibri; font-size: 9pt; font-style: Italic; color: #800000; display: none; border-collapse:collapse">
            <?php
			if ($zRo > 0)
			{
			do
				{
				?>
            <tr> 
              <td width="4%">&nbsp;</td>
              <td width="5%"> 
                <?=$rRo['Kd_Aset']?>              </td>
              <td width="1%">:</td>
              <td width="80%"> 
                <?=$rRo['Nm_Aset']?>              </td>
              <td width="10%">&nbsp; </td>
            </tr>
            <?php
				}
					while ($rRo = mysql_fetch_assoc($mRs));	
				}
				else
				{
				?>
            <tr> 
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>Unit tidak ditemukan </td>
              <td valign="top">&nbsp;</td>
            </tr>
            <?php }?>
          </table></td>
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
        <td colspan="5">Data tidak ditemukan..!!</td>
        <td>&nbsp;</td>
      </tr>
      <?php
		}
		?>
      <tr height="30">
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
        <td colspan="5" style="border-top:1px solid #CCCCCC">
		[&nbsp;<a href="#" class="ico add" onclick="AddItem('800','450','<?=$Lev?>')">&nbsp;ADD ITEM</a>&nbsp;]&nbsp;&nbsp;&nbsp;
		[&nbsp;<a href="<?=$_SERVER['PHP_SELF']."?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG']."&KdAst1=".$KdAst1."&KdAst2=".$KdAst2."&KdAst3=".$KdAst3?>" class="ico reff">&nbsp;REFRESH</a>&nbsp;]&nbsp;&nbsp;&nbsp;
		<a href="#" onclick="P_Document('800','400','center','<?=$KdAst3?>');return false" class="ico docu">&nbsp;DOKUMENT</a>&nbsp;]		</td>
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
      </tr>
    </table>
	  <?php
		$nSQL= "SELECT COUNT(*) AS JmlRc FROM ref_rek_aset4 WHERE Kd_Aset LIKE '".$KdAst3.".__'";
		$fUlrR= "FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&KdAst1=".$KdAst1."&KdAst2=".$KdAst2."&KdAst3=".$KdAst3."&";
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
			var AN = confirm("Hapus data aset..?!!");
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
	
	function AddItem(w,h,Lev)
	{
		if (Lev>1){alert('Access denied..!!');return false;}
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
			win=window.open('','',settings);
			if (win!=null)
				{
					win.window.document.open()       			
					<?php
						$URL_Top = "Form_Kode_Aset4_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
						$URL_Mid = "Form_Kode_Aset4_Mid.php?KdAst3=".$KdAst3."&IdL=".$_GET['IdL'];
						$URL_Bot = "Form_Kode_Aset4_Bot.php";
					?>       			
				txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='<?=$URL_Top?>' scrolling='no'><frame name='WinFormKIB_Mid' src='<?=$URL_Mid?>' scrolling='auto'><frame name='WinFormKIB_Bot' src= '<?=$URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
				win.focus()
				win.window.document.clear()
				win.window.document.write(txtHTML)
				win.window.document.close() 
				win.setTimeout("self.close()",200000000)
			}
	}

	function EditData(w,h,Lev,IDT)
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
			URL_Top = "Form_Kode_Aset4_Top.php?"+"<?="FrmG=".$_GET['FrmG']?>";
			URL_Mid = "Form_Kode_Aset4_Mid.php?rIDT="+IDT+"<?="&IdL=".$_GET['IdL']?>";
			URL_Bot = "Form_Kode_Aset4_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}

	function P_Document(w,h,pos,gKD)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL = "Ref_Kode_Aset_Doc.php?CrT=OBJ&gKD="+gKD+"<?="&IdL=".$_GET['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
</script>

<?php require('Connection_Close.php');?>
