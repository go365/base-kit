<?php

namespace Base\Kit\Network\Curl\Request;

class DeleteRequest extends GetRequest
{
    /**
     * @inheritdoc
     */
    public function setOptions()
    {
        curl_setopt($this->curl->getCurl(), CURLOPT_CUSTOMREQUEST, "DELETE");

        return $this;
    }
}
