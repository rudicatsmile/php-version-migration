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
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
$KdRek1 = $_GET['KdRek1'] ?? '';
?>
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?="Ref_Kode_Rekn_2_.php?FrmG=".($_GET['FrmG'] ?? '')."&IdL=".($_GET['IdL'] ?? '')."&Page=".($_GET['Page'] ?? '')."&iG=".($_GET['iG'] ?? '')."&KdRek1=".$KdRek1?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
	<table border="0" align="center" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse; text-transform: uppercase; font-weight: bold; width:900px">
		<tr> 
		  <td width="92"><a href="<?="Ref_Kode_Rekn_1.php?FrmG=".($_GET['FrmG'] ?? '')."&IdL=".($_GET['IdL'] ?? '')?>">&lt;&lt; - BIDANG</a></td>
		  <td width="15">&nbsp;</td>
		  <td width="970"><a href="<?="Ref_Kode_Rekn_1.php?FrmG=".($_GET['FrmG'] ?? '')."&IdL=".($_GET['IdL'] ?? '')?>"><?=$KdRek1." : ".fGlobal("Nm_Rek","Ref_Rek_1","Kd_Rek",$KdRek1,"=","","")?></a></td>
		</tr>
		<tr>
		  <td width="83">&nbsp;</td>
		  <td width="22">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
	</table>
    <table align="center" class="table-list" border="0" cellspacing="0" cellpadding="0" style="width:900px">
      <tr> 
        <th width="46" class="ac">NO</th>
        <th width="58">KODE</th>
        <th>KELOMPOK</th>
        <th width="230" class="ac">ACTIONS</th>
      </tr>
      <?php
		$DataPerPageF = 17;
		include "FilePagingTop.php";

		$nSQL= "SELECT * FROM ref_rek_2 WHERE Kd_Rek LIKE '".$KdRek1."._' ORDER BY Kd_Rek LIMIT $Offset, $DataPerPage";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			if ($Lev>1)
			{
				$nDel="NoDel";
				$zRo=0;
			}
			else
			{
				$mSQL= "SELECT Kd_Rek, Nm_Rek FROM ref_rek_3 WHERE Kd_Rek LIKE '".$mRo['Kd_Rek']."._' ORDER BY Kd_Rek";
				$mRs = mysql_query($mSQL) or die(mysql_error());
				$zRo = mysql_num_rows($mRs);
				if ($zRo > 0)
					{$nDel="NoDel";}
				else
					{$nDel="";}
			}
			?>
      <tr height="22" style="cursor: pointer" title="clik disini untuk melihat rincian...!" onmouseover="this.style.cursor=&#39;pointer&#39"> 
        <td <?=fBackCLR($iG)?> style="border-bottom: 1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
        <td style="border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$mRo['Kd_Rek']?></td>
        <td style="border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?=$iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?=$mRo['Nm_Rek']?></td>
        <td style="border-bottom: 1px dotted #CCCCCC" class="ac" <?=fBackCLR($iG)?> >[&nbsp;
		<a href="<?="Ref_Kode_Rekn_3.php?FrmG=".($_GET['FrmG'] ?? '')."&IdL=".($_GET['IdL'] ?? '')."&KdRek1=".($_GET['KdRek1'] ?? '')."&KdRek2=".$mRo['Kd_Rek']?>" class="ico prev">VIEW</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;
		[&nbsp;<a href="#" class="ico edit" onclick="EditData('800','450','<?=$Lev?>','<?=$mRo['IDT']?>','<?=($_GET['FrmG'] ?? '')?>','<?=($_GET['IdL'] ?? '')?>'); return false;">EDIT</a>&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;
		[&nbsp;<a href="#" class="ico del" onclick="P_DeleteR('<?=$mRo['IDT']?>','<?=$nDel?>','<?=$ReO?>')">DELETE</a>&nbsp;]
		</td>
      </tr>
      <tr> 
        <td colspan="4"> <table id="detail<?=$iG?>" cellpadding="3" border="0" width="900" style="border:1px solid #C0C0C0; font-family: Calibri; font-size: 9pt; font-style: Italic; color: #800000; display: none; border-collapse:collapse">
            <?php
			if ($zRo > 0)
			{
				while ($rRo = mysql_fetch_assoc($mRs))
				{
				?>
            <tr> 
              <td width="4%">&nbsp;</td>
              <td width="5%"> 
                <?=$rRo['Kd_Rek']?>
              </td>
              <td width="1%">:</td>
              <td width="80%"> 
                <?=$rRo['Nm_Rek']?>
              </td>
              <td width="10%">&nbsp; </td>
            </tr>
            <?php
				}
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
        <td colspan="2">Data tidak ditemukan..!!</td>
        <td>&nbsp;</td>
      </tr>
      <?php
		}
		?>
      <tr height="30">
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
        <td colspan="2" style="border-top:1px solid #CCCCCC">[&nbsp;<a href="#" class="ico add" onclick="AddItem('800','450','<?=$KdRek1?>','<?=$Lev?>','<?=($_GET['FrmG'] ?? '')?>','<?=($_GET['IdL'] ?? '')?>'); return false;">&nbsp;ADD ITEM</a>&nbsp;]&nbsp;&nbsp;&nbsp;[&nbsp;
		<a href="<?=$_SERVER['PHP_SELF']."?FrmG=".($_GET['FrmG'] ?? '')."&IdL=".($_GET['IdL'] ?? '')."&Page=".($_GET['Page'] ?? '')."&iG=".($_GET['iG'] ?? '')."&KdRek1=".$KdRek1 ?>" class="ico reff">&nbsp;REFRESH</a>&nbsp;]</td>
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
      </tr>
    </table>
	  <?php
		$nSQL= "SELECT COUNT(*) AS JmlRc FROM ref_rek_2 WHERE Kd_Rek LIKE '".$KdRek1.".__'";
		$fUlrR= "FrmG=".($_GET['FrmG'] ?? '')."&IdL=".($_GET['IdL'] ?? '')."&KdRek1=".$KdRek1."&";
		include "FilePagingBot2.php";
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

	function AddItem(w,h,KdRek1,Lev,FrmG,IdL)
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
			URL_Top = "Form_Kode_Rekn2_Top.php?FrmG="+FrmG+"&IdL="+IdL;
			URL_Mid = "Form_Kode_Rekn2_Mid.php?KdRek1="+KdRek1+"&FrmG="+FrmG+"&IdL="+IdL;
			URL_Bot = "Form_Kode_Rekn2_Bot.php";
			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}

	function EditData(w,h,Lev,IDT,FrmG,IdL)
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
			URL_Top = "Form_Kode_Rekn2_Top.php?FrmG="+FrmG;
			URL_Mid = "Form_Kode_Rekn2_Mid.php?rIDT="+IDT+"&FrmG="+FrmG+"&IdL="+IdL;
			URL_Bot = "Form_Kode_Rekn2_Bot.php";
			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}

</script>

<?php require('Connection_Close.php');?>
