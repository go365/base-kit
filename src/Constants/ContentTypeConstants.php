<?php

namespace Base\Kit\Constants;

class ContentTypeConstants extends BaseConstants
{
    const JSON = 'application/json';
    const BINARY_XML = 'application/xml';
    const TEXT_XML = 'text/xml';
    const TEXT_PLAIN = 'text/plain';
    const TEXT_HTML = 'text/html';
    const X_FORM_URLENCODED = 'application/x-www-form-urlencoded';

    /**
     * @return array
     */
    public static function enum(): array
    {
        return [
            self::JSON,
            self::BINARY_XML,
            self::TEXT_XML,
            self::TEXT_PLAIN,
            self::TEXT_HTML,
            self::X_FORM_URLENCODED
        ];
    }
}
