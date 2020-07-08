<?php

namespace Base\Kit\Network\Curl\Request;

use Base\Kit\Contract\Params\IPostEncoder;
use Base\Kit\Network\Curl\Curl;
use Base\Kit\Network\Curl\Params\PostEncoderFactory;

class PostRequest extends AbstractMethodRequest
{
    /**
     * @var IPostEncoder
     */
    private $paramsEncoder;

    protected function init(Curl $curl)
    {
        parent::init($curl);
        $this->paramsEncoder = PostEncoderFactory::make($curl->getContentType());
    }

    /**
     * @inheritdoc
     */
    public function encodeParams()
    {
        $payload = $this->paramsEncoder->encode($this->curl->getOriginParams());
        $this->curl->setActualParams($payload);
        curl_setopt($this->curl->getCurl(), CURLOPT_POSTFIELDS, $payload);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setOptions()
    {
        curl_setopt($this->curl->getCurl(), CURLOPT_POST, true);

        return $this;
    }
}
