<?php

namespace Base\Kit\Support\Traits\Pattern;

use Closure;
use ReflectionClass;

/**
 * Trait Factory
 * @package Base\Kit\Support\Traits\Pattern
 */
trait Factory
{
    final private function __construct()
    {
    }

    /**
     * Make instance use key to find concrete and summon.
     * @param string $key
     * @param array $parameters
     * @return null|object null on fail.
     */
    public static function make(string $key, array $parameters = [])
    {
        return static::summon(static::mapping($key), $parameters, static::initMethodName());
    }

    /**
     * @param string|Closure|null $concrete when null will return null.
     * @param array $parameters
     * @param string|null $initStaticMethodName
     * @return null|object null on fail.
     */
    public static function summon($concrete, array $parameters = [], string $initStaticMethodName = null)
    {
        $instance = null;
        if (is_null($initStaticMethodName)) {
            try {
                if ($concrete instanceof Closure) {
                    $instance = $concrete($parameters);
                } else {
                    if (is_string($concrete)) {
                        $reflector = new ReflectionClass($concrete);
                        if ($reflector->isInstantiable()) {
                            if (function_exists('app')) {
                                $instance = app($concrete, $parameters);
                            } else {
                                $instance = $reflector->newInstance($parameters);
                            }
                        }
                    }
                }
            } catch (\Throwable $e) {
            }
        } else {
            try {
                $instance = $concrete::$initStaticMethodName(...$parameters);
            } catch (\Throwable $e) {
            }
        }

        return $instance;
    }

    /**
     * @param string $key
     * @return string
     */
    protected static function mapping(string $key)
    {
        return static::map()[$key] ?? static::defaultConcrete();
    }

    /**
     * The default concrete class you want create instance.
     * @return null|string
     */
    protected static function defaultConcrete()
    {
        return null;
    }

    /**
     * If want to use static init method by your self , please override this method ant return method string name.
     * @return null|string
     */
    protected static function initMethodName()
    {
        return null;
    }

    /**
     * @return array
     */
    abstract public static function map(): array;
}
