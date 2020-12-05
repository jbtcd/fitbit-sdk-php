# Fitbit SDK for PHP 🏃

[![@jbtcdDE on Twitter](http://img.shields.io/badge/twitter-%40jbtcdDE-blue.svg?style=flat)](https://twitter.com/jbtcdDE)
[![Build Status](https://travis-ci.com/jbtcd/fitbit-sdk-php.svg?branch=main)](https://travis-ci.com/jbtcd/fitbit-sdk-php)
[![license](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![packagist](https://img.shields.io/packagist/v/jbtcd/fitbit.svg?style=flat-square)](https://packagist.org/packages/jbtcd/fitbit)
[![downloads](https://img.shields.io/packagist/dt/jbtcd/fitbit.svg?style=flat-square)](https://packagist.org/packages/jbtcd/fitbit)
[![php version](https://img.shields.io/packagist/php-v/jbtcd/fitbit?style=flat-square)](https://packagist.org/packages/jbtcd/fitbit)

Fitbit provider fot authentication and data collection.

## Installation

To install, use composer:

```bash
$ composer require jbtcd/fitbit
```

## Usage

1. You must first register a Web Application on
   [dev.fitbit.com](https://dev.fitbit.com/apps/new) to get an OAuth ID and
   secret. Configure the application as:

   - OAuth 2.0 Application Type: **Server**
   - Callback URL: **https://app-settings.fitbitdevelopercontent.com/simple-redirect.html**

2. Put your **OAuth 2.0 Client ID** and **Client Secret** into
   the `Entity\ClientEntity.php` instance.

## Testing

``` bash
$ composer run tests
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
