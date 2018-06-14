<?php declare(strict_types=1);

/** @noinspection PhpIncludeInspection */
require \PHP_VERSION_ID >= 70300
    ? __DIR__ . '/functions-7.3.php'
    : __DIR__ . '/functions-7.0.php';

\define('ExceptionalJSON\\HAVE_JSON_TRY_DECODE', !\function_exists('json_try_decode'));
\define('ExceptionalJSON\\HAVE_JSON_TRY_ENCODE', !\function_exists('json_try_decode'));

if (\ExceptionalJSON\HAVE_JSON_TRY_DECODE) {
    /**
     * Decodes a JSON string.
     *
     * @param string $json The JSON string being decoded.
     * @param bool $assoc When TRUE, returned objects will be converted into associative arrays.
     * @param int $depth User specified recursion depth.
     * @param int $options Bit mask of JSON decode options.
     * @return mixed The value encoded in JSON in appropriate PHP type.
     * @throws \ExceptionalJSON\DecodeErrorException When the decode operation fails.
     */
    function json_try_decode(string $json, bool $assoc = null, int $depth = 512, int $options = 0)
    {
        return \ExceptionalJSON\decode($json, $assoc, $depth, $options);
    }
}

if (\ExceptionalJSON\HAVE_JSON_TRY_ENCODE) {
    /**
     * Returns the JSON representation of a value.
     *
     * @param mixed $value The value being encoded.
     * @param int $depth User specified recursion depth.
     * @param int $options Bit mask of JSON encode options.
     * @return string JSON encoded string.
     * @throws \ExceptionalJSON\EncodeErrorException When the encode operation fails
     */
    function json_try_encode($value, int $options = 0, int $depth = 512): string
    {
        return \ExceptionalJSON\encode($value, $options, $depth);
    }
}
