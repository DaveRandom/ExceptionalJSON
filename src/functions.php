<?php declare(strict_types=1);

namespace ExceptionalJSON
{
    /**
     * Decodes a JSON string.
     *
     * @param string $json The JSON string being decoded.
     * @param bool $assoc When TRUE, returned objects will be converted into associative arrays.
     * @param int $depth User specified recursion depth.
     * @param int $options Bit mask of JSON decode options.
     * @return mixed The value encoded in JSON in appropriate PHP type.
     * @throws DecodeErrorException When the decode operation fails.
     */
    function decode(string $json, bool $assoc = false, int $depth = 512, int $options = 0)
    {
        $result = \json_decode($json, $assoc, $depth, $options);
        $code = \json_last_error();

        if ($code !== \JSON_ERROR_NONE) {
            throw new DecodeErrorException($code, \json_last_error_msg(), $json);
        }

        return $result;
    }

    /**
     * Returns the JSON representation of a value.
     *
     * @param mixed $value The value being encoded.
     * @param int $depth User specified recursion depth.
     * @param int $options Bit mask of JSON encode options.
     * @return string JSON encoded string.
     * @throws Exception When the encode operation fails
     */
    function encode($value, int $options = 0, int $depth = 512): string
    {
        $result = \json_encode($value, $options, $depth);
        $code = \json_last_error();

        if ($code !== \JSON_ERROR_NONE) {
            throw new EncodeErrorException($code, \json_last_error_msg(), $value);
        }

        return $result;
    }
}

namespace
{
    if (!\function_exists('json_try_decode')) {
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
        function json_try_decode(string $json, bool $assoc = false, int $depth = 512, int $options = 0)
        {
            return \ExceptionalJSON\decode($json, $assoc, $depth, $options);
        }
    }

    if (!\function_exists('json_try_encode')) {
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
}
