<?php 
	$fileName = $_FILES["selectedFile"]["name"];
	$fileTmpLoc = $_FILES["selectedFile"]["tmp_name"]; // File in the PHP tmp folder
	$fileType = $_FILES["selectedFile"]["type"]; // The type of file it is
	$fileSize = $_FILES["selectedFile"]["size"]; // File size in bytes
	$fileErrorMsg = $_FILES["selectedFile"]["error"]; // 0 for false... and 1 for true
	if (!$fileTmpLoc) { // if file not chosen
		echo "ERROR: Please browse for a file before clicking the upload button.";
		exit();
	}
	if(is_uploaded_file($fileTmpLoc)) {
		if(move_uploaded_file($fileTmpLoc, "outputs/". iconv("UTF-8", "CP949", $fileName))){
			echo $fileName;
		} else {
			echo "upload is failed";
		}	
	}
?>