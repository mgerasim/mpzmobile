<?php		
	$dbconn = pg_connect("host=localhost dbname=postgres user=monter password=zaq12wsx")
	or die('Could not connect: ' . pg_last_error());
	
	$export = pg_query($dbconn, "SELECT * FROM mpz.orders ORDER BY id DESC");
	if (!$export) {
	  echo "Error select from photos.\n";
	  exit;
	}
	
$fields = pg_num_fields ( $export );

for ( $i = 0; $i < $fields; $i++ )
{
    $header .= pg_field_name( $export , $i ) . "\t";
}

while( $row = pg_fetch_row( $export ) )
{
    $line = '';
    foreach( $row as $value )
    {
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n" . "<br />";
}
$data = str_replace( "\r" , "" , $data );



if ( $data == "" )
{
    $data = "\n(0) Records Found!\n";
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=mpzorders.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";


?>
