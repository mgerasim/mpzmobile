<?php

/*
$request = <<<ABS
<CreateOrder>
    <orders>
        <order>
            <Num>1</Num>
            <Date>2013-10-28T00:00:00+06:00</Date>
            <Client LastName="Иванов" FirstName="Иван" MiddleName="Иванович" birthDate="2001-02-25T00:00:00+06:00" contactCellPhone="1234567890" contactHomePhone="9876543210" contactEmail="ru@ru.ru" contactPerson="Фамилия Имя Отчество" IDCardType="1" IDCardSeria="1234" IDCardNumber="123456" IDCardAuthority="увд" IDCardDate="2010-06-09T00:00:00+06:00"/>
            <Product SvcClassId="2" TarId="170635" TechId="3" contractNum="666" contractDate="2006-06-06T00:00:00+06:00">
                <tarOptions>
                    <tarOption Id="iptv_popular"/>
                </tarOptions>
                <instAdrPhone>9241086799</instAdrPhone>
                <instAdr>
                    <RegionId>27</RegionId>                   
                </instAdr>
            </Product>
            <ChannelId>3</ChannelId>
            <OrgId>123</OrgId>
        </order>
    </orders>
</CreateOrder>
ABS;
*/

$request = <<<ABS
<CreatePacketOrder>
    <orders>
        <order>
            <Num>1</Num>
            <Date>2013-10-28T00:00:00+06:00</Date>
            <Client LastName="Иванов" FirstName="Иван" MiddleName="Иванович" birthDate="2001-02-25T00:00:00+06:00" contactCellPhone="1234567890" contactHomePhone="9876543210" contactEmail="ru@ru.ru" contactPerson="Фамилия Имя Отчество" IDCardType="1" IDCardSeria="1234" IDCardNumber="123456" IDCardAuthority="увд" IDCardDate="2010-06-09T00:00:00+06:00"/>
<contractNum>666</contractNum>
<contractDate>2006-06-06T00:00:00+06:00</contractDate>
   <Products>
            <Product SvcClassId="1" TarId="170634" TechId="3" >
                <tarOptions>
                    <tarOption Id="base"/>
                </tarOptions>
                <instAdrPhone>8924110890</instAdrPhone>
                <instAdr>
                    <RegionId>27</RegionId>
                </instAdr>
				
				<note>test</note>
            </Product>
                  <Product SvcClassId="2" TarId="170633" TechId="3" >
                <tarOptions>
                   <tarOption Id="iptv_popular"/>
                </tarOptions>
                <instAdrPhone>9241108890</instAdrPhone>
                <instAdr>
                    <RegionId>27</RegionId>
                </instAdr>
				
				<note>test</note>
            </Product>
                 <Product SvcClassId="3" TarId="170635" >
                
                <instAdrPhone>9241108890</instAdrPhone>
                <instAdr>
                    <RegionId>27</RegionId>
                </instAdr>
				<note>test</note>
            </Product>
   </Products>
            <ChannelId>17</ChannelId>
            <OrgId>2004890</OrgId>
			<note>test2</note>
        </order>
    </orders>
</CreatePacketOrder>
ABS;
/*
<CreatePacketOrder> <orders> <order> <Num>1</Num> <Date>2013-10-28T00:00:00+06:00</Date> <Client LastName="Герасимовцц" FirstName="Михаилцц" MiddleName="Николаевичцц" birthDate="2001-02-25T00:00:00+06:00" contactCellPhone="79841086893" contactHomePhone="79841086893" contactEmail="" contactPerson="Михаилцц" IDCardType="1" IDCardSeria="1234" IDCardNumber="123456" IDCardAuthority="увд" IDCardDate="2010-06-09T00:00:00+06:00"/> <contractNum>666</contractNum> <contractDate>2006-06-06T00:00:00+06:00</contractDate> <Products> <Product SvcClassId="1" TarId="170634" TechId="3" > <tarOptions> <tarOption Id="base"/> </tarOptions> <instAdrPhone>79841086893</instAdrPhone> <instAdr> <RegionId>27</RegionId> </instAdr> </Product> <Product SvcClassId="1" TarId="170635" TechId="3" > <tarOptions> <tarOption Id="base"/> </tarOptions> <instAdrPhone>79841086893</instAdrPhone> <instAdr> <RegionId>27</RegionId> </instAdr> </Product> </Products> <ChannelId>17</ChannelId> <OrgId>2004890</OrgId> </order> </orders> </CreatePacketOrder>
*/


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

echo $content;


