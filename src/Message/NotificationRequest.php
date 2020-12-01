<?php


namespace Omnipay\PagSeguro\Message;


/**
 * Class NotificationRequest
 *
 * @see https://dev.pagseguro.uol.com.br/docs/api-notificacao-v1
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
class NotificationRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $resource = 'transactions/notifications';

    /**
     * @var string
     */
    protected $version = '3';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @return mixed
     */
    public function getNotificationType()
    {
        return $this->getParameter('notificationType');
    }

    /**
     * @param $value
     *
     * @return PurchaseRequest
     */
    public function setNotificationType($value)
    {
        return $this->setParameter('notificationType', $value);
    }

    /**
     * @param $value
     *
     * @return PurchaseRequest
     */
    public function setNotificationCode($value)
    {
        return $this->setParameter('notificationCode', $value);
    }

    public function getData()
    {
        $data = $this->getBaseData();
        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        $endPoint = $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
        return "{$endPoint}{$this->getVersion()}/{$this->getResource()}/{$this->getNotificationCode()}";
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function getHttp($data)
    {
        $url = sprintf(
            '%s?%s',
            $this->getEndpoint(),
            http_build_query($data, '', '&')
        );

        return $this->httpClient->request($this->getMethod(), $url, $this->getHeaders());
    }

    /**
     * @return mixed
     */
    public function getNotificationCode()
    {
        return $this->getParameter('notificationCode');
    }


}
