<?php

namespace Basic\Jwt\Signatures;

use Basic\Jwt\Algorithm;
use Basic\Jwt\Base64;
use Basic\Jwt\Key;
use DomainException;

/**
 * Signs a JWT using a asymmetric
 */
class Asymmetric implements SignatureInterface
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
        $signed = openssl_sign(
            "$header.$payload",
            $signature,
            $this->key->get(),
            $this->algorithm->name()
        );

        if (!$signed) {
            throw new DomainException("Error signing token", 1);
        }

        return Base64::urlEncode($signature);
    }
}
