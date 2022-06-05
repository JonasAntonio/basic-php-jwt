<?php

namespace Basic\Jwt;

use DomainException;

class Signature
{
    private string $key;
    private Algorithm $algorithm;

    public function __construct(Algorithm $algorithm, string $key)
    {
        $this->key = $key;
        $this->algorithm = $algorithm;
    }

    public function sign(string $header, string $payload): string
    {
        $signature = hash_hmac(
            $this->algorithm->name(),
            (string) $header . "." . (string) $payload,
            $this->key,
            true
        );

        if ($signature === null) {
            throw new DomainException("Error signing token", 1);
        }

        return Base64::urlEncode($signature);
    }
}
