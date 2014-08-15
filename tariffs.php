<?php

$request = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>".
						 "<request reqType=\"GET_AV_TARIFF_INFO\" ".
							"svcNum=\"q5345a22\" ".
							"svcTypeId=\"INTERNET_LOGIN\" ".
							"<SvcAddress ".
							"> ".
							"infoType=\"2\" ".
							"destSystem=\"1\" ".
							"svcClassIdList=\"\" ".
						"</request>";
						
echo $request = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
			
echo $request;

$url = 'http://10.200.2.47:85/elk';
$data = array('xml' => $request);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

var_dump($result);

?>
