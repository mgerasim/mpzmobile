<?php

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
		echo "Request must have POST method";
		exit;
	}
	
	
	if (!array_key_exists('account', $_REQUEST)) {
		echo "Request must have param account";
		exit;
	}

	if (!array_key_exists('sn', $_REQUEST)) {
		echo "Request must have param sn";
		exit;
	}
	
	$file_path = "C:\\upload\\";
	
     
    $file_path = $file_path.basename( $_FILES['zip']['name']);	
    if(!move_uploaded_file($_FILES['zip']['tmp_name'], $file_path)) {        
        echo "Fail upload file";
		echo "\n";
		echo print_r($_FILES);
		echo "\n";
		echo print_r($_REQUEST);
		exit;
    }
	$src_path = 'C:\\storage\\'.$_REQUEST['account'];
	if (!file_exists($src_path)) {
		mkdir($src_path, 0777, true);
	}
	shell_exec('c:\upload\winrar\winrar.exe x -o+ -ptest123! '.$file_path.' '.$src_path); 
	
	$dirlist = glob("$src_path\\*", GLOB_ONLYDIR);
	
	$src_path = $dirlist[0];
	
	$dbconn = pg_connect("host=localhost dbname=postgres user=monter password=zaq12wsx")
	or die('Could not connect: ' . pg_last_error());

	$ver = pg_query($dbconn,
"INSERT INTO monter.photos(src, account, sn) VALUES ('$src_path','{$_REQUEST['account']}', '{$_REQUEST['sn']}' )"
	);
	
	pg_close($dbconn);
	
	echo "OK";
?>
