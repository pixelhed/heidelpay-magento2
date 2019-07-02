<?php
/**
 * Created by PhpStorm.
 * User: David.Owusu
 * Date: 19.06.2019
 * Time: 15:35
 */

namespace Heidelpay\Gateway\Test\Integration\data\provider;


use SimpleXMLElement;

class PushResponse
{
    public $xmlString = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Response version="1.0">
    <Transaction mode="CONNECTOR_TEST" channel="31HA07BC8181E8CCFDAD49A7CD9E0420">
        <Identification>
            <TransactionID>521</TransactionID>
            <UniqueID>31HA07BC819A0F7EF2A6A76B5818D34D</UniqueID>
            <ShortID>4242.8118.4858</ShortID>
            <ShopperID>2</ShopperID>
            <ReferenceID>31HA07BC819A0F7EF2A68B79A7E2E9C9</ReferenceID>
            <CreditorID>DE00000000000000000000</CreditorID>
        </Identification>
        <Processing code="OT.RC.90.00">
            <Timestamp>2019-06-12 15:53:04</Timestamp>
            <Result>ACK</Result>
            <Status code="90">NEW</Status>
            <Reason code="00">SUCCESSFULL</Reason>
            <Return code="000.100.112">Request successfully processed in 'Merchant in Connector Test Mode'</Return>
        </Processing>
        <Payment code="OT.RC">
            <Clearing>
                <Amount>53.55</Amount>
                <Currency>EUR</Currency>
                <Descriptor>4242.8116.1848 Heidelpay QA </Descriptor>
            </Clearing>
            <Presentation>
                <Amount>53.55</Amount>
                <Currency>EUR</Currency>
                <Usage>4242.8116.1848 Heidelpay QA </Usage>
            </Presentation>
        </Payment>
        <Account>
            <Expiry/>
            <Brand>SOFORT</Brand>
            <Identification>4242.8116.1848</Identification>
        </Account>
        <Customer>
            <Name>
                <Given>Lemon</Given>
                <Family>Mustermann</Family>
            </Name>
            <Address>
                <Street>Hugo-Jünkers Straße 491</Street>
                <Zip>60386</Zip>
                <City>Frankfurt am Main</City>
                <Country>DE</Country>
            </Address>
            <Contact>
                <Email>david.owusu@heidelpay.de</Email>
            </Contact>
        </Customer>
        <Frontend>
            <ResponseUrl>https://test-heidelpay.hpcgw.net/ngw/responsePa?state=9158be8fffffffff17fcff09</ResponseUrl>
        </Frontend>
        <Analysis>
            <Criterion name="SHOP.TYPE">Magento 2.2.8-Community</Criterion>
            <Criterion name="SDK_NAME">Heidelpay\PhpPaymentApi</Criterion>
            <Criterion name="SECRET">d83f0dae2fca921d00cb70559762a365e55870e0cad5384177a931379e04d0204fb8d01ee16ef109f27ec67fb181e748d688119cf82966f59ab1db476d460a5e</Criterion>
            <Criterion name="SDK_VERSION">v1.8.0</Criterion>
            <Criterion name="PAYMENT_METHOD">SofortPaymentMethod</Criterion>
            <Criterion name="SHOPMODULE.VERSION">Heidelpay Gateway 19.5.08</Criterion>
            <Criterion name="GUEST">false</Criterion>
        </Analysis>
        <RequestTimestamp>2019-06-12 15:53:04</RequestTimestamp>
    </Transaction>
</Response>
XML;

    public function providePushXml(array $specifyValue = [])
    {
        $xmlString = $this->xmlString;
        foreach ($specifyValue as $key => $value) {
            $pattern = '/<' .$key. '>.*<\/'.$key.'>/';
            $replacement = '<' . $key . '>'. $value . '</'.$key.'>';
            $xmlString = preg_replace($pattern, $replacement, $xmlString);
        }

        return $xmlString;
    }
}