<?php

/*
 * This file is part of the tuowt/Zhifu99\.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Zhifu99\Kernel\Support;

use ArrayAccess;
use ArrayIterator;
use Zhifu99\Kernel\Contracts\Arrayable;
use IteratorAggregate;

/**
 * Class ArrayAccessible.
 */
class ArrayAccessible implements ArrayAccess, IteratorAggregate, Arrayable
{
    private $array;

    public function __construct($array = [])
    {
        $this->array = $array;
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->array);
    }

    public function offsetGet($offset)
    {
        return $this->array[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if (null === $offset) {
            $this->array[] = $value;
        } else {
            $this->array[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->array[$offset]);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->array);
    }

    public function toArray()
    {
        return $this->array;
    }
}
