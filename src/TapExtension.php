<?php declare(strict_types=1);

namespace nikeee\PhpunitTap;

use PHPUnit\Runner;
use PHPUnit\TextUI;

final class TapExtension implements Runner\Extension\Extension
{
    public function bootstrap(
        TextUI\Configuration\Configuration   $configuration,
        Runner\Extension\Facade              $facade,
        Runner\Extension\ParameterCollection $parameters
    ): void
    {
        $targetFileName = $parameters->has('fileName')
            ? $parameters->get('fileName')
            : null;
        $facade->registerTracer(new TapResultPrinter($targetFileName));
    }
}
