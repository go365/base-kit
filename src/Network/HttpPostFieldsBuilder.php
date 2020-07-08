<?php

namespace Base\Kit\Network;

use Base\Kit\Support\Scalar\StringMaster;

class HttpPostFieldsBuilder
{
    /**
     * Use this to send data with multidimensional arrays and CURLFiles.
     * @param mixed $data
     * @param string $key - will set the paramater name, probably don't want to use
     * @param array $result - Can pass data to start with, only put good data here
     * @return array
     * @example curl_setopt($ch, CURLOPT_POSTFIELDS, build_post_fields($postfields));
     */
    public static function toCurlFields($data, string $key = '', array &$result = [])
    {
        if (($data instanceof \CURLFile) || !(is_array($data) || is_object($data))) {
            $result[$key] = $data;

            return $result;
        } else {
            foreach ($data as $k => $v) {
                self::toCurlFields($v, StringMaster::isNotEmpty($key) ? $key . "[{$k}]" : $k, $result);
            }

            return $result;
        }
    }
}
