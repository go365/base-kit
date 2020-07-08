<?php

namespace Base\Kit\Tests;

use PHPUnit\Framework\TestCase;
use Base\Kit\Support\Scalar\ArrayMaster;

class ExampleTest extends TestCase
{
    public function testExample()
    {
        $arr = [2, 3, 4];
        $this->assertTrue(2 == ArrayMaster::first($arr));
    }
}
