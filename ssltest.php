<?php
$url = "https://10.184.86.12:8445/xmlInteface";
$dir = "c:/apache24/cert";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSLCERT, 'c:/apache24/cert/server.pem');
curl_setopt($ch, CURLOPT_SSLKEY, 'c:/apache24/cert/server.key');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$request = <<<ABS
<CreateOrder>
    <orders>
        <order>
            <Num>1</Num>
            <Date>2013-10-28T00:00:00+06:00</Date>
            <Client LastName="Иванов" FirstName="Иван" MiddleName="Иванович" birthDate="2001-02-25T00:00:00+06:00" contactCellPhone="1234567890" contactHomePhone="9876543210" contactEmail="ru@ru.ru" contactPerson="Фамилия Имя Отчество" IDCardType="1" IDCardSeria="1234" IDCardNumber="123456" IDCardAuthority="увд" IDCardDate="2010-06-09T00:00:00+06:00"/>
            <Product SvcClassId="1" TarId="120708" TechId="3" contractNum="666" contractDate="2006-06-06T00:00:00+06:00">
                <tarOptions>
                    <tarOption Id="base"/>
                </tarOptions>
                <instAdrPhone>4232444050</instAdrPhone>
                <instAdr>
                    <RegionId>25</RegionId>
                    <Code>S25000001000023800</Code>
                    <Level>40</Level>
                    <HouseId>264437</HouseId>
                    <House>10</House>
                    <Flat>02</Flat>
                </instAdr>
            </Product>
            <ChannelId>3</ChannelId>
            <OrgId>123</OrgId>
        </order>
    </orders>
</CreateOrder>
ABS;

$postfields = array(
    'xml' => $request
);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

ob_start();
curl_exec($ch);

if(curl_errno($ch) != 0 ) {
   die('CURL_error: ' . curl_errno($ch) . ', ' . curl_error($ch));
};

$content = ob_get_contents();
ob_end_clean();
curl_close($ch);

echo $content;
?>
