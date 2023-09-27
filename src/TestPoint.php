<?php declare(strict_types=1);

namespace nikeee\PhpunitTap;

class TestPoint
{
    public function __construct(
        private readonly bool       $ok,
        private readonly ?int       $number,
        private readonly ?string    $description = null,
        private readonly ?Directive $directive = null,
        private readonly ?string    $yamlBlock = null,
    )
    {
    }

    function asString(): string
    {
        $result = $this->ok ? "ok" : "not ok";
        if ($this->number !== null) {
            $result .= " $this->number";
        }

        if ($this->description !== null) {
            $escapedDescription = str_replace('#', '\\#', $this->description);
            $result .= " - $escapedDescription";
        }

        if ($this->directive !== null) {
            $result .= $this->directive->asString();
        }

        if ($this->yamlBlock !== null) {
            $result .= "\n";
            $result .= $this->yamlBlock;
        }

        $result .= "\n";
        return $result;
    }
}
