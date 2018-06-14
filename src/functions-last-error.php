<?php declare(strict_types=1);

namespace ExceptionalJSON;

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
function decode(
    string $json,
    bool $assoc = \ExceptionalJSON\DECODE_ASSOC_ARG_DEFAULT,
    int $depth = \ExceptionalJSON\DECODE_DEPTH_ARG_DEFAULT,
    int $options = \ExceptionalJSON\DECODE_OPTIONS_ARG_DEFAULT
)
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
function encode(
    $value,
    int $options = \ExceptionalJSON\ENCODE_OPTIONS_ARG_DEFAULT,
    int $depth = \ExceptionalJSON\ENCODE_DEPTH_ARG_DEFAULT
): string
{
    $result = \json_encode($value, $options & ~\JSON_PARTIAL_OUTPUT_ON_ERROR, $depth);
    $code = \json_last_error();

    if ($code !== \JSON_ERROR_NONE) {
        throw new EncodeErrorException($code, \json_last_error_msg(), $value);
    }

    return $result;
}
