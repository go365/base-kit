<?php

namespace Base\Kit\Utils;

class UrlParserUtil
{
    /** @var array $url */
    private $url;

    /**
     * ParserUtil constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = parse_url($url);
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->url = parse_url($url);

        return $this;
    }

    /**
     * @return string|null
     */
    public function scheme()
    {
        return $this->url['scheme'] ?? null;
    }

    /**
     * @return string|null
     */
    public function host()
    {
        return $this->url['host'] ?? null;
    }

    /**
     * @return string|null
     */
    public function path()
    {
        return $this->url['path'] ?? null;
    }

    /**
     * @return string|null
     */
    public function query()
    {
        return $this->url['query'] ?? null;
    }

    /**
     * @return string|null
     */
    public function port()
    {
        return $this->url['port'] ?? null;
    }

    /**
     * @return string|null
     */
    public function user()
    {
        return $this->url['user'];
    }

    /**
     * @return string|null
     */
    public function fragment()
    {
        return $this->url['fragment'];
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->url;
    }
}
