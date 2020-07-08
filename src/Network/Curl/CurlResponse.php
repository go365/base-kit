<?php

namespace Base\Kit\Network\Curl;

use Base\Kit\Contract\IHttpResponse;
use Base\Kit\Support\Scalar\ArrayMaster;

/**
 * Class CurlResponse
 * @package Mid\CommonTools\Network
 */
class CurlResponse implements IHttpResponse
{
    /**
     * The http method
     * @var string
     */
    private $httpMethod;
    /**
     * @var Curl
     */
    private $curl;

    /**
     * CurlResponse constructor.
     * @param Curl $curl
     */
    public function __construct(Curl $curl)
    {
        $this->curl = $curl;
    }

    /**
     * @param string $httpMethod
     * @return $this
     */
    public function setHttpMethod(string $httpMethod): CurlResponse
    {
        $this->httpMethod = $httpMethod;

        return $this;
    }

    /**
     * @return string
     */
    public function response()
    {
        return curl_multi_getcontent($this->curl->getCurl());
    }

    /**
     * @return string|resource
     */
    public function body()
    {
        return substr($this->response(), $this->getResponseInfoByKey('header_size'));
    }

    /**
     * @return array
     */
    public function requestHeader()
    {
        return $this->getResponseInfoByKey("request_header");
    }

    /**
     * @return array
     */
    public function responseHeader()
    {
        $headers = [];
        $strHeaders = substr($this->response(), 0, $this->getResponseInfoByKey('header_size'));
        foreach (ArrayMaster::explode($strHeaders, "\r\n") as $line => $content) {
            if ($line === 0) {
                // 第一行必定是 HTTP/1.1 200 OK 這樣的內容
                $headers['http_code'] = $content;
            } else {
                try {
                    // if line is xxx: xxx , set to $headers , otherwise ignore.
                    [$key, $value] = ArrayMaster::explode($content, ': ');
                    $headers[$key] = $value;
                } catch (\Throwable $e) {
                }
            }
        }

        return $headers;
    }

    /**
     * @return array
     */
    public function originParams()
    {
        return $this->curl->getOriginParams();
    }

    /**
     * @inheritdoc
     */
    public function actualParams()
    {
        return $this->curl->getActualParams();
    }

    /**
     * @return string
     */
    public function method()
    {
        return $this->httpMethod;
    }

    /**
     * @return string
     */
    public function originUrl()
    {
        return $this->curl->getOriginUrl();
    }

    /**
     * The send url.
     * @return string
     */
    public function requestUrl()
    {
        return $this->curl->getRequestUrl();
    }

    /**
     * @return array
     */
    public function info()
    {
        return curl_getinfo($this->curl->getCurl());
    }

    /**
     * @return int
     */
    public function statusCode()
    {
        return $this->getResponseInfoByKey("http_code");
    }

    /**
     * @return array
     */
    public function errorInfo()
    {
        return [
            'error_number' => $this->curl->getErrorNumber(),
            'error_msg'    => $this->curl->getErrorMessage()
        ];
    }

    /**
     * Request send complete and no error occur.
     * @return bool
     */
    public function isSuccess()
    {
        return $this->curl->getErrorNumber() == CURLE_OK;
    }

    /**
     * All cookies.
     * @return array
     */
    public function cookies()
    {
        return curl_getinfo($this->curl->getCurl(), CURLINFO_COOKIELIST);
    }

    /**
     * Get info by key.
     * @param string $key
     * @param null $default
     * @return mixed
     */
    private function getResponseInfoByKey(string $key, $default = null)
    {
        $info = $this->info();

        return $info[$key] ?? $default;
    }

    /**
     * The all info.
     * @return array
     */
    public function all()
    {
        return [
            'success'          => $this->isSuccess(),
            'request_headers'  => $this->requestHeader(),
            'origin_params'    => $this->originParams(),
            'actual_params'    => $this->actualParams(),
            'method'           => $this->method(),
            'origin_url'       => $this->originUrl(),
            'request_url'      => $this->requestUrl(),
            'statusCode'       => $this->statusCode(),
            'errorInfo'        => $this->errorInfo(),
            'cookies'          => $this->cookies(),
            'response_headers' => $this->responseHeader(),
            'body'             => $this->body()
        ];
    }
}
