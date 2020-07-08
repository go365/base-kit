<?php

namespace Base\Kit\Network\Curl\Request;

class PutRequest extends PostRequest
{
    /**
     * @inheritdoc
     */
    public function setOptions()
    {
        curl_setopt($this->curl->getCurl(), CURLOPT_CUSTOMREQUEST, "PUT");

        return $this;
    }
}
