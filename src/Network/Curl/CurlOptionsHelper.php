<?php

namespace Base\Kit\Network\Curl;

use Base\Kit\Support\Scalar\ArrayMaster;

/**
 * Trait CurlOptionsHelper
 * @package Base\Kit\Network\Curl
 */
trait CurlOptionsHelper
{
    private $headers = [];

    /**
     * @return resource
     */
    abstract public function getCurl();

    /**
     * One of CURL_SSLVERSION_DEFAULT (0),
     * CURL_SSLVERSION_TLSv1 (1),
     * CURL_SSLVERSION_SSLv2 (2),
     * CURL_SSLVERSION_SSLv3 (3),
     * CURL_SSLVERSION_TLSv1_0 (4),
     * CURL_SSLVERSION_TLSv1_1 (5) or CURL_SSLVERSION_TLSv1_2 (6).<br>
     * Your best bet is to not set this and let it use the default.
     * Setting it to 2 or 3 is very dangerous given the known vulnerabilities in SSLv2 and SSLv3.
     * @param int $version
     * @return $this
     */
    public function setSSLVersion(int $version)
    {
        curl_setopt($this->getCurl(), CURLOPT_SSLVERSION, $version);

        return $this;
    }

    /**
     * TRUE to include the header in the output.
     * @param bool $switch
     * @return $this
     */
    public function switchFeedbackResponseHeader(bool $switch)
    {
        curl_setopt($this->getCurl(), CURLOPT_HEADER, $switch);

        return $this;
    }

    /**
     * TRUE to follow any "Location:" , if CURLOPT_MAXREDIRS is set , that well follow amount of HTTP redirections.
     * @param bool $followLocation
     * @return $this
     */
    public function setFollowLocation(bool $followLocation)
    {
        curl_setopt($this->getCurl(), CURLOPT_FOLLOWLOCATION, $followLocation);

        return $this;
    }

    /**
     * TRUE to automatically set the Referer: field in requests where it follows a Location: redirect.
     * @param bool $autoReferer
     * @return $this
     */
    public function setAutoReferer(bool $autoReferer)
    {
        curl_setopt($this->getCurl(), CURLOPT_AUTOREFERER, $autoReferer);

        return $this;
    }

    /**
     * TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
     * @param bool $returnTransfer
     * @return $this
     */
    public function setReturnTransfer(bool $returnTransfer)
    {
        curl_setopt($this->getCurl(), CURLOPT_RETURNTRANSFER, $returnTransfer);

        return $this;
    }

    /**
     * The maximum number of seconds to allow cURL functions to execute.
     * @param $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        curl_setopt($this->getCurl(), CURLOPT_TIMEOUT, $timeout);

        return $this;
    }

    /**
     * The contents of the "User-Agent: " header to be used in a HTTP request.
     * @param string $userAgent
     * @return $this
     */
    public function setUserAgent(string $userAgent)
    {
        curl_setopt($this->getCurl(), CURLOPT_USERAGENT, $userAgent);

        return $this;
    }

    /**
     * The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
     * @param int $secTime
     * @return $this
     */
    public function setConnectTimeout(int $secTime)
    {
        curl_setopt($this->getCurl(), CURLOPT_CONNECTTIMEOUT, $secTime);

        return $this;
    }

    /**
     * An array of HTTP header fields to set, in the format array('Content-type: text/plain', 'Content-length: 100')
     * @param array $headers
     * @return $this
     */
    public function setHttpHeader(array $headers)
    {
        $this->headers = $headers;
        curl_setopt($this->getCurl(), CURLOPT_HTTPHEADER, $this->headers);

        return $this;
    }

    /**
     * @param array $headers
     */
    private function appendHeader(array $headers)
    {
        if (ArrayMaster::isList($headers)) {
            $headers = ArrayMaster::arrayMerge($this->headers, $headers);
            $this->setHttpHeader($headers);
        }
    }

    /**
     * The maximum amount of HTTP redirections to follow. Use this option alongside CURLOPT_FOLLOWLOCATION.
     * @param int $maxRedirects
     * @return $this
     */
    public function setMaxRedirects(int $maxRedirects)
    {
        curl_setopt($this->getCurl(), CURLOPT_MAXREDIRS, $maxRedirects);

        return $this;
    }

    /**
     * The contents of the "Referer: " header to be used in a HTTP request.
     * @param string $referer url
     * @return $this
     */
    public function setReferer(string $referer)
    {
        curl_setopt($this->getCurl(), CURLOPT_REFERER, $referer);

        return $this;
    }

    /**
     * 0 don't verify ssl
     * 1 to check the existence of a common name in the SSL peer certificate.<p>
     * 2 to check the existence of a common name and also verify that it matches the hostname provided.(default value)
     * @param string $sslVerifyhost url
     * @return $this
     */
    public function setSSLVerifyHost(string $sslVerifyhost)
    {
        curl_setopt($this->getCurl(), CURLOPT_SSL_VERIFYHOST, $sslVerifyhost);

        return $this;
    }

    /**
     * FALSE to stop cURL from verifying the peer's certificate.<p><p>
     * Alternate certificates to verify against can be specified with the CURLOPT_CAINFO option
     * or a certificate directory can be specified with the CURLOPT_CAPATH option.<p><p>
     * TRUE by default as of cURL 7.10. Default bundle installed as of cURL 7.10.
     * @param bool $sslVerifypeer url
     * @return $this
     */
    public function setSSLVerifyPeer(bool $sslVerifypeer)
    {
        curl_setopt($this->getCurl(), CURLOPT_SSL_VERIFYPEER, $sslVerifypeer);

        return $this;
    }

    /**
     * Batch set curl opts
     * @param array $options curl opts.
     * @return $this
     */
    public function setOptions(array $options)
    {
        curl_setopt_array($this->getCurl(), $options);

        return $this;
    }

    /**
     * TRUE to track the handle's request string.
     * @param bool $headerOut
     * @return $this
     */
    public function setHeaderOut(bool $headerOut)
    {
        curl_setopt($this->getCurl(), CURLINFO_HEADER_OUT, $headerOut);

        return $this;
    }

    /**
     * The HTTP authentication method(s) to use. The options areAUTH_BASIC,
     * CURLAUTH_DIGEST, CURLAUTH_GSSNEGOTIATE, CURLAUTH_NTLM, CURLAUTH_ANY,
     * and CURLAUTH_ANYSAFE.
     * @param int $method
     * @return $this
     */
    public function setHttpAuth(int $method)
    {
        curl_setopt($this->getCurl(), CURLOPT_HTTPAUTH, $method);

        return $this;
    }

    /**
     * A username and password formatted as "[username]:[password]" to use for the connection.
     * @param string $userPwd
     * @return $this
     */
    public function setUserPwd($userPwd)
    {
        curl_setopt($this->getCurl(), CURLOPT_USERPWD, $userPwd);

        return $this;
    }

    /**
     * The contents of the "Accept-Encoding: " header. This enables decoding of the
     * response. Supported encodings are "identity", "deflate", and "gzip". If an empty
     * string, "", is set, a header containing all supported encoding types is sent.
     * @param string $encoding
     * @return $this
     */
    public function setEncoding($encoding)
    {
        curl_setopt($this->getCurl(), CURLOPT_ENCODING, $encoding);

        return $this;
    }

    /**
     * TRUE to mark this as a new cookie "session".
     * @param bool $cookieSession
     * @return $this
     */
    public function setCookieSession(bool $cookieSession)
    {
        curl_setopt($this->getCurl(), CURLOPT_COOKIESESSION, $cookieSession);

        return $this;
    }

    /**
     * Save cookie as file when session handle end(exec end).
     * @param string $cookieFileName
     * @return $this
     */
    public function setCookieByFile(string $cookieFileName)
    {
        curl_setopt($this->getCurl(), CURLOPT_COOKIEJAR, $cookieFileName);
        curl_setopt($this->getCurl(), CURLOPT_COOKIEFILE, $cookieFileName);

        return $this;
    }

    /**
     * The contents of the "Cookie: " header to be used in the HTTP request.<p><p>
     * multiple cookies are separated with a semicolon followed by a space
     * @param string $cookie
     * @return $this
     * @example fruit=apple; colour=red
     */
    public function setCookieByString(string $cookie)
    {
        curl_setopt($this->getCurl(), CURLOPT_COOKIE, $cookie);

        return $this;
    }

    /**
     * A custom request method to use instead of "GET" or "HEAD" when doing a HTTP request.
     * This is useful for doing "DELETE" or other, more obscure HTTP requests.
     * Valid values are things like "GET", "POST", "CONNECT" and so on;
     * i.e. Do not enter a whole HTTP request line here. For instance,
     * entering "GET /index.html HTTP/1.0\r\n\r\n" would be incorrect.
     * @param $method
     * @return $this
     */
    public function setCustomerRequest($method)
    {
        curl_setopt($this->getCurl(), CURLOPT_CUSTOMREQUEST, $method);

        return $this;
    }

    /**
     * Read SSL page content from https with curl
     * @return $this
     */
    public function enableSSL()
    {
        $this->setSSLVerifyHost(0);
        $this->setSSLVerifyPeer(false);

        return $this;
    }

    /**
     * TRUE to fail verbosely if the HTTP code returned is greater than or equal to 400.
     * The default behavior is to return the page normally, ignoring the code.
     * @param bool $failOnError
     * @return $this
     */
    public function setFailOnError(bool $failOnError)
    {
        curl_setopt($this->getCurl(), CURLOPT_FAILONERROR, $failOnError);

        return $this;
    }
}
