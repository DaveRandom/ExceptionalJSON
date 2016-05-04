# Exceptional JSON

Thin wrapper around PHP's `json_encode()` and `json_decode()` functions, which throws exceptions when an operation fails.

**Required PHP Version**

- PHP 7.0+

**Installation**

```bash
$ composer require daverandom/exceptional-json
```

**Usage**

Call the `\ExceptionJSON\encode()` and `\ExceptionJSON\decode()` functions in exactly the same way as you would with
`json_encode()` and `json_decode()`. The only difference is that they will throw an exception if the operation fails.

Also defines `json_try_encode()` and `json_try_decode()` in the root namespace if they don't already exist, these are
simply aliases of their namespaced counterparts.

```php
$encoded = \ExceptionJSON\encode($data);
$decoded = \ExceptionJSON\decode($encoded);
```

**What about tests?**

![Tests? Where we're going, we don't need... tests](https://i.imgflip.com/13kfdv.jpg)
