<?php

/*
 * This file is part of the Apisearch PHP Client.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */

declare(strict_types=1);

namespace Apisearch\Tests\Transformer;

use Apisearch\Model\Item;
use Apisearch\Model\ItemUUID;
use Apisearch\Transformer\WriteTransformer;

/**
 * Class ProductWriteTransformer.
 */
class ProductWriteTransformer implements WriteTransformer
{
    /**
     * Is an indexable object.
     *
     * @param mixed $object
     *
     * @return bool
     */
    public function isValidObject($object): bool
    {
        return $object instanceof Product;
    }

    /**
     * Create item by object.
     *
     * @param mixed $object
     *
     * @return Item
     */
    public function toItem($object): Item
    {
        /*
         * @var Product $object
         */
        return Item::create(
            $this->toItemUUID($object),
            [
                'created_at' => $object->getCreatedAt()->format(DATE_ATOM),
            ],
            [
                'name' => $object->getName(),
            ],
            [
                $object->getName(),
            ],
            [
                'engonga',
            ],
            [
                $object->getName(),
            ]
        );
    }

    /**
     * Create item UUID by object.
     *
     * @param mixed $object
     *
     * @return ItemUUID
     */
    public function toItemUUID($object): ItemUUID
    {
        return new ItemUUID($object->getSku(), 'product');
    }
}
