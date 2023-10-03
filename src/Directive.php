<?php declare(strict_types=1);

namespace nikeee\PhpunitTap;

class Directive
{
    public function __construct(
        private readonly DirectiveKind $kind,
        private readonly ?string       $reason = null,
    )
    {
    }

    function asString(): string
    {
        return match ($this->kind) {
            DirectiveKind::SKIP => ' # skip' . ($this->reason !== null ? ' ' . $this->reason : ''),
            DirectiveKind::TODO => ' # todo' . ($this->reason !== null ? ' ' . $this->reason : ''),
            DirectiveKind::TIME => ' # time=' . ($this->reason !== null ? $this->reason : '0ms'),
        };
    }

    public static function skip(?string $reason = null): Directive
    {
        return new Directive(DirectiveKind::SKIP, $reason);
    }

    public static function todo(?string $reason = null): Directive
    {
        return new Directive(DirectiveKind::TODO, $reason);
    }

    /**
     * non-standard, but is used on some reporters, and it is proposed to be added to the standard.
     * See: https://github.com/TestAnything/Specification/issues/16
     */
    public static function time(float $milliseconds): Directive
    {
        $formatted = number_format($milliseconds, 3, '.', '');
        return new Directive(
            DirectiveKind::TIME,
            $formatted . 'ms',
        );
    }
}
