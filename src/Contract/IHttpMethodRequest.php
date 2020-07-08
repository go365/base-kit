<?php

namespace Base\Kit\Contract;

interface IHttpMethodRequest
{
    /**
     * Encode the conn client take params.
     * @return $this
     */
    public function encodeParams();

    /**
     * Setting the required options.
     * @return $this
     */
    public function setOptions();
}
