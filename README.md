# Laravel Cryptocurrency package

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![Last commit][ico-commit]][link-commit]
[![License][ico-license]][link-license]
[![Requires PHP7.1][ico-php]][link-php]

Laravel provider to have all cryptocurrency infos in a single package without using a database.

## Installation

``` bash
$ composer require crypto-technology/laravel-cryptocurrency
```

### Laravel 5.5+

If you don't use auto-discovery, add the `ServiceProvider` to the providers array in `config/app.php`:

```php
'providers' => [
    ...
    CryptoTech\Laravel\CryptocurrencyServiceProvider::class,
    ...
],
```

If you want to use the facade, add the `Facade` to the facades array in `config/app.php`:

```
'aliases' => [
    ...
    'Cryptocurrency' => CryptoTech\Laravel\Facades\Cryptocurrency::class,
    ...
]
```

Copy the package config to your local config with the publish command:

```bash
$ php artisan vendor:publish --provider="CryptoTech\Laravel\CryptocurrencyServiceProvider"
```

### Lumen

Configure the Service Provider and alias:

```php
# boostrap/app.php

// Register the facade
$app->withFacades(true, [
    CryptoTech\Laravel\Facades\Cryptocurrency::class => 'Cryptocurrency'
]);

// Load the configuration
$app->configure('cryptocurrency');

// Register the service provider
$app->register(CryptoTech\Laravel\CryptocurrencyServiceProvider::class);
```

Copy the [configuration file](config/cryptocurrency.php) to `/config/cryptocurrency.php` if you wish to override it.

## Usage

First, make sure that interested cryptocurrency is enabled in your `/config/cryptocurrency.php` config file.  
All methods available on `\CryptoTech\Cryptocurrency\Cryptocurrency` class can be used in this package.
 
```php
# HomeController.php

use Cryptocurrency;

// Get the Bitcoin object
$bitcoin = Cryptocurrency::get('Bitcoin');

// Return (string) cryptocurrency name
$bitcoin->getName();

// Return (string) cryptocurrency description
$bitcoin->getDescription();

// Return (boolean) cryptocurrency mineable state
$bitcoin->isMineable();

return view('home', compact('bitcoin'));
```

```blade
# home.blade.php

@section('content')
    <p>{!! $bitcoin->getSymbol() !!}</p>
@endsection
```

More information can be found in the `\CryptoTech\Cryptocurrency\CryptocurrencyInterface` interface PhpDocumentation.  
The `\CryptoTech\Cryptocurrency\Cryptocurrency` class contains, in addition to the get methods, also set methods (only for description and for project, explorer and sourcecode urls), which allow you to momentarily overwrite the default values.

## Changelog

Please see the [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
# For Windows system
$ composer test-win

# For Unix system
$ composer test-unix
```

## Contributing

Your help is always welcome! Feel free to open issues, ask questions, talk about it and discuss this tool.  
Of course there are some [contributing guidelines](CONTRIBUTING.md) and a [code of conduct](CODE_OF_CONDUCT.md), which I invite you to check out.  
For all other contributions, see below.

After every code changes, but before submit your pull request, please apply Php Cs Fixer code fixing:
``` bash
# For Windows system
$ composer php-cs-fixer-win

# For Unix system
$ composer php-cs-fixer-unix
```

## Security

The `CryptoTech\Laravel` package will be checked for security vulnerabilities using [Roave Security Advisories][link-roave] checker.
If you discover any security related issues, please email [security@cryptotech.srl](mailto:security@cryptotech.srl) instead of using the issue tracker.

## Code

cloc|github.com/AlDanial/cloc v 1.80  T=0.50 s (28.0 files/s, 1564.0 lines/s)
--- | ---

Language|files|blank %|comment %|code|scale|3rd|gen.|equiv
:-------|-------:|-------:|-------:|-------:|-------:|-------:|-------:|-------:
Markdown|3|28.08|0.00|146|1|146
PHP|6|11.57|53.71|117|3.5|409.5
JSON|1|0.00|0.00|97|2.5|242.5
YAML|3|12.20|2.44|70|0.9|63
XML|1|7.94|26.98|41|1.9|77.9
--------|--------|--------|--------|--------|--------|--------|--------|--------
SUM:|14|14.19|25.58|471|x|1.99|=|938.90

## Credits

- [Crypto Technology srl][link-author]
- [Luca Bognolo][link-coauthor]
- [All Contributors][link-contributors]

## Versioning
We use [SemVer][link-semver] for versioning. For the versions available, see [the tags][link-tags] on this repository.

## License

The GNU General Public License version 3. Please see the [license file](LICENSE) for more information.
This work [is licensed](LICENSE) under the [GNU GPL v3][link-license].

[ico-version]: https://img.shields.io/packagist/v/crypto-technology/laravel-cryptocurrency.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/crypto-technology/laravel-cryptocurrency.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/com/crypto-technology/laravel-cryptocurrency/master.svg?style=flat-square
[ico-commit]: https://img.shields.io/github/last-commit/crypto-technology/laravel-cryptocurrency.svg?style=flat-square
[ico-license]: https://img.shields.io/github/license/crypto-technology/laravel-cryptocurrency.svg?style=flat-square
[ico-php]: https://img.shields.io/badge/php-7.1-blue.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/crypto-technology/laravel-cryptocurrency
[link-downloads]: https://packagist.org/packages/crypto-technology/laravel-cryptocurrency
[link-travis]: https://travis-ci.com/crypto-technology/laravel-cryptocurrency
[link-commit]: https://github.com/crypto-technology/laravel-cryptocurrency/commits
[link-license]: https://www.gnu.org/licenses/gpl-3.0.en.html
[link-php]: https://secure.php.net/downloads.php
[link-roave]: https://github.com/Roave/SecurityAdvisories
[link-author]: https://cryptotech.srl
[link-coauthor]: https://bogny.eu
[link-contributors]: https://github.com/crypto-technology/laravel-cryptocurrency/contributors
[link-semver]: https://semver.org/
[link-tags]: https://github.com/crypto-technology/laravel-cryptocurrency/tags
