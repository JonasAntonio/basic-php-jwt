<?php

namespace Basic\Jwt;

class Header
{
    private array $data;

    public function __construct(Algorithm $algorithm, Key $key)
    {
        $this->data = [
            'typ' => 'JWT',
            'alg' => $key->isAsymmetric()
                ? $algorithm->asymmetricHeader()
                : $algorithm->symmetricHeader()
        ];
    }

    public function __toString(): string
    {
        return Base64::urlEncode(json_encode($this->data));
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
