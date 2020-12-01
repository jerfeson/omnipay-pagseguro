<?php

namespace Omnipay\PagSeguro;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{

    /**
     * @var Gateway
     */
    protected $gateway;

    /**
     * @var array
     */
    protected $options;


    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->options = [
            'transactionId' => '1',
            'amount' => '10.00',
            'currency' => 'BRL',
            'returnUrl' => 'https://www.example.com/return',
            'cancelUrl' => 'https://www.example.com/cancel',
            'NotifyUrl' => 'https://www.example.com/notify',
        ];
    }


    public function testPurchaseSuccess()
    {
        $this->setMockHttpResponse('GatewayPurchaseSuccess.txt');
        $response = $this->gateway->purchase($this->options)->send();
    }

}