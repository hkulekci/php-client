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

namespace Apisearch\App;

use Apisearch\Model\AppUUID;

/**
 * Class WithRepositoryReferenceTrait.
 */
trait WithAppRepositoryReferenceTrait
{
    /**
     * @var AppRepositoryReference
     *
     * Repository Reference
     */
    private $repositoryReference;

    /**
     * Set repository reference.
     *
     * @param AppRepositoryReference $repositoryReference
     */
    public function setRepositoryReference(AppRepositoryReference $repositoryReference): void
    {
        $this->repositoryReference = $repositoryReference;
    }

    /**
     * Get AppRepositoryReference.
     *
     * @return AppRepositoryReference
     */
    public function getRepositoryReference(): AppRepositoryReference
    {
        return $this->repositoryReference;
    }

    /**
     * Get AppUUID.
     *
     * @return AppUUID|null
     */
    public function getAppUUID(): ? AppUUID
    {
        return $this
            ->repositoryReference
            ->getAppUUID();
    }
}
