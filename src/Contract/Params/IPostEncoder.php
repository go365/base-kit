<?php

namespace Base\Kit\Contract\Params;

interface IPostEncoder
{
    /**
     * @param array|string|resource $params
     * @return array|string|resource
     */
    public function encode($params);
}
