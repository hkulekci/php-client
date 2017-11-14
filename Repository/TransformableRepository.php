<?php

/*
 * This file is part of the Search PHP Library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author PuntMig Technologies
 */

declare(strict_types=1);

namespace Puntmig\Search\Repository;

use Puntmig\Search\Model\Item;
use Puntmig\Search\Model\ItemUUID;
use Puntmig\Search\Query\Query;
use Puntmig\Search\Result\Result;
use Puntmig\Search\Transformer\Transformer;

/**
 * Class TransformableRepository.
 */
class TransformableRepository extends Repository
{
    /**
     * @var Repository
     *
     * Repository decorated
     */
    private $repository;

    /**
     * @var Transformer
     *
     * Item transformer
     */
    private $transformer;

    /**
     * TransformableRepository constructor.
     *
     * @param Repository  $repository
     * @param Transformer $transformer
     */
    public function __construct(
        Repository $repository,
        Transformer $transformer
    ) {
        $this->repository = $repository;
        $this->transformer = $transformer;

        parent::__construct();
    }

    /**
     * Set app id.
     *
     * @param string $appId
     */
    public function setAppId(string $appId)
    {
        $this
            ->repository
            ->setAppId($appId);

        parent::setAppId($appId);
    }

    /**
     * Flush items.
     *
     * @param Item[]     $itemsToUpdate
     * @param ItemUUID[] $itemsToDelete
     */
    protected function flushItems(
        array $itemsToUpdate,
        array $itemsToDelete
    ) {
        $this
            ->repository
            ->flushItems(
                $itemsToUpdate,
                $itemsToDelete
            );
    }

    /**
     * Search across the index types.
     *
     * @param Query $query
     *
     * @return Result
     */
    public function query(Query $query): Result
    {
        $result = $this
            ->repository
            ->query($query);

        return Result::create(
            $result->getQuery(),
            $result->getTotalItems(),
            $result->getTotalHits(),
            $result->getAggregations(),
            $result->getSuggests(),
            $this
                ->transformer
                ->fromItems(
                    $result->getItems()
                )
        );
    }

    /**
     * Reset the index.
     *
     * @var null|string
     */
    public function reset(? string $language)
    {
        $this
            ->repository
            ->reset($language);
    }

    /**
     * Generate item document by a simple object.
     *
     * @param mixed $object
     */
    public function addObject($object)
    {
        $item = $this
            ->transformer
            ->toItem($object);

        if ($item instanceof Item) {
            $this->addItem($item);
        }
    }

    /**
     * Delete item document by uuid.
     *
     * @param mixed $object
     */
    public function deleteObject($object)
    {
        $itemUUID = $this
            ->transformer
            ->toItemUUID($object);

        if ($itemUUID instanceof ItemUUID) {
            $this->deleteItem($itemUUID);
        }
    }
}
