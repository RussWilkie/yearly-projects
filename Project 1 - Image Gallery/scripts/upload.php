<?php
$valid_formats = array("JPG", "PNG", "GIF", "BMP", "jpeg");
$path = "../images/gallery/"; // Upload directory
$count = 0;

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	// Loop $_FILES to execute all files
	foreach ($_FILES['file-upload']['name'] as $f => $name) {
		$imageFileType = strtolower(pathinfo($name,PATHINFO_EXTENSION));		
	    if ($_FILES['file-upload']['error'][$f] == 4) {
			echo 'file not found';
	        continue; // Skip file if any error found		
	    }	       
	    if ($_FILES['file-upload']['error'][$f] == 0) {	           
	       if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif"){
				echo 'invalid format';
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files 
	            if(move_uploaded_file($_FILES["file-upload"]["tmp_name"][$f], $path.$name))
	            $count++; // Number of successfully uploaded file
	        }
	    }
	}
	header('Location: ../sample.html');
		exit;
}
else {
        echo "Sorry, there was an error in uploading";
    }
?>