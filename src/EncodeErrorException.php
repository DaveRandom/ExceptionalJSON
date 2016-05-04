<?php

namespace ExceptionalJSON;

/**
 * Exception thrown when a JSON decoding operation fails.
 *
 * @package ExceptionalJSON
 */
class EncodeErrorException extends Exception
{
    private $value;

    public function __construct(int $code, string $message, $value)
    {
        parent::__construct($code, $message);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
