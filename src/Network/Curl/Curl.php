<?php

namespace Base\Kit\Network\Curl;

use Base\Kit\Constants\ContentTypeConstants;
use Base\Kit\Constants\HttpMethodConstants;
use Base\Kit\Contract\IHttpRequest;
use Base\Kit\Network\Curl\Exception\CurlExeFailException;
use Base\Kit\Network\Curl\Request\MethodRequestFactory;
use Base\Kit\Support\Scalar\ArrayMaster;

/**
 * Class Curl
 * @package Mid\CommonTools\Network
 */
class Curl implements IHttpRequest, \Serializable
{
    use CurlOptionsHelper;
    /**
     * @var string
     */
    private $originUrl = '';
    /**
     * @var string
     */
    private $requestUrl = '';
    /**
     * The curl client handle.
     * @var resource
     */
    private $curl = null;
    /**
     * The origin params.
     * @var string|array|resource
     */
    private $originParams = null;
    /**
     * The request send params(payload).
     * @var string|array|resource
     */
    private $actualParams = null;
    /**
     * Header of Content type
     * @var string
     */
    private $contentType = '';

    /**
     * Curl constructor.
     */
    public function __construct()
    {
        $this->refresh();
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string|array|resource $actualParams
     * @return Curl
     */
    public function setActualParams($actualParams)
    {
        $this->actualParams = $actualParams;

        return $this;
    }

    /**
     * @return array|resource|string
     */
    public function getActualParams()
    {
        return $this->actualParams;
    }

    /**
     * @return string
     */
    public function getOriginUrl()
    {
        return $this->originUrl;
    }

    /**
     * @return string
     */
    public function getRequestUrl()
    {
        return $this->requestUrl;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setRequestUrl(string $url)
    {
        $this->requestUrl = $url;

        return $this;
    }

    /**
     * @return string|array|resource
     */
    public function getOriginParams()
    {
        return $this->originParams;
    }

    /**
     * @return resource
     */
    public function getCurl()
    {
        return $this->curl;
    }

    /**
     * Set cURL options to default
     */
    public function setDefaultOptions()
    {
        $this->setFollowLocation(true)
            ->setAutoReferer(true)
            ->switchFeedbackResponseHeader(true)
            ->setCookieSession(false)
            ->setReturnTransfer(true)
            ->setTimeout(30)
            ->setHeaderOut(true)
            ->setConnectTimeout(60);
    }

    /**
     * @inheritdoc
     */
    public function get(string $url, array $data = [], array $headers = [], bool $reset = false)
    {
        return $this->send($url, HttpMethodConstants::GET, $data, $headers, $reset);
    }

    /**
     * @inheritdoc
     */
    public function post(string $url, array $data = [], array $headers = [], bool $encode = false, bool $reset = false)
    {
        $this->contentType = $encode ? ContentTypeConstants::X_FORM_URLENCODED : '';

        return $this->send($url, HttpMethodConstants::POST, $data, $headers, $reset);
    }

    /**
     * @inheritdoc
     */
    public function postJson(
        string $url,
        array $data = [],
        array $headers = [],
        bool $reset = false
    ) {
        $this->contentType = ContentTypeConstants::JSON;
        $headers[] = 'Content-Type:' . $this->contentType;

        return $this->send($url, HttpMethodConstants::POST, $data, $headers, $reset);
    }

    /**
     * @inheritdoc
     */
    public function postXML(
        string $url,
        string $data = '',
        array $headers = [],
        bool $binary = false,
        bool $reset = false
    ) {
        $this->contentType = $binary ? ContentTypeConstants::BINARY_XML : ContentTypeConstants::TEXT_XML;
        $headers[] = 'Content-Type:' . $this->contentType;

        return $this->send($url, HttpMethodConstants::POST, $data, $headers, $reset);
    }

    /**
     * @inheritdoc
     */
    public function put(string $url, array $data = [], array $headers = [], bool $reset = false)
    {
        return $this->send($url, HttpMethodConstants::PUT, $data, $headers, $reset);
    }

    /**
     * @inheritdoc
     */
    public function patch(string $url, array $data = [], array $headers = [], bool $reset = false)
    {
        return $this->send($url, HttpMethodConstants::PATCH, $data, $headers, $reset);
    }

    /**
     * @inheritdoc
     */
    public function delete(string $url, array $data = [], array $headers = [], bool $reset = false)
    {
        return $this->send($url, HttpMethodConstants::DELETE, $data, $headers, $reset);
    }

    /**
     * If curl is valid resource , just reset the current curl session to default.
     * Otherwise init a new curl for use.
     */
    public function reset()
    {
        if (is_resource($this->curl)) {
            curl_reset($this->curl);
            $this->setDefaultOptions();
            $this->headers = [];
        } else {
            $this->refresh();
        }

        return $this;
    }

    /**
     * Close the current curl session and Init a curl session and set option to default.
     */
    public function refresh()
    {
        $this->close();
        $this->curl = curl_init();
        $this->setDefaultOptions();
        $this->headers = [];
    }

    /**
     * Close the curl handle.
     */
    public function close()
    {
        if (is_resource($this->curl)) {
            curl_close($this->curl);
        }
    }

    /**
     * Check the curl exec is success or not.
     * @throws CurlExeFailException when curl exe error occur
     */
    public function checkSucceed()
    {
        if ($this->getErrorNumber() != CURLE_OK) {
            throw new CurlExeFailException($this->getErrorMessage() . "(" . $this->getErrorNumber() . ")");
        }
    }

    /**
     * Return the last error number
     * @return int
     */
    public function getErrorNumber(): int
    {
        return curl_errno($this->curl);
    }

    /**
     * Return a string containing the last error for the current session
     * @return string
     */
    public function getErrorMessage(): string
    {
        return curl_error($this->curl);
    }

    /**
     * @param string $url
     * @param string $method
     * @param array|string|resource $params
     * @param array $headers
     * @param bool $reset
     * @return CurlResponse
     */
    private function send(string $url, string $method, $params, array $headers = [], bool $reset = false)
    {
        if ($reset) {
            $this->reset();
        }
        $this->originUrl = $url;
        $this->requestUrl = $this->originUrl;
        $this->originParams = $params;
        $request = MethodRequestFactory::make($method, [$this]);
        $request->setOptions()->encodeParams();
        if (ArrayMaster::isList($headers)) {
            $this->appendHeader($headers);
        }
        curl_setopt($this->curl, CURLOPT_URL, $this->requestUrl);
        curl_exec($this->curl);

        return $this->toResponse($method);
    }

    /**
     * Save the response detail.
     * @param string $method
     * @return CurlResponse
     */
    private function toResponse(string $method)
    {
        $result = new CurlResponse($this);

        return $result->setHttpMethod($method);
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize($this);
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        $this->refresh();
    }
}
