<?php

namespace TDD;

class Stack
{
    protected int $length = 0;
    protected array $elements;

    public function isEmpty() : bool
    {
        return $this->getLength() == 0;
    }

    public function getLength() : int
    {
        return $this->length;
    }

    public function push(mixed $element) : void
    {
        $this->length++;
        $this->elements[] = $element;
    }

    public function top() : mixed
    {
        return $this->elements[$this->length - 1];
    }

    public function pop() : mixed
    {
        $element = $this->top();
        unset($this->elements[$this->length - 1]);
        $this->length--;
        return $element;
    }
}
