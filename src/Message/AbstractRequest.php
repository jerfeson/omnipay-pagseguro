<?php

namespace Omnipay\PagSeguro\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Class AbstractRequest.
 *
 * @author Jerfeson Guerreiro <jerfeson_guerreiro@hotmail.com>
 *
 * @since 1.0.0
 *
 * @version 1.0.0
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://ws.pagseguro.uol.com.br/v';
    protected $testEndpoint = 'https://ws.sandbox.pagseguro.uol.com.br/v';
    
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->getParameter('email');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    /**
     * @return mixed|string
     */
    public function getToken()
    {
        return $this->getParameter('token');
    }

    /**
     * @param string $value
     *
     * @return AbstractRequest
     */
    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    /**
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }
    
    /**
     * @param mixed $data
     *
     * @return ResponseInterface|Response
     */
    public function sendData($data)
    {
        $httpResponse = $this->getHttp($data);

        if ($httpResponse->getStatusCode() != 200 && $httpResponse->getStatusCode() != 400) {
                $array = [
                    'error' => [
                        'code' => $httpResponse->getStatusCode(),
                        'message' => $httpResponse->getReasonPhrase()
                    ]
                ];

            return $this->createResponse($array);
        }

        $xml = simplexml_load_string($httpResponse->getBody()->getContents(), "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        return $this->createResponse($array);

    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function getHttp($data)
    {
        return $this->httpClient->request(
            $this->getMethod(),
            $this->getEndpoint(),
            $this->getHeaders(),
            http_build_query($data, '', '&')
        );
    }

    public function getHeaders()
    {
        return ['Content-Type' => 'application/x-www-form-urlencoded'];
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        $endPoint = $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
        return  "{$endPoint}{$this->getVersion()}/{$this->getResource()}";
    }

    /**
     * @param $data
     *
     * @return Response
     */
    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }

    /**
     * @return array
     */
    protected function getBaseData() {

        $data = [];
        $data['email'] = $this->getEmail();
        $data['token'] = $this->getToken();

        return $data;
    }
}
