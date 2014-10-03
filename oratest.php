<?php
//  echo system("c:/oracle/product/11.2.0.4/bin/tnsping HARDX 2>&1")."<br />";
//  echo 'NLS_LANG='.getenv('NLS_LANG');

$conn = oci_connect('hardx', 'zaq12wsx', 'HARDX', 'AL32UTF8');
//$conn = oci_connect('hardx', 'zaq12wsx', 'HARDX');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, 'SELECT * FROM v$version');
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}

$item=getenv('NLS_LANG');
$item="NLS_LANG=$item";
echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";

echo "</table>\n";
?>