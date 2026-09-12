<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>APLIKASI SILABEL HST</title>
	<link href="simandor/style.css" rel="stylesheet">
     <!--<link href="bootstrap.min.css" rel="stylesheet">
	<script src="jquery.min.js"></script> -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<style>
.center_div{
    margin: 0 auto;
    width:80% /* value of your choice which suits your alignment */
}
</style>

<div class="container center_div">
<body>
    <p></p>
	<h3>APLIKASI SIMANDOR</h3>
	<p>
	<form method="post" action="">

    <button type="button" name="KIB-A-" class="btn btn-lg btn-success kib-a">KIB A</button>
    <button type="button" name="KIB-B-" class="btn btn-lg btn-success kib-b">KIB B</button>
    <button type="button" name="KIB-C-" class="btn btn-lg btn-success kib-c">KIB C</button>
    <button type="button" name="KIB-D-" class="btn btn-lg btn-success kib-d">KIB D</button>
    <button type="button" name="KIB-E-" class="btn btn-lg btn-success kib-e">KIB E</button>
    <button type="button" name="KIB-F-" class="btn btn-lg btn-success kib-f">KIB F</button>
	<fieldset>
	
	    <label for="kode">Kode Barcode</label>
        <input type="hidden" id="kode-hidden" value="<?php $val=isset($_POST['generate']) ? $_POST['kode'] : ""; echo $val; ?>">
	    <input type="text" readonly name="kode" id="kode" minlength="4" maxlength="20" required 
                value="<?php $val=isset($_POST['generate']) ? $_POST['kode'] : ""; echo $val; ?>">
	
    <p id="peringatan"></p>
    <h1 class="next"></h1>
	
	<input type="submit" name="generate" id="btn_submit" value="Generate Code" class="save">
	
	</fieldset>
	</form>
	
	
    <?php
	if (isset($_POST['generate'])){
	
        include "simandor/phpqrcode/qrlib.php"; 

        $tempdir = "simandor/temp/"; //Nama folder tempat menyimpan file qrcode
        if (!file_exists($tempdir)) //Buat folder bername temp
        mkdir($tempdir);

        //ambil logo
        //$logopath="https://cdn.pixabay.com/photo/2018/05/08/18/25/facebook-3383596_960_720.png";
        $logopath="Images/logopemda.png";

        //isi qrcode jika di scan
        $codeContents = $_POST['kode']; 

        //simpan file qrcode
        QRcode::png($codeContents, $tempdir.'qrwithlogo'.$codeContents.'.png', QR_ECLEVEL_H, 10,4);


        // ambil file qrcode
        $QR = imagecreatefrompng($tempdir.'qrwithlogo'.$codeContents.'.png');

        // memulai menggambar logo dalam file qrcode
        $logo = imagecreatefromstring(file_get_contents($logopath));
        
        imagecolortransparent($logo , imagecolorallocatealpha($logo , 0, 0, 0, 127));
        imagealphablending($logo , false);
        imagesavealpha($logo , true);

        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);

        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);

        // Scale logo to fit in the QR Code
        $logo_qr_width = $QR_width/4;
        $scale = $logo_width/$logo_qr_width;
        $logo_qr_height = $logo_height/$scale;

        imagecopyresampled($QR, $logo, $QR_width/0.6, $QR_height/0.8, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

        // Simpan kode QR lagi, dengan logo di atasnya
        //imagepng($QR,$tempdir.''.$codeContents.'.png');

        //menampilkan file qrcode 
        echo '<div align="center">'; 
		echo "<button type=button class='btn btn-lg btn-primary cekData'>Cetak</button>";
		echo "&nbsp;&nbsp;&nbsp;<button type=button class='btn btn-lg btn-primary cekData2'>Cetak BAR KODE 2030</button>";
        echo '<br><a href="https://www.hstkab.go.id">Aset Pemerintah Kabupaten HST</a><div>';        
        echo '<img src="Images/logopemda.png" align=top/>';
        echo '<img src="'.$tempdir.'qrwithlogo'.$codeContents.'.png'.'" />';
        //echo "<p class=cetak><a href='qr2.php?file=".$tempdir."qrwithlogo'.$codeContents.'.png'>$codeContents</a></p>";
        echo "<br>$codeContents</br>";
       
       
	}
    ?>

    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pemberitahuan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Kode sudah pernah di daftarkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                    <!-- <button type="button" class="btn btn-primary">Save</button> -->
                </div>
            </div>
        </div>
    </div>
</body>
</div>
</html>

<script type="text/javascript">
	$("document").ready(function()
	{
        $(".kib-a,.kib-b,.kib-c,.kib-d,.kib-e,.kib-f").click(function(e){	
      
                    var btnName = $(this).attr("name");
					//alert(btnName);
                    var kode = btnName;
                    $('#peringatan').hide();
                    
                    $.post( "cekNumberKib.php",{"kode": kode}, function( data ) {                        
                        if(data['peringatan'] == 1){
                            $('#peringatan').show();
                        }                        				
                        //$(".next").html(data['next']);
                        $('#kode').val(data['next']);
                    },"json");
                    
        });

        $(".cetak").click(function(e){	
      
            var kode =  $('#kode').val();
            //alert(kode);
            $.post( "saveNumberKib.php",{"kode": kode}, function( data ) {                        
                      
                        if(data['msg'] == "exist"){
                            alert("dobel data");
                        }else{
                            //alert(data['msg']);
                        }   
                                             				
                    },"json");
           
            
        });

        $(".cekData").click(function(){
            
            var kode =  $('#kode').val();

            $.post( "saveNumberKib.php",{"kode": kode}, function( data ) {                        
                      
                        if(data['msg'] == "exist"){
                            $("#myModal").modal('show');
                        }else{
                            //alert(data['msg']);
                            window.location = 'Cetak_Bar_Code_.php?file=simandor/temp/qrwithlogo'+kode+'.png';

                            

                        }   
                                             				
                    },"json");

        });

        $(".cekData2").click(function(){
            
            var kode =  $('#kode').val();

            $.post( "saveNumberKib.php",{"kode": kode}, function( data ) {                        
                      
                        if(data['msg'] == "exist"){
                            $("#myModal").modal('show');
                        }else{
                            //alert(data['msg']);
                            // window.location = 'Cetak_Bar_Code2_kosong.php?file=simandor/temp/qrwithlogo'+kode+'.png';
                            window.location = 'Cetak_Bar_Code2.php?file=simandor/temp/qrwithlogo'+kode+'.png';
                        }   
                                             				
                    },"json");

        });

    });
</script>
