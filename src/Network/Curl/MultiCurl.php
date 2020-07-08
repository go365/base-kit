<?php

namespace Base\Kit\Network\Curl;

use Base\Kit\Support\Scalar\ArrayMaster;

class MultiCurl
{
    /**
     * @param array $urls string[]
     * @return array \Mid\CommonTools\Network\CurlResponse[]
     */
    public static function execSimple(array $urls = [])
    {
        $handles = [];
        foreach ($urls as $url) {
            $handles[] = (new Curl())->setGetOption($url);
        }

        return self::execFromEntries($handles);
    }

    /**
     * @param array $handles \Mid\CommonTools\Network\Curl[]
     * @return array \Mid\CommonTools\Network\CurlResponse[]
     */
    public static function execFromEntries(array $handles)
    {
        if (!ArrayMaster::isList($handles)) {
            return [];
        }
        $result = [];
        $mh = curl_multi_init();
        /** @var Curl $handle */
        foreach ($handles as $handle) {
            curl_multi_add_handle($mh, $handle->getCurl());
        }
        $active = null;
        do {
            (curl_multi_exec($mh, $active));
        } while ($active);
        /** @var Curl $handle */
        foreach ($handles as $handle) {
            $result[] = $handle->getResponse(true);
            curl_multi_remove_handle($mh, $handle->getCurl());
            $handle->close();
        }
        curl_multi_close($mh);

        return $result;
    }
}
