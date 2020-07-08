<?php

namespace Base\Kit\Contract;

interface IHttpRequest
{
    /**
     * Send a request with get method
     * @param string $url
     * @param array $data
     * @param array $headers
     * @param bool $reset true will reset the http client for used
     * @return IHttpResponse
     */
    public function get(string $url, array $data = [], array $headers = [], bool $reset = false);

    /**
     * Send a request with post method
     * @param string $url
     * @param array $data
     * @param array $headers
     * @param bool $encode
     * @param bool $reset true will reset the http client for used
     * @return IHttpResponse
     */
    public function post(string $url, array $data = [], array $headers = [], bool $encode = false, bool $reset = false);

    /**
     * Send a request with post method
     * @param string $url
     * @param array $data
     * @param array $headers
     * @param bool $reset true will reset the http client for used
     * @return IHttpResponse
     */
    public function postJson(string $url, array $data = [], array $headers = [], bool $reset = false);

    /**
     * @param string $url
     * @param string $data
     * @param array $headers
     * @param bool $binary
     * @param bool $reset
     * @return IHttpResponse
     */
    public function postXML(
        string $url,
        string $data = '',
        array $headers = [],
        bool $binary = false,
        bool $reset = false
    );

    /**
     * Send a request with put method
     * @param string $url
     * @param array $data
     * @param array $headers
     * @param bool $reset true will reset the http client for used
     * @return IHttpResponse
     */
    public function put(string $url, array $data = [], array $headers = [], bool $reset = false);

    /**
     * Send a request with patch method
     * @param string $url
     * @param array $data
     * @param array $headers
     * @param bool $reset true will reset the http client for used
     * @return IHttpResponse
     */
    public function patch(string $url, array $data = [], array $headers = [], bool $reset = false);

    /**
     * Send a request with delete method
     * @param string $url
     * @param array $data
     * @param array $headers
     * @param bool $reset true will reset the http client for used
     * @return IHttpResponse
     */
    public function delete(string $url, array $data = [], array $headers = [], bool $reset = false);
}
