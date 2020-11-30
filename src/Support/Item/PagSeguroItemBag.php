<?php

namespace Omnipay\PagSeguro\Support\Item;

use Omnipay\Common\ItemBag;
use Omnipay\Common\ItemInterface;

/**
 * Class PagSeguroItemBag.
 *
 * @author Jerfeson Guerreiro <jerfeson_guerreiro@hotmail.com>
 *
 * @since 1.0.0
 *
 * @version 1.0.0
 */
class PagSeguroItemBag extends ItemBag
{
    /**
     * Add an item to the bag.
     *
     * @see Item
     *
     * @param ItemInterface|array $item An existing item, or associative array of item parameters
     */
    public function add($item)
    {
        if ($item instanceof ItemInterface) {
            $this->items[] = $item;
        } else {
            $this->items[] = new PagSeguroItem($item);
        }
    }
}
