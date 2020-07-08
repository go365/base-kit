<?php

namespace Base\Kit\Utils;

class URLUtil
{
    /**
     * @param array|object $params it may be a simple one-dimensional structure(一維陣列),
     * or an array of arrays (which in turn may contain other arrays).<br>
     * Is an object, then only public properties will be incorporated into the result.
     * @param string $prefix 會附加於一維陣列中每一個用數字當作索引的元素之前,null則是不執行該行為
     * @param string $separator 分隔號,預設是&
     * @param int $type PHP_QUERY_RFC1738 or PHP_QUERY_RFC3986,差別在於空格的編碼,
     * 前者編碼成 => + ,後者編碼成%20. By default, PHP_QUERY_RFC1738.
     * @return string
     */
    public static function queryEncode(
        $params,
        string $prefix = '',
        string $separator = '&',
        int $type = PHP_QUERY_RFC1738
    ) {
        return http_build_query($params, $prefix, $separator, $type);
    }

    /**
     * @param string $host e.g https://secure.php.net/, secure.php.net, or secure.php.net/
     * @param $params
     * @param string $prefix 會附加於一維陣列中每一個用數字當作索引的元素之前,null則是不執行該行為
     * @param string $separator 分隔號,預設是&
     * @param int $type PHP_QUERY_RFC1738 or PHP_QUERY_RFC3986,差別在於空格的編碼,
     * 前者編碼成 => + ,後者編碼成%20. By default, PHP_QUERY_RFC1738.
     * @return string
     */
    public static function buildGet(
        string $host,
        $params,
        string $prefix = '',
        string $separator = '&',
        int $type = PHP_QUERY_RFC1738
    ) {
        return $host . '?' . self::queryEncode($params, $prefix, $separator, $type);
    }

    /**
     * @param string $url
     * @return bool
     */
    public static function isURL(string $url)
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
}
