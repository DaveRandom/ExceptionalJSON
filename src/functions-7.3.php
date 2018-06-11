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
function decode(string $json, bool $assoc = null, int $depth = 512, int $options = 0)
{
    try {
        return \json_decode($json, $assoc, $depth, $options | \JSON_THROW_ON_ERROR);
    } catch (\JsonException $e) {
        throw new DecodeErrorException($e->getCode(), $e->getMessage(), $json, $e);
    }
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
    try {
        return \json_encode($value, ($options & ~\JSON_PARTIAL_OUTPUT_ON_ERROR) | \JSON_THROW_ON_ERROR, $depth);
    } catch (\JsonException $e) {
        throw new EncodeErrorException($e->getCode(), $e->getMessage(), $value, $e);
    }
}
