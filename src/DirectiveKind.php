<?php declare(strict_types=1);

namespace nikeee\PhpunitTap;

enum DirectiveKind
{
    case SKIP;
    case TODO;
    /**
     * non-standard, but is used on some reporters, and it is proposed to be added to the standard.
     * See: https://github.com/TestAnything/Specification/issues/16
     */
    case TIME;
}
