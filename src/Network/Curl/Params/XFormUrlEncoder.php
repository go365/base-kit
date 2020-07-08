<?php

namespace Base\Kit\Network\Curl\Params;

use Base\Kit\Utils\URLUtil;

class XFormUrlEncoder extends AbstractPostEncoder
{
    /**
     * @inheritdoc
     */
    public function encode($params)
    {
        return URLUtil::queryEncode($params);
    }
}
