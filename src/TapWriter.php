<?php declare(strict_types=1);

namespace nikeee\PhpunitTap;

class TapWriter
{
    private int $indentLevel = 0;
    private string $buffer = '';

    // Version := "TAP version 14\n"
    function version(int $version = 14): void
    {
        $this->write("TAP version $version\n");
    }

    // Plan := "1.." (Number) (" # " Reason)? "\n"
    function plan(int $testCount, ?string $reason = null): void
    {
        $this->write("1..$testCount");
        if ($reason) {
            $this->write(" # $reason");
        }
        $this->write("\n");
    }

    // TestPoint := ("not ")? "ok" (" " Number)? ((" -")? (" " Description) )? (" " Directive)? "\n" (YAMLBlock)?
    function testPoint(TestPoint $testPoint): void
    {
        $this->write($testPoint->asString());
    }

    // BailOut := "Bail out!" (" " Reason)? "\n"
    function bailOut(?string $reason = null): void
    {
        // TODO: Check $reason for invalid characters
        $this->write("Bail out!" . ($reason ? " $reason" : '') . "\n");
    }

    // Pragma := "pragma " [+-] PragmaKey "\n"
    function pragma(bool $plus, ?string $key): void
    {
        // TODO: Check $key for invalid characters
        $this->write("pragma " . ($plus ? '+' : '-') . $key . "\n");
    }

    // TODO: Subtest

    // Comment := ^ (" ")* "#" [^\n]* "\n"
    function comment(string $comment): void
    {
        $this->write("# $comment\n");
    }

    // Anything := [^\n]+ "\n"
    function anything(string $anything): void
    {
        // TODO: Check $anything for invalid characters
        $this->write("$anything\n");
    }

    private function write(string $value): void
    {
        $this->buffer .= StringUtils::indent($value, $this->indentLevel);
    }

    function getString(): string
    {
        return $this->buffer;
    }
}
