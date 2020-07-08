<?php

namespace Base\Kit\Support\Scalar;

class StringMaster
{
    /**
     * The cache of snake-cased words.
     *
     * @var array
     */
    protected static $snakeCache = [];
    /**
     * The empty `string` `''`.
     *
     * @var string
     */
    private static $EMPTY_STR = '';

    /**
     * Checks if a `string` is empty (`''`) or `null`.
     *
     *     StringUtils::isEmpty(null);      // true
     *     StringUtils::isEmpty('');        // true
     *     StringUtils::isEmpty(' ');       // false
     *     StringUtils::isEmpty('bob');     // false
     *     StringUtils::isEmpty('  bob  '); // false
     *
     * @param string $str The `string` to check.
     *
     * @return boolean `true` if the `string` is empty or `null`, `false`
     *    otherwise.$EMPTY_STR
     */
    public static function isEmpty($str)
    {
        return (null === $str) || (self::$EMPTY_STR === $str);
    }

    /**
     * Checks if a `string` is not empty (`''`) and not `null`.
     *
     *     StringUtils::isNotEmpty(null);      // false
     *     StringUtils::isNotEmpty('');        // false
     *     StringUtils::isNotEmpty(' ');       // true
     *     StringUtils::isNotEmpty('bob');     // true
     *     StringUtils::isNotEmpty('  bob  '); // true
     *
     * @param string $str The `string` to check.
     *
     * @return boolean `true` if the `string` is not empty or `null`, `false`
     *    otherwise.
     */
    public static function isNotEmpty($str)
    {
        return false === self::isEmpty($str);
    }

    /**
     * Replaces a `string` with another `string` inside a larger `string`, for
     * the first maximum number of values to replace of the search `string`.
     *
     *     StringUtils::replace(null, *, *, *)         // null
     *     StringUtils::replace('', *, *, *)           // ''
     *     StringUtils::replace('any', null, *, *)     // 'any'
     *     StringUtils::replace('any', *, null, *)     // 'any'
     *     StringUtils::replace('any', '', *, *)       // 'any'
     *     StringUtils::replace('any', *, *, 0)        // 'any'
     *     StringUtils::replace('abaa', 'a', null, -1) // 'abaa'
     *     StringUtils::replace('abaa', 'a', '', -1)   // 'b'
     *     StringUtils::replace('abaa', 'a', 'z', 0)   // 'abaa'
     *     StringUtils::replace('abaa', 'a', 'z', 1)   // 'zbaa'
     *     StringUtils::replace('abaa', 'a', 'z', 2)   // 'zbza'
     *     StringUtils::replace('abaa', 'a', 'z', -1)  // 'zbzz'
     *
     * @param string $text The `string` to search and replace in.
     * @param string $search The `string` to search for.
     * @param string $replace The `string` to replace $search with.
     * @param integer $max The maximum number of values to replace, or `-1`
     *                         if no maximum.
     *
     * @return string The text with any replacements processed or `null` if
     *    `null` `string` input.
     */
    public static function replace($text, $search, $replace, $max = -1)
    {
        if (true === self::isEmpty($text) || true === self::isEmpty($search) || null === $replace || (0 === $max)) {
            return $text;
        }

        return \preg_replace('/' . \preg_quote($search, '/') . '/', $replace, $text, $max);
    }

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param  string $haystack
     * @param  string|array $needles
     * @return bool
     */
    public static function startsWith($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ($needle !== '' && substr($haystack, 0, strlen($needle)) === (string)$needle) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given string ends with a given substring.
     *
     * @param  string $haystack
     * @param  string|array $needles
     * @return bool
     */
    public static function endsWith($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if (substr($haystack, -strlen($needle)) === (string)$needle) {
                return true;
            }
        }

        return false;
    }

    /**
     * Convert the given string to lower-case.
     *
     * @param  string $value
     * @return string
     */
    public static function lower($value)
    {
        return mb_strtolower($value, 'UTF-8');
    }

    /**
     * Convert the given string to upper-case.
     *
     * @param  string $value
     * @return string
     */
    public static function upper($value)
    {
        return mb_strtoupper($value, 'UTF-8');
    }

    /**
     * Return the length of the given string.
     *
     * @param  string $value
     * @param  string $encoding
     * @return int
     */
    public static function length($value, $encoding = null)
    {
        if ($encoding) {
            return mb_strlen($value, $encoding);
        }

        return mb_strlen($value);
    }

    /**
     * Convert a string to snake case.
     *
     * @param  string $value
     * @param  string $delimiter
     * @return string
     */
    public static function snake($value, $delimiter = '_')
    {
        $key = $value;
        if (isset(static::$snakeCache[$key][$delimiter])) {
            return static::$snakeCache[$key][$delimiter];
        }
        if (!ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));
            $value = static::lower(preg_replace('/(.)(?=[A-Z])/u', '$1' . $delimiter, $value));
        }

        return static::$snakeCache[$key][$delimiter] = $value;
    }

    /**
     * Returns the portion of string specified by the start and length parameters.
     *
     * @param  string $string
     * @param  int $start
     * @param  int|null $length
     * @return string
     */
    public static function substr($string, $start, $length = null)
    {
        return mb_substr($string, $start, $length, 'UTF-8');
    }

    /**
     * Make a string's first character uppercase.
     *
     * @param  string $string
     * @return string
     */
    public static function ucfirst($string)
    {
        return static::upper(static::substr($string, 0, 1)) . static::substr($string, 1);
    }
}
