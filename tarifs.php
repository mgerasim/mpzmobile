<?php

$request = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" +
						 "<request reqType=\"GET_AV_TARIFF_INFO\" "+
							"svcNum=\"q5345a22\" " +
							"svcTypeId="INTERNET_LOGIN" ' +
							"<SvcAddress ' +
							"> '+
							"infoType="2" ' +
							"destSystem="1" ' +
							"svcClassIdList="" ' +
						'</request>'";

$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);

$context = stream_context_create($opts);

/* Sends an http request to www.example.com
   with additional headers shown above */
$fp = fopen('http://www.example.com', 'r', false, $context);
fpassthru($fp);
fclose($fp);
?>
