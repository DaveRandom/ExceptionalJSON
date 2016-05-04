<?php declare(strict_types=1);

namespace ExceptionalJSON;

/**
 * Base exception thrown when a JSON operation fails.
 *
 * @package ExceptionalJSON
 */
abstract class Exception extends \RuntimeException
{
    public function __construct(int $code, string $message)
    {
        parent::__construct($message, $code);
    }
}
