<?
    //function upload_files($fil,)
    function upload_files($gUpb,$gThn,$gKib,$UID)
    {
		if((!empty($_FILES["car_info_file"])) && ($_FILES['car_info_file']['error'] == 0)) 
		{
			//Check if the file is JPEG image and it's size is less than 350Kb
			$filename = str_replace('.','',$gUpb).$gThn."-".basename($_FILES['car_info_file']['name']);
			$ext = substr($filename, strrpos($filename, '.') + 1);
			//echo $ext;
			//if (($ext == "xls") && ($_FILES["car_info_file"]["type"] == "text/xls" ) && ($_FILES["car_info_file"]["size"] <= 500000000)) 
			if ($ext == "xls" || $ext == "xlsx")  
			{
				$newname = 'xls_file/kib_'.strtolower($gKib).'_xls_file/'.$filename;
				//$newname = 'xls_file/kib_a_xls_file/'.$filename;
				//Check if the file with the same name is already exists on the server
				if (!file_exists($newname)) 
				{
					//Attempt to move the uploaded file to it's new place
					if ((move_uploaded_file($_FILES['car_info_file']['tmp_name'],$newname))) 
					{
						$gNm= str_replace('.','',$gUpb).$gThn."-".$_FILES["car_info_file"]["name"];
						$gSz= $_FILES["car_info_file"]["size"];
						
						$SQ ="INSERT INTO ta_upload_excel SET 
						Kd_UPB='$gUpb', 
						KIB='$gKib', 
						Nm_File='$gNm', 
						Size='$gSz', 
						Tahun='$gThn',
						Imported='N',
						Recorded=now(),
						Pencatat='$UID'";
						$rs = mysql_query($SQ) or die(mysql_error());	
						
						echo "<div style='background-color:#C0C0C0;color:#0099CC;font-weight:bold;text-align:center;'>Upload data berhasil...!!!</div>";
					} 
					else 
					{
						echo "Error: A problem occurred during file upload!";
					}
				} 
				else 
				{
					echo "Error: File ".$_FILES["car_info_file"]["name"]." already exists";
				}
			} 
			else 
			{
				echo "Error: Only *.xls OR xlsx files are accepted for upload";
			}
		} 
		else 
		{
			echo "Error: No file uploaded";
		}
    }
	?>