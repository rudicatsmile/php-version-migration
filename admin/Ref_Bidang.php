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
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "Ref_Bidang_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG']?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
    <table align="center" class="table-list" border="0" cellspacing="0" cellpadding="0" style="width:99%">
      <tr> 
        <th width="47" class="ac">No</th>
        <th width="59">Kode</th>
        <th width="866">Nama Bidang</th>
        <th width="156" class="ac">Actions</th>
      </tr>
      <?php
	  	$iG=1;
		$DataPerPageF = 17;
		include "FilePagingTop.php";

		$nSQL= "SELECT * FROM ref_bidang order by Kd_Bidang LIMIT $Offset, $DataPerPage";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			$mSQL= "SELECT * FROM ref_unit WHERE Kd_Unit LIKE '".$mRo['Kd_Bidang'].".__' ORDER BY Kd_Unit";
			$mRs = mysql_query($mSQL) or die(mysql_error());
			$rRo = mysql_fetch_assoc($mRs);
			$zRo = mysql_num_rows($mRs);
			if ($zRo > 0)
			{$nDel="NoDel";}
			else
			{$nDel="";}
			?>
      <tr height="22" style="cursor: pointer" title="clik disini untuk melihat rincian...!" onmouseover="this.style.cursor=&#39;pointer&#39"> 
        <td <?=fBackCLR($iG)?> style="border-bottom: 1px dotted #CCCCCC; text-align:center"><?php echo $iG?>.</td>
        <td style="border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?php echo $mRo['Kd_Bidang']?></td>
        <td style="border-bottom: 1px dotted #CCCCCC" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)" <?=fBackCLR($iG)?>><?php echo $mRo['Nm_Bidang']?></td>
        <td style="border-bottom: 1px dotted #CCCCCC" class="ac" <?=fBackCLR($iG)?>><a href="#" class="ico del" onclick="P_DeleteR('<?php echo $mRo['IDT']?>','<?php echo $nDel?>','<?php echo $ReO?>')">DELETE</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="ico edit" onclick="EditData('800','450','center','<?=$mRo['IDT']?>')">EDIT</a></td>
      </tr>
      <tr> 
        <td colspan="4"> <table id="detail<?php echo $iG?>" cellpadding="3" border="0" width="900" style="border:1px solid #C0C0C0; font-family: Calibri; font-size: 9pt; font-style: Italic; color: #800000; display: none; border-collapse:collapse">
            <?php
			if ($zRo > 0)
			{
			do
				{
				?>
            <tr> 
              <td width="4%">&nbsp;</td>
              <td width="5%"> 
                <?php echo $rRo['Kd_Unit']?>
              </td>
              <td width="1%">:</td>
              <td width="80%"> 
                <?php echo $rRo['Nm_Unit']?>
              </td>
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
        <td colspan="2">Data tidak ditemukan..!!</td>
        <td>&nbsp;</td>
      </tr>
      <?php
		}
		?>
      <tr height="30">
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
        <td colspan="2" style="border-top:1px solid #CCCCCC">
		[&nbsp;<a href="#" class="ico add" onclick="AddItem('800','450','center')">&nbsp;ADD ITEM</a>&nbsp;]&nbsp;&nbsp;&nbsp;
		[&nbsp;<a href="<?php echo $_SERVER['PHP_SELF']."?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG'] ?>" class="ico reff">&nbsp;REFRESH</a>&nbsp;]</td>
        <td style="border-top:1px solid #CCCCCC">&nbsp;</td>
      </tr>
    </table>
	  <?php
		$nSQL= "SELECT COUNT(*) AS JmlRc FROM ref_bidang";
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
	
	function AddItem(w,h,pos)
	{	var win=null;
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
						$URL_Top = "Form_Bidang_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
						$URL_Mid = "Form_Bidang_Mid.php?IdL=".$_GET['IdL'];
						$URL_Bot = "Form_Bidang_Bot.php";
					?>       			
				txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFormKIB_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFormKIB_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
				win.focus()
				win.window.document.clear()
				win.window.document.write(txtHTML)
				win.window.document.close() 
				win.setTimeout("self.close()",200000000)
			}
	}

	function EditData(w,h,pos,IDT)
	{	var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = "Form_Bidang_Top.php?"+"<?="FrmG=".$_GET['FrmG']?>";
			URL_Mid = "Form_Bidang_Mid.php?rIDT="+IDT+"<?="&IdL=".$_GET['IdL']?>";
			URL_Bot = "Form_Bidang_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
</script>

<?php require('Connection_Close.php');?>
