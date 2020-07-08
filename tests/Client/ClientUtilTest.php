<?php

namespace Base\Kit\Tests\Client;

use PHPUnit\Framework\TestCase;
use Base\Kit\Utils\ClientUtil;

class ClientUtilTest extends TestCase
{
    public function testIp()
    {
        $this->assertSame('5.5.5.5', ClientUtil::ip('5.5.5.5'));
    }
}
