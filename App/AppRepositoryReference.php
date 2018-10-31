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
 * Class AppRepositoryReference.
 */
class AppRepositoryReference
{
    /**
     * @var AppUUID|null
     *
     * App uuid
     */
    protected $appUUID;

    /**
     * RepositoryReference constructor.
     *
     * @param AppUUID $appUUID
     */
    private function __construct(
        AppUUID $appUUID = null
    ) {
        $this->appUUID = $appUUID;
    }

    /**
     * Get AppUUID.
     *
     * @return AppUUID|null
     */
    public function getAppUUID(): ? AppUUID
    {
        return $this->appUUID;
    }

    /**
     * Create by appUUID and indexUUID.
     *
     * @param AppUUID $appUUID
     * @return AppRepositoryReference
     */
    public static function create(
        AppUUID $appUUID = null
    ): AppRepositoryReference {
        return new self($appUUID);
    }

    /**
     * Compose.
     *
     * @return string
     */
    public function compose(): string
    {
        return sprintf('%s',
            $this->appUUID instanceof AppUUID
                ? str_replace('_', '-', $this->appUUID->composeUUID())
                : ''
        );
    }

    /**
     * Create from composed.
     *
     * @param string $composed
     *
     * @return AppRepositoryReference
     */
    public static function createFromComposed(string $composed): AppRepositoryReference
    {
        return AppRepositoryReference::create(
            AppUUID::createById($composed)
        );
    }
}
