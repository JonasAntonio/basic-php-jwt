<?php

namespace Basic\Jwt;

use DomainException;

class Base64
{
    /**
     * Encodes base64 URL
     *
     * @param string $data
     * @return string
     */
    public static function urlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Decodes base64 URL
     *
     * @param string $data
     * @return string
     */
    public static function urlDecode(string $data): string
    {
        $decoded = base64_decode(
            strtr($data, '-_', '+/')
                . str_repeat('=', 3 - (3 + strlen($data)) % 4)
        );

        if ($decoded === false) {
            throw new DomainException("Could not decode base64");
        }

        return $decoded;
    }
}
