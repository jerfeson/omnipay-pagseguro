<?php

namespace Omnipay\PagSeguro\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Class AbstractRequest
 *
 * @package Omnipay\PagSeguro\Message
 *
 * @author Jerfeson Guerreiro <jerfeson_guerreiro@hotmail.com>
 *
 * @since 1.0.0
 *
 * @version 1.0.0
 *
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://ws.pagseguro.uol.com.br/v2';
    protected $testEndpoint = 'https://ws.sandbox.pagseguro.uol.com.br/v2';

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->getParameter('email');
    }

    /**
     * @param $value
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
     * @return AbstractRequest
     */
    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    /**
     * @param mixed $data
     * @return ResponseInterface|Response
     */
    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request(
            'POST',
            $this->getEndpoint(),
            [],
            http_build_query($data, '', '&')
        );

        return $this->createResponse($httpResponse->getBody()->getContents());
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    /**
     * @param $data
     * @return Response
     */
    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }
}