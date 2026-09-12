<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<?
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
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?="Ref_Kode_Aset108_1_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG']?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
    <table align="center" border="0" cellspacing="0" cellpadding="0" class="table-list" style="width:99%">
      <tr> 
        <th width="46" class="ac">No</th>
        <th width="58" align="left">Kode</th>
        <th align="left">Kelompok</th>
        <th width="216" class="ac">Action</th>
      </tr>
      <?
	  	$iG=1;
		$DataPerPageF = 20;
		include "FilePagingTop.php";

		$nSQL= "SELECT * FROM ref_rek_aset108_2 ORDER BY Kd_Aset LIMIT $Offset, $DataPerPage";
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
				$mSQL= "SELECT * FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '".$mRo['Kd_Aset']."._' ORDER BY Kd_Aset";
				$mRs = mysql_query($mSQL) or die(mysql_error());
				$rRo = mysql_fetch_assoc($mRs);
				$zRo = mysql_num_rows($mRs);
				
				if ($zRo > 0) {$nDel="NoDel";}
				else {$nDel="";}
			}
			
			?>
      <tr height="27" style="cursor: pointer" title="clik disini untuk melihat rincian...!" onmouseover="this.style.cursor=&#39;pointer&#39"> 
        <td style="border-bottom:1px dotted #CCCCCC" class="ac" <?=fBackCLR($iG)?>><?=$iG?>.</td>
        <td style="border-bottom:1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$mRo['Kd_Aset']?></td>
        <td style="border-bottom:1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$mRo['Nm_Aset']?></td>
        <td style="border-bottom:1px dotted #CCCCCC" align="center" <?=fBackCLR($iG)?>>
		[&nbsp;<a href="<?="Ref_Kode_Aset108_2.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&KdAst1=".$mRo['Kd_Aset']?>" class="ico prev">VIEW</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;
		[&nbsp;<a href="#" class="ico edit" onclick="EditData('800','450','<?=$Lev?>','<?=$mRo['IDT']?>'); return false">EDIT</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;
		[&nbsp;<a href="#" class="ico del" onclick="P_DeleteR('<?=$mRo['IDT']?>','<?=$nDel?>','<?=$ReO?>'); return false">DELETE</a>
		</td>
      </tr>
      <tr> 
        <td colspan="4"> <table id="detail<?=$iG?>" cellpadding="3" border="0" width="900" style="border:1px solid #C0C0C0; font-family: Calibri; font-size: 9pt; font-style: Italic; color: #800000; display: none; border-collapse:collapse">
            <?
			if ($zRo > 0)
			{
			do
				{
				?>
            <tr> 
              <td width="4%">&nbsp;</td>
              <td width="5%"> 
                <?=$rRo['Kd_Aset']?>
              </td>
              <td width="1%">:</td>
              <td width="80%"> 
                <?=$rRo['Nm_Aset']?>
              </td>
              <td width="10%">&nbsp; </td>
            </tr>
            <?
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
            <? }?>
          </table></td>
      </tr>
      <?
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
      <?
		}
		?>
      <tr height="30">
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
        <td colspan="2" style="border-top:1px solid #CCCCCC">[&nbsp;<a href="#" class="ico add" onclick="AddItem('800','450','<?=$Lev?>'); return false;">&nbsp;ADD ITEM</a>&nbsp;]&nbsp;&nbsp;&nbsp;[&nbsp;
		<a href="<?=$_SERVER['PHP_SELF']."?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG']?>" class="ico reff">&nbsp;REFRESH</a>&nbsp;]&nbsp;&nbsp;&nbsp;[&nbsp;
		<a href="#" onclick="P_Document('800','400','center');return false" class="ico docu">&nbsp;DOKUMENT</a>&nbsp;]
		</td>
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
      </tr>
    </table>
	  <?
		$nSQL= "SELECT COUNT(*) AS JmlRc FROM ref_rek_aset108_2";
		$fUlrR= "FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&";
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
					<?
						$URL_Top = "Form_Kode_Aset108_1_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
						$URL_Mid = "Form_Kode_Aset108_1_Mid.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
						$URL_Bot = "Form_Kode_Aset108_1_Bot.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
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
			URL_Top = "Form_Kode_Aset108_1_Top.php?"+"<?="FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>";
			URL_Mid = "Form_Kode_Aset108_1_Mid.php?rIDT="+IDT+"<?="&IdL=".$_GET['IdL']?>";
			URL_Bot = "Form_Kode_Aset108_1_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function P_Document(w,h,pos)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL = "Ref_Kode_Aset108_Doc.php?CrT=BDG&"+"<?="&IdL=".$_GET['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
</script>

<?php require('Connection_Close.php');?>
