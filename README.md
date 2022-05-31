
# This is my package cronly-wrapper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/coenschutte/cronly-wrapper.svg?style=flat-square)](https://packagist.org/packages/coenschutte/cronly-wrapper)
[![Total Downloads](https://img.shields.io/packagist/dt/coenschutte/cronly-wrapper.svg?style=flat-square)](https://packagist.org/packages/coenschutte/cronly-wrapper)

This is a basic API wrapper for Cronly in PHP


## Installation

You can install the package via composer:

```bash
composer require coenschutte/cronly-wrapper
```

## Usage

```php
$cronly = new CoenSchutte\CronlyWrapper($apiKey);
echo $cronly->getAllMonitors();
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Credits

- [Coen Schutte](https://github.com/CoenSchutte)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
