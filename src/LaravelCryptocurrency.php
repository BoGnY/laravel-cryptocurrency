<?php

/**
 * Laravel Cryptocurrency list package.
 * Laravel provider to have all cryptocurrency infos in a
 * single package without using a database.
 *
 * Copyright (C) 2018-2019 <Crypto Technology srl>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace CryptoTech\Laravel;

use CryptoTech\Cryptocurrency\Cryptocurrency;
use CryptoTech\Cryptocurrency\Exception\CryptoNotEnabledException;

/**
 * Class LaravelCryptocurrency.
 */
class LaravelCryptocurrency
{
    /**
     * Check if cryptocurrency is enabled.
     *
     * @param string $cryptocurrency
     * The name of cryptocurrency.
     *
     * @throws \CryptoTech\Cryptocurrency\Exception\CryptoNotEnabledException
     *
     * @return bool
     */
    public function isEnabled(string $cryptocurrency)
    {
        $config = config('cryptocurrency.crypto_enabled');
        if ( ! \in_array($cryptocurrency, $config, false)) {
            throw new CryptoNotEnabledException('The cryptocurrency ('.$cryptocurrency.') you have selected is not enabled in your configuration!');
        }

        return true;
    }

    /**
     * Get cryptocurrency object with all infos.
     *
     * @param string $cryptocurrency
     * The name of cryptocurrency.
     *
     * @return null|\CryptoTech\Cryptocurrency\Cryptocurrency
     */
    public function get(string $cryptocurrency): ?Cryptocurrency
    {
        if ($this->isEnabled($cryptocurrency)) {
            $class = 'CryptoTech\\Cryptocurrency\\'.$cryptocurrency;

            return call_user_func([new $class(), 'build']);
        }

        return null;
    }
}
