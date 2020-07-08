<?php

namespace Base\Kit\Network\Curl\Params;

use Base\Kit\Contract\Params\IPostEncoder;
use Base\Kit\Support\Traits\Pattern\Singleton;

abstract class AbstractPostEncoder implements IPostEncoder
{
    use Singleton;

    /**
     * Initialize class.
     * @param array $parameters
     */
    protected function init(...$parameters)
    {
    }

    /**
     * @inheritdoc
     */
    public function encode($params)
    {
        return $params;
    }
}
