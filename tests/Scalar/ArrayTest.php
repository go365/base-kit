<?php

namespace Base\Kit\Tests\Scalar;

use PHPUnit\Framework\TestCase;
use Base\Kit\Support\Scalar\ArrayMaster;

class ArrayTest extends TestCase
{
    public function testFirst()
    {
        $arr = [2, 3, 4];
        $this->assertTrue(2 == ArrayMaster::first($arr));
    }

    public function testExplode()
    {
        $arr = '123,223';
        $ex = ArrayMaster::explode($arr);
        var_dump($ex);
        $this->assertTrue(ArrayMaster::isListOrEmpty($ex));
    }
}
