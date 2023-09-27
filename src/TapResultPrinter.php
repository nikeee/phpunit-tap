<?php declare(strict_types=1);

namespace nikeee\PhpunitTap;

use PHPUnit\Event\Application\Started;
use PHPUnit\Event\Event;
use PHPUnit\Event\Test\Failed;
use PHPUnit\Event\Test\Passed;
use PHPUnit\Event\Test\Skipped;
use PHPUnit\Event\TestRunner\Finished;
use PHPUnit\Event\TestSuite\Loaded;
use PHPUnit\Event\Tracer\Tracer;

final class TapResultPrinter implements Tracer
{
    private readonly TapWriter $writer;

    public function __construct(private readonly ?string $targetFileName)
    {
        $this->writer = new TapWriter();
    }

    public function trace(Event $event): void
    {
        if ($event instanceof Started) {
            $this->writer->version();
        } else if ($event instanceof Loaded) {
            $this->writer->plan($event->testSuite()->count());
        } else if ($event instanceof Passed) {
            $this->writer->testPoint(
                new TestPoint(
                    true,
                    number: null,
                    description: $event->test()->id(),
                    directive: null,
                    yamlBlock: null,
                )
            );
        } else if ($event instanceof Failed) {
            $this->writer->testPoint(
                new TestPoint(
                    false,
                    number: null,
                    description: $event->test()->id(),
                    directive: null,
                    yamlBlock: null,
                )
            );
        } else if ($event instanceof Skipped) {
            $this->writer->testPoint(
                new TestPoint(
                    true,
                    number: null,
                    description: $event->test()->id(),
                    directive: Directive::SKIP,
                    yamlBlock: null,
                )
            );
        } else if ($event instanceof Finished) {
            if ($this->targetFileName !== null) {
                file_put_contents($this->targetFileName, $this->writer->getString());
            } else {
                echo $this->writer->getString();
            }
        } else {
            var_dump(get_class($event));
        }
    }
}
