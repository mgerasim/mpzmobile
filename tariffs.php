<?php

$request = <<<ABS
<CreateOrder>
    <orders>
        <order>
            <Num>1</Num>
            <Date>2013-10-28T00:00:00+06:00</Date>
            <Client LastName="Бояндина" FirstName="Лариса" contactCellPhone="9241086744" contactHomePhone="4212322151"/>
            <Product SvcClassId="2" TarId="103162" >                
                <instAdrPhone>4212226062</instAdrPhone>                
            </Product>
            <ChannelId>3</ChannelId>
        </order>
    </orders>
</CreateOrder>

ABS;

echo $request;

$url = 'https://10.184.86.13:8444/';
$data = array('xml' => $request);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-Type: text/xml; charset=UTF-8\r\nAccept: text/xml\r\nAccept-Charset: UTF-8\r\n",
        'method'  => 'POST',
        'content' => 'xml='.$request,
    ),
);

 
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

var_dump($result);

?>
