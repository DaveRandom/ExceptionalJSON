<?php declare(strict_types=1);

final class DecodeTest extends \PHPUnit\Framework\TestCase
{
    const VALID_ENCODED = '{"string":"foo bar baz","array":[1,2,3],"bigint":12345678901234567890}';
    const DECODED = ["string" => "foo bar baz", "array" => [1,2,3], "bigint" => 12345678901234567890];
    const DECODED_BIGINT_AS_STRING = "12345678901234567890";

    private function assertStdClassSameAsArray(array $expected, \stdClass $actual)
    {
        foreach ($expected as $name => $value) {
            $this->assertSame($value, $actual->{$name}, "Member '{$name}' does not match expected value");
        }
    }

    public function testDecodeValidJsonDefaultArgs()
    {
        $this->assertStdClassSameAsArray(
            self::DECODED,
            \ExceptionalJSON\decode(self::VALID_ENCODED)
        );
    }

    public function testDecodeValidJsonAssocTrue()
    {
        $this->assertSame(
            self::DECODED,
            \ExceptionalJSON\decode(self::VALID_ENCODED, true)
        );
    }

    public function testDecodeValidJsonAssocFlag()
    {
        $this->assertSame(
            self::DECODED,
            \ExceptionalJSON\decode(self::VALID_ENCODED, null, 512, \JSON_OBJECT_AS_ARRAY)
        );
    }

    public function testDecodeValidJsonBigIntStringFlag()
    {
        $this->assertSame(
            self::DECODED_BIGINT_AS_STRING,
            \ExceptionalJSON\decode(self::VALID_ENCODED, true, 512, \JSON_BIGINT_AS_STRING)['bigint']
        );
    }

    public function testDecodeValidJsonValidDepth()
    {
        $this->assertEquals((object)self::DECODED, \ExceptionalJSON\decode(self::VALID_ENCODED, false, 3));
    }

    public function testDecodeValidJsonInvalidDepth()
    {
        try {
            \ExceptionalJSON\decode(self::VALID_ENCODED, null, 2);
        } catch (\ExceptionalJSON\DecodeErrorException $e) {
            $this->assertSame(\JSON_ERROR_DEPTH, $e->getCode());
        }
    }

    public function testDecodeInvalidJsonStateMismatch()
    {
        try {
            \ExceptionalJSON\decode('{"foo":"bar"]');
        } catch (\ExceptionalJSON\DecodeErrorException $e) {
            $this->assertSame(\JSON_ERROR_STATE_MISMATCH, $e->getCode());
        }
    }

    public function testDecodeInvalidJsonControlChar()
    {
        try {
            \ExceptionalJSON\decode('{"foo"' . "\x03" . ':"bar"}');
        } catch (\ExceptionalJSON\DecodeErrorException $e) {
            $this->assertSame(\JSON_ERROR_CTRL_CHAR, $e->getCode());
        }
    }

    public function testDecodeInvalidJsonSyntax()
    {
        try {
            \ExceptionalJSON\decode('{"foo" => "bar"}');
        } catch (\ExceptionalJSON\DecodeErrorException $e) {
            $this->assertSame(\JSON_ERROR_SYNTAX, $e->getCode());
        }
    }

    public function testDecodeInvalidUtf8()
    {
        try {
            \ExceptionalJSON\decode('{"foo' . "\x80\x80" . '":"bar"}');
        } catch (\ExceptionalJSON\DecodeErrorException $e) {
            $this->assertSame(\JSON_ERROR_UTF8, $e->getCode());
        }
    }

    public function testDecodeInvalidPropertyName()
    {
        try {
            \ExceptionalJSON\decode('{"\u0000foo":"bar"}');
        } catch (\ExceptionalJSON\DecodeErrorException $e) {
            $this->assertSame(\JSON_ERROR_INVALID_PROPERTY_NAME, $e->getCode());
        }
    }
}
