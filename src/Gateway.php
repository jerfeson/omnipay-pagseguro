<?php

namespace Omnipay\PagSeguro;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class Gateway.
 *
 * @author Jerfeson Guerreiro <jerfeson_guerreiro@hotmail.com>
 *
 * @since 1.0.0
 *
 * @version 1.0.0
 *
 * @see https://dev.pagseguro.uol.com.br/docs/checkout-web
 *
 * @method ResponseInterface authorize(array $options = [])
 * @method ResponseInterface completeAuthorize(array $options = [])
 * @method ResponseInterface capture(array $options = [])
 * @method ResponseInterface void(array $options = [])
 * @method ResponseInterface createCard(array $options = [])
 * @method ResponseInterface updateCard(array $options = [])
 * @method ResponseInterface deleteCard(array $options = [])
 * @method RequestInterface fetchTransaction(array $options = [])
 */
class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'PagSeguro';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'email' => '',
            'token' => '',
            'testMode' => false,
        ];
    }

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
     * @return Gateway
     */
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->getParameter('token');
    }

    /**
     * @param $value
     *
     * @return Gateway
     */
    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|RequestInterface
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PagSeguro\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|RequestInterface
     */
    public function acceptNotification(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PagSeguro\Message\NotificationRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|RequestInterface
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PagSeguro\Message\NotificationRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|RequestInterface
     */
    public function refund(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\PagSeguro\Message\RefundRequest', $parameters);
    }

}
