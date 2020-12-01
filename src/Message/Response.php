<?php

namespace Omnipay\PagSeguro\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use function GuzzleHttp\Psr7\str;

/**
 * Class Response.
 *
 * @author Jerfeson Guerreiro <jerfeson_guerreiro@hotmail.com>
 *
 * @since 1.0.0
 *
 * @version 1.0.0
 */
class Response extends AbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        if (isset($this->data['code']) && isset($this->data['date']) || reset($this->data) === 'OK') {
            return true;
        }

        return false;
    }

    /**
     * @return mixed|string|null
     */
    public function getTransactionReference()
    {
        return $this->data['code'];
    }


    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        return isset($this->data['error']) ? "{$this->data['error']['code']} - {$this->data['error']['message']}" : null;
    }

    /**
     * @return string|void|null
     */
    public function getRedirectUrl()
    {
        $request = $this->getRequest();
        $endpoint = str_replace('ws.', '', $request->getEndpoint());
        return "{$endpoint}/payment.html?code={$this->getTransactionReference()}";
    }

}
