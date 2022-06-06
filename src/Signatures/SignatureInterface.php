<?php

namespace Basic\Jwt\Signatures;

use Basic\Jwt\Algorithm;
use Basic\Jwt\Key;

interface SignatureInterface
{
    public function  __construct(Algorithm $algorithm, Key $key);

    /**
     * Signs a JWT
     *
     * @param string $header
     * @param string $payload
     * @return string
     */
    public function sign(string $header, string $payload): string;
}
