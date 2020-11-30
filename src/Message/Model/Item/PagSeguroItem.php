<?php

namespace Omnipay\PagSeguro\Model\Item;

use Omnipay\Common\Item;

/**
 * Class PagSeguroItem
 *
 * @package Omnipay\PagSeguro\Model\Item
 *
 * @author Jerfeson Guerreiro <jerfeson_guerreiro@hotmail.com>
 *
 * @since 1.0.0
 *
 * @version 1.0.0
 *
 */
class PagSeguroItem extends Item
{
    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->getParameter('weight');
    }

    /**
     * @param $value
     * @return PagSeguroItem
     */
    public function setWeight($value)
    {
        return $this->setParameter('weight', $value);
    }
}