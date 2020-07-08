<?php

namespace Base\Kit\Support\Scalar;

class ArrayMaster
{
    /**
     * @param array $value
     * @return bool
     */
    public static function isList($value)
    {
        return is_array($value) && count($value) > 0;
    }

    /**
     * Implode the array.
     * @param string[] $value
     * @param string $glue
     * @return string|null null on fail.
     */
    public static function implode(array $value, $glue = ',')
    {
        try {
            return implode($glue, $value);
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Explode the array.
     * @param string $value
     * @param string $delimiter
     * @param int $limit
     * @return string[]
     */
    public static function explode($value, string $delimiter = ',', int $limit = PHP_INT_MAX)
    {
        try {
            return explode($delimiter, $value, $limit);
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Finds whether a variable is an array or an empty array.
     * @param mixed $value
     * @return bool
     */
    public static function isListOrEmpty($value)
    {
        return is_array($value);
    }

    /**
     * @param mixed $value
     * @return array
     */
    public static function forceBeArray($value)
    {
        $tmp = $value;
        if (!self::isListOrEmpty($tmp)) {
            $tmp = [$tmp];
        }

        return $tmp;
    }

    /**
     * Merge one or more arrays.
     * @param array $array1 Initial array to merge.
     * @param array $array2 Variable list of arrays to merge.
     * @param array $_ More variable list of arrays to merge.
     * @return array
     */
    public static function arrayMerge(array $array1, array $array2 = null, array $_ = null)
    {
        $arrayArgs = func_get_args();
        $result = [];
        foreach ($arrayArgs as $arr) {
            if (self::isList($arr)) {
                $result = array_merge($result, $arr);
            }
        }

        return $result;
    }

    /**
     * Return the first element in an array
     * @param mixed $arr
     * @param mixed $default
     * @return mixed
     */
    public static function first(array $arr, $default = null)
    {
        $result = $default;
        foreach ($arr as $item) {
            $result = $item;
            break;
        }

        return $result;
    }

    /**
     * @param array $array
     * @return mixed|null Returns the shifted value, or NULL if array is empty or is not an array.
     */
    public static function shift(array $array)
    {
        return array_shift($array);
    }

    /**
     * @param array $array
     * @param int $offset
     * @param int|null $length
     * @param bool $preserveKeys reorder and reset the integer key index by default.
     * set true to keep your keys sort.
     * @return array
     */
    public static function slice(array $array, int $offset, int $length = null, $preserveKeys = false)
    {
        return array_slice($array, $offset, $length, $preserveKeys);
    }
}
