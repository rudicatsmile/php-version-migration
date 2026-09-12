<div id="cssmenu" class="cssmenu">
   <ul>
		<li class="active"><a href="<?="Home.php?IdL=".$_GET['IdL']?>">Home</a></li>
		<?php if ($SEN=='Y') {?>
			<li class="active"><a href="#">Lembar Kerja Inventarisasi (LKI)</a>
				<ul>
					<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=1.3.1&FrmG=LEMBAR KERJA INVENTARISASI (LKI) TANAH (III.A.1)&IdL=".$_GET['IdL']?>">LKI Tanah (III.A.1)</a></li>
					<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=1.3.2&FrmG=LEMBAR KERJA INVENTARISASI (LKI) PERALATAN DAN MESIN (III.A.2)&IdL=".$_GET['IdL']?>">LKI Peralatan Dan Mesin (III.A.2)</a></li>
					<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=1.3.3&FrmG=LEMBAR KERJA INVENTARISASI (LKI) GEDUNG DAN BANGUNAN (III.A.3)&IdL=".$_GET['IdL']?>">LKI Gedung dan Bangunan (III.A.3)</a></li>
					<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=1.3.4&FrmG=LEMBAR KERJA INVENTARISASI (LKI) JALAN, IRIGASI DAN JARINGAN (III.A.4)&IdL=".$_GET['IdL']?>">LKI Jalan, Irigasi dan Jaringan (III.A.4)</a></li>
					<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=1.3.5&FrmG=LEMBAR KERJA INVENTARISASI (LKI) ASET TETAP LAINNYA (III.A.5)&IdL=".$_GET['IdL']?>">LKI Aset Tetap Lainnya (III.A.5)</a></li>
					<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=1.5.3&FrmG=LEMBAR KERJA INVENTARISASI (LKI) ASET TIDAK BERWUJUD (III.A.6)&IdL=".$_GET['IdL']?>">LKI Aset Tidak Berwujud (III.A.6)</a></li>
					<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=x.x.x&FrmG=LEMBAR KERJA INVENTARISASI (LKI) BMD BELUM TERCATAT (III.A.7)&IdL=".$_GET['IdL']?>">LKI BMD Belum Tercatat (III.A.7)</a></li>
				</ul>
			</li>
		<?php } else {?>
			<li class="active"><a href="#">Referensi</a>
				<ul>
					<?php if ($Lev <= 1) {?>
						<li class="last"><a href="<?="Ref_ProKeg_1.php?FrmG=REFERENSI -> REFERENSI PROGRAM KEGIATAN 13/2006&IdL=".$_GET['IdL']?>">Program & Kegiatan 13/2006</a></li>
						<li class="last"><a href="<?="Ref_ProKeg_90_1.php?FrmG=REFERENSI -> REFERENSI PROGRAM KEGIATAN 90/2019&IdL=".$_GET['IdL']?>">Program & Kegiatan 90/2019</a></li>
						<li class="has-sub"><a href="#">Rekening</a>
							<ul>
								<li class="last"><a href="<?="Ref_Kode_Rekn_1.php?FrmG=REFERENSI -> KODE REKENING ASET PERMENDAGRI 13/2006&IdL=".$_GET['IdL']?>">Permendagri 13/2006</a></li>
								<li class="last"><a href="<?="Ref_Kode_Aset_1.php?FrmG=REFERENSI -> KODE REKENING ASET PERMENDAGRI 17/2007&IdL=".$_GET['IdL']?>">Permendagri 17/2007</a></li>
								<li class="last"><a href="<?="Ref_Kode_Aset108_1.php?FrmG=REFERENSI -> KODE REKENING ASET PERMENDAGRI 108&IdL=".$_GET['IdL']?>">Permendagri 108/2016</a></li>
								<li class="last"><a href="<?="Ref_Kode_Rekn_108_1.php?FrmG=REFERENSI -> KODE REKENING ASET PERMENDAGRI 108&IdL=".$_GET['IdL']?>">Permendagri 108/2016 New</a></li>
								<li class="last"><a href="<?="ref_kode_aset_maping_108.php?FrmG=REFERENSI -> MAPING REK 17-108&IdL=".$_GET['IdL']?>">Mapping 17 -> 108</a></li>					
							</ul>
						</li>
						<li class="has-sub"><a href="#">Lembaga</a>
							<ul>
								<li class="last"><a href="<?="Ref_Bidang.php?FrmG=REFERENSI -> BIDANG PEMERINTAHAN&IdL=".$_GET['IdL']?>">Bidang Pemerintahan</a></li>
								<li class="last"><a href="<?="Ref_Unit.php?FrmG=REFERENSI -> UNIT KERJA&IdL=".$_GET['IdL']?>">Unit Kerja</a></li>
								<li class="last"><a href="<?="Ref_Sub_Unit.php?FrmG=REFERENSI -> SUB UNIT KERJA&IdL=".$_GET['IdL']?>">Sub Unit</a></li>
								<li class="last"><a href="<?="Ref_UPB.php?FrmG=REFERENSI -> UPB&IdL=".$_GET['IdL']?>">UPB</a></li>
								<li class="last"><a href="<?="Ref_Ruangan.php?FrmG=REFERENSI -> RUANGAN&IdL=".$_GET['IdL']?>">Ruangan ()</a></li>
							</ul>
						</li>
						<li class="has-sub"><a href="#">Inventarisasi</a>
							<ul>
								<li class="last"><a href="<?="Ref_Petugas_Sensus.php?FrmG=REFERENSI -> PETUGAS SENSUS&IdL=".$_GET['IdL']?>">Petugas Sensus</a></li>
								<li class="last"><a href="<?="Ref_Usulan_Syarat.php?FrmG=REFERENSI -> SYARAT USULAN&IdL=".$_GET['IdL']?>">Syarat Usulan</a></li>
								<li class="last"><a href="<?="Ref_Usulan_Ketera.php?FrmG=REFERENSI -> KETERANGAN USULAN&IdL=".$_GET['IdL']?>">Keterangan Usulan</a></li>
							</ul>
						</li>
						<li class="last"><a href="<?="Ref_SumberDana.php?FrmG=REFERENSI -> SUMBER DANA&IdL=".$_GET['IdL']?>">Sumber Dana *</a></li>
					<?php } else { ?>
						<li class="last"><a href="<?="Ref_Unit.php?FrmG=REFERENSI -> UNIT KERJA&IdL=".$_GET['IdL']?>">Unit Kerja</a></li>
						<li class="last"><a href="<?="Ref_Sub_Unit.php?FrmG=REFERENSI -> SUB UNIT KERJA&IdL=".$_GET['IdL']?>">Sub Unit</a></li>
						<li class="last"><a href="<?="Ref_UPB.php?FrmG=REFERENSI -> UPB&IdL=".$_GET['IdL']?>">UPB</a></li>
						<li class="last"><a href="<?="Ref_Ruangan.php?FrmG=REFERENSI -> RUANGAN&IdL=".$_GET['IdL']?>">Ruangan</a></li>
					<?php } ?>
					<li class="last"><a href="<?="Ref_Rekanan.php?FrmG=REFERENSI -> REKANAN / VENDOR&IdL=".$_GET['IdL']?>">Rekanan/Vendor *</a></li>
				</ul>
			</li>
			<li class="active"><a href="#">Perencanaan</a>
				<ul>
					<?php if ($Lev <= 1) {?>
						<li class="last"><a href="<?="RKBMD_New_Security.php?FrmG=PENGAMANAN DATA&IdL=".$_GET['IdL']?>">Pengamanan Data</a></li>
					<?php } ?>
					<li class="last"><a href="<?="rkbmd_standar_kebutuhan_frm.php?FrmG=FORM STANDAR KEBUTUHAN BMD&IdL=".$_GET['IdL']?>">Standar Kebutuhan *</a></li>
					<li class="has-sub"><a href="#">Usulan BMD (SKPD)</a>
						<ul>
							<li class="last"><a href="<?="RKBMD_New_Frm.php?FrmG=FORM USULAN PENGADAAN BMD&IdL=".$_GET['IdL']?>">Pengadaan BMD</a></li>
							<li class="last"><a href="<?="RKPBMD_New_Frm.php?FrmG=FORM USULAN PEMELIHARAAN BMD&IdL=".$_GET['IdL']?>">Pemeliharaan BMD</a></li>
							
							<li class="last"><a href="<?="rkbmd_new_pmf_pmt_phs_frm.php?Frm=PMF&Crit=pengguna&FrmG=RENCANA PEMANFAATAN BARANG MILIK DAERAH &IdL=".$_GET['IdL']?>">Pemanfaatan BMD *</a></li>
							<li class="last"><a href="<?="rkbmd_new_pmf_pmt_phs_frm.php?Frm=PMT&Crit=pengguna&FrmG=RENCANA PEMINDAHTANGANAN BARANG MILIK DAERAH &IdL=".$_GET['IdL']?>">Pemindahtanganan BMD *</a></li>
							<li class="last"><a href="<?="rkbmd_new_pmf_pmt_phs_frm.php?Frm=PHS&Crit=pengguna&FrmG=RENCANA PENGHAPUSAN BARANG MILIK DAERAH&IdL=".$_GET['IdL']?>">Penghapusan  BMD *</a></li>
							
							<li class="last"><a href="<?="Open_RKBMD_Report_1.php?FrmG=LAPORAN RKBMD (SKPD)&IdL=".$_GET['IdL']?>">Laporan RKBMD</a></li>
							<li class="last"><a href="<?="Open_RKBMD_Report_2.php?FrmG=LAPORAN USULAN BMD (SKPD)&IdL=".$_GET['IdL']?>">Laporan Usulan RKBMD</a></li>
						</ul>
					</li>
					<li class="has-sub"><a href="#">Telaah Usulan BMD (Pengelola)</a>
						<ul>
							<li class="last"><a href="<?="RKBMD_New_Telaah.php?FrmG=DAFTAR USULAN PENGADAAN BMD (TELAAH)&IdL=".$_GET['IdL']?>">Telaah Usulan Pengadaan</a></li>
							<li class="last"><a href="<?="RKPBMD_New_Telaah.php?FrmG=DAFTAR USULAN PEMELIHARAAN BMD (TELAAH)&IdL=".$_GET['IdL']?>">Telaah Usulan Pemeliharaan</a></li>
							
							<li class="last"><a href="<?="rkbmd_new_pmf_pmt_phs_telaah.php?Frm=PMF&Crit=pengguna&FrmG=RENCANA PEMANFAATAN BMD (TELAAH)&IdL=".$_GET['IdL']?>">Telaah Pemanfaatan BMD *</a></li>
							<li class="last"><a href="<?="rkbmd_new_pmf_pmt_phs_telaah.php?Frm=PMT&Crit=pengguna&FrmG=RENCANA PEMINDAHTANGANAN BMD (TELAAH)&IdL=".$_GET['IdL']?>">Telaah Pemindahtanganan BMD *</a></li>
							<li class="last"><a href="<?="rkbmd_new_pmf_pmt_phs_telaah.php?Frm=PHS&Crit=pengguna&FrmG=RENCANA PENGHAPUSAN BMD (TELAAH)&IdL=".$_GET['IdL']?>">Telaah Penghapusan BMD *</a></li>
							
							<li class="last"><a href="<?="Open_RKBMD_Report_3.php?FrmG=LAPORAN USULAN PENGADAAN BMD (PENGELOLA)&IdL=".$_GET['IdL']?>">Laporan Usulan Pengadaan</a></li>
							<li class="last"><a href="<?="Open_RKBMD_Report_4.php?FrmG=LAPORAN USULAN PEMELIHARAAN BMD (PENGELOLA)&IdL=".$_GET['IdL']?>">Laporan Usulan Pemeliharaan</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="active"> <a href="#">Pengadaan</a> 
				<ul>
					<li class="has-sub"><a href="#">Program Kegiatan</a>
						<ul>
							<li class="last"><a href="<?="Ref_ProgramSKPD.php?FrmG=PENGADAAN -> PROGRAM SKPD&IdL=".$_GET['IdL']?>">Program SKPD</a></li>
							<li class="last"><a href="<?="Ref_KegiatanSKPD.php?FrmG=PENGADAAN -> KEGIATAN SKPD&IdL=".$_GET['IdL']?>">Kegiatan SKPD</a></li>
							<li class="last"><a href="<?="Ref_SubKegiatanSKPD.php?FrmG=PENGADAAN -> SUB KEGIATAN SKPD&IdL=".$_GET['IdL']?>">Sub Kegiatan SKPD</a></li>
							<li class="last"><a href="<?="Ref_RekeningSKPD.php?FrmG=PENGADAAN -> REKENING BELANJA SKPD&IdL=".$_GET['IdL']?>">Rek. Belanja SKPD</a></li>
						</ul>
					</li>
					<li class="has-sub"><a href="#">Penerimaan Berkas</a>
						<ul>
							<li class="last"><a href="<?="Penerimaan_Berkas.php?FrmG=PENGADAAN -> PENERIMAAN BERKAS&IdL=".$_GET['IdL']?>">Formulir</a></li>
							<li class="last"><a href="#" onClick="WinOpenBERKAS('650','350','<?=$_GET['IdL']?>')" title="Laporan Penerimaan Berkas">Laporan Penerimaan Berkas</a></li>
						</ul>
					</li>
					<li class="has-sub"><a href="#">Pengadaan</a>
						<ul>
							<li class="last"><a href="<?="Pengadaan.php?FrmG=PENGADAAN -> PENGADAAN&IdL=".$_GET['IdL']?>">Form Pengadaan</a></li>
							<li class="last"><a href="<?="Rekon_Pengadaan.php?FrmG=PENGADAAN -> REKON PENGADAAN&IdL=".$_GET['IdL']?>">Form Rekon Pengadaan</a></li>
							<li class="last"><a href="#" onClick="WinOpenPGADAN('650','350','<?=$_GET['IdL']?>')" title="Laporan Pengadaan">Laporan Pengadaan</a></li>
							<li class="last"><a href="#" onClick="WinOpenREKONS('650','350','<?=$_GET['IdL']?>')" title="Laporan Rekonsiliasi">Laporan Rekon Belanja & Pengadaan</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="active"><a href="#">Perolehan BMD *</a> 
				<ul>
					<li class="last"><a href="<?="P47_CP_APBD.php?FrmG=CARA PEROLEHAN -> ATAS BEBAN APBD&IdL=".$_GET['IdL']?>">F11. Atas Beban APBD *</a></li>
					<li class="last"><a href="<?="P47_CP_Other.php?JnsNon=FIIA12&FrmG=CARA PEROLEHAN -> HIBAH / SUMBANGAN (F.II.A.12)&IdL=".$_GET['IdL']?>">F12. Hibah / Sumbangan *</a></li>
					<li class="last"><a href="<?="P47_CP_Other.php?JnsNon=FIIA13&FrmG=CARA PEROLEHAN -> PERJANJIAN KONTRAK (F.II.A.13)&IdL=".$_GET['IdL']?>">F13. Perjanjian / Kontrak *</a></li>
					<li class="last"><a href="<?="P47_CP_Other.php?JnsNon=FIIA14&FrmG=CARA PEROLEHAN -> KETENTUAN PERATURAN (F.II.A.14)&IdL=".$_GET['IdL']?>">F14. Ketentuan Peratuan *</a></li>
					<li class="last"><a href="<?="P47_CP_Other.php?JnsNon=FIIA15&FrmG=CARA PEROLEHAN -> PUTUSAN PENGADILAN (F.II.A.15)&IdL=".$_GET['IdL']?>">F15. Putusan Pengadilan *</a></li>
					<li class="last"><a href="<?="P47_CP_Other.php?JnsNon=FIIA16&FrmG=CARA PEROLEHAN -> DIVESTASI (F.II.A.16)&IdL=".$_GET['IdL']?>">F16. Divestasi *</a></li>
					<li class="last"><a href="<?="P47_CP_Other.php?JnsNon=FIIA17&FrmG=CARA PEROLEHAN -> HASIL INVENTARISASI (F.II.A.17)&IdL=".$_GET['IdL']?>">F17. Hasil Inventarisasi *</a></li>
					<li class="last"><a href="<?="P47_CP_Other.php?JnsNon=FIIA18&FrmG=CARA PEROLEHAN -> HASIL TUKAR MENUKAR (F.II.A.18)&IdL=".$_GET['IdL']?>">F18. Hasil Tukar Menukar *</a></li>
					<li class="last"><a href="<?="P47_CP_Other.php?JnsNon=FIIA19&FrmG=CARA PEROLEHAN -> PEMBATALAN PENGHAPUSAN (F.II.A.19)&IdL=".$_GET['IdL']?>">F19. Pembatalan Penghapusan *</a></li>
					<li class="last"><a href="<?="P47_CP_Other.php?JnsNon=FIIA20&FrmG=CARA PEROLEHAN -> PENERIMAAN LAINNYA (F.II.A.20)&IdL=".$_GET['IdL']?>">F20. Penerimaan Lainnya *</a></li>
				</ul>
			</li>
			<li class="active"><a href="#">Daftar BMD</a> 
				<ul>
					<li class="has-sub"><a href="#">Aset Lancar</a>
						<ul>
							<li class="last"><a href="<?="KIB-P.php?FrmG=PENATAUSAHAAN -> KIB PERSEDIAAN&IdL=".$_GET['IdL']?>">KIB Persediaan) #</a></li>
						</ul>
					</li>
					<li class="has-sub"><a href="#">Aset Tetap</a>
						<ul>
							<li class="last"><a href="<?="KIB-A.php?FrmG=PENATAUSAHAAN -> KIB A (ASET TANAH)&IdL=".$_GET['IdL']?>">KIB-A (Tanah)</a></li>
							<li class="last"><a href="<?="KIB-B.php?FrmG=PENATAUSAHAAN -> KIB B (PERALATAN DAN MESIN)&IdL=".$_GET['IdL']?>">KIB-B (Peralatan & Mesin)</a></li>
							<li class="last"><a href="<?="KIB-C.php?FrmG=PENATAUSAHAAN -> KIB-C (GEDUNG DAN BANGUNAN)&IdL=".$_GET['IdL']?>">KIB-C (Gedung & Bangunan)</a></li>
							<li class="last"><a href="<?="KIB-D.php?FrmG=PENATAUSAHAAN -> KIB-D (JALAN, IRIGASI DAN JARINGAN)&IdL=".$_GET['IdL']?>">KIB-D (Jalan, Irigasi & Jaringan)</a></li>
							<li class="last"><a href="<?="KIB-E.php?FrmG=PENATAUSAHAAN -> KIB-E (ASET TETAP LAINNYA)&IdL=".$_GET['IdL']?>">KIB-E (Aset Tetap Lainnya)</a></li>
							<li class="last"><a href="<?="KIB-F.php?FrmG=PENATAUSAHAAN -> KIB-F (KONSTRUKSI DALAM PENGERJAAN)&IdL=".$_GET['IdL']?>">KIB-F (KDP)</a></li>
							<li class="last"><a href="#<?="KIB-H.php?FrmG=PENATAUSAHAAN -> AKUMULASI PENYUSUTAN&IdL=".$_GET['IdL']?>">Akumulasi Penyusutan</a></li>
						</ul>
					</li>
					<li class="has-sub"><a href="#">Aset Lainnya</a>
						<ul>
							<li class="last"><a href="<?="KIB-I.php?FrmG=PENATAUSAHAAN -> ASET KEMITRAAN DGN PIHAK KETIGA&IdL=".$_GET['IdL']?>">Kemitraan Dengan Pihak Ketiga</a></li>
							<li class="last"><a href="<?="KIB-J.php?FrmG=PENATAUSAHAAN -> ASET TIDAK BERWUJUD&IdL=".$_GET['IdL']?>">Aset Tidak Berwujud</a></li>
							<li class="last"><a href="<?="KIB-G.php?FrmG=PENATAUSAHAAN -> ASET LAINNYA&IdL=".$_GET['IdL']?>">Aset Lain-Lain</a></li>
						</ul>
					</li>
					<li class="last"><a href="<?="KIR.php?FrmG=PENATAUSAHAAN -> (KIR)&IdL=".$_GET['IdL']?>">Kartu Inventaris Ruangan (KIR)</a></li>
					<li class="last"><a href="#" onClick="WinOpenKKerja('900','470','center','2','<?=$_GET['IdL']?>')" title="Kertas Kerja">Rekap Penyusutan</a></li>
					<li class="last"><a href="<?="Utility_Extracom_Frm.php?FrmG=REPAIR EXTRACOM&IdL=".$_GET['IdL']?>">Repair Extracom</a></li>
				</ul>
			</li>
			<li class="active"> <a href="#">Inventarisasi</a> 
				<ul>
					<li class="has-sub"><a href="#">Lembar Kerja Inventarisasi</a>
						<ul>
						<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=1.3.1&FrmG=LEMBAR KERJA INVENTARISASI (LKI) TANAH (III.A.1)&IdL=".$_GET['IdL']?>">LKI Tanah (III.A.1)</a></li>
						<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=1.3.2&FrmG=LEMBAR KERJA INVENTARISASI (LKI) PERALATAN DAN MESIN (III.A.2)&IdL=".$_GET['IdL']?>">LKI Peralatan Dan Mesin (III.A.2)</a></li>
						<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=1.3.3&FrmG=LEMBAR KERJA INVENTARISASI (LKI) GEDUNG DAN BANGUNAN (III.A.3)&IdL=".$_GET['IdL']?>">LKI Gedung dan Bangunan (III.A.3)</a></li>
						<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=1.3.4&FrmG=LEMBAR KERJA INVENTARISASI (LKI) JALAN, IRIGASI DAN JARINGAN (III.A.4)&IdL=".$_GET['IdL']?>">LKI Jalan, Irigasi dan Jaringan (III.A.4)</a></li>
						<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=1.3.5&FrmG=LEMBAR KERJA INVENTARISASI (LKI) ASET TETAP LAINNYA (III.A.5)&IdL=".$_GET['IdL']?>">LKI Aset Tetap Lainnya (III.A.5)</a></li>
						<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=1.5.3&FrmG=LEMBAR KERJA INVENTARISASI (LKI) ASET TIDAK BERWUJUD (III.A.6)&IdL=".$_GET['IdL']?>">LKI Aset Tidak Berwujud (III.A.6)</a></li>
						<li class="last"><a href="<?="Lembar_Kerja_Frm.php?AsT=x.x.x&FrmG=LEMBAR KERJA INVENTARISASI (LKI) BMD BELUM TERCATAT (III.A.7)&IdL=".$_GET['IdL']?>">LKI BMD Belum Tercatat (III.A.7)</a></li>
					</ul>
					<li class="last"><a href="<?="Lembar_Kerja_Open_Report.php?FrmG=LAPORAN HASIL INVENTARISASI&IdL=".$_GET['IdL']?>">Laporan Hasil Inventarisasi</a></li>
					<li class="last"><a href="<?="Lembar_Kerja_Open_Rekap.php?FrmG=REKAPITULASI LHI&IdL=".$_GET['IdL']?>">Rekapitulasi LHI</a></li>
				</ul>
			</li>
			<li class="active"> <a href="#">Inventarisasi Reguler</a> 
				<ul>
					<li class="has-sub"><a href="#">Surat</a>
						<ul>
							<li class="last"><a href="<?="Surat_permohonan_mutasi_frm.php?FrmG=SURAT PERMOHONAN MUTASI&IdL=".$_GET['IdL']?>">Permohonan Mutasi</a></li>
							<li class="last"><a href="<?="Surat_permohonan_penghentian_frm.php?FrmG=SURAT PERMOHONAN PENGHENTIAN PENGGUNAAN BMD&IdL=".$_GET['IdL']?>">Permohonan Penghentian Penggunaan BMD</a></li>
						</ul>
					</li>
					<li class="last"><a href="<?="Invent_Usulan_Frm.php?FrmG=FORMULIR USULAN MUTASI&IdL=".$_GET['IdL']?>">Formulir Usulan Mutasi</a></li>
					<li class="last"><a href="<?="Invent_Usulan.php?FrmG=DAFTAR USULAN MUTASI&IdL=".$_GET['IdL']?>">Daftar Usulan Mutasi</a></li>
					<?php if ($Lev <= 1) {?>
						<li class="last"><a href="<?="Invent_Usulan_Veri_Frm.php?FrmG=FORMULIR TINDAK LANJUT USULAN MUTASI&IdL=".$_GET['IdL']?>">Tindak Lanjut Usulan</a></li>
					<?php } ?>
				</ul>
			</li>
			<li class="active"> <a href="#">Penghapusan</a> 
				<ul>
					<li class="last"><a href="<?="Penghapusan_Usulan_Frm.php?FrmG=FORMULIR USULAN PENGHAPUSAN&IdL=".$_GET['IdL']?>">Usulan Penghapusan</a></li>
					<li class="last"><a href="<?="Penghapusan_Usulan.php?FrmG=DAFTAR USULAN PENGHAPUSAN&IdL=".$_GET['IdL']?>">Daftar Usulan Penghapusan</a></li>
					<?php if ($Lev <= 1) {?>
						<li class="last"><a href="<?="Penghapusan_Usulan_Veri_Frm.php?FrmG=FORMULIR TINDAK LANJUT USULAN PENGHAPUSAN&IdL=".$_GET['IdL']?>">Penghapusan</a></li>
					<?php } ?>
				</ul>
			</li>
			<li class="active"> <a href="#">Pelaporan</a>
				<ul>
					<li class="has-sub"><a href="#">Mutasi</a>
						<ul>
							<li class="last"><a href="#" onClick="OpenReport('700','400','center','3','<?=$_GET['IdL']?>')" title="Daftar Mutasi">Daftar Mutasi Masuk</a></li>
							<li class="last"><a href="#" onClick="OpenReport('700','400','center','6','<?=$_GET['IdL']?>')" title="Daftar Mutasi">Daftar Mutasi Keluar</a></li>
						</ul>
					</li>
					<li class="has-sub"><a href="#">Dokumen</a>
						<ul>
							<li class="last"><a href="#" onClick="WinOpenKIB_New('650','350','center','1','<?=$_GET['IdL']?>')" title="Dokumen KIB">Dokumen KIB</a></li>
							<li class="last"><a href="#" onClick="WinOpenKIB_New('750','450','center','2','<?=$_GET['IdL']?>')" title="Dokumen KIB">Dokumen KIB (<i>Choise</i>)</a></li>
							<li class="last"><a href="#" onClick="OpenReport('700','400','center','1','<?=$_GET['IdL']?>')" title="Buku Inventaris">Buku Inventaris</a></li>
						</ul>
					</li>
					<li class="has-sub"><a href="#">Rekapitulasi</a>
						<ul>
							<li class="last"><a href="#" onClick="OpenReport('700','400','center','2','<?=$_GET['IdL']?>')" title="Rekap Buku Inventaris">Rekap Buku Inventaris</a></li>
							<li class="last"><a href="#" onClick="OpenReport('700','400','center','4','<?=$_GET['IdL']?>')" title="Rekap Daftar Mutasi">Rekap Daftar Mutasi</a></li>
							<li class="last"><a href="#" onClick="OpenReport('700','400','center','5','<?=$_GET['IdL']?>')" title="Rekap Per Rekening">Rekap Per Rincian Rekening</a></li>
							<li class="last"><a href="#" onClick="OpenRekap('600','350','center','1','<?=$_GET['IdL']?>')" title="Rekap Per Kelompok Rekening">Rekap Per Kelompok Rekening</a></li>
							<li class="last"><a href="#" onClick="OpenRekapAllSKPD('600','350','1','<?=$_GET['IdL']?>')" title="Rekapitulasi Barang Per SKPD">Rekapitulasi Barang Per SKPD 1</a></li>
							<li class="last"><a href="#" onClick="OpenRekapAllSKPD('600','350','2','<?=$_GET['IdL']?>')" title="Rekapitulasi Barang Per SKPD">Rekapitulasi Barang Per SKPD 2</a></li>
							<li class="last"><a href="#" onClick="WinOpenKKerja('900','470','center','2','<?=$_GET['IdL']?>')" title="Kertas Kerja">Rekap Penyusutan (<i>Nilai Buku</i>)</a></li>
							<li class="last"><a href="#" onClick="WinOpenKKerja('650','350','center','5','<?=$_GET['IdL']?>')" title="Rekap Penyusutan">Rekap Penyusutan (<i>Kabupaten</i>)</a></li>
						</ul>
					</li>
					<li class="has-sub"><a href="#">Permendagri 47 *</a>
						<ul>
							<!--
							A->1, B->2, C->3, D->4, E->5, F->6, G->7, H->8, I->9, J->10, K->11, L->12, M->13, N->14, O->15
							-->
							<li class="last"><a href="<?="p47_open_report_semester_ii.php?FrmG=LAPORAN PERMEN 47 (II.E)&model=L1&IdL=".$_GET['IdL']?>">Permen 47 (II.E)</a></li>
							<li class="last"><a href="<?="p47_open_report_semester_ii_12.php?FrmG=LAPORAN PERMEN 47 (II.L)&model=L1&IdL=".$_GET['IdL']?>">Permen 47 (II.L)</a></li>
							<li class="last"><a href="<?="p47_open_report_semester_ii_15.php?FrmG=LAPORAN PERMEN 47 (II.O.2-3)&model=L1&IdL=".$_GET['IdL']?>">Permen 47 (II.O.2-3) *</a></li>
							<li class="last"><a href="<?="p47_open_report_semester_ii_16.php?FrmG=LAPORAN PERMEN 47 (II.O.4)&IdL=".$_GET['IdL']?>">Permen 47 (II.O.4) *</a></li>
							<li class="last"><a href="<?="p47_open_report_semester_iv.php?FrmG=LAPORAN PERMEN 47 (IV)&model=L1&IdL=".$_GET['IdL']?>">Permen 47 (IV)</a></li>
							<!--li class="last"><a href="<?="p47_open_report_semester_xx.php?FrmG=LAPORAN PERMEN 47 (*)&IdL=".$_GET['IdL']?>">Permen 47 ( <i>Daftar BMD</i> ) *</a></li-->
						</ul>
					</li>
				</ul>
			</li>
			
			<!--li class="active"> <a href="#">Permen 47 *</a>
				<ul>
					<li class="last"><a href="<?="P47_Open_Laporan.php?FrmG=LAPORAN BMD&model=L1&IdL=".$_GET['IdL']?>">Laporan BMD</a></li>
					<li class="last"><a href="<?="P47_Open_Laporan.php?FrmG=LAPORAN PEROLEHAN BMD&model=L2&IdL=".$_GET['IdL']?>">Laporan Perolehan BMD</a></li>
					<li class="last"><a href="<?="P47_Open_Laporan.php?FrmG=LAPORAN PENERIMAAN INTERNAL BMD&model=L3&IdL=".$_GET['IdL']?>">Laporan Penerimaan Internal</a></li>
					<li class="last"><a href="<?="P47_Open_Laporan.php?FrmG=LAPORAN PENGELUARAN INTERNAL BMD&model=L4&IdL=".$_GET['IdL']?>">Laporan Pengeluaran Internal</a></li>
					<li class="last"><a href="<?="P47_Open_Laporan.php?FrmG=LAPORAN KOREKSI BMD&model=L5&IdL=".$_GET['IdL']?>">Laporan Koreksi BMD</a></li>
					<li class="last"><a href="<?="P47_Open_Laporan.php?FrmG=LAPORAN PENGHAPUSAN BMD&model=L6&IdL=".$_GET['IdL']?>">Laporan Penghapusan</a></li>
					<li class="last"><a href="<?="P47_Open_Laporan.php?FrmG=LAPORAN PENYUSUTAN BMD&model=L7&IdL=".$_GET['IdL']?>">Laporan Penyusutan</a></li>
					<li class="has-sub"><a href="#">Laporan Akibat Reklas</a>
						<ul>
						<li class="last"><a href="<?="P47_Open_Laporan.php?FrmG=LAPORAN PENAMBAHAN AKIBAT REKLAS&model=L8&IdL=".$_GET['IdL']?>">Laporan Penambahan</a></li>
						<li class="last"><a href="<?="P47_Open_Laporan.php?FrmG=LAPORAN PENGURANGAN AKIBAT REKLAS&model=L9&IdL=".$_GET['IdL']?>">Laporan Pengurangan</a></li>
						</ul>
					</li>
					<li class="has-sub"><a href="#">Rekonsiliasi</a>
						<ul>
						<li class="last"><a href="<?="P47_Rekonsiliasi_Frm.php?FrmG=REKONSILIASI&model=V1&IdL=".$_GET['IdL']?>">Rekonsiliasi Format V.1</a></li>
						<li class="last"><a href="<?="P47_Rekonsiliasi_Frm.php?FrmG=REKONSILIASI&model=V1&IdL=".$_GET['IdL']?>">Rekonsiliasi Format V.2</a></li>
						<li class="last"><a href="<?="P47_Rekonsiliasi_Frm.php?FrmG=REKONSILIASI&model=V1&IdL=".$_GET['IdL']?>">Rekonsiliasi Format V.3</a></li>
						<li class="last"><a href="<?="P47_Rekonsiliasi_Frm.php?FrmG=REKONSILIASI&model=V1&IdL=".$_GET['IdL']?>">Rekonsiliasi Format V.4</a></li>
						</ul>
					</li>
				</ul>
			</li>
			-->

			<li class="active"> <a href="#">Utility</a> 
				<ul>
						<?php if ($UID =="creator") {?>
							<li class="has-sub"><a href="#">Import Simda</a>
								<ul>
									<li class="last"><a href="<?="Utility_Import_SQL_A.php?FrmG=TARIK DATA SIMDA (KIB A)&IdL=".$_GET['IdL']?>">Import Data (Simda) A *</a></li>
									<li class="last"><a href="<?="Utility_Import_SQL_B.php?FrmG=TARIK DATA SIMDA (KIB B)&IdL=".$_GET['IdL']?>">Import Data (Simda) B *</a></li>
									<li class="last"><a href="<?="Utility_Import_SQL_BFN.php?FrmG=TARIK DATA SIMDA (KIB B FN)&IdL=".$_GET['IdL']?>">Import Data (Simda) B KDL *</a></li>
									<li class="last"><a href="<?="Utility_Import_SQL_C.php?FrmG=TARIK DATA SIMDA (KIB C)&IdL=".$_GET['IdL']?>">Import Data (Simda) C *</a></li>
									<li class="last"><a href="<?="Utility_Import_SQL_CFN.php?FrmG=TARIK DATA SIMDA (KIB C FN)&IdL=".$_GET['IdL']?>">Import Data (Simda) C KDL *</a></li>
									<li class="last"><a href="<?="Utility_Import_SQL_D.php?FrmG=TARIK DATA SIMDA (KIB D)&IdL=".$_GET['IdL']?>">Import Data (Simda) D *</a></li>
									<li class="last"><a href="<?="Utility_Import_SQL_E.php?FrmG=TARIK DATA SIMDA (KIB E)&IdL=".$_GET['IdL']?>">Import Data (Simda) E *</a></li>
									<li class="last"><a href="<?="Utility_Import_SQL_EFN.php?FrmG=TARIK DATA SIMDA (KIB E FN)&IdL=".$_GET['IdL']?>">Import Data (Simda) E KDL *</a></li>
									<li class="last"><a href="<?="Utility_Import_SQL_FFN.php?FrmG=TARIK DATA SIMDA (KIB F FN)&IdL=".$_GET['IdL']?>">Import Data (Simda) F KDL *</a></li>
									<li class="last"><a href="<?="Utility_Import_SQL_J.php?FrmG=TARIK DATA SIMDA (KIB J-ATB)&IdL=".$_GET['IdL']?>">Import Data (Simda) ATB *</a></li>
								</ul>
							</li>
						<?php } ?>
						<?php if ($Lev <= 1) {?>
						<li class="has-sub"><a href="#">Tools</a>
							<ul>
								<!--li class="last"><a href="<?="Home.php?IdL=".$_GET['IdL']?>" onClick="WinDumpDB('400','500','center')" title="Dokumen KIB">Backup Database</a></li-->
								<li class="last"><a href="<?="Log_Viewer.php?FrmG=LOG ERROR SISTEM&IdL=".$_GET['IdL']?>" title="Log Error Sistem">Log Error Sistem</a></li>
								<li class="last"><a href="#" onClick="WinMoveDataUPB('700','350','center','<?=$_GET['IdL']?>')" title="Pindah Data KIB (UPB->UPB)">Pindah Data KIB (UPB->UPB) *</a></li>
								<li class="last"><a href="#" onClick="WinMoveDataUNT('700','350','center','<?=$_GET['IdL']?>')" title="Pindah Data KIB (SKPD->SKPD)">Pindah Data KIB (SKPD->SKPD) *</a></li>
								<li class="last"><a href="#" onClick="WinKunciData('650','450','center','<?=$_GET['IdL']?>')" title="Kunci data aset">Kunci Data Aset</a></li>					
								<?php if ($CetakBC == "Y") {?>
									<li class="last"><a href="#" onClick="WinCetakBarcode('850','450','center','<?=$_GET['IdL']?>')" title="Cetak Bar Code">Cetak Bar Code</a></li>
									<li class="last"><a href="<?="Ref_Bar_Code.php?FrmG=REFERENSI -> DAFTAR KODE BAR&IdL=".$_GET['IdL']?>">Daftar Kode Bar</a></li>
								<?php } ?>
							</ul>
						</li>
						<?php if ($UID =="creator") {?>
							<li class="has-sub"><a href="#">Import Data (XLS)</a>
								<ul>
									<li class="last"><a href="#" onClick="WinXLS('1100','550','center','A','<?=$_GET['IdL']?>')" title="Import From Excel (KIB-A)">Import From Excel (KIB-A)*</a></li>
									<li class="last"><a href="#" onClick="WinXLS('1100','550','center','B','<?=$_GET['IdL']?>')" title="Import From Excel (KIB-B)">Import From Excel (KIB-B)*</a></li>
									<li class="last"><a href="#" onClick="WinXLS('1100','550','center','C','<?=$_GET['IdL']?>')" title="Import From Excel (KIB-C)">Import From Excel (KIB-C)*</a></li>
									<li class="last"><a href="#" onClick="WinXLS('1100','550','center','D','<?=$_GET['IdL']?>')" title="Import From Excel (KIB-D)">Import From Excel (KIB-D)*</a></li>
									<li class="last"><a href="#" onClick="WinXLS('1100','550','center','E','<?=$_GET['IdL']?>')" title="Import From Excel (KIB-E)">Import From Excel (KIB-E)*</a></li>
									<li class="last"><a href="#" onClick="WinXLS('1100','550','center','F','<?=$_GET['IdL']?>')" title="Import From Excel (KIB-F)">Import From Excel (KIB-F)*</a></li>
								</ul>
							</li>
						<?php } ?>
						<li class="last"><a href="ArsipDokumen_pdf.php?<?="IdL=".$_GET['IdL']?>">Arsip Dokumen ( pdf )</a></li>
						<li class="last"><a href="#" onClick="ManageInfo('900','500','center','<?=$_GET['IdL']?>')" title="Informasi dan berita">Informasi & Berita</a></li>
						<li class="last"><a href="#" onClick="ManageKritik('900','500','center','<?=$_GET['IdL']?>')" title="Kritik dan saran">Kritik & Saran</a></li>
						<li class="last"><a href="<?="Utility_Extracom_Frm.php?FrmG=REPAIR EXTRACOM&IdL=".$_GET['IdL']?>">Repair Extracom</a></li>
						<li class="last"><a href="<?="Utility_FindData_Frm.php?FrmG=FIND DATA ASET&IdL=".$_GET['IdL']?>">Find Data</a></li>
						<?php if ($UID =="creator") {?>
							<li class="has-sub"><a href="#">Creator</a>
								<ul>
									<li class="last"><a href="<?="utility_apbd.php?FrmG=Utilily APBD (SiPD)&IdL=".$_GET['IdL']?>">Utility APBD (SiPD)</a></li>
									<li class="last"><a href="<?="Utility_Missing_Post_Frm.php?FrmG=MISSING POST DATA&IdL=".$_GET['IdL']?>">Missing POST</a></li>
									<li class="last"><a href="<?="Utility_CopyData.php?FrmG=COPY DATA&IdL=".$_GET['IdL']?>">Copy Data (Database)</a></li>
									<li class="last"><a href="#<?="Utility_Tarik_KIB.php?FrmG=TARIK DATA KIB&IdL=".$_GET['IdL']?>"># Tarik Data KIB</a></li>
									<li class="last"><a href="#<?="Utility_KdpToAset.php?FrmG=RETRIVE KDP TO ASET&IdL=".$_GET['IdL']?>"># Retrive KdpToAset</a></li>
								</ul>
							</li>
						<?php } ?>
					<?php } else {?>
						<li class="last"><a href="#<?="Utility_Extracom_Frm.php?FrmG=REPAIR EXTRACOM&IdL=".$_GET['IdL']?>">Repair Extracom #</a></li>
						<?php if ($CetakBC == "Y") {?>
							<li class="last"><a href="#" onClick="WinCetakBarcode('850','450','center','<?=$_GET['IdL']?>')" title="Cetak Bar Code">Cetak Bar Code</a></li>
							<li class="last"><a href="<?="Ref_Bar_Code.php?FrmG=REFERENSI -> DAFTAR KODE BAR&IdL=".$_GET['IdL']?>">Daftar Kode Bar</a></li>
						<?php } ?>
					<?php } ?>
				</ul>
			</li>
			<li class="active"> <a href="#">Help</a> 
				<ul>
					<li class="last"><a href="#" onClick="WinHELP('800','400','center')">User Manual</a></li>
					<li class="last"><a href="#" onClick="WinABOUT('400','500','center')">About</a></li>
				</ul>
			</li>
			<!--li class="active"><a href="#" onClick="OpenChat('630','480','center','1')">Chat</a></li-->
		<?php } ?> <!-- end dari if ($SEN=='YA')-->
	</ul>
</div>
<?php if ($FrmG){?>
	<div class="titleform">
		<table cellpadding="0" cellspacing="0" style="height:100%; border-collapse:collapse">
			<tr>
			<td width="5px"></td>
			<td width="25px"><img src="Images/Logo Litle.gif" height="20" width="20" /></td>
			<td><?=$FrmG?></td>
			</tr>
		</table>
	</div>
	<br>
<?php } ?>

<script language="javascript">
	function winABOUT(w,h,pos)
	{	var win=null;
		var txtHTML = "";
  		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();       			
			URL_Top = "About_Top.php";
			URL_Mid = "About_Mid.php";
			URL_Bot = "About_Bot.php";
			txtHTML="<html><head><title>SimBADA</title></head><frameset framespacing='0' border='0' rows='59,*,30' frameborder='0'><frame name='WinInfo_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinInfo_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinInfo_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}

	function WinOpenKKerja(w,h,pos,pil,IdL)
	{	var win=null;
		var URL_MidA= "";
		var URL_MidB= "";
		var URL_MidC= "";
		var txtHTML = "";
  		var iErrors = 0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
			if (win!=null)
			{
				win.window.document.open();
				switch (pil)
				{
				case '1' :
					URL_Top ="Open_KKR_Top.php?FrmG=PELAPORAN -> DOKUMEN KERTAS KERJA&IdL="+IdL;
					URL_Mid ="Open_KKR_Mid.php?IdL="+IdL;
					URL_Bot ="Open_KKR_Bot.php";
					break;
				case '2' :
					//URL_Top ="Open_KKM_Top.php?FrmG=PELAPORAN -> REKAP PENYUSUTAN&IdL="+IdL;
					//URL_Mid ="Open_KKM_Mid.php?IdL="+IdL;
					//URL_Bot ="Open_KKM_Bot.php";
					
					URL_Top ="Open_KKM_Top_108.php?FrmG=PELAPORAN -> REKAP PENYUSUTAN&IdL="+IdL;
					URL_Mid ="Open_KKM_Mid_108.php?IdL="+IdL;
					URL_Bot ="Open_KKM_Bot_108.php";
					
					break;
				case '3' :
					URL_Top ="Open_NRC_Top.php?FrmG=PELAPORAN -> REKAP NILAI KE NERACA&IdL="+IdL;
					URL_Mid ="Open_NRC_Mid.php?IdL="+IdL;
					URL_Bot ="Open_NRC_Bot.php";
					break;
				case '4' :
					URL_Top ="Open_KKM_Top.php?FrmG=PELAPORAN -> REKAP PENYUSUTAN - PERITEM&IdL="+IdL;
					URL_Mid ="Open_KKM_Mid_sdTgl.php?IdL="+IdL;
					URL_Bot ="Open_KKM_Bot.php";
					break;
				case '5' :
					URL_Top ="Open_KKB_Top.php?FrmG=PELAPORAN -> REKAP PENYUSUTAN - KABUPATEN&IdL="+IdL;
					URL_Mid ="Open_KKB_Mid.php?IdL="+IdL;
					URL_Bot ="Open_KKB_Bot.php";
					break;
				}
       			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' src='"+URL_Top+"' scrolling='no' noresize><frame name='WinOpenKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinOpenKIB_Bot' src='"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>";
       			win.focus();
      			win.window.document.clear();
      			win.window.document.write(txtHTML);
      			win.window.document.close();
      			win.setTimeout("self.close()",200000000);
    		}
	}

	function WinMerger(w,h,pos,pil,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			switch (pil)
			{
				case '1':
					gURL_Mid ='zMerger_Kib_A.php';
					gJDL="KIB - A";
					break;
				case '2':
					gURL_Mid ='zMerger_Kib_B.php';
					gJDL="KIB - B";
					break;
				case '3':
					gURL_Mid ='zMerger_Kib_C.php';
					gJDL="KIB - C";
					break;
				case '4':
					gURL_Mid ='zMerger_Kib_D.php';
					gJDL="KIB - D";
					break;
				case '5':
					gURL_Mid ='zMerger_Kib_E.php';
					gJDL="KIB - E";
					break;
				case '6':
					gURL_Mid ='zMerger_Kib_F.php';
					gJDL="KIB - F";
					break;
			}
			win.window.document.open();
			var URL_Top = 'zMerger_Top.php?FrmG=MERGER DATA '+gJDL;
			var URL_Mid = gURL_Mid+"?IdL="+IdL;
			var URL_Bot = 'zMerger_Bot.php';

			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='yes'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}

	function ManageKritik(w,h,pos,IdL)
	{	var win=null;
		var txtHTML = "";
  		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();       			
			URL_Top = "Kritik_Top.php?IdL="+IdL;
			URL_Mid = "Kritik_Mid.php?IdL="+IdL;
			URL_Bot = "Kritik_Bot.php?IdL="+IdL;
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='59,*,30' frameborder='0'><frame name='WinInfo_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinInfo_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinInfo_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}

	function ManageInfo(w,h,pos,IdL)
	{	var win=null;
		var txtHTML = "";
  		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_Top = "Information_Top.php?IdL="+IdL;
			URL_Mid = "Information_Mid.php?IdL="+IdL;
			URL_Bot = "Information_Bot.php?IdL="+IdL;
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='59,*,30' frameborder='0'><frame name='WinInfo_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinInfo_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinInfo_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}

	function WinImport(w,h,pil,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			switch (pil)
			{
				case '1':
					gURL_Mid ='zImport_Rek_132006.php';
					gJDL="";
					break;
				case '2':
					gURL_Mid ='zImport_Rek_172007.php';
					gJDL="";
					break;
				case '3':
					gURL_Mid ='zImport_Bidang_Pemerintahan.php';
					gJDL="";
					break;
				case '4':
					gURL_Mid ='zImport_Unit_Kerja.php';
					gJDL="";
					break;
				case '5':
					gURL_Mid ='zImport_Sub_Unit.php';
					gJDL="";
					break;
				case '6':
					gURL_Mid ='zImport_Upb.php';
					gJDL="";
					break;
				case '7':
					gURL_Mid ='zImport_Kib_A.php';
					gJDL="KIB - A";
					break;
				case '8':
					gURL_Mid ='zImport_Kib_B.php';
					gJDL="KIB - B";
					break;
				case '9':
					gURL_Mid ='zImport_Kib_C.php';
					gJDL="KIB - C";
					break;
				case '10':
					gURL_Mid ='zImport_Kib_D.php';
					gJDL="KIB - D";
					break;
				case '11':
					gURL_Mid ='zImport_Kib_E.php';
					gJDL="KIB - E";
					break;
				case '12':
					gURL_Mid ='zImport_Kib_F.php';
					gJDL="KIB - F";
					break;
				case '15':
					gURL_Mid ='Utility_Post_Data_A.php';
					gJDL="KIB - A";
					break;
				case '16':
					gURL_Mid ='Utility_Post_Data_B.php';
					gJDL="KIB - B";
					break;
				case '17':
					gURL_Mid ='Utility_Post_Data_C.php';
					gJDL="KIB - C";
					break;
				case '18':
					gURL_Mid ='Utility_Post_Data_D.php';
					gJDL="KIB - D";
					break;
				case '19':
					gURL_Mid ='Utility_Post_Data_E.php';
					gJDL="KIB - E";
					break;
				case '20':
					gURL_Mid ='Utility_Post_Data_F.php';
					gJDL="KIB - F";
					break;
			}
			win.window.document.open();
			var URL_Top = 'zImport_Top.php?FrmG=IMPORT DATA '+gJDL;
			var URL_Mid = gURL_Mid+"?IdL="+IdL;
			var URL_Bot = 'zImport_Bot.php';

			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}
	
	function WinDumpDB(w,h,pos,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_Top = "Backup_Dump_Top.php?FrmG=BACKUP DATABASE";
			URL_Mid = "Backup_Dump_Mid.php?IdL="+IdL;
			URL_Bot = "Backup_Dump_Bot.php";
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}
	
	function WinMoveDataUPB(w,h,pos,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_Top = "Move_Data_UPB_Top.php?FrmG=PINDAH DATA KIB UPB -> UPB";
			URL_Mid = "Move_Data_UPB_Mid.php?IdL="+IdL;
			URL_Bot = "Move_Data_UPB_Bot.php";
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}

	function WinMoveDataUNT(w,h,pos,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_Top = "Move_Data_Unit_Top.php?FrmG=PINDAH DATA KIB SKPD -> SKPD";
			URL_Mid = "Move_Data_Unit_Mid.php?IdL="+IdL;
			URL_Bot = "Move_Data_Unit_Bot.php";
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}

	function WinCleanData(w,h,pos,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_Top = "Clean_Data_Aset_Top.php?FrmG=CLEAN / PENGHAPUSAN SEMUA DATA ASET";
			URL_Mid = "Clean_Data_Aset_Mid.php?IdL="+IdL;
			URL_Bot = "Clean_Data_Aset_Bot.php";
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}
	
	function WinKunciData(w,h,pos,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_Top = "Kunci_Data_Aset_Top.php?FrmG=KUNCI DATA ASET";
			URL_Mid = "Kunci_Data_Aset_Mid.php?IdL="+IdL;
			URL_Bot = "Kunci_Data_Aset_Bot.php";
			txtHTML="<html><head><title>SimBADA</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}
	
	
	
	function WinCetakBarcode(w,h,pos,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_Top = "Kunci_Data_Aset_Top.php?FrmG=Cetak Bar Code";
			URL_Mid = "Cetak_Bar_Code.php?IdL="+IdL;
			URL_Bot = "Kunci_Data_Aset_Bot.php";
			txtHTML="<html><head><title>SimBADA</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}
	
	function WinXLS(w,h,pos,gkib,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_Top = "Import_KIB_Top.php?FrmG=IMPORT KIB-"+gkib+"&gKib="+gkib+"&IdL="+IdL;
			URL_Mid = "Import_KIB_Mid.php?gKib="+gkib+"&IdL="+IdL;
			URL_Bot = "Import_KIB_Bot.php";
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='90,*,30' frameborder='0'><frame name='WinOpenXLS_Top"+gkib+"' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenXLS_Mid"+gkib+"' src='"+URL_Mid+"' scrolling='yes'><frame name='WinOpenXLS_Bot"+gkib+"' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}
	
	function WinOpenRKBMD(w,h,pos,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_Top = "RKBMD_Top.php?IdL="+IdL;
			URL_Mid = "RKBMD_Mid.php?IdL="+IdL;
			URL_Bot = "RKBMD_Bot.php";
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='138,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='yes'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}
		
	function WinOpenRKPBMD(w,h,pos,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_Top = "RKPBMD_Top.php?IdL="+IdL;
			URL_Mid = "RKPBMD_Mid.php?IdL="+IdL;
			URL_Bot = "RKPBMD_Bot.php";
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='138,*,30' frameborder='0'><frame name='WinOpenRKPB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKPB_Mid' src='"+URL_Mid+"' scrolling='yes'><frame name='WinOpenRKPB_Bot' src='"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}
		
	function WinOpenKIB(w,h,pos,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_Top = "Open_KIB_Top.php?FrmG=PELAPORAN -> DOKUMEN KIB";
			URL_Mid = "Open_KIB_Mid.php?IdL="+IdL;
			URL_Bot = "Open_KIB_Bot.php";
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinOpenKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}
	
	function WinOpenKIB_New(w,h,pos,pil,IdL)
	{	var win=null;
		var URL_MidA="";
		var URL_MidB="";
		var URL_MidC="";
		var txtHTML = "";
  		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
			if (win!=null)
			{
				win.window.document.open();
				switch (pil)
				{
				case '1' :
					URL_Top ="Open_KIB_Top.php?FrmG=PELAPORAN -> DOKUMEN KIB&IdL="+IdL;
					URL_Mid ="Open_KIB_Mid.php?IdL="+IdL;
					URL_Bot ="Open_KIB_Bot.php";
					break;
				case '2' :
					URL_Top ="Open_KIB_Choise_Top.php?FrmG=PELAPORAN -> DOKUMEN KIB (<i>Choise</i>)&IdL="+IdL;
					URL_Mid ="Open_KIB_Choise_Mid.php?IdL="+IdL;
					URL_Bot ="Open_KIB_Choise_Bot.php";
					break;
				}
       			txtHTML= "<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'>";
				txtHTML= txtHTML+"<frame name='WinOpenKIB_Top' src='"+URL_Top+"' scrolling='no' noresize>";
				txtHTML= txtHTML+"<frame name='WinOpenKIB_Mid' src='"+URL_Mid+"' scrolling='auto'>";
				txtHTML= txtHTML+"<frame name='WinOpenKIB_Bot' src='"+URL_Bot+"' scrolling='no'><noframes>";
				txtHTML= txtHTML+"<body><p>=>.............??!</p></body></noframes></frameset></html>";
       			win.focus();
      			win.window.document.clear();
      			win.window.document.write(txtHTML);
      			win.window.document.close();
      			win.setTimeout("self.close()",200000000);
    		}
	}

	function OpenChat(w,h,pos)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL="Chat/chat.php";
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function OpenReport(w,h,pos,pil,IdL)
	{	var win=null;
		var URL_MidA="";
		var URL_MidB="";
		var URL_MidC="";
		var txtHTML = "";
  		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
			if (win!=null)
			{
				win.window.document.open();
				URL_MidA = "Open_Report_Mid.php?";
				URL_TopA = "Open_Report_Top.php?";
				switch (pil)
				{
				case '1' :
					URL_MidB="rCrt=1";
					URL_TopB="FrmG=PELAPORAN -> BUKU INVENTARIS";
					break;
				case '2' :
					URL_MidB="rCrt=2";
					URL_TopB="FrmG=PELAPORAN -> REKAP BUKU INVENTARIS";
					break;
				case '3' :
					URL_MidB="rCrt=3";
					URL_TopB="FrmG=PELAPORAN -> DAFTAR MUTASI MASUK";
					break;
				case '4' :
					URL_MidB="rCrt=4";
					URL_TopB="FrmG=PELAPORAN -> REKAP DAFTAR MUTASI";
					break;
				case '5' :
					URL_MidB="rCrt=5";
					URL_TopB="FrmG=PELAPORAN -> REKAP REKENING";
					break;
				case '6' :
					URL_MidB="rCrt=6";
					URL_TopB="FrmG=PELAPORAN -> DAFTAR MUTASI KELUAR";
					break;
					}
				URL_Bot  = "Open_Report_Bot.php";
				URL_MidC = "&IdL="+IdL;
       			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' noresize src='"+URL_TopA+URL_TopB+"' scrolling='no'><frame name='WinOpenKIB_Mid' src='"+URL_MidA+URL_MidB+URL_MidC+"' scrolling='auto'><frame name='WinOpenKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus();
      			win.window.document.clear();
      			win.window.document.write(txtHTML);
      			win.window.document.close();
      			win.setTimeout("self.close()",200000000);
    		}
	}

	function OpenRekap(w,h,pos,pil,IdL)
	{	var win=null;
		var URL_MidA="";
		var URL_MidB="";
		var URL_MidC="";
		var txtHTML = "";
  		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_MidA = "Open_Rekap_Mid.php?";
			URL_TopA = "Open_Rekap_Top.php?";
			switch (pil)
			{
			case '1' :
				URL_MidB="rCrt=1";
				URL_TopB="FrmG=PELAPORAN -> REKAP PER KELOMPOK ASET";
				break;
			case '2' :
				URL_MidB="rCrt=2";
				URL_TopB="FrmG=PELAPORAN -> REKAPITULASI BARANG PER SKPD";
				break;
			}
			URL_Bot  = "Open_Rekap_Bot.php";
			URL_MidC = "&IdL="+IdL;
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' noresize src='"+URL_TopA+URL_TopB+"' scrolling='no'><frame name='WinOpenKIB_Mid' src='"+URL_MidA+URL_MidB+URL_MidC+"' scrolling='auto'><frame name='WinOpenKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}

	function OpenRekapAllSKPD(w,h,pil,IdL)
	{	var win=null;
		var URL_MidA="";
		var URL_MidB="";
		var URL_MidC="";
		var txtHTML = "";
  		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_MidA = "Open_Rekap_AllSKPD_Mid.php?";
			URL_TopA = "Open_Rekap_AllSKPD_Top.php?";
			switch (pil)
			{
			case '1' :
				URL_MidB="rCrt=1";
				URL_TopB="FrmG=PELAPORAN -> REKAPITULASI BARANG PER SKPD MODEL (1)";
				break;
			case '2' :
				URL_MidB="rCrt=2";
				URL_TopB="FrmG=PELAPORAN -> REKAPITULASI BARANG PER SKPD MODEL (2)";
				break;
			}
			URL_Bot  = "Open_Rekap_AllSKPD_Bot.php";
			URL_MidC = "&IdL="+IdL;
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' noresize src='"+URL_TopA+URL_TopB+"' scrolling='no'><frame name='WinOpenKIB_Mid' src='"+URL_MidA+URL_MidB+URL_MidC+"' scrolling='auto'><frame name='WinOpenKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}

	function WinTarikData(w,h,pos,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		var TopPosition=(screen.height)?(screen.height-h)/2:100;
		var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('ddd','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_Top = "TarikDataAsetKe108_Top.php?FrmG=TARIK DATA ASET";
			URL_Mid = "TarikDataAsetKe108_Mid.php?IdL="+IdL;
			URL_Bot = "TarikDataAsetKe108_Bot.php";
			txtHTML="<html><head><title>SimBADA</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
	}
	
function WinOpenBERKAS(w,h,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "Penerimaan_Berkas_Open_Report_Top.php?FrmG=PENGADAAN -> REPORT PENERIMAAN BERKAS";
		URL_Mid = "Penerimaan_Berkas_Open_Report_Mid.php?IdL="+IdL;
		URL_Bot = "Penerimaan_Berkas_Open_Report_Bot.php";
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinADA_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinADA_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinADA_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinOpenPGADAN(w,h,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "Pengadaan_Open_Report_Top.php?FrmG=PENGADAAN -> REPORT PENGADAAN";
		URL_Mid = "Pengadaan_Open_Report_Mid.php?IdL="+IdL;
		URL_Bot = "Pengadaan_Open_Report_Bot.php";
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinADA_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinADA_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinADA_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinOpenREKONS(w,h,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "Pengadaan_Open_Rekon_Top.php?FrmG=PENGADAAN -> REKONSILIASI PENGADAAN ASET";
		URL_Mid = "Pengadaan_Open_Rekon_Mid.php?IdL="+IdL;
		URL_Bot = "Pengadaan_Open_Rekon_Bot.php";
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinADA_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinADA_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinADA_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}
</script>
