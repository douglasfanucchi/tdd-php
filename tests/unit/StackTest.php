<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TDD\EmptyStackException;
use TDD\Stack;

final class StackTest extends TestCase
{
    protected Stack $stack;

    protected function setUp(): void
    {
        $this->stack = new Stack();
    }

    public function testStackShouldBeEmpty()
    {
        $this->assertTrue($this->stack->isEmpty());
        $this->assertEquals(0, $this->stack->getLength());
    }

    public function testShouldPutAElementIntoStack()
    {
        $this->stack->push(1);

        $this->assertFalse($this->stack->isEmpty());
        $this->assertEquals(1, $this->stack->getLength());
        $this->assertEquals(1, $this->stack->top());
    }

    public function testShouldRemoveAnElementFromAStackThatHas2Elements()
    {
        $this->stack->push(2);
        $this->stack->push(1);

        $element = $this->stack->pop();

        $this->assertEquals(1, $element);
        $this->assertEquals(2, $this->stack->top());
    }

    public function testEmptyStackShouldReturnAnExceptionWhenAPopIsPerformed()
    {
        $this->expectException(EmptyStackException::class);

        $this->stack->pop();
    }

    public function testEmptyStackShouldReturnNULLWhenCheckingTopElement()
    {
        $element = $this->stack->top();

        $this->assertNull($element);
    }
}
