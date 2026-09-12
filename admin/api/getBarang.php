<?php 

require_once 'connect.php';

$kodeUpb = $_GET['kodeUpb'];
$kodeAset = $_GET['kodeAset'];
$fields = " IDT,Referensi,Ref_Group,Ref_Mutasi,Ref_Usulan,Ref_History,Ref_Usulan_His,Kd_UPB,Kd_Aset,Kd_Aset_108,
Kd_Ruang,No_Register,No_Pengadaan,Ref_Temp,Nm_Aset,Kd_Pemilik,Tgl_Perolehan,Tgl_Mutasi,Tgl_Mulai,Tahun,Luas_M2,Alamat,
Hak_Tanah,Sertifikat,Sertifikat_Tanggal,Sertifikat_Nomor,Penggunaan,Asal_Usul,Harga,No_SP2D,Merk,Type,Ukuran_CC,Bahan,Nomor_Pabrik,
Nomor_Rangka,Nomor_Mesin,Nomor_Polisi,Nomor_Polisi_Lama,Nomor_BPKB,Pemegang,Pemegang_Lama,Kondisi,Masa_Manfaat,Nilai_Akhir,Bertingkat,
Beton,Luas_Lantai,Lokasi,Dokumen_Tanggal,Dokumen_Nomor,Status_Tanah,Kd_Tanah1,Kd_Tanah2,Kd_Tanah3,Kd_Tanah4,Kd_Tanah5,Luas_Tanah,
Kode_Tanah_Old,Kode_Tanah,Konstruksi,Panjang,Lebar,Luas,Judul,Spesifikasi,Pencipta,Daerah_Asal,Jenis,Tipe_Bangunan,KdpToAset,Ukuran,
Keterangan,Post,file_name,file_type,file_size,extracom,MasukKeUsulan,Status,ImportFrom,Recorded,Pencatat,
IdTabelMaster,kode_bar,lat,lng,lat_lng";
$query=" SELECT $fields FROM ta_kib_108 
			WHERE referensi LIKE '%' 
			AND extracom LIKE 'N' 
			AND Kd_UPB LIKE '$kodeUpb' 
			AND Kd_Ruang LIKE '%' 
			AND Kd_Aset_108 LIKE  '$kodeAset'
			AND Tgl_Perolehan >='1970-01-01' AND Tgl_Perolehan <='2022-12-31' 
                       	ORDER BY Kd_UPB, Tgl_Perolehan, Kd_Aset_108, No_Register LIMIT 0, 50;";
//echo $query;
$data=array();
$result = mysqli_query($conn, $query);
while($row=mysqli_fetch_object($result))
      {
	/*
        if($row['file_content'] === NULL){
	
		//$row['file_content'] =  '';
	
	} else{
		$row['file_content'] = '';
	}
*/
	$data[]=$row;
      }
$response=array(
            'status' => 1,
            'message' =>'Get Data Successfully.',
            'value' => $data
        );
header('Content-Type: application/json');
echo json_encode($response);

?>
