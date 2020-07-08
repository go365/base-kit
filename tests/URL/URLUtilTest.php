<?php

namespace Base\Kit\Tests\URL;

use PHPUnit\Framework\TestCase;
use Base\Kit\Utils\URLUtil;

class URLUtilTest extends TestCase
{
    public function testQueryEncode()
    {
        $params = ['a' => 'my name', 'b' => '2', 'no_key'];
        $actual = URLUtil::queryEncode($params, 'var_', '&&');
        $expected = 'a=my+name&&b=2&&var_0=no_key';
        $this->assertEquals($expected, $actual);
    }

    public function testBuildGet()
    {
        $host = 'http://php.net/manual';
        $params = ['a' => 'very good', 'b' => '2', 'no_key'];
        $actual = URLUtil::buildGet($host, $params, 'var_', '&', PHP_QUERY_RFC3986);
        $expected = 'http://php.net/manual/?a=very%20good&b=2&var_0=no_key';
        $this->assertEquals($expected, $actual);
    }
}
