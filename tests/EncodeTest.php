<?php declare(strict_types=1);

namespace ExceptionalJSON\Tests;

use ExceptionalJSON\EncodeErrorException;
use PHPUnit\Framework\TestCase;

final class EncodeTest extends TestCase
{
    const VALID_ENCODED = '{"string":"foo bar baz","array":[1,2,3],"bigint":"12345678901234567890"}';
    const ASSOC_ARRAY = ["string" => "foo bar baz", "array" => [1,2,3], "bigint" => "12345678901234567890"];
    const BIGINT_AS_STRING = "12345678901234567890";

    public function testEncodeAssocArray()
    {
        $this->assertSame(
            self::VALID_ENCODED,
            \ExceptionalJSON\encode(self::ASSOC_ARRAY)
        );
    }

    public function testEncodeBigIntegerString()
    {
        $this->assertSame(
            '"' . self::BIGINT_AS_STRING . '"',
            \ExceptionalJSON\encode(self::BIGINT_AS_STRING)
        );
    }

    public function testEncodeNonUtf8String()
    {
        try {
            \ExceptionalJSON\encode("\xB1\x31");
        } catch (EncodeErrorException $e) {
            $this->assertSame(5, $e->getCode());
            $this->assertSame("\xB1\x31", $e->getValue());
        }
    }
}
