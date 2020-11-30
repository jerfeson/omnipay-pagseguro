<?php

namespace Omnipay\PagSeguro\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

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
        parse_str($data, $this->data);
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data['code']) && isset($this->data['date']);
    }

    /**
     * @return mixed|string|null
     */
    public function getTransactionReference()
    {
        return $this->data['code'];
    }
}
