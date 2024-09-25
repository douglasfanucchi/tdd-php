<?php

namespace TDD;

class Stack
{
    protected int $length = 0;

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
    }

    public function top() : mixed
    {
        return 1;
    }
}
