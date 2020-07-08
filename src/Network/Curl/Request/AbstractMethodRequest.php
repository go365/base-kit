<?php

namespace Base\Kit\Network\Curl\Request;

use Base\Kit\Contract\IHttpMethodRequest;
use Base\Kit\Network\Curl\Curl;
use Base\Kit\Support\Traits\Pattern\Singleton;

abstract class AbstractMethodRequest implements IHttpMethodRequest
{
    use Singleton;
    /**
     * @var Curl
     */
    protected $curl;

    protected function init(Curl $curl)
    {
        $this->curl = $curl;
    }
}
