<?php declare(strict_types=1);

namespace ExceptionalJSON
{
    const HAVE_NATIVE_JSON_EXCEPTIONS = \PHP_VERSION_ID >= 70300;
    const HAVE_JSON_OBJECT_AS_ARRAY_FLAG = \PHP_VERSION_ID >= 70200;

    const DECODE_ASSOC_ARG_DEFAULT = HAVE_JSON_OBJECT_AS_ARRAY_FLAG ? null : false;
    const DECODE_DEPTH_ARG_DEFAULT = 512;
    const DECODE_OPTIONS_ARG_DEFAULT = 0;

    const ENCODE_DEPTH_ARG_DEFAULT = 512;
    const ENCODE_OPTIONS_ARG_DEFAULT = 0;
}

namespace
{
    /** @noinspection PhpIncludeInspection */
    require \ExceptionalJSON\HAVE_NATIVE_JSON_EXCEPTIONS
        ? __DIR__ . '/functions-native-exceptions.php'
        : __DIR__ . '/functions-last-error.php';

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
        function json_try_decode(
            string $json,
            bool $assoc = \ExceptionalJSON\DECODE_ASSOC_ARG_DEFAULT,
            int $depth = \ExceptionalJSON\DECODE_DEPTH_ARG_DEFAULT,
            int $options = \ExceptionalJSON\DECODE_OPTIONS_ARG_DEFAULT
        )
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
        function json_try_encode(
            $value,
            int $options = \ExceptionalJSON\ENCODE_OPTIONS_ARG_DEFAULT,
            int $depth = \ExceptionalJSON\ENCODE_DEPTH_ARG_DEFAULT
        ): string
        {
            return \ExceptionalJSON\encode($value, $options, $depth);
        }
    }
}
