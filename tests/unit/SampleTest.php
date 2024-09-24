<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TDD\Sample;

final class SampleTest extends TestCase
{
    public function testSampleObjectShouldHaveNumber() : void
    {
        $expected = 100;

        $sample = new Sample();

        $this->assertEquals($expected, $sample->number);
    }
}
