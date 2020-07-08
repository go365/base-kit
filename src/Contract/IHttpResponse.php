<?php

namespace Base\Kit\Contract;

interface IHttpResponse
{
    /**
     * @return string|resource
     */
    public function body();

    /**
     * @return array
     */
    public function requestHeader();

    /**
     * @return array
     */
    public function responseHeader();

    /**
     * @return array
     */
    public function originParams();

    /**
     * @return string|resource|array
     */
    public function actualParams();

    /**
     * @return string
     */
    public function method();

    /**
     * Origin url.
     * @return string
     */
    public function originUrl();

    /**
     * The send url.
     * @return string
     */
    public function requestUrl();

    /**
     * @return array
     */
    public function info();

    /**
     * @return int
     */
    public function statusCode();

    /**
     * @return array
     */
    public function errorInfo();

    /**
     * Request send complete and no error occur.
     * @return bool
     */
    public function isSuccess();

    /**
     * All cookies.
     * @return array
     */
    public function cookies();

    /**
     * The all info.
     * @return array
     */
    public function all();
}
