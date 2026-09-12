<?php

require('Connection.php');
require('FileFunction.php');
extract($_GET);

include "simandor/phpqrcode/qrlib.php";
$tempdir = "simandor/temp/"; //Nama folder tempat menyimpan file qrcode
if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);

//ambil logo
$logopath = "Images/logopemda.png";

//isi qrcode jika di scan
//$codeContents = $_POST['kode']; 

//simpan file qrcode
QRcode::png($codeContents, $tempdir . 'qrwithlogo' . $codeContents . '.png', QR_ECLEVEL_H, 10, 4);


// ambil file qrcode
$QR = imagecreatefrompng($tempdir . 'qrwithlogo' . $codeContents . '.png');

// memulai menggambar logo dalam file qrcode
$logo = imagecreatefromstring(file_get_contents($logopath));

imagecolortransparent($logo, imagecolorallocatealpha($logo, 0, 0, 0, 127));
imagealphablending($logo, false);
imagesavealpha($logo, true);

$QR_width = imagesx($QR);
$QR_height = imagesy($QR);

$logo_width = imagesx($logo);
$logo_height = imagesy($logo);

// Scale logo to fit in the QR Code
$logo_qr_width = $QR_width / 4;
$scale = $logo_width / $logo_qr_width;
$logo_qr_height = $logo_height / $scale;

imagecopyresampled($QR, $logo, $QR_width / 0.6, $QR_height / 0.8, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

// Simpan kode QR lagi, dengan logo di atasnya
//imagepng($QR,$tempdir.''.$codeContents.'.png');

//menampilkan file qrcode 
echo '<div align="center">';
echo "<button type=button class='btn btn-lg btn-primary cekData'>Cetak : " . $codeContents . "</button>";
echo '<br><a href="https://www.balangankab.go.id">Aset Pemerintah Kabupaten Balangan</a><div>';
echo '<img src="Images/logopemda.png" align=top/>';
echo '<img style="width:230px;height:240px;" src="' . $tempdir . 'qrwithlogo' . $codeContents . '.png' . '" />';
echo "<div id=kode>$codeContents</div>";


?>

<script type="text/javascript">
    $("document").ready(function () {

        $(".cekData").click(function () {

            var kode = $('#kode').text();
            // alert(kode)
            window.location = 'Cetak_Bar_Code_.php?file=simandor/temp/qrwithlogo' + kode + '.png';


            //window.history.back();

        });

    });
</script>