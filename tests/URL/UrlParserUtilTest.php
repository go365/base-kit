<?php

namespace Base\Kit\Tests\URL;

use PHPUnit\Framework\TestCase;
use Base\Kit\Utils\UrlParserUtil;

class UrlParserUtilTest extends TestCase
{
    /** @var UrlParserUtil $parse */
    private $parse;

    /**
     * ParseUtilTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->parse = new UrlParserUtil('http://username:password@hostname:9090/path?arg=value#anchor');
    }

    public function testHost()
    {
        $this->assertNotNull($this->parse->host());
    }

    public function testScheme()
    {
        $this->assertNotNull($this->parse->scheme());
    }

    public function testPath()
    {
        $this->assertNotNull($this->parse->path());
    }

    public function testQuery()
    {
        $this->assertNotNull($this->parse->query());
    }

    public function testPort()
    {
        $this->assertNotNull($this->parse->port());
    }

    public function testUser()
    {
        $this->assertNotNull($this->parse->user());
    }

    public function testFragment()
    {
        $this->assertNotNull($this->parse->fragment());
    }
}
