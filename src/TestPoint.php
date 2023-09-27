<?php declare(strict_types=1);

namespace nikeee\PhpunitTap;

use Symfony\Component\Yaml\Yaml;

class TestPoint
{
    public function __construct(
        private readonly bool       $ok,
        private readonly ?int       $number,
        private readonly ?string    $description = null,
        private readonly ?Directive $directive = null,
        private readonly ?array     $yamlMetadata = null,
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

        if ($this->yamlMetadata !== null) {
            $result .= "\n";

            $yaml = Yaml::dump($this->yamlMetadata);

            $asFrontMatter = "---\n$yaml...";

            $result .= StringUtils::indent($asFrontMatter, 2, ' ');
        }

        $result .= "\n";
        return $result;
    }
}
