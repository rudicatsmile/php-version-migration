<?php
    header('content-type: multipart/form-data');
    ini_set('memory_limit', '256M');
    ini_set('max_execution_time', 300);
    ini_set('upload_max_filesize', '100M');

    require_once 'connect.php';

    $idt = $_GET['idt'];
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    $date = date('Y-m-d');

    $lat_lng = "LatLng(".$lat.",".$lng.")";

    /*
    $image = $_FILES['image']['name'];   
    $imagePath = '../simandor/images/'.$image; 
    $tmp_name = $_FILES['image']['tmp_name']; 
    //echo $_FILES['image']['error'] ; //Bila 1:error - 0:success [if error cek php.ini -> upload_max_filesize]
    move_uploaded_file($tmp_name, $imagePath);
    */    

    $target_dir = "../simandor/images/";
	$file = $_FILES['image']['name'];
	$path = pathinfo($file);
	$filename = $idt.'xyz'.$path['filename'];
	$ext = $path['extension'];
	$temp_name = $_FILES['image']['tmp_name'];
	$path_filename_ext = $target_dir.$filename.".".$ext;

	if (file_exists($path_filename_ext)) {

		//file already exists.";
		$response=array(
            'status' => 0,
            'message' =>'Data Failed to input'
        );

	}else{
		move_uploaded_file($temp_name,$path_filename_ext);

		//Insert temprary table
		//$sql = "insert into aa_upload_image set image='".$filename.".".$ext."', date='".$date."'";
    	//$result = mysqli_query($conn, $sql);

    	//Update tabel ta_kib_108
    	$file_name = $_FILES['image']['name'];       //nama file (tanpa path)
	    $tmp_name  = $_FILES['image']['tmp_name'];   //nama local temp file di server
	    $file_size = $_FILES['image']['size'];       //ukuran file (dalam bytes)
	    $file_type = $_FILES['image']['type'];       //tipe filenya (langsung detect MIMEnya)


	   /*
	    $fp = fopen($tmp_name, 'r');                // open file (read-only, binary)
            $file_content = fread($fp, $file_size) or die("Tidak dapat membaca source file X"); // read file
            $file_content = mysql_real_escape_string($file_content) or die("Tidak dapat membaca source file XX"); // parse image ke string
            fclose($fp);
    	   */

	    // field ini lewat dulu :  file_content='$file_content',
    	$nSQL = "UPDATE ta_kib_108 SET 
				    file_name='$file_name', 
				    file_type='$file_type', 
				    lat='$lat', 
				    lng='$lng', 
                                    file_content='$file_content',
				    lat_lng='$lat_lng', 
				    file_size='$file_size' WHERE IDT='".$idt."'";
		$result = mysqli_query($conn, $nSQL);

		if($result){
			$response=array(
	            'status' => 1,'message' =>'Data input successfully'
	        );	       
	    }else{
			$response=array(
	            'status' => 0,'message' =>'Data Failed to input'
	        );

	    }
	}
   
   /*
    $fp = fopen($tmp_name, 'r');                // open file (read-only, binary)
    $file_content = fread($fp, $file_size) or die("Tidak dapat membaca source file X"); // read file
    $file_content = mysql_real_escape_string($file_content) or die("Tidak dapat membaca source file XX"); // parse image ke string
    fclose($fp); 

   */
  

    
    
?>
