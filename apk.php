<?php

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
		echo "Request must have POST method";
		exit;
	}
	

		
	$file_path = "C:\\Apache24\\htdocs\\apk\\monter.apk";
	
     
    if(!move_uploaded_file($_FILES['apk']['tmp_name'], $file_path)) {        
        echo "Fail upload file";
		echo "\n";
		echo print_r($_FILES);
		echo "\n";
		echo print_r($_REQUEST);
		exit;
    }
	
	
	echo "OK";
?>
