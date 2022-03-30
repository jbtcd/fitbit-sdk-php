[![Stand With Ukraine](https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/banner2-direct.svg)](https://vshymanskyy.github.io/StandWithUkraine/)

# Fitbit SDK for PHP 🏃

[![GitHub stars](https://img.shields.io/github/stars/jbtcd/fitbit-sdk-php.svg)](https://github.com/vshymanskyy/StandWithUkraine/stargazers)
[![GitHub issues](https://img.shields.io/github/issues/jbtcd/fitbit-sdk-php.svg)](https://github.com/vshymanskyy/StandWithUkraine/issues)
[![Build Status](https://travis-ci.com/jbtcd/fitbit-sdk-php.svg?branch=main)](https://travis-ci.com/jbtcd/fitbit-sdk-php)
[![license](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![packagist](https://img.shields.io/packagist/v/jbtcd/fitbit.svg?style=flat-square)](https://packagist.org/packages/jbtcd/fitbit)
[![downloads](https://img.shields.io/packagist/dt/jbtcd/fitbit.svg?style=flat-square)](https://packagist.org/packages/jbtcd/fitbit)
[![php version](https://img.shields.io/packagist/php-v/jbtcd/fitbit?style=flat-square)](https://packagist.org/packages/jbtcd/fitbit)

Fitbit provider for authentication and data collection.

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
