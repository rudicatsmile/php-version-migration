<?php 

require_once 'connect.php';

$kdUnit = $_GET['kdUnit'];
$kdSubUnit = $_GET['kdSubUnit'];
$kdUpb = $_GET['kdUpb'];
$sType = $_GET['sType'];
$kdKib = $_GET['kdKib'];
$findText = $_GET['findText'];

if(empty($findText)) {
    $sqlFind = "";
}
else {
    $sqlFind = " AND (Kd_Aset_108 LIKE '$findText%' 
					OR No_Register LIKE '$findText%'
					OR Nm_Aset LIKE '%$findText%'
          OR Referensi LIKE '%$findText%'
					)";
	
}

$sqlMappingNotYet = " AND kode_bar='' " ;


switch ($sType) {
  case "1":
    $condition = $kdUnit;
    break;
  case "2":
	$condition = $kdSubUnit;
	break;
  case "3":	
    $condition = $kdUpb;
    break;  
  default:
  
}

$fields = " IDT,Referensi,Ref_Group,Ref_Mutasi,Ref_Usulan,Ref_History,Ref_Usulan_His,Kd_UPB,Kd_Aset,Kd_Aset_108,
Kd_Ruang,No_Register,No_Pengadaan,Ref_Temp,Nm_Aset,Kd_Pemilik,Tgl_Perolehan,Tgl_Mutasi,Tgl_Mulai,Tahun,Luas_M2,Alamat,
Hak_Tanah,Sertifikat,Sertifikat_Tanggal,Sertifikat_Nomor,Penggunaan,Asal_Usul,Harga,No_SP2D,Merk,Type,Ukuran_CC,Bahan,Nomor_Pabrik,
Nomor_Rangka,Nomor_Mesin,Nomor_Polisi,Nomor_Polisi_Lama,Nomor_BPKB,Pemegang,Pemegang_Lama,Kondisi,Masa_Manfaat,Nilai_Akhir,
Bertingkat,Beton,Luas_Lantai,Lokasi,Dokumen_Tanggal,Dokumen_Nomor,Status_Tanah,Kd_Tanah1,Kd_Tanah2,Kd_Tanah3,Kd_Tanah4,
Kd_Tanah5,Luas_Tanah,Kode_Tanah_Old,Kode_Tanah,Konstruksi,Panjang,Lebar,Luas,Judul,Spesifikasi,Pencipta,Daerah_Asal,Jenis,
Tipe_Bangunan,KdpToAset,Ukuran,Keterangan,Post,file_name,file_type,file_size,extracom,MasukKeUsulan,Status,ImportFrom,Recorded,Pencatat,
IdTabelMaster,kode_bar,lat,lng,lat_lng,
(SELECT IFNULL(SUM(debet),0) AS sna FROM ta_kib_post_108 
WHERE referensi=ta_kib_108.Referensi AND kd_upb=ta_kib_108.Kd_UPB) AS sum_nilai_akhir 
";
$query=" SELECT $fields FROM ta_kib_108 
			WHERE referensi LIKE '%' 
			AND extracom LIKE 'N' 
			AND Kd_UPB LIKE '".trim($condition," ")."%' 
			AND Kd_Ruang LIKE '%' 
			AND Kd_Aset_108 LIKE  '$kdKib%'
			$sqlFind
      $sqlMappingNotYet
			AND Tgl_Perolehan >='1970-01-01' AND Tgl_Perolehan <='2023-12-31' 
      ORDER BY Kd_UPB, Tgl_Perolehan, Kd_Aset_108, No_Register";
//echo $query;exit;
$data=array();
$result = mysqli_query($conn, $query);
while($row=mysqli_fetch_object($result))
    {		
		$data[]=$row;		
		//$data[]=str_replace("'", "\'", $row);
		//$data[]=str_replace('&quot;','&#39;',$row);
    }
$response=array(
            'status' => 1,
            'message' =>'Get Data Successfully.',
            'value' =>  $data
        );
header('Content-Type: application/json');
echo json_encode($response);
//echo json_encode(addslashes($response));
//echo json_encode(escapeJsonString($response));
//echo str_replace("'", "", json_encode($response));
//echo str_replace("'", "\'", json_encode($response));
//echo json_encode($response, JSON_HEX_APOS)
//echo htmlspecialchars(json_encode($response, ENT_QUOTES, 'UTF-8'));

function escapeJsonString($value) {
    # list from www.json.org: (\b backspace, \f formfeed)    
    $escapers =     array("'","\\",     "/",   "\"",  "\n",  "\r",  "\t", "\x08", "\x0c");
    $replacements = array(" ","\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t",  "\\f",  "\\b");
    $result = str_replace($escapers, $replacements, $value);
    return $result;
}

?>
