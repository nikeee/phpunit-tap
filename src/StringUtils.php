<?php

namespace nikeee\PhpunitTap;

class StringUtils
{
    public static function indent(string $value, int $level, string $char = ' '): string
    {
        if ($level === 0) {
            return $value;
        }

        $split = explode("\n", $value);
        $indentation = str_repeat($char, $level);
        $indented = array_map(fn($line) => $indentation . $line, $split);
        return implode("\n", $indented);
    }
}
