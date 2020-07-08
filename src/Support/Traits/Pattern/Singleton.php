<?php

namespace Base\Kit\Support\Traits\Pattern;

trait Singleton
{
    /**
     * Instances.
     * @var object[]
     */
    protected static $INSTANCES = null;

    final private function __construct(...$parameters)
    {
        $this->init(...$parameters);
    }

    /**
     * Initialize class.
     * @param array $parameters
     */
    abstract protected function init(...$parameters);

    /**
     * Multi singleton instance handle.
     * @param array $parameters
     * @return static
     */
    public static function getInstance(...$parameters)
    {
        if (!isset(self::$INSTANCES[static::symbol()])) {
            $instance = new static(...$parameters);
            self::$INSTANCES[static::symbol()] = $instance;
        } else {
            /** @var static $instance */
            $instance = self::$INSTANCES[static::symbol()];
            $instance->init(...$parameters);
        }

        return $instance;
    }

    /**
     * Handle the instance container key.
     * @return string
     */
    public static function symbol(): string
    {
        return static::class;
    }
}
