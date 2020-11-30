<?php

namespace Omnipay\PagSeguro\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\ItemBag;
use Omnipay\PagSeguro\Model\Item\PagSeguroItemBag;

/**
 * Class PurchaseRequest
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
class PurchaseRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $resource = 'checkout';

    /**
     * @var string
     */
    protected $shippingType = '3';

    /**
     * @return mixed
     */
    public function getShippingType()
    {
        return $this->getParameter('shippingType');
    }

    /**
     * @param $value
     * @return PurchaseRequest
     */
    public function setShippingType($value)
    {
        return $this->setParameter('shippingType', $value);
    }

    /**
     * @return mixed
     */
    public function getShippingCost()
    {
        return $this->getParameter('shippingCost');
    }

    /**
     * @param $value
     * @return PurchaseRequest
     */
    public function setShippingCost($value)
    {
        return $this->setParameter('shippingCost', $value);
    }

    /**
     * @param array|ItemBag $items
     * @return PurchaseRequest
     */
    public function setItems($items)
    {
        if ($items && !$items instanceof ItemBag) {
            $items = new PagSeguroItemBag($items);
        }

        return $this->setParameter('items', $items);
    }

    /**
     * @return mixed|void
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate('currency', 'transactionId');

    }

    /**
     * @param $value
     * @return PurchaseRequest
     */
    public function setExtraAmount($value)
    {
        return $this->setParameter('extraAmount', $value);
    }

    /**
     * @return string
     * @throws InvalidRequestException
     */
    public function getExtraAmount()
    {
        $extraAmount = $this->getParameter('extraAmount');

        if ($extraAmount !== null && $extraAmount !== 0) {
            if ($this->getCurrencyDecimalPlaces() > 0) {
                if (is_int($extraAmount) || (is_string($extraAmount) && strpos((string) $extraAmount, '.') === false)) {
                    throw new InvalidRequestException(
                        'Please specify extra amount as a string or float, with decimal places.'
                    );
                }
            }

            // Check for rounding that may occur if too many significant decimal digits are supplied.
            $decimal_count = strlen(substr(strrchr(sprintf('%.8g', $extraAmount), '.'), 1));
            if ($decimal_count > $this->getCurrencyDecimalPlaces()) {
                throw new InvalidRequestException('Amount precision is too high for currency.');
            }

            return $this->formatCurrency($extraAmount);
        }
    }
}