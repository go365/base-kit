<?php

namespace Base\Kit\Network\Curl\Request;

use Base\Kit\Constants\HttpMethodConstants;
use Base\Kit\Contract\IHttpMethodRequest;
use Base\Kit\Support\Traits\Pattern\Factory;

/**
 * Class HttpRequestFactory
 * @package Base\Kit\Network\Curl\Request
 * @method static IHttpMethodRequest make(string $key, array $parameters = [])
 */
class MethodRequestFactory
{
    use Factory;

    /**
     * @return array
     */
    public static function map(): array
    {
        return [
            HttpMethodConstants::GET    => GetRequest::class,
            HttpMethodConstants::POST   => PostRequest::class,
            HttpMethodConstants::PUT    => PutRequest::class,
            HttpMethodConstants::PATCH  => PatchRequest::class,
            HttpMethodConstants::DELETE => DeleteRequest::class,
        ];
    }

    /**
     * If want to use static init method by your self , please override this method ant return method string name.
     * @return null|string
     */
    protected static function initMethodName()
    {
        return 'getInstance';
    }
}
