<?php

namespace Base\Kit\Utils;

use Base\Kit\Support\Scalar\ArrayMaster;

/**
 * Handle client information.
 * Class ClientUtil
 * @package Base\Kit\Utils
 */
class ClientUtil
{
    /**
     * Get the real client ip.
     * @param string|null $customize
     * @return string
     */
    public static function ip(string $customize = null)
    {
        $result = $customize;
        if (isset($_SERVER) && !empty($_SERVER['REMOTE_ADDR'])) {
            $result = $_SERVER['REMOTE_ADDR'];
        } else {
            if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $forwardIps = ArrayMaster::explode($_SERVER['HTTP_X_FORWARDED_FOR']);
                if (ArrayMaster::isList($forwardIps)) {
                    $result = ArrayMaster::first($forwardIps);
                }
            }
        }

        return $result;
    }
}
