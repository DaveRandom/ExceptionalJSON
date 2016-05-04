<?php

namespace ExceptionalJSON;

/**
 * Exception thrown when a JSON decoding operation fails.
 *
 * @package ExceptionalJSON
 */
class DecodeErrorException extends Exception
{
    private $json;

    public function __construct(int $code, string $message, string $json)
    {
        parent::__construct($code, $message);
        $this->json = $json;
    }

    public function getJSON(): string
    {
        return $this->json;
    }
}
