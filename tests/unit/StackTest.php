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

    public function testShouldPutAElementIntoStack()
    {
        $stack = new Stack();

        $stack->push(1);

        $this->assertFalse($stack->isEmpty());
        $this->assertEquals(1, $stack->getLength());
        $this->assertEquals(1, $stack->top());
    }

    public function testShouldRemoveAnElementFromAStackThatHas2Elements()
    {
        $stack = new Stack();
        $stack->push(2);
        $stack->push(1);

        $element = $stack->pop();

        $this->assertEquals(1, $element);
        $this->assertEquals(2, $stack->top());
    }
}
