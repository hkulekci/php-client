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

/**
 * Class WithAppRepositoryReference.
 */
interface WithAppRepositoryReference
{
    /**
     * Set repository reference.
     *
     * @param AppRepositoryReference $repositoryReference
     */
    public function setRepositoryReference(AppRepositoryReference $repositoryReference);

    /**
     * Get RepositoryReference.
     *
     * @return AppRepositoryReference
     */
    public function getRepositoryReference(): AppRepositoryReference;
}
