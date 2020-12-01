<?php


namespace Omnipay\PagSeguro\Message;


/**
 * Class RefundRequest
 *
 * @see https://dev.pagseguro.uol.com.br/reference/checkout-pagseguro#estornar-transa%C3%A7%C3%A3o
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
class RefundRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $resource = 'transactions/refunds';

    /**
     * @var string
     */
    protected $version = '2';

    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * @return mixed
     */
    public function getTransactionCode()
    {
        return $this->getParameter('notificationType');
    }

    /**
     * @param $value
     *
     * @return PurchaseRequest
     */
    public function setTransactionCode($value)
    {
        return $this->setParameter('notificationType', $value);
    }

    /**
     * @return array|mixed
     */
    public function getData()
    {
        $data = $this->getBaseData();
        $data['transactionCode'] = $this->getTransactionCode();
        return $data;
    }

}
