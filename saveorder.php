<?php

$comments = "Адрес: {$_REQUEST['address']} Тариф: {$_REQUEST['tariff']} Примечание: {$_REQUEST['comments']}Агент: {$_REQUEST['user']}";

$usluga_1 = $_REQUEST['usluga-1'];
$usluga_2 = $_REQUEST['usluga-2'];
$usluga_3 = $_REQUEST['usluga-3'];

$usluga_count = 0;

if ($usluga_1 == 'true') {
	$usluga_count++;
}

if ($usluga_2 == 'true') {
	$usluga_count++;
}

if ($usluga_3 == 'true') {
	$usluga_count++;
}

if ($usluga_count == 0) {
	$usluga_1 = 'true';
	$usluga_count = 1;
}

$request = "";

$usluga_count = 2;

if ($usluga_count > 1) {
	$request = '<CreatePacketOrder>
			<orders>
				<order>
					<Num>1</Num>
					<Date>2013-10-28T00:00:00+06:00</Date>
					<Client LastName="'."{$_REQUEST['lastname']}".'" FirstName="'."{$_REQUEST['firstname']}".'" MiddleName="'."{$_REQUEST['secondname']}".'" birthDate="2001-02-25T00:00:00+06:00" contactCellPhone="'."{$_REQUEST['phone']}".'" contactHomePhone="'."{$_REQUEST['phone']}".'" contactEmail="" contactPerson="'."{$_REQUEST['firstname']}".'" IDCardType="1" IDCardSeria="1234" IDCardNumber="123456" IDCardAuthority="увд" IDCardDate="2010-06-09T00:00:00+06:00"/>
					<contractNum>666</contractNum>
					<contractDate>2006-06-06T00:00:00+06:00</contractDate>
			<Products>';
			if ($usluga_1 == 'true') {
				$request = $request.'	<Product SvcClassId="1" TarId="170634" TechId="3" >
						<tarOptions>
							<tarOption Id="base"/>
						</tarOptions>
						<instAdrPhone>'."{$_REQUEST['phone']}".'</instAdrPhone> 
						<instAdr> 
							<RegionId>27</RegionId>  
						</instAdr>  
					</Product> ';
			}
			if ($usluga_2 == 'true') {
				$request = $request.'	<Product SvcClassId="2" TarId="170633" TechId="3" >
						<tarOptions>
							<tarOption Id="iptv_popular"/>
						</tarOptions>
						<instAdrPhone>'."{$_REQUEST['phone']}".'</instAdrPhone> 
						<instAdr> 
							<RegionId>27</RegionId>  
						</instAdr>  
					</Product> ';
			}
			if ($usluga_3 == 'true') {
				$request = $request.'	<Product SvcClassId="3" TarId="170635" >
						<tarOptions>
							<tarOption Id="base_personal"/>
						</tarOptions>
						<instAdrPhone>'."{$_REQUEST['phone']}".'</instAdrPhone> 
						<instAdr> 
							<RegionId>27</RegionId>  
						</instAdr>  
					</Product> ';
			}
			$request = $request.' </Products>
					<note>'.$comments.'</note>
					<ChannelId>27</ChannelId>
					<OrgId>2004890</OrgId>
		</order>
		</orders>
		</CreatePacketOrder>';

	}
else {
$request = <<<ABS
<?xml version="1.0" encoding="UTF-8"?>
<CreateOrder>
    <orders>
        <order>
            <Num>1</Num>
            <Date>2013-10-28T00:00:00+06:00</Date>
            <Client LastName="{$_REQUEST['lastname']}" FirstName="{$_REQUEST['firstname']}" MiddleName="{$_REQUEST['secondname']}" birthDate="2001-02-25T00:00:00+06:00" contactCellPhone="{$_REQUEST['phone']}" contactHomePhone="{$_REQUEST['phone']}" contactEmail="" contactPerson="{$_REQUEST['firstname']}" IDCardType="1" IDCardSeria="1234" IDCardNumber="123456" IDCardAuthority="увд" IDCardDate="2010-06-09T00:00:00+06:00"/>
            <Product SvcClassId="1" TarId="170634" TechId="3" contractNum="666" contractDate="2006-06-06T00:00:00+06:00">
                <tarOptions>
                    <tarOption Id="base"/>
                </tarOptions>
                <instAdrPhone>{$_REQUEST['phone']}</instAdrPhone>
                <instAdr>
                    <RegionId>27</RegionId>
                </instAdr>
            </Product>
			<note>{$comments}</note>
            <ChannelId>27</ChannelId>
            <OrgId>123</OrgId>
        </order>
    </orders>
</CreateOrder>
ABS;
}


$url = "https://10.184.86.12:8445/xmlInteface";
$dir = "c:/apache24/cert";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,    $url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSLCERT, 'c:/apache24/cert/cert.pem');
curl_setopt($ch, CURLOPT_SSLKEY,  'c:/apache24/cert/server.key');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
$headers = array(
  'Content-Type: text/xml; charset=utf-8',
  'Content-Length: ' . strlen($request)
);

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);


 
ob_start();
curl_exec($ch);

if(curl_errno($ch) != 0 ) {
   die('CURL_error: ' . curl_errno($ch) . ', ' . curl_error($ch));
};

$content = ob_get_contents();
ob_end_clean();

curl_close($ch);

$xml = simplexml_load_string($content);

$result = $content;

if ($usluga_count>1) {	
	if ($xml->orderCreateResults[0]->orderCreateResult->result == '0') {
		$result = $xml->orderCreateResults[0]->orderCreateResult->orderId;
		$result = $result.$xml->orderCreateResults[0]->orderCreateResult->Products[0]->Product->message;
	} else {		
		
	}	
} else {
	if ($xml->orderCreateResults[0]->orderCreateResult->result == '0') {
		$result = $xml->orderCreateResults[0]->orderCreateResult->orderUserId;
	} else {
		$result = $xml->orderCreateResults[0]->orderCreateResult->message;
	}
}

echo $result;

$dbconn = pg_connect("host=localhost dbname=postgres user=monter password=zaq12wsx")
	or die('Could not connect: ' . pg_last_error());
	
	$ver = pg_query($dbconn,
"INSERT INTO mpz.orders(lastname, firstname, secondname, phone, address, \"user\", result, tariff, comments, city, longitude, latitude, \"supervisor\") VALUES ('{$_REQUEST['lastname']}', '{$_REQUEST['firstname']}','{$_REQUEST['secondname']}','{$_REQUEST['phone']}','{$_REQUEST['address']}', '{$_REQUEST['user']}', '{$result}', '{$_REQUEST['tariff']}', '{$comments}', '{$_REQUEST['city']}', {$_REQUEST['longitude']}, {$_REQUEST['latitude']}, '{$_REQUEST['supervisor']}'  )"
	);
	
	pg_close($dbconn);

