<?php

namespace Base\Kit\Network\Curl\Request;

use Base\Kit\Support\Scalar\ArrayMaster;
use Base\Kit\Utils\URLUtil;

class GetRequest extends AbstractMethodRequest
{
    /**
     * @inheritdoc
     */
    public function encodeParams()
    {
        $params = $this->curl->getOriginParams();
        if (ArrayMaster::isList($params)) {
            $sendParams = URLUtil::buildGet($this->curl->getRequestUrl(), $params);
            $this->curl->setActualParams($sendParams);
            $this->curl->setRequestUrl($sendParams);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setOptions()
    {
        curl_setopt($this->curl->getCurl(), CURLOPT_HTTPGET, true);

        return $this;
    }
}
