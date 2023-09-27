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
        $prefix = match ($this->directive) {
            DirectiveKind::SKIP => 'skip',
            DirectiveKind::TODO => 'todo',
        };
        return ' # ' . $prefix . ($this->reason !== null ? ' ' . $this->reason : '');
    }

    public static function skip(?string $reason = null): Directive
    {
        return new Directive(DirectiveKind::SKIP, $reason);
    }

    public static function todo(?string $reason = null): Directive
    {
        return new Directive(DirectiveKind::TODO, $reason);
    }
}
