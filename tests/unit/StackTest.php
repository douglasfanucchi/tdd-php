<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TDD\Stack;

final class StackTest extends TestCase
{
    public function testStackShouldBeEmpty()
    {
        $stack = new Stack();

        $this->assertTrue($stack->isEmpty());
        $this->assertEquals(0, $stack->getLength());
    }
}
