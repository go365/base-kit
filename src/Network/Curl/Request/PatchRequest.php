<?php

namespace Base\Kit\Network\Curl\Request;

class PatchRequest extends AbstractMethodRequest
{
    /**
     * @inheritdoc
     */
    public function encodeParams()
    {
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setOptions()
    {
        return $this;
    }
}
