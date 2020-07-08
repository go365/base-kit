<?php

namespace Base\Kit\Support\Scalar;

class XmlMaster
{
    /**
     * 陣列轉換成XML
     * @param array $params
     * @return string|boolean
     * this function returns a string on success and FALSE on error.
     */
    public static function arrayToXml(array $params)
    {
        $params = array_flip($params);
        $xml = new \SimpleXMLElement('<xml/>');
        array_walk_recursive($params, [$xml, 'addChild']);

        return $xml->asXML();
    }

    /**
     * @param $xml
     * @return object|boolean
     * Returns a SimpleXMLElement or FALSE on failure.
     */
    public static function xmlToObject($xml)
    {
        $result = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

        return $result;
    }

    /**
     * @param $xml
     * @return array|boolean
     * Returns an array or FALSE on failure.
     */
    public static function xmlToArray($xml)
    {
        $result = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        return $result;
    }
}
