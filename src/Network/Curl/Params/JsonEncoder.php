<?php

namespace Base\Kit\Network\Curl\Params;

class JsonEncoder extends AbstractPostEncoder
{
    /**
     * @inheritdoc
     */
    public function encode($params)
    {
        return json_encode($params) ?: '';
    }
}
