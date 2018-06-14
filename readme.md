# Exceptional JSON

[![Build Status](https://travis-ci.org/DaveRandom/ExceptionalJSON.svg?branch=master)](https://travis-ci.org/DaveRandom/JOM)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/DaveRandom/ExceptionalJSON/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/DaveRandom/JOM/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/DaveRandom/ExceptionalJSON/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/DaveRandom/JOM/?branch=master)
[![Packagist](https://img.shields.io/packagist/dt/daverandom/exceptional-json.svg)](https://packagist.org/packages/daverandom/exceptional-json)
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://github.com/DaveRandom/ExceptionalJSON/blob/master/LICENSE)

Thin wrapper around PHP's `json_encode()` and `json_decode()` functions, which throws exceptions when an operation fails.

### Required PHP Version

- PHP 7.0+

### Installation

```bash
$ composer require daverandom/exceptional-json
```

### Usage

Call the `\ExceptionJSON\encode()` and `\ExceptionJSON\decode()` functions in exactly the same way as you would with
`json_encode()` and `json_decode()`. The only difference is that they will throw an exception if the operation fails.

Also defines `json_try_encode()` and `json_try_decode()` in the root namespace if they don't already exist, these are
simply aliases of their namespaced counterparts.

```php
$encoded = \ExceptionJSON\encode($data);
$decoded = \ExceptionJSON\decode($encoded);
```
