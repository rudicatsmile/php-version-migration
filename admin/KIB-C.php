<?php require "CheckSession.php" ?>
<?php require "Connection.php" ?>
<?php require "FileFunction.php" ?>
<?php require "CheckLogin.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Simbada Kab. Hulu Sungai Tengah</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
extract($_GET);
if (isset($_GET['gUnt'])) {
	$gUnt  = $_GET['gUnt'];
} else {
	$gUnt  = "";
}
if (isset($_GET['gSub'])) {
	$gSub  = $_GET['gSub'];
} else {
	$gSub  = "";
}
if (isset($_GET['gUpb'])) {
	$gUpb  = $_GET['gUpb'];
} else {
	$gUpb  = "";
}
if (isset($_GET['gThn'])) {
	$gThn  = $_GET['gThn'];
} else {
	$gThn  = "";
}
if (isset($_GET['gBid'])) {
	$gBid  = $_GET['gBid'];
} else {
	$gBid  = "";
}
if (isset($_GET['gKel'])) {
	$gKel  = $_GET['gKel'];
} else {
	$gKel  = "";
}
if (isset($_GET['gOBJ'])) {
	$gOBJ  = $_GET['gOBJ'];
} else {
	$gOBJ  = "";
}
if (isset($_GET['gRin'])) {
	$gRin  = $_GET['gRin'];
} else {
	$gRin  = "";
}
if (isset($_GET['gFin'])) {
	$gFin  = $_GET['gFin'];
} else {
	$gFin  = "";
}
if (isset($_GET['eMuT'])) {
	$eMuT  = $_GET['eMuT'];
} else {
	$eMuT  = "";
}

if (isset($_GET['gExt'])) {
	$gExt  = $_GET['gExt'];
} else {
	$gExt  = "N";
}

if ($gKdBar != "") {
	if ($gKdBar == "All") {
		$tKdBar = "";
	} else if ($gKdBar == "N") {
		$tKdBar = "AND kode_bar=''";
	} else if ($gKdBar == "Y") {
		$tKdBar = "AND kode_bar<>''";
	}
} else {
	$tKdBar = "";
}

$gFin = addslashes($gFin);
if ($gFin != "") {
	$gBid  = "All";
	$gKel  = "All";
	$gOBJ  = "All";
	$gRin  = "All";
}
if ($gThn == "") {
	$gThn = "____";
}
if ($gThn == "All") {
	$gThn = "____";
}
$rKib = "03.__";
$gRf = "BNG";
?>

<body>
	<?php require "FileMenu.php"; ?>
	<form name="myfrm" method="post" action="<?php echo "KIB-C_.php?FrmG=" . $_GET['FrmG'] . "&IdL=" . $_GET['IdL'] ?>">
		<input type="hidden" name="Simpan">
		<input type="hidden" name="CritIDT" size="10">
		<table border="0" align="center" style="width:99%">
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="84">UNIT</td>
				<td width="511">
					<select class="boxs" name="fUnt" id="fUnt" tabindex="0" style="width: 470px" onchange="this.form.submit()">
						<?php
						if ($Lev > 1) {
							$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit WHERE Kd_Unit = '" . substr($SkP, 0, 11) . "' ORDER BY Kd_Unit";
						} else {
							$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
						}
						$nRs = mysql_query($nSQ) or die(mysql_error());
						$mRo = mysql_fetch_assoc($nRs);
						$tRo = mysql_num_rows($nRs);
						if ($tRo > 0) {
							if ($gUnt == "") {
								$gUnt = $mRo['Kd_Unit'];
							}
							do {
								$sel = "";
								if ($mRo['Kd_Unit'] == $gUnt) {
									$sel = "selected";
									$zUnt = $mRo['Kd_Unit'];
								}
								echo '<option ' . $sel . ' value="' . $mRo['Kd_Unit'] . '">' . $mRo['Kd_Unit'] . " : " . $mRo['Nm_Unit'] . '</option>';
							} while ($mRo = mysql_fetch_assoc($nRs));
						}
						?>
					</select>
				</td>
				<td width="106">OBJEK.</td>
				<td>
		<select class="boxs" name="fBid" tabindex="0" style="width:480px" onchange="P_Change()">
		<option value=""></option>
		<option <?php if ($gBid=="All") {echo "selected";} ?> value="All">All</option>
		<?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '1.3.3.__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gBid!="All")
            {
				if ($gBid=="") {$gBid=$mRo['Kd_Aset'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gBid) 
				{
					$sel ="selected";
					$zBid=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
				<td>&nbsp;</td>
				<td align="right"><input type="button" name="B35" value="INPUT DATA" onclick="InputData('950','520','center')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
			</tr>
			<tr>
				<td width="84">SUB UNIT</td>
				<td width="511">
					<select class="boxs" name="fSub" id="fSub" tabindex="0" style="width: 470px" onchange="this.form.submit()">
						<?php
						if ($Lev <= 2) {
							echo "<option value='All'>All</option>";
							$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '" . $gUnt . ".__' ORDER BY Kd_Sub";
						} else {
							$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '" . $gUnt . "." . substr($SkP, 12, 2) . "' ORDER BY Kd_Sub";
						}
						$nRs = mysql_query($nSQ) or die(mysql_error());
						$mRo = mysql_fetch_assoc($nRs);
						$tRo = mysql_num_rows($nRs);
						if ($tRo > 0) {
							if ($gSub == "") {
								$gSub = $mRo['Kd_Sub'];
							}
							#if (substr($gSub,0,11)!=$gUnt) {$gSub=$mRo['Kd_Sub'];}
							do {
								$sel = "";
								if ($mRo['Kd_Sub'] == $gSub) {
									$sel = "selected";
									$zSub = $mRo['Kd_Sub'];
								}
								echo '<option ' . $sel . ' value="' . $mRo['Kd_Sub'] . '">' . $mRo['Kd_Sub'] . " : " . $mRo['Nm_Sub'] . '</option>';
							} while ($mRo = mysql_fetch_assoc($nRs));
						}
						?>
					</select>
				</td>
				<td width="106">RINCAN OBJ </td>
				<td> <select class="boxs" name="fKel" tabindex="0" style="width: 480px" onchange="this.form.submit()">
						<option <?php if ($gKel == "All") {
									echo "selected";
								} ?> value="All">All</option>
						<?php
						$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '" . $gBid . ".__' ORDER BY Kd_Aset";
						$nRs = mysql_query($nSQ) or die(mysql_error());
						$mRo = mysql_fetch_assoc($nRs);
						$tRo = mysql_num_rows($nRs);
						if ($tRo > 0) {
							if ($gKel != "All") {
								if ($gKel == "") {
									$gKel = $mRo['Kd_Aset'];
								}
								if (substr($gKel, 0, 8) != $gBid) {
									$gKel = $mRo['Kd_Aset'];
								}
							}
							do {
								$sel = "";
								if ($mRo['Kd_Aset'] == $gKel) {
									$sel = "selected";
									$zKel = $mRo['Kd_Aset'];
								}
								echo '<option ' . $sel . ' value="' . $mRo['Kd_Aset'] . '">' . $mRo['Kd_Aset'] . " : " . $mRo['Nm_Aset'] . '</option>';
							} while ($mRo = mysql_fetch_assoc($nRs));
						}
						?>
					</select> </td>
				<td>&nbsp;</td>
				<td align="right">
					<!--input type="button" name="B36" value="DOKUMEN KIB" onclick="OpenKIB('650','350','center')"  style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /-->
					<input type="button" name="B36" value="DOKUMEN KIB" onclick="P_OpenDoc('800','400','<?= $_GET['IdL'] ?>')" style="color:#0000FF; width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
				</td>
			</tr>
			<tr>
				<td width="84">UPB</td>
				<td width="511">
					<select class="boxs" name="fUpb" id="fUpb" tabindex="0" style="width: 470px" onchange="this.form.submit()">
						<?php
						if ($Lev <= 3) {
							echo "<option value='All'>All</option>";
							$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '" . $gUnt . "." . substr($gSub, 12, 2) . ".___' ORDER BY Kd_Upb";
						} else {
							$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '" . $gUnt . "." . substr($gSub, 12, 2) . "." . substr($SkP, -3, 3) . "' ORDER BY Kd_Upb";
						}
						$nRs = mysql_query($nSQ) or die(mysql_error());
						$mRo = mysql_fetch_assoc($nRs);
						$tRo = mysql_num_rows($nRs);
						if ($tRo > 0) {
							if ($gUpb == "") {
								$gUpb = $mRo['Kd_Upb'];
							}
							do {
								$sel = "";
								if ($mRo['Kd_Upb'] == $gUpb) {
									$sel = "selected";
									$zUpb = $mRo['Kd_Upb'];
								}
								echo '<option ' . $sel . ' value="' . $mRo['Kd_Upb'] . '">' . $mRo['Kd_Upb'] . " : " . $mRo['Nm_Upb'] . '</option>';
							} while ($mRo = mysql_fetch_assoc($nRs));
						}
						?>
					</select>
				</td>
				<td width="106">SUB ROBJ </td>
				<td> <select class="boxs" name="fOBJ" tabindex="0" style="width: 480px" onchange="this.form.submit()">
						<option <?php if ($gOBJ == "All") {
									echo "selected";
								} ?> value="All">All</option>
						<?php
						$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '" . $gBid . "." . substr($gKel, -2, 2) . ".__' ORDER BY Kd_Aset";
						$nRs = mysql_query($nSQ) or die(mysql_error());
						$mRo = mysql_fetch_assoc($nRs);
						$tRo = mysql_num_rows($nRs);
						if ($tRo > 0) {
							if ($gOBJ != "All") {
								if ($gOBJ == "") {
									$gOBJ = $mRo['Kd_Aset'];
								}
								if (substr($gOBJ, 0, 11) != $gKel) {
									$gOBJ = $mRo['Kd_Aset'];
								}
							}
							do {
								$sel = "";
								if ($mRo['Kd_Aset'] == $gOBJ) {
									$sel = "selected";
									$zOBJ = $mRo['Kd_Aset'];
								}
								echo '<option ' . $sel . ' value="' . $mRo['Kd_Aset'] . '">' . $mRo['Kd_Aset'] . " : " . $mRo['Nm_Aset'] . '</option>';
							} while ($mRo = mysql_fetch_assoc($nRs));
						}
						?>
					</select></td>
				<td>&nbsp;</td>
				<td align="right"><input type="button" name="B37" value="EXPORT DATA" disabled onclick="P_ToExcel('800','400','center','ToExcel/KIB_C_ToExcel')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
			</tr>
			<tr>
				<td>TAHUN</td>
				<td valign="middle">
					<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
						<tr>
							<td width="24%"> <select class="boxs" name="fThn" style="width: 60px" tabindex="0" onchange="this.form.submit()">
									<option <?php if ($gThn == "All") {
												echo "selected";
											} ?> value="All">All</option>
									<?php
									for ($nThn = 1900; $nThn <= 2030; $nThn++) {
										$sel = "";
										if ($gThn == $nThn) {
											$sel = "selected";
										}
										echo '<option ' . $sel . ' value="' . $nThn . '">' . $nThn . '</option>';
									}
									?>
								</select> </td>
							<td width="8%">FIND</td>
							<td width="35%"> <input class="text" type="text" name="fFind" id="fFind" value="<?php echo $gFin ?>" placeholder='Search' style="width:200px; font-family: Calibri; font-size: 10pt; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
							<td width="1%">&nbsp;</td>
							<td width="26%"> <input type="button" name="B39" value="GO" onclick="P_Find()" style="width: 50px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
								<?php if ($Lev == "0" || $Lev == "100") { ?>
									<input type="hidden" name="B392" value="Import" disabled onclick="P_Import(); return false;" style="width: 55px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
								<?php } ?>
							</td>
							<td width="6%">&nbsp;</td>
						</tr>
					</table>
				</td>
				<td>SUB SUB ROBJ </td>
				<td width="478">
					<select class="boxs" name="fRin" tabindex="0" style="width: 480px" onchange="this.form.submit()">
						<option <?php if ($gRin == "All") {
									echo "selected";
								} ?> value="All">All</option>
						<?php
						$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_7 WHERE Kd_Aset LIKE '" . $gBid . "." . substr($gKel, -2, 2) . "." . substr($gOBJ, -2, 2) . ".___' ORDER BY Kd_Aset";
						$nRs = mysql_query($nSQ) or die(mysql_error());
						$mRo = mysql_fetch_assoc($nRs);
						$tRo = mysql_num_rows($nRs);
						if ($tRo > 0) {
							if ($gRin != "All") {
								if ($gRin == "") {
									$gRin = $mRo['Kd_Aset'];
								}
								if (substr($gRin, 0, 14) != $gOBJ) {
									$gRin = $mRo['Kd_Aset'];
								}
							}
							do {
								$sel = "";
								if ($mRo['Kd_Aset'] == $gRin) {
									$sel = "selected";
									$zRin = $mRo['Kd_Aset'];
								}
								echo '<option ' . $sel . ' value="' . $mRo['Kd_Aset'] . '">' . $mRo['Kd_Aset'] . " : " . $mRo['Nm_Aset'] . '</option>';
							} while ($mRo = mysql_fetch_assoc($nRs));
						}
						?>
					</select>
				</td>
				<td width="7">&nbsp;</td>
				<td width="98" align="right">
					<input type="button" name="B38" value="CARI REKENING" onclick="OpenAccNumb('600','500','center')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>ASET / EXTRACOMP</td>
				<td><select class="boxs" name="fExt" style="width: 120px" tabindex="0" onchange="this.form.submit()">
						<option <?php if ($gExt == "All") {
									echo "selected";
								} ?> value="All">ALL</option>
						<option <?php if ($gExt == "N") {
									echo "selected";
								} ?> value="N">A S E T</option>
						<option <?php if ($gExt == "Y") {
									echo "selected";
								} ?> value="Y">EXTRACOM</option>
					</select></td>
				<td>&nbsp;</td>
				<td><label style="float:right; color:#FF0000"><input type="checkbox" name="fSdhMutasi" <?php if ($eMuT != "") {
																											echo "checked";
																										} ?> onclick="P_Find()" value="ON" />Sudah Mutasi</label></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>Kode Bar<div id="loadingImg" style="width:40px;height:10px;display:none"><img src="Images/loading3.gif" alt="" width="40" height="40"></div>
				</td>
				<td>
					<select class="boxs" name="fKdBar" style="width: 120px" tabindex="0" onchange="this.form.submit()">
						<option <?php if ($gKdBar == "All") {echo "selected";} ?> value="All">ALL</option>
						<option <?php if ($gKdBar == "N") {echo "selected";} ?> value="N">Belum QR</option>
						<option <?php if ($gKdBar == "Y") {echo "selected";} ?> value="Y">Sudah QR</option>
					</select>
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<table border="0" align="center" id="tbViewData" style="width:99%">
			<tr>
				<td>
					<div id="ViewDATA" style="height:20px; width:500px; overflow:auto; display:none"></div>
				</td>
			</tr>
		</table>
		<table align="center" class="table-list" border="0" cellspacing="0" cellpadding="0" style="width:99%">
			<tr>
				<th width="31" class="ac">No</th>
				<th width="100" class="al">Referensi</th>
				<th width="98" class="al">Kode Aset</th>
				<th width="52" class="ac">Register</th>
				<th style="padding-left:2px">Nama Aset</th>
				<th width="184">LOKASI</th>
				<th width="76" class="ac">Perolehan</th>
				<th width="75" class="ac">Tgl.Mutasi</th>
				<th width="91" class="ar">Nilai Perolehan </th>
				<th width="93" class="ar">Nilai Akhir </th>
				<th width="300" class="ac">Actions</th>
			</tr>
			<?php
			if ($eMuT != "") {
				$tMuTZ = "_mutasi";
			} else {
				$tMuTZ = "";
			}
			if ($gUpb == "All") {
				$zUpb = $zSub . ".%";
			}
			if ($gSub == "All") {
				$zUpb = $zUnt . ".%.%";
			}
			if ($gExt == "All") {
				$zExt = "%";
			} else {
				$zExt = $gExt;
			}

			if ($gThn == "All") {
				$rThn = "____";
			} else {
				$rThn = $gThn;
			}

			if ($gBid == "All") {
				$rBid = "_._._.__";
				$rKel = "__";
				$rOBJ = "__";
				$rRin = "___";
			} else {
				if ($gKel == "All") {
					$rBid = $zBid;
					$rKel = "__";
					$rOBJ = "__";
					$rRin = "___";
				} else {
					if ($gOBJ == "All") {
						$rBid = $zBid;
						$rKel = substr($zKel, -2, 2);
						$rOBJ = "__";
						$rRin = "___";
					} else {
						if ($gRin == "All") {
							$rBid = $zBid;
							$rKel = substr($zKel, -2, 2);
							$rOBJ = substr($zOBJ, -2, 2);
							$rRin = "___";
						} else {
							$rBid = $gBid;
							$rKel = substr($gKel, -2, 2);
							$rOBJ = substr($gOBJ, -2, 2);
							$rRin = substr($gRin, -3, 3);
						}
					}
				}
			}
			include "FilePagingTop.php";
			if ($gFin != "") {
				$fFindSy = "AND (No_Pengadaan LIKE '%" . $gFin . "%' OR Ref_KdpToAset LIKE '%" . $gFin . "%' OR Nm_Aset LIKE '%" . $gFin . "%' OR No_Register LIKE '%" . $gFin . "%' OR Harga LIKE '%" . $gFin . "%' OR Referensi LIKE '%" . $gFin . "%' OR Ref_Group LIKE '%" . $gFin . "%' OR Kd_Aset_108 LIKE '%" . $gFin . "%' OR Keterangan LIKE '%" . $gFin . "%' OR Lokasi LIKE '%" . $gFin . "%' OR Pencatat LIKE '%" . $gFin . "%')";
			} else {
				$fFindSy = "";
			}

			$nSQL = "SELECT * FROM ta_kib_108" . $tMuTZ . " WHERE referensi LIKE '$gRf%' AND extracom LIKE '" . $zExt . "' AND Kd_UPB LIKE '" . $zUpb . "' AND Kd_Aset_108 LIKE '" . $rBid . "." . $rKel . "." . $rOBJ . "." . $rRin . "' AND Tgl_Perolehan LIKE '" . $rThn . "-__-__' " . $fFindSy . $tKdBar . " ORDER BY Kd_Aset_108, Tgl_Perolehan ,No_Register LIMIT $Offset, $DataPerPage";
			#echo $nSQL;
			$nSQLForMAP = str_replace("'", "^", $nSQL);
			echo "
            			<div align='right'>
            				<input type='button' name='B36A' value='Lokasi Pada Peta' onclick='OpenAccMAP()'  
            					style='color:#0000FF; width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; 
            					padding-bottom: 0px' />&nbsp;&nbsp;&nbsp;
            			</div>	";

			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0) {
				do {
					$gTGL = (int)substr($mRo['Tgl_Perolehan'], 0, 4);

					if ((substr((int)$mRo['Tgl_Perolehan'], 0, 4) >= 2022) && $mRo['No_Pengadaan'] == "") {
						$TtK = "<div style='color:#ff0000; float:right'>**&nbsp;</div>";
					} else {
						$TtK = "";
					}

					if ($mRo['Ref_Group'] != "") {
						$RegGrp = $mRo['Ref_Group'];
					} else {
						$RegGrp = "";
					}

					$gCEU = fGlobal("Referensi", "ta_usulan_rinci_108", "Ref_Aset:Kd_UPB", $mRo['Referensi'] . ":" . $mRo['Kd_UPB'], "=:=", "", "");
					if ($gCEU != "") {
						$gCEK = fGlobal("IDT", "ta_usulan_verifikasi_rinci_108", "Ref_Aset:Kd_UPB:Eksekusi", $mRo['Referensi'] . ":" . $mRo['Kd_UPB'] . ":Sudah", "=:=:=", "", "");
						if ($gCEK != '') {
							$Blnk = "";
							$gSkM = "";
							$BT   = "";
						} else {
							$gSkP = substr(fGlobal("To_UPB", "ta_usulan_rinci_108", "Ref_Aset:Kd_UPB", $mRo['Referensi'] . ":" . $mRo['Kd_UPB'], "=:=", "", ""), 0, 11);
							$gSkM = "";
							if ($gSkP != "" && $gSkP != $SkT) {
								$gSkM = "<br><i>Ke:" . fGlobal("Nm_Unit", "ref_unit", "Kd_Unit", substr($gSkP, 0, 11), "=", "", "") . "</i>";
							}
							$BT = "<font style='background:#97928A; color:#fff'>Usulan Mutasi : " . $gCEU . $gSkM . "</font><br>";

							$Blnk = "; background:#F1F8A0";
						}
					} else {
						$Blnk = "";
						$BT = "";
					}


					$gCeU = $mRo['Ref_Mutasi'];
					if ($gCeU != "") {
						$SG = fGlobal("Kd_UPB", "ta_kib_108_mutasi", "Referensi_To:Kd_UPB_To", $mRo['Referensi'] . ":" . substr($mRo['Kd_UPB'], 0, 11) . "%", "=:LIKE", "", "");
						$SG = fGlobal("Nm_Unit", "ref_unit", "Kd_Unit", substr($SG, 0, 11), "=", "", "");
						$BV = "<font style='background:#000000; color:#fff'>Mutasi masuk dari " . $SG . "<br>Ref. " . $mRo['Ref_Mutasi'] . "</font><br>";
					} else {
						$BV = "";
					}

					$gAda = "";
					if ($mRo['Tgl_Mutasi'] == "0000-00-00") {
						$gAda = fGlobal("IDT", "ta_kib_post_108", "Referensi:Kd_UPB:Ref_Mutasi", $mRo['Referensi'] . ":" . substr($mRo['Kd_UPB'], 0, 11) . "%:", "=:LIKE:<>", "", "");
						if ($gAda) {
							$gAda = "**";
						}
					}
					if ($tMuTZ != "") {
						$BV = "";
					}

					$gHRG = $mRo['Harga'];
					$mUPB = $mRo['Kd_UPB'];
					$gNIa = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108" . $tMuTZ, "Referensi:Kd_UPB", $mRo['Referensi'] . ":" . $mUPB, "=:LIKE", "", "");

					$gNIb = 0;
					if ($gNIb != 0) {
						$gNIL = $gNIa - $gNIb;
					} else {
						$gNIL = $gNIa;
					}

					$dCK = "";
					$gNIc = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108", "Referensi", $mRo['Referensi'], "=", "", "");
					if ($gNIc <> $gNIa) {
						$dCK  = "<br><font style='color:#0000FF'>????</font>";
						$SW = "UPDATE ta_kib_post_108 SET kd_upb='" . $mUPB . "' WHERE Referensi='" . $mRo['Referensi'] . "' AND kd_upb LIKE '" . substr($mUPB, 0, 11) . "%' AND kd_upb<>'" . $mUPB . "'";
						echo $SW . "<br>";
						mysql_query($SW);
					}

					if ($gHRG > $gNIL) {
						$ClR = "; color: #FF0000";
					} else if ($gHRG < $gNIL) {
						$ClR = "; color: #0000FF";
					} else {
						$ClR = "";
					}

					#$NmB=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");
					$NmB = $mRo['Nm_Aset'];

					//Kunci Data
					$KiB = "C";
					$ThN = substr($mRo['Tgl_Perolehan'], 0, 4);
					$gSK = substr($mRo['Kd_UPB'], 0, 11);
					$CeK = CekKey($gSK, $ThN, 'Kib_' . $KiB, '');
					if ($CeK == 'Y') {
						$del = "lock";
					} else {
						$del = "del";
					}
					$NeN = fGlobal("count(*)", "ta_kib_post_108" . $tMuTZ, "Referensi:HasilMerger", $mRo['Referensi'] . ":Y", "=:=", "", "");

					$Ujung = substr($mRo['Kd_UPB'], -3, 3);
					if ($Ujung == '000') {
						$kdUPB  = "<br><font style='color:#ff0000; font-style:italic'>error kode upb..!!</font>";
					} else {
						$kdUPB  = "";
					}
					$Kd108K = $mRo['Kd_Aset_108'];
					if ($Kd108K == '') {
						$kd108  = "<br><font style='color:#ff0000; font-style:italic'>Kode aset 108..??</font>";
					} else {
						$kd108  = "<br>" . $Kd108K;
					}

					$KdPTA = $mRo['Ref_KdpToAset'];
					$RfPTA  = "";
					if ($KdPTA != '') {
						$RfPTA  = "<br>" . $KdPTA;
					}

					$BARKODE = "";
					if ($mRo['kode_bar'] != "") {
						#$tanggal_scan = fConvertDateShort(fGlobal("Recorded_map","ta_kib_108_barcode","kode_bar",$mRo['kode_bar'],"=","",""));
						#$user_scan = fGlobal("userName","ta_kib_108_barcode","kode_bar",$mRo['kode_bar'],"=","","");
						$dtScan = fGlobal("Recorded_map:userName", "ta_kib_108_barcode", "kode_bar", $mRo['kode_bar'], "=", "", "");
						if ($dtScan) {
							$dtScan       = explode(":", $dtScan);
							$tanggal_scan = fConvertDateShort($dtScan[0]);
							$user_scan    = $dtScan[1];
						}
						$BARKODE = "<font style='background:#FF0000; color:#FFFFFF'>Scan QR SIMANDOR tanggal : " . $tanggal_scan . " oleh : " . $user_scan . " [" . $mRo['kode_bar'] . "]</font><br>";
					}
					/*
			$ImPORT='YAxx';
			$Dipla='Ya';
			$Exec ='No';
			
			if ($ImPORT=='YA')
			{
				$aTR = fGlobal("count(*)","atribusi_c","kode_skpd:register_new",$gSK.":".$mRo['No_Register'],"=:=","","");
				$aTP = fGlobal("count(*)","ta_kib_post_108","referensi:kd_upb",$mRo['Referensi'].":".$mRo['Kd_UPB'],"=:=","","");
				$aHR = fGlobal("IfNull(sum(Harga_Bertambah),0)","atribusi_c","kode_skpd:register_new",$gSK.":".$mRo['No_Register'],"=:=","","");
				
				if ($aTR > 1 && $aTR > $aTP && $aHR==$gNIL)
				{
					callImportAtribusi_CDE('atribusi_c',$mRo['No_Register'],$mRo['Referensi'],$mRo['Kd_Aset_108'],$mRo['Kd_UPB'],$Dipla,$Exec);
				}
			}
			*/
			?>
					<tr height="40" style="cursor: pointer <?= $Blnk ?>" onmouseover="this.style.cursor=&#39;pointer&#39" <?= fBackCLR($iG) ?>>
						<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?= $iG ?>.</td>
						<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?= $mRo['Referensi'] . $dCK . $kdUPB . $RfPTA ?></td>
						<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?= $mRo['Kd_Aset_108'] ?></td>
						<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center" title="<?= $aTR ?> record"><?= $mRo['No_Register'] ?></td>
						<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px; padding-right:2px"><?= $BARKODE . $NmB . $TtK ?></td>
						<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px; padding-right:2px">
							<?php
							if ((int) strlen($mRo['Lokasi']) > 70) {
								echo $BV . $BT . substr($mRo['Lokasi'], 0, 70) . " .....";
							} else {
								echo $BV . $BT . $mRo['Lokasi'];
							}
							?>
						</td>
						<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?= fConvertDateShort($mRo['Tgl_Perolehan']) ?></td>
						<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?php if ($mRo['Tgl_Mutasi'] != "0000-00-00") {
																																echo fConvertDateShort($mRo['Tgl_Mutasi']);
																															} ?><?= $gAda ?></td>
						<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-right:2px" align="right"> <?= fConvertToRupiah($mRo['Harga']) ?></td>
						<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-right:2px <?= $ClR ?>" align="right" title="<?= $aTR ?> record"><?= fConvertToRupiah($gNIL) ?></td>
						<td style="border-bottom: #999999 dotted 1px; text-align:center">
							<a href="#" class="ico docu" onclick="P_OpenKibar('800','400','<?= $mRo['IDT'] ?>','<?= $_GET['IdL'] ?>'); return false">&nbsp;Kibar</a>&nbsp;|&nbsp;
							<a href="#" class="ico prev" onclick="P_Tabel('850','450','<?= $mRo['Referensi'] ?>','<?= substr($mRo['Kd_UPB'], 0, 11) ?>','<?= $_GET['IdL'] ?>'); return false">Ms. Manfaat</a>
							<?php if ($eMuT == "") { ?>
								&nbsp;|&nbsp;
								<a href="#" class="ico edit" onclick="EditData('1020','550','center','<?= $mRo['IDT'] ?>'); return false">Edit</a>&nbsp;|&nbsp;
								<a href="#" class="ico merg" onclick="MergerData('<?= $ReO ?>','<?= $NeN ?>','<?= $CeK ?>','<?= $ThN ?>','<?= $KiB ?>','950','525','center','<?= $mRo['IDT'] ?>','<?= $_GET['IdL'] ?>'); return false">Merger</a>&nbsp;
								<?php if ($Lev <= 1) { ?>
									|&nbsp;<a href="#" class="ico <?= $del ?>" onclick="P_DeleteR('<?= $NeN ?>','<?= $CeK ?>','<?= $ThN ?>','<?= $KiB ?>','<?= $mRo['IDT'] ?>','<?= $RegGrp ?>','<?= $ReO ?>'); return false">Delete</a>
								<?php } ?>
							<?php } ?>
						</td>
					</tr>
				<?php
					$iG++;
				} while ($mRo = mysql_fetch_assoc($nRs));
			} else {
				?>
				<tr>
					<td></td>
					<td colspan="4">Data tidak ditemukan..!!</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			<?php
			}
			?>
		</table>
		<!-- Pagging -->
		<?php
		$nSQL = "SELECT COUNT(*) AS JmlRc FROM ta_kib_108" . $tMuTZ . " WHERE referensi LIKE '$gRf%' AND extracom LIKE '$zExt' AND Kd_UPB LIKE '" . $zUpb . "' AND Kd_Aset_108 LIKE '" . $rBid . "." . $rKel . "." . $rOBJ . "." . $rRin . "' AND Tgl_Perolehan LIKE '" . $rThn . "-__-__' " . $fFindSy . $tKdBar;
		$fUlrR = "FrmG=" . $_GET['FrmG'] . "&IdL=" . $_GET['IdL'] . "&gExt=" . $gExt . "&gFin=" . $gFin . "&gUnt=" . $zUnt . "&gSub=" . $gSub . "&gUpb=" . $gUpb . "&gThn=" . $gThn . "&gBid=" . $gBid . "&gKel=" . $gKel . "&gOBJ=" . $gOBJ . "&gRin=" . $gRin . "&gKdBar=" . $gKdBar . "&";
		include "FilePagingBot.php";
		?>
		<!--/div-->
		<!-- Table --></div>
		<!-- End Content -->
	</form>
</body>

</html>
<script language="javascript">
	objfrm = document.myfrm;

	function P_Change()
	{
		objfrm.fFind.value = "";
		objfrm.submit();
	}

	function OpenAccMAP() {
		var w = '850';
		var h = '600';
		var pos = 'center';
		var win = null;
		var txtHTML = "";
		var iErrors = 0;
		LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
		TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
		settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win = window.open('', '', settings);
		if (win != null) {
			win.window.document.open()
			URL_Top = "UploadIMG_Top.php?FrmG=Lokasi Peta -> KIB A (ASET TANAH)";
			URL_Mid = "FindMAP_Mid.php?" + "<?= "rCRT=a&rIDT=" . $rIDT . "&nSQL=" . $nSQLForMAP . "&IdL=" . $_GET['IdL'] ?>";
			URL_Bot = "UploadIMG_Bot.php";
			txtHTML = "<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='" + URL_Top + "' scrolling='no'><frame name='WinFindAcc_Mid' src='" + URL_Mid + "' scrolling='auto'><frame name='WinFindAcc_Bot' src= '" + URL_Bot + "' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close()
			win.setTimeout("self.close()", 200000000)
		}
	}

	function P_DeleteR(NeN, KeY, ThN, KiB, xA, xB, xR) {
		if (NeN > 0) {
			alert('Access denied, data sudah memiliki nilai hasil merger, silahkan RESTORE atau KAPITALISASI lebih dulu..!!');
			return false;
		}
		if (KeY == 'Y') {
			alert('Access denied, data kib ' + KiB + ' tahun ' + ThN + ' sudah terkunci..!!');
			return false;
		}
		if (xR == "Y") {
			window.alert('<?= TxReadOnly ?>');
			return false;
		}
		if (xB != "") {
			window.alert("Teknis input menggunakan fasilitas GROUP, penghapusan langsung belum diperbolehkan, \ngunakan fasilitas penghapusan dengan cara mengurangi jumlah item aset ...!");
		} else {
			var AN = confirm("Hapus data aset..?!!");
			if (AN) {
				objfrm.CritIDT.value = xA;
				objfrm.Simpan.value = "DeleteRecord";
				objfrm.submit();
			}
		}
	}

	function P_Find() {
		objfrm.Simpan.value = "Find";
		objfrm.submit();
	}

	function P_ToExcel(w, h, pos, doc) {
		var win = null;
		var txtHTML = "";
		var iErrors = 0;
		LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
		TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
		URL = doc + "<?= ".php?gFin=" . $gFin . "&gUnt=" . $zUnt . "&gSub=" . $zSub . "&gUpb=" . $zUpb . "&gThn=" . $gThn . "&gBid=" . $gBid . "&gKel=" . $gKel . "&gOBJ=" . $gOBJ . "&gRin=" . $gRin . "&IdL=" . $_GET['IdL'] ?>";
		settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL, '', settings);
	}

	function InputData(w, h, pos) {
		var win = null;
		var txtHTML = "";
		var iErrors = 0;
		LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
		TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
		settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win = window.open('', '', settings);
		if (win != null) {
			win.window.document.open() 
			<?php
			$URL_Top = "Form_Asset_C_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
			$URL_Mid = "Form_Asset_C_Mid.php?gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&gBid=".$zBid."&gKel=".$zKel."&gOBJ=".$zOBJ."&gRin=".$zRin."&IdL=".$_GET['IdL'];
			$URL_Bot = "Form_Asset_C_Bot.php"; 
			?>
			txtHTML = "<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='<?php echo $URL_Top ?>' scrolling='no'><frame name='WinFormKIB_Mid' src='<?php echo $URL_Mid ?>' scrolling='auto'><frame name='WinFormKIB_Bot' src= '<?php echo $URL_Bot ?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close()
			win.setTimeout("self.close()", 200000000)
		}
	}

	function OpenKIB(w, h, pos) {
		var win = null;
		var txtHTML = "";
		var iErrors = 0;
		LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
		TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
		settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win = window.open('', '', settings);
		if (win != null) {
			win.window.document.open() 
			<?php
			$URL_Top = "Open_KIB_Top.php";
			$URL_Mid = "Open_KIB_Mid.php?CrKIB=KIB_C&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
			$URL_Bot = "Open_KIB_Bot.php"; 
			?>
			txtHTML = "<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' noresize src='<?php echo $URL_Top ?>' scrolling='no'><frame name='WinOpenKIB_Mid' src='<?php echo $URL_Mid ?>' scrolling='auto'><frame name='WinOpenKIB_Bot' src= '<?php echo $URL_Bot ?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close()
			win.setTimeout("self.close()", 200000000)
		}
	}

	function OpenAccNumb(w, h, pos) {
		var win = null;
		var txtHTML = "";
		var iErrors = 0;
		LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
		TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
		settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win = window.open('', '', settings);
		if (win != null) {
			win.window.document.open() 
			<?php
			$URL_Top = "Find_Acc_Top.php?CrAcc=KIB-C&FrmG=".$_GET['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
			$URL_Mid = "Find_Acc_Mid.php?CrAcc=KIB-C&FrmG=".$_GET['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
			$URL_Bot = "Find_Acc_Bot.php"; 
			?>
			txtHTML = "<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top ?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid ?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot ?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close()
			win.setTimeout("self.close()", 200000000)
		}
	}

	function EditData(w, h, pos, IDT) {
		var win = null;
		var txtHTML = "";
		var iErrors = 0;
		LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
		TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
		settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win = window.open('', '', settings);
		if (win != null) {
			win.window.document.open()
			URL_Top = "Form_Asset_C_Top.php?" + "<?= "FrmG=" . $_GET['FrmG'] ?>";
			URL_Mid = "Form_Asset_C_Mid.php?rIDT=" + IDT + "<?= "&IdL=" . $_GET['IdL'] ?>";
			URL_Bot = "Form_Asset_C_Bot.php";
			txtHTML = "<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='" + URL_Top + "' scrolling='no'><frame name='WinFormKIB_Mid' src='" + URL_Mid + "' scrolling='auto'><frame name='WinFormKIB_Bot' src= '" + URL_Bot + "' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close()
			win.setTimeout("self.close()", 200000000)
		}
	}

	function P_Tabel(w, h, ref, upb, IdL) {
		var win = null;
		var txtHTML = "";
		var iErrors = 0;
		LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
		TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
		settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open('Tabel_Masa_Manfaat_Choise.php?ref=' + ref + '&upb=' + upb + '&IdL=' + IdL, '', settings);
	}

	function MergerData(ReO, NeN, KeY, ThN, KiB, w, h, pos, IDT, IdL) {
		if (ReO == 'Y') {
			alert('Access denied, akses readony..!!');
			return false;
		}
		if (NeN > 0) {
			alert('Access denied, data sudah memiliki nilai hasil merger, silahkan RESTORE atau KAPITALISASI lebih dulu..!!');
			return false;
		}
		if (KeY == 'Y') {
			alert('Access denied, data kib ' + KiB + ' tahun ' + ThN + ' sudah terkunci..!!');
			return false;
		}
		var win = null;
		var txtHTML = "";
		var iErrors = 0;
		LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
		TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
		settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win = window.open('', '', settings);
		if (win != null) {
			win.window.document.open()
			URL_Top = "Merger_Top.php?" + "<?= "FrmG=MERGER DATA ASET" ?>";
			URL_Mid = "Merger_Mid.php?CrT=c&rIDT=" + IDT + "&IdL=" + IdL;
			URL_Bot = "Merger_Bot.php";
			txtHTML = "<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormMRG_Top' noresize src='" + URL_Top + "' scrolling='no'><frame name='WinFormMRG_Mid' src='" + URL_Mid + "' scrolling='auto'><frame name='WinFormMRG_Bot' src= '" + URL_Bot + "' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close()
			win.setTimeout("self.close()", 200000000)
		}
	}

	function P_Import() {

		$(document).ready(function() {
			fUnt = $("#fUnt").val();
			fSub = $("#fSub").val();
			fUpb = $("#fUpb").val();
			/*
			if (fUpb=="All") {
				alert('Silahkan pilih UPB..!!'); return false;
			}
			*/

			$.ajax({
				url: "KIB-C_Import_.php",
				data: {
					fUnt: fUnt,
					fSub: fSub,
					fUpb: fUpb
				},
				type: "get",
				beforeSend: function() {
					alert('Silahkan tunggu, akan memproses import data...!!');
					$("#ViewDATA").show();
					$("#ViewDATA").text("Silahkan tunggu, sedang proses...!!");
					$("#loadingImg").show();
				},
				success: function(data) {
					$("#loadingImg").hide();
					$("#ViewDATA").html(data);
				}
			});
		});

	}

	function P_OpenDoc(w, h, IdL) {
		gUnt = objfrm.fUnt.value;
		gSub = objfrm.fSub.value;
		gUpb = objfrm.fUpb.value;

		gBid = objfrm.fBid.value;
		gKel = objfrm.fKel.value;
		gOBJ = objfrm.fOBJ.value;
		gRin = objfrm.fRin.value;

		gExt = objfrm.fExt.value;
		gThn = objfrm.fThn.value;
		gFin = objfrm.fFind.value;

		var win = null;
		var txtHTML = "";
		var iErrors = 0;
		LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
		TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
		URL = 'KIB_C_Dokumen.php?CriT=BPK&gUnt=' + gUnt + '&gSub=' + gSub + '&gUpb=' + gUpb + '&gBid=' + gBid + '&gKel=' + gKel + '&gOBJ=' + gOBJ + '&gRin=' + gRin + '&gExt=' + gExt + '&gFin=' + gFin + '&gThn=' + gThn + '&IdL=' + IdL;
		settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL, '', settings);
	}

	function P_OpenKibar(w, h, IdT, IdL) {
		var win = null;
		var txtHTML = "";
		var iErrors = 0;
		LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
		TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
		URL = 'report/P47_Kibar_C.php?IdT=' + IdT + '&IdL=' + IdL;
		settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL, '', settings);
	}

	$("#fFind").focus();
</script>