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

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use /* @noinspection PhpUndefinedNamespaceInspection */
    /* @noinspection PhpUndefinedClassInspection */
    Laravel\Lumen\Application as LumenApplication;

/**
 * Class CryptocurrencyServiceProvider.
 */
class CryptocurrencyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('cryptocurrency', function () {
            return new LaravelCryptocurrency();
        });

        $this->mergeConfigFrom(
            $this->getConfigFile(),
            'cryptocurrency'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            /* @noinspection PhpUndefinedClassInspection */
            if ($this->app instanceof LumenApplication || Str::contains($this->app->version(), 'Lumen')) {
                /* @noinspection PhpUndefinedMethodInspection */
                $this->app->configure('cryptocurrency');
            } else {
                // Publishing the configuration file.
                $this->publishes([
                    $this->getConfigFile() => config_path('cryptocurrency.php'),
                ], 'config');
            }
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            'cryptocurrency',
        ];
    }

    /**
     * Get the correct path of configuration file.
     *
     * @return string
     */
    protected function getConfigFile(): string
    {
        return __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'cryptocurrency.php';
    }
}
