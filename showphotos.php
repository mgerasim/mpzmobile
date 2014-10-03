<?php	

	if (!array_key_exists('id', $_REQUEST)) {
		echo "Request must have param id";
		exit;
	}
	
	class scanDir {
    static private $directories, $files, $ext_filter, $recursive;

// ----------------------------------------------------------------------------------------------
    // scan(dirpath::string|array, extensions::string|array, recursive::true|false)
    static public function scan(){
        // Initialize defaults
        self::$recursive = false;
        self::$directories = array();
        self::$files = array();
        self::$ext_filter = false;

        // Check we have minimum parameters
        if(!$args = func_get_args()){
            die("Must provide a path string or array of path strings");
        }
        if(gettype($args[0]) != "string" && gettype($args[0]) != "array"){
            die("Must provide a path string or array of path strings");
        }

        // Check if recursive scan | default action: no sub-directories
        if(isset($args[2]) && $args[2] == true){self::$recursive = true;}

        // Was a filter on file extensions included? | default action: return all file types
        if(isset($args[1])){
            if(gettype($args[1]) == "array"){self::$ext_filter = array_map('strtolower', $args[1]);}
            else
            if(gettype($args[1]) == "string"){self::$ext_filter[] = strtolower($args[1]);}
        }

        // Grab path(s)
        self::verifyPaths($args[0]);
        return self::$files;
    }

    static private function verifyPaths($paths){
        $path_errors = array();
        if(gettype($paths) == "string"){$paths = array($paths);}

        foreach($paths as $path){
            if(is_dir($path)){
                self::$directories[] = $path;
                $dirContents = self::find_contents($path);
            } else {
                $path_errors[] = $path;
            }
        }

        if($path_errors){echo "The following directories do not exists<br />";die(var_dump($path_errors));}
    }

    // This is how we scan directories
    static private function find_contents($dir){
        $result = array();
        $root = scandir($dir);
        foreach($root as $value){
            if($value === '.' || $value === '..') {continue;}
            if(is_file($dir.DIRECTORY_SEPARATOR.$value)){
                if(!self::$ext_filter || in_array(strtolower(pathinfo($dir.DIRECTORY_SEPARATOR.$value, PATHINFO_EXTENSION)), self::$ext_filter)){
                    self::$files[] = $result[] = $dir.DIRECTORY_SEPARATOR.$value;
                }
                continue;
            }
            if(self::$recursive){
                foreach(self::find_contents($dir.DIRECTORY_SEPARATOR.$value) as $value) {
                    self::$files[] = $result[] = $value;
                }
            }
        }
        // Return required for recursive search
        return $result;
    }
}

	
	echo "<!doctype html>";
	echo "<html";
	echo "<head>";	
	echo "</head>";
	echo "<body>";
	echo "<table>";
	
	$dbconn = pg_connect("host=localhost dbname=postgres user=monter password=zaq12wsx")
	or die('Could not connect: ' . pg_last_error());
	
	$result = pg_query($dbconn, "SELECT * FROM monter.photos WHERE id=".$_REQUEST['id']);
	if (!$result) {
	  echo "Error select from photos by id.\n";
	  exit;
	}
	echo "<tr>";
	echo "	<td>#</td>";	
	echo "</tr>";
	
	
	while ($row = pg_fetch_row($result)) {
		$file_ext = array(
			"jpg",
			"jpeg",
			"bmp",
			"png"
		);
		$dirs = array(
			$row[1]
		);
		$files = scanDir::scan($dirs, $file_ext);
		foreach($files as $photo) {
			$type = pathinfo($photo, PATHINFO_EXTENSION);
			$data = file_get_contents($photo);
			$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
			
			echo '<img src="'.$base64.'">';

		}
		

		echo "<tr>";
		echo "	<td>$row[0]</td>";		
		echo "</tr>";	  
	}
	echo "";
	echo "</table>";
	echo "</body>";
	echo "</html>";
?>
