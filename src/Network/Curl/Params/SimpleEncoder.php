<?php

namespace Base\Kit\Network\Curl\Params;

use Base\Kit\Network\HttpPostFieldsBuilder;

class SimpleEncoder extends AbstractPostEncoder
{
    /**
     * @inheritdoc
     */
    public function encode($params)
    {
        return HttpPostFieldsBuilder::toCurlFields($params);
    }
}
