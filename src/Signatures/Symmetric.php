<?php

namespace Basic\Jwt\Signatures;

use Basic\Jwt\Algorithm;
use Basic\Jwt\Base64;
use Basic\Jwt\Key;
use DomainException;

/**
 * Signs a JWT using a symmetric key
 */
class Symmetric implements SignatureInterface
{
    private Key $key;
    private Algorithm $algorithm;

    public function __construct(Algorithm $algorithm, Key $key)
    {
        $this->key = $key;
        $this->algorithm = $algorithm;
    }

    public function sign(string $header, string $payload): string
    {
        $signature = hash_hmac(
            $this->algorithm->name(),
            (string) $header . "." . (string) $payload,
            $this->key->get(),
            true
        );

        if ($signature === null) {
            throw new DomainException("Error signing token", 1);
        }

        return Base64::urlEncode($signature);
    }
}
