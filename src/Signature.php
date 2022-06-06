<?php

namespace Basic\Jwt;

use Basic\Jwt\Signatures\SignatureInterface;

class Signature
{
    private Key $key;
    private Algorithm $algorithm;

    private array $classMap = [
        0 => "Basic\\Jwt\\Signatures\\Symmetric",
        1 => "Basic\Jwt\Signatures\\Asymmetric"
    ];

    public function __construct(Algorithm $algorithm, Key $key)
    {
        $this->key = $key;
        $this->algorithm = $algorithm;
    }

    public function instance(): SignatureInterface
    {
        $class = $this->classMap[(int) $this->key->isAsymmetric()];
        return new $class($this->algorithm, $this->key);
    }
}
